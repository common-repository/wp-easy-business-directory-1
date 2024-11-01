<h3><font color="red">Companies waiting Admin VALIDATION</font></h3>
<table class="widefat tag fixed" cellspacing="0">
	<thead>
	<tr>
	<th><font color="red">Company Name</font></th>
	<th><font color="red">Category</font></th>
	<th><font color="red">Website</font></th>
	<th><font color="red">e-mail</font></th>
	<th><font color="red">Admin Actions</font></th>
	</tr>
	</thead>

	<tfoot>
	<tr>
	<th><font color="red">Company Name</font></th>
	<th><font color="red">Category</font></th>
	<th><font color="red">Website</font></th>
	<th><font color="red">e-mail</font></th>
	<th><font color="red">Admin Actions</font></th>
	</tr>
	</tfoot>

<tbody id="the-list" class="list:tag">
<?php
global $wpdb;

//Chech if is category or subcategory
$companies = $wpdb->get_results("SELECT * FROM `wp_easybdcompanies` WHERE trash!='1' AND valid!='1'"); 

foreach ($companies as $company) {
$realcat = $wpdb->get_var($wpdb->prepare("SELECT catname FROM wp_easybdcategories WHERE catid=" . $company->compcat . ";"));
echo "<tr>
<td>" . $company->compname . "</td>
<td>" . $realcat . "</td>
<td>" . $company->website . "</td>
<td>" . $company->email . "</td>
<td>
<a href=admin.php?page=companies&comp=" . $company->compid . "&edit=true>Edit</a> | 
<a href=admin.php?page=companies&comp=" . $company->compid . "&delete=true>Delete</a> | 
<a href=admin.php?page=companies&comp=" . $company->compid . "&validate=true>Validate</a></td>
</tr>";
}
?>
	</tbody>
</table>
<p><strong>Note:</strong><br />Companies List</p>