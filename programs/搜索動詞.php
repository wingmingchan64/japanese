<?php
/*
php H:\github\japanese\programs\搜索動詞.php
*/
require_once( 'H:\github\japanese\programs\動詞表.php' );
$NL = "\r\n";
$動詞 = '食べる';

$model = $動詞表[ $動詞 ][ 'model' ];
$動詞陣列名 = "${model}";

$stem  = $動詞表[ $動詞 ][ 'stem' ];
require_once( "H:\\github\\japanese\\programs\\${model}.php" );
print_r( $$動詞陣列名 );
?>