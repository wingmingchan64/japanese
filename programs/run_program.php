<?php
/*
php h:\github\japanese\programs\run_program.php "羅馬字→漢字、假名、音調 accent_num"
php h:\github\japanese\programs\run_program.php "羅馬字→漢字、假名、音調 accent_kana"
php h:\github\japanese\programs\run_program.php "羅馬字→漢字、假名、音調 accent_romaji"
php h:\github\japanese\programs\run_program.php "詞條→漢字、假名、音調 accent_kana"
php h:\github\japanese\programs\run_program.php "漢字→漢字、假名、音調 accent_romaji"
php h:\github\japanese\programs\run_program.php "weblio\下載weblio詞條"
php h:\github\japanese\programs\run_program.php "weblio\展示詞條内容"


The command prompt window cannot deal with an input containing "…";
therefore, all prefixes and suffixes like …冊 will fail to show up.
Use '...' instead.

This program runs another program continuously with the same 
programmatic (non-user) parameter(s), like accent_num above. 
The program run can have its own runtime parameters.
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
	$參數 = readline(); //  …冊
	
	if( $參數 == 'exit' )
	{
		echo "Bye!", NL;
		exit;
	}
	//echo mb_strlen( $參數 ) . NL;
	
	if( $additional != '' )
	{
		$executable = "php $程式路徑 $additional \"${參數}\"";
	}
	else
	{
		$executable = "php " . $程式路徑 . ' "' . $參數 . '"';
	}
	$output = null;
	$retval = null;
	echo NL;

	exec( $executable, $output, $retval );
	printOutput( $output );
}
?>