<?php
global $wpdb;
if ($_GET[cat]) 
	{ 
		$categories = $wpdb->get_results("SELECT * FROM wp_easybdcategories WHERE trash!='1' AND mother=" . $_GET[cat] . ""); 
		$mothercat = $wpdb->get_var($wpdb->prepare("SELECT catname FROM wp_easybdcategories WHERE catid=" . $_GET[cat] . ""));
?>
<h2>Categories List</h2>
<table class="widefat tag fixed" cellspacing="0">
	<thead>
	<tr>
	<th>Category Name</th>
	<th>Mother Category</th>
	<th>Category Description</th>
	<th>Number of Companies</th>
	<th>Admin Actions</th>
	</tr>
	</thead>

	<tfoot>
	<tr>
	<th>Category Name</th>
	<th>Sub Categories</th>
    <th>Category Description</th>
	<th>Number of Companies</th>
	<th>Admin Actions</th>
	</tr>
	</tfoot>

<tbody id="the-list" class="list:tag">
<?php
foreach ($categories as $category) 
			{
				echo "<tr>
				<td>" . $category->catname . "</td>
				<td>" . $mothercat . "</td>
				<td>" . $category->catdesc . "</td>
				<td>111111111</td>
				<td>
				<a href=admin.php?page=categories&cat=" . $category->catid . "&edit=true>Edit</a> | 
				<a href=admin.php?page=categories&cat=" . $category->catid . "&easyaction=deletecategory>Delete</a></td>
				</tr>";
			}
	} 
else if (!$_GET[cat]) 
	{ 
	$categories = $wpdb->get_results("SELECT * FROM wp_easybdcategories WHERE trash!='1' AND mother='0'"); 
?>
<h2>Categories List</h2>
<table class="widefat tag fixed" cellspacing="0">
	<thead>
	<tr>
	<th>Category Name</th>
	<th>Sub Categories</th>
	<th>Category Description</th>
	<th>Number of Companies</th>
	<th>Admin Actions</th>
	</tr>
	</thead>

	<tfoot>
	<tr>
	<th>Category Name</th>
	<th>Sub Categories</th>
    <th>Category Description</th>
	<th>Number of Companies</th>
	<th>Admin Actions</th>
	</tr>
	</tfoot>

<tbody id="the-list" class="list:tag">

<?php
foreach ($categories as $category) 
			{
				echo "<tr>
				<td>" . $category->catname . "</td>
				<td><a href=admin.php?page=categories&cat=" . $category->catid . ">Subcategories</a></td>
				<td>" . $category->catdesc . "</td>
				<td>111111111</td>
				<td>
				<a href=admin.php?page=categories&cat=" . $category->catid . "&edit=true>Edit</a> | 
				<a href=admin.php?page=categories&cat=" . $category->catid . "&easyaction=deletecategory>Delete</a></td>
				</tr>";
			}
	}
?>
	</tbody>
</table>
<p><strong>Note:</strong><br />Categories list</p>



