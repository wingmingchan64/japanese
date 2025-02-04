<?php
require_once( 'H:\github\japanese\programs\常數.php' );

set_error_handler( function ( 
	$severity, $message, $file, $line )
{
    throw new \ErrorException( $message, $severity, 	
		$severity, $file, $line );
});

function url_check( $url )
{ 
    $headers = @get_headers( $url ); 
    return is_array( $headers ) ? 
		preg_match( '/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',
			$headers[ 0 ]) : false; 
}

// check argv
function checkARGV( array $argv, int $num, string $msg )
{
	if( sizeof( $argv ) < $num )
	{
		echo $msg, NL;
		exit;
	}
}

// wadoku
/*
Wadoku entry XML structure
entry
 form
  orth+
 reading
  hira
  hatsuon
  accent
 gramGrp
 sense

code:
$entry_dom = new DOMDocument();
$entry_dom->loadXML( $xml );
print_r( $entry_dom->firstElementChild );

DOMElement Object
(
    [tagName] => entry
    [firstElementChild] => (object value omitted)
    [lastElementChild] => (object value omitted)
    [childElementCount] => 4
    [previousElementSibling] =>
    [nextElementSibling] =>
    [nodeName] => entry
    [nodeValue] => 食べる食べるたべるたべるた~べる2essenspeisenzu sich nehmenfressenprobierenleben von
    [nodeType] => 1
    [parentNode] => (object value omitted)
    [childNodes] => (object value omitted)
    [firstChild] => (object value omitted)
    [lastChild] => (object value omitted)
    [previousSibling] =>
    [nextSibling] =>
    [attributes] => (object value omitted)
    [ownerDocument] => (object value omitted)
    [namespaceURI] => http://www.wadoku.de/xml/entry
    [prefix] =>
    [localName] => entry
    [textContent] => 食べる食べるたべるたべるた~べる2essenspeisenzu sich nehmenfressenprobierenleben von
)
print_r( $entry_dom->getElementsByTagName( 'gramGrp' )[ 0 ] );

DOMElement Object
(
    [tagName] => gramGrp
    [schemaTypeInfo] =>
    [firstElementChild] => (object value omitted)
    [lastElementChild] => (object value omitted)
    [childElementCount] => 1
    [previousElementSibling] => (object value omitted)
    [nextElementSibling] => (object value omitted)
    [nodeName] => gramGrp
    [nodeValue] =>
    [nodeType] => 1
    [parentNode] => (object value omitted)
    [childNodes] => (object value omitted)
    [firstChild] => (object value omitted)
    [lastChild] => (object value omitted)
    [previousSibling] => (object value omitted)
    [nextSibling] => (object value omitted)
    [attributes] => (object value omitted)
    [ownerDocument] => (object value omitted)
    [namespaceURI] => http://www.wadoku.de/xml/entry
    [prefix] =>
    [localName] => gramGrp
    [textContent] =>
)

print_r( $entry_dom->getElementsByTagName( 'accent' )[ 0 ] );

DOMElement Object
(
    [tagName] => accent
    [schemaTypeInfo] =>
    [firstElementChild] =>
    [lastElementChild] =>
    [childElementCount] => 0
    [previousElementSibling] => (object value omitted)
    [nextElementSibling] =>
    [nodeName] => accent
    [nodeValue] => 2
    [nodeType] => 1
    [parentNode] => (object value omitted)
    [childNodes] => (object value omitted)
    [firstChild] => (object value omitted)
    [lastChild] => (object value omitted)
    [previousSibling] => (object value omitted)
    [nextSibling] =>
    [attributes] => (object value omitted)
    [ownerDocument] => (object value omitted)
    [namespaceURI] => http://www.wadoku.de/xml/entry
    [prefix] =>
    [localName] => accent
    [textContent] => 2
)

$entry_sim = new SimpleXMLElement( $xml );
print_r( $entry_sim );
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [id] => 8610599
            [version] => 1.6
            [HE] => true
        )

    [form] => SimpleXMLElement Object
        (
            [orth] => Array
                (
                    [0] => 食べる
                    [1] => 食べる
                    [2] => たべる
                )

            [reading] => SimpleXMLElement Object
                (
                    [hira] => たべる
                    [hatsuon] => た~べる
                    [accent] => 2
                )

        )

    [gramGrp] => SimpleXMLElement Object
        (
            [doushi] => SimpleXMLElement Object
                (
                    [@attributes] => Array
                        (
                            [level] => 1e
                            [transitivity] => trans
                        )

                )

        )

    [sense] => Array
        (
            [0] => SimpleXMLElement Object
                (
                    [trans] => Array
                        (
                            [0] => SimpleXMLElement Object
                                (
                                    [tr] => SimpleXMLElement Object
                                        (
                                            [text] => essen
                                        )

                                )

                            [1] => SimpleXMLElement Object
                                (
                                    [tr] => SimpleXMLElement Object
                                        (
                                            [text] => speisen
                                        )

                                )

                            [2] => SimpleXMLElement Object
                                (
                                    [tr] => SimpleXMLElement Object
                                        (
                                            [text] => zu sich nehmen
                                        )

                                )

                            [3] => SimpleXMLElement Object
                                (
                                    [tr] => SimpleXMLElement Object
                                        (
                                            [text] => fressen
                                        )

                                )

                            [4] => SimpleXMLElement Object
                                (
                                    [tr] => SimpleXMLElement Object
                                        (
                                            [text] => probieren
                                        )

                                )

                        )

                )

            [1] => SimpleXMLElement Object
                (
                    [trans] => SimpleXMLElement Object
                        (
                            [tr] => SimpleXMLElement Object
                                (
                                    [text] => leben von
                                )

                        )

                )

        )

)

echo $entry_sim->form->orth[ 0 ];
食べる

$entry->registerXPathNamespace('e', 'http://www.wadoku.de/xml/entry'); 
$midashigo = $entry->xpath( "//e:form//e:orth[@midashigo='true']" );

foreach( $midashigo as $m )
{
	echo $m[ 0 ];
}
*/

