<template>
  <div
    class="transition-colors first:rounded-t-lg last:rounded-b-lg px-3 py-2"
    :class="
      user.is_on_turn
        ? 'bg-blue-500 text-white shadow-md'
        : 'bg-blue-100 text-blue-600 opacity-50 shadow'
    "
  >
	<user-name :user="user" />
    <user-score-and-checkout :user="user" />
  </div>
</template>

<script>
import UserScoreAndCheckout from "./UserScoreAndCheckout";
import UserName from "./UserName";

export default {
  props: ["user", "isOnTurn"],
  components: {
    UserScoreAndCheckout,
    UserName,
  },
};
</script>
