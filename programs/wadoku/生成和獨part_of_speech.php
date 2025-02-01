<?php
/*
php H:\japanese\programs\wadoku\生成和獨part_of_speech.php
*/
ini_set('memory_limit', '-1');

require_once( 'H:\github\japanese\programs\函式.php' );
require_once( 'H:\japanese\programs\wadoku\id_xml_entry.php' );

// run these one at a time!!!
$part_of_speech_array = array(
	//'prefix' => 'prefix',
	//'suffix' => 'suffix',
	//'daimeishi' => '代名詞',
	//'kandoushi' =>'感動詞',
	//'rentaishi' => '連体詞',
	//'setsuzokushi' => '接続詞',
	//'joshi' => '助詞',
	//'jodoushi' => '助動詞',
	//'shuujoshi' => '終助詞',
	//'setsuzokujoshi' => '接続助詞',
	//'kakarijoshi' => '係助詞',
	//'fukujoshi' => '副助詞',
	//'kakujoshi' => '格助詞',
	//'kanji' => 'kanji',
	//'wordcomponent' => 'wordcomponent',
	'specialcharacter' => 'specialcharacter',
);
$romaji = array_keys( $part_of_speech_array );
//print_r ( $romaji );

foreach( $part_of_speech_array as $pos => $漢 )
{
	$陣列名 = "${漢}陣列";
	$$陣列名 = array();
	
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
		
		//if( $品詞名 == 'fukushi' )
		if( in_array( $品詞名, $romaji ) )
		{
			$cur漢 = $part_of_speech_array[ $品詞名 ];
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
			
			$列名 = $cur漢 . "陣列";
			if( !in_array( $kanji, ${$列名} ) )
			{
				//echo $列名, ' ', $kanji, NL;
				array_push( ${$列名}, $kanji );
			}
		}
	}
}
//print_r( $副助詞陣列 );

$contents = "<?php
\$${漢}=array(
";

foreach( $$陣列名 as $term )
{
	$contents .= "\"$term\",\r\n";
}

$contents .= ");
?>
";
//echo $contents, NL;
file_put_contents( "H:\\japanese\\programs\\wadoku\\${漢}.php", $contents );
}
?>