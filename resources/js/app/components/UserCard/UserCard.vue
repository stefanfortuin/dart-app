<template>
	<div
		class="relative transition-all duration-500 ease-in-out px-3 py-2"
		:class="
      user.is_on_turn
        ? 'text-white z-30'
        : 'text-blue-500 text-opacity-75 z-10'
    "
	>
		<div class="flex items-baseline">
			<user-name class="text-xl" :user="user" />
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
