<?php
/*
php H:\github\japanese\programs\id→xml.php 6720086
<entry xmlns="http://www.wadoku.de/xml/entry" id="6720086" version="1.6" HE="true">
 <form>
  <orth midashigo="true">×綺麗</orth>
  <orth midashigo="true">奇麗</orth>
  <orth midashigo="true">×暉麗</orth>
  <orth>きれい</orth>
  <orth>キレイ</orth>
  <orth>奇麗</orth>
  <orth type="irreg">綺麗</orth>
  <orth type="irreg">暉麗</orth>
  <reading>
   <hira>きれい</hira>
   <hatsuon>き'れい</hatsuon>
   <accent>1</accent>
  </reading>
 </form>
 <gramGrp>
  <keiyoudoushi/>
 </gramGrp>
 <sense>
  <trans><tr><token genus="f" type="N">Schönheit</token></tr></trans>
  <trans><tr><token genus="f" type="N">Sauberkeit</token></tr></trans>
  <trans><tr><token genus="f" type="N">Ordentlichkeit</token></tr></trans>
 </sense>
 <sense>
  <trans><tr><token genus="f" type="N">Vollständigkeit</token></tr></trans>
 </sense>
 <sense>
  <trans><tr><token genus="f" type="N">Fairness</token></tr></trans>
  <trans><tr><token genus="f" type="N">Ehrlichkeit</token></tr></trans>
 </sense>
 <sense>
  <trans><tr><token genus="f" type="N">Vollständigkeit</token></tr></trans>
  <trans><tr><token genus="f" type="N">Restlosigkeit</token></tr></trans>
 </sense>
 <ruigos>
  <ruigo id="2382847"/><ruigo id="6373406"/>
 </ruigos>
</entry>
*/
ini_set('memory_limit', '-1');

require_once( "h:\\github\\japanese\\programs\\函式.php" );
require_once( 'H:\japanese\programs\wadoku\data\和獨id_xml_entry.php' );
checkARGV( $argv, 2, 輸入id );
$term = trim( $argv [ 1 ] );

if( array_key_exists( $term, $和獨id_xml_entry ) )
{
	echo $和獨id_xml_entry[ $term ];
}
else
{
	echo 無此id;
}
?>