<?php
 
 
/**
 *	Gmail attachment extractor.
 *
 *	Downloads attachments from Gmail and saves it to a file.
 *	Uses PHP IMAP extension, so make sure it is enabled in your php.ini,
 *	extension=php_imap.dll
 *
 */
 
 
set_time_limit(9000); 
 
/* connect to gmail with your credentials */
$hostname = '{c2s1-3e-syd.hosting-services.net.au:993/imap/ssl}INBOX';
$username = 'fs.process@autechnet.com'; # e.g somebody@gmail.com
$password = 'uMQP)iH^60hW';
 
 
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
		
		$from = $email[$email_number]['fromaddress'];
		$from_email = $email[$email_number]['from'];
		$to = $email[$email_number]['to'];
		$subject = $email[$email_number]['subject'];

		echo $from_email . '</br>';
		echo $to . '</br>';
		echo $subject . '</br>';
		echo $email[$email_number]['date'] . '</br>';
		
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
                $fp = fopen("processing/" . $email_number . "-" . $filename, "w+");
                fwrite($fp, $attachment['attachment']);
                fclose($fp);
            }
 
        }
 
        if($count++ >= $max_emails) break;
    }
 
} 
 
/* close the connection */
imap_close($inbox);
 
echo "Done";
 
?>