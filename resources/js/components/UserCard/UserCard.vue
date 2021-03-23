<template>
	<div
		class="transition-all first:rounded-t-lg last:rounded-b-lg px-3 py-2"
		:class="user.is_on_turn ? 'bg-blue-500 text-white shadow-md' : 'bg-blue-100 text-blue-600 opacity-50 shadow'
		"
	>
		<div class="flex justify-between items-baseline mb-2">
			<user-name :user="user"/>
			<user-last-turn :turn="user.last_turn" />
		</div>
		<user-score-and-checkout :user="user" />
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
