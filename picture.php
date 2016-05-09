<?php

$a = $_POST['a'];
$b = $_POST['b'];
$c = $_POST['c'];
$p = 0.5 * ($a + $b + $c);
$S = sqrt($p * ($p - $a) * ($p - $b) * ($p - $c));
$sinus = (2 * $S) / ($a * $b);
$arcsine = asin($sinus);
$degree = round(rad2deg($arcsine));

header("Content-type: image/png");

$obrazek = ImageCreate(500, 400);

$bialy = ImageColorAllocate($obrazek, 255, 255, 255);
$czerwony = ImageColorAllocate($obrazek, 255, 0, 0);
$zielony = ImageColorAllocate($obrazek, 0, 255, 0);
$czarny = ImageColorAllocate($obrazek, 0, 0, 0);

imagestring($obrazek, 5, 150, 10, "View angle = " . $degree . " degree", $czarny);
imagestring($obrazek, 5, 5, 330, "The green lines show 120 degree of view angle,", $czarny);
imagestring($obrazek, 5, 5, 350, "which one is the optimal minimum for car cameras.", $czarny);

if ($degree < 180 and $degree > 0) {
    $start = 270 - (0.5 * $degree);
    $stop = 270 + (0.5 * $degree);
} else {
    $start = 269.99;
    $stop = 270;
}
ImageRectangle($obrazek, 230, 285, 270, 305, $czarny);
ImageEllipse($obrazek, 250, 295, 10, 10, $czarny);
ImageFilledArc($obrazek, 250, 280, 500, 500, 210, 330, $zielony, IMG_ARC_EDGED | IMG_ARC_NOFILL);
ImageFilledArc($obrazek, 250, 280, 500, 500, $start, $stop, $czerwony, IMG_ARC_PIE);

ImagePng($obrazek);

ImageDestroy($obrazek);
?>
