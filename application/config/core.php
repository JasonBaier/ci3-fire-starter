<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Core Config File
 */

// Site Details
$config['site_version']          = "3.2.3";     // this is CI3 Fire Starter version - set it to 1.0.0 for your new project
$config['root_folder']           = "htdocs";    // set to whatever your webroot is (htdocs, public_html, etc.) - MAKE SURE you rename the /htdocs folder locally
$config['public_theme']          = "Default";   // folder containing your public theme
$config['admin_theme']           = "Admin";     // folder containing your admin theme

// Pagination
$config['num_links']             = 8;
$config['full_tag_open']         = "<div class=\"pagination\">";
$config['full_tag_close']        = "</div>";

// Miscellaneous
$config['profiler']              = FALSE;
$config['error_delimeter_left']  = "";
$config['error_delimeter_right'] = "<br />";
