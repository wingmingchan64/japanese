<?php
/*
php H:\japanese\programs\wadoku\生成和獨漢字_id.php
*/
require_once( 'H:\github\japanese\programs\函式.php' );

$data_str = file_get_contents( 
	'H:\japanese\programs\wadoku\data\和獨id_詞條_假名_accent.txt' );
$data = explode( NL, $data_str );
$kanji_array = array();
$kana_array = array();
$kanji_contents = "<?php
\$和獨漢字_id=array(
";
$kana_contents = "<?php
\$和獨假名_id=array(
";
$contents1 = '';
$contents2 = '';

$count = 0;

foreach( $data as $line )
{
	$count++;
	if( $line == '' )
		continue;
	$parts = explode( DELIMITER, $line );
	//print_r( $parts );
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
/*
	if( $count > 30 )
		break;
*/
}
foreach( $kanji_array as $kanji => $id )
{
	$pair = "\"$kanji\"=>\"$id\"," . NL;
	$contents1 .= $pair;
}

foreach( $kana_array as $kana => $id )
{
	$pair = "\"$kana\"=>\"$id\"," . NL;
	$contents2 .= $pair;
}

$kanji_contents .= cleanUpWadokuOutputString( $contents1 ) .
");
?>";
$kana_contents .= cleanUpWadokuOutputString( $contents2 ) .
");
?>";

file_put_contents( 'H:\japanese\programs\wadoku\data\和獨漢字_id.php',  $kanji_contents );
file_put_contents( 'H:\japanese\programs\wadoku\data\和獨假名_id.php',  $kana_contents );
?>