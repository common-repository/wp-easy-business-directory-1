<?php
wp_tiny_mce( true , // true makes the editor "teeny"
	array(
		"editor_selector" => "a_nice_textarea"
	)
);
global $wpdb;
$mylink = $wpdb->get_row("SELECT * FROM wp_easybdcompanies WHERE compid =" . $_GET[comp] . "", ARRAY_N);
$mylink2 = $wpdb->get_row("SELECT * FROM wp_easybdcategories WHERE catid =" . $mylink[2] . "", ARRAY_N);

if (!$_POST){ ?>
<div class="form-wrap">
<form id="addtag" method="post" class="validate" action="admin.php?page=companies&easyaction=updatecategory">
<input type="hidden" name="compid" value="<?php echo $_GET[comp];?>"/>

<table>
<tr>
<td>
<div class="form-field form-required">
<label>Company Name</label>
<input name="compname" type="text" value="<?php echo $mylink[1];?>" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>Contact Person</label>
<input name="contact" type="text" value="<?php echo $mylink[2];?>" size="40" aria-required="true" />
</div>

<div class="form-field">
<label for="tag-slug">Slug</label>
<input name="slug" id="tag-slug" type="text" value="" size="40" />
<p>The &#8220;slug&#8221; is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</p>
</div>

<div class="form-field">
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
if ($twodra->catid == $mylink2[0]) { $loutsa .="<option selected=\"selected\" class=level-2 value=" . $twodra->catid . ">---" . $twodra->catname . "</option>";
 } else { $loutsa .="<option class=level-2 value=" . $twodra->catid . ">---" . $twodra->catname . "</option>"; }
}



/*if ($fivesdraft->mother!=0) { echo "<option class=\"level-1\" value=" . $fivesdraft->catid . "> - " . $fivesdraft->catname . "</option>"; } else {

	echo "<option class=\"level-1\" value=" . $fivesdraft->catid . "><b>" . $fivesdraft->catname . "</b></option>"; }*/
}
?>
<select name='compcat' id='parent' class='postform' >
<option value='0'>None</option>
<option class="level-0" value='0'>None</option>
<?php echo $loutsa; ?>
</select>

<p>Categories, unlike tags, can have a hierarchy. You might have a Jazz category, and under that have children categories for Bebop and Big Band. Totally optional.</p>
</div>

<div class="form-field">
<label for="tag-description">Short Description</label>
<textarea name="shortdesc" id="a_nice_textarea" class="a_nice_textarea" rows="2" cols="40"><?php echo $mylink[3];?></textarea>
<p>The description is not prominent by default; however, some themes may show it.</p>
</div>

<div class="form-field">
<label for="tag-description">Full Description</label>
<textarea name="fulldesc" id="a_nice_textarea" class="a_nice_textarea" rows="12" cols="40"><?php echo $mylink[4];?></textarea>
<p>The description is not prominent by default; however, some themes may show it.</p>
</div>



</td>

<td>
<div class="form-field form-required">
<label>City</label>
<input name="city" type="text" value="<?php echo $mylink[8];?>" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>Postal Code</label>
<input name="tk" type="text" value="<?php echo $mylink[9];?>" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>Region</label>
<input name="region" type="text" value="<?php echo $mylink[6];?>" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>Address</label>
<input name="address" type="text" value="<?php echo $mylink[7];?>" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>Telephone 1</label>
<input name="phone1" type="text" value="<?php echo $mylink[10];?>" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>Telephone 2</label>
<input name="phone2" type="text" value="<?php echo $mylink[11];?>" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>Fax</label>
<input name="fax" type="text" value="<?php echo $mylink[12];?>" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>E-mail</label>
<input name="email" type="text" value="<?php echo $mylink[13];?>" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>Website</label>
<input name="website" type="text" value="<?php echo $mylink[14];?>" size="40" aria-required="true" />
</div>

</td>
</tr>
</table>

<?php 
$googlemaps = get_option('googlemaps'); 
if ($googlemaps=='enable') {
?>
<h2>Map Options</h2>
<table>
<tr>
<td>
<div class="form-field form-required">
<label>Latitude</label>
<input name="lat" type="text" value="" size="40" aria-required="true" />
</div>


</td>


<td>
<div class="form-field form-required">
<label>Lognitude</label>
<input name="logn" type="text" value="" size="40" aria-required="true" />
</div>
</td>
</tr>

</table>
<?php } ?>

<p class="submit"><input type="submit" class="button" name="submit" id="submit" value="Add New Company" /></p>
</form></div>

<?php
}
 if  (($_POST) AND ($_GET[easyaction]=='addnewcompany'))
{
if ($_POST[compcat]==0) {echo "Please select a subcategory! No a master category!!!!"; exit();}
global $wpdb;
echo $_POST[compname];
echo "<br />";
echo $_POST[compcat];
echo "<br />";
echo $_POST[shortdesc];
echo "<br />";
echo $_POST[fulldesc];
echo "<br />";
echo $_POST[contact];
echo "<br />";
echo $_POST[address];
echo "category=" . $_POST[compcat];
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
'logn' => $_POST[logn] ), 
array( '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s','%s','%s','%s','%s','%s','%s' ) );
}
?>