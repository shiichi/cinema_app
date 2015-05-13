<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use App\User;							//追加
use Illuminate\Contracts\Mail\Mailer;	//追加

class SendWelcomeMail extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

	protected $user;  // 追加

	public function __construct(User $user)	//Userクラスのインスタンスをオブジェクトとして取得
	{
		$this->user = $user;
	}

	public function handle(Mailer $mailer)	//Mailer クラスのインスタンスをオブジェクトとして取得
	{
        
        $gift = "ハワイ旅行";
 
        $user = $this->user;
        $mailer->send('emails.welcome', compact('user', 'gift'), function($message) use ($user) {
            $message->to($user->email, $user->name)->subject('ようこそ、Hogeトラベルへ');
        });
	}

}
