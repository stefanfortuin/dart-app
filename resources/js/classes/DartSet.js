export default class DartSet{
	constructor(){
		this.legs = []	
	}

	addLeg(leg){
		this.legs.push(leg);
		return this;
	}
}