<?php
/*
data from https://tangorin.com/
php H:\github\japanese\programs\羅馬字→詞義.php taberu
*/
require_once( "h:\\github\\japanese\\programs\\常數.php" );
require_once( "h:\\github\\japanese\\programs\\函式.php" );

checkARGV( $argv, 2, 輸入羅馬字詞 );

require_once( "h:\\github\\japanese\\programs\\tangorin_dict.php" );
$term = trim( $argv [ 1 ] );

if( in_array( $term, array_keys( $tangorin_dict ) ) )
{
	echo $term, NL;
	print_r( $tangorin_dict[ $term ] );
}
else
{
	echo 無此漢字詞;
}
?>