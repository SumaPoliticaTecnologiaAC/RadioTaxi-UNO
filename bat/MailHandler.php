<?php

	//SMTP server settings	
	$host = "smtp.gmail.com;
    $port = "465";
    $username = "";
    $password = "";
	
	
	$messageBody = "";
	
	if($_POST['name']!='true'){
		$messageBody .= '<p>Visitor: ' . $_POST["name"] . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}
	if($_POST['name']!='true'){
		$messageBody .= '<p>Country: ' . $_POST["country"] . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}
	if($_POST['email']!='true'){
		$messageBody .= '<p>Email Address: ' . $_POST['email'] . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}else{
		$headers = '';
	}
	if($_POST['state']!='true'){		
		$messageBody .= '<p>State: ' . $_POST['state'] . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}
	if($_POST['phone']!='true'){		
		$messageBody .= '<p>Phone Number: ' . $_POST['phone'] . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}	
	if($_POST['fax']!='true'){		
		$messageBody .= '<p>Fax Number: ' . $_POST['fax'] . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}
	if($_POST['message']!='true'){
		$messageBody .= '<p>Message: ' . $_POST['message'] . '</p>' . "\n";
	}
	
	if($_POST["stripHTML"] == 'true'){
		$messageBody = strip_tags($messageBody);
	}
	
	if($host=="" or $username=="" or $password==""){
		$owner_email = $_POST["radiotaxi1.2022@gmail.com"];
		$headers = 'From:' . $_POST["email"] . "\r\n" . 'Content-Type: text/plain; charset=UTF-8' . "\r\n";
		$subject = 'A message from your site visitor ' . $_POST["name"];
		
		try{
			if(!mail($owner_email, $subject, $messageBody, $headers)){
				throw new Exception('mail failed');
				}else{
				echo 'mail sent';
			}
			}catch(Exception $e){
			echo $e->getMessage() ."\n";
		}
	}else{	
		require_once 'Mail.php';

		$to = $_POST["radiotaxi1.2022@gmail.coms"];
		$subject = 'A message from your site visitor ' . $_POST["name"];
		$headers = array (
		'From' => 'From:' . $_POST["email"] . "\r\n" . 'Content-Type: text/plain; charset=UTF-8' . "\r\n",
		'To' => $to,
		'Subject' => $subject);
		
		$smtp = Mail::factory(
					'smtp',
					array (
						'host' => $host,
						'port' => $port,
						'auth' => true,
						'username' => $username,
						'password' => $password));

		$mail = $smtp->send($to, $headers, $messageBody);
		
		try{
			if(PEAR::isError($mail)){
				echo $mail->getMessage();
				}else{
				echo 'mail sent';
			}
			}catch(Exception $mail){
			echo $mail->getMessage() ."\n";
		}
	}	
?>