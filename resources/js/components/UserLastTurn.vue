<template>
	<div class="text-xl font-thin">
		Heeft zonet <span class="font-semibold">{{turn.thrown_score}}</span> gegooid.
	</div>
</template>

<script>
export default {
	props: ['turn'],
}
</script>