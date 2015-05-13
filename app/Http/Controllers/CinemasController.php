<?php namespace App\Http\Controllers;

use App\Http\Requests;					//もともと
use App\Http\Controllers\Controller;	//もともと
use Illuminate\Http\Request;			//もともと

use App\Movie;						//Movieモデルを利用
use App\Person;						//Personモデルを利用
use App\Company;					//Companyモデルを利用
use App\companymovie;				//companymovieモデルを利用
use App\movieperson;				//moviepersonモデルを利用
use App\Country;                    //Countryモデルを利用
use App\Position;                   //Positionモデルを利用


class CinemasController extends Controller {

	public function index() {
        return view('cinemas.index');
    }

	public function home() {
        $movies = Movie::all();
        return view('cinemas.home', compact('movies'));
    }

    public function show_movie($movie_id) {
        
    	$movie = Movie::findOrFail($movie_id);
    	$person_names = $movie->people->fetch("name");
        $person_ids = $movie->people->fetch("id");
    	$person_posis = $movie->positions->fetch("position");
    	$person_prios = $movie->getpersonposition->fetch("priority");
    	$company_names = $movie->companies->fetch("name");
        $company_ids = $movie->companies->fetch("id");
    	$company_posis = $movie->getcompanyposition->fetch("position");
        $countries = $movie->country;

    	$countp = $person_names->count();
    	$countc = $company_names->count();
    	$companies = array();

    	$directores = array();              //監督
        $screenplaies = array();            //脚本  
        $baseds = array();                  //原作
        $e_produceres = array();            //製作総指揮
        $produceres = array();              //製作
        $cameras = array();                 //撮影
        $p_designeres = array();            //美術
        $musics = array();                  //音楽
        $film_editores = array();           //編集
        $animations = array();              //作画
        $localizations = array();           //字幕・吹替
        $casts = array();                   //キャスト
        $distributed_companies = array();   //配給会社
        $produced_companies = array();      //製作会社

    	$ix = 0;
    	while ( $ix < $countp) {
			if ($person_posis[$ix] === "監督") {
                $director["id"] = $person_ids[$ix];
                $director["name"] = $person_names[$ix];
                $director["prio"] = $person_prios[$ix];
				$directores[] = $director;
			}
            elseif ($person_posis[$ix] === "脚本") {
                $screenplay["id"] = $person_ids[$ix];
                $screenplay["name"] = $person_names[$ix];
                $screenplay["prio"] = $person_prios[$ix];
                $screenplaies[] = $screenplay;
            }
            elseif ($person_posis[$ix] === "原作") {
                $based["id"] = $person_ids[$ix];
                $based["name"] = $person_names[$ix];
                $based["prio"] = $person_prios[$ix];
                $baseds[] = $based;
            }
            elseif ($person_posis[$ix] === "製作総指揮") {
                $e_producer["id"] = $person_ids[$ix];
                $e_producer["name"] = $person_names[$ix];
                $e_producer["prio"] = $person_prios[$ix];
                $e_produceres[] = $e_producer;
            }
            elseif ($person_posis[$ix] === "製作") {
                $producer["id"] = $person_ids[$ix];
                $producer["name"] = $person_names[$ix];
                $producer["prio"] = $person_prios[$ix];
                $produceres[] = $producer;
            }
            elseif ($person_posis[$ix] === "撮影") {
                $camera["id"] = $person_ids[$ix];
                $camera["name"] = $person_names[$ix];
                $camera["prio"] = $person_prios[$ix];
                $cameras[] = $camera;
            }
            elseif ($person_posis[$ix] === "美術") {
                $p_designer["id"] = $person_ids[$ix];
                $p_designer["name"] = $person_names[$ix];
                $p_designer["prio"] = $person_prios[$ix];
                $p_designeres[] = $p_designer;
            }
            elseif ($person_posis[$ix] === "音楽") {
                $music["id"] = $person_ids[$ix];
                $music["name"] = $person_names[$ix];
                $music["prio"] = $person_prios[$ix];
                $musics[] = $music;
                $musics[$person_prios[$ix]] = $person_names[$ix];
            }
            elseif ($person_posis[$ix] === "編集") {
                $film_editor["id"] = $person_ids[$ix];
                $film_editor["name"] = $person_names[$ix];
                $film_editor["prio"] = $person_prios[$ix];
                $film_editores[] = $film_editor;
            }
            elseif ($person_posis[$ix] === "作画") {
                $animation["id"] = $person_ids[$ix];
                $animation["name"] = $person_names[$ix];
                $animation["prio"] = $person_prios[$ix];
                $animations[] = $animation;
            }
            elseif ($person_posis[$ix] === "字幕・吹替") {
                $localization["id"] = $person_ids[$ix];
                $localization["name"] = $person_names[$ix];
                $localization["prio"] = $person_prios[$ix];
                $localizations[] = $localization;
            }
			elseif ($person_posis[$ix] === "キャスト") {
                $cast["id"] = $person_ids[$ix];
                $cast["name"] = $person_names[$ix];
                $cast["prio"] = $person_prios[$ix];
                $casts[] = $cast;
			}  		
    		$ix++;
    	}

    	$ix = 0;
    	while ( $ix < $countc) {
			if ($company_posis[$ix] === "dist") {
                $distributed_company["id"] = $company_ids[$ix];
                $distributed_company["name"] = $company_names[$ix];
                $distributed_companies[] = $distributed_company;
			}
			elseif ($company_posis[$ix] === "prod") {
                $produced_company["id"] = $company_ids[$ix];
                $produced_company["name"] = $company_names[$ix];
                $produced_companies[] = $produced_company;
			}
    		$ix++;
    	}

        return view('cinemas.show_movie', compact('movie','directores','screenplaies','baseds','e_produceres','produceres','cameras','p_designeres','musics','film_editores','animations','localizations','casts','distributed_companies','produced_companies'));
    }

	public function show_person($person_id) {
    	$person = Person::findOrFail($person_id);
        $movies = array_unique($person->movies->toarray(), SORT_REGULAR);
        $positions = $person->positions->fetch("position");

        return view('cinemas.show_person', compact('person','movies','positions'));
    }

	public function show_company($company_id) {
    	$company = Company::findOrFail($company_id);
        $movies = array_unique($company->movies->toarray(), SORT_REGULAR);
        return view('cinemas.show_company', compact('company','movies'));
    }

	public function show_user() {
    	$movie = User::findOrFail($user_id);
        return view('cinemas.user', compact('people'));
    }

    public function search_movie() {
        $searchtext = \Request::get('searchtext');
        $movies = Movie::where('title','like','%'.$searchtext.'%')->paginate(10);
        $people = Person::where('name','like','%'.$searchtext.'%')->paginate(20);
        $companies = Company::where('name','like','%'.$searchtext.'%')->paginate(10);

        return view('cinemas.search_movie', compact('searchtext','movies','people','companies'));
    }
}
