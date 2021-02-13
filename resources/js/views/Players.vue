<template>
	<div class="h-full w-full flex flex-col justify-between">
		<div>
			<PlayerInput
				id="player_one"
				label="Speler 1"
				v-model="data.user_one"
			/>
			<PlayerInput
				id="player_two"
				label="Speler 2"
				v-model="data.user_two"
			/>
			<div class="flex flex-col w-full mb-3">
				<label
					for="set_start_score"
					class="mb-2 text-xl font-semibold"
				>Start score</label>
				<input
					type="number"
					min=201
					max=501
					name="set_start_score"
					id="set_start_score"
					class="border-2 border-blue-200 py-4 px-5 rounded-lg text-xl"
					v-model="start_score"
				>
			</div>
		</div>

		<div class="flex flex-col w-full font-bold text-2xl text-white">
			<a
				@click="handleNextStep"
				class="h-20 rounded-lg my-2 flex justify-center items-center"
				:class="(canProceed) ? 'bg-green-500' : 'bg-blue-200'"
			>
				Volgende
			</a>

			<a
				href="/stats"
				class="h-20 bg-blue-500 rounded-lg my-2 flex justify-center items-center"
			>Statistieken</a>
		</div>
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
			start_score: 501,
			all_users: null
		}
	},
	created() {
		// fetch('http://localhost/api/all_users')
		// .then(response => response.json())
		// .then(response => {
		// 	this.all_users = response;
		// })
	},
	components: {
		PlayerInput,
	},
	computed: {
		canProceed() {
			return this.data.user_one != "" && this.data.user_two != ""
		}
	},
	methods: {
		...mapMutations([
			'setUsers',
			'goToNextStep',
			'setStartScore'
		]),

		handleNextStep() {
			if (!this.canProceed) return;

			this.setStartScore(this.start_score);

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