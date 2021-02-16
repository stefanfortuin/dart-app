export default class Turn{
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

	setOldScoreToThrowFrom(score){
		this.old_score_to_throw_from = score;
		return this;
	}

	addShotAndCalculateNewScore(shot){
		this.shots.push(shot);
		this.calculateThrownScore();
	}

	get shotScoresInStringFormat(){
		return this.shots.map(shot => shot.thrown_score).join(" ");
	}

	calculateThrownScore(){
		this.thrown_score = this.shots.reduce((t,a) => {return t+= a.thrown_score}, 0);
		this.new_score_to_throw_from = this.old_score_to_throw_from - this.thrown_score;
	}

}