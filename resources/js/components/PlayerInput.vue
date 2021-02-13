<template>
	<div>
		<input
			type="text"
			:value="value"
			placeholder="Spelernaam"
			@input="$emit('input', $event.target.value)"
		>
	</div>
</template>

<script>
export default {
	props: [
		'value'
	]
}
</script>