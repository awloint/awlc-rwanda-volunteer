<?php
/**
 * This script handles registration and payment
 *
 * PHP version 7.2
 *
 * @category Form_Processor
 * @package  Form_Processor
 * @author   Benson Imoh,ST <benson@stbensonimoh.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://stbensonimoh.com
 */
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// Require Classes
require '../config.php';
require './DB.php';
require './Notify.php';
require './Newsletter.php';

$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$location = $_POST['location'];
$skills = $_POST['skills'];
$linkedin = $_POST['linkedin'];
$twitter = $_POST['twitter'];
$instagram = $_POST['instagram'];
$facebook = $_POST['facebook'];
$reasonForVolunteering = $_POST['reasonForVolunteering'];
$canWorkRemotely = $_POST['canWorkRemotely'];
$livesInRwanda = $_POST['livesInRwanda'];
$availableTime = $_POST['availableTime'];
$communicationChannel = $_POST['communicationChannel'];

$name = $firstName . " " . $lastName;
require './emails.php';
$details = array(
    "firstName" => $_POST['firstName'],
    "middleName" => $_POST['middleName'],
    "lastName" => $_POST['lastName'],
    "email" => $_POST['email'],
    "phone" => $_POST['phone'],
    "location" => $_POST['location'],
    "skills" =>$_POST['skills'],
    "linkedin" => $_POST['linkedin'],
    "twitter" => $_POST['twitter'],
    "instagram" => $_POST['instagram'],
    "facebook" => $_POST['facebook'],
    "reasonForVolunteering" => $_POST['reasonForVolunteering'],
    "canWorkRemotely" => $_POST['canWorkRemotely'],
    "livesInRwanda" => $_POST['livesInRwanda'],
    "availableTime" => $_POST['availableTime'],
    "communicationChannel" => $_POST['communicationChannel'],
);
$emails = array(
    array(
            "email"         =>  $email,
            "variables"     =>  array(
            "phone"         =>  $phone,
            "name"          =>  $firstName,
            "middleName"    =>  $middleName,
            "lastName"      =>  $lastName,
            "skills"        =>  $skills
            )
    )
);
$db = new DB($host, $db, $username, $password);
$notify = new Notify($smstoken, $emailHost, $emailUsername, $emailPassword, $SMTPDebug, $SMTPAuth, $SMTPSecure, $Port);
$newsletter = new Newsletter($apiUserId, $apiSecret);
// Put the User into the Database
if ($db->insertUser("awlc_volunteers", $details)) {
    $notify->viaEmail("volunteer@awlo.org", "Volunter at African Women in Leadership Organisation", $email, $name, $emailBodyVolunteer, "Thanks for Signing Up");
    $notify->viaEmail("volunteer@awlo.org", "Volunteer at African Women in Leadership Organisation", "volunteer@awlo.org", "Admin", $emailBodyOrganisation, "New Volunteer SignUp");
    $notify->viaSMS("AWLOInt", "Dear {$firstName} {$lastName}, Thank you for volunteering and sharing your good heart with us. Kindly check your email for the next steps. Cheers!", $phone);
    $notify->viaSMS("AWLOInt", "A volunteer just signedup for the AWLCRwanda2019. Kindly check your email for the details.", "08037594969,08022473972");
    $newsletter->insertIntoList("2292703", $emails);
    echo json_encode("success");
}
