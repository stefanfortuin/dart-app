<template>
	<div class="flex flex-col w-full h-full font-semibold">
		<h1 class="text-5xl mb-4 self-start text-gray-700 font-bold"><span class="text-blue-500">Wie</span> begint?</h1>

		<div
			v-for="user in users"
			:key="user.name"
			@click="handleWhoBegins(user)"
			class="p-4 bg-blue-500 font-bold h-48 rounded-lg shadow-md text-white flex flex-col justify-between my-2"
		>
			<div class="text-5xl">
				{{user.name}}
			</div>
			<div class="font-thin">
				Laatste spel was <span class="font-semibold">3 dagen</span> geleden
			</div>
		</div>
	</div>
</template>

<script>
import { mapState, mapMutations } from 'vuex'
export default {
	computed: {
		...mapState({
			users: state => state.users,
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