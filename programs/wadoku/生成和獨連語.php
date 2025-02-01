<?php
/*
php H:\japanese\programs\wadoku\生成和獨連語.php
*/
ini_set('memory_limit', '-1');

require_once( 'H:\github\japanese\programs\函式.php' );
require_once( 'H:\japanese\programs\wadoku\id_xml_entry.php' );
$contents = "<?php
\$連語=array(
";

foreach( $id_xml_entry as $id => $xml )
{
	//$count++;
	$entry_dom = new DOMDocument();
	$entry_dom->loadXML( $xml );
	$entry_sim = new SimpleXMLElement( $xml );
	
	$gramGrp_dom = $entry_dom->getElementsByTagName( 'gramGrp' );
	if( $gramGrp_dom[ 0 ] && $gramGrp_dom[ 0 ]->firstElementChild )
	{
		$品詞名 = $gramGrp_dom[ 0 ]->firstElementChild->tagName;
		
		if( $品詞名 == 'fukushi' )
		{
			//$gramGrpXml = $entry_sim->gramGrp->asXML();
			$kanji = $entry_sim->form->orth[ 0 ];
			$kanji = str_replace( '×', '', $kanji );
			$kanji = str_replace( '△', '', $kanji );
			$kanji = str_replace( '{', '', $kanji );
			$kanji = str_replace( '}', '', $kanji );
			$kanji = str_replace( '〈', '', $kanji );
			$kanji = str_replace( '〉', '', $kanji );
			$kanji = str_replace( '(', '', $kanji );
			$kanji = str_replace( ')', '', $kanji );
			
			if( !in_array( $kanji, $連語陣列 ) )
			{
				array_push( $連語陣列, $kanji );
			}
		}
	}
}

foreach( $連語陣列 as $連語 )
{
	$contents .= "\"$連語\",\r\n";
}

$contents .= ");
?>
";

file_put_contents( "H:\\japanese\\programs\\wadoku\\連語.php", $contents );
}
?>