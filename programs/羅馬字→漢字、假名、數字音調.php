<?php
/*
羅馬字→漢字、假名、數字音調 accent_num     往く[いく⓪]
羅馬字→漢字、假名、數字音調 accent_kana    食べる[た/べ\る]
羅馬字→漢字、假名、數字音調 accent_romaji  逝く[いく] i/ku
*/
ini_set('memory_limit', '-1');
require_once( 'H:\github\japanese\programs\函式.php' );
require_once( 'H:\japanese\programs\wadoku\data\和獨id_詞條_假名_accent.php' );
require_once( 'H:\japanese\programs\wadoku\data\和獨詞條_id.php' );
require_once( 'H:\japanese\programs\wadoku\data\和獨假名_id.php' );
require_once( 'H:\japanese\programs\wadoku\data\和獨羅馬字_id.php' );
require_once( 'H:\japanese\programs\kana_romaji_lookup.php' );

checkARGV( $argv, 3, 輸入羅馬字詞 );
$form   =  trim( $argv [ 1 ] );
$romaji = trim( $argv [ 2 ] );
$result = array();

if( array_key_exists( $romaji, $和獨羅馬字_id ) )
{
	$ids = $和獨羅馬字_id[ $romaji ];
	$ids = explode( DELIMITER, $ids );
	foreach( $ids as $id )
	{
		$converted = convertTriplet(
			$和獨id_詞條_假名_accent[ $id ],
			$$form, MARKER_ARRAY,
			$prep, $拗音, $一般假名, $促音 );
		$result = array_merge( $result, $converted );
	}
}
print_r( $result );
?>