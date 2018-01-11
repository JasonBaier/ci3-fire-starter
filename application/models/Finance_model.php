<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Finance_model extends CI_Model {

    /**
     * @vars
     */
    private $_db;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // define primary table
        $this->_db = 'records';
        $this->_ass = 'assets';
        $this->_users = 'users';
    }


    /**
     * Get list of non-deleted users
     *
     * @param  int $limit
     * @param  int $offset
     * @param  array $filters
     * @param  string $sort
     * @param  string $dir
     * @return array|boolean
     */
    function get_all($limit = 0, $offset = 0, $filters = array(), $sort = 'id', $dir = 'asc')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
            WHERE deleted = '0'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                  
                if ($key == 'category') {
                    
                $value = $this->db->escape('' . $value . '');
                $sql .= " AND {$key} LIKE {$value}";
                    
                } else { 
                
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
                
                }
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
	
    /**
     * Get list of non-deleted categories / vendors
     *
     * @param  int $limit
     * @param  int $offset
     * @param  array $filters
     * @param  string $sort
     * @param  string $dir
     * @return array|boolean
     */
    function get_catvenall($limit = 0, $offset = 0, $filters = array(), $sort = 'categories', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_ass}
            WHERE deleted = '0' 
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " and {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }


    /**
     * Get specific user
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_record($id = NULL)
    {
        if ($id)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
                WHERE id = " . $this->db->escape($id) . "
                    AND deleted = '0'
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }


    /**
     * Add a new record
     *
     * @param  array $data
     * @return mixed|boolean
     */
    function add_record($data = array(), $userfile, $fileExt, $filepath)
    {
        if ($data)
        {
			
			// INSERT INTO `records` (`id`, `title`, `category`, `filename`, `description`, `assigned_user`, `value`, `deleted`, `created`, `updated`) VALUES (NULL, 'BigW - Logitech USB Mouse and Mouse Pad', 'Work Expenses', '160705_BigW_Logitech_USB_Mouse_and_Mouse_Pad', 'Logitech USB Mouse and Pads used one handfed typing. ', '', '1', '0', '', '');
		
            $sql = "INSERT INTO {$this->_db} (
					title,
					category,
					vendor,
                    filename,
                    description,
                    assigned_user,
                    value,
                    fiscal_yr,
                    deleted,
                    created,
                    updated
                ) VALUES (  
				" . $this->db->escape($data['title']) . ",
				" . $this->db->escape($data['category_id']) . ",
				" . $this->db->escape($data['vendor_id']) . ",
				'" . $userfile . "',
				" . $this->db->escape($data['description']) . ",
				" . $this->db->escape($data['username_id']) . ",
				" . $this->db->escape($data['costprice']) . ",
				" . $this->db->escape($data['fiscal_y']) . ",
				'0',
				'" . date('Y-m-d H:i:s') . "',
                '" . date('Y-m-d H:i:s') . "')
			";

			$usernameID = $data['username_id'];
	        $this->db->query($sql);
			$id = $this->db->insert_id();
			
			$DocTitle = ucwords($data['title']); 
			$DocTitle = str_replace(' ', '_', $DocTitle); 
								
			$realFileName = $id.'_'.$DocTitle.$fileExt;
			
			if(is_file("./uploads/".$userfile.$fileExt)) {
 
				rename($filepath.$userfile.$fileExt, $filepath.$realFileName);
				
		            $sql = "UPDATE {$this->_db} 
					SET filename='".$realFileName."'
					WHERE id=" . $id . ";";

            $this->db->query($sql);

			$this->email->attach("./uploads/".$realFileName);
				
			}
					 
			// $this->email->attach($upload_data['full_path']);
        // $this->email->initialize($config);	
	
	//$this->email->from($config['SITE_EMAIL'], $config['SITE_EMAIL_FROM']);
		$this->email->from($this->settings->efs_from, $this->settings->email_name_sender);
        
    $this->email->subject('R'.$id.' - Title:'.$data['title'].', Filename:'.$realFileName.', Category:'.$data['category_id'].', Vendor:'.$data['vendor_id'].', Updated:' . date('Y-m-d H:i:s'));
	
	$sqlUser = "SELECT * FROM users
                WHERE id='" . $usernameID . "'
                    AND deleted='0'
	
	";
	
    $query = $this->db->query($sqlUser);
    $assignedUser = $query->row();
	
	$sqlRecord = "SELECT * FROM assets
                WHERE id='" . $data['category_id'] . "'
                    AND deleted='0'
	";
	
    $query = $this->db->query($sqlRecord);
    $categoryDetails = $query->row_array();
	
	$sqlRecord = "SELECT * FROM assets
                WHERE id='" . $data['vendor_id'] . "'
                    AND deleted='0'
	";
	
    $query = $this->db->query($sqlRecord);
    $vendorDetails = $query->row_array();
	
	$sqlRecord = "SELECT * FROM assets
                WHERE id='" . $data['fiscal_y'] . "'
                    AND deleted='0'
	";
	
    $query = $this->db->query($sqlRecord);
    $fiscalDetails = $query->row_array();
	
	$emailMessage = "
Title:" . $data['title'] . ",
Cost: $" . $data['costprice'] . ",
Financial Yr: " . $fiscalDetails['categories'] . ",
Category:" . $categoryDetails['categories'] . ",
Vendor:" . $vendorDetails['categories'] . ",
Filename:" . $realFileName . ",
Description:" . $data['description'] . ",
Assigned User:" . $assignedUser->id .",
'0',
Created: " . date('Y-m-d H:i:s') . ",
Updated: " . date('Y-m-d H:i:s') . ""; 
	
	$this->email->to($assignedUser->email);
	$this->email->cc($this->settings->efs_email);
	
    $this->email->message($emailMessage);

    $this->email->send();	


	if ($this->settings->delete_after_upload == 1) {
	$this->deleteFiles("./uploads/");
	}
                return $id;
            			
        }

        return FALSE;
    }

    /**
     * Edit an existing user
     *
     * @param  array $data
     * @return boolean
     */
    function edit_record($data = array(), $userfile, $fileExt, $filepath)
    {
        if ($data)
        {
			
			/*
			
					title,
					category,
					vendor,
                    filename,
                    description,
                    assigned_user,
                    value,
                    deleted,
                    created,
                    updated
					
				" .  . ",
				'" . $userfile . "',
				" . $this->db->escape($data['description']) . ",
				" . $this->db->escape($data['username_id']) . ",
				" . $this->db->escape($data['costprice']) . ",
				'0',
				'" . date('Y-m-d H:i:s') . "',
                '" . date('Y-m-d H:i:s') . "')
			
			*/
			
			$sql = "
                UPDATE {$this->_db}
                SET
                    title = " . $this->db->escape($data['title']) . ",
                    category = " . $this->db->escape($data['category_id']) . ",
                    vendor = " . $this->db->escape($data['vendor_id']) . ",
                  description = " . $this->db->escape($data['description']) . ",
                    assigned_user = " . $this->db->escape($data['username_id']) . ",
                    value = " . $this->db->escape($data['costprice']) . ",
                    fiscal_yr = " . $this->db->escape($data['fiscal_y']) . ",
                    updated = '" . date('Y-m-d H:i:s') . "'
                WHERE id = " . $this->db->escape($data['id']) . "
                    AND deleted = '0'
            ";

			$usernameID = $data['username_id'];
            $this->db->query($sql);
			$id = $data['id'];
						
		
		
			$DocTitle = ucwords($data['title']); 
			$DocTitle = str_replace(' ', '_', $DocTitle); 		
			$realFileName = $id.'_'.$DocTitle.$fileExt;
		
		
		if(is_file("./uploads/".$userfile.$fileExt)) {
 
				rename($filepath.$userfile.$fileExt, $filepath.$realFileName);
				
		            $sql = "UPDATE {$this->_db} 
					SET filename='".$realFileName."'
					WHERE id=" . $id . ";";

            $this->db->query($sql);

			$this->email->attach("./uploads/".$realFileName);
				
			}
			
		
			//rename($filepath.$userfile.$fileExt, $filepath.$realFileName);
			//$this->email->attach("./uploads/".$realFileName);


			// $this->email->attach($upload_data['full_path']);
	
	$this->email->from($this->settings->efs_from, $this->settings->site_name);
	
	    $this->email->subject('R'.$id.' - Title:'.$data['title'].', Filename:'.$realFileName.', Category:'.$data['category_id'].', Vendor:'.$data['vendor_id'].', Updated:' . date('Y-m-d H:i:s'));
	
	$sqlUser = "SELECT * FROM users
                WHERE id='" . $usernameID . "'
                    AND deleted='0'
	
	";
	
    $query = $this->db->query($sqlUser);
    $assignedUser = $query->row();
	
	$sqlRecord = "SELECT * FROM assets
                WHERE id='" . $data['id'] . "'
                    AND deleted='0'
	";
	
    $query = $this->db->query($sqlRecord);
    $recordDetails = $query->row_array();
	
	$sqlRecord = "SELECT * FROM assets
                WHERE id='" . $data['category_id'] . "'
                    AND deleted='0'
	";
	
    $query = $this->db->query($sqlRecord);
    $categoryDetails = $query->row_array();
	
	$sqlRecord = "SELECT * FROM assets
                WHERE id='" . $data['vendor_id'] . "'
                    AND deleted='0'
	";
	
    $query = $this->db->query($sqlRecord);
    $vendorDetails = $query->row_array();
	
	$sqlRecord = "SELECT * FROM assets
                WHERE id='" . $data['fiscal_y'] . "'
                    AND deleted='0'
	";
	
    $query = $this->db->query($sqlRecord);
    $fiscalDetails = $query->row_array();
	
	$emailMessage = "
Title:" . $data['title'] . ",
Cost: $" . $data['costprice'] . ",
Financial Yr: " . $fiscalDetails['categories'] . ",
Category:" . $categoryDetails['categories'] . ",
Vendor:" . $vendorDetails['categories'] . ",
Filename:" . $realFileName . ",
Description:" . $data['description'] . ",
Assigned User:" . $assignedUser->id .",
'0',
Updated: " . date('Y-m-d H:i:s') . ""; 


	$this->email->to($assignedUser->email);
	$this->email->cc($this->settings->efs_email);	
    
	$this->email->message($emailMessage);

    $this->email->send();			


            if ($this->db->affected_rows())
            {
                return TRUE;
            }
        }

        return FALSE;
    }

     function edit_catven($data = array())
    {
        if ($data)
        {
            $sql = "
                UPDATE {$this->_ass}
                SET
            ";

            $sql .= "categories = " . $this->db->escape($data['categories']) . ",
                    locked = " . $this->db->escape($data['locked']) . "
                WHERE id = " . $this->db->escape($data['id']) . "
                    AND deleted = '0'
            ";

            $this->db->query($sql);

            if ($this->db->affected_rows())
            {
                return TRUE;
            }
        }

        return FALSE;
    } 

    /**
     * Soft delete an existing record
     *
     * @param  int $id
     * @return boolean
     */
    function delete_record($id = NULL)
    {
        if ($id)
        {
            $sql = "
                UPDATE {$this->_db}
                SET
                    deleted = '1',
                    updated = '" . date('Y-m-d H:i:s') . "'
                WHERE id = " . $this->db->escape($id) . "
                    AND id > 1
            ";

            $this->db->query($sql);

            if ($this->db->affected_rows())
            {
                return TRUE;
            }
        }

        return FALSE;
    }
	
	    /**
     * Soft delete an existing category
     *
     * @param  int $id
     * @return boolean
     */
    function delete_catven($id = NULL)
    {
        if ($id)
        {
            $sql = "
                UPDATE {$this->_ass}
                SET
                    deleted=1
                WHERE id=" . $this->db->escape($id) . "";

            $this->db->query($sql);

            if ($this->db->affected_rows())
            {
                return TRUE;
            }
        }

        return FALSE;
    }


    /**
     * Check for valid login credentials
     *
     * @param  string $username
     * @param  string $password
     * @return array|boolean
     */
    function login($username = NULL, $password = NULL)
    {
        if ($username && $password)
        {
            $sql = "
                SELECT
                    id,
                    username,
                    password,
                    salt,
                    first_name,
                    last_name,
                    email,
                    language,
                    is_admin,
                    value,
                    created,
                    updated
                FROM {$this->_db}
                WHERE (username = " . $this->db->escape($username) . "
                        OR email = " . $this->db->escape($username) . ")
                    AND value = '1'
                    AND deleted = '0'
                LIMIT 1
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                $results = $query->row_array();
                $salted_password = hash('sha512', $password . $results['salt']);

                if ($results['password'] == $salted_password)
                {
                    unset($results['password']);
                    unset($results['salt']);

                    return $results;
                }
            }
        }

        return FALSE;
    }


    /**
     * Handle user login attempts
     *
     * @return boolean
     */
    function login_attempts()
    {
        // delete older attempts
        $older_time = date('Y-m-d H:i:s', strtotime('-' . $this->config->item('login_max_time') . ' seconds'));

        $sql = "
            DELETE FROM login_attempts
            WHERE attempt < '{$older_time}'
        ";

        $query = $this->db->query($sql);

        // insert the new attempt
        $sql = "
            INSERT INTO login_attempts (
                ip,
                attempt
            ) VALUES (
                " . $this->db->escape($_SERVER['REMOTE_ADDR']) . ",
                '" . date("Y-m-d H:i:s") . "'
            )
        ";

        $query = $this->db->query($sql);

        // get count of attempts from this IP
        $sql = "
            SELECT
                COUNT(*) AS attempts
            FROM login_attempts
            WHERE ip = " . $this->db->escape($_SERVER['REMOTE_ADDR'])
        ;

        $query = $this->db->query($sql);

        if ($query->num_rows())
        {
            $results = $query->row_array();
            $login_attempts = $results['attempts'];
            if ($login_attempts > $this->config->item('login_max_attempts'))
            {
                // too many attempts
                return FALSE;
            }
        }

        return TRUE;
    }


    /**
     * Validate a user-created account
     *
     * @param  string $encrypted_email
     * @param  string $validation_code
     * @return boolean
     */
    function validate_account($encrypted_email = NULL, $validation_code = NULL)
    {
        if ($encrypted_email && $validation_code)
        {
            $sql = "
                SELECT id
                FROM {$this->_db}
                WHERE SHA1(email) = " . $this->db->escape($encrypted_email) . "
                    AND validation_code = " . $this->db->escape($validation_code) . "
                    AND value = '0'
                    AND deleted = '0'
                LIMIT 1
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                $results = $query->row_array();

                $sql = "
                    UPDATE {$this->_db}
                    SET value = '1',
                        validation_code = NULL
                    WHERE id = '" . $results['id'] . "'
                ";

                $this->db->query($sql);

                if ($this->db->affected_rows())
                {
                    return TRUE;
                }
            }
        }

        return FALSE;
    }


    /**
     * Reset password
     *
     * @param  array $data
     * @return mixed|boolean
     */
    function reset_password($data = array())
    {
        if ($data)
        {
            $sql = "
                SELECT
                    id,
                    first_name
                FROM {$this->_db}
                WHERE email = " . $this->db->escape($data['email']) . "
                    AND value = '1'
                    AND deleted = '0'
                LIMIT 1
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                // get user info
                $user = $query->row_array();

                // create new random password
                $user_data['new_password'] = generate_random_password();
                $user_data['first_name']   = $user['first_name'];

                // create new salt and stored password
                $salt     = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), TRUE));
                $password = hash('sha512', $user_data['new_password'] . $salt);

                $sql = "
                    UPDATE {$this->_db} SET
                        password = " . $this->db->escape($password) . ",
                        salt = " . $this->db->escape($salt) . "
                    WHERE id = " . $this->db->escape($user['id']) . "
                ";

                $this->db->query($sql);

                if ($this->db->affected_rows())
                {
                    return $user_data;
                }
            }
        }

        return FALSE;
    }


    /**
     * Check to see if a username already exists
     *
     * @param  string $username
     * @return boolean
     */
    function _username_exists($username)
    {
        $sql = "
            SELECT id
            FROM {$this->_db}
            WHERE username = " . $this->db->escape($username) . "
            LIMIT 1
        ";

        $query = $this->db->query($sql);

        if ($query->num_rows())
        {
            return TRUE;
        }

        return FALSE;
    }


    /**
     * Check to see if an email already exists
     *
     * @param  string $email
     * @return boolean
     */
    function email_exists($email)
    {
        $sql = "
            SELECT id
            FROM {$this->_db}
            WHERE email = " . $this->db->escape($email) . "
            LIMIT 1
        ";

        $query = $this->db->query($sql);

        if ($query->num_rows())
        {
            return TRUE;
        }

        return FALSE;
    }
	
	function get_categories_list()
    {
	$where_array = array('locked'=>1,'deleted'=>0);
	$where_table = 'assets';
	$return = array();
	$result = $this->db->order_by('categories', 'ASC')->get_where($where_table, $where_array);
	if($result->num_rows() > 0) {
		foreach($result->result() as $row) {
		$return[] = $row; 
		//foreach($result->result_array() as $row) {
		//$return[$row['id']] = $row['id'] . " - " . $row['categories'];
	}
	}

        return $return;

    }
	
	function get_assets()
    {
	$where_array = array('deleted'=>0);
	$where_table = 'assets';
	$return = array();
	$result = $this->db->order_by('id', 'ASC')->get_where($where_table, $where_array);
	if($result->num_rows() > 0) { 
		foreach($result->result_array() as $row) {
		$return[$row['locked']] = $row['locked'] . " - " . $row['categories'];
	}
	}

        return $return;

    }
	
	function get_categories()
    {
	$where_array = array('locked'=>1,'deleted'=>0);
	$where_table = 'assets';
	$return = array();
	$result = $this->db->order_by('categories', 'ASC')->get_where($where_table, $where_array);
	if($result->num_rows() > 0) { 
		foreach($result->result_array() as $row) {
		$return[$row['id']] = /*$row['id'] . " - " . */$row['categories'];
	}
	}

        return $return;

    }
	
	function get_users()
    {
	$where_array = array('is_admin'=>1,'deleted'=>0);
	$where_table = 'users';
	$return = array();
	$result = $this->db->order_by('id', 'ASC')->get_where($where_table, $where_array);
	if($result->num_rows() > 0) { 
		foreach($result->result_array() as $row) {
		$return[$row['id']] = $row['id'] . " - " . $row['username'];
	}
	}

        return $return;

    }
	
	function get_userslist()
    {
	$where_array = array('is_admin'=>'1','deleted'=>'0','status'=>'1');
	$where_table = 'users';
	$return = array();
	$result = $this->db->order_by('id', 'ASC')->get_where($where_table, $where_array);
	if($result->num_rows() > 0) {
		foreach($result->result() as $row) {
		$return[] = $row; 
		//foreach($result->result_array() as $row) {
		//$return[$row['id']] = $row['id'] . " - " . $row['categories'];
	}
	}

        return $return;

    }
	
	function get_fiscallist()
    {
	$where_array = array('locked'=>3,'deleted'=>0);
	$where_table = 'assets';
	$result = $this->db->order_by('id', 'DESC')->get_where($where_table, $where_array);
	$return = array();
	
	if($result->num_rows() > 0) {
		foreach($result->result_array() as $row) {
		$return[$row['id']] = $row['categories'];
	}
	
	}

        return $return;

    }
	
	function get_category_name()
    {
	$where_array = array('deleted'=>0,'locked'=>1);
	$where_table = 'assets';
	$result = $this->db->order_by('id', 'ASC')->get_where($where_table, $where_array);
	$return = array();
	
	if($result->num_rows() > 0) {
		foreach($result->result() as $row) {
		$return[] = $row; 
	}
	} 
		
        return $return;
	}


	
	function get_vendor()
    {
	$where_array = array('locked'=>2,'deleted'=>0);
	$where_table = 'assets';
	$result = $this->db->order_by('categories', 'ASC')->get_where($where_table, $where_array);
	$return = array();
	
	if($result->num_rows() > 0) {
		foreach($result->result_array() as $row) {
		$return[$row['id']] = $row['categories'];
	}
	
	}

        return $return;

    }
	
	function getUserName($id)
    {
	if ($id)
        {
            $sql = "
                SELECT *
                FROM {$this->_users}
                WHERE id = " . $this->db->escape($id) . "
                    AND deleted = '0'
                    AND is_admin = '1'
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array()->username;
            }
        }

        return FALSE;

    }
	
	function get_userlist()
    {

	$result = $this->db->query("SELECT * FROM `users` WHERE `status` = '1'");
	$return = array();
	
	if($result->num_rows() > 0) {
		foreach($result->result_array() as $row) {
		$return[$row['id']] = ucfirst($row['username']);
	}
	
	}

        return $return;

    }
	
	function deleteFiles($path){
    $files = glob($path.'*'); // get all file names
    foreach($files as $file){ // iterate files
      if(is_file($file))
        unlink($file); // delete file
        //echo $file.'file deleted';
    }
	}	

	    /**
     * Get specific user
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_catven_record($id = NULL)
    {
        if ($id)
        {
            $sql = "
                SELECT *
                FROM {$this->_ass}
                WHERE id = " . $this->db->escape($id) . "
                    AND deleted = '0'
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }
	
	 function add_catven($data = array())
    {
        if ($data)
        {
				
            $sql = "INSERT INTO {$this->_ass} (
					categories,
					locked,
					deleted
                ) VALUES (  
				" . $this->db->escape($data['categories']) . ",
				" . $this->db->escape($data['locked']) . ", '0')";

            $this->db->query($sql);
			$id = $this->db->insert_id();

			return $id;
            			
        }

        return FALSE;
    }
	
	   /**
     * Get specific user
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_currentuser($id = NULL)
    {
        if ($id)
        {
            $sql = "
                SELECT *
                FROM {$this->_users}
                WHERE id = " . $this->db->escape($id) . "
                    AND deleted = '0'
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->email;
            }
        }

        return FALSE;
    }
	
	function get_email($userid) {
		$sqlUser = "SELECT * FROM users
                WHERE id='" . $userid . "'
                    AND deleted='0'
	
	";
	
    $query = $this->db->query($sqlUser);
    $assignedUser = $query->row();
	return $assignedUser; 
	}
	
	function get_fy() {
	$sql = "SELECT * FROM assets
               WHERE locked = '3'
               Order By id DESC
			   Limit 1
	"; 
	
    $query = $this->db->query($sql);
    $fy = $query->row();
	return $fy; 
        
	}
	
}

