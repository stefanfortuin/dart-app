<template>
  <div>
	  <h1>Wie begint?</h1>
	  <div v-for="user in users" :key="user.name" @click="handleWhoBegins(user)">
		  {{user.name}}
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

		handleWhoBegins(user){
			this.setUserThatDoesTurn(user);
			this.goToNextStep();
		}
	}
}
</script>