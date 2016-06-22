<?php session_start();

$width = 80;
$height = 40;
$font_size = 10.5;
$let_amount = 4;
$fon_let_amount = 10;
$path_fonts = '../style/fonts/';


$letters = array('1','2','3','4','5','6','7','9','0');
$colors = array('10','30','50','70','90','110','130','150','170','190','210');

$src = imagecreatetruecolor($width,$height);
$fon = imagecolorallocate($src,255,255,255);
imagefill($src,0,0,$fon);

$fonts = array();
$dir=opendir($path_fonts);
while($fontName = readdir($dir))
{
if($fontName != "." && $fontName != "..")
{
$fonts[] = $fontName;
}
}
closedir($dir);



for($i=0;$i<$let_amount;$i++)
{
$color = imagecolorallocatealpha($src,$colors[rand(0,sizeof($colors)-1)],$colors[rand(0,sizeof($colors)-1)],$colors[rand(0,sizeof($colors)-1)],rand(20,40));
$font = $path_fonts.$fonts[rand(0,sizeof($fonts)-1)];
$letter = $letters[rand(0,sizeof($letters)-1)];
$size = rand($font_size*2.1-2,$font_size*2.1+2);
$x = ($i+1)*$font_size + rand(4,7);
$y = (($height*2)/3) + rand(0,5);
$cod[] = $letter;
imagettftext($src,$size,rand(0,15),$x,$y,$color,$font,$letter);
}

$_SESSION['secpic'] = implode('',$cod);

header ("Content-type: image/gif");
imagegif($src);
?> 