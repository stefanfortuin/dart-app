<template>
	<div class="w-4/12 flex items-center">
		{{ stat.name }}
	</div>
	<div class="w-4/12 justify-end flex items-center">
		{{ users[0].stats[stat.key] }}
	</div>
	<div class="w-4/12 justify-end flex items-center">
		{{ users[1].stats[stat.key] }}
	</div>
</template>

<script>
export default {
	props: ['stat', 'users'],
}
</script>