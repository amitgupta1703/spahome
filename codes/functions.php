<?php 
 // Function to generate OTP
 function generateNumericOTP($n) { 
	$generator = "1357902468"; 
	$result = ""; 
	for ($i = 1; $i <= $n; $i++) {
		$result .= substr($generator, (rand()%(strlen($generator))), 1);
	} 
	return $result;
} 
//$contact="9450715497";
//sendWhatsappMsg('Amit',$contact);

function sendOtp($otp,$mobilenumber){
    $key = "0665563232716606766f";	
    $mbl="91{$mobilenumber}";
    $message_content=urlencode("Your OTP for login to spa home service Account is {$otp} please do not share this OTP. Regards, SPA HOME SERVICE");
    $senderid="THERPE";	
    $route= 3;
    $templateid="1207166220980728906";
    $url = "http://sms.smsinsta.com/vb/apikey.php?apikey=$key&senderid=$senderid&templateid=$templateid&route=$route&number=$mbl&message=$message_content"; 
    $output = file_get_contents($url);	/*default function for push any url*/
    echo $output;
}

function sendWhatsappMsgOnlyText($name,$contact){
    $number = $contact;
	$msg = "Welcome to SPA Home Service {$name},\n\nYou successfully registered with us.\n\nRegards\n\nSpa Home Service";
	$ins = "bd84dba8bf0c7893ccff3d74b59da17059f05e9f24b722207a50279bfd37aaa1";
	$api = "e892c988b026e8465b469a5b898e8749ff95d9dac6398030f7bde36a77206c0b"; 
	$url = "http://whatsapi.smsinsta.com/api/send-text";
	$data = [
		"number" => $number,
		"msg" => $msg,
		"instance" => $ins,
		"apikey" => $api
	]; 

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    echo $url;
	$result = curl_exec($ch);
	curl_close($ch);
	echo $result;
}


function sendWhatsappMsg($name,$contact){
	$number = "91{$contact}";
	$media="https://spahomeservice.in/images/partners-join.jpg";
	$msg = "\nWelcome to SPA Home Service {$name},\n\nYou successfully registered with us.\n\nRegards\n\nSpa Home Service";
	$ins = "bd84dba8bf0c7893ccff3d74b59da17059f05e9f24b722207a50279bfd37aaa1";
	$api = "e892c988b026e8465b469a5b898e8749ff95d9dac6398030f7bde36a77206c0b"; 
	$url = "http://whatsapi.smsinsta.com/api/send-media";
	$type = "image";
	$data = [
		"number" => $number,
		"msg" => $msg,
		"media"=>$media,
		"type" => $type,
		"instance" => $ins,
		"apikey" => $api
	];  
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$result = curl_exec($ch);
	curl_close($ch);
	//echo $result;  
}

?>