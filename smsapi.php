<?php
 
$key = "0665563232716606766f";	
$mbl="919450715497";
$message_content=urlencode("Your OTP for Account Verification is: 235464 Please do not share this OTP with anyone. Best Wishes Spahomeservice.in");  //here this is a message content should i pass here
//$otp="234567";
$senderid="SMSNCR";	
$route= 3;
$templateid="1207165458221179539";

$url = "http://sms.smsinsta.com/vb/apikey.php?apikey=$key&senderid=$senderid&templateid=$templateid&route=$route&number=$mbl&message=$message_content";
        
//$url="http://sms.smsinsta.com/vb/http-dlr.php?apikey=0665563232716606766f&msgid=MTUxMDgyMDc=&format=json"
$output = file_get_contents($url);	/*default function for push any url*/
echo $output;

//where should i pass otp
/* In msg you will pass otp. I cannot teach you basic coding. Kindly pass the right template id 

i know basic coding but i don't know how your api work 
Its very easy aPI.
Show me your Msg content ?

i just wanted to know where i pass otp like $otp in place of var variable in temeplate

Yes Pass that in content of your msg

YOu need to pass Exact Content approved on DLT
YOur OTP is $otp for Login. Regards ABC
Kindly don't change the content as that can reject msg_get_queue 

ok i understand


like 

Your OTP for Account Verification is: $otp Please do not share this OTP with anyone. Best Wishes Spahomeservice.in


right 

Your system will generate new otp everytime. If you keep 1234 it will send 1234 everytime.
yes that is only for example
ok one more thing

how do i find my template idate

Kindly take that from your client/ he must be having or the sales person will share the same with htmlentities

ok thanks
:)

can we disconnect  */
?>