<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Public_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the users model
        $this->load->model('users_model');

        // load the users language file
        $this->lang->load('users');
    }


    /**************************************************************************************
     * PUBLIC FUNCTIONS
     **************************************************************************************/


    /**
     * Default
     */
    function index() {}


    /**
     * Validate login credentials
     */
    function login()
    {
        if ($this->session->userdata('logged_in'))
        {
            $logged_in_user = $this->session->userdata('logged_in');
            if ($logged_in_user['is_admin'])
            {
                redirect('admin');
            }
            else
            {
                redirect(base_url());
            }
        }

        // set form validation rules
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('username', lang('users input username_email'), 'required|trim|max_length[256]');
        $this->form_validation->set_rules('password', lang('users input password'), 'required|trim|max_length[72]|callback__check_login');

        if ($this->form_validation->run() == TRUE)
        {
            if ($this->session->userdata('redirect'))
            {
                // redirect to desired page
                $redirect = $this->session->userdata('redirect');
                $this->session->unset_userdata('redirect');
                redirect($redirect);
            }
            else
            {
                $logged_in_user = $this->session->userdata('logged_in');
                if ($logged_in_user['is_admin'])
                {
                    // redirect to admin dashboard
                    redirect('admin');
                }
                else
                {
                    // redirect to landing page
                    redirect(base_url());
                }
            }
        }

        // setup page header data
        $this->set_title(lang('users title login'));

		$this->add_css_theme('login.css');

        $data = $this->includes;

        // load views
        $data['content'] = $this->load->view('user/login', NULL, TRUE);
        $this->load->view($this->template, $data);
    }


    /**
     * Logout
     */
    function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('login');
    }


    /**
     * Registration Form
     */
    function register()
    {
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('username', lang('users input username'), 'required|trim|min_length[5]|max_length[30]|callback__check_username');
        $this->form_validation->set_rules('first_name', lang('users input first_name'), 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('last_name', lang('users input last_name'), 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('email', lang('users input email'), 'required|trim|max_length[256]|valid_email|callback__check_email');
        $this->form_validation->set_rules('language', lang('users input language'), 'required|trim');
        $this->form_validation->set_rules('password', lang('users input password'), 'required|trim|min_length[5]');
        $this->form_validation->set_rules('password_repeat', lang('users input password_repeat'), 'required|trim|matches[password]');

        if ($this->form_validation->run() == TRUE)
        {
            // save the changes
            $validation_code = $this->users_model->create_profile($this->input->post());

            if ($validation_code)
            {
                // build the validation URL
                $encrypted_email = sha1($this->input->post('email', TRUE));
                $validation_url  = base_url('user/validate') . "?e={$encrypted_email}&c={$validation_code}";

                // build email
                $email_msg  = lang('core email start');
                $email_msg .= sprintf(lang('users msg email_new_account'), $this->settings->site_name, $validation_url, $validation_url);
                $email_msg .= lang('core email end');

                // send email
                $this->load->library('email');
                $config['protocol'] = 'sendmail';
                $config['mailpath'] = '/usr/sbin/sendmail -f' . $this->settings->site_email;
                $this->email->initialize($config);
                $this->email->clear();
                $this->email->from($this->settings->site_email, $this->settings->site_name);
                $this->email->reply_to($this->settings->site_email, $this->settings->site_name);
                $this->email->to($this->input->post('email', TRUE));
                $this->email->subject(sprintf(lang('users msg email_new_account_title'), $this->input->post('first_name', TRUE)));
                $this->email->message($email_msg);
                $this->email->send();
                #echo $this->email->print_debugger();

                $this->session->language = $this->input->post('language');
                $this->lang->load('users', $this->user['language']);
                $this->session->set_flashdata('message', sprintf(lang('users msg register_success'), $this->input->post('first_name', TRUE)));
            }
            else
            {
                $this->session->set_flashdata('error', lang('users error register_failed'));
                redirect($_SERVER['REQUEST_URI'], 'refresh');
            }

            // redirect home and display message
            redirect(base_url());
        }

        // setup page header data
        $this->set_title( lang('users title register') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => base_url(),
            'user'              => NULL,
            'password_required' => TRUE
        );

        // load views
        $data['content'] = $this->load->view('user/profile_form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    /**
     * Validate new account
     */
    function validate()
    {
        // get codes
        $encrypted_email = $this->input->get('e');
        $validation_code = $this->input->get('c');

        // validate account
        $validated = $this->users_model->validate_account($encrypted_email, $validation_code);

        if ($validated)
        {
            $this->session->set_flashdata('message', lang('users msg validate_success'));
        }
        else
        {
            $this->session->set_flashdata('error', lang('users error validate_failed'));
        }

        redirect(base_url());
    }


    /**
	 * Forgot password
     */
	function forgot()
	{
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('email', lang('users input email'), 'required|trim|max_length[256]|valid_email|callback__check_email_exists');

        if ($this->form_validation->run() == TRUE)
        {
            // save the changes
            $results = $this->users_model->reset_password($this->input->post());

            if ($results)
            {
                // build email
                $reset_url  = base_url('login');
                $email_msg  = lang('core email start');
                $email_msg .= sprintf(lang('users msg email_password_reset'), $this->settings->site_name, $results['new_password'], $reset_url, $reset_url);
                $email_msg .= lang('core email end');

                // send email
                $this->load->library('email');
                $config['protocol'] = 'sendmail';
                $config['mailpath'] = '/usr/sbin/sendmail -f' . $this->settings->site_email;
                $this->email->initialize($config);
                $this->email->clear();
                $this->email->from($this->settings->site_email, $this->settings->site_name);
                $this->email->reply_to($this->settings->site_email, $this->settings->site_name);
                $this->email->to($this->input->post('email', TRUE));
                $this->email->subject(sprintf(lang('users msg email_password_reset_title'), $results['first_name']));
                $this->email->message($email_msg);
                $this->email->send();
                #echo $this->email->print_debugger();

                $this->session->set_flashdata('message', sprintf(lang('users msg password_reset_success'), $results['first_name']));
            }
            else
            {
                $this->session->set_flashdata('error', lang('users error password_reset_failed'));
            }

            // redirect home and display message
            redirect(base_url());
        }

        // setup page header data
        $this->set_title( lang('users title forgot') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url' => base_url(),
            'user'       => NULL
        );

        // load views
        $data['content'] = $this->load->view('user/forgot_form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    /**************************************************************************************
     * PRIVATE VALIDATION CALLBACK FUNCTIONS
     **************************************************************************************/


    /**
     * Verify the login credentials
     *
     * @param  string $password
     * @return boolean
     */
    function _check_login($password)
    {
        // limit number of login attempts
        $ok_to_login = $this->users_model->login_attempts();

        if ($ok_to_login)
        {
            $login = $this->users_model->login($this->input->post('username', TRUE), $password);

            if ($login)
            {
                $this->session->set_userdata('logged_in', $login);
                return TRUE;
            }

            $this->form_validation->set_message('_check_login', lang('users error invalid_login'));
            return FALSE;
        }

        $this->form_validation->set_message('_check_login', sprintf(lang('users error too_many_login_attempts'), $this->config->item('login_max_time')));
        return FALSE;
    }


    /**
     * Make sure username is available
     *
     * @param  string $username
     * @return int|boolean
     */
    function _check_username($username)
    {
        if ($this->users_model->username_exists($username))
        {
            $this->form_validation->set_message('_check_username', sprintf(lang('users error username_exists'), $username));
            return FALSE;
        }
        else
        {
            return $username;
        }
    }


    /**
     * Make sure email is available
     *
     * @param  string $email
     * @return int|boolean
     */
    function _check_email($email)
    {
        if ($this->users_model->email_exists($email))
        {
            $this->form_validation->set_message('_check_email', sprintf(lang('users error email_exists'), $email));
            return FALSE;
        }
        else
        {
            return $email;
        }
    }


    /**
     * Make sure email exists
     *
     * @param  string $email
     * @return int|boolean
     */
    function _check_email_exists($email)
    {
        if ( ! $this->users_model->email_exists($email))
        {
            $this->form_validation->set_message('_check_email_exists', sprintf(lang('users error email_not_exists'), $email));
            return FALSE;
        }
        else
        {
            return $email;
        }
    }

}
