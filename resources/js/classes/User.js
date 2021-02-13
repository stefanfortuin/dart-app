export default class User{
	constructor(id, name, start_score){
		this.id = id
		this.name = name
		this.turns = [];
		this.start_score = start_score;
	}

	addTurn(turn){
		this.turns.push(turn);
	}

	get score_to_throw_from(){
		return (this.last_turn != undefined)
		? this.last_turn.new_score_to_throw_from
		: this.start_score;
	}

	get last_turn(){
		return this.turns.slice(-1)[0];
	}
}