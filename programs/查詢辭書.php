<?php
/*
php H:\github\japanese\programs\查詢辭書.php kawaii
php H:\github\japanese\programs\查詢辭書.php taberu
php H:\github\japanese\programs\查詢辭書.php たべる
php H:\github\japanese\programs\查詢辭書.php 食べる

*/
require_once( "h:\\github\\japanese\\programs\\常數.php" );
require_once( "h:\\github\\japanese\\programs\\函式.php" );

checkARGV( $argv, 2, 輸入詞條 );
$詞條 = urlencode( trim( $argv[ 1 ] ) );

$jisho_url = "https://jisho.org/search/${詞條}";
$title_regex = '/<title>([^<]+)<\/title>/';
$kana_regex = '/<span class="hilite_1">([^<]+)<\/span>/';
$span_hit_regex = '/<span class="hit">([^<]+)<\/span>/';
$span_text_regex = '/<span class="text">([^<]+)<span>([^<]+)<\/span>/';
$sentence_search_regex = '/Sentence search for ([^<]+)/';
$meaning_regex = '/<span class="meaning-definition-section_divider">(\d\. )<\/span><span class="meaning-meaning">([^<]+)<\/span>/';
$matches = array();

if( url_check( $jisho_url ) )
{
	$source = file_get_contents( $jisho_url );
	$sentence = '';
	$kana = '';
	$org = '';
	$hit = '';
	$search = '';
	
	preg_match_all( $kana_regex, $source, $matches );
	if( $matches[ 1 ] )
	{
		$kana = trim( $matches[ 1 ][ 0 ] );
		//echo "kana: ", $kana, NL;
		//print_r( $matches );
	}
	
	preg_match_all( $span_hit_regex, $source, $matches );
	if( $matches[ 1 ] )
	{
		$hit = trim( $matches[ 1 ][ 0 ] );
		//echo "hit: ", $hit, NL;
	}
	
	//print_r( $matches );
	
	preg_match_all( $title_regex, $source, $matches );
	if( $matches[ 1 ] )
	{
		$titles = explode( '-', $matches[ 1 ][ 0 ] );
		$org = trim( $titles[ 1 ] ) . ':' . NL;
		$search = trim( $titles[ 0 ] );
		//echo "search: ", $search, NL;
		
		if( $search != '' )
		{
			$search .= ' ';
		}
		if( $kana != '' )
		{
			$kana .= ' ';
		}
		if( $hit != '' )
		{
			$hit .= ' ';
		}
	}
	preg_match_all( $sentence_search_regex, $source, $matches );
	if( $matches[ 1 ] )
	{
		$sentence = trim( $matches[ 1 ][ 0 ] );
		
		if( $matches[ 1 ][ 0 ] == trim( $search ) )
		{
			$sentence = trim( $matches[ 1 ][ 1 ] );
		}
		$sentence .= ' ';
		//print_r( $matches );
		//echo "sentence: ", $sentence, NL;
	}
	if( trim( $hit ) == trim( $sentence ) )
	{
		$hit = '';
	}
	if( trim( $hit ) == trim( $search ) )
	{
		$hit = '';
	}
	if( trim( $sentence ) == trim( $search ) )
	{
		$search = '';
	}

	echo $org, $sentence, $hit, $search, $kana, NL;

	preg_match_all( $span_text_regex, $source, $matches );

	if( !$matches[ 0 ] )
	{
		echo "$詞條 Not found", NL;
	}
	elseif( !$matches[ 1 ] )
	{
		echo "$詞條 Not found", NL;
	}
	else
	{
		$search = trim( $matches[ 1 ][ 0 ] ) 
			. trim( $matches[ 2 ][ 0 ] );
		//echo $search, NL;
	}

	preg_match_all( $meaning_regex, $source, $matches );
	echo $matches[ 1 ][ 0 ] . ' ' . $matches[ 2 ][ 0 ] . NL;
	
	for( $i = 1; $i < sizeof( $matches[ 1 ] ); $i++ )
	{
		if( $matches[ 1 ][ $i ] == '1.' )
		{
			break;
		}
		echo $matches[ 1 ][ $i ] . ' ' . $matches[ 2 ][ $i ] . NL;
	}
	//print_r( $matches );
}
else
{
	echo "$詞條 Not found", NL;
}

$wadoku_url = "";

?>