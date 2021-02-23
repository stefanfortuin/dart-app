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
			class="w-full bg-gray-200 text-gray-700 font-bold placeholder-opacity-40 shadow-md placeholder-gray-400 py-3 px-5 mt-3 rounded-lg text-4xl"
		>
	</div>

</template>

<script>
export default {
	props: ['user', 'value'],
}
</script>