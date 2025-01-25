<?php
/*
php H:\github\japanese\programs\test.php

Hiragana Range: 3040–309F
Katakana Range: 30A0–30FF

*/
require_once( 'H:\github\japanese\programs\kanji_meaning.php' );
require_once( 'H:\github\japanese\programs\函式.php' );

//print_r( $kanji_meaning[ '龕灯返し' ] );
//echo getPitchAccentString( '1-0' ), NL; //➀-⓪
//echo getPitchAccentString( '4 3' ), NL; //➀-⓪
//echo hexdec( '309F' );
//echo( isRomaji( '食べるru' ) ? "Romaji" : "Not Romaji" ), NL;
//echo( isKana( '食べるru' ) ? "Kana" : "Not Kana" ), NL;
//echo( isKana( 'ru' ) ? "Kana" : "Not Kana" ), NL;
//echo( isKana( 'べる' ) ? "Kana" : "Not Kana" ), NL;
//echo( isKana( '食べる' ) ? "Kana" : "Not Kana" ), NL;


$source = file_get_contents( 'https://wadoku.de/entry/view/3772255' );


$entry_regex = '/<h1 class="middle"><span class="midashigo">(.)+<\/span><\/h1>/';
$matches = array();
preg_match_all( $entry_regex, $source, $matches );
//print_r( $matches );
if( $matches[ 0 ] )
{
	$result = strip_tags( $matches[ 0 ][ 0 ] );
	$result = str_replace( '【', '',
		str_replace( '】', '', $result ) );
	echo $result;
}
?>