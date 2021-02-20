<template>
	<div class="bg-blue-500 rounded-lg px-3 py-4">
		<div class="text-xl font-light text-white">
			{{title}}
		</div>
		<div class="text-4xl font-bold text-white">
			{{metric}}
		</div>
	</div>
</template>

<script>
export default {
	props: ['title', 'metric'],
}
</script>