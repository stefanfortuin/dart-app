<template>
	<div class="flex flex-col w-full h-full font-semibold">
		<h1 class="text-4xl self-start text-gray-700 font-bold">Wie begint?</h1>
		<div class=" my-auto">
			<div
				v-for="user in users"
				:key="user.name"
				@click="handleWhoBegins(user)"
				class="text-5xl bg-blue-500 font-bold h-48 rounded-lg shadow-md text-white flex justify-center items-center my-4"
			>
				{{user.name}}
			</div>
		</div>
	</div>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'
export default {
	computed: {
		...mapGetters({
			users: 'getUsers',
		})
	},

	methods: {
		...mapMutations([
			'setUserThatDoesTurn',
			'goToNextStep',
		]),

		handleWhoBegins(user) {
			this.setUserThatDoesTurn(user);
			this.goToNextStep();

		}
	}
}
</script>