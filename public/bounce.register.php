<?php 
include ("../Config/core.php");
    include('../Config/class.conn.php');
    include('../classes/class.user.registration.php');
    include('../classes/class.user.utilities.php');
    include('../classes/class.security.geo_ip.php');

    // $IP_finder = new security_ip;
    // $user_ip = $IP_finder->get_ip_address();
    // $get_country = new security_ip;
    // // $country = $get_country->get_region($user_ip);
    //  $country = $get_country->get_region('89.34.64.0/21');
    //  $message = ""; 
    
    if(isset($_POST)){

            if(!empty($_POST['firstname'])){
            $firstname = htmlspecialchars(strip_tags($_POST['firstname']));
            }else{
                header('Location: home.php?page=home&alert=warning&message=No First Name');
                // print('<p>No first name</p>');
                exit();
            }

    //         if(isset($_POST['email'])){
    //             $email = htmlspecialchars(strip_tags($_POST['email']));
    //             $check_email_exists = new user_utilities;
    //                 if($check_email_exists->email_exists_check($email)){
    //                     header('Location: home.php?page=home&alert=warning&message=Email Already Exists');
    //                     exit();
    //                 }
    //             }else{
    //                 $email = "NULL";
    //                 $message.= "No Email";
    //             }



    //         if(isset($_POST['psw1'])){
    //            // $psw1 = htmlspecialchars(strip_tags($_POST['psw1']));
    //             $psw1 = $_POST['psw1'];
    //             $password1 = $psw1;
    //             }else{
    //                 $psw1 = "NULL";
    //                 $message.= "No Password";
    //             }

    //         if(isset($_POST['psw2'])){
    //             // $psw2 = htmlspecialchars(strip_tags($_POST['psw2']));
    //             $psw2 = $_POST['psw2'];
    //             }else{
    //                 $psw2 = "NULL";
    //             }
                
    //         if(!($psw2 == $psw1)){
    //             header('Location: home.php?page=home&alert=warning&message=Passwords Do Not Match');
    //             exit();
    //             }else{
    //         }

    //         $register = new user_registration();
    //         if($register->create($firstname, 'last', $email, $psw1, $user_ip, $country)){
    //          header('Location: home.php?page=home&message=Confirm Your Email');
    //          exit();
    //         }else{
    //          header('Location: home.php?page=home&alert=warning&message=Data Upload Problem');
    //          exit();
    //         }

    //     }else{
    //         header("Location: home.php?page=home");
    //         exit();
         }
 
?>

<?php

//$register = new user_registration();
//print('<p>'.$register->create($firstname, 'last', $email, $password, $user_ip, $country).'</p>');
print('<pre>');
print_r($_POST);
print($user_ip);
print($country);
print('</pre>');
?>

<?php

/**
 * Gets IP address.
 */
function getIpAddress()
{
    $ipAddress = '';
    if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
        // to get shared ISP IP address
        $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check for IPs passing through proxy servers
        // check if multiple IP addresses are set and take the first one
        $ipAddressList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($ipAddressList as $ip) {
            if (! empty($ip)) {
                // if you prefer, you can check for valid IP address here
                $ipAddress = $ip;
                break;
            }
        }
    } else if (! empty($_SERVER['HTTP_X_FORWARDED'])) {
        $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if (! empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
        $ipAddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    } else if (! empty($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (! empty($_SERVER['HTTP_FORWARDED'])) {
        $ipAddress = $_SERVER['HTTP_FORWARDED'];
    } else if (! empty($_SERVER['REMOTE_ADDR'])) {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
    }
    return $ipAddress;
}

echo "IP Address: " . getIpAddress();