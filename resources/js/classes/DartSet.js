export default class DartSet{
	constructor(){
		this.legs = []
		this.winner_id = undefined	
	}

	addLeg(leg){
		this.legs.push(leg);
		return this;
	}

	setWinnerId(winner_id){
		this.winner_id = winner_id;
		return this;
	}
}