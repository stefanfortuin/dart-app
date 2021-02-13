<template>
	<div class="flex flex-col h-28 mb-4">
		<label :for="id" class="mb-2 text-xl font-semibold">{{label}}</label>
		<input
			type="text"
			:value="value"
			:id="id"
			placeholder="Naam speler"
			@input="$emit('input', $event.target.value)"
			class="border-2 border-blue-200 py-4 px-5 rounded-lg text-xl"
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