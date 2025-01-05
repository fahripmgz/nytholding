<?php
// Create our image
$image = imagecreatetruecolor(100, 30);

// Assign a background colour. I have set it to white but background is going to be transparent anyway
$background = imagecolorallocate($image, 0,0,0);

// Make background transparent by setting the colour we are going to use as transparent
imagecolortransparent($image, $background);

// Fill it in with the background colour. This is required to make the background transparent
imagefilledrectangle($image, 0, 0, 199, 49, $background);

// function to generate captcha characters
function captchaChars($hash)
{
  //  Generate a 32 character string by getting the MD5 hash of the servers name with the hash added to the end.
  //  Adding the servers name means outside sources cannot just work out the characters from the hash
  $captchastr = md5($_SERVER['SERVER_NAME'] . $hash);
  return strtoupper($captchastr); // Make all our characters uppercase for clarity in the image
}

// Lets get the characters to show in the image or say 'error' if no hash submitted
$str = (!empty($_GET['hash'])) ? captchaChars($_GET['hash']) : 'ERROR';

// Assign a colour for the text and lines. I've chosen a shade of grey
$our_colour = imagecolorallocate($image, 140,140,140);

// Lets add three random background lines
for ($i = mt_rand(5, 8); $i <= 29; $i += 10)
{
  imageline($image, mt_rand(0, 100), $i + mt_rand(-5, 5), mt_rand(0, 100), $i + mt_rand(-5, 5), $our_colour);
}

// Set a random horizontal starting position
$x_pos = mt_rand(10, 20);

// Lets loop through our string adding one character at a time in a randomish position
// We start with the first character and then use every seventh character just for added randomness
for($i = 0; $i <= 28; $i += 7)
{
  imagestring($image, 5, $x_pos, mt_rand(0, 12), $str[$i], $our_colour); // add a character from our string
  $x_pos += mt_rand(10, 18);  // Move the horizontal position by a random amount
}

// Add some wavy distortion to the image
$wave = rand(3,5);
$wave_width = rand(8,15);
for ($i = 0; $i < 200; $i += 2)
{
  imagecopy($image, $image, $i - 2, sin($i / $wave_width) * $wave, $i, 0, 2, 40);
} 

// Send the gif header. We use a gif because of IE6's poor support for PNG transparency
header('Content-type: image/gif');
// Dump the image
imagegif($image);

?>