import { createStore } from 'vuex';
import toastModule from './toast/store';
import User from '../classes/User';

export default createStore({
	modules: {
		toast: toastModule,
	},
	state: {
		users: [],
		total_sets: 2,
		total_legs: 1,
		user_that_does_turn: undefined,
		current_leg_owner: undefined,
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
			state.user_that_does_turn = undefined;
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
			state.user_that_does_turn = user
			state.current_leg_owner = user
		},

		switchUserThatDoesTurn(state) {
			state.user_that_does_turn = state.users.find(u => u != state.user_that_does_turn)
		},

		
	},

	actions: {
		switchUserThatStartsNextLeg({commit, dispatch, state}) {
			let userThatShouldThrowNow = state.users.find(u => u != state.current_leg_owner);

			if(userThatShouldThrowNow != state.current_leg_owner){
				dispatch('toast/add', {
					title: `${userThatShouldThrowNow.name} heeft de leg van ${state.current_leg_owner.name} gebroken.`,
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

		getUsers(state) {
			return state.users;
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

		getUserThatDoesTurn(state) {
			return state.user_that_does_turn;
		},
	}
})