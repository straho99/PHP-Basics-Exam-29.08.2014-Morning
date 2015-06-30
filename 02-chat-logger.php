<?php
date_default_timezone_set('Europe/Sofia');
$currentDate = new DateTime(($_GET['currentDate']));
//var_dump($currentDate);
$input = ($_GET['messages']);
$lines = preg_split("/\r?\n/", $input);

$messages = [];
foreach ($lines as $line) {
    $tokens = preg_split("/\s+\/\s+/", $line, -1, PREG_SPLIT_NO_EMPTY);
    $messages[trim($tokens[0])] = new DateTime($tokens[1]);
}

uasort($messages, function ($a, $b) {
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
});

//var_dump($messages);

foreach ($messages as $key => $value) {
    echo "<div>" . htmlspecialchars($key) . "</div>\n";
}

$maxTime = max($messages);
$yesterday = new DateTime(($_GET['currentDate']));
$yesterday->sub(new DateInterval('P1D'));

$interval = date_diff($currentDate, $maxTime);
$minutes = $interval->days * 24 * 60 + $interval->h * 60 + $interval->i;

if (date('d', $yesterday->getTimestamp()) == date('d', $maxTime->getTimestamp())
    && date('m', $yesterday->getTimestamp()) == date('m', $maxTime->getTimestamp())
    && date('Y', $yesterday->getTimestamp()) == date('Y', $maxTime->getTimestamp())) {
    echo "<p>Last active: <time>" . "yesterday" . "</time></p>";
} else if ($minutes < 60) {
    echo "<p>Last active: <time>" . htmlspecialchars($minutes) . " minute(s) ago" . "</time></p>";
} else if ($minutes < (24 * 60) && date('d', $currentDate->getTimestamp()) == date('d', $maxTime->getTimestamp())) {
    echo "<p>Last active: <time>" . htmlspecialchars($interval->h) . " hour(s) ago" . "</time></p>";
} else if ($minutes < 1) {
    echo "<p>Last active: <time>" . "a few moments ago" . "</time></p>";
} else if ($interval->days > 1) {
    echo "<p>Last active: <time>" . htmlspecialchars(date('d-m-Y', $maxTime->getTimeStamp())). "</time></p>";
}
?>