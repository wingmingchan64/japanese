<?php
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
								str_replace( '➆', '', $str )
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
								str_replace( '[➆]', '', $str )
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