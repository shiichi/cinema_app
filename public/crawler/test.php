<?php 
$array1 = array(
	'監督' => array('マーク・ウェブ', 'ジョージ・ルーカス'),
	'脚本' => array('あああ', 'いいい'),
	'出演' => array('マイケル', 'ジョン'));

var_dump($array1);

array_push($array1['出演'], 'ケイト');
var_dump($array1);

if (isset($array1['出演'])) {
	echo "あるので　array_push";
	array_push($array1['出演'], 'ジョン');
	var_dump($array1);
}
else{
	echo "ないので　array1[]";
	$array1['出演'] = 'ジョン';
	var_dump($array1);
}




?>