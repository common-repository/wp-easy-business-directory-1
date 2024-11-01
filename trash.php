<?php 
/*if ($_GET[edit]=='true') 
{
include ("forms/edit-company.php");
} 
*/
if  ((!$_GET[edit]=='true') AND ($_POST) AND ($_GET[easyaction]=='updatecategory'))
{
global $wpdb;
$wpdb->update( 'wp_easybdcategories', array( 'catname' => $_POST[catname], 'mother' => $_POST[mother] , 'catdesc' => $_POST[catdesc] ), array( 'catid' => $_POST[catid] ), array( '%s', '%d','%s' ), array( '%d' ) );
}

else 
{
include ("tables/companies_list_trash.php");
include ("tables/categories_list_trash.php");
} 
?>
