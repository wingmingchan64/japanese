<?php
/*
漢字→含此漢字詞條 accent_kana
*/
ini_set('memory_limit', '-1');
require_once( 'H:\github\japanese\programs\函式.php' );
require_once( 'H:\japanese\programs\wadoku\data\和獨id_詞條_假名_accent.php' );
require_once( 'H:\japanese\programs\wadoku\data\和獨詞條_id.php' );
require_once( 'H:\japanese\programs\wadoku\data\和獨假名_id.php' );
require_once( 'H:\japanese\programs\wadoku\data\和獨漢字、含漢字詞條id.php' );
require_once( 'H:\japanese\programs\kana_romaji_lookup.php' );

checkARGV( $argv, 3, 輸入漢字詞 );
$form   = trim( $argv [ 1 ] );
$kanji  = trim( $argv [ 2 ] );
$result = array();

if( array_key_exists( $kanji, $和獨漢字、含漢字詞條id ) )
{
	$ids = $和獨漢字、含漢字詞條id[ $kanji ];
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