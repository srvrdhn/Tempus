<?php
require '../php-rest-api-master/autoload.php';

$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$city = $_POST['address_city'];
$state = $_POST['address_state'];
$zip = $_POST['address_zip'];
$weapons = $_POST['demo-priority'];
$injured = $_POST['demo-priority2'];
$type = $_POST['emergency-category'];
$addinfo = $_POST['demo-message'];
$repeat = "This message will repeat once more.";

if($weapons == 'yes') {
  $weapons = 'There are weapons present.';
}
else {
  $weapons = 'There are no weapons present.';
}

if($injured == 'yes') {
  $injured = 'There are injured people present.';
}
else {
  $injured = '';
}

$info = '';

if($type == '1') {
  $type = "an intruder.";
}
if($type == '2') {
  $type = "a hostage situation.";
}
if($type == '3') {
  $type = "domestic abuse.";
}
if($type == '4') {
  $type = "${addinfo}.";
}
elseif($addinfo != '') {
  $info = "Additionally, ${addinfo}."; 
}

$message = "This is an automated emergency alert originating from the following location: ${address1}, ${address2}, ${city}, ${state}, ${zip}. The type of emergency involves ${type} ${weapons} ${injured} ${info} ${repeat}";

echo $message;

$MessageBird = new \MessageBird\Client('live_N0cnSHunASBPRmhSav3Q5LMBG');

$VoiceMessage = new \MessageBird\Objects\VoiceMessage();
$VoiceMessage->originator = 'MessageBird';
$VoiceMessage->recipients = array(19256393325);
$VoiceMessage->body = $message;

$VoiceMessage->language = 'en-us';
$VoiceMessage->voice = 'male';

$MessageBird->voicemessages->create($VoiceMessage);

?>
