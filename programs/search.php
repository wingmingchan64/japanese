<?php
/*
php h:\github\japanese\programs\search.php 
*/
require_once( "h:\\github\\japanese\\programs\\常數.php" );
require_once( "h:\\github\\japanese\\programs\\函式.php" );
require_once( "H:\\github\\japanese\\programs\\四角字典.php" );
require_once( "H:\\github\\japanese\\programs\\粵和詞典.php" );
require_once( "H:\\github\\japanese\\programs\\romaji_kanji.php" );
require_once( 'H:\japanese\programs\wadoku\data\和獨漢字_假名.php' );
require_once( 'H:\japanese\programs\wadoku\data\和獨詞條_accent.php' );

$input  = "";
$buffer = '';
$cleanup = false; // 0
$show_furi = false; // 1
// 2 default
$move_furi = false; // 3
//$furikana_regex = '/\[\[\X+?]]|\[\X+?]/';
//$pitch_regex = '/\[\X+?]/'; // BRACKET_REGEX
// $dict is from 四角字典, the starting point
// do not use array_merge!!!
foreach( $romaji_kanji as $k => $v )
{
	$dict[ $k ] = $v;
}
foreach( $粵和詞典 as $k => $v )
{
	$dict[ $k ] = $v;
}

// outer while
while( true )
{
	echo 選項指令;
	$程式名 = array_keys( 搜索程式 );
	print_r( $程式名 );
	$cleanup = false;
	$show_furi = false;
	$move_furi = false;

	$option = readline();
	
	if( $option == "exit" )
	{
		echo "Bye!\n";
		exit;
	}
	
	$num = intval( $option );
	
	if( $num == 0 || $num == 1 || $num == 2 || $num == 3 )
	{
		if( $num == 0 )
		{
			$cleanup = true;
		}
		elseif( $num == 1 )
		{
			$show_furi = true;
		}
		elseif( $num = 3 )
		{
			$move_furi = true;
		}

// inner while for inputting kanji
while( true ) 
{
	// clr: clear the buffer in memory
	// del: remove the last unicode char from memory
	// show: show the content in memory
	// quit: exit program
	// key: Romaji
	echo "Enter a command (clr, del, show, quit) or a Romaji\n";
	$input = readline();

	// command or key
	if( $input == "quit" )
	{
		echo "Bye!\n";
		break;
	}
	elseif( $input == "del" )
	{
		$buffer = mb_substr( 
			$buffer, 0, mb_strlen( $buffer ) - 1 );
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
	elseif( array_key_exists( $input, $dict ) )
	{
		//echo $dict[ $input ], "stop\r\n";
		
		// more than one 漢字符 in value
		if( is_string( $dict[ $input ] ) && 
			mb_strlen( $dict[ $input ] ) > 0 )
		{
			// only one option, append entire string to buffer
			if( mb_strpos( $dict[ $input ], ":" ) === false )
			{
				$option_str = trim( $dict[ $input ] );
				
				if( $cleanup ) // clear up everything in []
				{
					$option_str = preg_replace( 
						BRACKET_REGEX, '', $option_str );
				}
				elseif( $show_furi ) // remove accent markers
				{
					$option_str = removeAllAccentMarker( $option_str );
				}
				elseif( $move_furi ) // only one option
				{
					$option_str = moveFurigana( 
						$option_str, $和獨漢字_假名, $和獨詞條_accent );
				}

				$buffer .= trim( $option_str, "*" );
				printBuffer( $buffer );
			}
			// provide options
			elseif( mb_strpos( $dict[ $input ], ":" ) !== false )
			{
				// :-separated string
				
				//{
					$options = array( '' );
					$option_str = $dict[ $input ];
					$parts = explode( ':', $option_str );
					
					for( $i = 0; $i < sizeof( $parts ); $i++ )
					{
						if( $cleanup )
						{
							$parts[ $i ] = 
								preg_replace( BRACKET_REGEX, '', 
								$parts[ $i ] );
							//$option_str = preg_replace( 
								//BRACKET_REGEX, '', $option_str );
						}
						elseif( $show_furi )
						{
							// remove all accent markers
							$parts[ $i ] = 
								preg_replace( BRACKET_REGEX, '',
								$parts[ $i ] );

						//$option_str = removeAllAccentMarker( $option_str );
						}
						elseif( $move_furi )
						{
							$parts[ $i ] = moveFurigana(
								$parts[ $i ], $kanji_kana, $和獨詞條_accent );
						}
					}
					
					$options = array_merge( $options, $parts );
				//}
				/*
				// no :
				else
				{
					$option_str = $dict[ $input ];
					
					if( $cleanup )
					{
						$option_str = preg_replace( 
							BRACKET_REGEX, '', $option_str );
					}
					elseif( $show_furi )
					{
						// remove all accent markers
						$option_str = removeAllAccentMarker( $option_str );
					}
					elseif( $num == 3 )
					{
						$option_str = moveFurigana( $option_str );
					}

					
					//$options = array( '' );
			
					
					// create option array
					//for( $i=1; $i<=mb_strlen( $option_str ); $i++ )
					/{
						//array_push( $options, 
							//mb_substr( $option_str, $i-1, 1 ) );
					//}
				}
				*/
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
			$parts = explode( ':', $option_str );
			
			for( $i = 0; $i < sizeof( $parts ); $i++ )
			{
				if( $cleanup )
				{
					$parts[ $i ] = 
					preg_replace( 
					BRACKET_REGEX, '', $parts[ $i ] );
				}
				elseif( $show_furi )
				{
					// remove all accent markers
					$parts[ $i ] = 
					removeAllAccentMarker( $parts[ $i ] );
				}
				elseif( $move_furi )
				{
					$parts[ $i ] = moveFurigana(
						$parts[ $i ], $kanji_kana, $和獨詞條_accent );
				}
			}

			$options = array_merge( $options, $parts );
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
		require_once( 'H:\japanese\programs\wadoku\data\和獨羅馬字_假名_漢字.php' );
		if( array_key_exists( $input, $和獨羅馬字_假名_漢字 ) )
		{
			$k_k = $和獨羅馬字_假名_漢字[ $input ];
			
			if( strpos( $k_k, ',' ) !== false )
			{
				$options = explode( ',', $k_k );
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
			else
			{
				$buffer .= $k_k;
				printBuffer( $buffer );
			}
		}

/*
		require_once( 'H:\github\japanese\programs\tangorin_dict.php' );
		
		if( array_key_exists( $input, $tangorin_dict ) )
		{
			$陣列 = $tangorin_dict[ $input ];
			
			$t = '';
			
			if( is_string( $陣列[ 0 ] ) )
			{
				if( $陣列[ 0 ] != '' )
				{
					$t = $陣列[ 0 ] . '[' . $陣列[ 1 ] . ']';
				}
				else
				{
					$t = $陣列[ 1 ];
				}
			}
			elseif( is_array( $陣列[ 0 ] ) )
			{
				foreach( $陣列 as $strings )
				{
					if( $strings[ 0 ] != '' )
					{
						$t .= $strings[ 0 ] . '[' . $strings[ 1 ] . ']';
					}
					else
					{
						$t .= $strings[ 1 ];
					}
				}
			}
			$buffer .= $t;
			printBuffer( $buffer );
		}
*/
		
		echo "Not a valid key. Try again.\n";
	}
}// inner while
	} 
	elseif( $num > 2 && $num < sizeof( $程式名 ) )
	{
		$程式 = $程式名[ $num ];
		
		if( 搜索程式[ $程式 ] != '' )
		{
			$程式 = $程式名[ $num ];
			echo 搜索程式[ $程式 ];
			$參數 = readline();
		}
		else
		{
			$參數 = '';
		}
		
		$executable = "php " . 程式文件夾 . $程式 . 程式後綴 . ' ' . $參數;
		$output = null;
		$retval = null;
		echo NL;

		exec( $executable, $output, $retval );
		printOutput( $output );

	}
	else
	{
		echo "Not a valid option. Try again.\n";
	}
}

function printBuffer( string $buffer )
{
	// remove space
	$buffer = str_replace( ' ', '', $buffer );
	// display
	echo "=>", $buffer, "\n";
}
?>