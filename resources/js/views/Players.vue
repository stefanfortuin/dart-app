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
					class="mb-2 text-xl font-semibold text-blue-400"
				>Start score</label>
				<input
					type="number"
					min=201
					max=501
					name="set_start_score"
					id="set_start_score"
					class="border-2 border-blue-200 text-blue-500 font-bold text-3xl py-3 px-4 rounded-lg"
					v-model="start_score"
				>
			</div>
		</div>

		<div class="flex flex-col w-full font-bold text-2xl text-white">
			<a
				@click="handleNextStep"
				class="p-4 rounded-lg my-1 flex justify-center items-center bg-gradient-to-br"
				:class="(canProceed) ? 'from-green-600 to-green-500' : 'bg-blue-200'"
			>
				Volgende
			</a>

			<a
				href="/stats"
				class="p-4 bg-gradient-to-br from-blue-600 to-blue-500 rounded-lg my-1 flex justify-center items-center"
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
	components: {
		PlayerInput,
	},
	computed: {
		canProceed() {
			return this.fieldsAreNotEmpty && this.usersAreNotTheSame;
		},

		usersAreNotTheSame(){
			return this.data.user_one.toLowerCase() != this.data.user_two.toLowerCase()
		},

		fieldsAreNotEmpty(){
			return this.data.user_one != "" && this.data.user_two != "" && this.start_score != ""
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

			fetch('https://darts.stefanfortuin.nl/api/users', {
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