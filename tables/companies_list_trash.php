<table class="widefat tag fixed" cellspacing="0">
	<thead>
	<tr>
	<th>Company Name</th>
	<th>Category</th>
	<th>Website</th>
	<th>e-mail</th>
	<th>Admin Actions</th>
	</tr>
	</thead>

	<tfoot>
	<tr>
	<th>Company Name</th>
	<th>Category</th>
	<th>Website</th>
	<th>e-mail</th>
	<th>Admin Actions</th>
	</tr>
	</tfoot>

<tbody id="the-list" class="list:tag">
<?php
global $wpdb;

//Chech if is category or subcategory
$companies = $wpdb->get_results("SELECT * FROM `wp_easybdcompanies` WHERE trash='1'"); 

foreach ($companies as $company) {
$realcat = $wpdb->get_var($wpdb->prepare("SELECT catname FROM wp_easybdcategories WHERE catid=" . $company->compcat . ";"));
echo "<tr>
<td>" . $company->compname . "</td>
<td>" . $realcat . "</td>
<td>" . $company->website . "</td>
<td>" . $company->email . "</td>
<td>
<a href=admin.php?page=companies&comp=" . $company->compid . "&edit=true>Edit</a> | 
<a href=deletecomp.php?comp=" . $company->compid . "&action=deletecatnow>Delete</a></td>
</tr>";
}
?>
	</tbody>
</table>
<p><strong>Note:</strong><br />sdfsdfsd</p>



