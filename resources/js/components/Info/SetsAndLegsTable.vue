<template>
  <div class="text-white flex flex-col text-lg h-full overflow-scroll relative">
    <div class="w-full h-full z-0 flex gap-x-1 px-3 text-sm">
      <div class="w-4/12"></div>
      <div
        v-for="user in users"
        :key="user.id"
        class="w-4/12 flex justify-center bg-blue-100 bg-opacity-40 rounded-t"
      >
        <div class="overflow-hidden whitespace-nowrap overflow-ellipsis">
          {{ user.name }}
        </div>
        <div
          v-show="user.owns_current_leg"
          class="ml-1 inline-flex rounded-full self-center h-2 w-2 bg-white"
        ></div>
      </div>
    </div>
      <div
        v-for="stat in stats"
        :key="`stats_${stat.name}`"
        class="flex bg-white text-blue-500 font-semibold rounded-lg px-2 py-1 mb-1"
      >
        <div class="w-4/12 flex items-center text-base">
          {{ stat.name }}
        </div>
        <div class="w-4/12 text-center">{{ users[0].stats[stat.key] }}</div>
        <div class="w-4/12 text-center">{{ users[1].stats[stat.key] }}</div>
      </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  data() {
    return {
      stats: [
        {
          name: "Sets",
          key: "sets_won",
        },
        {
          name: "Legs",
          key: "legs_won",
        },
        {
          name: "Gem.",
          key: "average_per_turn",
        },
        {
          name: "Hoogst",
          key: "highest",
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