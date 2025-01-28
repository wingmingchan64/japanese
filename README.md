<h1>Using PHP to Facilitate Japanese Learning</h1>
<h2>jisho.org</h2>
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
<h2>和独辞典</h2>
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
<li>Example: <a href=""></a></li>
</ul>
<hr />
<h2>JapanDict</h2>
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
<li>The file <a href="https://github.com/wingmingchan64/japanese/blob/main/programs/japandict/romaji_kanji_kana.php">romaji_kanji_kana.php</a> is created</li>
</ul>


<h2>Inputting Japanese</h2>
<ul>
<li>I write my own program to enable easy input of Japanese</li>
<li>The program works with my own dictionaries as well as <a href="https://github.com/wingmingchan64/japanese/blob/main/programs/japandict/romaji_kanji_kana.php">romaji_kanji_kana.php</a></li>
<li>Since I can compile my own dictionaries, the program can output different versions of Japanese texts:
<ul>
<li>漢字、仮名 only</li>
<li>漢字、仮名 with 振仮名</li>
<li>漢字、仮名 with 振仮名 and pitch accent markers</li>

<li>Any text can be put into various dictionaries for output; for example, the program can output もう[➀]一[いち]度[ど➂]お願[ねが⓪]いします as a single entry with the key mouichido..</li>
</ul>
</li>
<li>Any keys can be used, and currently I am compiling a dictionary using Cantonese pinyin as keys; example: saam1gaai1 as the key and [さん]階[がい⓪] as the output</li>
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
<li>When an entry does not exist in any of my own dictionaries, the program will look at <a href="https://github.com/wingmingchan64/japanese/blob/main/programs/japandict/romaji_kanji_kana.php">romaji_kanji_kana.php</a></li>
<li>This file contains more than 180,000 entries (more than 210,000 words and phrases)</li>
<li>Each entry is a 漢字[仮名] string (or an array of such strings), possibly with an accent marker pulled from wadoku</li>
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
