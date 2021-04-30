<template>
  <div class="text-white flex flex-col h-full text-lg rounded-lg overflow-scroll relative first:rounded-t-lg">
    <div
      class="w-full z-0 py-0.5 flex text-sm xsm:text-base bg-blue-100 bg-opacity-50"
    >
      <div class="w-4/12"></div>
      <div
        v-for="user in users"
        :key="user.id"
        class="w-4/12 flex px-1 items-baseline"
      >
        <div class="overflow-hidden whitespace-nowrap overflow-ellipsis"
        style="max-width:85%;">
          {{ user.name }}
        </div>
        <div
          v-if="user.owns_current_leg"
          class="rounded-full ml-1 h-1.5 w-1.5 bg-white"
        ></div>
      </div>
    </div>
      <div
        v-for="stat in stats"
        :key="`stats_${stat.name}`"
        class="last:rounded-b-lg border-b-2 border-gray-200 border-opacity-50 flex bg-white text-blue-500 font-semibold px-2 py-1 text-base xsm:text-lg"
      >
        <div class="w-4/12 flex items-center">
          {{ stat.name }}
        </div>
        <div class="w-4/12 justify-end flex items-center">
          {{ users[0].stats[stat.key] }}
        </div>
        <div class="w-4/12 justify-end flex items-center">
          {{ users[1].stats[stat.key] }}
        </div>
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