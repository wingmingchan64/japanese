<h1>Using PHP to Facilitate Japanese Learning</h1>
<h2>Useful Generated Data Files</h2>
<p>The following are files containing useful data generated from various sites.</p>
<p>Data files generated from the wadoku database:</p>
<ul>
<li><a href="https://github.com/wingmingchan64/japanese/blob/main/programs/wadoku/%E4%B8%80%E6%AE%B5%E3%81%84%E5%8B%95%E8%A9%9E.php">一段い動詞.php</a></li>
<li><a href="https://github.com/wingmingchan64/japanese/blob/main/programs/wadoku/%E4%B8%80%E6%AE%B5%E3%81%88%E5%8B%95%E8%A9%9E.php">一段え動詞.php</a></li>
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
<li>I find this XML dump (I call it the wadoku database) extremely useful</li>
<li>I create a PHP file containing an array mapping entry id to entry XML</li>
<li>I create a map, containing 漢字-ID pairs for easy lookup</li>
<li>I create a map, containing 仮名-ID pairs for easy lookup</li>
<li>I create a map, containing 羅馬名-漢字-仮名 combinations for easy lookup</li>
<li>Since these files are very large, I provide instead the <a href="https://github.com/wingmingchan64/japanese/tree/main/programs/wadoku">programs</a> used to create these files</li>
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
<li>I use the wadoku database as a resource and write programs to gather statistical information</li>
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
<h2>Homonyms and Variants</h2>
<ul>
<li>I have a program named <kbd>run_program.php</kbd> that can execute another program, with programmatic and user parameters, repeatedly</li>
<li>When the program named <kbd>羅馬字→漢字、假名、音調.php</kbd> with the programmatic parameter <kbd>accent_kana</kbd> is executed, this program can be used to display homonyms and variants drawn from the wadoku database</li>
<li>I can memorize not just a single word, but a group of related variants as well as homoyms</li>
</ul>
<pre>
H:\php809>php h:\github\japanese\programs\run_program.php "羅馬字→漢字、假名、音調 accent_kana"
請輸入參數:
tobu

Array
(
    [0] => 飛ぶ[と/ぶ]
    [1] => 跳ぶ[と/ぶ]
)

請輸入參數:
tsuku

Array
(
    [0] => 付く[つ\く]
    [1] => 附く[つ\く]
    [2] => 点く[つ\く]
    [3] => 浸く[つ\く]
    [4] => 漬く[つ\く]
    [5] => 即く[つ\く]
    [6] => 着く[つ\く]
    [7] => 築く[つ\く]
    [8] => 就く[つ\く]
    [9] => 吐く[つ\く]
    [10] => 搗く[つ\く]
    [11] => 舂く[つ\く]
    [12] => 憑く[つ\く]
    [13] => 突く[つ\く]
    [14] => 衝く[つ\く]
    [15] => 撞く[つ\く]
)
</pre>
<ul>
<li>Because I know all common Japanese 漢字 and many many more Chinese 漢字, I can link homomyns and variants like <code>搗く、舂く</code>, <code>衝く、突く、撞く</code>, <code>就く、即く、着く</code>, <code>点く、付く</code> and <code>付く、憑く</code> as related groups and memorize them as groups; and all 16 homonyms and variants can also be treated as a single group</li>
<li>It is easier to see the relation if the transitive group is added to the picture:</li>
</ul>
<pre>
Array
(
    [0] => 即ける[つ/け\る]
    [1] => 卽ける[つ/け\る]
    [2] => 就ける[つ/け\る]
    [3] => 浸ける[つ/ける]
    [4] => 漬ける[つ/ける]
    [5] => 付ける[つ/け\る]
    [6] => 附ける[つ/け\る]
    [7] => 点ける[つ/け\る]
    [8] => 付ける[つ/け\る]
    [9] => 着ける[つ/け\る]
)
</pre>
<ul>
<li>I have also memorized homomyns like <code>片付ける[か/たづけ\る]</code> and <code>嫁ける[か/たづけ\る]</code> as a pair (one of the meanings of 片付ける is to marry off a daughter) by making up a phrase like to marry off a daughter to clean up someone's house</li>
</ul>
<h2>Entries Containing a 漢字</h2>
<ul>
<li>The program <kbd>run_program.php</kbd> can also be used to drive other programs</li>
<li>Three related programs can be driven to display wadoku entries containing a certain 漢字 as the first 字, last 字, or anywhere in the entries</li>
</ul>
<pre>
H:\php809>php h:\github\japanese\programs\run_program.php "漢字→尾字漢字詞條 accent_kana"
請輸入參數:
尾

