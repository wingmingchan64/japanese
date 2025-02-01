<?php
/*
php H:\japanese\programs\wadoku\生成和獨id_xml_entry.php

This file creates the id=>entry_xml map of the wadoku database.
*/
ini_set('memory_limit', '-1');
require_once( 'H:\github\japanese\programs\函式.php' );

$xml_str = file_get_contents( 
	'H:\japanese\programs\wadoku\wadoku.xml' );
$entries = new SimpleXMLElement( $xml_str );
$contents = "<?php
\$和獨id_xml_entry=array(" . NL;
foreach( $entries as $entry )
{
	$id = trim( $entry[ 'id' ] );
	$xml = cleanUpWadokuXML( $entry->saveXML() );
	$contents .= "'${id}'=>\"${xml}\"," . NL;
}
$contents .= ");
?>
";
file_put_contents( 
    'H:\japanese\programs\wadoku\data\和獨id_xml_entry.php', $contents );
?>