// insert / and \ to indicate rising and falling pitches
function addAccentMarkers( string $marker, array &$store )
{
	//echo $marker, NL;
	if( $marker != '' )
	{
		$marker_int = intval( $marker );
	}
	else
	{
		$marker_int = -1; // add nothing if -1
	}
	
	if( $marker_int == 1 )
	{
		$store[ 0 ] =  $store[ 0 ] . "\\";
	}
	// default to 0
	elseif( $marker_int != -1 )
	{
		$store[ 0 ] =  $store[ 0 ] . "/";
	}
	
	if( $marker_int > 1 )
	{
		$store[ $marker_int - 1 ] =  $store[ $marker_int - 1 ] . "\\";
	}
}

// escape $ and "
function cleanUpWadokuOutputString( string $str ) : string
{
	$replaced = array( '$'=>'\$', '"'=>"\\\""	);
	
	foreach( $replaced as $s => $r )
	{
		$str = str_replace( $s, $r, $str );
	}
	return $str;
}

// use this to clean up text contained in xml
function cleanUpWadokuString( string $data ) : string
{
	// can't use , as the delimiter
	$unwanted = array( ' ', '<', '>', '×', '△', 
		'〈', '〉', '{', '}', '　', );
	
	foreach( $unwanted as $u )
	{
		$data = str_replace( $u, '', $data );
	}
	
	return $data;
}

// use this to clean up the xml
function cleanUpWadokuXML( string $xml ) : string
{
	$replaced = array( '"'=>'\"', '$'=>'\$' );
	
	foreach( $replaced as $s => $r )
	{
		$xml = str_replace( $s, $r, $xml );
	}
	return $xml;
}

// produce a string like い/ちど\, equivalent to いちど➂
function convertKanaToVisualizedKana(
	string $str,
	array $prep,
	array $拗音,
	array $一般假名,
	array $促音,
	string $marker ) : string
{
	$store = array();
	getKanaAsMoraeArray( $str, $prep, $store );
	addAccentMarkers( $marker, $store );
	return implode( $store );
}

// produce a string like i/chido\
function convertKanaToVisualizedRomaji(
	string $str,
	array $prep,
	array $拗音,
	array $一般假名,
	array $促音,
	string $marker ) : string
{
	echo "input: ", $str, NL;
	$store = array();
	getKanaAsMoraeArray( $str, $prep, $store );
	$size_of_store = sizeof( $store );
	
	for( $i = 0; $i < $size_of_store; $i++ )
	{
		if( array_key_exists( $store[ $i ], $拗音 ) )
		{
			$store[ $i ] = $拗音[ $store[ $i ] ];
		}
	}
	for( $i = 0; $i < $size_of_store; $i++ )
	{
		if( array_key_exists( $store[ $i ], $一般假名 ) )
		{
			$store[ $i ] = $一般假名[ $store[ $i ] ];
		}
	}
	for( $i = 0; $i < $size_of_store; $i++ )
	{
		if( $store[ $i ] == 'っ' || $store[ $i ] == 'ッ' )
		{
			$store[ $i ] = substr( $store[ $i+1 ], 0, 1 );
		}
	}
	
	for( $i = 0; $i < $size_of_store; $i++ )
	{
		if( $store[ $i ] == 'ー' )
		{
			$store[ $i ] = substr( $store[ $i-1 ], -1, 1 );
		}
	}
	addAccentMarkers( $marker, $store );
	return implode( $store );
}

