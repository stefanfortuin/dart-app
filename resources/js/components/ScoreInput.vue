<template>
	<div class="mt-auto w-full">
		<label
			for="dart-id"
			:key="'dart-' + user.current_dart"
			class="text-blue-500 font-bold text-xl"
		>Pijl - {{user.current_dart}}</label>
		<input
			type="number"
			id="dart-id"
			:value="value"
			min=0
			max=60
			placeholder="Score"
			@change="$emit('change', $event.target)"
			class="w-full border-2 border-blue-300 py-4 px-5 mt-3 rounded-lg text-xl"
		>
	</div>

</template>

<script>
export default {
	props: ['user', 'value']
}
</script>