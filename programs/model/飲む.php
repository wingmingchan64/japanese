<?php
/*
https://www.youtube.com/watch?v=cGA6Tj9_lSg
五段
い-stem：連用形
たい（desire） 飲みたい
attached to nouns 飲み物
attached to another verb 話し合う
turns a verb to a noun 休み、夏休み

あ-stem：ない、ず、ぬ、（ら）れる、（さ）せる
negative：ない、ず、ぬ

*/
$飲む=array(
'Present'=>"${stem}む,${stem}みます,${stem}まない,${stem}みません",
'Past'=>"${stem}んだ,${stem}みました,${stem}まなかった,${stem}みませんでした",
'Past Rule'=>"stem + んだ; み+た becomes んだ (voice assimilation)",
'-te Form'=>"${stem}んで,${stem}まなくて",
'-te Form Rule'=>"stem + んで; み+て becomes んで (voice assimilation)",
'Volitional'=>"${stem}もう,${stem}みましょう",
'Potential'=>"${stem}める,${stem}めます,${stem}めない,${stem}めません",
'Passive'=>"${stem}まれる,${stem}まれます,${stem}まれない,${stem}まれません",
'Causative'=>"${stem}ませる,${stem}ませます,${stem}ませない,${stem}ませません",
'Imperative'=>"${stem}め,${stem}んでください,${stem}むな,${stem}まないでください",
'Condition'=>"${stem}めば,${stem}めなければ",
'Condition (-tara)'=>"${stem}んだら,${stem}まなかったら",
);
?>