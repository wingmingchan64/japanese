<?php
/*
php H:\japanese\programs\wadoku\生成和獨_列表.php
*/
require_once( 'H:\github\japanese\programs\函式.php' );


// entry accent
/*
$contents = file_get_contents(
	'H:\japanese\programs\wadoku\data\和獨id_詞條_假名_accent.txt' );
$lines = explode( NL, $contents );
$result = '';
$result_array = array();
$count = 0;
$kanji_kana = '';
$hira = '';
$accent = '';

foreach( $lines as $line )
{
	$count++;

	//echo $line, NL;
	$parts = explode( DELIMITER, trim( $line ) );
	//print_r( $parts );
	
	if( sizeof( $parts ) == 4 )
	{
		$kanji_kana = trim( $parts[ 1 ] );
		$hira = trim( $parts[ 2 ] );
		$accent = trim( $parts[ 3 ] );
		
		if( $accent == '' )
		{
			continue;
		}
		//echo "kanji_kana: " . $kanji_kana. NL;
		
		if( !array_key_exists( $kanji_kana, $result_array ) )
		{
			$result_array[ $kanji_kana ] = array( $accent );
		}
		else
		{
			if( !in_array( $accent, $result_array[ $kanji_kana ] ) )
			{
				array_push( $result_array[ $kanji_kana ], $accent );
			}
		}
		if( !array_key_exists( $hira, $result_array ) )
		{
			//$result_array[ $kanji_kana ] = $accent;
			$result_array[ $hira ] = array( $accent );
		}
		else
		{
			if( !in_array( $accent, $result_array[ $hira ] ) )
			{
				array_push( $result_array[ $hira ], $accent );
			}
		}
	}
	//echo $count;
}

foreach( $result_array as $k => $v_array )
{
	$v = implode( ',', $v_array );
	$result .= "\"${k}\"=>'${v}'," . NL;
}

file_put_contents(
	'H:\japanese\programs\wadoku\data\和獨詞條_accent.txt',
	$result );
*/

// find all characters
/*
$contents = file_get_contents( 'H:\japanese\programs\wadoku\entries.txt' );
$lines = explode( NL, $contents );
$count = 0;
$symbols = array();
$file = '';

foreach( $lines as $line )
{
	$count++;
	$line = trim( $line );
	$len = mb_strlen( $line );
	
	for( $i=0; $i<$len; $i++ )
	{
		$char = mb_substr( $line, $i, 1 );
		if( !in_array( $char, $symbols ) )
		{
			array_push( $symbols, $char );
		}
	}
}
sort( $symbols );

foreach( $symbols as $s )
{
	$file .= $s . NL;
}
//print_r( $symbols );
//echo sizeof( $symbols );
file_put_contents( 'H:\japanese\programs\wadoku\symbols.txt', $file );
*/

?>