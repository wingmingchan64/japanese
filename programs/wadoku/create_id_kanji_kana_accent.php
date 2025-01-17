<?php
/*
php H:\japanese\programs\wadoku\create_id_kanji_kana_accent.php
*/
ini_set( 'memory_limit', '-1' );
require_once( 'H:\github\japanese\programs\函式.php' );

$xml_str = file_get_contents( 
	'H:\japanese\programs\wadoku\wadoku.xml' );
$entries = new SimpleXMLElement( $xml_str );
$line = '';
foreach( $entries as $entry )
{
	$line = trim( $entry[ 'id' ] ) . DELIMITER .
		trim( $entry->form->orth[ 0 ] ) . DELIMITER .
		trim( $entry->form->reading->hira ) . DELIMITER .
		trim( $entry->form->reading->accent );
	// write one line at a time so that the program
	// can be stopped anywhere and resume later
	// the program can crash when it is run
	$line = cleanUpWadokuString( $line );
	logToFile( 
		'H:\japanese\programs\wadoku\id_kanji_kana_accent.txt', 
		$line );
}
?>