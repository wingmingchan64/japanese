<?php
/*
php H:\japanese\programs\weblio\展示詞條内容.php ここ
*/
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
require_once( 'H:\github\japanese\programs\函式.php' );

checkARGV( $argv, 2, 輸入詞條 );
$entry = trim( $argv[ 1 ] );
$source = file_get_contents( "H:\\japanese\\programs\\weblio\\data\\${entry}.html" );
echo strip_tags( $source );
?>