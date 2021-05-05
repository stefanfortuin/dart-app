<template>
	<div
		v-if="user.owns_current_leg"
		class="rounded-full ml-2 h-2 w-2 transition-all duration-300 ease-in-out"
		:class="user.is_on_turn ? 'bg-white' : 'bg-blue-500 bg-opacity-75'"
	></div>
</template>

<script>
export default {
	props: ['user']
}
</script>