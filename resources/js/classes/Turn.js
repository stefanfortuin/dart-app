export default class Turn{
	constructor(user_id, thrown_score, old_score_to_throw_from){
		this.user_id = user_id,
		this.thrown_score = thrown_score;
		this.old_score_to_throw_from = old_score_to_throw_from;
		this.new_score_to_throw_from = this.calculateNewScoreToThrowFrom();
	}

	calculateNewScoreToThrowFrom(){
		return this.old_score_to_throw_from - this.thrown_score;
	}
}