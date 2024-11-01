<?php if (!$_POST){ ?>
<div class="form-wrap">
<form id="addtag" method="post" class="validate" action="admin.php?page=newcompany&easyaction=addnewcompany">


<table>
<tr>
<td>
<div class="form-field form-required">
<label>Company Name</label>
<input name="compname" type="text" value="" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>Contact Person</label>
<input name="contact" type="text" value="" size="40" aria-required="true" />
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
$loutsa .="<option class=level-2 value=" . $twodra->catid . ">---" . $twodra->catname . "</option>";
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
<textarea name="shortdesc" id="tag-description" rows="2" cols="40"></textarea>
<p>The description is not prominent by default; however, some themes may show it.</p>
</div>

<div class="form-field">
<label for="tag-description">Full Description</label>
<textarea name="fulldesc" id="tag-description" rows="12" cols="40"></textarea>
<p>The description is not prominent by default; however, some themes may show it.</p>
</div>



</td>

<td>
<div class="form-field form-required">
<label>City</label>
<input name="city" type="text" value="" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>Postal Code</label>
<input name="tk" type="text" value="" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>Region</label>
<input name="region" type="text" value="" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>Address</label>
<input name="address" type="text" value="" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>Telephone 1</label>
<input name="phone1" type="text" value="" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>Telephone 2</label>
<input name="phone2" type="text" value="" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>Fax</label>
<input name="fax" type="text" value="" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>E-mail</label>
<input name="email" type="text" value="" size="40" aria-required="true" />
</div>

<div class="form-field form-required">
<label>Website</label>
<input name="website" type="text" value="" size="40" aria-required="true" />
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
echo "<font color=green>The company <b>" . $_POST[compname] . "</b> ";
echo "added successfully to the database</font>";
echo "<br />";
echo "Press <a href=admin.php?page=companies>HERE</a> to return to the companies list page or  <a href=admin.php?page=newcompany>HERE</a> to add a new category!";

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
'valid' => 1  ), 
array( '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s','%s','%s','%s','%s','%s','%s','%d' ) );
}
?>
