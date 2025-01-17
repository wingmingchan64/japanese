<?php
/*
data from https://tangorin.com/
php H:\github\japanese\programs\漢字、假名→音調標記.php taberu
*/
require_once( "h:\\github\\japanese\\programs\\常數.php" );
require_once( "h:\\github\\japanese\\programs\\函式.php" );

checkARGV( $argv, 2, 輸入漢字、假名詞 );
$entry = trim( $argv[ 1 ] );

require_once( "h:\\github\\japanese\\programs\\wadoku_entry_accent.php" );
if( array_key_exists( $entry, $wadoku_entry_accent ) )
{
	$num = $wadoku_entry_accent[ $entry ];
	echo $num . ' ' . getPitchAccentString( $num );
}
else
{
	echo 無此漢字、假名詞;
}
?>