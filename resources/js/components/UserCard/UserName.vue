<template>
  <div class="flex justify-between items-center mb-1">
    <div class="w-10/12 flex items-baseline">
      <div
        class="text-xl overflow-hidden whitespace-nowrap overflow-ellipsis"
        style="max-width: 90%"
      >
        {{ user.name }}
      </div>

      <div
        v-if="user.owns_current_leg"
        class="rounded-full ml-2 h-2 w-2"
        :class="user.is_on_turn ? 'bg-white' : 'bg-blue-500'"
      ></div>
    </div>
    <!-- <div :class="user.is_on_turn ? 'text-white' : 'text-blue-500'">
      <svg class="icon">
        <use xlink:href="assets/sprite.svg#dots-vertical"></use>
      </svg>
    </div> -->
  </div>
</template>

<script>
export default {
  props: ["user"],
};
</script>