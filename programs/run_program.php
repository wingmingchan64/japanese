<?php
/*
php h:\github\japanese\programs\run_program.php "羅馬字→漢字、假名、音調 accent_num"
php h:\github\japanese\programs\run_program.php "羅馬字→漢字、假名、音調 accent_kana"
php h:\github\japanese\programs\run_program.php "羅馬字→漢字、假名、音調 accent_romaji"
php h:\github\japanese\programs\run_program.php "詞條→漢字、假名、音調 accent_kana"


This program runs another program consistently.
*/
require_once( "h:\\github\\japanese\\programs\\函式.php" );

checkARGV( $argv, 2, 輸入程式名稱 );
// store program name
$程式 = trim( $argv[ 1 ] );
$additional = '';

// additional params passed in
if( strpos( $程式, ' ' ) !== false )
{
	$parts = explode( ' ', $程式 );
	$程式 = trim( $parts[ 0 ] );
	$additional = trim( $parts[ 1 ] );
}
$程式 = str_replace( '.php', '', $程式 );
$程式路徑 = "H:\\github\\japanese\\programs\\${程式}.php";

if( !file_exists( $程式路徑 ) )
{
	echo "此程式不存在。" . NL;
	exit;
}

while( true )
{
	// execute the program
	// most programs require parameters
	// strings with spaces must be in quotes
	echo "請輸入參數:", NL;
	$參數 = readline();
	
	if( $參數 == 'exit' )
	{
		echo "Bye!", NL;
		exit;
	}
	
	if( $additional != '' )
	{
		$executable = "php $程式路徑 $additional $參數";
	}
	else
	{
		$executable = "php " . $程式路徑 . ' ' . $參數;
	}
	//echo $executable, NL;
	$output = null;
	$retval = null;
	echo NL;

	exec( $executable, $output, $retval );
	printOutput( $output );
}
?>