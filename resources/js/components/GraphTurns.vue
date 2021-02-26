<template>
  <div
    class="bg-gray-200 bg-opacity-75 my-2 rounded-lg shadow flex-grow flex justify-center items-center max-h-60 relative"
  >
	<div v-if="getTurns.length == 0" class="font-semibold text-xl">Begin met gooien!</div>
    <svg
      v-for="user in getUsers"
      :key="user.id"
      xmlns="http://www.w3.org/2000/svg"
      ref="graph"
      width="95%"
      height="90%"
      class="absolute"
      :class="
        user == getUserThatDoesTurn ? 'stroke-blue z-10' : 'stroke-gray z-0'
      "
    >
      <path
        :d="getPointsFromTurns(user.turns)"
        style="transition: stroke 0.3s ease-in-out; fill: none; stroke-width: 3"
      />
    </svg>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import {line,curveCardinal} from 'd3-shape';

export default {
  data() {
    return {
      width: null,
      height: null,
      scale_y: null,
      scale_x: null,
      graph_points: 5, //default
    };
  },
  mounted() {
    this.updateScale();
    window.addEventListener("resize", () => {
      this.updateScale();
    });
  },
  computed: {
    ...mapGetters([
      "getTurns",
      "getUsers",
      "getStartScore",
      "getUserThatDoesTurn",
    ]),
  },
  methods: {
    updateScale() {
      if (this.$refs.graph == undefined) return;
      if (this.getTurns.length / 2 > this.graph_points) this.graph_points += 1;

      this.width = this.$refs.graph.clientWidth;
      this.height = this.$refs.graph.clientHeight;
      this.scale_x = this.width / this.graph_points;
      this.scale_y = this.height / this.getStartScore;
    },

    getPointsFromTurns(turns) {
      this.updateScale();
      let points = turns.map((turn, i) => [
        (i == 0) ? 0 : (i + 1) * this.scale_x,
        this.height - turn.new_score_to_throw_from * this.scale_y,
      ]);

      let lineGenerator = line().curve(curveCardinal);
      let pathData = lineGenerator(points);

      return pathData;
    },
  },
};
</script>