<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MoviePerson extends Model {

	protected $table = 'movie_person';        //テーブルを明示的に指定（DRYに従えば不要）
	protected $fillable = ['position','priority'];

}