import Vue from 'vue';
import Vuex from 'vuex';
import Turn from '../classes/Turn';
import User from '../classes/User';

Vue.use(Vuex);

export default new Vuex.Store({
	state: {
		users: [],
		turns: [],
		user_that_does_turn: undefined,
		current_step: 0,
		start_score: 501,
	},
	mutations: {
		setUsers(state, users){
			users.forEach(user => {
				state.users.push(new User(user.id, user.name, state.start_score))
			});
		},

		goToNextStep(state){
			state.current_step++;
		},

		resetCurrentStep(state){
			state.current_step = 0;
			state.users = []
			state.user_that_does_turn = undefined;
			state.start_score = 501;
		},

		saveTurnToGame(state, turn){
			state.turns.push(turn);
		},

		setUserThatDoesTurn(state, user){
			state.user_that_does_turn = user
		},

		switchUserThatDoesTurn(state){
			state.user_that_does_turn = state.users.find(u => u != state.user_that_does_turn)
		}
	},
	getters: {
		getCurrentStep(state){
			return state.current_step;
		},

		getUsers(state){
			return state.users;
		},

		getTurns(state){
			return state.turns;
		},

		getUserThatDoesTurn(state){
			return state.user_that_does_turn;
		},
	}
})