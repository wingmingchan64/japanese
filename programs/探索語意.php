<?php
/*
php H:\github\japanese\programs\探索語意.php omou
*/
require_once( '函式.php' );

checkARGV( $argv, 2, "必須提供詞的羅馬字： " );
require_once( 'H:\github\japanese\programs\tangorin_dict.php' );

print_r( $tangorin_dict[ trim( $argv[ 1 ] ) ] );

?>