Array
(
    [0] => 尾[お\]
    [1] => 竜頭蛇尾[りゅ/うとうだ\び]
    [2] => 龍頭蛇尾[りゅ/うとうだ\び]
    [3] => 巻尾[か\んび]
    [4] => 巻(き)尾[ま/きお]
    [5] => 巻き尾[ま/きお]
    [6] => 巻尾[ま/きお]
    [7] => …尾[…/び]
    [8] => 永尾[な/がお]
    [9] => 豚尾[ぶたお]
    [10] => 豚尾[とんび]
    [11] => 大尾[おおお]
    [12] => 大尾[た\いび]
    [13] => 花虎の尾[は/なとらの\お]
    [14] => ハナトラノオ[は/なとらの\お]
    [15] => 花とらのお[は/なとらの\お]
    [16] => 不首尾[ふ/しゅ\び]
    [17] => 栂尾[とがのお]
    [18] => 高護田鳥尾[た/かうすびょ\う]
    [19] => 高護田鳥斑[た/かうすびょ\う]
    [20] => 鷹護田鳥尾[た/かうすびょ\う]
    [21] => 鷹護田鳥斑[た/かうすびょ\う]
    [22] => 頭尾[と\うび]
    [23] => 鳶尾[い/ちはつ]
    [24] => 一八[い/ちはつ]
    [25] => イチハツ[い/ちはつ]
    [26] => 彗星の尾[すいせいのお]
    [27] => すい星の尾[すいせいのお]
    [28] => 角虎の尾[かくとらのお]
    [29] => カクトラノオ[かくとらのお]
    [30] => 角とらのお[かくとらのお]
    [31] => 八尾[や\お]
    [32] => 鳩尾[み/ぞおち]
    [33] => 鳩尾[み/ずおち]
    [34] => 鳩尾[きゅ\うび]
    [35] => きゅう尾[きゅ\うび]
    [36] => 鳩尾[はとお]
    [37] => はと尾[はとお]
    [38] => 後尾[こ\うび]
    [39] => 月尾[つ/きお]
    [40] => 尻尾[し/っぽ\]
    [41] => シッポ[し/っぽ\]
    [42] => 春虎(の)尾[は/るとらの\お]
    [43] => ハルトラノオ[は/るとらの\お]
    [44] => 春虎の尾[は/るとらの\お]
    [45] => 春虎尾[は/るとらの\お]
    [46] => 凧の尾[たこのお]
    [47] => 無尾[むび]
    [48] => 末尾[ま\つび]
    [49] => 蛇尾[だ\び]
    [50] => 石尾[い/しお]
    [51] => 上首尾[じょ/うしゅ\び]
    [52] => 横尾[よ/こお]
    [53] => 驥尾[き\び]
    [54] => き尾[き\び]
    [55] => 断尾[だ\んび]
    [56] => 馬尾[ば\び]
    [57] => 馬尾[す\]
    [58] => 海老尾[え/び\お]
    [59] => 蝦尾[え/び\お]
    [60] => 海老尾[え/び\お]
    [61] => 護田鳥尾[うすびょう]
    [62] => 黶[うすびょう]
    [63] => 上尾[あ/げお]
    [64] => 行列の最後尾[ぎょうれつのさいこうび]
    [65] => 後水尾[ごみずのお]
    [66] => 高尾[た/かお]
    [67] => 孝男[た/かお]
    [68] => 高尾[た/かお]
    [69] => 隆夫[た/かお]
    [70] => 松尾[ま/つお]
    [71] => 燕尾[え\んび]
    [72] => えん尾[え\んび]
    [73] => 短尾[た\んび]
    [74] => 追尾[つ\いび]
    [75] => 牛尾[ぎゅ\うび]
    [76] => 牛尾[う/しお]
    [77] => 潮[う/しお]
    [78] => 砲尾[ほうび]
    [79] => 無首尾[む/しゅび]
    [80] => 鴟尾[し\び]
    [81] => 鵄尾[し\び]
    [82] => 蚩尾[し\び]
    [83] => 長尾[ちょ\うび]
    [84] => 長尾[な/がお]
    [85] => ねずみの尾[ねずみのお]
    [86] => 敏尾[と/しお]
    [87] => 敏尾[と/しお]
    [88] => 終尾[しゅ\うび]
    [89] => 岡虎の尾[お/かとらの\お]
    [90] => 西尾[に/しお]
    [91] => 語尾[ご\び]
    [92] => 掉尾[と\うび]
    [93] => とう尾[と\うび]
    [94] => 棹尾[と\うび]
    [95] => 掉尾[ちょ\うび]
    [96] => 棹尾[ちょ\うび]
    [97] => 掉尾[と\うび]
    [98] => とう尾[と\うび]
    [99] => 棹尾[と\うび]
    [100] => 虎の尾[と/らの\お]
    [101] => トラノオ[と/らの\お]
    [102] => 結尾[け\つび]
    [103] => 澪[み/お]
    [104] => 水脈[み/お]
    [105] => 水尾[み/お]
    [106] => 銃尾[ぢゅうび]
    [107] => 船尾[せ\んび]
    [108] => 銀宝[ぎ/んぽ]
    [109] => 銀尾[ぎ/んぽ]
    [110] => ギンポ[ぎ/んぽ]
    [111] => 銀寶[ぎ/んぽ]
    [112] => 徹頭徹尾[て/っとうて\つび]
    [113] => 男性語尾[だ/んせ\いごび]
    [114] => 交尾[こ\うび]
    [115] => 中尾[な/かお]
    [116] => 狐の尾[きつねのお]
    [117] => 前尾[ま/えお]
    [118] => 宮尾[み/やお]
    [119] => たこの尾[たこのお]
    [120] => 首尾[しゅ\び]
    [121] => 寺尾[て/らお]
    [122] => 飯尾[い/いお]
    [123] => 神尾[かんお]
    [124] => 神尾[か/みお]
    [125] => 北尾[き/たお]
    [126] => 島尾[し/まお]
    [127] => 符尾[ふ\び]
    [128] => 堀尾[ほ/りお]
    [129] => 足尾[あしお]
    [130] => 広尾[ひろお]
    [131] => 竹尾[た/けお]
    [132] => 活用語尾[か/つようご\び]
    [133] => 若尾[わ/かお]
    [134] => 赤尾[あ/かお]
    [135] => 秋尾[あ/きお]
    [136] => 秋保[あ/きお]
    [137] => 槙尾[まきのお]
    [138] => 藤尾[ふ/じお]
    [139] => 藤生[ふ/じお]
    [140] => 稲尾[い/なお]
    [141] => 稲生[い/なお]
    [142] => 稲雄[い/なお]
    [143] => 格語尾[かくごび]
    [144] => 七尾[ななお]
    [145] => 山尾[や/まお]
    [146] => 自動追尾[じどうついび]
    [147] => 人称語尾[に/んしょうご\び]
    [148] => 板尾[い/たお]
    [149] => 鳥尾[と/りお]
    [150] => 浜尾[は/まお]
    [151] => 深尾[ふ/かお]
    [152] => 懸尾[か/けお]
    [153] => 荒尾[あ/らお]
    [154] => 岩尾[い/わお]
    [155] => 柏尾[か/しお]
    [156] => 浅尾[あ/さお]
    [157] => 渋滞後尾[ぢゅうたいこうび]
    [158] => 派生語尾[はせいごび]
    [159] => 失尾[しつび]
    [160] => 縦に平たい尾[たてにひらたいお]
    [161] => 文尾[ぶ\んび]
    [162] => 妹尾[せ/お]
    [163] => 妹尾[せ/のお]
    [164] => 東尾[ひ/がし\お]
    [165] => 機尾[き\び]
    [166] => 鳩尾[きゅ\うび]
    [167] => きゅう尾[きゅ\うび]
    [168] => 鳩尾[はとお]
    [169] => はと尾[はとお]
    [170] => 紙尾[し\び]
    [171] => 最後尾[さ/いこ\うび]
    [172] => 平尾[ひ/らお]
    [173] => 森尾[も/りお]
    [174] => 栃尾[と/ちお]
    [175] => 田尾[た/お]
    [176] => 下平尾[し/もひ\らお]
    [177] => 鷲尾[わ/しお]
    [178] => 艦尾[か\んび]
    [179] => 栂野尾[とがのお]
    [180] => 根尾[ね/お]
    [181] => 垂れ尾[た/れ\お]
    [182] => 小尾[お/び]
    [183] => 伊野尾[いのお]
    [184] => 伏尾[ふ/せお]
    [185] => 巻(き)尾[ま/きお]
    [186] => 巻き尾[ま/きお]
    [187] => 巻尾[ま/きお]
    [188] => 鎌尾[か/まお]
    [189] => 鎌尾[か/まお]
    [190] => 変化語尾[へ/んかご\び]
    [191] => 孔雀尾[く/ぢゃく\お]
    [192] => クジャク尾[く/ぢゃく\お]
    [193] => くじゃく尾[く/ぢゃく\お]
    [194] => 接尾[せ\つび]
    [195] => 艇尾[て\いび]
    [196] => 金尾[か/なお]
    [197] => 金尾[か/ねお]
    [198] => 仙尾[せ\んび]
    [199] => イオンの尾[いおんのお]
    [200] => プラズマの尾[ぷらずまのお]
    [201] => ダストの尾[だすとのお]
)
</pre>