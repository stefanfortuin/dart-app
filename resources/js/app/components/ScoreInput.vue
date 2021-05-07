<template>
  <div
    class="relative grid grid-rows-4 grid-cols-3 w-full h-full min-h-32 max-h-52 gap-1"
  >
    <transition name="custom-score">
      <div
        v-if="score.length > 0"
        class="absolute w-full flex justify-start items-center z-50 px-2"
        style="top: -3.4rem"
      >
        <div
          class="px-2 py-1 bg-blue-100 text-blue-800 font-semibold text-2xl rounded h-full"
        >
          {{ formattedScore }}
        </div>
      </div>
    </transition>
    <div
      v-for="i in 9"
      :key="'num-' + i"
      @click="addNumberToScore(i)"
      class="flex justify-center items-center max-h-12 text-blue-800 bg-blue-100 active:bg-blue-500 active:text-white font-semibold text-2xl rounded z-20"
    >
      {{ i }}
    </div>
    <div class="grid grid-cols-2 gap-1">
      <div
        @click="backspace()"
        class="rounded flex justify-center items-center max-h-12 bg-blue-100 active:bg-blue-500 active:text-white text-blue-900"
      >
        <svg class="icon">
          <use href="/assets/sprite.svg#backspace"></use>
        </svg>
      </div>
      <div
        @click="startspeech()"
        class="rounded flex justify-center items-center max-h-12 active:bg-blue-500 active:text-white "
        :class="isListening ? 'bg-blue-500' : 'bg-blue-100'"
      >
        <svg class="icon fill-current" :class="isListening ? 'text-white' : 'text-blue-900'">
          <use href="/assets/sprite.svg#microphone"></use>
        </svg>
      </div>
    </div>
    <div
      @click="addNumberToScore(0)"
      class="flex justify-center items-center max-h-12 text-blue-800 bg-blue-100 active:bg-blue-400 font-semibold text-2xl rounded"
    >
      0
    </div>
    <div
      @click="applyScore()"
      class="rounded flex justify-center items-center max-h-12 bg-blue-500 active:bg-blue-600 text-white"
    >
      <svg class="icon">
        <use href="/assets/sprite.svg#arrow-right"></use>
      </svg>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
export default {
  props: ["min", "max"],
  data() {
    return {
      score: [],
      unthrowableScores: [
        "179",
        "178",
        "176",
        "175",
        "173",
        "172",
        "169",
        "166",
        "163",
      ],
      unthrowableEndScores: ["169", "168", "166", "165", "163", "162", "159"],
      recognition: undefined,
      recognitionList: undefined,
      isListening: false,

    };
  },
  created() {
    let SpeechRecognition =
      window.SpeechRecognition || window.webkitSpeechRecognition;
    let SpeechGrammarList =
      window.SpeechGrammarList || window.webkitSpeechGrammarList;
    let SpeechRecognitionEvent =
      window.SpeechRecognitionEvent || window.webkitSpeechRecognitionEvent;

    this.recognition = new SpeechRecognition();
    this.recognitionList = new SpeechGrammarList();

    const numbers = [...Array(181)].map((v, i) => `${i}`);
    const grammar =
      "#JSGF V1.0; grammar numbers; public <number> = " +
      numbers.join(" | ") +
      " ;";

    this.recognitionList.addFromString(grammar, 1);

    this.recognition.grammars = this.recognitionList;
    this.recognition.continuous = false;
    this.recognition.lang = "nl-NL";
    this.recognition.interimResults = false;
    this.recognition.maxAlternatives = 1;

    this.recognition.onresult = (event) => {
      let number = event.results[0][0].transcript;
      console.log(number)
      if (numbers.includes(number)) {
        let numbers = number.split("");
        console.log(numbers);

        numbers.forEach(n => {
          setTimeout(() => {
            this.addNumberToScore(n);
          }, 200);
        })

        setTimeout(() => {
          this.applyScore();
        }, 650);

      } else {
        this.notify({
          title: `We konden geen score herkennen.`,
          type: "error",
        });
      }
    };

    this.recognition.onspeechend = () => {
      this.recognition.stop();
      this.isListening = false;
    };

    this.recognition.onnomatch = (event) => {
      this.notify({
          title: `We konden geen score herkennen.`,
          type: "error",
        });
    }
  },
  computed: {
    ...mapState({
      user_on_turn: (state) => state.users.find((u) => u.is_on_turn),
    }),

    formattedScore() {
      return this.score.join("");
    },
  },
  methods: {
    ...mapActions({
      notify: "toast/add",
    }),

    startspeech() {
      if(this.isListening){
        this.isListening = !this.isListening;
        this.recognition.stop();
        return;
      }
      this.recognition.start();
      this.isListening = true;
    },

    backspace() {
      this.score.splice(this.score.length - 1, 1);
    },
    addNumberToScore(number) {
      if (this.score.length == 3) return;
      this.score.push(number);
    },

    applyScore() {
      if (this.score.length == 0) return;

      const score = this.score.join("");

      if (this.scoreIsOutOfRange(this.min, this.max, score)) {
        this.notify({
          title: `Score moet tussen 0 en ${this.max}`,
          type: "error",
        });
        return;
      }

      if (this.scoreIsUnthrowableCheckout(score)) {
        this.notify({
          title: `${score} is niet uit te gooien.`,
          type: "error",
        });
        return;
      }

      if (this.scoreIsUnthrowable(score)) {
        this.notify({
          title: `${score} is niet te gooien.`,
          type: "error",
        });
        return;
      }

      this.$emit("handleTurn", score);
      this.score = [];
    },

    scoreIsOutOfRange(min, max, score) {
      return score < min || score > max;
    },

    scoreIsUnthrowable(score) {
      return this.unthrowableScores.includes(score);
    },

    scoreIsUnthrowableCheckout(score) {
      return (
        (score > 170 &&
          this.user_on_turn.last_turn &&
          this.user_on_turn.last_turn.new_score_to_throw_from == score) ||
        this.unthrowableEndScores.includes(score)
      );
    },
  },
};
</script>