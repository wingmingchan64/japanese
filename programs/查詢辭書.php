<?php
/*
php H:\github\japanese\programs\查詢辭書.php kawaii
php H:\github\japanese\programs\查詢辭書.php かわいい
php H:\github\japanese\programs\查詢辭書.php 可愛い
php H:\github\japanese\programs\查詢辭書.php taberu
php H:\github\japanese\programs\查詢辭書.php たべる
php H:\github\japanese\programs\查詢辭書.php 食べる
php H:\github\japanese\programs\查詢辭書.php atarashii
php H:\github\japanese\programs\查詢辭書.php あたらしい
php H:\github\japanese\programs\查詢辭書.php 新しい
私にとって子供たちは目の中に入れてもいたくないほどかわいいのです。
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
	$kanji = '';
	
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
		//$kanji = $hit;
	}
	
	//print_r( $matches );
	
	preg_match_all( $title_regex, $source, $matches );
	if( $matches[ 1 ] )
	{
		$titles = explode( '-', $matches[ 1 ][ 0 ] );
		$org = trim( $titles[ 1 ] ) . ':' . NL;
		$org .= '=================================' . NL;
		$search = trim( $titles[ 0 ] );
		echo "search: ", $search, NL;
		
		if( $kanji == '' )
		{
			//$kanji = $search;
		}
		
		if( $search != '' )
		{
			$search .= ' ';
		}
		
		if( mb_detect_encoding($kanji, ['ASCII'], false) == 'ASCII' )
		{
			//$kanji = trim( $search );
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
		if( mb_detect_encoding( $kanji, ['ASCII'], false) == 'ASCII' )
		{
			//$kanji = trim( $sentence );
		}

		$sentence .= ' ';
		//print_r( $matches );
		echo "sentence: ", $sentence, NL;
	}
	
	// input romaji, $search is romaji
	if( $kana != '' )
	{
		$kanji = trim( $sentence );
	}
	// input kana or kanji
	else
	{
		$kanji = ( ( mb_strlen( trim( $search ) ) >= mb_strlen( trim( $sentence ) ) ) ? $sentence : $search );
	}
/*
	if( trim( $hit ) == trim( $sentence ) )
	{
		$sentence = '';
	}
	if( trim( $hit ) == trim( $search ) )
	{
		$search = '';
	}
*/	
	if( trim( $sentence ) == trim( $search ) )
	{
		$search = '';
	}
	// $hit can be totally unrelated
	if( trim( $hit ) != trim( $sentence ) && 
		trim( $hit ) != trim( $search ) &&
		trim( $hit ) != trim( $kana ) )
		{
			$hit = '';
		}

	echo NL, $org, $sentence, $search, $kana, /* $hit, */ NL, NL;

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

//echo "kanji: $kanji", NL;
$詞條 = urlencode( trim( $kanji ) );
$wadoku_url = "https://wadoku.de/search/${詞條}";
$id  = '';

$view_regex = '/href="\/entry\/view\/(\d+)"/';
if( url_check( $wadoku_url ) )
{
	$source = file_get_contents( $wadoku_url );
	preg_match_all( $view_regex, $source, $matches );
	//print_r( $matches );
	if( $matches[ 1 ] )
	{
		$id = $matches[ 1 ][ 0 ];
		$wadoku_url = "https://wadoku.de/entry/view/${id}";
		
		if( url_check( $wadoku_url ) )
		{
			$source = file_get_contents( $wadoku_url );
			$accent_regex = '/data-accent-id="1">([^<])+<\/small>/';
			preg_match_all( $accent_regex, $source, $matches );
			
			if( $matches[ 0 ] )
			{
				echo NL, "wadoku.de:", NL;
				echo '=================================' . NL;

				echo "Pitch accent: " . $matches[ 1 ][ 0 ] . NL;
				
				$romaji_regex = '/"ja-latn">([^<]+)<\/small>/';
				preg_match_all( $romaji_regex, $source, $matches );
				if( $matches[ 0 ] )
				{
					echo "Romaji: " . $matches[ 1 ][ 0 ] . NL . NL;
				}
			}
		}
	}
}

$japandict_url = "https://www.japandict.com/${詞條}?lang=eng";
$ja_regex = '/<span lang="ja">([^<]+)<\/span>/';
$eng_regex = '/role="tabpanel">([^<]+)<\/div>/';
$analysis_regex = '/btn-word">([^<]+)<|mdshadow-0">([^<]+)<|btn-word disabled">([^<]+)</';
$analysis_array = array();

if( url_check( $japandict_url ) )
{
	$source = file_get_contents( $japandict_url );
	preg_match_all( $ja_regex, $source, $matches );
	//print_r( $matches );
	
	if( $matches[ 0 ] )
	{
		//print_r( $matches );
		
		$ja = "文例： " . trim( $matches[ 1 ][ 0 ] );
	
		preg_match_all( $eng_regex, $source, $matches );
		
		if( $matches[ 0 ] )
		{
			$eng = "英語： " . trim( $matches[ 1 ][ 0 ] );
			echo "JapanDict:", NL;
			echo '=================================' . NL;
			
			preg_match_all( $analysis_regex, $source, $matches );
			
			$analysis_array = $matches[ 1 ];
			//print_r( $matches );
			
			for( $i = 0; $i < sizeof( $analysis_array ); $i++ )
			{
				if( $analysis_array[ $i ] == '' )
				{
					if( $matches[ 2 ][ $i ] != '' )
						$analysis_array[ $i ] = $matches[ 2 ][ $i ];
					elseif( $matches[ 3 ][ $i ] != '' )
						$analysis_array[ $i ] = $matches[ 3 ][ $i ];
				}
			}
			
			$analysis = '';
			
			for( $i = 0; $i < sizeof( $analysis_array ); $i++ )
			{
				if( $analysis_array[ $i ] == '' )
				{
					$analysis_array[ $i ] = $matches[ 2 ][ $i ];
				}
				
				$analysis .= $analysis_array[ $i ] . '  ';
				$current = str_replace( '  ', '', $analysis );
				
				if( mb_strpos( $ja, $current ) === false )
				{
					$analysis = str_replace( 
						$analysis_array[ $i ], '', $analysis );
					break;
				}
			}

			
			$analysis = "分析： " . $analysis;
			
			echo $ja, NL, $analysis, NL, $eng, NL;
		}
	}
 
}
?>