<?php
const NL = "\r\n";
const 選項指令 = "要搜索甚麼？請輸入選項數字；用 exit 來結束。\n";
const 搜索程式 = array(
	'輸入日本語' => '請輸入羅馬字：' . NL, // just 漢字 & 假名
	'輸入日本語[にほんご]' => '請輸入羅馬字：' . NL,
	'輸入日[に]本[ほん]語[ご⓪]' => '請輸入羅馬字：' . NL,
	'輸入日本語[にほんご⓪]' => '請輸入羅馬字：' . NL,
	'查詢辭書' => '請輸入詞條：' . NL,
	'漢字→動詞變形' => '請輸入漢字動詞：' . NL,
	'漢字→音調標記' => '請輸入漢字詞：' . NL, // wadoku
	'漢字→羅馬字、音調標識' => '請輸入漢字詞：' . NL, // wadoku
	//'漢字→詞義' => '請輸入漢字詞：' . NL,
	//'漢字→假名' => '請輸入漢字詞：' . NL,
	//'漢字、假名→羅馬字' => '請輸入漢字、假名詞：' . NL,
	//'羅馬字→詞義' => '請輸入羅馬字詞：' . NL,
	//'羅馬字→音調標記' => '請輸入羅馬字詞：' . NL,
	//'假名→漢字' => '請輸入假名詞：' . NL,
	'羅馬字→JapanDict' => '請輸入羅馬字：' . NL,
	'羅馬字→假名、音調標記' => '請輸入羅馬字詞：' . NL,
);
const 程式文件夾 = "H:\\github\\japanese\\programs\\";
const 程式後綴 = '.php';
const 輸入詞條 = "必須輸入詞條";
const 輸入漢字詞 = "必須輸入漢字詞";
const 輸入漢字、假名詞 = "必須輸入漢字、假名詞";
const 輸入假名詞 = "必須輸入假名詞";
const 輸入羅馬字詞 = "必須輸入羅馬字詞";
const 輸入id = "必須詞條 id";
const 無此漢字詞 = "沒找到此漢字詞" . NL;
const 無此假名詞 = "沒找到此假名詞" . NL;
const 無此漢字、假名詞 = "沒找到此漢字、假名" . NL;
const 無此羅馬字詞 = "沒找到此羅馬字" . NL;
const 輸入程式名稱 = "程式名稱" . NL;
const 無此id = "沒找到此 id" . NL;


const DELIMITER = '，';
const BRACKET_REGEX = '/\[\X+?]/';
const MARKER_ARRAY = array( '⓪','➀','➁','➂','➃','➄','➅','➆','➇' );
const ACCENT_NUM = '⓪';
const ACCENT_KANA = "/あ\\";
const ACCENT_ROMAJI = "/a\\";
$accent_num    = ACCENT_NUM;
$accent_kana   = ACCENT_KANA;
$accent_romaji = ACCENT_ROMAJI;

$HIRAGANA_RANGE = range( hexdec( '3040' ), hexdec( '309F' ) );
$KATAKANA_RANGE = range( hexdec( '30A0' ), hexdec( '30FF' ) );

?>