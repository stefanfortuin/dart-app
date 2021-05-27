<template>
  <div
    class="text-white px-2 bg-white flex flex-col h-full text-lg rounded-lg overflow-scroll relative first:rounded-t-lg"
  >
    <div
      class="flex justify-between items-center font-bold w-full text-blue-500 bg-white text-xl"
    >
      <user-name class="w-5/12 text-blue-500" :user="users[0]" />
      <div class="w-2/12 flex text-4xl justify-center items-center">
        <div class="font-bold">{{ users[0].stats["sets_won"] }}</div>
        <div class="mx-1 text-xl">:</div>
        <div class="font-bold">{{ users[1].stats["sets_won"] }}</div>
      </div>
      <user-name class="w-5/12 text-right text-blue-500" :user="users[1]" />
    </div>
    <div
      v-for="stat in stats"
      :key="`stats_${stat.name}`"
      class="last:rounded-b-lg border-b-2 border-gray-200 border-opacity-50 flex bg-white text-blue-500 font-semibold py-1 text-base xsm:text-lg"
    >
      <info-table-row
        :stat="stat"
        :max="stat.max"
        :users="users"
        :decimal="stat.decimal"
      />
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
import InfoTableRow from "./InfoTableRow.vue";
import UserName from "../UserCard/UserName.vue";

export default {
  components: { InfoTableRow, UserName },
  computed: {
    ...mapState({
      users: (state) => state.users,
      total_legs: (state) => state.total_legs,
    }),

	stats(){
		return [
        {
          name: "Legs",
          key: "legs_won",
          decimal: 0,
          max: this.total_legs,
        },
        {
          name: "Gem.",
          key: "average_per_turn",
          decimal: 2,
          max: 180,
        },
        {
          name: "Hoogst",
          key: "highest",
          decimal: 0,
          max: 180,
        },
      ]
	}
  },
};
</script>