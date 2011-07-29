<?php
# ilchClan Script (c) by Manuel Staechele
# Installation file (c) by Ithron
# Support: http://www.ilch.de

defined ('main') or die ( 'no direct access' );
if(user_has_admin_right($menu,false) == false)
	die ( 'F&uuml;r diese Installation ben&ouml;tigt man Administratorenrechte !<br /><a href="index.php">Zur Startseite</a>' );


// Script Konfiguration
$scripter		= 'finke';								// Name des Autors des Moduls
$script_name	= 'Ilch WOW Mod';				// Name des Moduls
$script_vers	= '1.0';								// Version des Moduls
$ilch_vers		= '1.1';								// Version des ilchClan Scripts
$ilch_update	= 'I';									// Update des ilchClan Scripts
$erfolg			= '';									// Benutzerdefinierte Erfolgsnachricht
$fehler			= '';									// Benutzerdefinierte Fehlermeldung
// Ende der Konfiguration

$title = $allgAr['title'].' => I&nbsp;N&nbsp;S&nbsp;T&nbsp;A&nbsp;L&nbsp;L&nbsp;A&nbsp;T&nbsp;I&nbsp;O&nbsp;N:&nbsp;&nbsp;'.$script_name;
$hmenu  = $script_name.' Vers.: '.$script_vers.' f&uuml;r ilchClan '.$ilch_vers.' Vers.: '.$ilch_update;
$design = new design ( $title , $hmenu, 1);
$design->header();


if(!isset($_POST['do']))
{
?>
		<form action="index.php?installation" method="POST">
		<input type="hidden" name="do" value="1">
		<table width="97%" class="border" border="0" cellspacing="1" cellpadding="3" align="center">
		<tr class="Chead">
		 <td align="center">
			<h2><strong>I&nbsp;n&nbsp;s&nbsp;t&nbsp;a&nbsp;l&nbsp;l&nbsp;a&nbsp;t&nbsp;i&nbsp;o&nbsp;n</strong></h2>
		 </td>
		</tr>
		<tr class="Cmite">
		 <td align="center">
		 	<br />
			<div style="margin-left:60px; text-align:left;">
			<strong><u>Informationen:</u></strong><br /><br />
			<strong>Modulname:</strong> <?php echo $script_name; ?><br />
			<strong>Version:</strong> <?php echo $script_vers; ?><br />
			<strong>Entwickler:</strong> <?php echo $scripter; ?><br />
			<br />
			<br />
			Entwickelt f&uuml;r ilchClan Version <strong><?php echo $ilch_vers; ?> <?php echo $ilch_update; ?></strong> .<br />
			<br />
			<i>Andere Versionen k&ouml;nnen eventuell Fehler verursachen!</i>
			</div>
			<br />
			<hr />
			<br />
			<div style="margin-left:60px; text-align:left;">
			<strong><u>Wichtig:</u></strong><br /><br />
			Machen Sie zuerst ein <a href="admin.php?backup" target="_blank" style="font-style:italic; font-weight:bold;">Backup</a> Ihrer Datenbank!<br />
			<br />
			</div>
		 </td>
		</tr>
		<tr class="Cdark">
		 <td align="center">
			<input type="submit" value="Installieren" />
		 </td>
		</tr>
		</table>
		</form>
<?php
}
elseif ($_POST['do'] == '1')
{
	$error = '';
	$sql_file = implode('',file('include/contents/installation.sql'));
	$sql_file = preg_replace ("/(\015\012|\015|\012)/", "\n", $sql_file);
	$sql_statements = explode(";\n",$sql_file);
	foreach ( $sql_statements as $sql_statement )
	{
	  if ( trim($sql_statement) != '' )
	  {
		#echo '<pre>'.$sql_statement.'</pre><hr>';
		db_query($sql_statement) OR $error .= mysql_errno().': '.mysql_error().'<br />';
	  }
	}
	
	
	// Ausgabe
?>
		<table width="97%" class="border" border="0" cellspacing="1" cellpadding="3" align="center">
		<tr class="Chead">
		 <td colspan="3">
			<h2><strong>Installation abgeschlossen</strong></h2>
		 </td>
		</tr>
		<tr class="Cmite">
		 <td colspan="3" align="center">
			<br />
<?php
	
	if(!empty($error))
	{
		if(empty($fehler))
		{
			$fehler = 'Es sind Fehler bei der Installation aufgetreten!<br />Bitte benachrichtigen Sie den Entwickler.';
		}
		$fehler .= '<br /><br />Oben sollten Sie eine ausf&uuml;hrlichere Fehlermeldung sehen<br />(ab ilchClan Version 1.1 I).';
		
		echo $fehler.'<br /><br /><hr /><br /><strong style="text-decoration:underline;">Fehlermeldungen:</strong><br /><br /><span style="color:#FF0000;font-size:bold;">'.$error.'</span>';
	}
	else
	{
		if(empty($erfolg))
		{
			$erfolg = 'Die Installation wurde erfolgreich abgeschlossen!';
		}
		if(@unlink('include/contents/installation.php') && @unlink('include/contents/installation.sql'))
		{
			$erfolg .= '<br /><br />Diese Installationsdateien wurden erfolgreich gel&ouml;scht. Es muss nichts mehr getan werden.';
		}
		else
		{
			$erfolg .= '<br /><br /><strong>Die Installationsdateien konnten nicht automatisch gel&ouml;scht werden. L&ouml;schen Sie folgende Dateien:</strong><br /><br /><i>include/contents/installation.php</i><br /><i>include/contents/installation.sql</i>';
		}
		
		echo $erfolg;
	}

?>
			<br />
			<br />
		 </td>
		</tr>
		<tr class="Chead">
		 <td colspan="3" align="center">
			<button onclick="javascript:window.location.href = 'index.php';">Auf die Startseite</button>
		 </td>
		</tr>
		</table>
	  </td>
	 </tr>
     </table>
<?php
}
$design->footer();
?>