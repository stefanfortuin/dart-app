<template>
	<div class="flex justify-between mb-2">
		<div class="text-6xl font-bold">
			{{animatedScore}}
		</div>
		<transition name="checkout-text" mode="out-in">
			<div v-show="user.checkout != ''" :key="user.checkout" class="text-xl self-end">
				{{user.checkout}}
			</div>
		</transition>
	</div>
</template>

<script>
import {gsap} from 'gsap';
export default {
	props: ['user'],
	data(){
		return {
			tweenedScore: null,
		}
	},
	created(){
		this.tweenedScore = this.user.start_score;
	},
	computed: {
		animatedScore(){
			return this.tweenedScore.toFixed(0);
		}
	},
	watch: {
		'user.score_to_throw_from': function(newValue){
			gsap.to(this.$data, {duration: 0.7, tweenedScore: newValue})
		} 
	}
}
</script>