<h1>Using PHP to Facilitate Japanese Learning</h1>
<h2>Useful Generated Data Files</h2>
<p>The following are files containing useful data generated from various sites.</p>
<p>Data files generated from the wadoku database:</p>
<ul>
<li><a href="https://github.com/wingmingchan64/japanese/blob/main/programs/wadoku/%E4%B8%80e%E6%AE%B5%E5%8B%95%E8%A9%9E.php">一e段動詞.php</a></li>
<li><a href="https://github.com/wingmingchan64/japanese/blob/main/programs/wadoku/%E4%B8%80i%E6%AE%B5%E5%8B%95%E8%A9%9E.php">一i段動詞.php</a></li>
<li><a href="https://github.com/wingmingchan64/japanese/blob/main/programs/wadoku/%E4%BA%94%E6%AE%B5%E5%8B%95%E8%A9%9E.php">五段動詞.php</a></li>
<li><a href="https://github.com/wingmingchan64/japanese/blob/main/programs/wadoku/%E4%BA%94%E6%AE%B5%E3%81%84%E3%81%88%E5%8B%95%E8%A9%9E.txt">五段いえ動詞.txt</a></li>
<li><a href="https://github.com/wingmingchan64/japanese/blob/main/programs/wadoku/%E5%BD%A2%E5%AE%B9%E8%A9%9E.php">形容詞.php</a> （い形容詞）</li>
<li><a href="https://github.com/wingmingchan64/japanese/blob/main/programs/wadoku/%E5%BD%A2%E5%AE%B9%E5%8B%95%E8%A9%9E.php">形容動詞.php</a> （な形容詞）</li>
<li>A dozen of other files containing words of various parts of speech; the only one left out is nouns (more than 200,000 of them)</li>
<li>There are more useful files, but they are too big to upload to github</li>
</ul>
<p>The following is a file generated from JapanDict:</p>
<ul>
<li><a href="https://github.com/wingmingchan64/japanese/blob/main/programs/japandict/japandict_romaji_kana.php">japandict_romaji_kana.php</a></li>
</ul>
<p>I am still exploring jisho.org, wadoku.de, japandict.com, weblio.jp and so on, and see what information I can gather from them.</p>
<!--
<ul>
<li><a href=""></a></li>
<li><a href=""></a></li>
<li><a href=""></a></li>
<li><a href=""></a></li>
<li><a href=""></a></li>
<li><a href=""></a></li>
<li><a href=""></a></li>
<li><a href=""></a></li>
</ul>
-->
<h2>Dictionary Lookup</h2>
<h3>jisho.org</h3>
<ul>
<li>The best thing about this site is that Romaji can be used to query the dictionary (JapanDict can do that as well)</li>
<li>There is no easy way to extract the available entries from the site</li>
<li>I decide to query the site directly, one entry at a time</li>
</ul>
<pre>
H:\php809>php h:\github\japanese\programs\search.php
要搜索甚麼？請輸入選項數字；用 exit 來結束。
Array
(
    [0] => 輸入日本語
    [1] => 輸入日[に]本[ほん]語[ご]
    [2] => 輸入日[に]本[ほん]語[ご⓪]
    [3] => 輸入日本語[にほんご⓪]
    [4] => 查詢辭書
    [5] => 漢字→動詞變形
)
4
請輸入詞條：
kaeru


Jisho.org:
=================================
帰る[かえる] kaeru

1.  to return; to come home; to go home; to go back
2.  to leave (of a guest, customer, etc.)
3.  to get home; to get to home plate</pre>
<hr />
<h3>和独辞典</h3>
<ul>
<li>As of January 5, 2025, the <a href="https://wadoku.de/wiki/display/WAD/Downloads+und+Links">XML dump</a> contains 433,218 entries</li>
<li><a href="https://github.com/wingmingchan64/japanese/tree/main/programs/wadoku">id_kanji_kana_accent.txt</a> containing 433,218 entries extracted from the XML file</li>
<li>I create a PHP file containing an array mapping entry id to entry XML (too big, 237MB, to upload to github)</li>
<li>I create a map, containing 漢字-ID pairs for easy lookup</li>
<li>I create a map, containing 仮名-ID pairs for easy lookup</li>
<li>I only provide the <a href="https://github.com/wingmingchan64/japanese/tree/main/programs/wadoku">programs</a> used to create these files</li>
<li>With an ID, the XML content can be retrieved, processed and displayed</li>
<li>Information contained in the XML: ID, 漢字, 仮名, pitch accent, meanings (in German) and so on</li>
<li>I create these files locally to avoid querying the website directly</li>
<li>After querying jisho.org, the kanji version of the entry is passed onto 和独辞典</li>
</ul>
<pre>
wadoku.de:
=================================
Pitch accent: 帰る[かえる➀]

