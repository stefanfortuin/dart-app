<template>
	<div
		class="transition-all first:rounded-t-lg last:rounded-b-lg last px-3 py-2"
		:class="(isOnTurn) ? 'bg-blue-500 text-white shadow-md' : 'bg-blue-200 text-blue-600 opacity-50 shadow'
		"
	>
		<div class="flex justify-between items-baseline mb-2">
			<user-name :user="user" />
			<user-last-turn :turn="user.last_turn" />
		</div>
		<user-score-and-checkout :user="user" />
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
