<template>
    <div class="text-4xl xsm:text-5xl xs:text-6xl font-bold inline-flex">
      {{ user.score_to_throw_from.toFixed(0) }}
    </div>
</template>

<script>
export default {
  props: ["user"],
};
</script>