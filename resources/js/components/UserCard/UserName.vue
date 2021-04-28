<template>
  <div class="flex justify-between items-center mb-1">
    <div
      class="text-xl overflow-hidden whitespace-nowrap overflow-ellipsis"
      style="max-width: 95%"
    >
      {{ user.name }}
    </div>
    <div
      v-if="user.owns_current_leg"
      class="rounded-full h-2 w-2"
      :class="user.is_on_turn ? 'bg-white' : 'bg-blue-500'"
    ></div>
  </div>
</template>

<script>
export default {
  props: ["user"],
};
</script>