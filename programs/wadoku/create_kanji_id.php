<?php
/*
php H:\japanese\programs\wadoku\create_kanji_id.php
*/
require_once( 'H:\github\japanese\programs\函式.php' );

$data_str = file_get_contents( 
	'H:\japanese\programs\wadoku\id_kanji_kana_accent.txt' );
$data = explode( NL, $data_str );
$kanji_array = array();
$kana_array = array();
$kanji_contents = "<?php
\$kanji_id=array(
";
$kana_contents = "<?php
\$kana_id=array(
";

foreach( $data as $line )
{
	//$count++;
	if( $line == '' )
		continue;
	$parts = explode( DELIMITER, $line );
	$id    = trim( $parts[ 0 ] );
	$kanji = trim( $parts[ 1 ] );
	$kana  = trim( $parts[ 2 ] );
	
	if( !array_key_exists( $kanji, $kanji_array ) )
	{
		$kanji_array[ $kanji ] = $id;
	}
	else
	{
		$kanji_array[ $kanji ] = $kanji_array[ $kanji ] . 
			DELIMITER . $id;
	}
	//echo $pair, NL;
	if( !array_key_exists( $kana, $kana_array ) )
	{
		$kana_array[ $kana ] = $id;
	}
	else
	{
		$kana_array[ $kana ] = $kana_array[ $kana ] . 
			DELIMITER . $id;
	}
}
foreach( $kanji_array as $kanji => $id )
{
	$pair = "\"$kanji\"=>\"$id\"," . NL;
	$kanji_contents .= $pair;
}

foreach( $kana_array as $kana => $id )
{
	$pair = "\"$kana\"=>\"$id\"," . NL;
	$kana_contents .= $pair;
}
$kanji_contents .= ");
?>";
$kana_contents .= ");
?>";

file_put_contents( 'H:\japanese\programs\wadoku\kanji_id.php', $kanji_contents );
file_put_contents( 'H:\japanese\programs\wadoku\kana_id.php', $kana_contents );
?>