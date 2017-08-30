<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends Public_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // disable the profiler
        $this->output->enable_profiler(FALSE);
    }


    /**
     * Custom 404 page
     */
    function error404()
    {
        // setup page header data
        $this->set_title(lang('core error page_not_found'));

        $data = $this->includes;

        // load views
        $data['content'] = $this->load->view("errors/error_404", NULL, TRUE);
        $this->load->view($this->template, $data);
    }

}
