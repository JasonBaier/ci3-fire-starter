<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Cron Class
 */
class Cron_Controller extends MY_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // block direct browser access in production environments
        if ( ! $this->input->is_cli_request() && ENVIRONMENT == 'production')
        {
            show_error(lang('core error direct_access_forbidden'));
        }
    }

}
