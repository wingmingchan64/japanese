<?php
/*
php H:\github\japanese\programs\漢字→音調標記.php 起きる
*/
require_once( "h:\\github\\japanese\\programs\\常數.php" );
require_once( "h:\\github\\japanese\\programs\\函式.php" );
require_once( 'H:\japanese\programs\kana_romaji_lookup.php' );

checkARGV( $argv, 2, 輸入漢字詞 );
$term = trim( $argv[ 1 ] );
require_once( 'H:\japanese\programs\wadoku\data\和獨漢字_假名.php' );
require_once( 'H:\japanese\programs\wadoku\data\和獨詞條_accent.php' );
$kana = '';
$kanji = '';
// cannot be kana nor romaji
if( !isKana( $term ) && !isAscii( $term ) )
{
	$kanji = $term;
}
else
{
	echo 無此漢字詞;
	exit;
}

if( array_key_exists( $term, $和獨漢字_假名 ) )
{
	$kana = $和獨漢字_假名[ $term ];
}
else
{
	echo 無此漢字詞;
	exit;
}

if( array_key_exists( $term, $和獨詞條_accent ) )
{
	$num = $和獨詞條_accent[ $term ];
	echo $num . ' ' . getPitchAccentString( $num, $markers );
}
else
{
	echo 無此漢字、假名詞;
	exit;
}
?>