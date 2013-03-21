<?php
/*
+ ----------------------------------------------------------------------------+
|     ©Nikkbu 2012
|     Site: http://nikkbu.info
|     eMail: nikkbu@nikkbu.info
|     Theme: NB-TT-2c -- 1.0.0
|     TT Version: v2 svn
|     TT Revision: 1108
|     Date: 17/05/2012
|     Author: Nikkbu
+----------------------------------------------------------------------------+
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $site_config["CHARSET"]; ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="pragma" content="no-cache">
<meta name="author" content="Nikkbu, TorrentTrader" />
<meta name="generator" content="TorrentTrader <?php echo $site_config['ttversion']; ?>" />
<meta name="description" content="TorrentTrader is a feature packed and highly customisable PHP/MySQL Based BitTorrent tracker. Featuring intergrated forums, and plenty of administration options. Please visit www.torrenttrader.org for the support forums. " />
<meta name="keywords" content="http://nikkbu.info, http://www.torrenttrader.org" />
<!-- CSS -->
<!-- Theme css -->
<link rel="shortcut icon" href="<?php echo $site_config["SITEURL"]; ?>/themes/NB-TT-2c/images/favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo $site_config["SITEURL"]; ?>/themes/NB-TT-2c/theme.css" />
<!--[if IE]>
    <link rel="stylesheet" type="text/css" href="<?php echo $site_config["SITEURL"]; ?>/themes/NB-TT-2c/css/ie.css" />
<![endif]-->
<!-- JS -->
<script type="text/javascript" src="<?php echo $site_config["SITEURL"]; ?>/backend/java_klappe.js"></script>
<!--[if lte IE 6]>
    <script type="text/javascript" src="<?php echo $site_config["SITEURL"]; ?>/themes/NB-TT-2c/js/pngfix/supersleight-min.js"></script>
<![endif]-->
</head>
<?php
	$page = $_SERVER['REQUEST_URI'];
	$page = str_replace("/","",$page);
	$page = str_replace(".php","",$page);
	$page = str_replace("svn","",$page);  //-- name if tracker installed in a sub-dir 
	$page = str_replace("?search=","",$page);
	$page = $page ? $page : 'index'
?>
<body>
<div id='wrapper'>
  <div id='header'>
    <div id='infobar'>
<!-- START INFOBAR -->
    <div class="fltLeft">
    <?php
        if ($CURUSER["control_panel"]=="yes") {
    
            print("<a class='admincp' href=admincp.php>AdminCP</a> ");
    
        }
    ?>
    </div>
    <div class="fltRight">
    <?php
    if (!$CURUSER){
        echo "[<a href=\"account-login.php\">".T_("LOGIN")."</a>]<B> ".T_("OR")." </B>[<a href=\"account-signup.php\">".T_("SIGNUP")."</a>]";
    
    }else{
    
    print (T_("LOGGED_IN_AS").": ".$CURUSER["username"]. "");
    $userdownloaded = mksize($CURUSER["downloaded"]);
    $useruploaded = mksize($CURUSER["uploaded"]);
    
    if ($CURUSER["uploaded"] > 0 && $CURUSER["downloaded"] == 0)
    $userratio = "Inf.";
    elseif ($CURUSER["downloaded"] > 0)
    $userratio = number_format($CURUSER["uploaded"] / $CURUSER["downloaded"], 2);
    else
    $userratio = "---";
	
    
    print (",  <img src='themes/NB-TT-2c/images/downloaded.png' border='none' height='20' width='20' alt='Downloaded' title='Downloaded'> <font color='#CC0000'>$userdownloaded </font> <img src='themes/NB-TT-2c/images/Uploaded.png' border='none' height='20' width='20' alt='Uploaded' title='Uploaded'> <font color='#009900'>$useruploaded</font> <img src='themes/NB-TT-2c/images/ratio.png' border='none' height='20' width='20' alt='Ratio' title='Ratio'> $userratio");
    print("  [Bonus Points: <a href='seedbonus.php'>".$CURUSER['seedbonus']." ]");
    echo " <a class='profile' href='account.php'><img src='themes/NB-TT-2c/images/account.png' border='none' height='20' width='20' alt='Your account' title='Your account'></a> <a class='account' href='account-details.php?id=$CURUSER[id]'><img src='themes/NB-TT-2c/images/profile.png' border='none' height='20' width='20' alt='Profile' title='Profile'></a> <a class='logout' href=\"account-logout.php\"><img src='themes/NB-TT-2c/images/logout.png' border='none' height='20' width='20' alt='Logout' title='Logout'></a> ";
        
	    //check for new pm's
    
    $res = mysql_query("SELECT COUNT(*) FROM messages WHERE receiver=" . $CURUSER["id"] . " and unread='yes' AND location IN ('in','both')") or print(mysql_error());
    
    $arr = mysql_fetch_row($res);
    
    $unreadmail = $arr[0];
    
    if ($unreadmail){
    
        print("<a class='mail_n' href=mailbox.php?inbox><img src='themes/NB-TT-2c/images/mail_new.png' border='none' height='20' width='20' alt='New PM' title='($unreadmail) New PM'S'><font color='red'>($unreadmail)</font></a>&nbsp;");
    
    }else{
    
        print("<a class='mail' href=mailbox.php><img src='themes/NB-TT-2c/images/mail.png' border='none' height='20' width='20' alt='My Messages' title='My Messages'></a>&nbsp;");
    
    }
    
    //end check for pm's
    
    }
    
    ?>
    
    </div>
<!-- END INFOBAR -->
    </div>
    <div class='header'>
      <div id='logo'><a href='index.php'><img src='themes/NB-TT-2c/images/blank.gif' width='360' height='64' /></a></div>
    </div>
    <div id='menu'>
      <!-- START NAVIGATION -->
      <ul class='menu' id='<?php echo $page ?>'>
        <li class='myLink1'><a href='index.php'><span>Home</span></a></li>
        <li class='myLink2'><a href='forums.php'><span>Forums</span></a></li>
        <li class='myLink3'><a href='torrents-upload.php'><span>Upload Torrent</span></a></li>
        <li class='myLink4'><a href='torrents.php'><span>Browse Torrents</span></a></li>
        <li class='myLink5'><a href='torrents-today.php'><span>Today's Torrents</span></a></li>
        <li class='myLink6'><a href='torrents-search.php'><span>Search Torrents</span></a></li>
        <li class='myLink7'><a href='faq.php'><span>FAQ</span></a></li>
      </ul>
      <!-- END NAVIGATION -->
    </div>
  </div>
  <div class='myTable'>
    <div class='myTrow'>
      <div class='shad-l'><img src='themes/NB-TT-2c/images/blank.gif' width='9px' height='9px' /></div>
      <div class='main'>
        <table width='100%' border='0' cellspacing='10' cellpadding='0'>
          <tr>
            <td valign='top'>
            <!-- START MAIN COLUM -->
