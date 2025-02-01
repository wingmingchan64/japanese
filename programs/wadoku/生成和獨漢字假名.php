<?php
/*
php H:\japanese\programs\wadoku\生成和獨漢字假名.php
*/
require_once( 'H:\github\japanese\programs\函式.php' );

$data_str = file_get_contents( 
	'H:\japanese\programs\wadoku\data\和獨id_詞條_假名_accent.txt' );
$data = explode( NL, $data_str );
$kanji_kana_array = array();
$kanji_kana_contents = "<?php
\$和獨漢字_假名=array(
";

foreach( $data as $line )
{
	//$count++;
	if( $line == '' )
		continue;
	$parts  = explode( DELIMITER, $line );
	$kanji = trim( $parts[ 1 ] );
	$kana  = trim( $parts[ 2 ] );
	$kanji = cleanUpWadokuOutputString( $kanji );

	if( !array_key_exists( $kanji, $kanji_kana_array ) )
	{
		$kanji_kana_array[ $kanji ] = $kana;
	}
	else
	{
		if( is_string( $kanji_kana_array[ $kanji ] ) )
		{

			if( $kanji_kana_array[ $kanji ] == $kana )
			{
				continue;
			}
			else
			{
				$kanji_kana_array[ $kanji ] = array(
					$kanji_kana_array[ $kanji ], $kana );
			}
		}
		elseif( is_array( $kanji_kana_array[ $kanji ] ) )
		{
			if( !in_array($kana, $kanji_kana_array[ $kanji ] ) )
			{
				array_push( $kanji_kana_array[ $kanji ], $kana );
			}
		}
	}
}

foreach( $kanji_kana_array as $kanji => $kanas )
{
	if( is_array( $kanas ) )
	{
		$new_kanas = implode( DELIMITER, $kanas );
	}
	else
	{
		$new_kanas = $kanas;
	}
	$pair = "\"$kanji\"=>\"$new_kanas\"," . NL;
	$kanji_kana_contents .= $pair;
/*	
*/
}

$kanji_kana_contents .= 
");
?>";

file_put_contents( 'H:\japanese\programs\wadoku\data\和獨漢字_假名.php',  $kanji_kana_contents );

?>