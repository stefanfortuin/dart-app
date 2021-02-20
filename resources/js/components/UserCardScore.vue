<template>
	<div
		class=" transition-colors duration-300 ease-in-out rounded-lg p-4 mb-2"
		:class="(isOnTurn) ? 'bg-blue-500' : 'bg-gray-100'"
	>
		<user-name
			:user="user"
			:class="(isOnTurn) ? 'text-white' : 'text-gray-600'"
		/>
		<user-score-and-checkout
			:user="user"
			:class="(isOnTurn) ? 'text-white' : 'text-gray-700'"
		/>
		<user-last-turn
			v-if="user.last_turn"
			:turn="user.last_turn"
			:class="(isOnTurn) ? 'text-gray-200' : 'text-gray-500'"
		/>
	</div>
</template>

<script>
import UserLastTurn from './UserLastTurn';
import UserScoreAndCheckout from './UserScoreAndCheckout';
import UserName from './UserName';

export default {
	props: ['user', 'isOnTurn'],
	components: {
		UserLastTurn,
		UserScoreAndCheckout,
		UserName,
	},
}
</script>