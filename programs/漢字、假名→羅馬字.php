<?php
/*
php H:\github\japanese\programs\漢字、假名→羅馬字.php 時
*/
require_once( "h:\\github\\japanese\\programs\\常數.php" );
require_once( "h:\\github\\japanese\\programs\\函式.php" );

checkARGV( $argv, 2, 輸入漢字詞 );

require_once( "h:\\github\\japanese\\programs\\tangorin_kanakanji_romaji.php" );
$term = trim( $argv [ 1 ] );

if( in_array( $term, array_keys( $tangorin_kanakanji_romaji ) ) )
{
	echo $term, NL;
	echo $tangorin_kanakanji_romaji[ $term ];
}
else
{
	echo 無此漢字詞;
}
?>