function convertKanaToRomaji(
	string $k,
	array $拗音,
	array $一般假名,
	array $促音 ) : string
{
	if( $k == '' )
	{
		return $k;
	}
	
	$假名 = trim( $k );
	$len = mb_strlen( $假名 );
	$result = $假名;

	for( $i=0; $i < $len-1; $i++ )
	{
		$kana = mb_substr( $假名, $i, 2 );
		
		if( array_key_exists( $kana, $拗音 ) )
		{
			$result = str_replace( $kana, $拗音[ $kana ], $result );
			$i++;
		}
	}

	for( $i=0; $i < $len; $i++ )
	{
		$kana = mb_substr( $假名, $i, 1 );
		if( array_key_exists( $kana, $一般假名 ) )
		{
			$result = str_replace( $kana, $一般假名[ $kana ], $result );
		}
	}

	if( mb_strpos( $result, 'っ' ) !== false || 
		mb_strpos( $result, 'ッ' ) !== false )
	{
		$pos = array();
		for( $i = 0; $i < mb_strlen( $result ); $i++ )
		{
			$ch = mb_substr( $result, $i, 1 );
			
			if( $ch == 'っ' || $ch == 'ッ' )
			{
				$following_letter = mb_substr( $result, $i+1, 1 );
				if( $following_letter == '' )
				{
					return $result;
				}
				$pos[ $i ] = $following_letter;
			}
		}
		$new_result = '';
		
		for( $i = 0; $i < mb_strlen( $result ); $i++ )
		{
			$ch = mb_substr( $result, $i, 1 );
			
			if( $ch == 'っ' || $ch == 'ッ' )
			{
				$new_result .= $pos[ $i ];
			}
			else
			{
				$new_result .= $ch;
			}
		}
		$result = $new_result;
	}

	if( mb_strpos( $result, 'ー' ) !== false )
	{
		$pos = array();
		for( $i = 0; $i < mb_strlen( $result ); $i++ )
		{
			$ch = mb_substr( $result, $i, 1 );
			if( $ch == 'ー' )
			{
				$previous_letter = mb_substr( $result, $i-1, 1 );
				$pos[ $i ] = $previous_letter;
			}
		}
		$new_result = '';
		
		for( $i = 0; $i < mb_strlen( $result ); $i++ )
		{
			$ch = mb_substr( $result, $i, 1 );
			
			if( $ch == 'ー' )
			{
				$new_result .= $pos[ $i ];
			}
			else
			{
				$new_result .= $ch;
			}
		}
		$result = $new_result;
	}
	
	return $result;
}

// convert a string like 二人，ににん，2 to 二人[ににん➁], 二人[に/に\ん] or 二人[ににん] ni/ni\n
function convertTriplet( string $triplet, string $form, 
	array $markers,
	array $prep,
	array $拗音,
	array $一般假名,
	array $促音
) : array
{
	// $form, $markers defined in 常數.php
	// $pred, etc. defined in H:\japanese\programs\kana_romaji_lookup.php
	$triplets = array();
	$result = array();
	
	if( mb_strpos( $triplet, '：' ) !== false )
	{
		$triplets = explode( '：', $triplet );
	}
	else
	{
		$triplets = array( $triplet );
	}
	//print_r( $triplets );
	foreach( $triplets as $triplet )
	{
		$parts = explode( DELIMITER, $triplet );
		
		if( sizeof( $parts ) != 3 )
		{
			echo "$triplet is not a triplet", NL;
			return $triplets;
		}
		
		$詞條 = trim( $parts[ 0 ] );
		$假名 = trim( $parts[ 1 ] );
		$音調 = ( $parts[ 2 ] == '' ? -1 : intval( trim( $parts[ 2 ] ) ) );
		if( $音調 > -1 )
		{
			$accent = getPitchAccentString( $音調, $markers );
		}
		else
		{
			$accent = '';
		}
		
		if( $form == ACCENT_NUM )
		{
			array_push( $result, $詞條 . '[' . $假名 . $accent . ']' );
		}
		elseif( $form == ACCENT_KANA ) 
		{
			$假名 = convertKanaToVisualizedKana( $假名, $prep, $拗音, $一般假名, $促音, $音調 );
			array_push( $result, $詞條 . '[' . $假名 . ']' );
		}
		elseif( $form == ACCENT_ROMAJI )
		{
			$羅馬字 = convertKanaToVisualizedRomaji( $假名, $prep, $拗音, $一般假名, $促音, $音調 );
			array_push( $result, $詞條 . 
				'[' . $假名 . ']' . ' ' . $羅馬字 );
		}
	}
	return $result;
}

