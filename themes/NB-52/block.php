
<?
//BEGIN FRAME
function begin_frame($caption = "-", $align = "justify"){
    global $THEME;
    global $site_config;
    print("<div class='myFrame'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='100%' height='29'><div class='f-cap'>$caption</div></td>
  </tr>
  <tr>
    <td width='100%'><div class='f-con'>");
}


//END FRAME
function end_frame() {
    global $THEME;
    global $site_config;
    print("</div></td>
  </tr>
</table></div>");
}

//BEGIN BLOCK
function begin_block($caption = "-", $align = "justify"){
    global $THEME;
    global $site_config;
    print("<div class='myBlock'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='100%' height='29'><div class='b-cap'>$caption</div></td>
  </tr>
  <tr>
    <td width='100%'><div class='b-con'>");
}

//END BLOCK
function end_block(){
    global $THEME;
    global $site_config;
    print("</div></td>
  </tr>
</table></div>");
}

function begin_table(){
    print("<table align=center cellpadding=\"0\" cellspacing=\"0\" class=\"ttable_headouter\" width=100%><tr><td><table align=center cellpadding=\"0\" cellspacing=\"0\" class=\"ttable_headinner\" width=100%>\n");
}

function end_table()  {
    print("</table></td></tr></table>\n");
}

function tr($x,$y,$noesc=0) {
    if ($noesc)
        $a = $y;
    else {
        $a = htmlspecialchars($y);
        $a = str_replace("\n", "<br />\n", $a);
    }
    print("<tr><td class=\"heading\" valign=\"top\" align=\"right\">$x</td><td valign=\"top\" align=left>$a</td></tr>\n");
}
?>