<?php
require_once( 'H:\github\japanese\programs\model\来る動詞.php' );
require_once( 'H:\github\japanese\programs\model\だ動詞.php' );
require_once( 'H:\github\japanese\programs\model\問う動詞.php' );
require_once( 'H:\github\japanese\programs\model\買う動詞.php' );
require_once( 'H:\github\japanese\programs\model\書く動詞.php' );
require_once( 'H:\github\japanese\programs\model\行く動詞.php' );
require_once( 'H:\github\japanese\programs\model\泳ぐ動詞.php' );
require_once( 'H:\github\japanese\programs\model\指す動詞.php' );
require_once( 'H:\github\japanese\programs\model\待つ動詞.php' );
require_once( 'H:\github\japanese\programs\model\死ぬ動詞.php' );
require_once( 'H:\github\japanese\programs\model\飲む動詞.php' );
require_once( 'H:\github\japanese\programs\model\呼ぶ動詞.php' );
require_once( 'H:\github\japanese\programs\model\ある動詞.php' );
require_once( 'H:\github\japanese\programs\model\くれる動詞.php' );
require_once( 'H:\github\japanese\programs\model\なさる動詞.php' );
require_once( 'H:\github\japanese\programs\model\入る動詞.php' );
require_once( 'H:\github\japanese\programs\model\食べる動詞.php' );
require_once( 'H:\github\japanese\programs\model\愛する動詞.php' );
require_once( 'H:\github\japanese\programs\model\接する動詞.php' );
require_once( 'H:\github\japanese\programs\model\禁ずる動詞.php' );

$動詞表=array(
'来る'=>$来る動詞,
'だ'=>$だ動詞,
// 五段 う
'問う'=>$問う動詞,
'買う'=>$買う動詞,
// 五段 つ
'待つ'=>$待つ動詞,
// 五段 る
'ある'=>$ある動詞,
'くれる'=>$くれる動詞,
'なさる'=>$なさる動詞,

// 五段 く
'書く'=>$書く動詞,
'行く'=>$行く動詞,
// 五段 ぐ
'泳ぐ'=>$行く動詞,
// 五段 す
'指す'=>$指す動詞,

// 五段 ぬ
'死ぬ'=>$死ぬ動詞,
// 五段 む
'飲む'=>$飲む動詞,
// 五段 ぶ
'呼ぶ'=>$呼ぶ動詞,

// 五段 り exception
// 入走要帰限切 喋知蹴滑焦減 like 五段
'入る'=>$入る動詞,
// 一段: $stem by removing る, before る is i/e sound
// https://www.youtube.com/watch?v=Fxib4q73vl8
// 上一段： いる
// 下一段： える
'食べる'=>$食べる動詞,
// 一段: する
'愛する'=>$愛する動詞,
'接する'=>$接する動詞,
'禁ずる'=>$禁ずる動詞,
// skip all other する verbs like 生成する
/*
五段
https://www.youtube.com/watch?v=UHo3qUb79No
-u, -tsu, -mu, -bu, -nu, -ku, -gu, -su, -ru (not after i/e)
未然形[みぜんけい]： か + ない(negative)、ず(without)、ぬ、（ら）れる(receptive/passive)、（さ）せる(causative)
連用形[れんようけい]： き + ます、たい、noun、verb、
連体形[れんたいけい]： く
終止形[しゅうしけい]： く
命令形[めいれいけい]： け
仮定形[かていけい]： け
可能形[かのうけい]： け
意向形[いこうけい]： こ + う

-te form
https://www.youtube.com/watch?v=HAdmKhVjVs8
う、つ、る： って 買う：買って、持つ：持って、走る：走って
ぬ、ぶ、む： んで 死んで 遊んで 飲んで
く： いて 步いて
ぐ： いで 泳いで
す： して 話して

一段： て 食べて
する： して
来る： 来て
行く： 行って
問う： 問うて
*/
);
?>