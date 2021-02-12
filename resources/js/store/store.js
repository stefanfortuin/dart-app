import Vuex from 'vuex';
import Match from '../classes/Match';
import Turn from '../classes/Turn';
import User from '../classes/User';

export default new Vuex.Store({
	state: {
		match: new Match(),
	}
})