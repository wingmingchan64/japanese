<?php
/*
data from https://tangorin.com/
php H:\github\japanese\programs\羅馬字→音調標記.php taberu
*/
require_once( "h:\\github\\japanese\\programs\\常數.php" );
require_once( "h:\\github\\japanese\\programs\\函式.php" );

checkARGV( $argv, 2, 輸入羅馬字詞 );

require_once( "h:\\github\\japanese\\programs\\romaji_kanji.php" );
$term = trim( $argv [ 1 ] );

if( array_key_exists( $term, $romaji_kanji ) )
{
	$kanji = $romaji_kanji[ $term ];
	$marker_regex = '/([⓪➀➁➂➃➄➅➆]+)/';
	$matches = array();
	preg_match_all( $marker_regex, $kanji, $matches );
	
	foreach( $matches[ 1 ] as $match )
	{
		$match = trim( $match );
		
		if( $match != '' )
		{
			if( mb_strlen( $match ) == 1 )
				echo $match;
			else
				for( $i = 0; $i < mb_strlen( $match ); $i++ )
					echo mb_substr( $match, $i, 1 ), "\r\n";
		}
	}
}
else
{
	echo 無此漢字詞;
}
?>