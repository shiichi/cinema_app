<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	protected $table = 'users';								//The database table used by the model.

	protected $fillable = ['name', 'email', 'password'];	//The attributes that are mass assignable.

	protected $hidden = ['password', 'remember_token'];		//The attributes excluded from the model's JSON form.

	public function articles() {
        return $this->hasMany('App\Article');
    }

}
