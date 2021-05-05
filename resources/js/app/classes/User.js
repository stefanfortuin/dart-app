import anime from 'animejs';

export default class User {
	constructor() {
		this.turns = [];
		this.start_score = undefined;
		this.checkout = '';
		this.legs_won = 0
		this.sets_won = 0
		this.is_on_turn = false
		this.owns_current_leg = false
		this.stats = {
			sets_won: 0,
			legs_won: 0,
			average_per_turn: parseFloat(0).toFixed(2),
			highest: 0,
		};
		this.last_turn = undefined;
		this.score_to_throw_from = undefined;
		this.updateStats();
	}

	setDataFromObject(user){
		for (const key in user) {
			this[key] = user[key]
		}
		return this;
	}

	setUuid(id){
		this.uuid = id
		return this;
	}

	setStartScore(start_score){
		this.start_score = start_score;
		this.score_to_throw_from = start_score;
		return this;
	}

	addTurn(turn) {
		this.turns.push(turn);
		this.last_turn = turn;

		if(turn.new_score_to_throw_from > 0){
			anime({
				targets: this,
				score_to_throw_from: turn.new_score_to_throw_from,
				duration: 700,
				easing: "easeInOutQuint",
			});
		}
		return this;
	}

	hasReachedZero(){
		return this.last_turn.new_score_to_throw_from <= 0
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
		this.score_to_throw_from = this.start_score;
		this.updateStats();
	}

	getAveragePerTurn(){
		if(this.turns.length == 0) return 0;
		return this.turns.reduce((t,a) => {return t+=a.thrown_score}, 0) / this.turns.length;
	}

	getHighestTurn(){
		if(this.turns.length == 0) return 0;
		return Math.max.apply(Math, this.turns.map((turn) => {return turn.thrown_score}));
	}

	updateStats(){
		this.stats.sets_won = this.sets_won;
		this.stats.legs_won = this.legs_won;

		anime({
			targets: this.stats,
			average_per_turn: this.getAveragePerTurn(),
			highest: this.getHighestTurn(),
			duration: 500,
			easing: "easeInOutQuint",
		});
	}

	getCheckout() {
		if (this.last_turn.new_score_to_throw_from > 170 || this.last_turn.new_score_to_throw_from < 2) return;

		fetch(`/api/checkout/${this.last_turn.new_score_to_throw_from}`)
			.then(response => response.json())
			.then(response => {
				this.checkout = response.join(" ");
			})
		
		return this;
	}
}