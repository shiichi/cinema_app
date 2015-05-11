<?php namespace App\Http\Controllers;

class PagesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $status = array(
		'first_name' => 'Nakajima',
		'last_name' => 'Akinori',
		'title_ja' => '堀田IT教室',
		'title_en' => 'Horita IT School',
		'sub_titile' => 'Technology is best for our future.',
		'phone' => '080-3118-0464',
		'email' => 's.shiichi311041@gmail.com',
		'address' => '愛知県名古屋市瑞穂区<br>下坂町１−４１丸美<br>タウンマンション堀田５０１号室'
	);

	protected $title = array(
		
	);

	public function home() {

        return view('pages.home',$this -> status);
    }

	public function about() {

        return view('pages.about',$this -> status);
    }

	public function contact() {

        return view('pages.contact',$this -> status);
    }
}
