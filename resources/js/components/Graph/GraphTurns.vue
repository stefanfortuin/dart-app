<template>
	<div class="rounded-lg flex justify-center items-center h-full relative">
		<svg
			v-for="user in users"
			:key="user.id"
			xmlns="http://www.w3.org/2000/svg"
			ref="graph"
			:viewBox="`-6 -8 ${width + 12} ${height + 12}`"
			width="100%"
			height="100%"
			class="absolute"
			:class="
        user.is_on_turn ? 'stroke-white z-20' : 'stroke-lightblue z-10'
      "
		>
			<path
				:ref="`graph_line_${user.id}`"
				:id="`graph_line_${user.id}`"
				:d="getLinePath(user)"
				fill="none"
				stroke-width="4"
				:pathLength="user.turns.length"
				:stroke-linecap="user.turns.length >= 1 ? 'round' : ''"
				style="transition: stroke 0.3s ease-in-out;"
			/>
		</svg>
		<svg 
			xmlns="http://www.w3.org/2000/svg"
			:viewBox="`-6 -8 ${width + 12} ${height + 12}`"
			width="100%"
			height="100%"
			class="absolute z-0">
			<line
				v-for="(point,i) in graph_points + 1"
				:key="point"
				:x1="i * scale_x"
				:y1="0"
				:x2="i * scale_x"
				:y2="height"
				stroke-width="3"
				class="stroke-graphaxis opacity-10"
			>
			</line>
		</svg>
	</div>
</template>

<script>
import { mapState } from "vuex";
import { line, curveMonotoneX } from 'd3-shape';
import anime from 'animejs';

export default {
	name: 'graph-turns',
	data() {
		return {
			width: null,
			height: null,
			scale_y: null,
			scale_x: null,
			graph_points: 5, //default
			paths: [

			]
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
			users: state => state.users,
			startScore: state => state.start_score,
			user_on_turn: state => state.users.find(u => u.is_on_turn)
		})
	},
	methods: {
		updateScale() {
			if (this.$refs.graph == undefined) return;

			if(this.user_on_turn.turns.length == 0)
				this.graph_points = 5;

			if (this.user_on_turn.turns.length >= this.graph_points + 1)
				this.graph_points += 1;

			this.width = this.$refs.graph.clientWidth;
			this.height = this.$refs.graph.clientHeight;
			this.scale_x = this.width / this.graph_points;
			this.scale_y = this.height / this.startScore;
		},

		getPointsFromTurns(turns) {
			this.updateScale();
			let points = turns.map((turn, i) => [
				(i + 1) * this.scale_x,
				this.height - turn.new_score_to_throw_from * this.scale_y,
				turn.thrown_score
			]);

			//push the startpoint at the beginning of the array
			points.unshift([
				0,
				this.height - this.startScore * this.scale_y,
			])
			return points;
		},

		getLinePath(user) {
			let element = this.$refs[`graph_line_${user.id}`];

			let points = this.getPointsFromTurns(user.turns);

			this.animatePath(element, user);

			let lineGenerator = line().curve(curveMonotoneX);
			return lineGenerator(points);
		},

		animatePath(path_element, user){
			if (!path_element) return;
			if (!user.is_on_turn) return;

			if (path_element.style.strokeDasharray > user.turns.length)
				path_element.style.strokeDasharray = 0;

			//animatie the svg path only when it has added a new point
			if (path_element.style.strokeDasharray < user.turns.length) {
				path_element.style.strokeDasharray = user.turns.length
				path_element.style.strokeDashoffset = 1;

				anime({
					targets: path_element,
					strokeDashoffset: 0,
					duration: 250,
					easing: 'easeOutQuad',
				})
			}
		}
	},
};
</script>