<template>
	<div
		class="transition-all rounded-lg shadow-md p-3 mb-2"
		:class="(isOnTurn) ? 'bg-blue-500' : 'bg-gray-200'"
	>
		<div class="flex justify-between">
			<user-name
				:user="user"
				:class="(isOnTurn) ? 'text-white' : 'text-gray-600'"
			/>
			<user-card-highlight v-if="isOnTurn" />
		</div>
		<user-score-and-checkout
			:user="user"
			:class="(isOnTurn) ? 'text-white' : 'text-gray-700'"
		/>
		<user-last-turn
			:turn="user.last_turn"
			:class="(isOnTurn) ? 'text-gray-200' : 'text-gray-500'"
		/>
	</div>
</template>

<script>
import UserLastTurn from './UserLastTurn';
import UserScoreAndCheckout from './UserScoreAndCheckout';
import UserName from './UserName';
import UserCardHighlight from './UserCardHighlight.vue';

export default {
	props: ['user', 'isOnTurn'],
	components: {
		UserLastTurn,
		UserScoreAndCheckout,
		UserName,
		UserCardHighlight,
	},
}
</script>