<?php
/*
php H:\github\japanese\programs\漢字→假名.php 毅然
*/
require_once( "h:\\github\\japanese\\programs\\常數.php" );
require_once( "h:\\github\\japanese\\programs\\函式.php" );

checkARGV( $argv, 2, 輸入漢字詞 );

require_once( "h:\\github\\japanese\\programs\\常用字.php" );
require_once( "h:\\github\\japanese\\programs\\kanji_kana.php" );
$term = trim( $argv [ 1 ] );

if( mb_strlen( $term ) == 1 && array_key_exists( $term, $常用字 ) )
{
	$arrays = $常用字[ $term ];
	$result = array();
	foreach( $arrays as $arr )
	{
		array_push( $result, $arr[ 0 ] );
	}
	print_r( $result );
}
elseif( in_array( $term, array_keys( $kanji_kana ) ) )
{
	print_r( $kanji_kana[ $term ] );
}
else
{
	echo 無此漢字詞;
}
?>