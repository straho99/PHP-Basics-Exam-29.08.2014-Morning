<?php
$input = ($_GET['text']);
//echo ($input);
$lines = preg_split("/\r?\n/", $input);
//var_dump($lines);
$articles = [];
foreach ($lines as $line) {
    $tokens=[];
    preg_match("/\s*([\w -]+)\s*\%\s*([. \-a-zA-Z]+)\s*;\s*[0-9]{2}-([0-9]{2})-[0-9]{4}\s*-\s*(.{1,100})/", $line, $tokens);
//    var_dump($tokens);
    if ($tokens) {
        $articleTopic = trim($tokens[1]);
        $author = trim($tokens[2]);
        $articleDate = trim($tokens[3]);
        $summary = trim($tokens[4]);
        $article = array(
            'Topic' => $articleTopic,
            'Author' => $author,
            'When' => trim($articleDate),
            'Summary' => $summary
        );
        $articles[]=$article;
    }
}
//var_dump($articles);
foreach ($articles as $article) {
    $theMonth = getMonth($article['When']);
//    var_dump($theMonth);
    echo "<div>\n";
    echo "<b>Topic:</b> <span>" . htmlspecialchars($article['Topic']) . "</span>\n";
    echo "<b>Author:</b> <span>" . htmlspecialchars($article['Author']) . "</span>\n";
    echo "<b>When:</b> <span>" . htmlspecialchars($theMonth) . "</span>\n";
    echo "<b>Summary:</b> <span>" . htmlspecialchars($article['Summary']) . "...</span>\n";
    echo "</div>\n";
}

function getMonth($month) {
    switch ($month) {
        case '01':
            return 'January';
            break;
        case '02':
            return 'February';
            break;
        case '03':
            return 'March';
            break;
        case '04':
            return 'April';
            break;
        case '05':
            return 'May';
            break;
        case '06':
            return 'June';
            break;
        case '07':
            return 'July';
            break;
        case '08':
            return 'August';
            break;
        case '09':
            return 'September';
            break;
        case '10':
            return 'October';
            break;
        case '11':
            return 'November';
            break;
        case '12':
            return 'December';
            break;
    }
}
?>