<?php namespace App\Http\Controllers;

class PagesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $status;

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
