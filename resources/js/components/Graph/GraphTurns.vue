<template>
  <div
    ref="graph"
    class="flex justify-center items-center h-full overflow-scroll relative"
  >
    <svg
      v-for="user in users"
      :key="user.id"
      xmlns="http://www.w3.org/2000/svg"
      height="100%"
      :width="`${graph_points * scale_x}px`"
      :viewBox="`-2 -4 ${graph_points * scale_x + 3} ${height + 4}`"
      preserveAspectRatio="none"
      class="absolute top-0 left-0"
      :class="user.is_on_turn ? 'stroke-white z-20' : 'stroke-lightblue z-10'"
    >
      <path
        :ref="`graph_line_${user.id}`"
        :id="`graph_line_${user.id}`"
        :d="getLinePath(user)"
        fill="none"
        stroke-width="3"
        :pathLength="user.turns.length"
        :stroke-linecap="user.turns.length >= 1 ? 'round' : ''"
        style="transition: stroke 0.3s ease-in-out"
      />
    </svg>
    <svg
      xmlns="http://www.w3.org/2000/svg"
      :width="`${graph_points * scale_x}px`"
      :viewBox="`-2 -4 ${graph_points * scale_x + 3} ${height + 4}`"
      height="100%"
      preserveAspectRatio="none"
      class="absolute z-0 top-0 left-0"
    >
      <line
        v-for="(point, i) in graph_points + 1"
        :key="point"
        :x1="i * scale_x"
        :y1="0"
        :x2="i * scale_x"
        :y2="height"
        stroke-width="2.5px"
        class="stroke-graphaxis opacity-10"
      ></line>
    </svg>
    <svg
      xmlns="http://www.w3.org/2000/svg"
      :width="`${graph_points * scale_x}px`"
      :viewBox="`-2 -4 ${graph_points * scale_x + 3} ${height + 4}`"
      height="100%"
      preserveAspectRatio="none"
      class="absolute z-50 top-0 left-0"
    >
      <rect
        v-for="(point, i) in graph_points"
        :key="point"
        :x="i * scale_x"
        :y="0"
        :width="`${1 * scale_x}px`"
        class="fill-current"
        :class="
          currentGraphIndex == i ? 'text-blue-100 opacity-40' : 'opacity-0'
        "
        @click="setCurrentGraphIndex(i)"
        height="100%"
      />
      <transition name="tab-fade" mode="out-in">
        <g
          v-if="graphTurnData != null"
          :key="`graph_index_${currentGraphIndex}`"
          class="stroke-white"
        >
          <circle
            :cx="graphTurnData.point[0]"
            :cy="graphTurnData.point[1]"
            class="fill-current text-white stroke-darkblue"
            stroke-width="1"
            r="0.16rem"
          ></circle>
        </g>
      </transition>
    </svg>
    <transition name="tab-fade" mode="out-in">
      <div
        v-if="graphTurnData != null"
		:key="`graph_point_${graphTurnData.point[0]}`"
        class="absolute z-50 text-center"
        :style="{
          left: `${graphTurnData.point[0] - scale_x}px`,
          top: `${(graphTurnData.point[1] < ((this.height / 3) * 2)) ? graphTurnData.point[1] : graphTurnData.point[1] - 25}px`,
		  width: `${scale_x}px`
        }"
      >
        <span class="bg-blue-100 px-2 rounded text-sm font-semibold">{{ graphTurnData.turn.new_score_to_throw_from }}</span>
      </div>
    </transition>
  </div>
</template>

<script>
import { mapState } from "vuex";
import { line, curveMonotoneX } from "d3-shape";
import anime from "animejs";

export default {
  name: "graph-turns",
  data() {
    return {
      width: null,
      height: null,
      scale_y: null,
      scale_x: null,
      graph_points: 4, //default
      paths: [],
      currentGraphIndex: undefined,
      graphTurnData: [],
      last_scroll_position: 0,
    };
  },
  mounted() {
    this.updateScale();
    window.addEventListener("resize", () => {
      this.updateScale();
    });
  },
  activated() {
    if (this.$refs.graph == undefined) return;

    let scroll_element = this.$refs.graph;
    scroll_element.scrollLeft = this.last_scroll_position;
  },
  computed: {
    ...mapState({
      users: (state) => state.users,
      startScore: (state) => state.start_score,
      user_on_turn: (state) => state.users.find((u) => u.is_on_turn),
    }),

    graphTurnData() {
      if (this.currentGraphIndex == undefined) return null;
      let graph_data = {
        turn: this.user_on_turn.turns[this.currentGraphIndex],
        point: this.getPointsFromTurns(this.user_on_turn.turns)[
          this.currentGraphIndex + 1
        ],
      };

      console.log(graph_data);

      return graph_data;
    },
  },
  methods: {
    updateScale() {
      if (this.$refs.graph == undefined) return;

      this.incrementGraphPoints();

      this.width = this.$refs.graph.clientWidth;
      this.height = this.$refs.graph.clientHeight;
      this.scale_x = this.width / 5;
      this.scale_y = this.height / this.startScore;
    },

    incrementGraphPoints() {
      if (this.user_on_turn.turns.length == 0) {
        this.graph_points = 5;
      }

      if (this.user_on_turn.turns.length >= this.graph_points + 1) {
        this.graph_points += 1;
        this.last_scroll_position = (this.graph_points - 5) * this.scale_x;
        this.scrollToLeft();
      }
    },

    scrollToLeft() {
      if (this.$refs.graph == undefined) return;
      let scroll_element = this.$refs.graph;
      let value_to_scroll_to = this.last_scroll_position + 1 * this.scale_x;

      anime({
        targets: scroll_element,
        scrollLeft: value_to_scroll_to,
        duration: 500,
        easing: "easeInOutQuad",
      });
    },

    setCurrentGraphIndex(index) {
      if (this.currentGraphIndex == index) {
        this.currentGraphIndex = undefined;
        return;
      }

      this.currentGraphIndex = index;
    },

    getPointsFromTurns(turns) {
      this.incrementGraphPoints();

      let points = turns.map((turn, i) => [
        (i + 1) * this.scale_x,
        this.height - turn.new_score_to_throw_from * this.scale_y,
      ]);

      //push the startpoint at the beginning of the array
      points.unshift([0, this.height - this.startScore * this.scale_y]);
      return points;
    },

    getLinePath(user) {
      let element = this.$refs[`graph_line_${user.id}`];

      let points = this.getPointsFromTurns(user.turns);

      this.animatePath(element, user);

      let lineGenerator = line().curve(curveMonotoneX);
      return lineGenerator(points);
    },

    animatePath(path_element, user) {
      if (!path_element) return;
      if (!user.is_on_turn) return;

      if (path_element.style.strokeDasharray > user.turns.length)
        path_element.style.strokeDasharray = 0;

      //animatie the svg path only when it has added a new point
      if (path_element.style.strokeDasharray < user.turns.length) {
        path_element.style.strokeDasharray = user.turns.length;
        path_element.style.strokeDashoffset = 1;

        anime({
          targets: path_element,
          strokeDashoffset: 0,
          duration: 250,
          easing: "easeOutQuad",
        });
      }
    },
  },
};
</script>