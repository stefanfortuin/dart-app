<template>
	<div class="flex justify-between font-bold mb-4">
		<div class="text-blue-500 text-6xl">
			{{user.score_to_throw_from}}
		</div>
		<div class="text-2xl flex items-end">
			{{user.checkout}}
		</div>
	</div>
</template>

<script>
export default {
	props: ['user']
}
</script>