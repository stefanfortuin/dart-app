export default class DartLeg{
	constructor(){
		this.turns = []
	}

	addTurn(turn){
		this.turns.push(turn);
		return this;
	}
}