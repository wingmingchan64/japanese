<?php
/*
php H:\japanese\programs\wadoku\生成和獨詞條.php
首飾(り) 5957019
<entry xmlns=\"http://www.wadoku.de/xml/entry\" id=\"5957019\" version=\"1.6\" HE=\"true\">
 <form>
  <orth midashigo=\"true\">首飾(り)</orth>
  <orth midashigo=\"true\">×頸飾(り)</orth>
  <orth>首飾り</orth>
  <orth>首飾</orth>
  <orth type=\"irreg\">頸飾り</orth>
  <orth type=\"irreg\">頸飾</orth>
  <reading>
   <hira>くびかざり</hira>
   <hatsuon>くび･かざり</hatsuon>
   <accent>3</accent>
  </reading>
 </form>
 <gramGrp><meishi/></gramGrp>
 <sense><trans><tr><token genus=\"m\" type=\"N\">Halsschmuck</token></tr></trans><trans><tr><token genus=\"f\" type=\"N\">Halskette</token></tr></trans><trans><tr><token genus=\"n\" type=\"N\">Halsband</token></tr></trans></sense><ruigos><ruigo id=\"3061531\"/><ruigo id=\"6949068\"/><ruigo id=\"8003173\"/><ruigo id=\"10640239\"/></ruigos>
</entry>",

*/
require_once( 'H:\github\japanese\programs\函式.php' );

$xml_str = file_get_contents( 
	'H:\japanese\programs\wadoku\wadoku.xml' );
$entries = new SimpleXMLElement( $xml_str );
$line = '';
$詞條 = '';
$max_accent = 0;
//$count = 0;

foreach( $entries as $entry )
{
	$entry_line = '';
	$id     = trim( $entry[ 'id' ] );
	$orths  = $entry->form->orth;
	$orths_diff = array();
	foreach( $orths as $orth )
	{
		$orth = trim( $orth );
		if( !in_array( $orth, $orths_diff ) )
		{
			array_push( $orths_diff, $orth );
		}
	}
	$hira   = trim( $entry->form->reading->hira );
	$accent = trim( $entry->form->reading->accent );
	
	foreach( $orths_diff as $orth )
	{
		$entry_line .= $id . DELIMITER . $orth . DELIMITER .
			$hira . DELIMITER . $accent . NL;
		$詞條 .= cleanUpWadokuString( $orth ) . NL;
	}
	
	$line .=  cleanUpWadokuString( $entry_line );
	//$line .= cleanUpWadokuString(
		//trim( $entry->form->orth[ 0 ] ) ) . NL;

	//$count++;
/*
	$accent = $entry->form->reading->accent;
	if( $accent && intval( $accent ) > $max_accent )
	{
		$max_accent = intval( $accent );
	}
*/
}
//echo $count;
file_put_contents( 'H:\japanese\programs\wadoku\data\和獨id_詞條_假名_accent.txt', $line );
file_put_contents( 'H:\japanese\programs\wadoku\data\和獨詞條.txt', $詞條 );

// echo $max_accent; 34
// count 433218
?>