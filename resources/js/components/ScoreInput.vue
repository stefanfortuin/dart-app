<template>
	<div class="mt-auto w-full">
		<input
			type="number"
			id="dart-id"
			:value="value"
			min=0
			max=180
			placeholder="Score"
			@change="$emit('change', $event.target)"
			class="w-full border-2 border-blue-300 py-4 px-5 mt-3 rounded-lg text-xl"
		>
	</div>

</template>

<script>
export default {
	props: ['user', 'value'],
}
</script>