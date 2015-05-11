<?php
require_once '/var/www/html/project2/vendor/autoload.php';

$file = fopen('./crawler.csv','w');
$client = new Goutte\Client();

$movies = array();
$id = 1451;
while ($id <= 1500) {

	$url = 'http://www.kinenote.com/main/public/cinema/detail.aspx?cinema_id='."$id";
	$crawler = $client->request('GET', "$url");													//Clientのrequestメソッドの返り値はSymfony2オブジェクト
	$movie = array();

	//人物情報取得
	$positions = array();
	$ix = 0;
	$crawler->filter('div.block_body table.list_inner tr')->each(function ($node) use (&$positions, &$ix){
		
		if ($ix >= 20){
		    $th = trim($node->filter('th')->text());
		    if ($th == ""){
		    }
		    elseif (preg_match("/\d/",$th)){
		    }
		    else{
		    	$positions[] = $th;
		    }		    	
		}
		$ix++;
	});
	$movies[] = $positions;
	$id++;
};

var_dump($movies);

//PDOによるデータベース接続
try {
	$pdo = new PDO('mysql:host=localhost; dbname=laravel; charset=utf8','laravel','laravel');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
	exit('データベース接続失敗。'.$e->getMessage());
}
//役割情報の書き込み
foreach ($movies as $key => $positions) {
	foreach ($positions as $key => $position) {
		try{
			$stmt = $pdo->prepare("SELECT id FROM positions WHERE position = :position");
			$stmt->bindParam(':position', $position, PDO::PARAM_STR);
			$stmt->execute();
		} catch (PDOException $e) {
		print "Exception3";
		print $e->getMessage();
		}

		//重複の確認
		if ($stmt -> rowCount() == 0) {
			$stmt = $pdo -> prepare("INSERT INTO positions (position) VALUES (:position)");
			$stmt->bindParam(':position', $position, PDO::PARAM_INT);
			$stmt->execute();
		}
	}
}
?>