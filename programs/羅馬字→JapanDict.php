<?php
/*
php H:\japanese\programs\japandict\羅馬字→JapanDict.php
*/
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

require_once( 'H:\github\japanese\programs\函式.php' );
require_once( 'H:\japanese\programs\japandict\japandict_romaji_id.php' );
require_once( 'H:\japanese\programs\japandict\japandict_id_def.php' );

checkARGV( $argv, 2, 輸入羅馬字詞 );

$romaji = trim( $argv[ 1 ] );

if( array_key_exists( $romaji, $japandict_romaji_id ) )
{
	$id_strs = array();
	$ids = $japandict_romaji_id[ $romaji ];
	// more than 1 id
	if( strpos( $ids, ',' ) !== false )
	{
		$id_strs = explode( ',', $ids );
	}
	else // only 1 id
	{
		$id_strs = array( $ids );
	}
	if( sizeof( $id_strs ) > 1 )
	{
		echo NL, '**********', NL, NL;
	}
	else
	{
		echo NL;
	}
	
	foreach( $id_strs as $id_str )
	{
		$def = $japandict_id_def[ $id_str ];
		$def = trim( $def );
		$def = substr( $def, 0, strlen( $def ) - 1 );
		$defs = explode( ';', $def );
		
		foreach( $defs as $key => $def )
		{
			echo $key + 1 . '. ' . trim( $def ) . NL;
		}
		
		if( sizeof( $id_strs ) > 1 )
		{
			echo NL, '**********', NL, NL;
		}
	}
}
else
{
	echo "Entry not found", NL;
}
?>