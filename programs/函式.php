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
function cleanUpWadokuOutputString( string $str ) : string
{
	$replaced = array( '$'=>'\$' );
	
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

function convertKanaToRomaji(
	string $k,
	array $拗音,
	array $一般假名,
	array $促音 ) : string
{
	//echo "Input: ", $k, NL;
	
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
		//echo 'Kana1: ', $kana, NL;
		
		if( array_key_exists( $kana, $拗音 ) )
		{
			$result = str_replace( $kana, $拗音[ $kana ], $result );
			//echo 'Result1: ', $result, NL;
			$i++;
		}
	}
//echo $result, NL;

	for( $i=0; $i < $len; $i++ )
	{
		$kana = mb_substr( $假名, $i, 1 );
		//echo 'Kana2: ' , $kana, NL;
		if( array_key_exists( $kana, $一般假名 ) )
		{
			$result = str_replace( $kana, $一般假名[ $kana ], $result );
			//echo $result, NL;
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

//echo $result, NL;
/*
	for( $i=0; $i < $len; $i++ )
	{
		$kana = mb_substr( $假名, $i, 1 );
		
		if( array_key_exists( $kana, $促音 ) )
		{
			$next = mb_substr( $假名, $i+1, 1 );
			echo 'Next: ', $next, NL;
			if( $next == '' )
			{
				break;
			}
			$next_letter = substr( $一般假名[ $next ], 0, 1 );
			echo "Next letter: ", $next_letter, NL;
			
			$result = str_replace( $kana, $next_letter, $result );
		}
	}
*/
	
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
		
		
		//echo "Inside while", NL;
		//while( mb_strpos( $result, 'ー' ) !== false )
		//{
			//$pos = mb_strpos( $result, 'ー' );
			//echo 'Position: ', $pos, NL;
			//$previous_letter = substr( $result, $pos-1, 1 );
			//echo 'Input: ', $k, NL;
			//echo 'Previous: ', $previous_letter, NL;
			//echo "First: ", substr( $result, 0, $pos ), NL;
			//echo "Second: ", substr( $result, $pos + 1 ), NL;
			//$result = substr( $result, 0, $pos ) . $previous_letter .
				//substr( $result, $pos + 1 );
			//echo substr( $result, 0, $pos ) . $previous_letter .
				//convertKanaToRomaji( substr( $result, $pos + 1 ), $拗音, $一般假名, $促音 ), NL;
			//$result = substr( $result, 0, $pos ) . $previous_letter .
				//convertKanaToRomaji( substr( $result, $pos + 1 ), $拗音, $一般假名, $促音 );
			//$result = str_replace( 'ー', $previous_letter, $result );
		//}
	}
	
	return $result;
}


function getWadokuAccentMarker(
	string $kanji, array $wadoku_entry_accent ) : string
{
	if( array_key_exists( $kanji, $wadoku_entry_accent ) )
	{
		$marker = $wadoku_entry_accent[ $kanji ];
		// just get the first one
		if( mb_strlen( $marker ) > 1 )
		{
			$marker = mb_substr( $marker, 0, 1 );
		}
		return getPitchAccentString( $marker );
	}
	else
	{
		return '';
	}
}

function getPitchAccentString( string $str ) : string
{
	//global PA_ARRAY;
	$pa_str = '';
	$pa_array = array( '⓪','➀','➁','➂','➃','➄','➅','➆','➇' );
	
	for( $i = 0; $i < strlen( $str ); $i++ )
	{
		$cur_char = substr( $str, $i, 1 );
		
		if( is_numeric( $cur_char ) && $cur_char >= 0 && $cur_char <= 8 )
		{
			$pa_str .= $pa_array[ $cur_char ];
		}
		else
		{
			$pa_str .= $cur_char;
		}
	}
	return $pa_str;
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

function moveFurigana( string $str, array $kanji_kana, array $wadoku_entry_accent ) : string
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
		$marker = getPitchAccentString( $wadoku_entry_accent[ $kanji ] );
	}
	
	if( array_key_exists( $kanji, $kanji_kana ) )
	{
		foreach( $kanji_kana[ $kanji ] as $kana )
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