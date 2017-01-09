# CI3 Fire Starter (ci3-fire-starter)

<a name="toc"></a>
## TABLE OF CONTENTS
* [Introduction](#introduction)
* [(Not) Modular](#not-modular)
* [Base Classes](#base-classes)
  * [MY\_controller](#my-controller)
  * [Public\_controller](#public-controller)
  * [Private\_controller](#private-controller)
  * [Admin\_controller](#admin-controller)
  * [API\_controller](#api-controller)
  * [Understanding Includes](#understanding-includes)
* [Core Files](#core-files)
  * [Core Config](#core-config)
  * [Core Language](#core-language)
  * [Core Helper](#core-helper)
* [Internationalization](#i18n)
  * [Jsi18n Library](#jsi18n-library)
* [User Management](#user-management)
* [Settings](#settings)
* [Themes](#themes)
  * [Theme Functions](#theme-functions)
* [APIs](#apis)
* [System Requirements](#system-requirements)
* [Installation](#installation)
* [Updates](#updates)
* [Conclusion](#conclusion)
* [What's New](#whats-new)
* [Fork It!](#forkit)

<a name="introduction"></a>
## INTRODUCTION

CI3 Fire Starter is a CodeIgniter3 skeleton application that includes [jQuery](https://jquery.com/) and
[Twitter Bootstrap](http://getbootstrap.com/). It is intended to be light weight, minimalistic and not
get in your way of building great CodeIgniter 3 applications. It is also intended for new CodeIgniter
developers who want a simple, easy platform for learning the framework.

* CodeIgniter 3.x
* Base controllers for Public, Private, Admin and API classes
* Internationalization (translations) support
    + Jsi18n Library to support internationalization in your JS files
* The latest version of [jQuery](https://jquery.com/)
* The latest version of [Twitter Bootstrap](http://getbootstrap.com/)
* The latest version of [Font Awesome](https://fortawesome.github.io/Font-Awesome/)
* Independent responsive admin and frontend themes
* [Summernote](http://summernote.org/ "Summernote") WYSIWYG editor
* Auto-loaded core config file
* Auto-loaded core language file (based on selected language)
* Auto-loaded core helper files
    + Human-readable JSON string output for API functions
    + Array to CSV exporting
    + Enhanced CAPTCHA
    + Random password generator
    + Available languages fetcher
* Simple user authentication with registration, forgot password and profile editor
* Contact Us page with enhanced CAPTCHA
* Basic admin tool with dashboard, user management, settings and Contact Us message list
* File-based sessions

That should cover the basic needs for kickstarting many small CodeIgniter 3 projects. While there are some
great CodeIgniter CMS applications ([see below](#conclusion)), sometimes you don't need a full CMS or you
need a completely customizable solution. That's why I created CI3 Fire Starter. I was tired of always
having to do the same things over and over again. So I took some best practices, included all the addons and
functions I most commonly use, and this was the end result, which I use to start many of my smaller projects.

I hope you find it useful. **Please [fork it on Github](https://github.com/JasonBaier/ci3-fire-starter/fork "Fork It")
and help make it better!**

NOTE: This documentation assumes you are already familiar with PHP and CodeIgniter. To learn more about PHP,
visit [php.net](http://php.net/). If you need to learn more about CodeIgniter, visit the
[CodeIgniter User Guide](http://www.codeigniter.com/userguide3/index.html).

![Welcome Screen](https://s32.postimg.org/oq5fugrgl/Screen_Shot_2016_07_26_at_3_13_15_PM.png?raw=true)

<a name="not-modular"></a>
## (NOT) MODULAR

The former versions of CI Fire Starter (prior to v3.0.0) used to utilize wiredesign's
[Modular Extensions](https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc). At this
time I have opted not to include it, however, if you have an argument in support of reimplementing it,
just let me know and we can open it up for discussion.

<a name="base-classes"></a>
## BASE CLASSES

Phil Sturgeon wrote a very helpful blog post years ago called
["CodeIgniter Base Classes: Keeping it DRY"](http://philsturgeon.co.uk/blog/2010/02/CodeIgniter-Base-Classes-Keeping-it-DRY).
The methods he described in that article have been implemented in CI3 Fire Starter. All base classes
are located in the /application/core folder.

<a name="my-controller"></a>
#### MY_Controller

This is the main core class used for loading settings, defining includes that get passed to the views,
loading logged-in user data, setting the configured timezone, and turning the profiler on or off. All
other classes extend this class.

<a name="public-controller"></a>
#### Public_Controller

This extends MY\_Controller and drives all your public pages (home page, etc). Any controller that
extends Public\_Controller will be open for the whole world to see.

<a name="private-controller"></a>
#### Private_Controller

This extends MY\_Controller and drives all your private pages (user profile, etc). Any controller that
extends Private\_Controller will require authentication. Specific page requests are stored in session
and will redirect upon successful authentication.

![Profile Screen](http://s14.postimg.org/3xmw5l4f5/Screen_Shot_2015_12_19_at_9_51_23_AM.png?raw=true)

<a name="admin-controller"></a>
#### Admin_Controller

This extends MY\_Controller and drives all your administration pages. Any controller that extends
Admin\_Controller will require authentication from a user with administration privileges. Specific
page requests are stored in session and will redirect upon successful authentication.

<a name="api-controller"></a>
#### API_Controller

This extends MY\_Controller and drives all your API functions. Any controller that extends
API\_Controller will be open for the whole world to see ([see below for details](#apis)).

<a name="understanding-includes"></a>
#### Understanding Includes

* page\_title    : the title of the page which gets inserted into the document head
* css\_files     : an array of css files to insert into the document head
* js\_files      : an array of javascript libraries to insert into the document body
* js\_files\_i18n : an array of javascript files with internationalization to insert into the document body (see more about these below)

Includes can be appended and/or overwritten from any controller function.

<a name="core-files"></a>
## CORE FILES

Several core files have been included to simplify customizations:

<a name="core-config"></a>
#### Core Config

In /application/config there is a file core.php. This file allows you to set site-wide variables. It
is set up with site version, default templates, pagination settings, login attempt settings,
enable/disable the profiler and default form validation error delimiters.

<a name="core-language"></a>
#### Core Language

In /application/language/english is a file core\_lang.php. This file allows you to set language
variables that could be used throughout the entire site (such as the words Home or Logout).

<a name="core-helper"></a>
#### Core Helper

In /application/helpers is a file core\_helper.php. This includes the following useful functions:

* display\_json($array) - used to output an array as JSON in a human-readable format - used by the API
* json\_indent($array) - this is the function that actually creates the human-readable JSON string
* array\_to\_csv($array, $filename) - exports an array into a CSV file (see admin user list)
* generate\_random\_pasword() - used to reset password for users who forgot password
* get\_languages() - retrieves a list of all language folders

<a name="i18n"></a>
## INTERNATIONALIZATION

Thanks to contributions from the community, the list of language translations is growing:

* Chinese (Simplified)
* Dutch
* English (default)
* Indonesian
* Russian
* Spanish
* Turkish

Registered users can set their own preferred language, admins can set preferred languauges for each user, and
non-registered users can use the language selector to render the site in their preferred language. The application
looks for a session variable (_$this->session->language_) to determine which language to show. If one is not found in the
session, the default defined in the main config file is used. If the user is logged in, then their assigned language is
used instead. If a user selects a different languauge other than what is configured, the selected languauge will be used
during their session.

All available languages are also stored in the session to improve performance.
They are available in _$this->session->languages_.

> If a translated language file is missing, the application will use English as the fall back using the extended MY_Lang class.

<a name="jsi18n-library"></a>
#### Jsi18n Library

This library allows you to internationalize your JavaScript files through CI language files and was
inspired by Alexandros D on [coderwall.com](https://coderwall.com/p/j88iog). It is included in /application/libraries.

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

<a name="user-management"></a>
## USER MANAGEMENT

CI3 Fire Starter comes with a simple user management tool in the administration tool. This tool demonstrates a lot of
basic but important functionality:

* Sortable list columns
* Search filters
* Pagination with user-changeable items/page
* Exporting lists to CSV
* Form validation
* Harnessing the power of Twitter Bootstrap to accelerate development

![User Administration](http://s27.postimg.org/orbhgea1f/Screen_Shot_2015_12_19_at_9_52_44_AM.png?raw=true)

IMPORTANT NOTE: user id 1 is the main administrator - DO NOT MANUALLY DELETE. You can not delete this
user from within the admin tool.

<a name="settings"></a>
## SETTINGS

Adding additional site owner-configurable setting fields couldn't be any easier. Simply add a new entry in the 'settings'
table of the database with the information below. The script then does all the work and adds the
setting fields to the form automatically. There's no need to modify the form yourself!

* name: this will be the actual input name in the settings form (Ex: site\_name)
* input\_type: type of input to use - options are: input, textarea, radio, dropdown, timezones
* options: optional field for declaring radio and dropdown values - key/value pair - each on its own line
* is\_numeric: 0 or 1 - forces numeric keypad on mobile devices and validates numbers only on form submission
* show\_editor: 0 or 1 - use only on textarea field types to utilize the WYSIWYG editor
* input\_size: use to specify width of input field - options are: small, medium, large
* translate: 0 or 1 - set to 1 if you want inputs for each language - multiple translated values are then stored as a serialized array
* help\_text: optional field for displaying help/info about the input
* validation: specifies how to validate the input values - uses the pipe-delimited rules from CI's Form
Validation Library - see [Rule Reference](https://codeigniter.com/user_guide/libraries/form_validation.html#rule-reference)
* sort\_order: use to sort the order of input fields
* label: text to display as the input's label
* value: this is the actual value stored for this setting - be sure to set something as the default value - NOTE: if you enable translation,
just enter a non-serialized value for your default language - the script will handle the rest
* last\_update: datetimestamp of when the settings field was updated
* updated\_by: reference to the 'users'.'id'

Settings are loaded in MY_Controller and are accessible in every controller, model and view file.

**Non-translated Example:**

    $this->settings->site_version

**Translated Example:**

    $this->settings->welcome_message[$this->session->language]

![Settings Screen](https://s32.postimg.org/4dn4nvo5x/Screen_Shot_2016_07_26_at_3_12_17_PM.png?raw=true)

<a name="themes"></a>
## THEMES

There are 2 responsive themes provided with CI3 Fire Starter: 'admin' and 'default'. There is also a
'core' theme for global assets. To keep the application light-weight, I did not include a templating
library, such as Smarty, nor did I utilize CI's built-in parser. If you really wanted to include one,
you could check out Phil Sturgeon's [CI-Dwoo extension](https://github.com/philsturgeon/codeigniter-dwoo).

<a name="theme-functions"></a>
#### Theme Functions

***add_css_theme($css_files)***

This function is used to easily add css files to be included in a template. With this function, you
can just add the css file name as a parameter and it will use the default css path for the active theme.
You can add one or more css files as the parameter, either as a string or an array. If using parameter
as a string, it must use comma separation between each css file name.

	 1. Using string as parameter
	     $this->add_css_theme("bootstrap.min.css, style.css, admin.css");

	 2. Using array as parameter
	     $this->add_css_theme(array("bootstrap.min.css", "style.css", "admin.css"));

***add_js_theme($js_files, $is_i18n)***

This function is used to easily add Javascript files to be included in a template. With this function,
you can just add the js file name as a parameter and it will use the default js path for the active theme.
You can add one or more js files as the parameter, either as a string or an array. If using the parameter
as a string, it must use comma separation between each js file name.

The second parameter is used to indicate that the js file supports internationalization using the i18n library. Default is FALSE.

	 1. Using string as parameter
	     $this->add_js_theme("jquery-1.11.1.min.js, bootstrap.min.js, another.js");

	 2. Using array as parameter
	     $this->add_js_theme(array("jquery-1.11.1.min.js", "bootstrap.min.js,", "another.js"));


***add_jsi18n_theme($js_files)***

This function is used to easily add Javascript files that support internationalization to be included
in a template. With this function, you can just add the js file name as the parameter and it will use
the default js path for the active theme. You also can add one or more js files as the parameter,
either as a string or an array. If using the parameter as a string, it must use comma separation
between each js file name.

    1. Using string as parameter
	    $this->add_jsi18n_theme("dahboard_i18n.js, contact_i18n.js");

	2. Using array as parameter
	    $this->add_jsi18n_theme(array("dahboard_i18n.js", "contact_i18n.js"));

	3. Or we can use add_js_theme function, and add TRUE for second parameter
	    $this->add_js_theme("dahboard_i18n.js, contact_i18n.js", TRUE);
	    	- or -
	    $this->add_js_theme(array("dahboard_i18n.js", "contact_i18n.js"), TRUE);

***add_external_css($css_files, $path)***

This function is used to easily add css files from external sources or outside the theme folder to be
included in a template. With this function, you can just add the css file name and their external path
as the parameter, or add css complete with path. See example below:

    1. Using string as first parameter
	    $this->add_external_css("global.css, color.css", "http://example.com/assets/css/");
	 	- or -
	    $this->add_external_css("http://example.com/assets/css/global.css, http://example.com/assets/css/color.css");

	2. Using array as first parameter
	    $this->add_external_css(array("global.css", "color.css"), "http://example.com/assets/css/");
		- or -
	    $this->add_external_css(array("http://example.com/assets/css/global.css", "http://example.com/assets/css/color.css"));

***add_external_js($js_files, $path)***

This function is used to easily add js files from external sources or outside the theme folder to be
included in a template. With this function, you can just add the js file name and their external path
as the parameter, or add js complete with path. See example below:

    1. Using string as first parameter
	    $this->add_external_js("global.js, color.js", "http://example.com/assets/js/");
	 	- or -
	    $this->add_external_js("http://example.com/assets/js/global.js, http://example.com/assets/js/color.js");

	2. Using array as first parameter
	    $this->add_external_js(array("global.js", "color.js"), "http://example.com/assets/js/");
		- or -
	    $this->add_external_js(array("http://example.com/assets/js/global.js", "http://example.com/assets/js/color.js"));

***Chaining***

These methods can also be chained like this:

    $this
        ->add_css_theme("bootstrap.min.css, style.css, admin.css")
		->add_external_css("global.css, color.css", "http://example.com/assets/css/")
        ->add_js_theme("jquery-1.11.1.min.js, bootstrap.min.js, another.js")
		->add_js_theme("dahboard_i18n.js, contact_i18n.js", TRUE)
		->add_external_js("global.js, color.js", "http://example.com/assets/js/");

***set_template($template_file)***

Sometimes you might want to use a different template for different pages, for example, 404 template,
login template, full-width template, sidebar template, etc. You can simply load a different template
using this function.

<a name="apis"></a>
## APIS

With the API class, you can easily create API functions for external applications. There is no
security on these, so if you need a more robust solution, such as authentication and API keys, check
out Phil Sturgeon's [CI Rest Server](https://github.com/philsturgeon/codeigniter-restserver). You
could also just set your own request authentication headers to the code that's already there.

![Sample JSON String](http://s8.postimg.org/nx4x1tdlx/ci3_fire_starter_sample_api.png?raw=true)

<a name="system-requirements"></a>
## SYSTEM REQUIREMENTS

* PHP version 5.6+ (successfully tested on PHP 7.0.x)
* MySQL 5.1+
* PHP GD extension for CAPTCHA to work
* PHP Mcrypt extension if you want to use the Encryption class

See CodeIgniter's [Server Requirements](https://codeigniter.com/user_guide/general/requirements.html)
for the complete list.

<a name="installation"></a>
## INSTALLATION

* Create a new database and import the included sql file from the /data folder
    + default administrator username/password is **admin/admin**
* Modify the /application/config/config.php
    + line 26: set your base site URL (new requirement as of CI v3.0.3)
    + line 220: set your log threshold - I usually set it to 1 for production environments
    + line 314: set your encryption key using the [recommended method](http://www.codeigniter.com/user_guide/libraries/encryption.html#setting-your-encryption-key "Encryption Library: Setting your encryption key")
* Modify /application/config/database.php and connect to your database
* Modify /application/config/core.php and set $config['root_folder'] to match your server's webroot (htdocs, public_html, etc.)
* Upload all files to your server - for security, /application and /system must go above your webroot and all the files and subfolders in /htdocs will go inside your webroot
* Make sure the /captcha folder inside your webroot has write permission
* Set /application/sessions permission to 0600
* Visit your new URL
* The default welcome page includes links to the admin tool and the private user profile page
* Make sure you log in to admin and change the administrator password!

<a name="updates"></a>
## UPDATES

Since version 3.2.4, anytime changes to the database are required, you'll find SQL files in /data/schema\_updates

<a name="conclusion"></a>
##CONCLUSION

As I mentioned earlier, CI3 Fire Starter does not attempt to be a full-blown CMS. You would need
to build that functionality yourself. If you're looking for a full CMS built on CodeIgniter,
or need a more robust starting point, then check out one of these applications:

* [GoCart](http://gocartdv.com/)
* [Bonfire](http://cibonfire.com/)
* [FuelCMS](http://getfuelcms.com/)
* [Hoosk](http://hoosk.org/)
* [Ionize](http://ionizecms.com/)
* [NodCMS](http://www.nodcms.com)
* [Codefight](http://codefight.org/)
* [No-CMS](http://getnocms.com/)
* [Expression Engine](http://ellislab.com/expressionengine/)
* [Halogy](http://www.halogy.com/)

_This list is provided only as an alternative resource. It is not an endorsement for any of the applications listed._

<a name="whats-new"></a>
## WHAT'S NEW

#### Version 3.3.5
01/09/2017

* Merged some of the changes contributed by [arif-rh](https://github.com/arif-rh "Arif RH")
* Upgraded to CI 3.1.3

#### Version 3.3.4
12/28/2016

* Moved too many login attempts process

#### Version 3.3.3
12/20/2016

* Upgraded latest version of jQuery
* Upgraded latest version of Bootstrap
* Upgraded latest version of FontAwesome
* Upgraded latest version of Summernote

#### Version 3.3.2
12/14/2016

* Upgraded to CI 3.1.2
* Fixed issue #34: Admin template footer bug

#### Version 3.3.1
08/09/2016

* Display PHP version in footer
* Updated README file CMS listing

#### Version 3.3.0
07/26/2016

* Upgraded to CI 3.1.0
* Fixed date search issue on Messages list
* Changed CI3 Fire Starter logo to comply with the [CodeIgniter Logo Guidelines and Usage](https://codeigniter.com/help/legal)

#### Version 3.2.6
04/02/2016

* Upgraded to CI 3.0.6

#### Version 3.2.5
03/28/2016

* Upgraded to CI 3.0.5

#### Version 3.2.4
02/29/2016

* Security Updates
    + Limit login requests
    + Improved encryption key (you still should replace it with your own)
    + Set username and password lengths
* Added 'email' form input fields where applicable for better mobile support
* Added new 'schema\_updates' folder in the 'assets' folder - includes SQL for new 'login\_attempt' table

#### Version 3.2.3
01/20/2016

Thanks [klavatron](https://github.com/klavatron "klavatron") for your Russian translation.

* Upgraded to CI 3.0.4
* Included pull requests
    + Russian translation
* Fixed Issue #21 for locating translation folders on Windows (thanks [Everterstraat](https://github.com/Everterstraat "Everterstraat") for finding the source of the problem)

#### Version 3.2.2
12/23/2015

* Added configurable webroot in core.php config file

#### Version 3.2.1
12/22/2015

* Site owner-configurable settings now translatable (requires update to settings table)

#### Version 3.2.0
12/19/2015

* Added language selector
* Users are now assigned a language (requires update to users table)
* Setup English as a fall back when translated language files are missing

#### Version 3.1.7
12/17/2015

* Added pagination config file

#### Version 3.1.6
12/11/2015

Thanks [TowerX](https://github.com/TowerX "TowerX") for your Spanish translation.
Thanks [yinlianwei](https://github.com/yinlianwei "yinlianwei") for your Simplified Chinese translation.

* Included pull requests
    + Spanish translation
    + Simplified Chinese translation

#### Version 3.1.5
11/10/2015

* Moved CAPTCHA font, Bromine, to core theme folder

#### Version 3.1.4
11/09/2015

* Moved the base classes into their own files
* Added [Table of Contents](#toc) to README.md
* Added new section for [Settings](#settings) in README.md

#### Version 3.1.3
11/02/2015

* Upgraded to CI 3.0.3
    + Requires you to now set your base URL in config.php
* Upgraded jQuery to 1.11.3
* Upgraded Font Awesome to 4.4.0

#### Version 3.1.2
08/25/2015

Thanks [DeeJaVu](https://github.com/DeeJaVu "DeeJaVu") for your Turkish and Dutch translations.

* Included pull requests
    + Turkish translation
    + Dutch translation
* Upgraded to CI 3.0.1

#### Version 3.1.1
06/16/2015

Thanks [arif-rh](https://github.com/arif-rh "Arif RH") and [simogeo](https://github.com/simogeo "Simon Georget")
for your contributions.

* Included pull requests
    + Added base\_url to links
    + Improved theme functions
    + Indonesian translation
    + Repeat Password error fix
* Fixed email validation check during account registration
* Links to this Github page in theme footers

#### Version 3.1.0
04/15/2015

* Upgraded to CI 3.0.0

#### Version 3.0.5
03/11/2015

* Upgraded to CI 3.0rc3

#### Version 3.0.4
02/17/2015

* Upgraded to CI 3.0rc2

#### Version 3.0.3
01/31/2015

* Added missing glyphicon halfling fonts
* Added favicon transparency
* Fixed favicon bug in main template files

#### Version 3.0.2
01/31/2015

* Updated site name in footers

#### Version 3.0.1
01/31/2015

* Upgraded to CI 3.0rc

#### Version 3.0.0
01/31/2015

* Started as a whole new repository (retiring former repo)
* Upgraded to CI 3.0dev
* Stripped out HMVC pattern
* Removed database navigation
* Replaced TinyMCE with Summernote WYSIWYG editor
* Lots of code cleanup and other improvements

#### Version 2.0.0
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

#### Version 1.0.1
10/10/2013

* Removed admin template includes
* Made login more secure using salt
* Modified users table to handle the login change
    + password field is now char(128)
    + added salt field char(128)

#### Version 1.0.0
10/08/2013

* Initial version

<a name="forkit"></a>
## FORK IT!

**Please [fork CI3 Fire Starter on Github](https://github.com/JasonBaier/ci3-fire-starter/fork "Fork It")
and help make it better!**
