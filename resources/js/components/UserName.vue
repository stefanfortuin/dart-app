<template>
	<div class="text-left text-gray-700 font-semibold text-3xl mb-3">
		{{user.name}}
	</div>
</template>

<script>
export default {
	props: ['user'],
}
</script>