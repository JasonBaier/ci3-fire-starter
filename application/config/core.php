<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Core Config File
 */

// Site Details
$config['site_version']          = "3.4.5";          // this is CI3 Fire Starter version - set it to 1.0.0 for your new project
$config['themes_folder']         = "assets/themes";  // folder containing your themes
$config['public_theme']          = "default";        // folder containing your public theme
$config['admin_theme']           = "admin";          // folder containing your admin theme
$config['captcha_folder']        = "assets/captcha"; // folder to save CAPTCHA images - must have write permission

// Pagination
$config['num_links']             = 8;
$config['full_tag_open']         = "<div class=\"pagination\">";
$config['full_tag_close']        = "</div>";

// Login Attempts
$config['login_max_time']        = 10;               // in seconds
$config['login_max_attempts']    = 3;

// Miscellaneous
$config['profiler']              = FALSE;
$config['error_delimeter_left']  = "";
$config['error_delimeter_right'] = "<br />";
