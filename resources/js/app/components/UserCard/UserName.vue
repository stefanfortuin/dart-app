<template>
      <div
        class="overflow-hidden whitespace-nowrap overflow-ellipsis"
        style="max-width: 90%"
      >
        {{ user.name }}
      </div>
</template>

<script>
export default {
  props: ["user"],
};
</script>