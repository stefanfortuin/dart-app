<template>
	<div class="text-left text-2xl">
		{{user.name}}
		<div
			v-if="user.owns_current_leg"
			class="inline-flex rounded-full h-2 w-2"
			:class="user.is_on_turn ? 'bg-white' : 'bg-blue-500'"
		></div>
	</div>
</template>

<script>
export default {
	props: ['user'],
}
</script>