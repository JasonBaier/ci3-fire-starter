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
        $this->includes = array_merge_recursive($this->includes, array(
            'css_files'     => array(
                "/themes/{$this->settings->theme}/css/{$this->settings->theme}.css"
            ),
            'js_files_i18n' => array(
                $this->jsi18n->translate("/themes/{$this->settings->theme}/js/{$this->settings->theme}_i18n.js")
            )
        ));

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
        $this->includes = array_merge_recursive($this->includes, array(
            'css_files'     => array(
                "/themes/{$this->settings->theme}/css/{$this->settings->theme}.css"
            ),
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
        $this->includes = array_merge_recursive($this->includes, array(
            'css_files'     => array(
                "/themes/{$this->settings->theme}/css/{$this->settings->theme}.css",
                "/themes/{$this->settings->theme}/css/summernote-bs3.css"
            ),
            'js_files'      => array(
                "/themes/{$this->settings->theme}/js/summernote.min.js"
            ),
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
