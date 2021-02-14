<template>
	<div class="flex flex-col mb-3">
		<label :for="id" class="mb-2 text-xl font-semibold text-blue-400">{{label}}</label>
		<input
			type="text"
			:value="value"
			:id="id"
			@input="$emit('input', $event.target.value)"
			class="border-2 border-blue-200 py-3 px-4 rounded-lg text-3xl font-bold text-blue-500"
		>
	</div>
</template>

<script>
export default {
	props: [
		'value',
		'id',
		'label'
	]
}
</script>