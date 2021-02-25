<template>
	<div class="flex justify-between mb-2">
		<div class="text-6xl font-bold">
			{{user.score_to_throw_from}}
		</div>
		<div class="text-xl font-normal flex items-end">
			{{user.checkout}}
		</div>
	</div>
</template>

<script>
export default {
	props: ['user']
}
</script>