<?php

function mise_en_forme_header($ad_mail,$prenom_mail,$nom_mail,$f)
{

    //-----------------------------------------------
    //HEADERS DU MAIL
    //-----------------------------------------------

    $headers = 'From: "'.$prenom_mail.' '.$nom_mail.'" <'.$ad_mail.'>'."\n";
    $headers .= 'MIME-Version: 1.0'."\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\n";

	return $headers;
    
}

function mise_en_forme_message($message_mail,$image_mail,$f)
{
	//-----------------------------------------------
    //GENERE LA FRONTIERE DU MAIL ENTRE TEXTE ET PIECE JOINTE
    //-----------------------------------------------

    $frontiere = '-----=' . md5(uniqid(mt_rand()));
	
	//-----------------------------------------------
    //MESSAGE TEXTE
    //-----------------------------------------------
    $message = 'This is a multi-part message in MIME format.'."\n\n";

    $message .= '--'.$f."\n";
    $message .= 'Content-Type: text/plain; charset="iso-8859-1"'."\n";
    $message .= 'Content-Transfer-Encoding: 8bit'."\n\n";
    $message .= $message_mail."\n\n";
	
	$message .= '--'.$f."\n";
	$nom_fich = date('Ymd-H:i:s').".jpg";
	$res =move_uploaded_file($image_mail["tmp_name"], "../../cecilegregoire.fr/images/".$nom_fich);
	
	$message .= 'Content-Type: image/jpeg; name="'.$nom_fich.'"'."\n";
	$message .= 'Content-Transfer-Encoding: base64'."\n";
	$message .= 'Content-Disposition:attachement; filename="'.$nom_fich.'"'."\n\n";
		
	$message .= chunk_split(base64_encode(file_get_contents("../../cecilegregoire.fr/images/".$nom_fich)))."\n"; 
	
	return $message;
}

function mise_en_forme_message_sans_image($message_mail,$f)
{
	//-----------------------------------------------
    //GENERE LA FRONTIERE DU MAIL ENTRE TEXTE ET PIECE JOINTE
    //-----------------------------------------------

    $frontiere = '-----=' . md5(uniqid(mt_rand()));
	
	//-----------------------------------------------
    //MESSAGE TEXTE
    //-----------------------------------------------
    $message = 'This is a multi-part message in MIME format.'."\n\n";

    $message .= '--'.$f."\n";
    $message .= 'Content-Type: text/plain; charset="iso-8859-1"'."\n";
    $message .= 'Content-Transfer-Encoding: 8bit'."\n\n";
    $message .= $message_mail."\n\n";
	
	return $message;
}

function test_log($mdp)
{
	if($mdp == "boisdelateppe")
		return TRUE;
	else
		return FALSE;
}

function phpinfo_array($return=false){
 /* Andale!  Andale!  Yee-Hah! */
 ob_start();
 phpinfo(-1);
 
 $pi = preg_replace(
 array('#^.*<body>(.*)</body>.*$#ms', '#<h2>PHP License</h2>.*$#ms',
 '#<h1>Configuration</h1>#',  "#\r?\n#", "#</(h1|h2|h3|tr)>#", '# +<#',
 "#[ \t]+#", '#&nbsp;#', '#  +#', '# class=".*?"#', '%&#039;%',
  '#<tr>(?:.*?)" src="(?:.*?)=(.*?)" alt="PHP Logo" /></a>'
  .'<h1>PHP Version (.*?)</h1>(?:\n+?)</td></tr>#',
  '#<h1><a href="(?:.*?)\?=(.*?)">PHP Credits</a></h1>#',
  '#<tr>(?:.*?)" src="(?:.*?)=(.*?)"(?:.*?)Zend Engine (.*?),(?:.*?)</tr>#',
  "# +#", '#<tr>#', '#</tr>#'),
 array('$1', '', '', '', '</$1>' . "\n", '<', ' ', ' ', ' ', '', ' ',
  '<h2>PHP Configuration</h2>'."\n".'<tr><td>PHP Version</td><td>$2</td></tr>'.
  "\n".'<tr><td>PHP Egg</td><td>$1</td></tr>',
  '<tr><td>PHP Credits Egg</td><td>$1</td></tr>',
  '<tr><td>Zend Engine</td><td>$2</td></tr>' . "\n" .
  '<tr><td>Zend Egg</td><td>$1</td></tr>', ' ', '%S%', '%E%'),
 ob_get_clean());

 $sections = explode('<h2>', strip_tags($pi, '<h2><th><td>'));
 unset($sections[0]);

 $pi = array();
 foreach($sections as $section){
   $n = substr($section, 0, strpos($section, '</h2>'));
   preg_match_all(
   '#%S%(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?%E%#',
     $section, $askapache, PREG_SET_ORDER);
   foreach($askapache as $m)
       $pi[$n][$m[1]]=(!isset($m[3])||$m[2]==$m[3])?$m[2]:array_slice($m,2);
 }

 return ($return === false) ? print_r($pi) : $pi;
}
?>
