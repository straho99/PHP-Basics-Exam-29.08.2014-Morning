<?php
$text = "Hi <>PHP5";//$_GET['text'];
$minFontSize = 4;//$_GET['minFontSize'];
$maxFontSize = 8;//$_GET['maxFontSize'];
$step = 3;//$_GET['step'];
$output = "";
$currentFontSize = $minFontSize;
$minFontSize++;
for ($i = 0; $i < strlen($text); $i++) {
    $output .= spanIt($text[$i], $currentFontSize);
    if (ctype_alpha($text[$i])) {
        $currentFontSize += $step;
        if ($currentFontSize >= $maxFontSize || $currentFontSize < $minFontSize) {
            $step = -$step;
        }
    }
}
echo $output;

function spanIt($char, $fontSize)
{
    $result = "<span style='font-size:" . htmlspecialchars($fontSize) . ";";
    if (ord($char) % 2 == 0) {
        $result .= "text-decoration:line-through;'>";
    } else {
        $result .= "'>";
    }
    $result .= htmlspecialchars($char) . "</span>";
    return $result;
}
?>