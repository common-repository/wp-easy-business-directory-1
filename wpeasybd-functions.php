<?php
function wpeasybd_css_register_head() {
	$siteurl = get_option('siteurl');
	$url = $siteurl . '/wp-content/plugins/wp-easy-business-directory/css/wpeasybd.css';
	echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
}

function buscat() {
global $wpdb;
global $easycump;
$buspage = get_option('buspage'); 
$blogurl= $wpdb->get_var($wpdb->prepare("SELECT option_value FROM wp_options WHERE option_name='siteurl'"));
$dirblogurl=$blogurl . "/" . $buspage;

if ((!$_GET[buscatid]) AND (!$_GET[company])){
$loutsa="";
$easycump="You are here : <a href=". $dirblogurl . "/>Directory Home </a> &raquo;";

if (!$_GET[catcatid]) 
	{ $catcatid='0'; } 
	else 
	{
	$catcatid = $_GET[catcatid];
	$easycump_cat = $wpdb->get_var($wpdb->prepare("SELECT catname FROM wp_easybdcategories WHERE catid=" . $catcatid . " AND trash!='1'"));
	$easycump .=$easycump_cat;
	}
$categories = $wpdb->get_results("SELECT * FROM wp_easybdcategories WHERE mother=" . $catcatid . " AND trash!='1'");
$catcount = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM wp_easybdcategories WHERE mother=0 AND trash!='1'"));

if (!$_GET[catcatid]) {
foreach ($categories as $category) 
	{
$total_companies_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM wp_easybdcompanies WHERE compcat=" . $category->catid . " AND trash!='1'")); // afto einai lathos
		//Ελεγχος για το αν υπάρχουν υποκατηγορίες ώστε να εμφανίσει τον πίνακα των υποκατηγοριών
		$subcatcount = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM wp_easybdcategories WHERE mother=" . $category->catid . " AND trash!='1'"));
		if ($subcatcount!=0) 
		{
		$loutsa .="<a href=?catcatid=" . $category->catid . ">" . $category->catname . "</a><br />";
		}
		if ($subcatcount==0) {
		$loutsa .="<a href=?buscatid=" . $category->catid . ">" . $category->catname . "</a><br />";
		}
	}
} else 
//Αν δεν είσαι στην αρχική του Directory
{
foreach ($categories as $category) 
	{
$total_companies_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM wp_easybdcompanies WHERE compcat=" . $category->catid . " AND trash!='1'")); // afto einai lathos
		
		//Ελεγχος για το αν υπάρχουν υποκατηγορίες ώστε να εμφανίσει τον πίνακα των υποκατηγοριών
		$subcatcount = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM wp_easybdcategories WHERE mother=" . $category->catid . " AND trash!='1'"));
		if ($subcatcount!=0) 
		{
		$loutsa .="<a href=?catcatid=" . $category->catid . ">" . $category->catname . "(" . $total_companies_count . ")</a><br />";
		}
		if ($subcatcount==0) {
		$loutsa .="<a href=?buscatid=" . $category->catid . ">" . $category->catname . "(" . $total_companies_count . ")</a><br />";
		}
	}
}	
		
$cats = explode("<br />",$loutsa);
$cat_n = count($cats) - 1;
for ($i=0;$i<$cat_n;$i++):
if ($i<$cat_n/2):
$cat_left = $cat_left.'<li>'.$cats[$i].'</li>';
elseif ($i>=$cat_n/2):
$cat_right = $cat_right.'<li>'.$cats[$i].'</li>';
endif;
endfor;
?>
<? // Emfanisi tou pinaka me tis katogories ?>

<div id="easycump"><?php echo $easycump; ?></div>
<br />
<ul id="easybd-left-ul">
<?php echo $cat_left;?>
</ul>
<ul id="easybd-right-ul">
<?php echo $cat_right;?>
</ul>

<?
}

elseif (($_GET[buscatid]) AND (!$_GET[catcatid]) AND (!$_GET[company])) {
$companies = $wpdb->get_results("SELECT * FROM wp_easybdcompanies WHERE compcat=$_GET[buscatid] AND trash='0' AND valid!=0");
$easycump_cat = $wpdb->get_var($wpdb->prepare("SELECT mother FROM wp_easybdcategories WHERE catid=" . $_GET[buscatid] . ""));
$easycump_cat_name = $wpdb->get_var($wpdb->prepare("SELECT catname FROM wp_easybdcategories WHERE catid=" . $easycump_cat . ""));
$easycump_subcat_name = $wpdb->get_var($wpdb->prepare("SELECT catname FROM wp_easybdcategories WHERE catid=" . $_GET[buscatid] . ""));
$easycump="You are here : <a href=" . $dirblogurl . ">Directory Home </a> &raquo; <a href=" . $dirblogurl . "?catcatid=" . $easycump_cat . ">" . $easycump_cat_name . "</a>  &raquo;  <a href=>" . $easycump_subcat_name . "</a>";
echo $easycump;
foreach ($companies as $company) {?>
<div id="easybd-div">
<span class = "easybd-span1"><?php echo $company->compname; ?></span>
<span class = "easybd-span2"><?php echo $company->shortdesc;?></span>
<span class = "easybd-span3"><b><a style="text-decoration:none;" href="http://<?php echo $company->website;?>">Website</a></b>  | <b>Phone: </b><?php echo $company->phone1;?> | <?php echo $company->city;?> , <?php echo $company->address;?>
 | <?php echo "<a href=". $dirblogurl . "/?company=" . $company->compid . ">ΔΙΑΒΑΣΤΕ ΠΕΡΙΣΣΟΤΕΡΑ</a>"; ?></span>
</div>
<? }

}



elseif ($_GET[company]) {
$mylink = $wpdb->get_row("SELECT * FROM wp_easybdcompanies WHERE compid =" . $_GET[company] . "", ARRAY_N);
$easycump_cat = $wpdb->get_var($wpdb->prepare("SELECT mother FROM wp_easybdcategories WHERE catid=" . $mylink[2] . ""));
$easycump_cat_name = $wpdb->get_var($wpdb->prepare("SELECT catname FROM wp_easybdcategories WHERE catid=" . $easycump_cat . ""));
$easycump_subcat_name = $wpdb->get_var($wpdb->prepare("SELECT catname FROM wp_easybdcategories WHERE catid=" . $mylink[2] . ""));
$easycump="You are here : <a href=" . $dirblogurl . ">Directory Home </a> &raquo; <a href=" . $dirblogurl . "?catcatid=" . $easycump_cat . ">" . $easycump_cat_name . "</a>  &raquo;  <a href=?buscatid=" . $mylink[2] . ">" . $easycump_subcat_name . "</a>";
echo $easycump;
?>
<div id="easybd-div">
<span class = "easybd-span1"><?php echo $mylink[1];?></span>
<span class = "easybd-span10"><?php echo $mylink[4];?></span>
<span class = "easybd-span2"><b>Address : </b><?php echo $mylink[6];?> , <?php echo $mylink[8];?> , <?php echo $mylink[7];?> ,  <?php echo $mylink[9];?></span>
<?php  if ($mylink[5]) { ?>
<span class = "easybd-span2"><b>Contact Person : </b><?php echo $mylink[5];?></span>
<?php } ?>
<span class = "easybd-span2"><b>Phones : </b><?php echo $mylink[10];?> , <?php echo $mylink[11];?> | FAX:  <?php echo $mylink[12];?></span>
<span class = "easybd-span2"><b>Email :</b> <?php echo $mylink[13];?> | <b>Website : </b><?php echo $mylink[14];?></span>

</div>
<?php

}





 }
 add_shortcode("liste", "buscat");
 


