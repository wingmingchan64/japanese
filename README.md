# japanese
<h1>Using PHP to Facilitate Japanese Learning</h1>
<h2>jisho.org</h2>
<ul>
<li>The best thing about this site is that Romaji can be used to query the dictionary</li>
<li>There is no easy way to extract the available entries from the site</li>
<li>I decide to query the site directly, one entry at a time</li>
<li>Command: <quote>H:\php809>php H:\github\japanese\programs\查詢辭書.php kaeru</quote></li>
</ul>
<pre>
Jisho.org:
=================================
帰る[かえる] kaeru

1.  to return; to come home; to go home; to go back
2.  to leave (of a guest, customer, etc.)
3.  to get home; to get to home plate</pre>
<hr />
<h2>和独辞典</h2>
<ul>
<li>As of January 5, 2025, the <a href="https://wadoku.de/wiki/display/WAD/Downloads+und+Links">XML dump</a> contains 433,218 entries</li>
<li><a href="https://github.com/wingmingchan64/japanese/tree/main/programs/wadoku">id_kanji_kana_accent.txt</a> containing 433,218 entries extracted from the XML file</li>
<li>Create a PHP file containing an array mapping entry id to entry XML (too big, 237MB, to upload to github)</li>
<li>Create a map, containing 漢字-ID pairs for easy lookup</li>
<li>Create a map, containing 仮名-ID pairs for easy lookup</li>
<li>I only provide the <a href="https://github.com/wingmingchan64/japanese/tree/main/programs/wadoku">programs</a> used to create these files</li>
<li>With an ID, the XML content can be retrieved, processed and displayed</li>
<li>Information contained in the XML: ID, 漢字, 仮名, pitch accent, meanings (in German)</li>
<li>I create these files locally to avoid querying the website directly</li>
<li>After querying jisho.org, the kanji version of the entry is passed onto 和独辞典</li>
</ul>
<pre>
wadoku.de:
=================================
Pitch accent: 1

Meaning:
1.  zurückgehen
2.  zurückkommen
3.  heimkehren
4.  heimkommen
5.  nach Hause gehen
6.  nach Hause kommen
</pre>