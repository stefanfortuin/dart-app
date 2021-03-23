import DartLeg from "./DartLeg";
import DartSet from "./DartSet";

export default class User {
	constructor(id, name, start_score) {
		this.id = id
		this.name = name
		this.sets = [];
		this.start_score = start_score;
		this.checkout = '';
		this.current_set = undefined;
		this.current_leg = undefined;
		this.legs_won = 0
		this.sets_won = 0
		this.is_on_turn = false
		this.owns_current_leg = false
		this.beginNewSet();
	}

	addTurn(turn) {
		this.current_leg.addTurn(turn);
		return this;
	}

	hasReachedZero(){
		return this.score_to_throw_from <= 0
	}

	addWonLeg(){
		this.legs_won += 1;
	}

	addWonSet(){
		this.sets_won += 1;
	}

	beginNewSet(){
		this.resetCheckout();
		this.legs_won = 0
		this.current_set = new DartSet();
		this.sets.push(this.current_set);
		this.beginNewLeg();
	}

	beginNewLeg(){
		this.resetCheckout();
		this.current_leg = new DartLeg();
		this.current_set.addLeg(this.current_leg);
	}

	resetCheckout(){
		this.checkout = '';
	}

	get score_to_throw_from() {
		return (this.last_turn != undefined)
			? this.last_turn.new_score_to_throw_from
			: this.start_score;
	}

	get last_turn() {
		return this.current_leg.turns.slice(-1)[0];
	}

	get turns(){
		return this.current_leg.turns
	}

	getCheckout() {
		if (this.score_to_throw_from > 170 || this.score_to_throw_from < 2) return;

		fetch(`/api/checkout/${this.score_to_throw_from}`)
			.then(response => response.json())
			.then(response => {
				this.checkout = response.join(" ");
			})
		
		return this;
	}
}