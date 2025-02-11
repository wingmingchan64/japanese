<?php
/*
php H:\github\japanese\programs\生成含漢字詞條.php
*/
ini_set('memory_limit', '-1');
require_once( 'H:\github\japanese\programs\函式.php' );
//require_once( 'H:\japanese\programs\wadoku\data\和獨id_詞條_假名_accent.php' );
require_once( 'H:\japanese\programs\wadoku\data\和獨詞條_id.php' );
//require_once( 'H:\japanese\programs\wadoku\data\和獨假名_id.php' );
//require_once( 'H:\japanese\programs\wadoku\data\和獨假名_id.php' );
//require_once( 'H:\japanese\programs\kana_romaji_lookup.php' );
require_once( 'H:\github\japanese\programs\常用漢字.php' );

$result = array();
$常用字 = array_keys( $常用漢字 );

foreach( $常用字 as $字 )
{
	$result[ $字 ] = array();
}

foreach( $和獨詞條_id as $詞條 => $id )
{
	foreach( $常用字 as $字 )
	{
		//$首字 = mb_substr( $詞條, 0, 1 );
		$尾字 = mb_substr( $詞條, mb_strlen( $詞條 ) - 1, 1 );
		
		if( $字 == $尾字 &&
		//if( mb_strpos( $詞條, $字 ) !== false && 
			!in_array( $id, $result[ $字 ] ) )
		{
			array_push( $result[ $字 ], $id );
		}
	}
}

$contents = "<?php
/*
php H:\github\japanese\programs\生成含漢字詞條.php
*/
\$和獨漢字、尾字漢字詞條id=array(
";
foreach( $result as $字 => $ids )
{
	$ids = implode( DELIMITER, $ids );
	$line = "\"${字}\"=>\"${ids}\",\r\n";
	$contents .= $line;
}
$contents .= ");
?>";
file_put_contents( 'H:\japanese\programs\wadoku\data\和獨漢字、尾字漢字詞條id.php', $contents );
?>