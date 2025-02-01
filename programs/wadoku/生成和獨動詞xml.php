<?php
/*
php H:\japanese\programs\wadoku\生成和獨動詞xml.php
<gramGrp>
<doushi level="5" transitivity="intrans" godanrow="ra" onbin="true"/>
</gramGrp>
*/
ini_set('memory_limit', '-1');

require_once( 'H:\github\japanese\programs\函式.php' );
require_once( 'H:\japanese\programs\wadoku\id_xml_entry.php' );
$contents = "<?php
\$和獨動詞xml=array(
";
$count=0;
$doushi_count = 0;
$動詞陣列 = array(
	'5'    => array(),
	'1e'   => array(),
	'1i'   => array(),
	'2e'   => array(),
	'2i'   => array(),
	'4'    => array(),
	'kuru' => array(),
	'ra'   => array(),
	'suru' => array()
);

foreach( $id_xml_entry as $id => $xml )
{
	$count++;
	$entry_dom = new DOMDocument();
	$entry_dom->loadXML( $xml );
	$entry_sim = new SimpleXMLElement( $xml );
	
	$gramGrp_dom = $entry_dom->getElementsByTagName( 'gramGrp' );
	if( $gramGrp_dom[ 0 ] && $gramGrp_dom[ 0 ]->firstElementChild )
	{
		$品詞名 = $gramGrp_dom[ 0 ]->firstElementChild->tagName;
		
		if( $品詞名 == 'doushi' )
		{
			$gramGrpXml = $entry_sim->gramGrp->asXML();
			$kanji = $entry_sim->form->orth[ 0 ];
			$kanji = str_replace( '×', '', $kanji );
			$kanji = str_replace( '△', '', $kanji );
			$kanji = str_replace( '{', '', $kanji );
			$kanji = str_replace( '}', '', $kanji );
			$kanji = str_replace( '〈', '', $kanji );
			$kanji = str_replace( '〉', '', $kanji );
			
			$gramGrpXml = str_replace( '"', '\"', $gramGrpXml );
			// 7672
			$contents .= "\"$kanji\"=>\"$gramGrpXml\",\r\n";
			
			if( strpos( $kanji, '(' ) !== false )
			{
				$kanji = str_replace( '(', '', $kanji );
				$kanji = str_replace( ')', '', $kanji );
				// 10249 after () are removed
				$contents .= "\"$kanji\"=>\"$gramGrpXml\",\r\n";
			}
			/*
			//print_r( $gramGrp_dom[ 0 ]->firstElementChild );
			//print_r( $gramGrp_dom[ 0 ]->firstElementChild );
			echo $品詞名, ' ';
			*/
			if( $gramGrp_dom[ 0 ]->firstElementChild->
				getAttribute( 'level' ) )
			{
				$段 = $gramGrp_dom[ 0 ]->firstElementChild->
					getAttribute( 'level' );
				//echo $段, NL;
				if( !in_array( $kanji, $動詞陣列[ $段 ] ) )
				{
					array_push( $動詞陣列[ $段 ], $kanji );
				}
			}
			// 音便
			/**/
		}
	}
}
$contents .= ");
?>
";

//print_r( $動詞陣列 );
//echo $count, NL;

file_put_contents( 'H:\japanese\programs\wadoku\和獨動詞xml.php', $contents );

foreach( $動詞陣列 as $段 => $陣列 )
{
	$contents = "<?php
\$${段}段動詞=array(
";
	foreach( $陣列 as $動詞 )
	{
		$contents .= "\"$動詞\",\r\n";
	}
	$contents .= ");
?>";
	file_put_contents( "H:\\japanese\\programs\\wadoku\\${段}段動詞.php", $contents );
}
?>