<?php 
if ($_GET[edit]=='true') 
{
include ("forms/edit-category.php");
} 


else if ((!$_GET[edit]=='true') AND (!$_POST) AND (!$_GET[easyaction]=='deletecategory'))
{

include ("forms/new-category.php");
include ("tables/categories_list.php");

} 

else if  ((!$_GET[edit]=='true') AND ($_POST) AND ($_GET[easyaction]=='addnewcategory'))
{
global $wpdb;
$wpdb->insert( 'wp_easybdcategories', array( 'catname' => $_POST[catname], 'mother' => $_POST[mother], 'catdesc' => $_POST[catdesc] ), array( '%s', '%d', '%s' ) );
print <<<EOF
<meta http-equiv="REFRESH" content="0;url=admin.php?page=categories"></HEAD>
EOF;
}

else if  ((!$_GET[edit]=='true') AND ($_POST) AND ($_GET[easyaction]=='updatecategory'))
{
global $wpdb;
$wpdb->update( 'wp_easybdcategories', array( 'catname' => $_POST[catname], 'mother' => $_POST[mother] , 'catdesc' => $_POST[catdesc] ), array( 'catid' => $_POST[catid] ), array( '%s', '%d','%s' ), array( '%d' ) );
print <<<EOF
<meta http-equiv="REFRESH" content="0;url=admin.php?page=categories"></HEAD>
EOF;
}

else if  ((!$_GET[edit]=='true') AND (!$_POST) AND ($_GET[easyaction]=='deletecategory'))
{
global $wpdb;

//Check if is mother category
$deletecat=$_GET[cat];
$check_cat = $wpdb->get_var($wpdb->prepare("SELECT mother FROM wp_easybdcategories WHERE catid=" . $deletecat . ""));
if ($check_cat=='0') 
	{
		//Check if has sub categories before delete
		$has_sub_categories = $wpdb->get_results("SELECT * FROM wp_easybdcategories WHERE mother=$deletecat");
			if ($has_sub_categories) 
				{
					echo "You must delete the subcateries before you delete the master category!!!"; 
					exit();
				} 
			else 
				{
					$wpdb->update( 'wp_easybdcategories', array( 'trash' => 1), array( 'catid' => $_GET[cat] ), array( '%d' ), array( '%d' ) );
print <<<EOF
				<meta http-equiv="REFRESH" content="0;url=admin.php?page=categories"></HEAD>
EOF;
				}
	}
else 
	{
		//Check if has companies before delete
		$has_companies = $wpdb->get_results("SELECT * FROM wp_easybdcompanies WHERE compcat='$deletecat'");
			if ($has_companies) 
				{
					echo "You must delete the companies before you delete the category!!!"; 
					exit();				
				}
			else
				{
					$wpdb->update( 'wp_easybdcategories', array( 'trash' => 1), array( 'catid' => $_GET[cat] ), array( '%d' ), array( '%d' ) );
print <<<EOF
				<meta http-equiv="REFRESH" content="0;url=admin.php?page=categories"></HEAD>
EOF;

				}
	}


//$wpdb->query("DELETE FROM wp_easybdcategories WHERE catid = '26'");
}





else 
{
include ("forms/new-category.php");
include ("tables/categories_list.php");
} 
?>
