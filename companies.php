<?php 
if ($_GET[edit]=='true') 
{
include ("forms/edit-company.php");
} 

if ((!$_GET[edit]=='true') AND (!$_POST) AND (!$_GET[delete]=='true'))
{
include ("tables/companies_list_for_validation.php");
include ("tables/companies_list.php");
} 

if  ((!$_GET[edit]=='true') AND ($_POST) AND ($_GET[easyaction]=='updatecategory'))
{
global $wpdb;
$wpdb->update( 'wp_easybdcompanies', array( 
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
'logn' => $_POST[logn]), array( 'compid' => $_POST[compid] ), array( '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s','%s','%s','%s','%s','%s','%s'  ), array( '%d' ) );

print <<<EOF
<meta http-equiv="REFRESH" content="0;url=admin.php?page=companies"></HEAD>
EOF;

}

if  ($_GET[delete]=='true')
{
global $wpdb;
$wpdb->update( 'wp_easybdcompanies', array( 'trash' => 1), array( 'compid' => $_GET[comp] ), array( '%d' ), array( '%d' ) );
print <<<EOF
<meta http-equiv="REFRESH" content="0;url=admin.php?page=companies"></HEAD>
EOF;
}

if  ($_GET[validate]=='true')
{
global $wpdb;
$wpdb->update( 'wp_easybdcompanies', array( 'valid' => 1), array( 'compid' => $_GET[comp] ), array( '%d' ), array( '%d' ) );
print <<<EOF
<meta http-equiv="REFRESH" content="0;url=admin.php?page=companies"></HEAD>
EOF;
}

?>