Meaning:
1.  zurückgehen
2.  zurückkommen
3.  heimkehren
4.  heimkommen
5.  nach Hause gehen
6.  nach Hause kommen
</pre>
<ul>
<li>Since I am learning Japanese (as a beginner), I am also interested in statistics in the language</li>
<li>I use the wadoku xml as a resource and write programs to gather statistical information</li>
<li>For example, from <a href="https://github.com/wingmingchan64/japanese/blob/main/programs/wadoku/%E7%B5%B1%E8%A8%88%E6%95%B8%E5%AD%97.php">統計數字.php</a>, I found that there are 7672 verbs in wadoku</li>
<li>For lists of verbs, see <a href="https://github.com/wingmingchan64/japanese/tree/main/programs/wadoku">wadoku</a></li>
</ul>
<hr />
<h3>JapanDict</h3>
<ul>
<li>This site also accepts Romaji</li>
<li>After querying jisho.org, the kanji version of the entry is passed onto the site</li>
<li>Example sentences are extracted and displayed</li>
</ul>
<pre>
JapanDict:
=================================
Examples:
恋人よ、我に帰れ。
恋人  よ  、  我  に  帰れ  。
Lover, come back to me.

１１時を過ぎると、お客たちは三々五々帰り始めた。
１１  時  を  過ぎる  と  、  お  客  たち  は  三々五々  帰り  始めた  。
After 11 o'clock the guests began to leave by twos and threes.
</pre>
<ul>
<li>I also extract more than 200,000 entries with IDs from the site</li>
</ul>


<h2>Inputting Japanese</h2>
<ul>
<li>I write my own program to enable easy input of Japanese</li>
<li>The program works with my own dictionaries and data files generated from sites mentioned above</li>
<li>Since I can compile my own dictionaries, the program can output different versions of Japanese texts:
<ul>
<li>漢字、仮名 only</li>
<li>漢字、仮名 with 振仮名</li>
<li>漢字、仮名 with 振仮名 and pitch accent markers</li>

<li>Any text can be put into various dictionaries for output; for example, the program can output <kbd>もう[➀]一[いち]度[ど➂]お願[ねが⓪]いします</kbd> as a single entry with the key <kbd>mouichido..</kbd></li>
</ul>
</li>
<li>Any keys can be used, and currently I am compiling a dictionary using Cantonese pinyin as keys; example: <kbd>saam1gaai1</kbd> as the key and <kbd>[さん]階[がい⓪]</kbd> as the output</li>
</ul>
<pre>
H:\php809>php h:\github\japanese\programs\search.php
要搜索甚麼？請輸入選項數字；用 exit 來結束。
Array
(
    [0] => 輸入日本語
    [1] => 輸入日[に]本[ほん]語[ご]
    [2] => 輸入日[に]本[ほん]語[ご⓪]
    [3] => 輸入日本語[にほんご⓪]
    [4] => 查詢辭書
    [5] => 漢字→動詞變形
)
2
Enter a command (clr, del, show, quit) or a Romaji
mouichido..
Array
(
    [0] =>
    [1] => もう[➀]一[いち]度[ど➂]
    [2] => もう[➀]一[いち]度[ど➂]お願[ねが⓪]いします
)
2
=>もう[➀]一[いち]度[ど➂]お願[ねが⓪]いします
Enter a command (clr, del, show, quit) or a Romaji
saam1gaai1
=>もう[➀]一[いち]度[ど➂]お願[ねが⓪]いします[さん]階[がい⓪]
Enter a command (clr, del, show, quit) or a Romaji
</pre>
<ul>
<li>If no entries are found in my dictionaries, the program will look at the wadoku files to find the entry</li>
</ul>
<pre>
Enter a command (clr, del, show, quit) or a Romaji
oohashi
Array
(
    [0] => 大嘴[おおはし⓪]
    [1] => 大橋[おおはし➀]
)
1
=>大橋[おおはし➀]
</pre>
<hr />

<h2>Verb Conjugation</h2>
<ul>
<li>I follow the <a href="https://conjugator.reverso.net/conjugation-rules-model-japanese.html">model</a> approach of Reverso</li>
<li>I start with the <a href="https://conjugator.reverso.net/index-japanese-1-250.html">2000 common verbs</a></li>
<li>I associate each verb with its corresponding model verb</li>
<li>Each model verb is associated with a template</li>
<li>A verb is reduced to its stem and the stem is plugged into the template</li>
</ul>
<pre>
H:\php809>php h:\github\japanese\programs\search.php
要搜索甚麼？請輸入選項數字；用 exit 來結束。
Array
(
    [0] => 輸入日本語
    [1] => 輸入日[に]本[ほん]語[ご]
    [2] => 輸入日[に]本[ほん]語[ご⓪]
    [3] => 輸入日本語[にほんご⓪]
    [4] => 查詢辭書
    [5] => 漢字→動詞變形
)
5
請輸入漢字動詞：
帰る


Array
(
    [Present] => 帰る,帰ります,帰らない,帰りません
    [Past] => 帰った,帰りました,帰らなかった,帰りませんでした
    [-te Form] => 帰って,帰らなくて
    [-te Form Rule] => stem + って
    [Volitional] => 帰ろう,帰りましょう
    [Potential] => 帰れる,帰れます,帰れない,帰れません
    [Passive] => 帰られる,帰られます,帰られない,帰られません
    [Causative] => 帰らせる,帰らせます,帰らせない,帰らせません
    [Imperative] => 帰れ,帰ってください,帰るな,帰らないでください
    [Condition] => 帰れば,帰れなければ
    [Condition (-tara)] => 帰ったら,帰らなかったら
)
</pre>
