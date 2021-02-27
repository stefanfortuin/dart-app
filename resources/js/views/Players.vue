<template>
  <div class="h-full w-full flex flex-col justify-between">
    <div>
      <PlayerInput id="player_one" label="Speler 1" v-model="data.user_one" />
      <PlayerInput id="player_two" label="Speler 2" v-model="data.user_two" />
      <div class="flex flex-col w-full mb-3">
        <label
          for="set_start_score"
          class="mb-2 text-xl font-semibold text-blue-400"
          >Start score</label
        >
        <input
          type="number"
          min="201"
          max="501"
          name="set_start_score"
          id="set_start_score"
          class="border-2 border-blue-200 text-blue-500 font-bold text-3xl py-3 px-4 rounded-lg"
          v-model="start_score"
        />
      </div>
    </div>

    <div class="flex flex-col w-full">
      <button-action @click="handleNextStep()" :disabled="!canProceed"
        >Volgende</button-action
      >

      <button-action href="/stats">Statistieken</button-action>
    </div>
  </div>
</template>

<script>
import PlayerInput from "../components/PlayerInput";
import { mapMutations } from "vuex";
import ButtonAction from "../components/ButtonAction.vue";

export default {
  data() {
    return {
      data: {
        user_one: "",
        user_two: "",
      },
      start_score: 501,
      all_users: null,
    };
  },
  components: {
    PlayerInput,
    ButtonAction,
  },
  computed: {
    canProceed() {
      return this.fieldsAreNotEmpty && this.usersAreNotTheSame;
    },

    usersAreNotTheSame() {
      return (
        this.data.user_one.toLowerCase() != this.data.user_two.toLowerCase()
      );
    },

    fieldsAreNotEmpty() {
      return (
        this.data.user_one != "" &&
        this.data.user_two != "" &&
        this.start_score != ""
      );
    },
  },
  methods: {
    ...mapMutations(["setUsers", "goToNextStep", "setStartScore"]),

    handleNextStep() {
      if (!this.canProceed) return;

      this.setStartScore(this.start_score);

      fetch(`/api/users`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(this.data),
      })
        .then((response) => response.json())
        .then((response) => {
          this.setUsers(response);
          this.goToNextStep();
        });
    },
  },
};
</script>