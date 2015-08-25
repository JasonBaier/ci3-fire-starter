# CI3 Fire Starter (ci3-fire-starter)

##INTRODUCTION

CI3 Fire Starter is a CodeIgniter3 skeleton application that includes jQuery and Bootstrap. It is intended to be light weight, minimalistic and not get in your way of building great CodeIgniter 3 applications. It is also intended for newbies who want a simple, easy platform for learning CodeIgniter.

Here is what's included:

* CodeIgniter 3.x
* Single base controller with Public, Private, Admin and API classes
* JSi18n Library to support internationalization in your JS files
* The latest version of jQuery
* The latest version of Bootstrap 3
* Independent admin and frontend themes
* [Summernote](http://summernote.org/ "Summernote") WYSIWYG editor
* Auto-loaded core config file
* Auto-loaded core language file
* Auto-loaded core helper files
    + Human-readable JSON string output for API functions
    + Array to CSV exporting
    + Enhanced CAPTCHA
* User authentication with registration, forgot password and profile editor
* Contact Us page
* Basic admin tool with dashboard, user management, settings and Contact Us message list
* File-based sessions

That should be the minimal features you need to kickstart many projects. While there are many great CodeIgniter CMS applications (see below), sometimes you don't need a full CMS, or you need something much simpler than what's available, or you need a completely customizable solution. That's why I created CI3 Fire Starter. I was tired of always having to do the same things over and over again. So I took some best practices, included all the addons and functions I most commonly use, and this was the end result, which I now use to start all of my projects.

I hope you find it useful. **Please [fork it on Github](https://github.com/JasonBaier/ci3-fire-starter/fork "Fork It") and help make it better!**

NOTE: This documentation assumes you are already familiar with PHP and CodeIgniter. To learn more about PHP, visit http://php.net/. If you need to learn more about CodeIgniter, visit the user guide at http://www.codeigniter.com/userguide3/index.html.

![Welcome Screen](http://s3.postimg.org/7vxaw3b2b/ci3_fire_starter_welcome_screen.png?raw=true)

##MODULAR

The former versions of CI Fire Starter (less than v3.0.0) used to implement wiredesign's Modular Extensions
(https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc). At this time I have opted not to include it, however, if you have an argument in support of reimplementing it, I'm all ears... just let me know.

##BASE CLASSES

Phil Sturgeon wrote a very helpful blog post years ago called "CodeIgniter Base Classes: Keeping it DRY"
(http://philsturgeon.co.uk/blog/2010/02/CodeIgniter-Base-Classes-Keeping-it-DRY). The methods he described have been
applied to CI3 Fire Starter. There is a file in /application/core called MY_Controller.php which includes the Public, Private, Admin and API base classes. This allows you to use shared functionality.

####MY_Controller

This loads settings, defines includes that get passed to the views, loads logged-in user data, sets the configured timezone,
and turns the profiler on or off.

####Understanding Includes

* page_title    : the title of the page which gets inserted into the document head
* css_files     : an array of css files to insert into the document head
* js_files      : an array of javascript libraries to insert into the document body
* js_files_i18n : an array of javascript files with internationalization to insert into the document body (see more about these below)

Includes can be appended and/or overwritten from any controller function.

####Public_Controller

This extends MY_Controller and drives all your public pages (home page, etc). Any controller that extends
Public_Controller will be open for the whole world to see.

####Private_Controller

This extends MY_Controller and drives all your private pages (user profile, etc). Any controller that extends
Private_Controller will require authentication. Specific page requests are stored in session and will redirect upon
successful authentication.

![Profile Screen](http://s8.postimg.org/xpcn4kuud/ci3_fire_starter_profile_screen.png?raw=true)

####Admin_Controller

This extends MY_Controller and drives all your administration pages. Any controller that extends Admin_Controller will
require authentication from a user with administration privileges. Specific page requests are stored in session and will
redirect upon successful authentication.

![Settings Screen](http://s4.postimg.org/3ltmgpt5p/ci3_fire_starter_setttings_screen.png?raw=true)

####API_Controller

This extends MY_Controller and drives all your API functions. Any controller that extends API_Controller will be open
for the whole world to see (see below for details).

##CORE FILES

####Core Config

In application/config there is a file core.php. This file allows you to set site-wide variables. It is set up with site version, default templates, pagination settings, enable/disable the profiler and default form validation error delimiters.

####Core Language

In application/language/english is a file core_lang.php. This file allows you to set language variables that could be used throughout the entire site (such as the words Home or Logout).

####Core Helper

In application/helper is a file core_helper.php. This includes the following useful functions:
* display_json($array) - used to output an array as JSON in a human-readable format - used by the API
* json_indent($array) - this is the function that actually creates the human-readable JSON string
* array_to_csv($array, $filename) - exports an array into a CSV file (see admin user list)

##LIBRARIES

####Jsi18n

In application/libraries is a file Jsi18n.php. This library allows you to internationalize your JavaScript files through CI language files and was inspired by Alexandros D on coderwall.com (https://coderwall.com/p/j88iog).

Load this library in the autoload.php file or manually in your controller:

    $this->load->library('jsi18n');

In your language file:

    $lang['alert_message'] = "This is my alert message!";

In your JS files, place your language key inside double braces:

    function myFunction() {
        alert("{{alert_message}}");
    }

Render the Javascript file in your template file:

    <script type="text/javascript"><?php echo $this->jsi18n->translate("/themes/admin/js/my_javascript_i18n.js"); ?></script>

OR in your includes array:

    $this->includes = array_merge_recursive($this->includes, array(
        'js_files_i18n' => array(
            $this->jsi18n->translate("/themes/admin/js/my_javascript_i18n.js")
        )
    ));

##USER MANAGEMENT

CI3 Fire Starter comes with a simple user management tool in the administration tool. It uses a database table called 'users'. This tool demonstrates a lot of basic but important functionality:

* Sortable list columns
* Search filters
* Pagination with user-changeable items/page
* Exporting lists to CSV
* Form validation
* Harnessing the power of Bootstrap to accelerate development

![User Administration](http://s27.postimg.org/udwfwrtqb/ci3_fire_starter_user_list.png?raw=true)

Important note: user 1 is the main administrator - DO NOT MANUALLY DELETE. You can not delete this user from within the admin tool.

##THEMES

There are 2 responsive themes provided with CI3 Fire Starter: 'admin' and 'default'. There is also a 'core' theme for global assets. To keep the application light-weight, I did not include a templating library, such as Smarty, nor did I utilize CI's built-in parser. If you really wanted to include one, you could check out Phil Sturgeon's CI-Dwoo extension
(https://github.com/philsturgeon/codeigniter-dwoo).

####Theme Functions

***add_css_theme( $css_files )***

This function is used to easily add css files to be included in a template. With this function, you can just add the css file name as a parameter and it will use the default css path for the active theme.
You can add one or more css files as the parameter, either as a string or an array. If using parameter as a string, it must use comma separation between each css file name.

**Example:**

	 1. Using string as parameter
	     $this->add_css_theme("bootstrap.min.css, style.css, admin.css");

	 2. Using array as parameter
	     $this->add_css_theme(array("bootstrap.min.css", "style.css", "admin.css"));

***add_js_theme($js_files, $is_i18n)***

This function is used to easily add Javascript files to be included in a template. With this function, you can just add the js file name as a parameter and it will use the default js path for the active theme.
You can add one or more js files as the parameter, either as a string or an array. If using the parameter as a string, it must use comma separation between each js file name.

The second parameter is used to indicate that the js file supports internationalization using the i18n library. Default is FALSE.

**Example:**

	 1. Using string as parameter
	     $this->add_js_theme("jquery-1.11.1.min.js, bootstrap.min.js, another.js");

	 2. Using array as parameter
	     $this->add_js_theme(array("jquery-1.11.1.min.js", "bootstrap.min.js,", "another.js"));


***add_jsi18n_theme($js_files)***

This function is used to easily add Javascript files that support internationalization to be included in a template. With this function, you can just add the js file name as the parameter and it will use the default js path for the active theme.
You also can add one or more js files as the parameter, either as a string or an array. If using the parameter as a string, it must use comma separation between each js file name.

    1. Using string as parameter
	    $this->add_jsi18n_theme("dahboard_i18n.js, contact_i18n.js");

	2. Using array as parameter
	    $this->add_jsi18n_theme(array("dahboard_i18n.js", "contact_i18n.js"));

	3. Or we can use add_js_theme function, and add TRUE for second parameter
	    $this->add_js_theme("dahboard_i18n.js, contact_i18n.js", TRUE);
	    	- or -
	    $this->add_js_theme(array("dahboard_i18n.js", "contact_i18n.js"), TRUE);

***add_external_css( $css_files, $path )***

This function is used to easily add css files from external sources or outside the theme folder to be included in a template.
With this function, you can just add the css file name and their external path as the parameter, or add css complete with path. See example below:

    1. Using string as first parameter
	    $this->add_external_css("global.css, color.css", "http://example.com/assets/css/");
	 	- or -
	    $this->add_external_css("http://example.com/assets/css/global.css, http://example.com/assets/css/color.css");

	2. Using array as first parameter
	    $this->add_external_css(array("global.css", "color.css"), "http://example.com/assets/css/");
		- or -
	    $this->add_external_css(array("http://example.com/assets/css/global.css", "http://example.com/assets/css/color.css"));

***add_external_js( $js_files, $path )***

This function is used to easily add js files from external sources or outside the theme folder to be included in a template.
With this function, you can just add the js file name and their external path as the parameter, or add js complete with path. See example below:

    1. Using string as first parameter
	    $this->add_external_js("global.js, color.js", "http://example.com/assets/js/");
	 	- or -
	    $this->add_external_js("http://example.com/assets/js/global.js, http://example.com/assets/js/color.js");

	2. Using array as first parameter
	    $this->add_external_js(array("global.js", "color.js"), "http://example.com/assets/js/");
		- or -
	    $this->add_external_js(array("http://example.com/assets/js/global.js", "http://example.com/assets/js/color.js"));

These methods can also be chained like this:

    $this
        ->add_css_theme("bootstrap.min.css, style.css, admin.css")
		->add_external_css("global.css, color.css", "http://example.com/assets/css/")
        ->add_js_theme("jquery-1.11.1.min.js, bootstrap.min.js, another.js")
		->add_js_theme("dahboard_i18n.js, contact_i18n.js", TRUE)
		->add_external_js("global.js, color.js", "http://example.com/assets/js/");

Sometimes you might want to use a different template for different pages, for example, 404 template, login template, full-width template, sidebar template, etc.
You can simply load a different template using this function:

***set_template($template_file)***

##APIS

With the API class, you can quite easily create API functions for external applications. There is no security on these, so if you need a more robust solution, such as authentication and API keys, check out Phil Sturgeon's CI Rest Server (https://github.com/philsturgeon/codeigniter-restserver). You could also just set your own request authentication headers to the code that's already there.

![Sample JSON String](http://s8.postimg.org/nx4x1tdlx/ci3_fire_starter_sample_api.png?raw=true)

##SYSTEM REQUIREMENTS

* PHP version 5.4+
* MySQL 5.1+
* PHP GD extension for CAPTCHA to work
* PHP Mcrypt extension if you want to use the Encryption class

##INSTALLATION

* Create a new database and import the included sql file from the /assets folder
    + default administrator username/password is admin/admin
* Modify the application/config/config.php
    + line 214: set your log threshold - I usually set it to 1 for production environments
    + line 308: set your encryption key using the [recommended method](http://www.codeigniter.com/user_guide/libraries/encryption.html#setting-your-encryption-key "Encryption Library: Setting your encryption key")
* Modify application/config/database.php and connect to your database
* Upload all files to your server
* Make sure the /captcha/ folder has write permission
* Set /application/sessions permission to 0600
* Configure your path to use /htdocs
* Visit your new URL
* The default welcome page includes links to the admin tool and the private user profile page
* Make sure you log in to admin and change the administrator password!

##CONCLUSION

As I said earlier, CI3 Fire Starter does not attempt to be a full-blown CMS. You would need
to build that functionality on your own. If you want a great CMS built on CodeIgniter, or need a more robust
starting point, check out one of these awesome applications:

* HeroFramework: sadly, this project appears to no longer be active since their website went down - but the source is still available here: https://github.com/electricfunction/hero
* Halogy: http://www.halogy.com/
* Expression Engine: http://ellislab.com/expressionengine (from the original creators of CodeIgniter)
* GoCart: http://gocartdv.com/ (shopping cart)
* Open-Blog: http://www.open-blog.org/ (this is my other project - currently working on a complete rewrite, but it's
  been slow going)
* Bonfire: http://cibonfire.com/ (this is more of an application builder than a full CMS)
* FuelCMS: http://getfuelcms.com/
* CMS Canvas: http://www.cmscanvas.com/

##WHAT'S NEW

####Version 3.1.2
08/25/2015

Thanks [DeeJaVu](https://github.com/DeeJaVu "DeeJaVu") for your Turkish and Dutch translations.

* Included pull requests
    + Turkish & Dutch translations
* Upgraded to CI 3.0.1

####Version 3.1.1
06/16/2015

Thanks [arif-rh](https://github.com/arif-rh "Arif RH") and [simogeo](https://github.com/simogeo "Simon Georget") for your contributions.

* Included pull requests
    + Added base_url to links
    + Improved theme functions
    + Indonesian translation
    + Repeat Password error fix
* Fixed email validation check during account registration
* Links to this Github page in theme footers

####Version 3.1.0
04/15/2015

* Upgraded to CI 3.0.0

####Version 3.0.5
03/11/2015

* Upgraded to CI 3.0rc3

####Version 3.0.4
02/17/2015

* Upgraded to CI 3.0rc2

####Version 3.0.3
01/31/2015

* Added missing glyphicon halfling fonts
* Added favicon transparency
* Fixed favicon bug in main template files

####Version 3.0.2
01/31/2015

* Updated site name in footers

####Version 3.0.1
01/31/2015

* Upgraded to CI 3.0rc

####Version 3.0.0
01/31/2015

* Started as a whole new repository (retiring former repo)
* Upgraded to CI 3.0dev
* Stripped out HMVC pattern
* Removed database navigation
* Replaced TinyMCE with Summernote
* Lots of code cleanup and other improvements

####Version 2.0.0
05/06/2014

Too many to list them all, but here are some of the major changes:

* Added database-driven settings administration
* Included TinyMCE WYSIWYG editor
* Included Bootstrap DatePicker and modified to work with Bootstrap 3.x
* Removed separate auth module and merged into user module
* Added user self-registration and forgot password functionality to the user module
* Removed separate login template
* Added database-driven menus with sub-menu capabilities and built-in Bootstrap formatting
* Added a CAPTCHA-protected contact page with an admin tool to view messages
* Enabled CSRF protection on all forms
* Enabled database session handling
* Tons of code cleanup and miscellaneous improvements

####Version 1.0.1
10/10/2013

* Removed admin template includes
* Made login more secure using salt
* Modified users table to handle the login change
    + password field is now char(128)
    + added salt field char(128)
* Added this what-new.txt file
* Added road-map.txt

####Version 1.0.0
10/08/2013

* Initial version

##FORK IT!

**Please [fork CI3 Fire Starter on Github](https://github.com/JasonBaier/ci3-fire-starter/fork "Fork It") and help make it better!**
