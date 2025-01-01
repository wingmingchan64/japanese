<?php
/*
php H:\github\japanese\programs\漢字→假名.php 毅然
*/
require_once( "h:\\github\\japanese\\programs\\常數.php" );
require_once( "h:\\github\\japanese\\programs\\函式.php" );

checkARGV( $argv, 2, 輸入漢字詞 );

require_once( "h:\\github\\japanese\\programs\\kanji_kana.php" );
$term = trim( $argv [ 1 ] );

if( in_array( $term, array_keys( $kanji_kana ) ) )
{
	print_r( $kanji_kana[ $term ] );
}
else
{
	echo 無此漢字詞;
}
?>