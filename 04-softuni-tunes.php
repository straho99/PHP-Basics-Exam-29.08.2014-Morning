<?php
$input = urldecode(trim($_GET['text']));
$artist = trim($_GET['artist']);
$sortBy = $_GET['property'];
$orderBy = $_GET['order'];

$songs = [];
$lines = preg_split("/\r?\n/", $input);
foreach ($lines as $line) {
    $tokens = explode('|', $line);
    $name = trim($tokens[0]);
    $genre = trim($tokens[1]);
    $artistsList = trim($tokens[2]);
    $artists = preg_split("/\s*,\s*/", $artistsList, -1, PREG_SPLIT_NO_EMPTY);
    sort($artists, SORT_STRING);
    $downloads = intval(trim($tokens[3]));
    $rating = doubleval(trim($tokens[4]));
    if (in_array($artist, $artists)) {
        $songs[] = array(
            'name' => $name,
            'genre' => $genre,
            'artists' => $artists,
            'downloads' => $downloads,
            'rating' => $rating

        );
    }
}

$sign = 1;
if ($orderBy == "descending") {
    $sign = -1;
}

function compare(&$arrayToSort, $sort, $order) {
    usort($arrayToSort, function($a, $b) use ($sort, $order) {
        if ($a[$sort] > $b[$sort]) {
            return 1 * $order;
        } else if ($a[$sort] == $b[$sort]) {
            return strcmp($a['name'], $b['name']);
//            if ($a['name'] > $b['name']) {
//                return 1 * $order;
//            } else if ($a['name'] == $b['name']) {
//                return 0;
//            } else {
//                return -1 * $order;
//            }
        } else {
            return -1 * $order;
        }
    });
}

switch ($sortBy) {
    case "name":
        compare($songs, $sortBy, $sign);
        break;
    case "genre":
        compare($songs, $sortBy, $sign);
        break;
    case "downloads":
        compare($songs, $sortBy, $sign);
        break;
    case "rating":
        compare($songs, $sortBy, $sign);
        break;
}
//var_dump($songs);

echo "<table>\n";
echo "<tr><th>Name</th><th>Genre</th><th>Artists</th><th>Downloads</th><th>Rating</th></tr>\n";
foreach ($songs as $song) {
    echo "<tr><td>" . htmlspecialchars($song['name']) . "</td><td>"
        . htmlspecialchars($song['genre']) . "</td><td>"
        . htmlspecialchars(implode(", ", $song['artists'])) . "</td><td>"
        . htmlspecialchars($song['downloads']) . "</td><td>"
        . htmlspecialchars($song['rating']) . "</td>" . "</tr>\n";
}
echo "</table>\n";
?>


<p></p>

<table>
    <tr><th>Name</th><th>Genre</th><th>Artists</th><th>Downloads</th><th>Rating</th></tr>
    <tr><td>ga6ta mi</td><td>Jazz</td><td>Jorkata, Kilata maika, Nakov</td><td>1</td><td>5</td></tr>
    <tr><td>pra6ka mi</td><td>Jazz</td><td>Jorkata, Kilata maika, Nakov</td><td>1</td><td>5</td></tr>
    <tr><td>4i4ka mi</td><td>Rap</td><td>Jorkata, Kilata maika, Nakov</td><td>1</td><td>4</td></tr>
    <tr><td>bajaka mi</td><td>Jazz</td><td>Jorkata, Kilata maika, Nakov</td><td>1</td><td>4</td></tr>
    <tr><td>cigarata mi</td><td>Jazz</td><td>Jorkata, Kilata maika, Nakov</td><td>1</td><td>3</td></tr>
    <tr><td>kilata mi</td><td>Jazz</td><td>Jorkata, Kilata maika, Nakov</td><td>1</td><td>2.2</td></tr>
    <tr><td>parcala mi</td><td>Jazz</td><td>Kilata maika, Nakov, Rico</td><td>1</td><td>1</td></tr>
</table>

