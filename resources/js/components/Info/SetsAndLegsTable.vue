<template>
	<div class="w-full h-full text-white flex flex-col text-lg">
		<div class="flex px-3 pb-1">
			<div class="w-7/12"></div>
			<div class="w-3/12">Sets</div>
			<div class="w-2/12">Legs</div>
		</div>
		<div
			v-for="user in users"
			:key="user.id"
			class="flex bg-white text-blue-500 font-semibold rounded-lg px-3 py-1 mb-1"
		>
			<div class="w-7/12">
				{{user.name}}
				<div
					v-show="user.owns_current_leg"
					class="inline-flex rounded-full h-2 w-2 bg-blue-500"
				></div>
			</div>
			<div class="w-3/12">{{user.sets_won}}</div>
			<div class="w-2/12">{{user.legs_won}}</div>
		</div>
	</div>
</template>

<script>
import { mapState } from 'vuex'
export default {
	computed: {
		...mapState({
			users: state => state.users,
		})
	}
}
</script>