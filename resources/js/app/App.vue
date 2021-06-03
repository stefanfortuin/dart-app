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
import ToastWrapper from './components/Toast/ToastWrapper.vue';

export default {
	components: {
		ToastWrapper,
	},
}
</script>