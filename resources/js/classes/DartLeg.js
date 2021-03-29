export default class DartLeg{
	constructor(){
		this.turns = []
		this.winner_id = undefined;
	}

	addTurn(turn){
		this.turns.push(turn);
		return this;
	}

	setWinnerId(winner_id){
		this.winner_id = winner_id;
		return this;
	}
}