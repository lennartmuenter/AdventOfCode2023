<?php
$file = file("Day4.txt");

$pointsCount = 0;
$cardCount = [];

foreach ($file as $key => $line) {
    $ticketPoints = 0;
    $wonCount = 0;
    $ticket = preg_split('/[:|]+/', trim($line));
    $ticket[1] = explode(' ', str_replace('  ', ' ', trim($ticket[1])));
    $ticket[2] = explode(' ', str_replace('  ', ' ', trim($ticket[2])));
    foreach ($ticket[2] as $selected) {
        foreach ($ticket[1] as $winning) {
            if ($selected === $winning) {
                $ticketPoints === 0 ? $ticketPoints = 1 : $ticketPoints += $ticketPoints;
                $wonCount++;
            }
        }
    }
    $pointsCount += $ticketPoints;
    $cardCount[$key]['val'] = 1;
    $cardCount[$key]['won'] = $wonCount;
}

for ($am = 0; $am < count($cardCount); $am++) {
    for ($i = 1; $i <= $cardCount[$am]['won']; $i++) {
        $cardCount[$am + $i]['val'] += $cardCount[$am]['val'];
    }
    $cardCount[$am] = $cardCount[$am]['val'];
}

var_dump($pointsCount);
var_dump(array_sum($cardCount));
