<template>
  <a
    :href="href"
    class="font-bold text-2xl text-white p-4 rounded-lg shadow-md my-2 flex justify-center items-center bg-gradient-to-br select-none"
    :class="(disabled) ? 'bg-gray-200' : 'from-blue-600 to-blue-500'"
  >
    <slot />
  </a>
</template>

<script>
export default {
  props: ["href", "disabled"],
};
</script>