<?php
/*
php H:\github\japanese\programs\漢字→羅馬字、音調標識.php 起きる
*/
require_once( "h:\\github\\japanese\\programs\\常數.php" );
require_once( "h:\\github\\japanese\\programs\\函式.php" );
require_once( 'H:\japanese\programs\kana_romaji_lookup.php' );

checkARGV( $argv, 2, 輸入漢字詞 );

require_once( 'H:\japanese\programs\wadoku\data\和獨漢字_假名.php' );
require_once( 'H:\japanese\programs\wadoku\data\和獨詞條_accent.php' );

$term = trim( $argv [ 1 ] );
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

// use kanji to retrieve accent
$marker = getWadokuAccentIntValue( $kanji, $和獨詞條_accent );
echo $term, NL;
echo $marker, NL;
// input kana here
echo convertKanaToVisualizedRomaji( $kana, $prep, $拗音, $一般假名, $促音, $marker );

?>