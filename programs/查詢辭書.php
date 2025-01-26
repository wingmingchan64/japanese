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
//require_once( "h:\\github\\japanese\\programs\\常數.php" );
ini_set('memory_limit', '-1');

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
$meaning_regex = '/<span class="meaning-definition-section_divider">(\d+\. )<\/span><span class="meaning-meaning">([^<]+)<\/span>/';
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
	
	$new_contents = '';

	echo $matches[ 1 ][ 0 ] . ' ' . 
		str_replace( ';', ',', str_replace( '&#39;',"'", $matches[ 2 ][ 0 ] ) ) . NL;
		
	$new_contents .= str_replace( ';', ',', str_replace( '&#39;',"'", $matches[ 2 ][ 0 ] ) ) . '; ';
	
	for( $i = 1; $i < sizeof( $matches[ 1 ] ); $i++ )
	{
		if( $matches[ 1 ][ $i ] == '1.' )
		{
			break;
		}
		echo $matches[ 1 ][ $i ] . ' ' . 
			str_replace( ';', ',', str_replace( '&#39;',"'", $matches[ 2 ][ $i ] ) ) . NL;
		$new_contents .= str_replace( ';', ',', str_replace( '&#39;',"'", $matches[ 2 ][ $i ] ) ) . '; ';
	}
	
	// unicode delimiter
	//logToFile( 'H:\japanese\programs\jisho\new_contents.txt',
		//$kanji . '：' . $new_contents );
}
else
{
	echo "$詞條 Not found", NL;
}

echo NL, "wadoku.de:", NL;
echo '=================================' . NL;

require_once( 'H:\japanese\programs\wadoku\id_xml_entry.php' );
require_once( 'H:\japanese\programs\wadoku\kana_id.php' );
require_once( 'H:\japanese\programs\wadoku\kanji_id.php' );

$entry_xml = '';
$entry_xml = $id_xml_entry[ $kanji_id[ $kanji ] ];
if( $entry_xml != '' )
{
	$entry_element = new SimpleXMLElement( $entry_xml );
	$marker = 
		getPitchAccentString( 
			$entry_element->form->reading->accent );
	echo "Pitch accent: " . $kanji, '[', $kana, $marker, '] '
		 . NL;

	$meaning = '';
	$meaning = $entry_element->sense->saveXML();
	if( $meaning != '' )
	{
		echo NL . "Meaning:" . NL;
		//echo $meaning;
		if( strpos( $meaning, '</text>' ) !== false )
		{
			$meaning = str_replace( '</text>', NL, $meaning );
		}
		$meaning_array = explode( NL, strip_tags( $meaning ) );
		
		foreach( $meaning_array as $index => $m_string )
		{
			if( $m_string != '' )
			{
				echo intval( $index )+1 . ".  " . $m_string . NL;
			}
		}
	}
}

$jd詞條 = urlencode( $kanji );
$japandict_url = "https://www.japandict.com/${jd詞條}?lang=eng";
$ana_matches = array();
$eng_matches = array();

$sentence_regex = '/<div class="btn-group d-flex text-nowrap flex-wrap" role="group" aria-label="Sentence analysis"><a.+?<\/a><\/div>/';
$eng_regex = '/<div class="tab-pane p-3 active" id="eng-\d+" role="tabpanel">([^<]+)<\/div>/';

if( url_check( $japandict_url ) )
{
	echo NL, "JapanDict:", NL;
	echo '=================================' . NL;
	echo 'Examples:', NL;

	$source = file_get_contents( $japandict_url );
	$source = str_replace( NL, '', $source );
	preg_match_all( $sentence_regex, $source, $ana_matches );
	preg_match_all( $eng_regex, $source, $eng_matches );
	
	// print_r( $matches );
	if( $ana_matches[ 0 ] && $eng_matches[ 0 ] )
	{
		for( $i = 0; $i < sizeof( $ana_matches[ 0 ] ); $i++ )
		{
			echo strip_tags( $ana_matches[ 0 ][ $i ] ), NL;
			$ana_sentence = 
				str_replace( '</a>', '  ', 
				$ana_matches[ 0 ][ $i ] );
			echo strip_tags( $ana_sentence ), NL;
			echo str_replace(
				'&#39;', "'",
				trim( $eng_matches[ 1 ][ $i ] ) ), NL, NL;
		}
	}
	//preg_match_all( $eng_regex, $source, $matches );
}
else
{
	echo "The site cannot be reached" . NL;
}

?>