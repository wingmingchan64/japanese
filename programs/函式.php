<?php
set_error_handler( function ( 
	$severity, $message, $file, $line )
{
    throw new \ErrorException( $message, $severity, 	
		$severity, $file, $line );
});

// check argv
function checkARGV( array $argv, int $num, string $msg )
{
	if( sizeof( $argv ) != $num )
	{
		echo $msg, NL;
		exit;
	}
}

?>