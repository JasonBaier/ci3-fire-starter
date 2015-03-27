<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	/**
     * Common data
     */
    public $user;
    public $settings;
    public $includes;
    public $current_uri;
    public $theme;
    public $template;
    public $error;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // get settings
        $settings = $this->settings_model->get_settings();
        $this->settings = new stdClass();
        foreach ($settings as $setting)
        {
            $this->settings->{$setting['name']} = $setting['value'];
        }
        $this->settings->site_version = $this->config->item('site_version');

        // get current uri
        $this->current_uri = "/" . uri_string();

        // set global header data - can be merged with or overwritten in controllers
        $this->includes = array(
            'css_files'     => array(
                "//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css",
                "//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css",
                "//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css",
                "/themes/core/css/core.css"
            ),
            'js_files'      => array(
                "//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js",
                "//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"
            ),
            'js_files_i18n' => array(
                $this->jsi18n->translate("/themes/core/js/core_i18n.js")
            )
        );

        // set the time zone
        $timezones = $this->config->item('timezones');
        date_default_timezone_set($timezones[$this->settings->timezones]);

        // get current user
        $this->user = $this->session->userdata('logged_in');

        // enable the profiler?
        $this->output->enable_profiler($this->config->item('profiler'));
    }
	
	// --------------------------------------------------------------------

	/**
	 * Add CSS from Active Theme Folder
	 *
	 * This function used to easily add css files to be included in a template.
	 * with this function, we can just add css name as parameter 
	 * and it will use default css path in active theme.
	 *
	 * We can add one or more css files as parameter, either as string or array.
	 * If using parameter as string, it must use comma separator between css file name.
	 * -----------------------------------
	 * Example:
	 * -----------------------------------
	 * 1. Using string as parameter
	 *     $this->add_css_theme( "bootstrap.min.css, style.css, admin.css" );
	 *
	 * 2. Using array as parameter
	 *     $this->add_css_theme( array( "bootstrap.min.css", "style.css", "admin.css" ) );
	 *
	 * --------------------------------------
	 * @author	Arif Rahman Hakim
	 * @access	public
	 * @param	mixed
	 */
	 
	function add_css_theme( $css_files )
	{
		// make sure that $this->includes has array value
		if ( ! is_array( $this->includes ) )
			$this->includes = array();
		
		// if $css_files is string, then convert into array
		$css_files = is_array( $css_files ) ? $css_files : explode( ",", $css_files );
		
		foreach( $css_files as $css )
		{
			// using sha1( $css ) as a key to prevent duplicate css to be included
			$this->includes[ 'css_files' ][ sha1( $css ) ] = base_url( "/themes/{$this->settings->theme}/css" ) . "/{$css}";
		}

		return $this;
	}

	/**
	 * Add JS from Active Theme Folder
	 *
	 * This function used to easily add js files to be included in a template.
	 * with this function, we can just add js name as parameter 
	 * and it will use default js path in active theme.
	 *
	 * We can add one or more js files as parameter, either as string or array.
	 * If using parameter as string, it must use comma separator between js file name.
	 * -----------------------------------
	 * Example:
	 * -----------------------------------
	 * 1. Using string as parameter
	 *     $this->add_js_theme( "jquery-1.11.1.min.js, bootstrap.min.js, another.js" );
	 *
	 * 2. Using array as parameter
	 *     $this->add_js_theme( array( "jquery-1.11.1.min.js", "bootstrap.min.js,", "another.js" ) );
	 *
	 * --------------------------------------
	 * @author	Arif Rahman Hakim
	 * @access	public
	 * @param	mixed
	 */
	 
	function add_js_theme( $js_files )
	{
		// make sure that $this->includes has array value
		if ( ! is_array( $this->includes ) )
			$this->includes = array();
		
		// if $css_files is string, then convert into array
		$js_files = is_array( $js_files ) ? $js_files : explode( ",", $js_files );
		
		foreach( $js_files as $js )
		{
			// using sha1( $css ) as a key to prevent duplicate css to be included
			$this->includes[ 'js_files' ][ sha1( $js ) ] = base_url( "/themes/{$this->settings->theme}/js" ) . "/{$js}";
		}

		return $this;
	}
	
}


/**
 * Base Public Class - used for all public pages
 */
class Public_Controller extends MY_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // prepare theme name
        $this->settings->theme = strtolower($this->config->item('public_theme'));

        // set up global header data
		$this->add_css_theme( "{$this->settings->theme}.css" );

        $this->includes = array_merge_recursive($this->includes, array(
            'js_files_i18n' => array(
                $this->jsi18n->translate("/themes/{$this->settings->theme}/js/{$this->settings->theme}_i18n.js")
            )
        ));
;
        // declare main template
        $this->template = "../../htdocs/themes/{$this->settings->theme}/template.php";
    }

}


/**
 * Base Private Class - used for all private pages
 */
class Private_Controller extends MY_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // must be logged in
        if ( ! $this->user)
        {
            if (current_url() != base_url())
            {
                // store requested URL to session - will load once logged in
                $data = array('redirect' => current_url());
                $this->session->set_userdata($data);
            }

            redirect('login');
        }

        // prepare theme name
        $this->settings->theme = strtolower($this->config->item('public_theme'));

        // set up global header data
		$this->add_css_theme( "{$this->settings->theme}.css" );
		
        $this->includes = array_merge_recursive($this->includes, array(
            'js_files_i18n' => array(
                $this->jsi18n->translate("/themes/{$this->settings->theme}/js/{$this->settings->theme}_i18n.js")
            )
        ));

        // declare main template
        $this->template = "../../htdocs/themes/{$this->settings->theme}/template.php";
    }

}


/**
 * Base Admin Class - used for all administration pages
 */
class Admin_Controller extends MY_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // must be logged in
        if ( ! $this->user)
        {
            if (current_url() != base_url())
            {
                //store requested URL to session - will load once logged in
                $data = array('redirect' => current_url());
                $this->session->set_userdata($data);
            }

            redirect('login');
        }

        // make sure this user is setup as admin
        if ( ! $this->user['is_admin'])
        {
            redirect(base_url());
        }

        // load the admin language file
        $this->lang->load('admin');

        // prepare theme name
        $this->settings->theme = strtolower($this->config->item('admin_theme'));

        // set up global header data
		$this->add_css_theme( "{$this->settings->theme}.css,summernote-bs3.css" );
		$this->add_js_theme( "summernote.min.js" );
		
        $this->includes = array_merge_recursive($this->includes, array(
            'js_files_i18n' => array(
                $this->jsi18n->translate("/themes/{$this->settings->theme}/js/{$this->settings->theme}_i18n.js")
            )
        ));

        // declare main template
        $this->template = "../../htdocs/themes/{$this->settings->theme}/template.php";
    }

}


/**
 * Base API Class - used for all API calls
 */
class API_Controller extends MY_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

}
