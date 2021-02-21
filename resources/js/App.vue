<template>
	<div class="h-full">
		<transition
			name="component-fade"
			mode="out-in"
		>
			<Players key="0" v-if="current_step == 0" />
			<WhoBegins key="1" v-else-if="current_step == 1" />
			<ScoreBoard key="2" v-else-if="current_step == 2" />
			<Win key="3" v-else-if="current_step == 3" />
		</transition>
	</div>
</template>

<script>
import Players from './views/Players';
import WhoBegins from './views/WhoBegins';
import ScoreBoard from './views/ScoreBoard';
import Win from './views/Win';
import { mapGetters } from 'vuex';

export default {
	components: {
		Players,
		WhoBegins,
		ScoreBoard,
		Win,
	},
	computed: {
		...mapGetters({
			current_step: 'getCurrentStep'
		})
	}
}
</script>