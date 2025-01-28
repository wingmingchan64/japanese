<?php
/*
php H:\japanese\programs\wadoku\統計數字.php
entry
  form
    orth
	reading
	  hira
	  hatsuon
	  accent
  gramGrp
    fukushi
  sense

Array
(
    [meishi] => 280342 名詞
    [fukushi] => 2684 副詞
    [doushi] => 7672 動詞
    [keiyoudoushi] => 2851 形容動詞
    [keiyoushi] => 1185 形容詞
    [rengo] => 741 連語
    [daimeishi] => 163 代名詞
    [suffix] => 299
    [kandoushi] => 318 感動詞
    [prefix] => 192
    [kanji] => 162
    [rentaishi] => 153 連体詞
    [setsuzokushi] => 96 接続詞
    [joshi] => 60 助詞
    [jodoushi] => 46 助動詞
    [wordcomponent] => 42
    [shuujoshi] => 12 終助詞
    [specialcharacter] => 18
    [setsuzokujoshi] => 3 接続助詞
    [kakarijoshi] => 3 係助詞
    [fukujoshi] => 5 副助詞
    [kakujoshi] => 4 格助詞
)
total 297051
count 433218
*/
ini_set('memory_limit', '-1');

require_once( 'H:\github\japanese\programs\函式.php' );
require_once( 'H:\japanese\programs\wadoku\id_xml_entry.php' );
$contents = '';
$count=0;
$doushi_count = 0;
$firstFound = false;
$品詞陣列 = array();

foreach( $id_xml_entry as $id => $xml )
{
	$count++;
	$entry = new DOMDocument();
	$entry->loadXML( $xml );
	
	$gramGrp = $entry->getElementsByTagName( 'gramGrp' );
	if( $gramGrp[ 0 ] && $gramGrp[ 0 ]->firstElementChild )
	{
		$品詞名 = $gramGrp[ 0 ]->firstElementChild->tagName;
		
		if( ! array_key_exists( $品詞名, $品詞陣列 ) )
		{
			$品詞陣列[ $品詞名 ] = 1;
		}
		else
		{
			$品詞陣列[ $品詞名 ]++;
		}
	}
	elseif( !$firstFound )
	{
		echo $entry->saveXML(), NL;
		$firstFound = true;
	}
}

print_r( $品詞陣列 );
$total = 0;
foreach( $品詞陣列 as $品詞 => $數 )
{
	$total += $數;
}
echo 'total ', $total, NL;
echo 'count ', $count, NL;
?>