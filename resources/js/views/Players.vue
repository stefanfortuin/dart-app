<template>
	<div>
		Speler 1
		<PlayerInput v-model="data.user_one" />
		Speler 2
		<PlayerInput v-model="data.user_two" />

		<button @click="handleNextStep">
			Volgende
		</button>
	</div>
</template>

<script>
import PlayerInput from '../components/PlayerInput';
import { mapMutations } from 'vuex';

export default {
	data() {
		return {
			data: {
				user_one: "",
				user_two: ""
			},
		}
	},
	components: {
		PlayerInput,
	},
	methods: {
		...mapMutations([
			'setUsers',
			'goToNextStep',
		]),

		handleNextStep() {
			fetch('http://localhost/api/users', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(this.data),
			})
				.then(response => response.json())
				.then(response => {
					this.setUsers(response);
					this.goToNextStep();
				})
		}
	}
}
</script>