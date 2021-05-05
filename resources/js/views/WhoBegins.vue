<template>
	<div class="flex flex-col w-full h-full font-semibold">
		<h1 class="text-5xl mb-4 self-start text-gray-700 font-bold"><span class="text-blue-500">Wie</span> begint?</h1>

		<div
			v-for="user in users"
			:key="user.name"
			@click="handleWhoBegins(user)"
			class="p-4 bg-blue-500 font-bold h-48 rounded-lg shadow-md text-white flex flex-col justify-between my-2"
		>
			<user-name :user="user" />
			<div v-if="user.latest_game && user.latest_game != false" class="font-thin">
				Laatste spel <span class="font-semibold">{{user.latest_game}}</span>
			</div>
			<div v-else class="font-thin">
				Nog geen spellen gespeeld
			</div>
		</div>
	</div>
</template>

<script>
import UserName from '../components/UserCard/UserName.vue';
import { mapState, mapMutations } from 'vuex'
export default {
	components: {
		UserName,
	},
	computed: {
		...mapState({
			users: state => state.users,
		})
	},

	methods: {
		...mapMutations([
			'setUserThatDoesTurn',
			'startGame',
			'goToNextStep',
		]),

		handleWhoBegins(user) {
			this.setUserThatDoesTurn(user);
			this.startGame()
			this.goToNextStep();
		}
	}
}
</script>