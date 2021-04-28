<template>
	<div class="text-white flex flex-col text-lg h-full">
		<div class="flex px-3 text-sm mb-1">
			<div class="w-8/12"></div>
			<div class="w-2/12 text-center">Sets</div>
			<div class="w-2/12 text-center">Legs</div>
		</div>
		<div
			v-for="user in users"
			:key="user.id"
			class="flex bg-white text-blue-500 font-semibold rounded-lg px-3 py-2 mb-1"
		>
			<div class="w-8/12 flex items-center">
				<div class="overflow-hidden whitespace-nowrap overflow-ellipsis" style="max-width:80%;">{{user.name}}</div>
				<div
					v-show="user.owns_current_leg"
					class="ml-1 inline-flex rounded-full self-center h-2 w-2 bg-blue-500"
				></div>
			</div>
			<div class="w-2/12 text-center">{{user.sets_won}}</div>
			<div class="w-2/12 text-center">{{user.legs_won}}</div>
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