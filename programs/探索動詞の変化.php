<?php
/*
php H:\github\japanese\programs\探索動詞の変化.php する
*/
require_once( '函式.php' );

checkARGV( $argv, 2, "必須提供動詞： " );

require_once( 'H:\github\japanese\programs\動詞表.php' );
$動詞 = '飲む';

$model = $動詞表[ $動詞 ][ 'model' ];
$動詞陣列名 = "${model}";

$stem  = $動詞表[ $動詞 ][ 'stem' ];
require_once( "H:\\github\\japanese\\programs\\${model}.php" );
print_r( $$動詞陣列名 );
?>