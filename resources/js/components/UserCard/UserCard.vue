<template>
	<div
		class="transition-colors first:rounded-t-lg last:rounded-b-lg px-3 py-2"
		:class="
      user.is_on_turn
        ? 'bg-blue-500 text-white shadow-md'
        : 'bg-blue-100 text-blue-600 opacity-50 shadow'
    "
	>
		<div class="flex items-baseline">
			<user-name :user="user" />
			<user-owns-leg :user="user" />
		</div>
		<div class="flex justify-between items-baseline">
			<user-score :user="user" />
			<user-checkout :user="user" />
		</div>
	</div>
</template>

<script>
import UserScore from "./UserScore";
import UserName from "./UserName";
import UserOwnsLeg from './UserOwnsLeg.vue';
import UserCheckout from './UserCheckout.vue';

export default {
	props: ["user"],
	components: {
		UserScore,
		UserName,
		UserOwnsLeg,
		UserCheckout
	},
};
</script>
