<?php
require_once '/var/www/html/project2/vendor/autoload.php';

$file = fopen('./crawler.csv','w');

$client = new Goutte\Client();
$movies = array();
$id = 2327;
while ($id <= 2327) {

	$url = 'http://www.kinenote.com/main/public/cinema/detail.aspx?cinema_id='."$id";
	//$url = 'http://192.168.33.17/crowler/download/m'."$id".'.html';
	//$url = 'http://192.168.33.17/crowler/download/m80790.html';
	$crawler = $client->request('GET', "$url");													//Clientのrequestメソッドの返り値はSymfony2オブジェクト
	$movie = array();

	//moviのtitle取得
	$crawler->filter('div.head-block h1')->each(function ($node) use (&$movie){				
		$title = $node->text();
		$title_tr = trim($title);
		$movie += array("title" => $title_tr);
	});

	//moviのyomi,ori_title取得
	$i = 0;
	$crawler->filter('div.head-block ul li')->each(function ($node) use (&$movie, &$i){

		$element = $node->text();
	    $element_tr = trim($element);

		//0:よみ,1:原題,2:??
	    if ($i == 0) {
	    	if ($element_tr == "－"){
				$movie += array("yomi" => null);
			}
			else{
				$movie += array("yomi" => $element_tr);
			}
		}
	    else if ($i == 1) {
	    	if ($element_tr == "----"){
				$movie += array("ori_title" => null);
			}
			else{
				$movie += array("ori_title" => $element_tr);
			}
		}
		$i++;
	});

	//moviのproduced,released,runtimeとcompanyのname取得
	$prod = array();
	$dist = array();
	$ix = 0;
	$crawler->filter('div.block_body table.list_inner td')->each(function ($node) use (&$movie, &$prod, &$dist, &$ix){
		
	    $element = $node->text();
	    $element_tr = trim($element);

	    //0:ジャンル,1:製作国,2:制作年,3:公開日,4:上映時間,5:製作会社,6:配給会社
	    if ($ix == 1) {										
	    	if ($element_tr == ""){
				$movie += array("country" => null);
			}
			else{
				$movie += array("country" => $element_tr);
			}
		}
	    elseif ($ix == 2) {										
	    	if ($element_tr == ""){
				$movie += array("produced" => null);
			}
			else{
				$element_cm = mb_convert_kana($element_tr, 'ran');		//全角を半角に
				$movie += array("produced" => $element_cm);
			}
		}

		elseif ($ix == 3) {
			if ($element_tr == "未公開"){
				$movie += array("released" => null);
			}
			else{
				$element_cm = mb_convert_kana($element_tr, 'ran');
				$element_pi = explode("/",$element_cm);				
				$year = $element_pi[0];								//分割して整合性の確認
				$month = $element_pi[1];
				$day = $element_pi[2];
				if (checkdate($month, $day, $year) == false){
					$movie += array("released" => null);
				}
				else{
					$movie += array("released" => $element_cm);
				}
			}
		}

		elseif ($ix == 4) {
			if ($element_tr == "0分"){
				$movie += array("runtime" => null);
			}
			else{
				$element_cm = mb_convert_kana($element_tr, 'ran');				//全角を半角に
				$element_re = mb_ereg_replace("[^0-9]","",$element_cm);
				$movie += array("runtime" => $element_re);
			}
		}
	    elseif ($ix == 5) {
	    	if ($element_tr == ""){
				//$company += array("name" => null);
			}
			else{
				$element_re = str_replace("作品", "", $element_tr);
				$element_pi = mb_split("=|（|）|＝",$element_re);					//分割
				foreach ($element_pi as $key => $value) {
					array_push($prod, $value);
				}
			}
		}
		elseif ($ix == 6) {
			if ($element_tr == ""){
			}
			else{
				$element_re = str_replace("作品", "", $element_tr);
				$element_pi = mb_split("=|（|）|＝",$element_re);					//分割
				foreach ($element_pi as $key => $value) {
					array_push($dist, $value);
				}
			}
		}
		$ix++;
	});

	//人物情報取得
	$person = array();
	$position = array();
	$ix = 0;

	$crawler->filter('div.block_body table.list_inner tr')->each(function ($node) use (&$movie, &$person, &$person, &$position, &$ix){
		
		if ($ix >= 16){
		    $th = trim($node->filter('th')->text());
		    $td = trim($node->filter('td')->text());
		    if ($th == "") {
		    	array_push($person[end(array_keys($person))], $td);
		    }

		    elseif (preg_match("/\d/",$th)){
		    }

		    else{
		    	$position = array();
		    	$position[] = $td;
				$person[$th] = $position;
		    }
		}
		$ix++;
	});

	//moviのtitle取得
	$crawler->filter('div.head-block h1')->each(function ($node) use (&$movie){				
		$title = $node->text();
		$title_tr = trim($title);
		$movie += array("title" => $title_tr);
	});

	$movies[] = $movie;
	$company = array();
	$company['prod'] = $prod;
	$company['dist'] = $dist;	
	$companies[$movie['title']] = $company;				//映画のタイトルをキーにして会社を配列に格納
	$people[$movie['title']] = $person;
	$id++;
	sleep(1);
};

