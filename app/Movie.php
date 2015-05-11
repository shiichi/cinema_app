<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model {

	//protected $table = 'movies';	//テーブルを明示的に指定（DRYに従えば不要）
	protected $fillable = ['title', 'yomi', 'ori_title', 'produced','released', 'runtime'];

	//MoviePerson中間テーブルからpositionを取得できるように
	public function getpersonposition() {
        return $this->hasMany('App\MoviePerson');
    }
	//personモデルと結合
	public function people() {
        return $this->belongsToMany('App\Person')->withTimestamps();
    }
    //positionモデルと結合
    public function positions() {
        return $this->belongsToMany('App\Position', 'movie_person', 'movie_id', 'position_id');
    }
	//CompanyMovie中間テーブルからpositionを取得できるように
	public function getcompanyposition() {
        return $this->hasMany('App\CompanyMovie');
    }
	//companyモデルと結合
	public function companies() {
        return $this->belongsToMany('App\Company')->withTimestamps();
    }
    //
    public function country() {
        return $this->belongsTo('App\Country');
    }
}
