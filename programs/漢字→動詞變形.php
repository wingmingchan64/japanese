<?php
/*
php H:\github\japanese\programs\漢字→動詞變形.php 食べる
*/
require_once( "h:\\github\\japanese\\programs\\常數.php" );
require_once( "h:\\github\\japanese\\programs\\函式.php" );

checkARGV( $argv, 2, 輸入漢字詞 );
require_once( 'H:\github\japanese\programs\model\動詞表.php' );
$動詞  = trim( $argv [ 1 ] );
$組名s = array_keys( $動詞表 );

foreach( $組名s as $組名 )
{
	if( in_array( $動詞, $動詞表[ $組名 ] ) )
	{
		$model = $組名;
		$動詞陣列名 = $組名;
		// get the stem
		$stem = str_replace(
			mb_substr( $組名, mb_strlen( $組名 ) - 1 ), '', $動詞 );
		// when found, get out of the loop
		break;
		//$stem = str_replace( 'る', '', $動詞 );
	}
/*
if( in_array( $動詞, $動詞表[ '食べる' ] ) )
{
	$model = '食べる';
	$動詞陣列名 = '食べる';
	$stem = str_replace( 'る', '', $動詞 );
}
elseif( in_array( $動詞, $動詞表[ '飲む' ] ) )
{
	$model = '飲む';
	$動詞陣列名 = '飲む';
	$stem = str_replace( 'む', '', $動詞 );
}*/
	else
	{
		$model = 'する';
		$動詞陣列名 = "する";
		$stem = str_replace( 'する', '', $動詞 );
	}
}

require_once( "H:\\github\\japanese\\programs\\model\\${model}.php" );
print_r( $$動詞陣列名 );
?>