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
	if( sizeof( $argv ) != $num )
	{
		echo $msg, NL;
		exit;
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
?>