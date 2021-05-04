<template>
  <div class="relative h-full w-full">
    <div
      ref="graph"
      class="flex justify-center items-center h-full w-full overflow-scroll absolute"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        height="100%"
        :width="`${graph_points * scale_x + 2}px`"
        :viewBox="`-2 -4 ${graph_points * scale_x + 2} ${height + 4}`"
        preserveAspectRatio="none"
        class="absolute top-0 left-0"
      >
        <!-- the animated user paths -->
        <g
          v-for="user in users"
          :key="user.id"
          :id="`graph_element_${user.id}`"
          :class="user.is_on_turn ? 'stroke-white' : 'stroke-lightblue'"
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
        </g>
        <use :href="`#graph_element_${user_on_turn.id}`" />

        <!-- y-axis lines -->
        <g>
          <line
            v-for="(point, i) in graph_points"
            :key="point"
            :x1="i * scale_x"
            :y1="0"
            :x2="i * scale_x"
            :y2="height"
            stroke-width="2.5px"
            class="stroke-graphaxis opacity-10"
          ></line>
        </g>

        <!-- clickable bars with circle showing point -->
        <g>
          <rect
            v-for="(point, i) in graph_points"
            :key="`rect_${point}`"
            :x="i * scale_x"
            :y="0"
            rx="0.25rem"
            :width="`${1 * scale_x}px`"
            height="100%"
            class="fill-current z-30 transition-opacity duration-150 opacity-0"
            @click="setCurrentGraphIndex(i)"
          />
        </g>
      </svg>

      <!-- showing the score from the selected index turn -->
      <transition name="tab-fade">
        <div
          v-if="graphTurnData != null"
          class="absolute transition-all duration-300 ease-in-out z-40 h-full bg-blue-100 bg-opacity-40 text-white rounded text-base font-bold pointer-events-none"
          :style="{
            left: '2px',
            transform: `translateX(${currentGraphIndex * scale_x}px)`,
            width: `${scale_x}px`,
          }"
        >
          <div
            class="flex flex-col items-center h-full"
            :class="
              graphTurnData.last_point[1] < this.height / 2
                ? 'justify-end'
                : 'justify-start'
            "
          >
            <div>
              {{ graphTurnData.turn.old_score_to_throw_from }}
            </div>
            <svg class="icon-xs">
              <use href="assets/sprite.svg#chevron-right"></use>
            </svg>
            <div>
              {{ graphTurnData.turn.new_score_to_throw_from }}
            </div>
          </div>
        </div>
      </transition>
    </div>
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
      currentGraphIndex: undefined,
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
  deactivated() {
    this.currentGraphIndex = undefined;
  },
  computed: {
    ...mapState({
      users: (state) => state.users,
      startScore: (state) => state.start_score,
      user_on_turn: (state) => state.users.find((u) => u.is_on_turn),
    }),

    graphTurnData() {
      if (this.currentGraphIndex == undefined) return null;

	  let points = this.getPointsFromTurns(this.user_on_turn.turns)
      let graph_data = {
        user_name: this.user_on_turn.name,
        turn: this.user_on_turn.turns[this.currentGraphIndex],
        first_point: points[this.currentGraphIndex],
		last_point: points[this.currentGraphIndex + 1]
      };

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
        this.last_scroll_position = (this.graph_points - 5) * this.scale_x;
        this.graph_points += 1;
        this.scrollToLeft();
      }
    },

    scrollToLeft() {
      if (this.$refs.graph == undefined) return;
      let scroll_element = this.$refs.graph;
      let value_to_scroll_to = this.last_scroll_position + 1 * this.scale_x + 2;

      anime({
        targets: scroll_element,
        scrollLeft: value_to_scroll_to,
        duration: 500,
        easing: "easeOutQuint",
        complete: () => {
          this.last_scroll_position = value_to_scroll_to;
        },
      });
    },

    setCurrentGraphIndex(index) {
      if (
        this.currentGraphIndex == index ||
        index >= this.user_on_turn.turns.length
      ) {
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
          duration: 500,
          easing: "easeOutQuad",
        });
      }
    },
  },
};
</script>