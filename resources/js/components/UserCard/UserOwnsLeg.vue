<template>
	<div
		v-if="user.owns_current_leg"
		class="rounded-full ml-2 h-2 w-2 transition-colors duration-300 ease-in-out"
		:class="user.is_on_turn ? 'bg-white' : 'bg-blue-500'"
	></div>
</template>

<script>
export default {
	props: ['user']
}
</script>