<template>
	<div class="text-left text-2xl">
		{{user.name}}
		<div
			v-if="user == currentLegOwner"
			class="inline-flex rounded-full h-2 w-2"
			:class="(isOnTurn) ? 'bg-white' : 'bg-blue-500'"
		></div>
	</div>
</template>

<script>
import { mapState } from 'vuex'
export default {
	props: ['user', 'isOnTurn'],
	computed: {
		...mapState({
			currentLegOwner: 'current_leg_owner',
		})
	}
}
</script>