var_dump($movies);
var_dump($companies);
var_dump($people);


//PDOによるデータベース接続
try {
	$pdo = new PDO('mysql:host=localhost; dbname=laravel; charset=utf8','laravel','laravel');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
	exit('データベース接続失敗。'.$e->getMessage());
}

//国情報の書き込み
foreach ($movies as $movie) {
	$country_name = $movie['country'];


		$stmt = $pdo -> prepare("SELECT id FROM countries WHERE name = :country_name");
		$stmt->bindParam(':country_name', $country_name, PDO::PARAM_STR);
		$stmt->execute();	



	if ($stmt -> rowCount() == 0) {
		$stmt = $pdo -> prepare("INSERT INTO countries (name) VALUES (:country_name)");
		$stmt->bindParam(':country_name', $country_name, PDO::PARAM_STR);
		$stmt->execute();
	}
	else{
		echo $country_name . "はすでに登録済<br>";
	}

}

//映画情報の書き込み
foreach ($movies as $movie) {
	$title = $movie['title'];
	$yomi = $movie['yomi'];
	$ori_title = $movie['ori_title'];
	$country_name = $movie['country'];
	$produced = $movie['produced'];
	$released = $movie['released'];
	$runtime = $movie['runtime'];

	$stmt = $pdo->prepare("SELECT id FROM movies WHERE title = :title");
	$stmt->bindParam(':title', $title, PDO::PARAM_STR);
	$stmt->execute();

	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	$movie_id = $row["id"];
	

	if ($stmt->rowCount() == 0) {
		$stmt = $pdo -> prepare("SELECT id FROM countries WHERE name = :country_name");
		$stmt->bindParam(':country_name', $country_name, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
		$country_id = $row["id"];

		try{
			$stmt = $pdo -> prepare("INSERT INTO movies (title, yomi, ori_title, country_id, produced, released, runtime) VALUES (:title, :yomi, :ori_title, :country_id, :produced, :released, :runtime)");
			$stmt->bindParam(':title', $title, PDO::PARAM_STR);
			$stmt->bindParam(':yomi', $yomi, PDO::PARAM_STR);
			$stmt->bindParam(':ori_title', $ori_title, PDO::PARAM_STR);
			$stmt->bindParam(':country_id', $country_id, PDO::PARAM_INT);//
			$stmt->bindParam(':produced', $produced, PDO::PARAM_INT);
			$stmt->bindParam(':released', $released, PDO::PARAM_STR);
			$stmt->bindParam(':runtime', $runtime, PDO::PARAM_INT);
			$stmt->execute();
		} catch (PDOException $e) {
	    print "Exception3";
	    print $e->getMessage();
		}
	}
	else{
		echo $title . "　はすでに登録済<br>";
	}
}

//会社情報の書き込み
foreach ($companies as $key => $company) {
	foreach ($company['prod'] as $key => $name) {

		$stmt = $pdo -> prepare("SELECT id FROM companies WHERE name = :name");
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->execute();

		if ($stmt -> rowCount() == 0) {
			$stmt = $pdo -> prepare("INSERT INTO companies (name) VALUES (:name)");
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->execute();
		}
		else{
			echo $name . "　はすでに登録済<br>";
		}
	}

	foreach ($company['dist'] as $key => $name) {

		$stmt = $pdo -> prepare("SELECT id FROM companies WHERE name = :name");
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->execute();

		if ($stmt -> rowCount() == 0) {
			$stmt = $pdo -> prepare("INSERT INTO companies (name) VALUES (:name)");
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->execute();
		}
		else{
			echo $name . "　はすでに登録済<br>";
		}
	}
}

//映画ー会社情報の書き込み
foreach ($companies as $movie_title => $company) {
	//movie_idの取得
	$stmt = $pdo->prepare("SELECT id FROM movies WHERE title = :title");
	$stmt->bindParam(':title', $movie_title, PDO::PARAM_STR);
	$stmt->execute();
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	$movie_id = $row["id"];

	foreach ($company as $position => $company_names){

		foreach ($company_names as $key => $company_name) {
			//company_idの取得

			$stmt = $pdo->prepare("SELECT id FROM companies WHERE name = :name");
			$stmt->bindParam(':name', $company_name, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			$company_id = $row["id"];

			//重複の確認
			$stmt = $pdo->prepare("SELECT movie_id, company_id, position FROM company_movie WHERE movie_id = :movie_id and company_id = :company_id and position = :position");
			$stmt->bindParam(':movie_id', $movie_id, PDO::PARAM_INT);
			$stmt->bindParam(':company_id', $company_id, PDO::PARAM_INT);
			$stmt->bindParam(':position', $position, PDO::PARAM_STR);
			$stmt->execute();

			if ($stmt -> rowCount() == 0) {
				$stmt = $pdo -> prepare("INSERT INTO company_movie (movie_id, company_id, position) VALUES (:movie_id, :company_id, :position)");
				$stmt->bindParam(':movie_id', $movie_id, PDO::PARAM_INT);
				$stmt->bindParam(':company_id', $company_id, PDO::PARAM_INT);
				$stmt->bindParam(':position', $position, PDO::PARAM_STR);
				$stmt->execute();
			}
			else{
				echo $person_name . "　はすでに登録済<br>";
			}
		}
	}
}
echo "映画ー人物情報の登録開始<br>";
//映画ー人物情報の書き込み
foreach ($people as $movie_title => $people) {
	//movie_idの取得
	$stmt = $pdo->prepare("SELECT id FROM movies WHERE title = :title");
	$stmt->bindParam(':title', $movie_title, PDO::PARAM_STR);
	$stmt->execute();

	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	$movie_id = $row["id"];
	echo "映画IDは". $movie_id . "<br>";

	foreach ($people as $position => $person) {
		//var_dump($position);
		if ($position == "監督") {
			$position_id = "1";
		}
		elseif ($position == "脚本" or $position == "脚色" or $position == "脚本監修") {
			$position_id = "2";
		}
		elseif ($position == "原作" or $position == "原案" or $position == "原作戯曲") {
			$position_id = "3";
		}
		elseif ($position == "製作総指揮" or $position == "共同製作総指揮" or $position == "エグゼクティブプロデューサー") {
			$position_id = "4";
		}
		elseif ($position == "製作" or $position == "共同製作" or $position == "プロデューサー" or $position == "アソシエイト・プロデューサー" or $position == "制作補") {
			$position_id = "5";
		}
		elseif ($position == "撮影" or $position == "カメラ" or $position == "撮影監督" or $position == "カメラ操作" or $position == "撮影助手" or $position == "特殊撮影" or $position == "空中撮影") {
			$position_id = "6";
		}
		elseif ($position == "美術" or $position == "美術監督" or $position == "プロダクション・デザイン") {
			$position_id = "7";
		}
		elseif ($position == "音楽" or $position == "音楽監督" or $position == "音楽監修" or $position == "編曲" or $position == "音楽編集" or $position == "音声編集スーパーバイザー" or $position == "音響" or $position == "音響監督" or $position == "音響監修") {
			$position_id = "8";
		}
		elseif ($position == "編集" or $position == "編集監督") {
			$position_id = "9";
		}
		elseif ($position == "作画" or $position == "作画監督") {
			$position_id = "10";
		}
		elseif ($position == "吹替版翻訳" or $position == "字幕" or $position == "字幕監修" or $position == "英語翻訳" or $position == "吹替版演出") {
			$position_id = "11";
		}
		elseif ($position == "出演" or $position == "特別出演" or $position == "出演（声）") {
			$position_id = "13";
		}
		else{
			$position_id = "12";
		}
		echo "　ポジションIDは". $position_id . "<br>";

		foreach ($person as $priority => $person_name) {
			//person_idの取得
			$stmt = $pdo->prepare("SELECT id FROM people WHERE name = :name");
			$stmt->bindParam(':name', $person_name, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			$person_id = $row["id"];
			echo "　　人物IDは". $person_id . "<br>";

			if (isset($person_id)) {
				//重複の確認
				$stmt = $pdo->prepare("SELECT movie_id, person_id, position_id FROM movie_person WHERE movie_id = :movie_id and person_id = :person_id and position_id = :position_id");
				$stmt->bindParam(':movie_id', $movie_id, PDO::PARAM_INT);
				$stmt->bindParam(':person_id', $person_id, PDO::PARAM_INT);
				$stmt->bindParam(':position_id', $position_id, PDO::PARAM_STR);
				$stmt->execute();

				if ($stmt -> rowCount() == 0) {

					try{
					$stmt = $pdo -> prepare("INSERT INTO movie_person (movie_id, person_id, position_id, priority) VALUES (:movie_id, :person_id, :position_id, :priority)");
					$stmt->bindParam(':movie_id', $movie_id, PDO::PARAM_INT);
					$stmt->bindParam(':person_id', $person_id, PDO::PARAM_INT);
					$stmt->bindParam(':position_id', $position_id, PDO::PARAM_STR);
					$stmt->bindParam(':priority', $priority, PDO::PARAM_INT);
					$stmt->execute();
					} catch (PDOException $e) {
					    print "Exception3";
					    print $e->getMessage();
					}
				}
				else{
					echo $person_name . "　はすでに登録済<br>";
				}
			}
		}
	}
}

?>