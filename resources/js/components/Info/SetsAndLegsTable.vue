<template>
	<div class="flex justify-between items-end">
		<div class="table px-2 pb-2 pt-1 w-40 text-white">
			<div class="table-row-group">
				<div class="table-row">
					<div class="table-cell"></div>
					<div class="table-cell text-right">Sets</div>
					<div class="table-cell text-right">Legs</div>
				</div>
				<div
					v-for="user in users"
					:key="user.id"
					class="table-row"
				>
					<div class="table-cell">
						{{user.name}}
						<div
							v-show="user.owns_current_leg"
							class="inline-flex rounded-full h-2 w-2 bg-white"
						></div>
					</div>
					<div class="table-cell text-right">{{user.sets_won}}</div>
					<div class="table-cell text-right">{{user.legs_won}}</div>
				</div>
			</div>
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