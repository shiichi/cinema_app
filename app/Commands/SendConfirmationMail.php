<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use App\User;							//追加
use Carbon\Carbon;						//追加
use Illuminate\Contracts\Mail\Mailer;	//追加


//ShouldBeQueuedインターフェースを実装しているので、queueとして動作する
class SendConfirmationMail extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

	protected $user;		// 追加
	protected $app_key;		// 追加


	// コンストラクタで Userオブジェクトを取得
	public function __construct(User $user, $app_key)
	{
		$this->user = $user;
		$this->app_key = $app_key;
	}

	//Mailerオブジェクトの依存性を注入　$userに確認メールの送信日時をセットし、確認メールの送信を行います。
	public function handle(Mailer $mailer)
	{
		//これはUserのオブジェクト
		$user = $this->user;

		$user->makeConfirmationToken($this->app_key);
		$user->confirmation_sent_at = Carbon::now();
		$user->save();

		$data = ['user' => $user, 'token' => $user->confirmation_token];
		$mailer->send('emails.confirmation', $data, function($message) use ($user) {
		    $message->to($user->email, $user->name)->subject('ユーザー登録確認');
		});      
	}
}
