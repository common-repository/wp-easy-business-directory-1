<?php
/*
Plugin Name: WP-WORDPRESS BUSINESS DIRECTORY
Plugin URI: http://www.easyinternet.gr
Description: Just an other wordpress business directory plugin
Author: Yiannopoulos Konstantinos
Version: 1.0.2
Author URI: http://www.easyinternet.gr
*/
global $jal_db_version;
$jal_db_version = "1.1";

function jal_install () {
   global $wpdb;
   global $jal_db_version;

   $table_name = $wpdb->prefix . "easybdcompanies";
   $table_name1 = $wpdb->prefix . "easybdcategories";

  $sql = "CREATE TABLE " . $table_name . " (
  `compid` int(8) NOT NULL AUTO_INCREMENT,
  `compname` varchar(255) NOT NULL,
  `compcat` int(8) NOT NULL,
  `shortdesc` text NOT NULL,
  `fulldesc` text NOT NULL,
  `contact` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `tk` varchar(6) NOT NULL,
  `phone1` varchar(20) NOT NULL,
  `phone2` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `logn` varchar(255) NOT NULL,
  `trash` int(1) NOT NULL,
  `valid` int(1) NOT NULL,
  `userid` int(1) NOT NULL
  PRIMARY KEY (`compid`)
	)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0";
	
$sql1 = "CREATE TABLE " . $table_name1 . " (
    `catid` int(8) NOT NULL AUTO_INCREMENT,
  `mother` int(8) NOT NULL,
  `catname` varchar(255) NOT NULL,
  `catdesc` text NOT NULL,
  `trash` int(1) NOT NULL,
  PRIMARY KEY (`catid`)
  	)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0";	
	

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($sql);
dbDelta($sql1);
}


// Hook for adding admin menus
add_action('admin_menu', 'ky_add_pages');
add_action( 'admin_init', 'register_wpeasybdsettings' );

// action function for above hook
function ky_add_pages() {
add_menu_page(__('WP EASY BD','menu-wpeasybd'), __('WP EASY BD','menu-wpeasybd'), 'manage_options', 'wpeasybd-top-level-handle', 'wpeasybd_toplevel_page' );
add_submenu_page('wpeasybd-top-level-handle', __('Companies','menu-wpeasybd'), __('Companies','menu-wpeasybd'), 'manage_options', 'companies', 'wpeasybd_companies');
add_submenu_page('wpeasybd-top-level-handle', __('Add New Company','menu-wpeasybd'), __('Add new company','menu-wpeasybd'), 'manage_options', 'newcompany', 'wpeasybd_newcompany');
add_submenu_page('wpeasybd-top-level-handle', __('Categories','menu-wpeasybd'), __('Categories','menu-wpeasybd'), 'manage_options', 'categories', 'wpeasybd_categories');
//add_submenu_page('wpeasybd-top-level-handle', __('Add New Category','menu-wpeasybd'), __('Add New Category','menu-wpeasybd'), 'manage_options', 'newcategory', 'wpeasybd_newcategory');
add_submenu_page('wpeasybd-top-level-handle', __('Options','menu-wpeasybd'), __('Options','menu-wpeasybd'), 'manage_options', 'myoptions', 'wpeasybd_myoptions');
add_submenu_page('wpeasybd-top-level-handle', __('Trash','menu-wpeasybd'), __('Trash','menu-wpeasybd'), 'manage_options', 'trash', 'wpeasybd_trash');
}

//action css register
add_action('wp_head', 'wpeasybd_css_register_head');

//register our settings
function register_wpeasybdsettings() 
	{
		register_setting( 'baw-wpeasybd-group', 'buspage' );
	}

if (isset($_GET['activate']) && $_GET['activate'] == 'true') 
	{
   		add_action('init', 'jal_install');
	}

function wpeasybd_toplevel_page() 
	{
		echo "<div class=\"wrap\">";
    	echo "<h2>" . __( 'WP-EASY-BUSINESS-DIRECTORYl', 'menu-wpeasybd' ) . "</h2>";
		echo "A simple yet powerful wordpress business directory";
		echo "</div>";    
	}

function wpeasybd_companies() 
	{
		echo "<div class=\"wrap\">";
    	echo "<h2>" . __( 'Companies List', 'menu-wpeasybd' ) . "</h2>";
    	include ("companies.php");
		echo "</div>";  
	}

function wpeasybd_newcompany() 
	{
		echo "<div class=\"wrap\">";
    	echo "<h2>" . __( 'Add New Company', 'menu-wpeasybd' ) . "</h2>";
    	include ("newcompany.php");
		echo "</div>";  
	}

function wpeasybd_categories() 
	{
		echo "<div class=\"wrap\">";
    	echo "<h1>" . __( 'Categories', 'menu-wpeasybd' ) . "</h1>";
		include ("categories.php");
		echo "</div>";  
	}

function wpeasybd_myoptions() 
	{
		echo "<div class=\"wrap\">";
    	echo "<h2>" . __( 'WP-EASY-BUSINESS-DIRECTORY OPTIONS', 'menu-wpeasybd' ) . "</h2>";
		include ("wpeasybd-options.php");
	}

function wpeasybd_trash() 
	{
		echo "<div class=\"wrap\">";
    	echo "<h1>" . __( 'Trash', 'menu-wpeasybd' ) . "</h1>";
		include ("trash.php");
		echo "</div>";  
	}

include ("wpeasybd-functions.php");
?>