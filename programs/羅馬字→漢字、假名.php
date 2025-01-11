<?php
/*
// remove all pronunciation information
php H:\github\japanese\programs\羅馬字→漢字、假名.php 0
// keep furigana
php H:\github\japanese\programs\羅馬字→漢字、假名.php 1
// show all pronunciation information
php H:\github\japanese\programs\羅馬字→漢字、假名.php
*/
$cleanup = false;
$show_furi = false;
$furikana_regex = '/\[\[\X+?]]|\[\X+?]/';
$pitch_regex = '/\[\[\X+?]]/';

if( sizeof( $argv ) > 1 )
{
	$cleanup = 
		( intval( $argv[1] ) == 0 ) ?  
		true : false;
	$show_furi =
		( intval( $argv[1] ) == 1 ) ?  
		true : false;
}

// 字庫
require_once( "H:\\github\\japanese\\programs\\四角字典.php" );
require_once( "H:\\github\\japanese\\programs\\日本語の固有名詞.php" );
require_once( "H:\\github\\japanese\\programs\\romaji_kanji.php" );

// do not use array_merge!!!
foreach( $固有名詞 as $k => $v )
{
	$dict[ $k ] = $v;
}
foreach( $romaji_kanji as $k => $v )
{
	$dict[ $k ] = $v;
}
$NL = "\r\n";

$out_file = 'h:\php809\code\buffer.txt';
$input    = "";
$buffer   = "";

