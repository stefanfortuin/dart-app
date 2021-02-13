<template>
	<div class="w-full h-screen flex flex-col justify-center items-center p-8">
		<transition
			name="component-fade"
			mode="out-in"
		>
			<Players v-if="current_step == 0" />
			<WhoBegins v-if="current_step == 1" />
			<ScoreBoard v-if="current_step == 2" />
			<Win v-if="current_step == 3" />
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