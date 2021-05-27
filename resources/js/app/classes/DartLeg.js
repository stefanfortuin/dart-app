import anime from 'animejs';

export default class DartLeg {
	constructor() {
		this.turns = [];
		this.winner_id = undefined;
		this.stats = {};
	}

	addTurn(turn) {
		this.turns.push(turn);
		this.updateStats(turn.user_uuid);
		return this;
	}

	setWinnerId(winner_id) {
		this.winner_id = winner_id;
		return this;
	}

	initStats(users){
		users.forEach(user => {
			this.stats[user.uuid] = {
				average_per_turn: 0.00,
				highest: 0,
			};
		});
	}

	updateStats(uuid){

		anime({
			targets: this.stats[uuid],
			average_per_turn: parseFloat(this.getAveragePerTurn(uuid)),
			highest: this.getHighestTurn(uuid),
			duration: 500,
			easing: "easeInOutQuint",
		});
	}

	getAveragePerTurn(uuid) {
		if (this.turns.length == 0) return 0;
		return (
			this.turns.reduce((t, a) => {
				if (a.user_uuid == uuid) return (t += a.thrown_score);
				else return (t += 0);
			}, 0) / this.turns.length
		);
	}

	getHighestTurn(uuid) {
		if (this.turns.length == 0) return 0;
		return Math.max.apply(
			Math,
			this.turns
				.filter((turn) => {
					return turn.user_uuid == uuid;
				})
				.map((turn) => {
					return turn.thrown_score;
				})
		);
	}
}
