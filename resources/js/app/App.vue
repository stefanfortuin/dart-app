<template>
	<toast-wrapper/>
	<transition
		name="view-fade"
		mode="out-in"
	>
		<GameSettings key="0" v-if="current_step == 0" />
		<WhoBegins key="1" v-else-if="current_step == 1" />
		<ScoreBoard key="2" v-else-if="current_step == 2" />
		<Win key="3" v-else-if="current_step == 3" />
	</transition>
</template>

<script>
import GameSettings from './views/GameSettings';
import WhoBegins from './views/WhoBegins';
import ScoreBoard from './views/ScoreBoard';
import Win from './views/Win';
import { mapState } from 'vuex';
import ToastWrapper from './components/Toast/ToastWrapper.vue';

export default {
	components: {
		GameSettings,
		WhoBegins,
		ScoreBoard,
		Win,
		ToastWrapper,
	},
	computed: {
		...mapState({
			current_step: state => state.current_step
		})
	},
	created(){
		window.onbeforeunload = (event) => {
			if(this.current_step == 2)
				event.returnValue = "Data will be lost";
		}
	}
}
</script>