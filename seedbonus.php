<?php
 
  /**
  * @package Seedbonus
  * @version TorrentTrader v2.08
  * @author  mostvotedplaya
  */
  
  require_once("backend/functions.php");
  dbconn();
  loggedinonly();
  
  if ( is_valid_id($_POST['id']) )
  {
       $res = SQL_Query_exec("SELECT `type`, `value`, `cost` FROM `seedbonus` WHERE `id` = '$_POST[id]'");
       $row = mysql_fetch_object($res);
       
       if ( !$row || $CURUSER['seedbonus'] < $row->cost )
       {
            autolink("seedbonus.php", "Demande non valide.");
       }
                 
       SQL_Query_exec("UPDATE `users` SET `seedbonus` = `seedbonus` - '$row->cost' WHERE `id` = '$CURUSER[id]'");
                 
       switch ( $row->type )
       {
           case 'invite':
                 SQL_Query_exec("UPDATE `users` SET `invites` = `invites` + '$row->value' WHERE `id` = '$CURUSER[id]'");
                 break;
                                 
           case 'traffic':
                 SQL_Query_exec("UPDATE `users` SET `uploaded` = `uploaded` + '$row->value' WHERE `id` = '$CURUSER[id]'");
                 break;
                                                           
           case 'other':
                 break;
       }
                 
       autolink("seedbonus.php", "You have been credited.");
  }
           
  $res = SQL_Query_exec("SELECT * FROM `seedbonus` ORDER BY `type`");
  
  stdhead("Seedbonus");
 
  begin_frame("Bonus Exchange");
  ?>
  
  <center>
  This page displays the options that you can redeem accumulated points against by torrents share. <i>Note:</i> If you do not have enough points to make the exchange, 
  then the button will be disabled. Your current position point seedbonus amount of: <b><?php echo $CURUSER['seedbonus']; ?></b>
  </center>
  
  <br />
  <table border="0" cellpadding="3" class="table_table" width="100%">
  <tr>
      <th class="table_head">Option</th>
      <th class="table_head">What's this about?</th>
      <th class="table_head">Points</th>
      <th class="table_head">Exchange</th>
  </tr>
  <?php while ($row = mysql_fetch_object($res)): ?>
  <form method="post" action="seedbonus.php">
  <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
  <tr>
      <td class="table_col1"><?php echo htmlspecialchars($row->title); ?></td>
      <td class="table_col2"><?php echo htmlspecialchars($row->descr); ?></td>
      <td class="table_col1"><?php echo $row->cost; ?></td>
      <td class="table_col2"><input type="submit" value="Trade" <?php echo ( $CURUSER['seedbonus'] < $row->cost ? 'disabled="disabled"' : null ); ?> /></td>
  </tr>
  </form>
  <?php endwhile; ?>
  </table>
  
  <ul>
     <li>You will recieve <?php echo $site_config['bonuspertime']; ?> points per <?php echo floor($site_config['autoclean_interval'] / 60); ?> minutes the system registers you as a seeder per torrent.</li>
  </ul>
  
  <?php
  end_frame();
  stdfoot();
  
?>
