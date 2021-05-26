import { createStore } from 'vuex';
import toastModule from './toast/store';
import User from '../classes/User';
import DartSet from '../classes/DartSet';
import DartLeg from '../classes/DartLeg';

export default createStore({
	modules: {
		toast: toastModule,
	},
	state: {
		users: [],
		sets: [],
		total_sets: 1,
		total_legs: 1,
		current_step: 0,
		current_leg: undefined,
		current_set: undefined,
		start_score: 501,
	},
	mutations: {
		setUsers(state, users) {
			let user_one = new User()
								.setDataFromObject(users.user_one)
								.setUuid(1)
								.setStartScore(state.start_score)
								
			state.users.push(user_one)

			let user_two = new User()
								.setDataFromObject(users.user_two)
								.setUuid(2)
								.setStartScore(state.start_score)
								
			state.users.push(user_two)
		},

		goToNextStep(state) {
			state.current_step++;
		},

		setStartScore(state, start_score) {
			state.start_score = parseInt(start_score);
		},

		setTotalSets(state, sets){
			state.total_sets = parseInt(sets);
		},

		setTotalLegs(state, legs){
			state.total_legs = parseInt(legs);
		},

		startGame(state){
			let dart_set = new DartSet();
			let dart_leg = new DartLeg();
			state.sets.push(dart_set);
			state.current_set = dart_set;

			state.current_set.addLeg(dart_leg);
			state.current_leg = dart_leg;
		},

		addTurnToLeg(state, turn){
			state.current_leg.addTurn(turn)
		},

		setLegWinner(state, user){
			state.current_leg.setWinnerId(user.id);
		},

		setSetWinner(state, user){
			state.current_set.setWinnerId(user.id);
		},

		makeNewLeg(state){
			let new_leg = new DartLeg();
			state.current_set.addLeg(new_leg);
			state.current_leg = new_leg;
		},

		makeNewSet(state){
			let new_set = new DartSet();
			state.sets.push(new_set);
			state.current_set = new_set;
		},

		resetCurrentStep(state) {
			state.current_step = 0;
			state.users = []
			state.sets = []
			state.start_score = 501;
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
		},

		addTurnToGame({commit}, turn){
			commit('addTurnToLeg', turn);
		},

		resetForNextLeg({commit, state}){
			state.users.forEach(user => {
				user.resetCheckout();
				user.clearTurns();
			})

			let userThatIsOnTurn = state.users.find(user => user.is_on_turn );
			commit('setLegWinner',userThatIsOnTurn);
			commit('makeNewLeg');
		},

		resetForNextSet({commit, state}){
			state.users.forEach(user => {
				user.resetCheckout();
				user.clearTurns();
				user.legs_won = 0;
			});

			let userThatIsOnTurn = state.users.find(user => user.is_on_turn );
			commit('setLegWinner',userThatIsOnTurn);
			commit('setSetWinner', userThatIsOnTurn);
			commit('makeNewSet');
			commit('makeNewLeg');
		},

		uploadGame({state, dispatch}) {
			let game = {
				users: state.users,
				game: {
					sets: state.sets,
					start_score: state.start_score,
					total_sets: state.total_sets,
					total_legs: state.total_legs,
					winner_id: state.users.find(user => user.is_on_turn ).id,
				}
			}

			fetch(`/play/upload-game`, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-Token': window.csrf_token
				},
				body: JSON.stringify(game),
			})
			.then((response) => response.json())
			.then((response) => {
				if(response.success == false)
					dispatch('toast/add', {title: response.message, type: 'error'})
			});
		}
	},
})