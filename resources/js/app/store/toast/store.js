export default {
	namespaced: true,
	state: {
		toasts: [],
	},

	mutations: {
		add(state, toast){
			state.toasts.unshift(toast);
		},

		pop(state){
			state.toasts.pop()
		}
	},

	actions: {
		add({commit}, toast){
			commit('add', toast);
			setTimeout(() => {
				commit('pop')
			}, 2000);
		}
	}
}