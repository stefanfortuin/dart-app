<template>
  <div class="flex justify-between mb-1">
    <div class="text-4xl xsm:text-5xl xs:text-6xl font-bold inline-flex">
      {{ animatedScore }}
    </div>
    <div class="flex flex-col justify-evenly xs:justify-end text-right opacity-80 text-sm leading-3 xs:leading-normal">
      <user-last-turn :turn="user.last_turn" />
      <transition name="checkout-text" mode="out-in">
        <div v-if="user.checkout != ''" :key="user.checkout">
          {{ user.checkout }}
        </div>
        <div v-else>Kan nog niet uit</div>
      </transition>
    </div>
  </div>
</template>

<script>
import anime from "animejs";
import UserLastTurn from "./UserLastTurn";
export default {
  props: ["user"],
  components: {
    UserLastTurn,
  },
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