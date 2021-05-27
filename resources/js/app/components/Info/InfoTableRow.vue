<template>
  <div class="w-full">
    <div class="flex justify-between items-center mb-1">
      <div class="font-bold">{{ users[0].stats[stat.key].toFixed(decimal) }}</div>
      <div class="font-semibold text-blue-500">{{ stat.name }}</div>
      <div class="font-bold">{{ users[1].stats[stat.key].toFixed(decimal) }}</div>
    </div>
    <div class="grid grid-cols-2 gap-3">
      <progress-bar
        :max="max"
        :value="users[0].stats[stat.key]"
        alignRight="true"
      />
      <progress-bar :max="max" :value="users[1].stats[stat.key]" />
    </div>
  </div>
</template>

<script>
import ProgressBar from "../ProgressBar.vue";

export default {
  props: ["stat", "users", "decimal", "max"],
  components: {
	  ProgressBar,
  },
};
</script>