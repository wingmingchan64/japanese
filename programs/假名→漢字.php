<?php
/*
php H:\github\japanese\programs\假名→漢字.php くい
*/
require_once( "h:\\github\\japanese\\programs\\常數.php" );
require_once( "h:\\github\\japanese\\programs\\函式.php" );

checkARGV( $argv, 2, 輸入假名詞 );

require_once( "h:\\github\\japanese\\programs\\kana_kanji.php" );
$term = trim( $argv [ 1 ] );

if( in_array( $term, array_keys( $kana_kanji ) ) )
{
	print_r( $kana_kanji[ $term ] );
}
else
{
	echo 無此假名詞;
}
?>