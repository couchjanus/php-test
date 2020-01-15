<?php

function lengthOfLongestSubstring($str) {
    $ans = 0;
    $hash = [];
    for ($i = $j = 0, $l = strlen($str); $j < $l; $j++) {
        if (isset($hash[$str[$j]])) {
            $i = max($i, $hash[$str[$j]] + 1);
        }
        $ans = max($ans, $j - $i + 1);
        $hash[$str[$j]] = $j;
    }
    return [$ans, $hash];
}

function key_implode(&$array) {
    $result = "";
    foreach ($array as $key => $value) {
        $result .= $key;
    }
    return $result;
}

function myPrint($str) {
    echo "the string is :" . $str;
    echo "\n";
    list($len, $hash) = lengthOfLongestSubstring($str);
    echo "\n";
    var_dump($hash);
    echo "\n";
    echo "longest string is :" . key_implode($hash);
    echo "\n";
    echo "longest string length is :" . $len;
    echo "\n";
}

myPrint('abcabcbb'); // abc, echo 3
// myPrint('bbbbb'); // b, echo 1
// myPrint('pwwkew'); // wke, echo 3
