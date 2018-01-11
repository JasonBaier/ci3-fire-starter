<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        // set content data
        $data = array();

        // load views
        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view('sitemap', $data);
    }

}
