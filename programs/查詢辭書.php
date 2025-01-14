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
php H:\github\japanese\programs\查詢辭書.php ドイツ人
php H:\github\japanese\programs\查詢辭書.php モーラ
php H:\github\japanese\programs\查詢辭書.php パーソナル･コンピューター

Hiragana Range: 3040–309F
Katakana Range: 30A0–30FF
*/
require_once( "h:\\github\\japanese\\programs\\常數.php" );
require_once( "h:\\github\\japanese\\programs\\函式.php" );

checkARGV( $argv, 2, 輸入詞條 );
$詞條 = trim( $argv[ 1 ] );
$js詞條 = $詞條;
$wd詞條 = $詞條;
$詞條屬性 = ( isRomaji( $詞條 ) ? 'Romaji' : 
	( isKana( $詞條 ) ? 'Kana' : 'Kanji' )
);
if( $詞條屬性 == 'Kana' )
{
	$js詞條 = str_replace( '･', '', $詞條 );
	//echo $js詞條, NL;
}

$詞條 = urlencode( $詞條 );
$js詞條 = urlencode( $js詞條 );

$jisho_url = "https://jisho.org/search/${js詞條}";
$title_regex = '/<title>([^<]+)<\/title>/';
$kana_regex = '/<span class="hilite_1">([^<]+)<\/span>/';
$span_text_regex = '/<span class="text">([^<]+)<span>([^<]+)<\/span>/';
$sentence_search_regex = '/Sentence search for ([^<]+)/';
$meaning_regex = '/<span class="meaning-definition-section_divider">(\d\. )<\/span><span class="meaning-meaning">([^<]+)<\/span>/';
$matches = array();

if( url_check( $jisho_url ) )
{
	$source = file_get_contents( $jisho_url );
	$sentence = '';
	$kana = '';
	$kanji = '';
	$romaji = '';
	$org = '';
	$search = '';
	
	if( $詞條屬性 == 'Romaji' )
	{
		preg_match_all( $kana_regex, $source, $matches );
		if( $matches[ 1 ] )
		{
			$kana = trim( $matches[ 1 ][ 0 ] );
			//echo "kana: ", $kana, NL;
		}
	}
		
	preg_match_all( $title_regex, $source, $matches );
	if( $matches[ 1 ] )
	{
		$titles = explode( '-', $matches[ 1 ][ 0 ] );
		$org = trim( $titles[ 1 ] ) . ':' . NL;
		$org .= '=================================' . NL;
		$search = trim( $titles[ 0 ] );
		//echo "search: ", $search, NL;
		if( isRomaji( $search ) && $romaji == '' )
		{
			$romaji = $search;
		}
		elseif( isKana( $search ) )
		{
			$kana = $search;
		}
		elseif( $search != '' )
		{
			$kanji = $search;
		}
		
		if( $search != '' )
		{
			$search .= ' ';
		}
	}
	
	preg_match_all( $sentence_search_regex, $source, $matches );
	if( $matches[ 1 ] )
	{
		$sentence = trim( $matches[ 1 ][ 0 ] );
		
		if( $matches[ 1 ][ 0 ] == trim( $search ) )
		{
			$sentence = trim( $matches[ 1 ][ 1 ] );
			if( isKana( $sentence ) && $kana == '' )
			{
				$kana = $sentence;
			}
		}

		$sentence .= ' ';
		//echo "sentence: ", $sentence, NL;
	}
	
	// input romaji, $search is romaji
	if( $kana != '' && $kanji == '' &&
		!isKana( trim( $sentence ) ) && !isRomaji( trim( $sentence ) ) ) 
	{
		$kanji = trim( $sentence );
	}

	if( trim( $sentence ) == trim( $search ) )
	{
		$search = '';
	}

	echo NL, $org, $kanji, '[', $kana, '] ', $romaji, NL, NL;

	preg_match_all( $span_text_regex, $source, $matches );

	if( !$matches[ 0 ] )
	{
		echo "$詞條 Not found", NL;
	}
	elseif( !$matches[ 1 ] )
	{
		echo "$詞條 Not found", NL;
	}

	preg_match_all( $meaning_regex, $source, $matches );
	echo $matches[ 1 ][ 0 ] . ' ' . 
		str_replace( '&#39;',"'", $matches[ 2 ][ 0 ] ) . NL;
	
	for( $i = 1; $i < sizeof( $matches[ 1 ] ); $i++ )
	{
		if( $matches[ 1 ][ $i ] == '1.' )
		{
			break;
		}
		echo $matches[ 1 ][ $i ] . ' ' . 
			str_replace( '&#39;',"'", $matches[ 2 ][ $i ] ) . NL;
	}
}
else
{
	echo "$詞條 Not found", NL;
}

//echo "kanji: $kanji", NL;
if( $kanji != '' )
{
	$詞條 = urlencode( trim( $kanji ) );
}
$wadoku_url = "https://wadoku.de/search/${詞條}";
$id  = '';
$view_regex = '/href="\/entry\/view\/(\d+)"/';
$meaning_regex = '/<section class="senses">(.)+?<\/section>/';

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
			//echo $source;
			$entry_regex = '/<h1 class="middle"><span class="midashigo">(.)+<\/span><\/h1>/';
			$accent_regex = '/data-accent-id="1">([^<])+<\/small>/';
			$entry = '';
			$kana = '';
			
			preg_match_all( $entry_regex, $source, $matches );
			//print_r( $matches );
			
			if( $matches[ 0 ] )
			{
				$entry = strip_tags( $matches[ 0 ][ 0 ] );
				$entry = str_replace( '【', '',
					str_replace( '】', '', $entry ) );
				echo $entry;
			}

			preg_match_all( $accent_regex, $source, $matches );
			
			if( $matches[ 0 ] )
			{
				echo NL, "wadoku.de:", NL;
				echo '=================================' . NL;

				echo "Pitch accent: " . 
					getPitchAccentString( 
						trim( $matches[ 1 ][ 0 ] ) ) . NL;
				
				$romaji_regex = '/"ja-latn">([^<]+)<\/small>/';
				preg_match_all( $romaji_regex, $source, $matches );
				if( $matches[ 0 ] )
				{
					echo "Romaji: " . $matches[ 1 ][ 0 ] . NL . NL;
				}
			}
			
			preg_match_all( $meaning_regex, $source, $matches );
			
			if( $matches[ 0 ] )
			{
				$str = strip_tags( $matches[ 0 ][ 0 ] );
				$str = str_replace( '&nbsp;', ' ', $str );
				$str = preg_replace( '/(\d)/', "\r\n\${1}. ", $str );
				//print_r( $str_array );
				echo $str, NL, NL;
			}
			//print_r( $matches );
		}
		/*
		if( $kanji != '' )
		{
			$log_content = $kanji;
		}
		elseif( $kana != '' )
		{
			$log_content = $kana;
		}
		elseif( $romaji != '' )
		{
			$log_content = $romaji;
		}
		else
		{
			$log_content = $wd詞條;
		}
		*/
		
		$log_content = $entry . ',' . $id;
		echo "Log: " . $log_content, NL, NL;
		logToFile(
			'H:\github\japanese\programs\entry_id_log.txt',
			$log_content );
	}
}

$japandict_url = "https://www.japandict.com/${js詞條}?lang=eng";
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