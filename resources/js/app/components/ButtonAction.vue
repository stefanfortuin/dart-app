<template>
  <a
    :href="href"
    class="transition-colors font-semibold text-xl text-white p-3 rounded-lg shadow my-2 flex justify-center items-center select-none"
    :class="(disabled) ? 'bg-gray-200 opacity-75' : 'bg-blue-500'"
  >
    <slot />
  </a>
</template>

<script>
export default {
  props: ["href", "disabled"],
};
</script>