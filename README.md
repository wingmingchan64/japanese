# japanese
<h1>Using PHP to Facilitate the Learning of Japanese</h1>
<h2>和独辞典</h2>
<ul>
<li>As of January 5, 2025, the <a href="https://wadoku.de/wiki/display/WAD/Downloads+und+Links">XML dump</a> contains 433,218 entries</li>
<li><a href="https://github.com/wingmingchan64/japanese/tree/main/programs/wadoku">id_kanji_kana_accent.txt</a> containing 433,218 entries extracted from the XML file</li>
<li>Create a PHP file containing an array mapping entry id to entry XML (too big, 237MB, to upload to github)</li>
<li>Create a map, containing 漢字-ID pairs for easy lookup</li>
<li>Create a map, containing 仮名-ID pairs for easy lookup</li>
<li>I only provide the programs used to create these files</li>
<li>With an ID, the XML content can be retrieved, processed and displayed</li>
<li>Information contained in the XML: ID, 漢字, 仮名, pitch accent, meanings (in German)</li>
</ul>