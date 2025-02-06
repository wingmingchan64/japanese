<?php
/*
php H:\github\japanese\programs\weblio\下載weblio詞條.php 詰らない
*/
ini_set('memory_limit', '-1');
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
require_once( 'H:\github\japanese\programs\函式.php' );

checkARGV( $argv, 2, 輸入詞條 );
$entry = trim( $argv[ 1 ] );
$encoded_entry = urlencode( $entry );
$url = "https://www.weblio.jp/content/${encoded_entry}";
$entry_regex = '/<div class="kiji">([\s\S]+?)<br class=clr>/';
$entry_matches = array();

if( url_check( $url ) )
{
	$source = file_get_contents( $url );
	preg_match_all( $entry_regex, $source, $entry_matches );
	
	if( $entry_matches[ 1 ] )
	{
		file_put_contents( "H:\\japanese\\programs\\weblio\\data\\${entry}.html", $entry_matches[ 1 ][ 0 ] );
	}
	else
	{
		echo "Nothing matched", NL;
	}
}
else
{
    echo $entry . ' not found or URL not reachable!';
}
?>