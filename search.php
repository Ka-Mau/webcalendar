<?php
include_once 'includes/init.php';

if ( $groups_enabled == "Y" ) $INC = array('js/search.php');
print_header($INC);
?>

<h2><?php if ( empty ( $advanced ) ) { etranslate("Search"); } else { etranslate ( "Advanced Search" ); } ?></h2>

<form action="search_handler.php" method="post" name="searchformentry">

<?php if ( empty ( $advanced ) ) { ?>

<b><?php etranslate("Keywords")?>:</b>
<input name="keywords" size="30" />
<input type="submit" value="<?php etranslate("Search")?>" />

<br /><br />
<a class="navlinks" href="search.php?advanced=1"><?php etranslate("Advanced Search") ?></a>

<?php } else {
$show_participants = ( $disable_participants_field != "Y" );
if ( $is_admin )
  $show_participants = true;
if ( $login == "__public__" && $public_access_others != "Y" )
  $show_participants = false;

?>

<table border="0">

<input type="hidden" name="advanced" value="1" />

<tr><td><b><?php etranslate("Keywords")?>:</b></td>
<td><input name="keywords" size="30" /></td>
<td><input type="submit" value="<?php etranslate("Search")?>" /></td></tr>

<?php if ( $show_participants ) { ?>
<tr><td valign="top"><b><?php etranslate("Users"); ?></b></td>
<?php
  $users = get_my_users ();
  $size = 0;
  $out = "";
  for ( $i = 0; $i < count ( $users ); $i++ ) {
    $out .= "<option value=\"" . $users[$i]['cal_login'] . "\"";
    if ( $users[$i]['cal_login'] == $login )
      $out .= " selected=\"selected\"";
    $out .= ">" . $users[$i]['cal_fullname'] . "</option>\n";
  }
  if ( count ( $users ) > 50 )
    $size = 15;
  else if ( count ( $users ) > 10 )
    $size = 10;
  else
    $size = count ( $users );
?>
<td><select name="users[]" size="<?php echo $size;?>" multiple="multiple"><?php echo $out; ?></select>
<?php 
  if ( $groups_enabled == "Y" ) {
    echo "<input type=\"button\" onclick=\"selectUsers()\" value=\"" .
      translate("Select") . "...\" />";
  }
?>
</td></tr>

<?php } /* if show_participants */ ?>

</table>

<?php } ?>

</form>

<?php print_trailer(); ?>
</body>
</html>
