<?php
	ob_start();
	session_start();
	
	require_once('sendmail.php');

	if(isset($_POST['contactFormSend'])){
		$data = file_get_contents('data.json');
		$data_array = json_decode($data);
		date_default_timezone_set("Asia/Calcutta");
		//Collect form data
		$contactName = trim(htmlentities($_POST['contactName']));
		$contactEmail = trim(htmlentities($_POST['contactEmail']));
		$contactPhone = trim(htmlentities($_POST['contactPhone']));
        $contactMessage = trim(htmlentities($_POST['contactMessage']));

        //Get Attachment
		$targetDir = "uploads/";
		$targetFile = $targetDir . basename($_FILES['contactFile']['name']);
		move_uploaded_file($_FILES['contactFile']['tmp_name'], $targetFile);

		//Generate JSON data array
        $groups = file_get_contents('./data.json');
        $groups = json_decode($data);
        $groupIDs = [];
        $entryID = trim(rand(11111, 99999));
        foreach($groups as $group){
            array_push($groupIDs, $group->entryID);
        }
        if(count($groupIDs) > 0 && in_array($entryID, $groupIDs)){
            $entryID = trim(rand(11111, 99999));
        }
		$contact = array(
			'entryDate' => date("Y-m-d H:i:s"),
            'uniqueID' => uniqid(),
			'entryID' => $entryID,
			'contactName' => $contactName,
			'contactEmail' => $contactEmail,
            'contactPhone' => $contactPhone,
            'contactMessage' => $contactMessage,
		);
		//Append form data to JSON
		$data_array[] = $contact;
		//Save updated JSON data to file
		$data_array = json_encode($data_array, JSON_PRETTY_PRINT);
		if(file_put_contents('./data.json', $data_array)){
			//Send Email Notification to contact
			sendMailNotification($entryID, $contactEmail, $contactName, $targetFile);
			//Send Email Notification to Admin
			sendAdminMailNotification($entryID, $contactName, $contactEmail, $contactPhone, $contactMessage, $targetFile);
		    header("Location: success.php");
        }
        else{
            header("Location: failed.php");
        }
	}
	else{
		header("Location: failed.php");
	}

	function sendMailNotification($sendMailID, $sendMailEmail, $sendMailName, $sendMailFile){
        $sendMailVars = array(
            'sendMailName' => $sendMailName,
            'sendMailID' => $sendMailID
        );
		$sendMailSubject = "Contact Form - Confirmation";
		$sendMailBody = file_get_contents('templates/user.html');
        if(isset($sendMailVars)){
            foreach($sendMailVars as $k=>$v){
                $sendMailBody = str_replace('{'. strtoupper($k) . '}', $v, $sendMailBody);
            }
        }
		new sendMail($sendMailEmail, $sendMailName, $sendMailSubject, $sendMailBody, $sendMailFile);
	}

	function sendAdminMailNotification($sendMailID, $sendMailName, $sendMailEmail, $sendMailPhone, $sendMailMessage, $sendMailFile){
		$adminEmail = "ADMIN_OR_YOUR_EMAIL_ID";
        $sendMailVars = array(
            'sendMailID' => $sendMailID,
            'sendMailName' => $sendMailName,
            'sendMailEmail' => $sendMailEmail, 
            'sendMailPhone' => $sendMailPhone,
            'sendMailMessage' => $sendMailMessage
        );
		$sendMailSubject = "Contact Form - New Entry";
		$sendMailBody = file_get_contents('templates/admin.html');
        
        if(isset($sendMailVars)){
            foreach($sendMailVars as $k=>$v){
                $sendMailBody = str_replace('{'. strtoupper($k) . '}', $v, $sendMailBody);
            }
        }
		new sendMail($adminEmail, $sendMailName, $sendMailSubject, $sendMailBody, $sendMailFile);
	}
	
	ob_end_flush();
?>