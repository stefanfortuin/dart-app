<template>
	<div class="flex justify-between items-end">
		<div class="table p-2 w-40 text-white">
			<div class="table-row-group">
				<div class="table-row">
					<div class="table-cell"></div>
					<div class="table-cell text-center">Sets</div>
					<div class="table-cell text-center">Legs</div>
				</div>
				<div
					v-for="user in users"
					:key="user.id"
					class="table-row"
				>
					<div class="table-cell">{{user.name}}</div>
					<div class="table-cell text-center">{{user.sets_won}}</div>
					<div class="table-cell text-center">{{user.legs_won}}</div>
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
			users: state => state.users
		})
	}
}
</script>