function getEntryTriplet(
	string $entry, 
	array $和獨詞條_id, 
	array $和獨假名_id,
	array $和獨id_詞條_假名_accent ) : array
{
	if( !array_key_exists( $entry, $和獨詞條_id ) &&
		!array_key_exists( $entry, $和獨假名_id ) )
	{
		echo $entry . " not found", NL;
		exit;
	}
	if( array_key_exists( $entry, $和獨詞條_id ) )
	{
		$ids = explode( DELIMITER, $和獨詞條_id[ $entry ] );
	}
	else
	{
		$ids = explode( DELIMITER, $和獨假名_id[ $entry ] );
	}
	
	$result = array();
	
	foreach( $ids as $id )
	{
		$vars = explode( '：', $和獨id_詞條_假名_accent[ $id ] );
		foreach( $vars as $var )
		{
			// find the first one
			if( mb_strpos( $var, $entry ) !== false ) 
			{
				// eliminate repeated entries
				if( !in_array( $var, $result ) )
				{
					array_push( $result, $var );
				}
			}
		}
	}
	return $result;
}

function getKanaAsMoraeArray(
	string $kanas, array $prep, array &$store )
{
	// $pred defined in H:\japanese\programs\kana_romaji_lookup.php
	// turn all two-part (e.g. しゃ) mora to a single unicode char
	// each unicode char represent one mora
	foreach( $prep as $k => $v )
	{
		$kanas = str_replace( $k, $v, $kanas );
	}
	
	$len = mb_strlen( $kanas );
	for( $i = 0; $i < $len; $i++ )
	{
		$char = mb_substr( $kanas, $i, 1 );
		$store[ $i ] = $char;
	}
	// convert unicode back to kana in the array
	$reverse_prep = array_flip( $prep );
	$size_of_store = sizeof( $store );
	
	for( $i = 0; $i < $size_of_store; $i++ )
	{
		if( array_key_exists( $store[ $i ], $reverse_prep ) )
		{
			$store[ $i ] = $reverse_prep[ $store[ $i ] ];
		}
	}
}

function getWadokuAccentIntValue(
	string $kanji, array $wadoku_entry_accent ) : int
{
	if( array_key_exists( $kanji, $wadoku_entry_accent ) )
	{
		$marker = $wadoku_entry_accent[ $kanji ];
		// just get the first one
		if( mb_strlen( $marker ) > 1 )
		{
			$marker = mb_substr( $marker, 0, 1 );
		}
		return intval( $marker );
	}
	else
	{
		return -1;
	}
}

function getWadokuAccentMarker(
	string $kanji, array $wadoku_entry_accent, array $markers ) : string
{
	if( array_key_exists( $kanji, $wadoku_entry_accent ) )
	{
		$marker = $wadoku_entry_accent[ $kanji ];
		// just get the first one
		if( mb_strlen( $marker ) > 1 )
		{
			$marker = mb_substr( $marker, 0, 1 );
		}
		return getPitchAccentString( $marker, $markers );
	}
	else
	{
		return '';
	}
}

function getPitchAccentString( string $str, array $markers ) : string
{
	// array: defined in 常數.php
	$pa_str = '';
	
	for( $i = 0; $i < strlen( $str ); $i++ )
	{
		$cur_char = substr( $str, $i, 1 );
		
		if( is_numeric( $cur_char ) && $cur_char >= 0 && $cur_char <= 8 )
		{
			$pa_str .= $markers[ $cur_char ];
		}
		else
		{
			$pa_str .= $cur_char;
		}
	}
	return $pa_str;
}

function getPitchAccentIntValue( string $str, array $markers ) : int
{
	foreach( $markers as $k => $v )
	{
		if( trim( $str ) == $v )
		{
			return $k;
		}
	}
	return -1;
}

