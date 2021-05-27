<template>
  <div class="w-full">
    <div class="flex justify-between items-center mb-1">
      <div class="font-bold">{{ leg.stats[users[0].uuid][stat.key].toFixed(stat.decimal) }}</div>
      <div class="font-semibold text-blue-500">{{ stat.name }}</div>
      <div class="font-bold">{{ leg.stats[users[1].uuid][stat.key].toFixed(stat.decimal) }}</div>
    </div>
    <div class="grid grid-cols-2 gap-3">
      <progress-bar
        :max="stat.max"
        :value="leg.stats[users[0].uuid][stat.key]"
        alignRight="true"
      />
      <progress-bar :max="stat.max" :value="leg.stats[users[1].uuid][stat.key]" />
    </div>
  </div>
</template>

<script>
import ProgressBar from "../ProgressBar.vue";

export default {
  props: ["stat", "users", "leg"],
  components: {
	  ProgressBar,
  },
};
</script>