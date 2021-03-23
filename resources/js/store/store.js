import { createStore } from 'vuex';
import toastModule from './toast/store';
import User from '../classes/User';

export default createStore({
	modules: {
		toast: toastModule,
	},
	state: {
		users: [],
		total_sets: 1,
		total_legs: 1,
		current_step: 0,
		start_score: 501,
	},
	mutations: {
		setUsers(state, users) {
			users.forEach(user => {
				state.users.push(new User(user.id, user.name, state.start_score))
			});
		},

		goToNextStep(state) {
			state.current_step++;
		},

		setStartScore(state, start_score) {
			state.start_score = start_score;
		},

		setTotalSets(state, sets){
			state.total_sets = sets;
		},

		setTotalLegs(state, legs){
			state.total_legs = legs;
		},

		resetCurrentStep(state) {
			state.current_step = 0;
			state.users = []
			state.turns = []
			state.start_score = 501;
		},

		resetForNextSet(state) {
			state.users.forEach(user => {
				user.beginNewSet()
			});
		},

		resetForNextLeg(state){
			state.users.forEach(user => {
				user.beginNewLeg();
			});
		},

		setUserThatDoesTurn(state, user) {
			let current_user = state.users.find(user => user.owns_current_leg);
			if (current_user){
				current_user.is_on_turn = false
				current_user.owns_current_leg = false
			}

			user.is_on_turn = true
			user.owns_current_leg = true
		},

		switchUserThatDoesTurn(state) {
			let current_user = state.users.find(user => user.is_on_turn);
			let user_to_switch_to = state.users.find(user => !user.is_on_turn)

			current_user.is_on_turn = false
			user_to_switch_to.is_on_turn = true;
		},

		
	},

	actions: {
		switchUserThatStartsNextLeg({commit, dispatch, state}) {
			let userThatShouldThrowNow = state.users.find(user => !user.owns_current_leg );

			if(userThatShouldThrowNow.is_on_turn){
				dispatch('toast/add', {
					title: `${userThatShouldThrowNow.name} heeft de leg gebroken.`,
					type: 'success'
				})
			}
			
			commit('setUserThatDoesTurn', userThatShouldThrowNow);
		}
	},

	getters: {
		getCurrentStep(state) {
			return state.current_step;
		},

		getStartScore(state) {
			return state.start_score;
		},

		getCurrentSet() {
			return state.current_set;
		},

		getCurrentLeg() {
			return state.current_leg;
		},
	}
})