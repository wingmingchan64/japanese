<?php
/*
php H:\japanese\programs\wadoku\生成和獨羅馬字假名漢字.php
*/
require_once( 'H:\github\japanese\programs\函式.php' );
require_once( 'H:\japanese\programs\wadoku\data\和獨假名_漢字.php' );
require_once( 'H:\japanese\programs\wadoku\data\和獨詞條_accent.php' );
require_once( 'H:\japanese\programs\kana_romaji_lookup.php' );

$羅假漢_array = array();
$羅假漢_contents = "<?php
\$和獨羅馬字_假名_漢字=array(
";
$假名s = array_keys( $和獨假名_漢字 );
$accent = '';

foreach( $假名s as $假名 )
{
	$羅馬字 = convertKanaToRomaji( $假名, $拗音, $一般假名, $促音 );
	$漢字s = explode( ',', $和獨假名_漢字[ $假名 ] );
	$羅假漢_array[ $羅馬字 ] = array();

	foreach( $漢字s as $漢字 )
	{
		$漢字 = cleanUpWadokuOutputString( $漢字 );
		if( array_key_exists( $漢字, $和獨詞條_accent ) )
		{
			$accent = getWadokuAccentMarker(
				$和獨詞條_accent[ $漢字 ], $和獨詞條_accent );
		}
		array_push( $羅假漢_array[ $羅馬字 ], "${漢字}[${假名}${accent}]" );
		$accent = '';
	}
}

foreach( $羅假漢_array as $羅 => $假漢s )
{
	//$假漢str = implode( ',', $假漢s );
	$假漢str = implode( DELIMITER, $假漢s );
	$line = "\"$羅\"=>\"$假漢str\",\r\n";
	$羅假漢_contents .= $line;
}

$羅假漢_contents .= 
");
?>";

file_put_contents( 'H:\japanese\programs\wadoku\data\和獨羅馬字_假名_漢字.php',
$羅假漢_contents );

?>