<h2>Add New Category</h2>
<div class="form-wrap">
<form id="addtag" method="post" class="validate" action="admin.php?page=categories&easyaction=addnewcategory">

<div class="form-field form-required">
<label for="tag-name">Name</label>
<input name="catname" id="tag-name" type="text" value="" size="40" aria-required="true" />
<p>The category name.</p>
</div>

<div class="form-field">
<label for="parent">Parent</label>
<select name='mother' id='parent' class='postform' >
<option value='0'>None</option>
<?php
global $wpdb;
$fivesdrafts = $wpdb->get_results("SELECT * FROM wp_easybdcategories WHERE mother='0'");
foreach ($fivesdrafts as $fivesdraft) {
	echo "<option class=\"level-1\" value=" . $fivesdraft->catid . ">" . $fivesdraft->catname . "</option>";
}
?>
</select>
<p>Select if is a subcategory else none</p>
</div>

<div class="form-field">
<label for="tag-description">Description</label>
<textarea name="catdesc" id="tag-description" rows="5" cols="40"></textarea>
<p>The Category description..</p>
</div>

<p class="submit"><input type="submit" class="button" name="submit" id="submit" value="Add New Category" /></p>
</form></div>



