     </div>
      <br class='clearfloat' />
    </td>
    </tr>
    <tr>
    <td height='111' align="center" valign="top" background='themes/NB-52/images/body-b.png'>
    <div class='credits'>
<!-- START FOOTER CODE -->
<?
//
// *************************************************************************************************************************************
//			PLEASE DO NOT REMOVE THE POWERED BY LINE, SHOW SOME SUPPORT! WE WILL NOT SUPPORT ANYONE WHO HAS THIS LINE EDITED OR REMOVED!
// *************************************************************************************************************************************
print ("<CENTER>Powered by <a href=\"http://www.torrenttrader.org\" target=\"_blank\">TorrentTrader v".$site_config["ttversion"]."</a> - ");
$totaltime = array_sum(explode(" ", microtime())) - $GLOBALS['tstart'];
printf("Page generated in %f", $totaltime);
print ("<BR><a href=rss.php?custom=1>Feed Info</a> - Theme By: <a href=\"http://nikkbu.info\" target=\"_blank\">Nikkbu</a></CENTER>");
//
// *************************************************************************************************************************************
//			PLEASE DO NOT REMOVE THE POWERED BY LINE, SHOW SOME SUPPORT! WE WILL NOT SUPPORT ANYONE WHO HAS THIS LINE EDITED OR REMOVED!
// *************************************************************************************************************************************

?> 
<!-- END FOOTER CODE -->
      </div>
    </td>
    </tr>
  </table>
  <br /><br />
  </div>
</div>
</BODY>
</HTML>
<?
ob_end_flush();
?>