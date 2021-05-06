<template>
	<div class="flex flex-col mb-1">
		<label :for="id" class="mb-1 text-lg font-semibold text-blue-400">{{label}}</label>
		<input
			type="text"
			:value="modelValue"
			:id="id"
			:readonly="readonly"
			placeholder="Phil Taylor"
			@input="$emit('update:modelValue', $event.target.value)"
			class="py-1 px-3 placeholder-blue-100 rounded-lg text-2xl font-semibold text-blue-500"
			:class="(readonly) ? '' : 'border-2 border-blue-200'"
		>
	</div>
</template>

<script>
export default {
	props: [
		'modelValue',
		'id',
		'label',
		'readonly'
	]
}
</script>