function addbus() {
echo "<div style=\"clear:both;\"><a href=\"add-company\">Add your own business</a></div>";


 }
 add_shortcode("addnewcomp", "addbus");
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
function addbusform() {?>
<?php if (is_user_logged_in()) { 
global $current_user;
$current_user = wp_get_current_user();
$current_wp_user_id =$current_user->ID;
?>

<?php if (!$_POST) { ?>
<form id="wpeasybdform" method="post">
<label>Company Name</label><input name="compname" type="text" value="" size="40" aria-required="true" /><br />
<label>Contact Person</label><input name="contact" type="text" value="" size="40" aria-required="true" /><br />
<label for="tag-slug">Slug</label><input name="slug" id="tag-slug" type="text" value="" size="40" /><br />
<label for="compcat">Category</label>
<?php
global $wpdb;
$loutsa="";
$loutsa1="";
$fivesdrafts = $wpdb->get_results("SELECT * FROM wp_easybdcategories WHERE mother='0'");
foreach ($fivesdrafts as $fivesdraft) {
$loutsa .="<option disabled=disabled class=level-0 value=" . $fivesdraft->catid . ">" . $fivesdraft->catname . "</option>";

$twodras = $wpdb->get_results("SELECT * FROM wp_easybdcategories WHERE mother=" . $fivesdraft->catid . "");
foreach ($twodras as $twodra) {
$loutsa .="<option class=level-2 value=" . $twodra->catid . ">---" . $twodra->catname . "</option>";
}
}
?>
<select name='compcat' id='parent' class='postform' >
<option value='0'>None</option>
<option class="level-0" value='0'>None</option>
<?php echo $loutsa; ?>
</select>
<br />

<label for="tag-description">Short Description</label><textarea name="shortdesc" id="tag-description" rows="2" cols="40"></textarea><br />
<label for="tag-description">Full Description</label><textarea name="fulldesc" id="tag-description" rows="12" cols="40"></textarea><br />
<label>City</label><input name="city" type="text" value="" size="40" aria-required="true" /><br />
<label>Postal Code</label><input name="tk" type="text" value="" size="40" aria-required="true" /><br />
<label>Region</label><input name="region" type="text" value="" size="40" aria-required="true" /><br />
<label>Address</label><input name="address" type="text" value="" size="40" aria-required="true" /><br />
<label>Telephone 1</label><input name="phone1" type="text" value="" size="40" aria-required="true" /><br />
<label>Telephone 2</label><input name="phone2" type="text" value="" size="40" aria-required="true" /><br />
<label>Fax</label><input name="fax" type="text" value="" size="40" aria-required="true" /><br />
<label>E-mail</label><input name="email" type="text" value="" size="40" aria-required="true" /><br />
<label>Website</label><input name="website" type="text" value="" size="40" aria-required="true" /><br />


<?php 
$googlemaps = get_option('googlemaps'); 
if ($googlemaps=='enable') {
?>
<label>Lognitude</label><input name="logn" type="text" value="" size="40" aria-required="true" /><br />
<?php } ?>

<p class="submit"><input type="submit" class="button" name="submit" id="submit" value="Add New Company" /></p>
</form>
<?php } else if ($_POST) { 
if ($_POST[compcat]==0) {echo "Please select a subcategory! No a master category!!!!"; exit();}
global $wpdb;

$wpdb->insert( 'wp_easybdcompanies', array( 
'compname' => $_POST[compname], 
'compcat' => $_POST[compcat], 
'shortdesc' => $_POST[shortdesc], 
'fulldesc' => $_POST[fulldesc], 
'contact' => $_POST[contact], 
'region' => $_POST[region],
'address' => $_POST[address],
'city' => $_POST[city],
'tk' => $_POST[tk],
'phone1' => $_POST[phone1],
'phone1' => $_POST[phone1],
'fax' => $_POST[fax],
'email' => $_POST[email],
'website' => $_POST[website],
'lat' => $_POST[lat],
'logn' => $_POST[logn],
'valid' => 0,
'userid' => $current_wp_user_id ), 
array( '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s','%s','%s','%s','%s','%s','%s' ,'%d' ,'%d' ) );

echo "<font color=green>The company <b>" . $_POST[compname] . "</b> ";
echo "added successfully to the database</font>";
echo "<br />";
echo "STATUS : PENDING ADMIN VALIDATION";


}?>
<?php }  else { ?>

Πρέπει να είστε συνδεδεμένοι για να καταχωρήσετε την επιχείριση σας!. Πατήστε <a href="<?php bloginfo("url"); ?>/wp-login.php?action=logout/">ΕΔΩ</a> για να συνδεθείτε. <br />
Αν δεν έχετε εγγραφεί στην ιστοσελίδα μας, πατήστε <a href="<?php bloginfo("url"); ?>/wp-login.php?action=register/"> ΕΔΩ</a> για να εγγραφείτε

<?php }?>



<?php }
 add_shortcode("addnewcompform", "addbusform");
 
 

?>