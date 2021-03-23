<template>
	<div class="bg-blue-100 bg-opacity-75 rounded-lg my-2 flex-grow flex justify-center items-center max-h-60 relative">
		<svg
			v-for="user in users"
			:key="user.id"
			xmlns="http://www.w3.org/2000/svg"
			ref="graph"
			width="100%"
			height="100%"
			class="absolute px-3 py-2"
			:class="
        user.is_on_turn ? 'stroke-blue z-20' : 'stroke-lightblue opacity-70 z-10'
      "
		>
			<g>
				<path
					:ref="`graph_line_${user.id}`"
					:d="getLinePath(user)"
					style="transition: stroke 0.3s ease-in-out; fill: none; stroke-width: 3;"
				/>
			</g>
			<g v-if="user.turns.length > 0 && user.is_on_turn">
				<circle
					v-for="point in getPointsFromTurns(user.turns)"
					:key="point[0]"
					:cx="point[0]"
					:cy="point[1]"
					fill="white"
					r="0.18rem"
				></circle>
			</g>
		</svg>
	</div>
</template>

<script>
import { mapState } from "vuex";
import { line, curveMonotoneX } from 'd3-shape';

export default {
	data() {
		return {
			width: null,
			height: null,
			scale_y: null,
			scale_x: null,
			graph_points: 5, //default
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
			if (this.user_on_turn.turns.length >= this.graph_points) 
				this.graph_points += 1;

			this.width = this.$refs.graph.clientWidth - 16;
			this.height = this.$refs.graph.clientHeight - 24;
			this.scale_x = this.width / this.graph_points;
			this.scale_y = this.height / this.startScore;
		},

		getPointsFromTurns(turns) {
			this.updateScale();
			let points = turns.map((turn, i) => [
				(i + 1) * this.scale_x,
				this.height - turn.new_score_to_throw_from * this.scale_y,
				turn.new_score_to_throw_from
			]);

			//push the startpoint at the beginning of the array
			points.unshift([
				0,
				this.height - this.startScore * this.scale_y,
			])
			return points;
		},

		getLinePath(user) {
			let points = this.getPointsFromTurns(user.turns);
			let lineGenerator = line().curve(curveMonotoneX);
			return lineGenerator(points);
		},
	},
};
</script>