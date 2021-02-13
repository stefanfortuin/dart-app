<template>
	<div>
		<Players v-if="current_step == 0" />
		<WhoBegins v-if="current_step == 1" />
		<ScoreBoard v-if="current_step == 2" />
		<Win v-if="current_step == 3" />
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