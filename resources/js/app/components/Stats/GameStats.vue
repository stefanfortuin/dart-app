<template>
	<div class="flex justify-between items-center font-bold text-blue-500 text-xl">
		<user-name :user="users[0]" />
		<div class="flex text-4xl items-center">
			<div class="font-bold">{{ users[0].stats["sets_won"] }}</div>
			<div class="mx-1 text-xl">:</div>
			<div class="font-bold">{{ users[1].stats["sets_won"] }}</div>
		</div>
		<user-name :user="users[1]" />
	</div>

	<div class="my-1">
		<div class="flex justify-between items-center mb-1">
			<div class="font-bold">{{ users[0].stats["legs_won"] }}</div>
			<div class="font-semibold text-blue-500">Legs</div>
			<div class="font-bold">{{ users[1].stats["legs_won"] }}</div>
		</div>

		<div class="grid grid-cols-2 gap-3">
			<progress-bar
				:max="total_legs"
				:value="users[0].stats['legs_won']"
				alignRight="true"
			/>
			<progress-bar
				:max="total_legs"
				:value="users[1].stats['legs_won']"
			/>
		</div>
	</div>

	<div class="my-1">
		<div class="flex justify-between items-center mb-1">
			<div class="font-bold">
				{{ users[0].stats["average_per_turn"].toFixed(2) }}
			</div>
			<div class="font-semibold text-blue-500">Gem.</div>
			<div class="font-bold">
				{{ users[1].stats["average_per_turn"].toFixed(2) }}
			</div>
		</div>
		<div class="grid grid-cols-2 gap-3">
			<progress-bar
				:max="180"
				:value="users[0].stats['average_per_turn']"
				alignRight="true"
			/>
			<progress-bar
				:max="180"
				:value="users[1].stats['average_per_turn']"
			/>
		</div>
	</div>

	<div class="my-1">
		<div class="flex justify-between items-center mb-1">
			<div class="font-bold">{{ users[0].stats["highest"] }}</div>
			<div class="font-semibold text-blue-500">Hoogste</div>
			<div class="font-bold">{{ users[1].stats["highest"] }}</div>
		</div>
		<div class="grid grid-cols-2 gap-3">
			<progress-bar
				:max="180"
				:value="users[0].stats['highest']"
				alignRight="true"
			/>
			<progress-bar
				:max="180"
				:value="users[1].stats['highest']"
			/>
		</div>
	</div>
</template>

<script>
import { mapState } from "vuex";
import ProgressBar from "../ProgressBar.vue";
import UserName from "../UserCard/UserName.vue";
export default {
	components: { ProgressBar, UserName },
	computed: {
		...mapState({
			users: (state) => state.users,
			total_sets: (state) => state.total_sets,
			total_legs: (state) => state.total_legs,
		}),
	},
};
</script>