<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyMovie extends Model {

	protected $table = 'company_movie';        //テーブルを明示的に指定（DRYに従えば不要）
	protected $fillable = ['position'];

}