<template>
	<toast-wrapper/>
	<transition
		name="view-fade"
		mode="out-in"
	>
		<router-view :key="$route.fullPath"></router-view>
	</transition>
</template>

<script>
import GameSettings from './views/GameSettings';
import { mapState } from 'vuex';
import {defineAsyncComponent} from 'vue';
import ToastWrapper from './components/Toast/ToastWrapper.vue';

export default {
	components: {
		GameSettings,
		WhoBegins: defineAsyncComponent(() => import(/* webpackChunkName: "choose" */ './views/WhoBegins')),
		ScoreBoard: defineAsyncComponent(() => import(/* webpackChunkName: "game" */ './views/ScoreBoard')),
		Win: defineAsyncComponent(() => import(/* webpackChunkName: "end" */ './views/Win')),
		ToastWrapper,
	},
}
</script>