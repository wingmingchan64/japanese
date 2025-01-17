<?php
/*
get the meaning of words from japandict
php H:\github\japanese\programs\process_japandict.php
*/
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

//checkARGV( $argv, 2, "必須提供詞： " );
const NL = "\r\n";

$contents = file_get_contents( 'H:\github\japanese\programs\difference.txt' );
$terms = explode( "\r\n", $contents );
$div_regex = '/<div lang="en">([^<]+)<\/div>/';
$rj_regex = '/<div class="xxsmall text-muted text-center mt-2">([^<]+)<\/div>/';
$counter = 0;

foreach( $terms as $詞 )
{
	$counter++;
	$詞 = trim( $詞 );
	//$詞 = '食べる';
	//$詞 = trim( $argv[ 1 ] );
	$url = "https://www.japandict.com/${詞}?lang=eng";
	$matches = array();

	if( url_check( $url ) )
	{
		$str = file_get_contents( $url );
		preg_match_all( $rj_regex, $str, $matches );
		$rj = '';
		if( $matches[ 1 ][ 0 ] )
		{
			$rj = trim( $matches[ 1 ][ 0 ] );
		}

		preg_match_all( $div_regex, $str, $matches );
		//print_r( $matches[ 1 ] );
		$result = "'$詞'=>array('rj'=>'$rj','meaning'=>\"";
		
		foreach( $matches[ 1 ] as $meaning )
		{
			$meaning_line = trim( str_replace( "\"", "\\\"", $meaning ) );
			$result .= $meaning_line . "]";
		}
		$result .= "\"),";
		file_put_contents(
			'H:\github\japanese\programs\44998_def.txt', 
			$result.PHP_EOL, 
			FILE_APPEND | LOCK_EX );
	}
	else
	{
		file_put_contents(
			'H:\github\japanese\programs\not_in_japandict.txt', 
			$詞.PHP_EOL, 
			FILE_APPEND | LOCK_EX );
		echo $詞, "\r\n";
	}
	if( $counter > 9999 )
	{
		exit;
	}
}

function url_check( $url )
{ 
    $headers = @get_headers( $url ); 
    return is_array( $headers ) ? 
		preg_match( '/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',
			$headers[ 0 ]) : false; 
}
function checkARGV( array $argv, int $num, string $msg )
{
	if( sizeof( $argv ) != $num )
	{
		echo $msg, NL;
		exit;
	}
}

?>