<?php
/*
php H:\japanese\programs\wadoku\生成和獨假名漢字.php
*/
require_once( 'H:\github\japanese\programs\函式.php' );

$data_str = file_get_contents( 
	'H:\japanese\programs\wadoku\data\和獨id_詞條_假名_accent.txt' );
$data = explode( NL, $data_str );
$kana_kanji_array = array();
$kana_kanji_contents = "<?php
\$和獨假名_漢字=array(
";

foreach( $data as $line )
{
	//$count++;
	if( $line == '' )
		continue;
	$parts  = explode( DELIMITER, $line );
	$kana  = trim( $parts[ 2 ] );
	$kanji = trim( $parts[ 1 ] );
	$kanji = cleanUpWadokuOutputString( $kanji );
	
	if( !array_key_exists( $kana, $kana_kanji_array ) )
	{
		$kana_kanji_array[ $kana ] = array( $kanji );
	}
	else
	{
		if( !in_array( $kanji, $kana_kanji_array[ $kana ] ) )
		{
			array_push( $kana_kanji_array[ $kana ], $kanji );
		}
	}
}

foreach( $kana_kanji_array as $kana => $kanjis )
{
	$new_kanjis = implode( DELIMITER, $kanjis );
	$pair = "\"$kana\"=>\"$new_kanjis\"," . NL;
	$kana_kanji_contents .= $pair;
}

$kana_kanji_contents .= 
");
?>";

file_put_contents( 'H:\japanese\programs\wadoku\data\和獨假名_漢字.php',  $kana_kanji_contents );

?>