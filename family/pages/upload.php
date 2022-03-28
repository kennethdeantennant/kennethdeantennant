<?php
$imageDirectory=$_POST["file"];
$imageName=$_POST["title"];
echo("$imageDirectory");
$srcImg = imagecreatefromjpeg("X:\FBMLiveWire\ken\rm\images\ken.jpg");
$origWidth = imagesx($srcImg);
$origHeight = imagesy($srcImg);
echo($origWidth);
/*
$ratio = $origWidth / $thumbWidth;
$thumbHeight = $origHeight * $ratio;

$thumbImg = imagecreate($thumbWidth, $thumbHeight);
imagecopyresized($thumbImg, $srcImg, 0, 0, 0, 0, $thumbWidth, $thumbHeight, imagesx($thumbImg), imagesy($thumbImg));

imagejpeg($thumbImg, "$thumbDirectory/$imageName");
}

createThumbnail("img", "theFileName.jpg", "img/thumbs", 100);
*/
?>