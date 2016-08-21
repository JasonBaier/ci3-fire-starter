<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Admin_Controller {

    /**
     * @var string
     */
    private $_redirect_url;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language files
        $this->lang->load('finance');

        // load the finance model
        $this->load->model('reports_model');
		// $this->load->model('users_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/finance'));
        define('DEFAULT_LIMIT', $this->settings->per_page_limit);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "id");
        define('DEFAULT_DIR', "desc");

        // use the url in session (if available) to return to the previous filter/sorted/paginated list
        if ($this->session->userdata(REFERRER))
        {
            $this->_redirect_url = $this->session->userdata(REFERRER);
        }
        else
        {
            $this->_redirect_url = THIS_URL;
        }
    }


    /**************************************************************************************
     * PUBLIC FUNCTIONS
     **************************************************************************************/


    /**
     * Records list page
     */
    function index()
    {
        // get parameters
        $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
        $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
        $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
        $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;

		
        // get filters
        $filters = array();

        if ($this->input->get('title'))
        {
            $filters['title'] = $this->input->get('title', TRUE);
        }

        if ($this->input->get('category'))
        {
            $filters['category'] = $this->input->get('category', TRUE);
        }

        if ($this->input->get('description'))
        {
            $filters['description'] = $this->input->get('description', TRUE);
        }
		
		if ($this->input->get('assigned_user'))
                {
                    $filters['assigned_user'] = $this->input->get('assigned_user', TRUE);
                }

        // build filter string
        $filter = "";
        foreach ($filters as $key => $value)
        {
            $filter .= "&{$key}={$value}";
        }

        // save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");

        // are filters being submitted?
        if ($this->input->post())
        {
            if ($this->input->post('clear'))
            {
                // reset button clicked
                redirect(THIS_URL);
            }
            else
            {
                // apply the filter(s)
                $filter = "";

                if ($this->input->post('title'))
                {
                    $filter .= "&title=" . $this->input->post('title', TRUE);
                }

                if ($this->input->post('category'))
                {
                    $filter .= "&category=" . $this->input->post('category', TRUE);
                }

                if ($this->input->post('description'))
                {
                    $filter .= "&description=" . $this->input->post('description', TRUE);
                }
				
				if ($this->input->post('assigned_user'))
                {
                    $filter .= "&assigned_user=" . $this->input->post('assigned_user', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
        }

        // get list
        $finances = $this->reports_model->get_all($limit, $offset, $filters, $sort, $dir);

        // build pagination
        $this->pagination->initialize(array(
            'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
            'total_rows' => $finances['total'],
            'per_page'   => $limit
        ));

        // setup page header data
		$this
			->add_js_theme( "users_i18n.js", TRUE )
			->set_title( lang('finance title finance_list') );

        $data = $this->includes;

        // set content data
        $content_data = array(
			'user_list'					=> $this->reports_model->get_userlist(),
			'category_name'					=> $this->reports_model->get_categories(),
			'category_list'					=> $this->reports_model->get_categories_list(),
			'vendor_list'					=> $this->reports_model->get_vendor(),
			'username_list'					=> $this->reports_model->get_userslist(),
            'this_url'   => THIS_URL,
            'finances'      => $finances['results'],
            'total'      => $finances['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );
		
		
        // load views
        $data['content'] = $this->load->view('admin/finance/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    /**
     * Add new record
     */
    function add()
    {
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('title', lang('users input title'), 'required|trim|min_length[5]|max_length[60]');
        $this->form_validation->set_rules('description', lang('users input description'), 'required|trim|min_length[2]|max_length[1000]');
        $this->form_validation->set_rules('costprice', lang('users input costprice'),'required|numeric|min_length[1]');
		
		if ($this->form_validation->run() == TRUE)
        {
         
		 $config =  array(
                  'upload_path'     => './uploads/',
                 'allowed_types'   => "gif|jpg|png|jpeg|pdf|doc|xml",
                  'overwrite'       => TRUE,
                  'remove_spaces'       => TRUE,
                  'max_size'        => "10000KB",  
                  'file_ext_tolower'        => "TRUE",  
                );
			
			$this->load->library('upload', $config);
			
			$this->upload->do_upload('userfile');
			
			$userfile = $this->upload->data('file_name'); 
			$file = $this->upload->data('raw_name');
			$fileExt = $this->upload->data('file_ext');
			$filepath = $this->upload->data('file_path');
						
			$saved = $this->reports_model->add_record($this->input->post(), $file, $fileExt, $filepath);
  
			
            if ($saved)
            {
                $this->session->set_flashdata('message', sprintf(lang('finance msg add_record_success'), $this->input->post('category') . " " . $this->input->post('description')));
            }
            else
            {
                $this->session->set_flashdata('error', sprintf(lang('finance error add_record_failed'), $this->input->post('category') . " " . $this->input->post('description')));
            }

            // return to list and display message
            redirect($this->_redirect_url);
        }

        // setup page header data
        $this->set_title( lang('finance title finance_add') );

        $data = $this->includes;
	
        // set content data
        $content_data = array(
			'cancel_url'        => $this->_redirect_url,
			'category_list'					=> $this->reports_model->get_categories(),
			'vendor_list'					=> $this->reports_model->get_vendor(),
			'users_list'					=> $this->reports_model->get_userlist(),
			'fiscal_list'					=> $this->reports_model->get_fiscallist(),
            'user'              => NULL,
            'password_required' => TRUE
        );
		
						
        // load views
        $data['content'] = $this->load->view('admin/finance/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    /**
     * Edit existing user
     *
     * @param  int $id
     */
    function edit($id = NULL)
    {
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect($this->_redirect_url);
        }

        // get the data
        $finance = $this->reports_model->get_record($id);

        // if empty results, return to list
        if ( ! $finance)
        {
            redirect($this->_redirect_url);
        }

        // validators	
		$this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('title', lang('users input title'), 'required|trim|min_length[5]|max_length[60]');
        $this->form_validation->set_rules('description', lang('users input description'), 'required|trim|min_length[2]|max_length[1000]');
        $this->form_validation->set_rules('costprice', lang('users input costprice'),'required|numeric|min_length[1]');

        if ($this->form_validation->run() == TRUE)
        {
            
			$config =  array(
                  'upload_path'     => './uploads/',
                 'allowed_types'   => "gif|jpg|png|jpeg|pdf|doc|xml",
                  'overwrite'       => TRUE,
                  'remove_spaces'       => TRUE,
                  'max_size'        => "10000KB",  
                  'file_ext_tolower'        => "TRUE",  
                );
			
			$this->load->library('upload', $config);
			$this->upload->do_upload('userfile');
			 
			$userfile = $this->upload->data('file_name'); 
			
			$file = $this->upload->data('raw_name');
			$fileExt = $this->upload->data('file_ext');
			$filepath = $this->upload->data('file_path');
			
			// save the changes
            $saved = $this->reports_model->edit_record($this->input->post(), $file, $fileExt, $filepath);

            if ($saved)
            {
                $this->session->set_flashdata('message', sprintf(lang('users msg edit_user_success'), $this->input->post('category') . " " . $this->input->post('description')));
            }
            else
            {
                $this->session->set_flashdata('error', sprintf(lang('users error edit_user_failed'), $this->input->post('category') . " " . $this->input->post('description')));
            }

            // return to list and display message
            redirect($this->_redirect_url);
        }

		$finance = $this->reports_model->get_record($id);
        // setup page header data
        $this->set_title( lang('finance title finance_edit') );

        $data = $this->includes;
		
        // set content data
        $content_data = array(
            'cancel_url'        => $this->_redirect_url,
			'category_list'					=> $this->reports_model->get_categories(),
			'vendor_list'					=> $this->reports_model->get_vendor(),
			'users_list'					=> $this->reports_model->get_userlist(),
			'fiscal_list'					=> $this->reports_model->get_fiscallist(),
			'site_email_cc'					=> $this->settings->efs_email, 
			'delete_after_upload'					=> $this->settings->delete_after_upload, 
			'site_email_subject'					=> 'R'.$finance["id"].' - Title:'.$finance['title'].', Filename:'.$finance["filename"].', Category:'.$finance['category'].', Vendor:'.$finance['vendor'].', Updated:' . date('Y-m-d H:i:s'), 
			'site_email_to'					=> $this->reports_model->get_email($finance['assigned_user']), 
            'finance'              => $finance,
            'user_id'           => $id,
            'password_required' => FALSE
        );

        // load views
        $data['content'] = $this->load->view('admin/finance/form', $content_data, TRUE);
        $this->load->helper('url');
		$this->load->view($this->template, $data);
    }


    /**
     * Delete a user
     *
     * @param  int $id
     */
    function delete($id = NULL)
    {
        // make sure we have a numeric id
        if ( ! is_null($id) OR ! is_numeric($id))
        {
            // get user details
            $finance = $this->reports_model->get_record($id);

            if ($finance)
            {
                // soft-delete the user
                $delete = $this->reports_model->delete_record($id);

                if ($delete)
                {
                    $this->session->set_flashdata('message', sprintf(lang('users msg delete_user'), $finance['category'] . " " . $finance['description']));
                }
                else
                {
                    $this->session->set_flashdata('error', sprintf(lang('users error delete_user'), $finance['category'] . " " . $finance['description']));
                }
            }
            else
            {
                $this->session->set_flashdata('error', lang('users error user_not_exist'));
            }
        }
        else
        {
            $this->session->set_flashdata('error', lang('users error user_id_required'));
        }

        // return to list and display message
        redirect($this->_redirect_url);
    }
	
    /**
     * Delete a catven
     *
     * @param  int $id
     */
    function delete_catven($id = NULL)
    {
        // make sure we have a numeric id
        if ( ! is_null($id) OR ! is_numeric($id))
        {
            // get catdetails details
            $finance = $this->reports_model->get_catven_record($id);

            if ($finance)
            {
                // soft-delete the user
                $delete = $this->reports_model->delete_catven($id);

                if ($delete)
                {
                    $this->session->set_flashdata('message', sprintf(lang('users msg delete_user'), $finance['category'] . " " . $finance['description']));
                }
                else
                {
                    $this->session->set_flashdata('error', sprintf(lang('users error delete_user'), $finance['category'] . " " . $finance['description']));
                }
            }
            else
            {
                $this->session->set_flashdata('error', lang('users error user_not_exist'));
            }
        }
        else
        {
            $this->session->set_flashdata('error', lang('users error user_id_required'));
        }

        // return to list and display message
        redirect($this->_redirect_url);
    }

    /**
     * Export list to CSV
     */
    function export()
    {
        // get parameters
        $sort = $this->input->get('sort') ? $this->input->get('sort', TRUE) : DEFAULT_SORT;
        $dir  = $this->input->get('dir')  ? $this->input->get('dir', TRUE)  : DEFAULT_DIR;

        // get filters
        $filters = array();

        if ($this->input->get('title'))
        {
            $filters['title'] = $this->input->get('title', TRUE);
        }

        if ($this->input->get('category'))
        {
            $filters['category'] = $this->input->get('category', TRUE);
        }

        if ($this->input->get('description'))
        {
            $filters['description'] = $this->input->get('description', TRUE);
        }

        // get all users
        $finances = $this->reports_model->get_all(0, 0, $filters, $sort, $dir);

        if ($finances['total'] > 0)
        {
            // manipulate the output array
            foreach ($finances['results'] as $key=>$finance)
            {
                unset($finances['results'][$key]['password']);
                unset($finances['results'][$key]['deleted']);

                if ($finance['value'] == 0)
                {
                    $finances['results'][$key]['value'] = lang('admin input inactive');
                }
                else
                {
                    $finances['results'][$key]['value'] = lang('admin input active');
                }
            }

            // export the file
            array_to_csv($finances['results'], "users");
        }
        else
        {
            // nothing to export
            $this->session->set_flashdata('error', lang('core error no_results'));
            redirect($this->_redirect_url);
        }

        exit;
    }
	
    /**
     * List and display categories and vendors. 
     */
    function manage()
    {
		
		       // get parameters
        $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
        $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
        $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
        $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;

        // get filters
        $filters = array();

        if ($this->input->get('categories'))
        {
            $filters['categories'] = $this->input->get('categories', TRUE);
        }

        if ($this->input->get('locked'))
        {
            $filters['locked'] = $this->input->get('locked', TRUE);
        }

        // build filter string
        $filter = "";
        foreach ($filters as $key => $value)
        {
            $filter .= "&{$key}={$value}";
        }

        // save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "/manage?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");

        // are filters being submitted?
        if ($this->input->post())
        {
            if ($this->input->post('clear'))
            {
                // reset button clicked
                redirect(THIS_URL);
            }
            else
            {
                // apply the filter(s)
                $filter = "";

                if ($this->input->post('categories'))
                {
                    $filter .= "&categories=" . $this->input->post('categories', TRUE);
                }

                if ($this->input->post('locked'))
                {
                    $filter .= "&locked=" . $this->input->post('locked', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "/manage?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
        }

        // get list
        $finances = $this->reports_model->get_catvenall($limit, $offset, $filters, $sort, $dir);

        // build pagination
        $this->pagination->initialize(array(
            'base_url'   => THIS_URL . "/manage?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
            'total_rows' => $finances['total'],
            'per_page'   => $limit
        ));

        // setup page header data
		$this
			->add_js_theme( "users_i18n.js", TRUE )
			->set_title( lang('finance title manage_list') );

        $data = $this->includes;

        // set content data
        $content_data = array(
			'category_list'					=> $this->reports_model->get_categories_list(),
			'all_assets'					=> $this->reports_model->get_assets(),
			'vendor_list'					=> $this->reports_model->get_vendor(),
			'category_names'					=> $this->reports_model->get_category_name(),
			'users_list'					=> $this->reports_model->get_userlist(),
            'this_url'   => THIS_URL,
            'finances'      => $finances['results'],
            'total'      => $finances['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );
		
		
        // load views
        $data['content'] = $this->load->view('admin/finance/manage', $content_data, TRUE);
        $this->load->view($this->template, $data); 
		
	}
	
	    /**
     * Edit existing categories/vendors
     *
     * @param  int $id
     */
    function manage_form($id = NULL)
    {
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect($this->_redirect_url);
        }

        // get the data
        $finance = $this->reports_model->get_catven_record($id);

        // if empty results, return to list
        if ( ! $finance)
        {
            redirect($this->_redirect_url);
        }

        // validators		
		$this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('categories', lang('finance input category_new'), 'required|trim|min_length[3]|max_length[60]');

        if ($this->form_validation->run() == TRUE)
        {
            
            $saved = $this->reports_model->edit_catven($this->input->post());

            if ($saved)
            {
                $this->session->set_flashdata('message', sprintf(lang('finance msg edit_category_success'), $this->input->post('categories') . "."));
            }
            else
            {
                $this->session->set_flashdata('error', sprintf(lang('finance error edit_finance_failed'), $this->input->post('category') . " " . $this->input->post('description')));
            }

            // return to list and display message
            redirect($this->_redirect_url);
        }

        // setup page header data
        $this->set_title( lang('finance title manage') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => $this->_redirect_url,
            'finances'              => $finance,
            'user_id'           => $id,
            'password_required' => FALSE
        );

        // load views
        $data['content'] = $this->load->view('admin/finance/form_manage', $content_data, TRUE);
        $this->load->helper('url');
		$this->load->view($this->template, $data);
    }

    /**
     * Add new vendor / supplier / category
     */
    function catven()
    {
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('categories', lang('finance input category_new'), 'required|trim|min_length[3]|max_length[60]');
		

        if ($this->form_validation->run() == TRUE)
        {
         
		 	$saved = $this->reports_model->add_catven($this->input->post());
  
			
            if ($saved)
            {
                $this->session->set_flashdata('message', sprintf(lang('finance msg add_record_success'), $this->input->post('category') . " " . $this->input->post('description')));
            }
            else
            {
                $this->session->set_flashdata('error', sprintf(lang('finance error add_record_failed'), $this->input->post('category') . " " . $this->input->post('description')));
            }

            // return to list and display message
            redirect($this->_redirect_url);
        }

        // setup page header data
        $this->set_title( lang('finance title manage') );

        $data = $this->includes;
	
        // set content data
        $content_data = array(
			'cancel_url'        => $this->_redirect_url,
            'finance'              => NULL,
            'password_required' => TRUE
        );
		
						
        // load views
        $data['content'] = $this->load->view('admin/finance/form_manage', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
    /**************************************************************************************
     * PRIVATE VALIDATION CALLBACK FUNCTIONS
     **************************************************************************************/


    /**
     * Make sure email is available
     *
     * @param  string $email
     * @param  string|null $current
     * @return int|boolean
     */
    function _check_email($email, $current)
    {
        if (trim($email) != trim($current) && $this->reports_model->email_exists($email))
        {
            $this->form_validation->set_message('_check_email', sprintf(lang('users error email_exists'), $email));
            return FALSE;
        }
        else
        {
            return $email;
        }
    }
	
	function _check_username($username, $current)
    {
        if (trim($email) != trim($current) && $this->reports_model->email_exists($email))
        {
            $this->form_validation->set_message('_check_email', sprintf(lang('users error email_exists'), $email));
            return FALSE;
        }
        else
        {
            return $email;
        }
    }
	
	function showCategoryNames(){
    $data = array();
    $this->load->model('finance_model');
    $query = $this->reports_model->getAllCategories();
    if ($query)
    {
        $data['records'] = $query;

    }

    $this->load->view('itemsView',$data);

 } 

}
