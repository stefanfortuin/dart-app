<template>
  <div class="flex justify-between items-baseline mb-1">
    <div class="text-4xl xsm:text-5xl xs:text-6xl font-bold inline-flex">
      {{ animatedScore }}
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
import anime from "animejs";
export default {
  props: ["user"],
  data() {
    return {
      tweenedScore: null,
    };
  },
  created() {
    this.tweenedScore = this.user.start_score;
  },
  computed: {
    animatedScore() {
      return this.tweenedScore.toFixed(0);
    },
  },
  watch: {
    "user.score_to_throw_from": function (newValue) {
      anime({
        targets: this.$data,
        tweenedScore: newValue,
        duration: 700,
        easing: "easeInOutQuint",
      });
    },
  },
};
</script>