<template>
	<div class="p-3 bg-gray-100 my-2 rounded-lg shadow-md flex-grow max-h-60">
		<svg
			ref="graph"
			width="100%"
			height="100%"
		>
			<polyline
				v-for="user in getUsers"
				:key="user.id"
				:points="getPointsFromTurns(user.turns)"
				style="fill:none;stroke:black;stroke-width:3"
			/>
		</svg>
	</div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
	data(){
		return{
			width: null,
			height: null,
			scale_y: null,
			scale_x: null,
		}
	},
	mounted(){
		this.updateScale();
		window.addEventListener('resize', () => {
			this.updateScale();
		})
	},
	computed: {
		...mapGetters([
			'getTurns',
			'getUsers',
			'getStartScore'
		])
	},
	methods: {
		updateScale() {
			if(this.$refs.graph == undefined) return;

			this.width = this.$refs.graph.clientWidth;
			this.height = this.$refs.graph.clientHeight;
			this.scale_x = (this.getTurns.length == 0) ? 1 : this.width / (this.getTurns.length / 2);
			this.scale_y = this.height / this.getStartScore;
		},

		getPointsFromTurns(turns) {
			this.updateScale();
			let points = "";

			console.log(turns)
			for (let i = 0; i < turns.length; i++) {
				const turn = turns[i];

				if(i == 0){
					points += `0,${this.height - (this.getStartScore * this.scale_y)} `
				}

				let y_new = this.height - (turn.new_score_to_throw_from * this.scale_y);
				let x_new = i * this.scale_x;
				points += `${x_new},${y_new} `
			}

			return points;
		}
	}
}
</script>