<?php
$hash = substr(md5(mt_rand(1, 1000)), 10, 20); // Just generate a random hash to use
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title></title>
  <script type="text/javascript">
  function reloadCaptcha(imageName)
  {
    var randomnumber=Math.floor(Math.random()*1001); // generate a random number to add to image url to prevent caching
    document.images[imageName].src = document.images[imageName].src + '&amp;rand=' + randomnumber; // change image src to the same url but with the random number on the end
  }
  </script>
  </head>
  <body>
<img src="captcha.php?hash=<?php echo $hash; ?>" alt="captcha" name="captchaImage"><br>
<a href="#" onclick="reloadCaptcha('captchaImage'); return false;">refresh image</a>
<form action="captchaform.php" method="post">
<input type="text" name="captchacode"><br>
<input type="submit" value="Submit Code" name="submit">
<input type="hidden" value="<?php echo $hash; ?>" name="hash">
</form>
<div style="height:20px;"> <?php
if(isset($_POST['submit']))
{
  $hash = (!empty($_POST['hash'])) ? preg_replace('/[\W]/i', '', trim($_POST['hash'])) : ''; // Remove any non alphanumeric characters to prevent exploit attempts
  $captchacode = (!empty($_POST['captchacode'])) ? preg_replace('/[\W]/i', '', trim($_POST['captchacode'])) : ''; // Remove any non alphanumeric characters to prevent exploit attempts
  // function to check the submitted captcha
  function captchaChars($hash)
  {
    //  Generate a 32 character string by getting the MD5 hash of the servers name with the hash added to the end.
    //  Adding the servers name means outside sources cannot just work out the characters from the hash
    $captchastr = strtolower(md5($_SERVER['SERVER_NAME'] . $hash));
    $captchastr2 = '';
    for($i = 0; $i <= 28; $i += 7)
    {
      $captchastr2 .= $captchastr[$i];
    }
    return $captchastr2;
  }
  if(!empty($captchacode))
  {
    if(strtolower($captchacode) == captchaChars($hash))  // We convert submitted characters to lower case then compare with the expected answer
    {
      echo '<h3>The submitted characters were correct</h3>';
    }
    else
    {
      echo '<h3>The submitted characters were WRONG!</h3>';
    }
  }
  else
  {
    echo '<h3>You forgot to fill in the code!</h3>';
  }
}
?></div>
  </body>
</html>