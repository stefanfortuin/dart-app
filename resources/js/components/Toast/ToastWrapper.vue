<template>
	<div
		class="absolute top-0 p-4 w-full z-50 pointer-events-none"
	>
		<transition-group name="toast-move">
			<toast v-for="(toast, index) in toasts" :key="index"
				:title="toast.title"
				:message="toast.message"
				:type="toast.type"
			/>
		</transition-group>
	</div>
</template>

<script>
import { mapState } from 'vuex';
import Toast from './Toast.vue';

export default {
	components: {
		Toast,
	},
	computed: {
		...mapState({
			toasts: state => state.toast.toasts,
		})
	}
}
</script>