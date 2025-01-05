<?php
class cript
{
var $key;
var $td;
var $time4keyToChange;
var $iv;

function cript($aKey='time',$aTime4keyToChange=3600)
 {
 $this->time4keyToChange=$aTime4keyToChange;
 if($aKey!='time')
   {
   $this->key=$aKey."&".intval(time()/$this->time4keyToChange);
   }
   else
   {
   $this->key=intval(time()/$this->time4keyToChange);
   }
 $this->td = MCRYPT_RIJNDAEL_256;
 $this->iv = "qe3jigneqfrgnqw2egfmas4qetjkn5lg";
 }

function hexFromBin($data)
{
return bin2hex($data);
}

function binFromHex($data)
 {
 $len = strlen($data);
 return pack("H" . $len, $data);
 }

function criptData($data)
 {
 return $this->hexFromBin(mcrypt_encrypt($this->td, $this->key, $data, MCRYPT_MODE_CBC, $this->iv));
 }
function decriptData($eData)
 {
 return trim(mcrypt_decrypt($this->td, $this->key, $this->binFromHex($eData), MCRYPT_MODE_CBC, $this->iv));
 }
}
return true;
?>

<?php
function _getconfigdb($key)
{
	$q=mysql_query("Select * from options where options_name='".$key."'");
	$r=	mysql_fetch_array($q);
	return $r['value'];
}

function _load($files) {
    $files = func_get_args();
    foreach($files as $file)
        require_once _LOADER."/".$file.".php";
}

function limit_200($str){
    echo substr($str, 0, 200);
}

function limit_text($str,$limit){
	$etr=preg_replace("/<img[^>]+\>/i", "", $str);
	$etr2=strip_tags($etr);
    echo substr($etr2, 0, $limit);
}


function _encodeParam($str)
{
	$p=new cript();
	return $p->criptData($str);
}

function _decodeParam($str)
{  
	$p=new cript();
	return $p->decriptData($str);
}

function currency($from_Currency,$to_Currency,$amount) {
  $amount = urlencode($amount);
  $from_Currency = urlencode($from_Currency);
  $to_Currency = urlencode($to_Currency);
  $url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency";
  $ch = curl_init();
  $timeout = 0;
  curl_setopt ($ch, CURLOPT_URL, $url);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
  curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $rawdata = curl_exec($ch);
  curl_close($ch);
  $data = explode('"', $rawdata);
  $data = explode('.', $data['3']);
  $data[0] = str_replace(" ", "",preg_replace('/\D/', '',  $data[0]));
  if(isset($data[1])){
    $data[1] = str_replace(" ", "",preg_replace('/\D/', '', $data[1]));
    $var = $data[0].".".$data[1];        
  } else{
    $var = $data[0];
  }
  return round($var,2); }

function strip_word_html($text, $allowed_tags = '<b><i><sup><sub><em><strong><u><br>')
    {
        mb_regex_encoding('UTF-8');
        //replace MS special characters first
        $search = array('/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u');
        $replace = array('\'', '\'', '"', '"', '-');
        $text = preg_replace($search, $replace, $text);
        //make sure _all_ html entities are converted to the plain ascii equivalents - it appears
        //in some MS headers, some html entities are encoded and some aren't
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        //try to strip out any C style comments first, since these, embedded in html comments, seem to
        //prevent strip_tags from removing html comments (MS Word introduced combination)
        if(mb_stripos($text, '/*') !== FALSE){
            $text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm');
        }
        //introduce a space into any arithmetic expressions that could be caught by strip_tags so that they won't be
        //'<1' becomes '< 1'(note: somewhat application specific)
        $text = preg_replace(array('/<([0-9]+)/'), array('< $1'), $text);
        $text = strip_tags($text, $allowed_tags);
        //eliminate extraneous whitespace from start and end of line, or anywhere there are two or more spaces, convert it to one
        $text = preg_replace(array('/^\s\s+/', '/\s\s+$/', '/\s\s+/u'), array('', '', ' '), $text);
        //strip out inline css and simplify style tags
        $search = array('#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu');
        $replace = array('<b>$2</b>', '<i>$2</i>', '<u>$1</u>');
        $text = preg_replace($search, $replace, $text);
        //on some of the ?newer MS Word exports, where you get conditionals of the form 'if gte mso 9', etc., it appears
        //that whatever is in one of the html comments prevents strip_tags from eradicating the html comment that contains
        //some MS Style Definitions - this last bit gets rid of any leftover comments */
        $num_matches = preg_match_all("/\<!--/u", $text, $matches);
        if($num_matches){
              $text = preg_replace('/\<!--(.)*--\>/isu', '', $text);
        }
        return $text;
    } 
	
function _direct($to)
{
	echo "<script>window.location='".$to."'</script>";
}

function _checksession($name)
{
	if(isset($_SESSION[$name]))
	{
		return true;
	}else{
		return false;
	}
}

function _setsession($name,$value)
{
	$_SESSION[$name]=$value;
}

function _clearsession($name)
{
	unset($_SESSION[$name]);
}

function _replacenull($str,$str2)
{
	if(empty($str) || $str=="")
	{
		return $str2;
	}else{
		return $str;
	}
}

function xTimeAgo ($oldTime, $newTime, $timeType) {
        $timeCalc = strtotime($newTime) - strtotime($oldTime);        
        if ($timeType == "x") {
            if ($timeCalc = 60) {
                $timeType = "m";
            }
            if ($timeCalc = (60*60)) {
                $timeType = "h";
            }
            if ($timeCalc = (60*60*24)) {
                $timeType = "d";
            }
        }        
        if ($timeType == "s") {
            $timeCalc .= " seconds ago";
        }
        if ($timeType == "m") {
            $timeCalc = round($timeCalc/60) . " minutes ago";
        }        
        if ($timeType == "h") {
            $timeCalc = round($timeCalc/60/60) . " hours ago";
        }
        if ($timeType == "d") {
            $timeCalc = round($timeCalc/60/60/24) . " days ago";
        }        
        return $timeCalc;
    }
	
function timeAgo($timestamp){
	date_default_timezone_set('Asia/Jakarta');
	$skrg=date("Y-m-d H:i:s");
	$isi= str_replace("-","",xTimeAgo($skrg,$timestamp,"m"));
	$isi2= str_replace("-","",xTimeAgo($skrg,$timestamp,"h"));
	$isi3= str_replace("-","",xTimeAgo($skrg,$timestamp,"d"));
	$go="";
	if($isi > 60)
	{
		$go=$isi2;
	}elseif($isi2 > 24)
	{
		$go=$isi3;
	}elseif($isi < 61)
	{
		$go=$isi;
	}
	return $go;
}

?>