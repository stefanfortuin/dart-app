export default class DartTurn{
	constructor(){
		this.user_id = undefined,
		this.thrown_score = undefined;
		this.old_score_to_throw_from = undefined;
		this.new_score_to_throw_from = undefined;
		this.shots = [];
	}

	setUser(id){
		this.user_id = id;
		return this;
	}

	setThrownScore(thrown_score){
		this.thrown_score = thrown_score;
		return this;
	}

	setOldScoreToThrowFrom(score){
		this.old_score_to_throw_from = score;
		return this;
	}

	calculateNewScoreToThrowFrom(){
		this.new_score_to_throw_from = this.old_score_to_throw_from - this.thrown_score;
		return this;
	}

}