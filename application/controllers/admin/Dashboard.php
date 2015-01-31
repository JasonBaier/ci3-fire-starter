<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language files
        $this->lang->load('dashboard');
    }


    /**
     * Dashboard
     */
    function index()
    {
        // setup page header data
        $this->includes = array_merge_recursive($this->includes, array(
            'page_title'    => lang('admin title admin'),
            'js_files_i18n' => array(
                $this->jsi18n->translate("/themes/admin/js/dashboard_i18n.js")
            )
        ));
        $data = $this->includes;

        // load views
        $data['content'] = $this->load->view('admin/dashboard', NULL, TRUE);
        $this->load->view($this->template, $data);
    }

}