while( true )
{
	// load: load the content of buffer.txt to memory
	// save: save the content in memory to buffer.txt
	// clr: clear the buffer in memory
	// del: remove the last unicode char from memory
	// show: show the content in memory
	// exit: terminate the program
	// key: a key in the dictionary
	echo "Enter a command (load, save, clr, del, show, exit) or a key\n";
	echo $show_furi ? "furi" . NL : "no furi" . NL;
	$input = readline();
	
	// command or key
	if( isAscii( $input ) )
	{
		if( $input == "exit" )
		{
			echo "Bye!\n";
			exit;
		}
		elseif( $input == "save" )
		{
			file_put_contents( $out_file, $buffer );
			printBuffer( $buffer );
		}
		elseif( $input == "del" )
		{
			$buffer = mb_substr( 
				$buffer, 0, mb_strlen( $buffer ) - 1 );
			printBuffer( $buffer );
		}
		elseif( $input == "load" )
		{
			$buffer = file_get_contents( $out_file );
			printBuffer( $buffer );
		}
		elseif( $input == "show" )
		{
			printBuffer( $buffer );
		}
		elseif( $input == "clr" )
		{
			$buffer = "";
			printBuffer( $buffer );
		}
		// read the value of a key
		elseif( array_key_exists( $input, $dict ) )
		{
			//echo 'here 1', $input, "\r\n";
			//echo $dict[ $input ], "stop\r\n";
			
			// more than one 漢字符 in value
			if( is_string( $dict[ $input ] ) && 
				mb_strlen( $dict[ $input ] ) > 1 )
			{
				//echo 'here 2', $input, "\r\n";
				// append entire string to buffer
				if( str_starts_with( $dict[ $input ], "*" ) &&
					mb_strpos( $dict[ $input ], ":" ) === false
				)
				{
					$option_str = trim( $dict[ $input ] );
					
					if( $cleanup )
					{
						$option_str = preg_replace( 
							$pitch_regex, '', $option_str );
					}
					elseif( $show_furi )
					{
						//$option_str = preg_replace( 
							//$pitch_regex, '', $option_str );
							
						// remove all accent markers
						$option_str = removeAllAccentMarker( $option_str );
			/*
						$option_str = str_replace( '[⓪]', '',
							str_replace( '[➀]', '',
								str_replace( '[➁]', '',
									str_replace( '[➂]', '', $option_str ) ) ) );
						$option_str = str_replace( '⓪', '',
							str_replace( '➀', '',
								str_replace( '➁', '',
									str_replace( '➂', '', $option_str ) ) ) );
			*/
					}

					$buffer .= trim( $option_str, "*" );
					printBuffer( $buffer );
				}
				// provide options
				else
				{
					if( mb_strpos( $dict[ $input ], ":" ) !== false )
					{
						$options = array( '' );
						$option_str = $dict[ $input ];

						if( $cleanup )
						{
							$option_str = preg_replace( 
								$pitch_regex, '', $option_str );
						}
						elseif( $show_furi )
						{
							//$option_str = preg_replace( 
								//$pitch_regex, '', $option_str );
							// remove all accent markers
							$option_str = 
								removeAllAccentMarker( $option_str);
							/*
							$option_str = str_replace( '[⓪]', '',
								str_replace( '[➀]', '',
									str_replace( '[➁]', '',
										str_replace( '[➂]', '', $option_str ) ) ) );
								$option_str = str_replace( '⓪', '',
									str_replace( '➀', '',
										str_replace( '➁', '',
											str_replace( '➂', '', $option_str ) ) ) );
							*/
						}

						
						$options = array_merge( $options,
							explode(
								':', trim( $option_str, "*" ) ) );
					}
					else
					{
						$option_str = $dict[ $input ];
						
						if( $cleanup )
						{
							$option_str = preg_replace( 
								$pitch_regex, '', $option_str );
						}
						elseif( $show_furi )
						{
							//$option_str = preg_replace( 
								//$pitch_regex, '', $option_str );
							// remove all accent markers
							$option_str = 
								removeAllAccentMarker( $option_str);
/*
							$option_str = str_replace( '[⓪]', '',
								str_replace( '[➀]', '',
									str_replace( '[➁]', '',
										str_replace( '[➂]', '', $option_str ) ) ) );
								$option_str = str_replace( '⓪', '',
									str_replace( '➀', '',
										str_replace( '➁', '',
											str_replace( '➂', '', $option_str ) ) ) );
*/
						}


						$options = array( '' );
				
						// create option array
						for( $i=1; $i<=mb_strlen( $option_str ); $i++ )
						{
							array_push( $options, 
								mb_substr( $option_str, $i-1, 1 ) );
						}
					}
					// output options
					print_r( $options );
					// wait for user option choice
					$num = intval( readline() );
				
					if( $num >= 0 && $num < sizeof( $options ) )
					{
						$buffer .= $options[ $num ];
						printBuffer( $buffer );
					}
					else
					{
						echo "Not a valid option. Try again.\n";
					}
				}
			}
			elseif( is_array( $dict[ $input ] ) )
			{
				//echo 'here 3', $input, "\r\n";

				// output options
				print_r( $dict[ $input ] );
				
				$num = intval( readline() );
				
				if( $num >= 0 && $num < sizeof( $dict[ $input ] ) )
				{
					$buffer .= $dict[ $input ][ $num ];
					printBuffer( $buffer );
				}
				else
				{
					echo "Not a valid option. Try again.\n";
				}
			}
			else
			{
				//echo 'here 4', $input, "\r\n";
				$buffer .= $dict[ $input ];
				printBuffer( $buffer );
			}
		}
		elseif( str_ends_with( $input, '..' ) )
		{
			// remove marker
			$input = str_replace( '..', '', $input );
			$options = array( '' );
			
			foreach( array_keys( $dict ) as $key )
			{
				// use the first key
				if( !str_starts_with( $key, $input ) )
				{
					continue;
				}
				$option_str = $dict[ $key ];
				if( $cleanup )
				{
					$option_str = preg_replace( 
						$pitch_regex, '', $option_str );
				}
				elseif( $show_furi )
				{
					//$option_str = preg_replace( 
						//$pitch_regex, '', $option_str );
					// remove all accent markers
					$option_str = 
						removeAllAccentMarker( $option_str);
/*
					$option_str = str_replace( '[⓪]', '',
						str_replace( '[➀]', '',
							str_replace( '[➁]', '',
								str_replace( '[➂]', '', $option_str ) ) ) );
						$option_str = str_replace( '⓪', '',
							str_replace( '➀', '',
								str_replace( '➁', '',
									str_replace( '➂', '', $option_str ) ) ) );
*/
				}

				$options = array_merge( $options,
					explode(
						':', trim( $dict[ $key ], "*" ) ) );
				break;
			}
			
			if( sizeof( $options ) > 1 )
			{
				// output options
				print_r( $options );
				// wait for user option choice
				$num = intval( readline() );
			
				if( $num >= 0 && $num < sizeof( $options ) )
				{
					$buffer .= $options[ $num ];
					printBuffer( $buffer );
				}
				else
				{
					echo "Not a valid option. Try again.\n";
				}
			}
		}
		else
		{
			// find something useful in other dictionaries
			require_once( 'H:\github\japanese\programs\tangorin_dict.php' );
			
			echo "Not a valid key. Try again.\n";
		}
	}
	else // 漢字符
	{
		$buffer .= $input;
		printBuffer( $buffer );
	}
}

function isAscii( string $str ) : bool
{
	return ( mb_detect_encoding( $str, 'ASCII' ) == 'ASCII' );
    //return mb_check_encoding( $str, 'ASCII' );
}

function printBuffer( string $buffer )
{
	// remove space
	$buffer = str_replace( ' ', '', $buffer );
	// display
	echo "=>", $buffer, "\n";
}
function removeAllAccentMarker( string $str ) : string
{
	$newstr = removeBracketedAccentMarker( $str );

	$newstr = str_replace( '⓪', '',
		str_replace( '➀', '',
			str_replace( '➁', '',
				str_replace( '➂', '', 
					str_replace( '➃', '', 
						str_replace( '➄', '', 
							str_replace( '➅', '', 
								str_replace( '➆', '', $newstr )
							)
						)
					)
				) 
			)
		) 
	);
	return $newstr;
}
function removeBracketedAccentMarker( string $str ) : string
	$newstr = str_replace( '[⓪]', '',
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

	return $newstr;
}
?>