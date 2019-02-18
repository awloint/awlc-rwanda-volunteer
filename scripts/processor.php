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
//Require Classes
require '../config.php';
require './DB.php';
require './Notify.php';
require './Newsletter.php';
// Capture Post Data that is coming from the form
$_POST = json_decode(file_get_contents('php://input'), true);
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$location = $_POST['location'];
$inmateFirstName = $_POST['inmateFirstName'];
$inmateMiddleName = $_POST['inmateMiddleName'];
$inmateLastName = $_POST['inmateLastName'];
$prisonLocation = $_POST['prisonLocation'];
$summaryOfCase = $_POST['summaryOfCase'];
$name = $firstName . " " . $lastName;
require './emails.php';
$details = array(
    "firstName" => $_POST['firstName'],
    "middleName" => $_POST['middleName'],
    "lastName" => $_POST['lastName'],
    "email" => $_POST['email'],
    "phone" => $_POST['phone'],
    "location" => $_POST['location'],
    "inmateFirstName" => $_POST['inmateFirstName'],
    "inmateMiddleName" => $_POST['inmateMiddleName'],
    "inmateLastName" => $_POST['inmateLastName'],
    "prisonLocation" => $_POST['prisonLocation'],
    "summaryOfCase" => $_POST['summaryOfCase']
);
$emails = array(
    array(
            "email"         =>  $email,
            "variables"     =>  array(
            "phone"         =>  $phone,
            "name"          =>  $firstName,
            "middleName"    =>  $middleName,
            "lastName"      =>  $lastName
            )
    )
);
$db = new DB($host, $db, $username, $password);
$notify = new Notify($smstoken, $emailHost, $emailUsername, $emailPassword, $SMTPDebug, $SMTPAuth, $SMTPSecure, $Port);
$newsletter = new Newsletter($apiUserId, $apiSecret);
// Put the User into the Database
if ($db->insertUser("indigent", $details)) {
    $notify->viaEmail("letstalk@hopebehindbarsafrica.org", "Hope Behind Bars Africa", $email, $name, $emailBodyIndigent, "Thanks for Reaching Out");
    $notify->viaEmail("letstalk@hopebehindbarsafrica.org", "Hope Behind Bars Africa", "letstalk@hopebehindbarsafrica.org", "Admin", $emailBodyIndigentOrganisation, "New Submission about an Indigent");
    $notify->viaSMS("HBBAfrica", "Dear {$firstName} {$lastName}, thank you for reaching out to us. Your details have been received and a representative will reach out to you shortly. Cheers!", $phone);
    $notify->viaSMS("HBBAfrica", "Someone has submitted information about an Indigent on the ConnectLawyer app. Kindly check your email for the details.", "08073600790");
    $notify->viaSMS("HBBAfrica", "Someone has submitted information about an Indigent on the ConnectLawyer app. Kindly check your email for the details.", "07033633243");
    $newsletter->insertIntoList("2278719", $emails);
    echo json_encode("success");
}
