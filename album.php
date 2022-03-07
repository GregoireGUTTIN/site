<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<link type="text/css" href="style.css" rel="stylesheet" media="screen" />
<title>Photos</title> 
</head>
<body>

<table>
	<tr>
		<!-- <td>
			<img src="images/orchidees.png">
 		</td> -->
  		<td>
		<?php
		include("../../cecilegregoire.fr/fonctions/fonctions.php");
		?>
		<DIV ID=ejs_photo_box></div>
		<script type="text/javascript">
		ejs_photo = new Array;
		<?
		$a = 0;
		$handle = opendir("photos/petit/" . $_GET["p"] . "/"); 
		while (($file = readdir())!=false) { 
			// clearstatcache(); 
			if($file!=".." && $file!=".") 
				{
				echo "ejs_photo[$a] = '$file';
		";
				$a++;
				}
			}
		closedir($handle); 
		?>	
		function ejs_aff_photos(num)
			{
			if(document.getElementById)
				{
				ejs_fin = "";
				if(num!=0)
					ejs_fin += "<div style='position:absolute;top:410px;left:0px'><A HREF=# onClick='ejs_aff_photos("+(num-1)+");return(false)'><img src='photos/petit/" + <? echo $_GET["p"] ?> + "/" +ejs_photo[num-1]+"' width='100'/></A></div>";
				if(num!=(ejs_photo.length-1))
					ejs_fin += "<div style='position:absolute;top:410px;left:400px'><A HREF=# onClick='ejs_aff_photos("+(num+1)+");return(false)'><img src='photos/petit/" + <? echo $_GET["p"] ?> + "/" +ejs_photo[num+1]+"' width='100'/></A></div>";
				document.getElementById("ejs_photo_box").innerHTML = "<div style='position:absolute;top:100px;left:50px'><a href='photos/grand/" + <? echo $_GET["p"] ?> + "/" +ejs_photo[num]+"'><IMG SRC='photos/petit/" + <? echo $_GET["p"] ?> + "/" +ejs_photo[num]+"' BORDER=0 height='400px' margin='5'> </a><BR>"+ejs_fin+"</div>";
				}
			}
		window.onload = new Function("ejs_aff_photos(0)")
		</script>
		</td>
	</tr>
</table>

<!-- Bouton retour -->
<style>#web-buttons-idpxxip a{display:block;color:transparent;} #web-buttons-idpxxip a:hover{background-position:left bottom;}a#web-buttons-idpxxipa {display:none}</style>
<table id="web-buttons-idpxxip" width=0 cellpadding=0 cellspacing=0 border=0><tr>
<td style="padding-right:32px" title ="Retour">
<a href="#" title="Retour" style="background-image:url(retour-files/btpxxip.png);width:100px;height:34px;display:block;"><br/></a></td>
</tr></table><a id="web-buttons-idpxxipa" href="http://free-buttons.org">Using Image As Button by Free-Buttons.org v2.0</a>
<!-- End Bouton retour -->


</body>
</html>
