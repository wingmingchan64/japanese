<?php
/*
php H:\github\japanese\programs\隨機句例.php
*/
$threshold = 5;
// read example sentences
$行s = 
	explode( "\r\n", file_get_contents( 'H:\github\japanese\programs\句例.txt' ) );
$句例s = array();
$results = array();

foreach( $行s as $行 )
{
	if( $行 != '' )
	{
		array_push( $句例s, 
			array( explode( ',', $行 ) ) );
	}
}
//$句例s[ 0 ][ 1 ]++; // strings can be incremented
print_r( $句例s );

?>