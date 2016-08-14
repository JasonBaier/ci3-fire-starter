<?php

function getFileExtension($fileName){
   $parts=explode(".",$fileName);
   return $parts[count($parts)-1];
}

$imap = imap_open("{c2s1-3e-syd.hosting-services.net.au:993/imap/ssl}INBOX", "fs.process@autechnet.com", "uMQP)iH^60hW") or die("imap connection error");
$message_count = imap_num_msg($imap);
for ($m = 1; $m <= $message_count; ++$m){

    $header = imap_header($imap, $m);
    //print_r($header);

    $email[$m]['from'] = $header->from[0]->mailbox.'@'.$header->from[0]->host;
    $email[$m]['fromaddress'] = $header->from[0]->personal;
    $email[$m]['to'] = $header->to[0]->mailbox;
    $email[$m]['subject'] = $header->subject;
    $email[$m]['message_id'] = $header->message_id;
    $email[$m]['date'] = $header->udate;

    $from = $email[$m]['fromaddress'];
    $from_email = $email[$m]['from'];
    $to = $email[$m]['to'];
    $subject = $email[$m]['subject'];

    echo $from_email . '</br>';
    echo $to . '</br>';
    echo $subject . '</br>';

    $structure = imap_fetchstructure($imap, $m);

    $attachments = array();
    if(isset($structure->parts) && count($structure->parts)) {

        for($i = 0; $i < count($structure->parts); $i++) {

            $attachments[$i] = array(
                'is_attachment' => false,
                'filename' => '',
                'name' => '',
                'attachment' => ''
            );

            if($structure->parts[$i]->ifdparameters) {
                foreach($structure->parts[$i]->dparameters as $object) {
                    if(strtolower($object->attribute) == 'filename') {
                        $attachments[$i]['is_attachment'] = true;
                        $attachments[$i]['name'] = $object->value;
                    }
                }
            }

            if($structure->parts[$i]->ifparameters) {
                foreach($structure->parts[$i]->parameters as $object) {
                    if(strtolower($object->attribute) == 'name') {
                        $attachments[$i]['is_attachment'] = true;
                        $attachments[$i]['name'] = $object->value;
                    }
                }
            }

            if($attachments[$i]['is_attachment']) {
                $attachments[$i]['attachment'] = imap_fetchbody($imap, $m, $i+1);
                if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
                    $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
					$attachments[$i]['name'] = $attachments[$i]['name'];
                }
                elseif($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
                    $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
					$attachments[$i]['name'] = $attachments[$i]['name'];
                }
            }
        }
    }

    foreach ($attachments as $key => $attachment) {
        $contents = $attachment['attachment'];
		$fname = $attachment['name'];

		echo $fname ."<br />\n";
		
		$myfile = fopen("processing/".$key, "w+") or die("Unable to open file!");
		fwrite($myfile, $contents);
		fclose($myfile);
		
		//file_put_contents("processing/".$fname, $contents);
    }

    //imap_setflag_full($imap, $i, "\\Seen");
    //imap_mail_move($imap, $i, 'Trash');
}

//for ($m = 1; $m <= $message_count; ++$m){
//		imap_delete($imap, $m);
//}

//imap_expunge($imap);

imap_close($imap);

echo "Complete";

?>