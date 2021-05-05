<template>
	<div class="flex flex-col mb-1">
		<label :for="id" class="mb-1 text-lg font-semibold text-blue-400">{{label}}</label>
		<input
			type="number"
			:value="modelValue"
			:id="id"
			:min="min"
			:max="max"
			@input="$emit('update:modelValue', $event.target.value)"
			class="border-2 border-blue-200 py-1 px-3 placeholder-blue-100 rounded-lg text-3xl font-bold text-blue-500"
		>
	</div>
</template>

<script>
export default {
	props: [
		'modelValue',
		'id',
		'label',
		'max',
		'min'
	]
}
</script>