function getJapanDictExample( string $source ) : string
{
	$ex_str = '';
	
	return $ex_str;
}

function isAscii( string $str ) : bool
{
	return ( mb_detect_encoding( $str, 'ASCII' ) == 'ASCII' );
}

function isKana( string $str ) : bool
{
	$strlen = mb_strlen( $str );
	
	for( $i = 0; $i < $strlen; $i++ )
	{
		if( ! in_array( mb_ord( mb_substr( $str, $i, 1 ) ),
			range( hexdec( '3040' ), hexdec( '309F' ) ) ) &&
			! in_array( mb_ord( mb_substr( $str, $i, 1 ) ),
			range( hexdec( '30A0' ), hexdec( '30FF' ) ) ) &&
			mb_substr( $str, $i, 1 ) != '･' &&
			mb_substr( $str, $i, 1 ) != 'ー' )
		{
			return false;
		}
	}
	return true;
}

function isKitakana( string $str ) : bool
{
	$strlen = mb_strlen( $str );

	for( $i = 0; $i < $strlen; $i++ )
	{
		if( ! in_array( mb_ord( mb_substr( $str, $i, 1 ) ),
			range( hexdec( '30A0' ), hexdec( '30FF' ) ) ) &&
			mb_substr( $str, $i, 1 ) != '･' &&
			mb_substr( $str, $i, 1 ) != 'ー' )
		{
			return false;
		}
	}
	return true;
}

function isHiragana( string $str ) : bool
{
	$strlen = mb_strlen( $str );
	
	for( $i = 0; $i < $strlen; $i++ )
	{
		if( ! in_array( mb_ord( mb_substr( $str, $i, 1 ) ),
			range( hexdec( '3040' ), hexdec( '309F' ) ) ) )
		{
			return false;
		}
	}
	return true;
}

function isRomaji( string $str ) : bool
{
	return mb_detect_encoding( $str, [ 'ASCII' ], false );
}

function logToFile( string $file, string $content )
{
	file_put_contents(
		$file, 
		$content.PHP_EOL, 
		FILE_APPEND | LOCK_EX );
}

function printOutput( array $output )
{
	foreach( $output as $i => $l )
	{
		echo $l, NL;
	}
	echo NL;
}

function removeAllAccentMarker( string $str ) : string
{
	$new_str = removeBracketedAccentMarker( $str );
	$new_str = str_replace( '⓪', '',
		str_replace( '➀', '',
			str_replace( '➁', '',
				str_replace( '➂', '', 
					str_replace( '➃', '', 
						str_replace( '➄', '', 
							str_replace( '➅', '', 
								str_replace( '➆', '', 
									str_replace( '➇', '', $str )
								)
							)
						)
					)
				)
			)
		)
	);
	return $new_str;
}
function removeBracketedAccentMarker( string $str ) : string
{
	$new_str = str_replace( '[⓪]', '',
		str_replace( '[➀]', '',
			str_replace( '[➁]', '',
				str_replace( '[➂]', '', 
					str_replace( '[➃]', '', 
						str_replace( '[➄]', '', 
							str_replace( '[➅]', '', 
								str_replace( '[➆]', '', 
									str_replace( '[➇]', '', $str )
								)
							)
						)
					)
				)
			)
		)
	);
	return $new_str;
}

function moveFurigana( string $str, array $kanji_kana, array $wadoku_entry_accent, array $markers ) : string
{
	// no brackets
	if( strpos( $str, '[' ) === false )
	{
		return $str;
	}
	$kanji = preg_replace( BRACKET_REGEX, '', $str );
	$marker = '';
	
	if( array_key_exists( $kanji, $wadoku_entry_accent ) )
	{
		$marker = getPitchAccentString(
			$wadoku_entry_accent[ $kanji ], $markers );
	}
	
	if( array_key_exists( $kanji, $kanji_kana ) )
	{
		$kanas = explode( ',', $kanji_kana[ $kanji ] );
		
		foreach( $kanas as $kana )
		{
			$kanji = $kanji . '[' . $kana . $marker . ']';
		}
		return $kanji;
	}
	/*
	// remove markers
	foreach( MARKER_ARRAY as $marker )
	{
		$str = str_replace( $marker, '', $str );
	}
	$matches = array();
	preg_match_all( BRACKET_REGEX, $str, $matches );
	$kana = '';
	
	if( $matches[ 0 ] )
	{
		$kana = implode( $matches[ 0 ] );
	}
	
	$kana = str_replace( '][', '', $kana ); 
	*/
	return $str;
}
?>