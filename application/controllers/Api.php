<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends API_Controller {

	/**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('finance_model');
		
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
	

    /**
     * Default
     */
    public function index()
    {
        $this->lang->load('core');
        $results['error'] = lang('core error no_results');
        display_json($results);		
							
        exit;
    }


    /**
     * Users API - DO NOT LEAVE THIS ACTIVE IN A PRODUCTION ENVIRONMENT !!! - for demo purposes only
     */
/*    public function users()
    {
        // load the users model and admin language file
        $this->load->model('users_model');
        $this->lang->load('admin');

        // get user data
        $users = $this->users_model->get_all();
        $results['data'] = NULL;

        if ($users)
        {
            // build usable array
            foreach($users['results'] as $user)
            {
                $results['data'][$user['id']] = array(
                    'name'   => $user['first_name'] . " " . $user['last_name'],
                    'email'  => $user['email'],
                    'status' => ($user['status']) ? lang('admin input active') : lang('admin input inactive')
                );
            }
            $results['total'] = $users['total'];
        }
        else
            $results['error'] = lang('core error no_results');

        // display results using the JSON formatter helper
        display_json($results);
        exit;
    } */ 

	public function checkaccess() {
		
		$accesslive = $this->input->get("accesstoken");
		$sitetoken = $this->settings->apitoken;
	
	if ($sitetoken == $accesslive ) {
	 return True; 		  			
		} else { 
		 die("Access is strictly prohibited!");
		}
		
	}
	
	public function emails() {
	
	if($this->checkaccess()) {
		
	set_time_limit(9000); 
 
	/* connect to gmail with your credentials */
	$hostname = $this->settings->efs_imap;
	$username = $this->settings->efs_from; 
	$password = $this->settings->efs_password;
 
 
/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to VentraIP: ' . imap_last_error());
 
 
/* get all new emails. If set to 'ALL' instead 
 * of 'NEW' retrieves all the emails, but can be 
 * resource intensive, so the following variable, 
 * $max_emails, puts the limit on the number of emails downloaded.
 * 
 */
$emails = imap_search($inbox,'ALL');
 
/* useful only if the above search is set to 'ALL' */
// $max_emails = 16;
$max_emails = imap_num_msg($inbox); 
 
 
/* if any emails found, iterate through each email */
if($emails) {
 
    $count = 1;
 
    /* put the newest emails on top */
    rsort($emails);
 
    /* for every email... */
    foreach($emails as $email_number) 
    {
		
        /* get information specific to this email */
        $overview = imap_fetch_overview($inbox,$email_number,0);
 
        /* get mail message, not actually used here. 
           Refer to http://php.net/manual/en/function.imap-fetchbody.php
           for details on the third parameter.
         */
        $message = imap_fetchbody($inbox,$email_number,2);
 		$header = imap_header($inbox, $email_number);
		$email[$email_number]['from'] = $header->from[0]->mailbox.'@'.$header->from[0]->host;
		$email[$email_number]['fromaddress'] = $header->from[0]->personal;
		$email[$email_number]['to'] = $header->to[0]->mailbox;
		$email[$email_number]['subject'] = $header->subject;
		$email[$email_number]['message_id'] = $header->message_id;
		$email[$email_number]['date'] = $header->udate;
		
		$fy = $this->finance_model->get_fy()->id;
		echo "Finance Year: " . $fy;
		
		$emailData = array (
				'title' => 'Test',
				'category_id' => '110',
				'vendor_id'=> '111',
                'filename' => 'test.txt',
                'description' => 'No Desc',
                'username_id' => $this->settings->efs_incomingemails_defaultUser,
                'costprice' => '-183',
                'fiscal_y' => $fy,
				);
 
		$emailinput = explode(", ", $email[$email_number]['subject']);
		
		$emailData['title']= $emailinput[0];
		$emailData['costprice']= $emailinput[1];
		$emailData['description']= $emailinput[2];
		
		$from = $email[$email_number]['fromaddress'];
		$from_email = $email[$email_number]['from'];
		$to = $email[$email_number]['to'];
		$subject = $email[$email_number]['subject'];

		echo $from_email . '</br>';
		echo $to . '</br>';
		echo $subject . '</br>';

		
        /* get mail structure */
        $structure = imap_fetchstructure($inbox, $email_number);
 
        $attachments = array();
 
        /* if any attachments found... */
        if(isset($structure->parts) && count($structure->parts)) 
        {
            for($i = 0; $i < count($structure->parts); $i++) 
            {
                $attachments[$i] = array(
                    'is_attachment' => false,
                    'filename' => '',
                    'name' => '',
                    'attachment' => ''
                );
 
                if($structure->parts[$i]->ifdparameters) 
                {
                    foreach($structure->parts[$i]->dparameters as $object) 
                    {
                        if(strtolower($object->attribute) == 'filename') 
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['filename'] = $object->value;
                        }
                    }
                }
 
                if($structure->parts[$i]->ifparameters) 
                {
                    foreach($structure->parts[$i]->parameters as $object) 
                    {
                        if(strtolower($object->attribute) == 'name') 
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['name'] = $object->value;
                        }
                    }
                }
 
                if($attachments[$i]['is_attachment']) 
                {
                    $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);
 
                    /* 3 = BASE64 encoding */
                    if($structure->parts[$i]->encoding == 3) 
                    { 
                        $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                    }
                    /* 4 = QUOTED-PRINTABLE encoding */
                    elseif($structure->parts[$i]->encoding == 4) 
                    { 
                        $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                    }
                }
            }
        }
 
        /* iterate through each attachment and save it */
        foreach($attachments as $attachment)
        {
            if($attachment['is_attachment'] == 1)
            {
                $filename = $attachment['name'];
                if(empty($filename)) $filename = $attachment['filename'];
 
                if(empty($filename)) $filename = time() . ".dat";
 
                /* prefix the email number to the filename in case two emails
                 * have the attachment with the same file name.
                 */
                $fp = fopen("uploads/" . $email_number . "-" . $filename, "w+");
                fwrite($fp, $attachment['attachment']);
                fclose($fp);
				
				
				$emailData['filename']=$email_number . "-" . $filename;
				$filedetails = explode('.',$emailData['filename']);
				
				$file = $filedetails[0];
				$fileExt = "." . $filedetails[1];
				$filepath = "./uploads/";
				echo $file . "<br />";
				echo $fileExt . "<br />";
				echo $filepath . "<br />";
				$emailData['filename']=$email_number . "-" . $file;												
				$this->finance_model->add_record($emailData, $file, $fileExt, './uploads/');
				
            }
 
        }
 
        if($count++ >= $max_emails) break;
    }
 
foreach($emails as $email_number) 
    {
	 imap_delete($inbox, $email_number);		
	}  

	} 
 
	imap_expunge($inbox);
/* close the connection */
imap_close($inbox);
 
echo "Done";	
	
	}
	
	}

}
