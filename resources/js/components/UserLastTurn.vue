<template>
	<div class="text-xl font-thin">
		<div v-if="turn">
			Heeft zonet <span class="font-semibold">{{turn.thrown_score}}</span> gegooid.
		</div>
		<div v-else>
			Moet nog gooien.
		</div>
	</div>
</template>

<script>
export default {
	props: ['turn'],
}
</script>