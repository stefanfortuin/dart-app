<template>
	<div
		ref="graph"
		class="flex justify-center items-center h-full overflow-scroll relative"
	>
		<svg
			v-for="user in users"
			:key="user.id"
			xmlns="http://www.w3.org/2000/svg"
			height="100%"
			:width="`${graph_points * scale_x}px`"
			:viewBox="`-2 -4 ${graph_points * scale_x} ${height + 4}`"
			preserveAspectRatio="none"
			class="absolute top-0 left-0"
			:class="user.is_on_turn ? 'stroke-white z-20' : 'stroke-lightblue z-10'"
		>
			<path
				:ref="`graph_line_${user.id}`"
				:id="`graph_line_${user.id}`"
				:d="getLinePath(user)"
				fill="none"
				stroke-width="3"
				:pathLength="user.turns.length"
				:stroke-linecap="user.turns.length >= 1 ? 'round' : ''"
				style="transition: stroke 0.3s ease-in-out"
			/>
		</svg>
		<svg
			xmlns="http://www.w3.org/2000/svg"
			:width="`${graph_points * scale_x}px`"
			:viewBox="`-2 -4 ${graph_points * scale_x} ${height + 4}`"
			height="100%"
			preserveAspectRatio="none"
			class="absolute z-0 top-0 left-0"
		>
			<line
				v-for="(point, i) in graph_points + 1"
				:key="point"
				:x1="i * scale_x"
				:y1="0"
				:x2="i * scale_x"
				:y2="height"
				stroke-width="2.5px"
				class="stroke-graphaxis opacity-10"
			></line>
		</svg>
		<svg 
			xmlns="http://www.w3.org/2000/svg"
			:width="`${graph_points * scale_x}px`"
			:viewBox="`-2 -4 ${graph_points * scale_x} ${height + 4}`"
			height="100%"
			preserveAspectRatio="none"
			class="absolute z-50 top-0 left-0">
			<rect 
				v-for="(point, i) in graph_points"
				:key="point"
				:x="i * scale_x"
				:y="0"
				:width="`${1 * scale_x}px`"
				class="fill-current"
				:class="currentGraphIndex == i ? 'text-blue-300 opacity-20' : 'opacity-0'"
				@click="getTurnsAtIndex(i)"
				height="100%" 
			/>
		</svg>
		<transition
			name="tab-fade"
			mode="out-in"
		>
			<div
				v-if="graphTurnData.length > 0"
				:key="`graph_index_${currentGraphIndex}`"
				class="p-2 right-0 top-0 absolute grid gap-y-1"
			>
				<div
					v-for="turn in graphTurnData"
					:key="`graph_turn_${turn.user_id}`"
					class="rounded leading-4 px-1 text-right bg-blue-100 text-blue-900 font-semibold"
				>
					{{ turn.thrown_score }}
				</div>
			</div>
		</transition>
	</div>
</template>

<script>
import { mapState } from "vuex";
import { line, curveMonotoneX } from "d3-shape";
import anime from "animejs";

export default {
	name: "graph-turns",
	data() {
		return {
			width: null,
			height: null,
			scale_y: null,
			scale_x: null,
			graph_points: 4, //default
			paths: [],
			currentGraphIndex: undefined,
			graphTurnData: [],
		};
	},
	mounted() {
		this.updateScale();
		window.addEventListener("resize", () => {
			this.updateScale();
		});
	},
	computed: {
		...mapState({
			users: (state) => state.users,
			startScore: (state) => state.start_score,
			user_on_turn: (state) => state.users.find((u) => u.is_on_turn),
		}),
	},
	methods: {
		updateScale() {
			if (this.$refs.graph == undefined) return;

			this.incrementGraphPoints();

			this.width = this.$refs.graph.clientWidth;
			this.height = this.$refs.graph.clientHeight;
			this.scale_x = this.width / 5;
			this.scale_y = this.height / this.startScore;
		},

		incrementGraphPoints() {
			if (this.user_on_turn.turns.length == 0) this.graph_points = 5;

			if (this.user_on_turn.turns.length >= this.graph_points + 1)
				this.graph_points += 1;
		},

		scrollToLeft(){
			if (this.$refs.graph == undefined) return;
			let scroll_element = this.$refs.graph;
			let value_to_scroll_to = scroll_element.scrollLeft + (1 * this.scale_x);
			anime({
				targets: scroll_element,
				scrollLeft: value_to_scroll_to,
				duration: 500,
				easing: 'easeInOutQuad'
			})
		},

		getPointsFromTurns(turns) {
			this.incrementGraphPoints();
			this.scrollToLeft();
			let points = turns.map((turn, i) => [
				(i + 1) * this.scale_x,
				this.height - turn.new_score_to_throw_from * this.scale_y,
				turn.thrown_score,
			]);

			//push the startpoint at the beginning of the array
			points.unshift([0, this.height - this.startScore * this.scale_y]);
			return points;
		},

		getLinePath(user) {
			let element = this.$refs[`graph_line_${user.id}`];

			let points = this.getPointsFromTurns(user.turns);

			this.animatePath(element, user);

			let lineGenerator = line().curve(curveMonotoneX);
			return lineGenerator(points);
		},

		getTurnsAtIndex(index) {
			if (this.graphTurnData.length > 0 && this.currentGraphIndex == index) {
				this.graphTurnData = [];
				this.currentGraphIndex = undefined;
				return;
			}

			this.currentGraphIndex = index;

			this.graphTurnData = this.users.map((user) => {
				return user.turns[index];
			});
		},

		animatePath(path_element, user) {
			if (!path_element) return;
			if (!user.is_on_turn) return;

			if (path_element.style.strokeDasharray > user.turns.length)
				path_element.style.strokeDasharray = 0;

			//animatie the svg path only when it has added a new point
			if (path_element.style.strokeDasharray < user.turns.length) {
				path_element.style.strokeDasharray = user.turns.length;
				path_element.style.strokeDashoffset = 1;

				anime({
					targets: path_element,
					strokeDashoffset: 0,
					duration: 250,
					easing: "easeOutQuad",
				});
			}
		},
	},
};
</script>