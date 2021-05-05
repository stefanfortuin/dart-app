<template>
	<div class="text-white flex flex-col h-full text-lg rounded-lg overflow-scroll relative first:rounded-t-lg">
		<div class="w-full z-0 py-0.5 flex text-sm xsm:text-base bg-blue-100 bg-opacity-50">
			<div class="w-4/12"></div>
			<div
				v-for="user in users"
				:key="user.uuid"
				class="w-4/12 flex px-2 items-baseline justify-end"
			>
				<div
					class="overflow-hidden whitespace-nowrap overflow-ellipsis"
					style="max-width:85%;"
				>
					{{ user.name }}
				</div>
			</div>
		</div>
		<div
			v-for="stat in stats"
			:key="`stats_${stat.name}`"
			class="last:rounded-b-lg border-b-2 border-gray-200 border-opacity-50 flex bg-white text-blue-500 font-semibold px-2 py-1 text-base xsm:text-lg"
		>
			<info-table-row :stat="stat" :users="users" :decimal="stat.decimal"/>
	</div>
	</div>
</template>

<script>
import { mapState } from "vuex";
import InfoTableRow from "./InfoTableRow.vue";

export default {
	components: { InfoTableRow },
	data() {
		return {
			stats: [
				{
					name: "Sets",
					key: "sets_won",
					decimal: 0
				},
				{
					name: "Legs",
					key: "legs_won",
					decimal: 0
				},
				{
					name: "Gem.",
					key: "average_per_turn",
					decimal: 2,
				},
				{
					name: "Hoogst",
					key: "highest",
					decimal: 0
				},
			],
		};
	},
	computed: {
		...mapState({
			users: (state) => state.users,
		}),
	},
};
</script>