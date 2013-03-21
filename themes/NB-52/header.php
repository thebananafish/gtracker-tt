<?php
$GLOBALS['tstart'] = array_sum(explode(" ", microtime()));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?= $title; ?></title>
<!--[if lt IE 7 ]><style type="text/css">  img { behavior: url(themes/NB-52/images/iepngfix.htc) } </style><![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=<?= $site_config["CHARSET"]; ?>">
<link href="themes/NB-52/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="themes/NB-52/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="themes/NB-52/js/menu.js"></script>
<script type="text/javascript" src="themes/NB-52/js/xbreadcrumbs.js"></script>
<script src="themes/NB-52/js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="themes/NB-52/js/jquery.kwicks-1.5.1.pack.js" type="text/javascript"></script>
<script type="text/javascript">
	$().ready(function() {
		$('.kwicks').kwicks({
			max : 90,
			spacing : 0
		});
	});
</script>
<script type="text/javascript">
     $(document).ready(function(){
          $('#jCrumbs').xBreadcrumbs();
     });
</script>
<script type="text/javascript" src="<?= $site_config["SITEURL"]; ?>/backend/java_klappe.js"></script>
</head>

<BODY>
<div class='wrapperA'>
  <div class='wrapperB'>
  <table width='100%' border='0' cellspacing='0' cellpadding='0'>
    <tr>
    <td height='55'>
    <div class='navigation'>
    <ul class='jCrumbs' id='jCrumbs'>
        <li><a href='index.php'><span>Home</span></a></li>
        <li><a href='forums.php'><span>Forum</span></a></li>
        <li><a href='#'><span>Torrents</span></a>
            <ul>
                <li><a href='torrents-upload.php'>Upload A Torrent</a></li>
                <li><a href='torrents.php'>Browse Torrents</a></li>
                <li><a href='torrents-today.php'>Todays Torrents</a></li>
                <li><a href='torrents-search.php'>Search</a></li>
                <li><a href=torrents-needseed.php>Needing Seeds</a></li>
            </ul>
        </li>
        <li><a href='faq.php'><span>FAQ</span></a></li>
    </ul>
    </div>
    </td>
    </tr>
    <tr>
    <td height='13'><img src='themes/NB-52/images/head-t.png' width='1106' height='13' /></td>
    </tr>
    <tr>
    <td height='100' background='themes/NB-52/images/head-bg.png'><div class='logo'>
      <table width='100%' border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td height='39' valign='top'>
	<? if (!$CURUSER) { ?>
    <div class='myLogin'>
    <form method=post action=account-login.php>
    <fieldset>
    <input class='myLogin-n' type='text' name='username' />
    <input class='myLogin-p' type='password' name='password' />
    <input class='myLogin-b' type='submit' value=''>
    </fieldset>  
    </form>
    </div>
    <? }else{ ?>
    
    <div class='mySearch'>
    <form method="get" action="torrents-search.php">
    <fieldset>
    <?php
  
   if (!empty($searchstr)) {
        $value = stripslashes(htmlspecialchars($searchstr));
   } else {
        $value = 'Search ...';
   }
   
   ?>
   
   <input type='text'  value="<?php echo $value; ?>" onfocus="if (this.value == 'Search ...') this.value = '';" onblur="if (this.value == '') this.value = 'Search ...';" name='search' id='q' class='mySearch-t'/>
	<input name="incldead" value="1" type="hidden">
    <input type='submit' value='' class='mySearch-b' />
    </fieldset>
    </form>
    </div>
    <div class="rss"><a href='rss.php'><img src="themes/NB-52/images/blank.gif" alt="RSS" title="RSS Feed" width="32" height="29" /></a></div>
    <? } ?>
          <div class='user'>
<!-- START INFOBAR CODE -->
	<?
    if (!$CURUSER){
        echo "[<a href=\"account-login.php\">". LOGIN . "</a>]<B> or </B>[<a href=\"account-signup.php\">" . SIGNUP . "</a>]&nbsp;&nbsp;";
    }else{
        print ("".LOGGEDINAS.": <span><b>".$CURUSER["username"]."</span>"); 
        }
    ?>
<!-- END INFOBAR CODE -->
          </div>
          </td>
          <td width='100' height='100' rowspan='2' align='center' valign='middle'>
          <div class='avatar'>
          <?
            $avatar = $CURUSER["avatar"];
            if (!$avatar)
            {
                $avatar = "themes/NB-52/images/noavatar.png";
            }
            if (!$CURUSER)
            {
                $avatar = "themes/NB-52/images/loggedout.png";
                $salt = "";
            }else{
                $salt = "'s avatar";
            }
            print ('<img src="' . $avatar . '" alt="' . $CURUSER[username] . $salt . '" name="' . $CURUSER[username] . $salt . '" title="' . $CURUSER[username] . $salt . '" border="0" width="70" height="70"" />');
        ?>
          </div>
          </td>
        </tr>
        <tr>
          <td height='61'>
		<? if (!$CURUSER) { ?>
        <div id="toolbar">
        <div id="kwick">
        <ul class='kwicks'> 
        <li id='kwick8'></li>
        <li id='kwick9'></li>
        <li id='kwick1'><a href='account-signup.php'>Sign Up</a></li>
        <li id='kwick2'><a href='account-recover.php'>Recover Account</a></li>
        </ul>
        </div>
        </div>
<? } else { ?>
        <div id="toolbar">
        <div id="kwick">
        <ul class="kwicks"> 
        <? if ($CURUSER["control_panel"]=="yes") {print("<li id='kwick6'><a href='admincp.php'>Admin CP</a></li>");}?>
        <li id='kwick4'><a href='account.php'>Account Settings</a></li>
		<?
            //check for new pm's
            $res = mysql_query("SELECT COUNT(*) FROM messages WHERE receiver=" . $CURUSER["id"] . " and unread='yes' AND location IN ('in','both')") or print(mysql_error());
            $arr = mysql_fetch_row($res);
            $unreadmail = $arr[0];
            if ($unreadmail){
                print("<li id='kwick7'><a title='($unreadmail) New Messages' href='mailbox.php?inbox'>New Mail</a></li>");
            }else{
                print("<li id='kwick5'><a href='mailbox.php'>Mailbox</a></li>");
            }
        
        ?>
        <li id='kwick3'><a href='account-logout.php'>Logout</a></li>
        </ul>
        </div>
        </div>
<? } ?>
          </td>
          </tr>
      </table>
    </div></td>
    </tr>
    <tr>
    <td height='3'><img src='themes/NB-52/images/body-t.png' width='1106' height='3' /></td>
    </tr>
    <tr>
    <td valign='top' background='themes/NB-52/images/body-m.png'>
      <div class="lcol">
    <?php
    
    //CODE
    
    if (isset($_COOKIE["blockswitcher"]) && $_COOKIE["blockswitcher"] == "left") {  $blocks = leftblocks(); $block = "left"; }
    if (isset($_COOKIE["blockswitcher"]) && $_COOKIE["blockswitcher"] == "right"){ $blocks = rightblocks(); $block = "right"; }  
    if (!isset($_COOKIE["blockswitcher"])){
         leftblocks();
    }else{
        echo $blocks;
    }
        // echo $blocks;
    
    
    if ($block == "left")
        $link = "<a href='themes/NB-52/blockswitcher.php?switch=right'><img src='themes/NB-52/images/rcol.gif' border='0'></a>";
    else
        $link = "<a href='themes/NB-52/blockswitcher.php?switch=left'><img src='themes/NB-52/images/lcol.gif' border='0'></a>"; 
    ?>
	
	</div>
    <div class="col-switch">
    <?php echo $link; ?>
    </div>
    
      <div class='mcol'>
      	<?
		if ($site_config["MIDDLENAV"]){
			middleblocks();
		} //MIDDLENAV ON/OFF END
		?>
