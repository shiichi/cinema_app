<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class person extends Model {

	protected $fillable = ['name', 'yomi', 'sub_name', 'born', 'birth', 'deth'];

	//personモデルと結合
	public function movies() {
        return $this->belongsToMany('App\Movie')->withTimestamps();
    }

    //positionモデルと結合
    public function positions() {
        return $this->belongsToMany('App\Position', 'movie_person', 'person_id', 'position_id');
    }

}