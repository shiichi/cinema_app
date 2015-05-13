<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Carbon\Carbon;                      //Carbon機能を利用

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	protected $table = 'users';								//The database table used by the model.

	protected $fillable = ['name', 'email', 'password'];	//The attributes that are mass assignable.

	protected $hidden = ['password','remember_token','confirmation_token','confirmed_at','confirmation_sent_at'];	//The attributes excluded from the model's JSON form.

	protected $dates = ['confirmed_at', 'confirmation_sent_at'];

	//Articleテーブルとの接続
	public function articles() {
        return $this->hasMany('App\Article');
    }

    //confirmation_tokenを生成して、自身にセットした後に、それを返す
	public function makeConfirmationToken($key) {
		return $this->confirmation_token = hash_hmac('sha256', str_random(40).$this->email, $key);
	}

	//確認日時をセットし、確認トークンをクリアして、ユーザー登録確認が完了した状態にする
	public function confirm() {
		$this->confirmed_at = Carbon::now();
		$this->confirmation_token = '';
		$this->save();
	}

	//ユーザー登録確認が完了しているかをチェック
	public function isConfirmed() {
		return ! empty($this->confirmed_at);
	}

}