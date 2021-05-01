<template>
  <div class="flex justify-between items-baseline">
    <div class="text-4xl xsm:text-5xl xs:text-6xl font-bold inline-flex">
      {{ user.score_to_throw_from.toFixed(0) }}
    </div>
    <div class="flex text-right opacity-80 text-sm leading-3 xs:leading-normal">
      <transition name="checkout-text" mode="out-in">
        <span v-if="user.checkout != ''" :key="user.checkout">
          {{ user.checkout }}
        </span>
        <span v-else>Kan nog niet uit</span>
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
};
</script>