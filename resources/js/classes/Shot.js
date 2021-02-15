export default class Shot{
	constructor(){
		this.user_id = undefined;
		this.dart_id = undefined;
		this.thrown_score = undefined;
	}

	setUser(id){
		this.user_id = id;
		return this;
	}

	setDart(id){
		this.dart_id = id;
		return this;
	}

	setThrownScore(score){
		this.thrown_score = score;
		return this;
	}
}