<template>
  <div
    class="relative flex mt-auto w-full p-1 bg-blue-200 bg-opacity-60 h-24 rounded-lg text-xl"
  >
	<transition name="checkout-text">
	<div v-if="score.length > 0" class="absolute w-full flex justify-center items-center" style="top: -2.7rem;">
		<div class="px-2 py-1 bg-blue-200 text-blue-600 font-bold text-3xl rounded-t h-full">
			{{formattedScore}}
		</div>
	</div>
	</transition>
    <div class="grid grid-rows-2 grid-cols-5 w-10/12 pr-1 gap-1">
      <div
        v-for="i in 10"
        :key="'num-' + i - 1"
        @click="addNumberToScore(i - 1)"
        class="flex justify-center items-center text-white bg-blue-500 hover:bg-blue-300 active:bg-blue-400 font-bold text-2xl rounded"
      >
        {{ i - 1 }}
      </div>
    </div>
    <div class="grid grid-cols-1 w-2/12 gap-1 text-gray-700">
      <div
        @click="backspace()"
        class="rounded flex justify-center items-center h-full bg-red-400 active:bg-red-500"
      >
        <svg class="icon">
			<use xlink:href="#backspace"></use>
		</svg>
      </div>
      <div
        @click="applyScore()"
        class="rounded flex justify-center items-center h-full bg-green-400 active:bg-green-500"
      >
        <svg class="icon">
			<use xlink:href="#check"></use>
		</svg>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  props: ["min", "max"],
  data() {
    return {
      score: [],
    };
  },
  computed: {
    formattedScore() {
      return this.score.join("");
    },
  },
  methods: {
    ...mapActions({
      notify: "toast/add",
    }),

    backspace() {
      this.score.splice(this.score.length - 1, 1);
      console.log(this.score);
    },
    addNumberToScore(number) {
      this.score.push(number);
      console.log(this.score);
    },

    applyScore() {
      const score = this.score.join("");
	  if(score < 0) return;
      if (this.scoreIsOutOfRange(this.min, this.max, score)) {
        this.notify({
          title: "Score moet tussen 0 en 180",
          type: "error",
        });
        return;
      }

      console.log(score);
      this.$emit("handleTurn", score);
      this.score = [];
    },

    scoreIsOutOfRange(min, max, score) {
      return score < min || score > max;
    },
  },
};
</script>