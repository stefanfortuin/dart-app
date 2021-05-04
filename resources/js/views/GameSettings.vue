<template>
  <div class="h-full w-full flex flex-col">
    <div>
      <input-text-field
        id="player_one"
        label="Speler 1"
        v-model="data.user_one"
      />
      <input-text-field
        id="player_two"
        label="Speler 2"
        v-model="data.user_two"
      />
      <div class="flex flex-col w-full mb-2">
        <input-number-field
          label="Start score"
          v-model="start_score"
          max="501"
          min="101"
        />
      </div>
      <div class="grid grid-cols-2 gap-2 w-full mb-2">
        <div class="flex flex-col">
          <input-number-field label="Sets" v-model="total_sets" min="1" />
        </div>
        <div class="flex flex-col">
          <input-number-field label="Legs/set" v-model="total_legs" min="1" />
        </div>
      </div>
    </div>

    <div class="flex flex-col w-full mt-auto">
      <button-action @click="handleNextStep()" :disabled="!canProceed"
        >Start spel</button-action
      >

      <button-action href="/stats">Statistieken</button-action>
    </div>
  </div>
</template>

<script>
import InputTextField from "../components/InputTextField.vue";
import InputNumberField from "../components/InputNumberField.vue";
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
      total_sets: 1,
      total_legs: 1,
    };
  },
  components: {
    InputTextField,
    InputNumberField,
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
    ...mapMutations([
      "setUsers",
      "goToNextStep",
      "setStartScore",
      "setTotalSets",
      "setTotalLegs",
    ]),

    handleNextStep() {
      if (!this.canProceed) return;

      this.setStartScore(this.start_score);
      this.setTotalSets(this.total_sets);
      this.setTotalLegs(this.total_legs);

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