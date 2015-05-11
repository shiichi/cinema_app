<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class position extends Model {

	protected $fillable = ['position', 'details'];

	//movieモデルと結合
	public function movies() {
        return $this->belongsToMany('App\Movie', 'movie_person')->withTimestamps();
    }

    //Personモデルと結合
    public function Persons() {
        return $this->belongsToMany('App\Person', 'movie_person', 'position_id', 'person_id');
    }

}