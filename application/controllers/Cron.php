<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * You can run crons from the command line without using wget or cURL. You simply
 * need to specify the direct path to the application.
 *
 * After creating your methods below, edit your crontab from the comman line using:
 *
 *      sudo crontab -e
 *
 * If you prefer using Nano, use:
 *
 *      sudo env EDITOR=nano crontab -e
 *
 * Then enter your command. This will run the 'demo' method at 10am every day:
 *
 *      0 10 * * * php /[APPLICATION PATH]/index.php cron demo
 *
 * For more information, check out this article:
 *
 *      https://glennstovall.com/writing-cron-job-in-codeigniter/
 *
 */

class Cron extends Cron_Controller {

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
        echo lang('core error direct_access_forbidden') . PHP_EOL;
    }


    /**
     * Demo
     *
     * php /[APPLICATION PATH]/index.php cron demo
     */
    function demo()
    {
        echo "Howdy from the Cron!" . PHP_EOL;
    }

}
