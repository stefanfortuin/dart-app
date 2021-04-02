export default class User {
	constructor(id, name, start_score) {
		this.id = id
		this.name = name
		this.latest_game;
		this.turns = [];
		this.start_score = start_score;
		this.checkout = '';
		this.legs_won = 0
		this.sets_won = 0
		this.is_on_turn = false
		this.owns_current_leg = false
	}

	setName(name){
		this.name = name;
		return this;
	}

	setId(id){
		this.id = id;
		return this;
	}

	setStartScore(start_score){
		this.start_score = start_score;
		return this;
	}

	setLatestGame(latest_game){
		this.latest_game = latest_game;
		return this;
	}

	addTurn(turn) {
		this.turns.push(turn);
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
		this.legs_won = 0;
	}

	beginNewLeg(){
		this.resetCheckout();
	}

	resetCheckout(){
		this.checkout = '';
	}

	clearTurns(){
		this.turns = [];
	}

	get score_to_throw_from() {
		return (this.last_turn != undefined)
			? this.last_turn.new_score_to_throw_from
			: this.start_score;
	}

	get last_turn() {
		return this.turns.slice(-1)[0];
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