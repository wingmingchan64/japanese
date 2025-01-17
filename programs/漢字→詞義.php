<?php
/*
php H:\github\japanese\programs\漢字→詞義.php 時
*/
require_once( "h:\\github\\japanese\\programs\\常數.php" );
require_once( "h:\\github\\japanese\\programs\\函式.php" );

checkARGV( $argv, 2, 輸入漢字詞 );

require_once( "h:\\github\\japanese\\programs\\kanji_meaning.php" );
$term = trim( $argv [ 1 ] );

if( in_array( $term, array_keys( $kanji_meaning ) ) )
{
	echo $term, NL;
	$meanings = explode( ']', $kanji_meaning[ $term ][ 'meaning' ] );
	print_r( $meanings );
}
else
{
	echo 無此漢字詞;
}
?>