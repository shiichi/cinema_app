<?php
require_once '/var/www/html/project2/vendor/autoload.php';

$file = fopen('./crawler.csv','w');

$client = new Goutte\Client();
$people = array();
$id = 70001;
while ($id <= 80000) {

	//$url = 'http://www.kinenote.com/main/public/cinema/person.aspx?person_id='."$id";
	$url = 'http://192.168.33.17/download/p'."$id".'.html';
	$crawler = $client->request('GET', "$url");											//Clientのrequestメソッドの返り値はSymfony2オブジェクト
	$person = array();
	$crawler->filter('div.head-blockCast')->each(function ($node) use (&$person){
		
		$name = $node->filter('h1')->text();
		$name_tr = trim($name);

		$sub_name = $node->filter('li')->first()->text();
		$sub_name_tri = trim($sub_name);

		$person += array("name" => $name_tr);
		$person += array("sub_name" => $sub_name_tri);
	});

	$ix = 0;	//カウント用

	$crawler->filter('div.block_cast_left div.block_list table.list_inner tr')->each(function ($node) use (&$person, &$ix){
		
	    $html = $node->html();
	    $element = $node->filter('td')->text();
	    $element_tr = trim($element);

	    if ($ix == 1) {									//0:本名,1:出身地.2:出生日.3:没日
	    	if ($element_tr == "－"){
				$person += array("born" => null);
			}
			else{
				$person += array("born" => $element_tr);
			}
		}

		else if ($ix == 2) {
			if ($element_tr == "－"){
				$person += array("birth" => null);
			}
			else{
				$element_cm = mb_convert_kana($element_tr, 'ran');						//全角を半角に
				$search = array('年','月','日');
				$replace = array('-','-','');
				$person += array("birth" => str_replace($search,$replace,$element_cm));	//フォーマット後の値を格納
			}
		}

		else if ($ix == 3) {
			if ($element_tr == "－"){
				$person += array("deth" => null);
			}
			else{
				$element_cm = mb_convert_kana($element_tr, 'ran');						//全角を半角に
				$search = array('年','月','日');
				$replace = array('-','-','');
				$person += array("deth" => str_replace($search,$replace,$element_cm));
			}
		}

		$ix++;
	});

	$people[] = $person;
	$id++;
};

//var_dump($people);	//確認用

//PDOによるデータベース接続
try {
	$pdo = new PDO('mysql:host=localhost; dbname=laravel; charset=utf8','laravel','laravel');
}
catch (PDOException $e) {
	exit('データベース接続失敗。'.$e->getMessage());
}

//人物情報の書き込み
foreach ($people as $person) {
	$name = $person['name'];
	$sub_name = $person['sub_name'];
	$born = $person['born'];
	$birth = $person['birth'];
	$deth = $person['deth'];

	$stmt = $pdo->prepare("SELECT id FROM people WHERE name = :name");
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->execute();


	if ($stmt->rowCount() == 0) {
		$stmt2 = $pdo -> prepare("INSERT INTO people (name, sub_name, born, birth, deth) VALUES (:name, :sub_name, :born, :birth, :deth)");
		$stmt2->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt2->bindParam(':sub_name', $sub_name, PDO::PARAM_STR);
		$stmt2->bindParam(':born', $born, PDO::PARAM_STR);
		$stmt2->bindParam(':birth', $birth, PDO::PARAM_STR);
		$stmt2->bindParam(':deth', $deth, PDO::PARAM_STR);
		$stmt2->execute();
	}
	else{
	}
}


?>