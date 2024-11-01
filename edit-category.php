<?php 
wp_tiny_mce( true , // true makes the editor "teeny"
	array(
		"editor_selector" => "a_nice_textarea"
	)
);
global $wpdb;
$mylink = $wpdb->get_row("SELECT * FROM wp_easybdcategories WHERE catid =" . $_GET[cat] . "", ARRAY_N);
?>
<h2>Edit Category</h2>
<div class="form-wrap">
<form id="addtag" method="post" class="validate" action="admin.php?page=categories&easyaction=updatecategory">
<input type="hidden" name="catid" value="<?=$_GET[cat];?>"/>
<div class="form-field form-required">
<label for="tag-name">Name</label>
<input name="catname" id="tag-name" type="text" value="<?=$mylink[2];?>" size="40" aria-required="true" />
<p>The name is how it appears on your site.</p>
</div>

<div class="form-field">
<label for="tag-slug">Slug</label>
<input name="slug" id="tag-slug" type="text" value="" size="40" />
<p>The &#8220;slug&#8221; is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</p>
</div>

<div class="form-field">
<label for="parent">Parent</label>
<select name='mother' id='parent' class='postform' >
<option value='0'>None</option>
<?php
global $wpdb;
$fivesdrafts = $wpdb->get_results("SELECT * FROM wp_easybdcategories WHERE mother='0'");
foreach ($fivesdrafts as $fivesdraft) {
if ($fivesdraft->catid == $mylink[1]) { echo "<option selected=\"selected\" class=\"level-1\" value=" . $fivesdraft->catid . ">" . $fivesdraft->catname . "</option>"; } else {echo "<option class=\"level-1\" value=" . $fivesdraft->catid . ">" . $fivesdraft->catname . "</option>";}
}
?>
</select>
<p>Categories, unlike tags, can have a hierarchy. You might have a Jazz category, and under that have children categories for Bebop and Big Band. Totally optional.</p>
</div>

<div class="form-field">
<label for="tag-description">Description</label>
<textarea name="catdesc" id="a_nice_textarea" class="a_nice_textarea" rows="5" cols="40"><?=$mylink[3];?></textarea>
<p>The description is not prominent by default; however, some themes may show it.</p>
</div>

<p class="submit"><input type="submit" class="button" name="submit" id="submit" value="Update Category" /></p>
</form></div>



