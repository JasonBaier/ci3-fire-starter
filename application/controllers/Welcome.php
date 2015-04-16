<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Public_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }


    /**
	 * Default
     */
	function index()
	{
        // setup page header data
        $this->set_title( sprintf(lang('core title welcome'), $this->settings->site_name) );
 
        $data = $this->includes;

        // set content data
        $content_data = array(
            'welcome_message' => $this->settings->welcome_message
        );

        // load views
        $data['content'] = $this->load->view('welcome', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}

}
