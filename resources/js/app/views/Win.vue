<template>
  <div class="flex flex-col w-full h-full">
    <div
      class="text-5xl font-bold text-gray-700 mb-2 flex flex-col justify-center items-center"
    >
      <user-name class="text-blue-500" :user="current_user" />
      <span class="text-base">heeft gewonnen</span>
    </div>

    <div class="my-1 bg-blue-500 p-2 rounded-lg">
      <div class="mb-2 grid grid-cols-2 gap-x-3 text-blue-500">
        <!-- Set -->
        <div class="grid grid-cols-3">
          <div class="col-span-1 text-white font-semibold flex justify-center items-center">Set</div>
          <div
            class="col-span-2 flex justify-between bg-white rounded-lg p-1 flex-shrink-0"
          >
            <div @click="setSetIndex(current_set_index - 1)">
              <svg class="icon">
                <use href="/assets/sprite.svg#left"></use>
              </svg>
            </div>
            <div class="px-2">{{ current_set_index }}/{{ total_sets }}</div>
            <div @click="setSetIndex(current_set_index + 1)">
              <svg class="icon">
                <use href="/assets/sprite.svg#right"></use>
              </svg>
            </div>
          </div>
        </div>

        <!-- Leg -->
        <div class="grid grid-cols-3">
          <div class="col-span-1 text-white font-semibold flex justify-center items-center">Leg</div>
          <div
            class="col-span-2 flex justify-between bg-white rounded-lg p-1 flex-shrink-0"
          >
            <div @click="setLegIndex(current_leg_index - 1)">
              <svg class="icon">
                <use href="/assets/sprite.svg#left"></use>
              </svg>
            </div>
            <div class="px-2">{{ current_leg_index }}/{{ total_legs }}</div>
            <div @click="setLegIndex(current_leg_index + 1)">
              <svg class="icon">
                <use href="/assets/sprite.svg#right"></use>
              </svg>
            </div>
          </div>
        </div>
      </div>
      <info-table :leg="legData" />
    </div>

    <div class="mt-auto">
      <button-action @click="handleNewGame">Nieuw Spel</button-action>
    </div>
  </div>
</template>

<script>
import { mapState, mapMutations, mapActions, mapGetters } from "vuex";
import ButtonAction from "../components/ButtonAction.vue";
import GraphTurns from "../components/Graph/GraphTurns.vue";
import UserName from "../components/UserCard/UserName";
import InfoTable from "../components/Info/InfoTable.vue";

export default {
  data() {
    return {
      current_set_index: 1,
      current_leg_index: 1,
    };
  },
  components: {
    ButtonAction,
    GraphTurns,
    UserName,
    InfoTable,
  },
  created() {
    if (window.logged_in_user) this.uploadGame();
  },
  computed: {
    ...mapState({
      current_user: (state) => state.users.find((user) => user.is_on_turn),
      sets: (state) => state.sets,
      total_sets: (state) => state.total_sets,
      total_legs: (state) => state.total_legs,
    }),

    legData() {
      let set = this.sets[this.current_set_index - 1];
      let leg = set.legs[this.current_leg_index - 1];
      return leg;
    },
  },
  methods: {
    ...mapMutations(["resetCurrentStep"]),

    ...mapActions(["uploadGame"]),

    setLegIndex(id) {
      if (id > this.total_legs || id == 0) return;
      this.current_leg_index = id;
    },

    setSetIndex(id) {
      if (id > this.total_sets || id == 0) return;
      this.current_set_index = id;
    },

    handleNewGame() {
      this.resetCurrentStep();
    },
  },
};
</script>