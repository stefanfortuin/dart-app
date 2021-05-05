<template>
  <div class="h-full w-full flex flex-col">
    <div>
      <input-text-field
        id="player_one"
        label="Speler 1"
        v-model="users.user_one.name"
        :readonly="(users.user_one.inserted) ? true : false" 
      />
      <input-text-field
        id="player_two"
        label="Speler 2"
        v-model="users.user_two.name"
      />
      <input-number-field
        label="Start score"
        v-model="start_score"
        max="501"
        min="101"
      />
      <div class="grid grid-cols-2 gap-2 w-full">
        <input-number-field label="Sets" v-model="total_sets" min="1" />
        <input-number-field label="Legs/set" v-model="total_legs" min="1" />
      </div>
    </div>

    <div class="flex flex-col w-full mt-auto">
      <button-action @click="handleNextStep()" :disabled="!canProceed"
        >Start spel</button-action
      >
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
      users: {
        user_one: { id: null, name: "" },
        user_two: { id: null, name: "" },
      },
      start_score: 501,
      total_sets: 1,
      total_legs: 1,
    };
  },
  created() {
    if(window.logged_in_user){
      this.users.user_one = window.logged_in_user;
      this.users.user_one.inserted = true
    }
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
        this.users.user_one.name.toLowerCase() !=
        this.users.user_two.name.toLowerCase()
      );
    },

    fieldsAreNotEmpty() {
      return (
        this.users.user_one.name != "" &&
        this.users.user_two.name != "" &&
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

      this.setUsers(this.users);
      this.goToNextStep();
    },
  },
};
</script>