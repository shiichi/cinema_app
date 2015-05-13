<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;							//追加
use App\User;											//追加
use Illuminate\Contracts\Config\Repository as Config;	//追加
use App\Commands\SendConfirmationMail;					//追加

class AuthController extends Controller {

	use AuthenticatesAndRegistersUsers;

	protected $redirectTo = '/cinema';
	
	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */

	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
		$this->middleware('confirm', ['only' => 'postLogin']);
	}

	/**
     * ① ユーザー登録
     * ユーザーを作成し、確認メールを送信する
     *
     * @param \Request $request
     * @return \Illuminate\Http\Redirect\Response
     */

    public function postRegister(Request $request, Config $config) {
        $validator = $this->registrar->validator($request->all());
 
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
 
 		$user = $this->registrar->create($request->all());
 
        // コマンドバスを使ってコマンドを実行
        $this->dispatch(
        	new SendConfirmationMail($user, $config->get('app_key'))
        );
 
        // ここでログインはしない
        \Session::flash('message', 'ユーザー登録確認メールを送りました。');
        return redirect()->guest('auth/login');
    }
 
    /**
     * ② ユーザーを確認済にする
     *
     * @param $token
     * @return Illuminate\Http\Redirect\Response|Illuminate\Routing\Redirector
     */
    public function getConfirm($token) {
        $user = User::where('confirmation_token', '=', $token)->first();
        if(! $user) {
            \Session::flash('message', '無効なトークンです。');
            return redirect('auth/login');
        }
 
        $user->confirm();
 
        \Session::flash('message', 'ユーザー登録が完了しました。ログインしてください。');
        return redirect()->guest('auth/login');
    }

	/**
     * ① 確認メール再送画面を表示する
     *
     * @return \Illuminate\View\View
     */
    public function getResend() {
        return view('auth.confirm');
    }
 
    /**
     * ② 確認メールの再送信する
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postResend(Request $request, Config $config) {
        $this->validate($request, ['email' => 'required|email']);
        $user = User::where('email', '=', $request->input('email'))->first();
        
        if(! $user) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => trans('passwords.user')]);
        }
        if($user->isConfirmed()) {
            \Session::flash('message', '既に、ユーザー登録が完了しています。ログインしてください。');
            return redirect()->guest('auth/login');
        }
 
        // コマンドバスを使ってコマンドを実行
        $this->dispatch(
            new SendConfirmationMail($user, $config->get('app.key'))
        );
 
        \Session::flash('message', 'ユーザー登録確認メールを送りました。');
        return redirect()->guest('auth/login');
    }
}
