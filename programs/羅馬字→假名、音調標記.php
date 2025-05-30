<?php
/*
php H:\github\japanese\programs\羅馬字→假名、音調標記.php taberu
*/
require_once( "h:\\github\\japanese\\programs\\常數.php" );
require_once( "h:\\github\\japanese\\programs\\函式.php" );

checkARGV( $argv, 2, 輸入羅馬字詞 );

require_once( 'H:\github\japanese\programs\japandict\japandict_romaji_kana.php' );
require_once( 'H:\japanese\programs\wadoku\data\和獨詞條_accent.php' );
require_once( 'H:\japanese\programs\kana_romaji_lookup.php' );

$term = trim( $argv [ 1 ] );

if( array_key_exists( $term, $japandict_romaji_kana ) )
{
	$str = $japandict_romaji_kana[ $term ];
	
	if( array_key_exists( $str, $和獨詞條_accent ) )
	{
		$num = $和獨詞條_accent[ $str ];
		$str .= getPitchAccentString( $num, $markers );
	}
	$str .= NL;
	echo $str;
}
else
{
	echo 無此漢字詞;
}
?>