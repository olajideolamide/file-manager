<?php if (!defined('BASEPATH')) exit('No direct script access allowed');




/*
 * Creates a strong password for each each user using blowfish algorithm
 * @see en.wikipedia.com/blowfish
 * @param string $password
 * @return string $hash the hash string
 */

function hashPassword($password)
{
    require APPPATH . "third_party/Passwords/password.php";
    $hash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));
    return $hash;
}

/*
 * Totally destroys the current session. Use with care :)
 */
function clearSession($userID = 0)
{

    $ci = &get_instance();
    $ci->session->sess_destroy($userID);
}


function verifyPassword($password, $hash)
{

    require APPPATH . "third_party/Passwords/password.php";
    if (password_verify($password, $hash)) {
        return TRUE;
    } else {
        return FALSE;
    }
}


function createUserSession($userID)
{

    $ci = &get_instance();

    $ci->session->set_userdata('id', $userID);
}




function isLoggedIn()
{
    $ci = &get_instance();

    if ($ci->session->userdata('id') == NULL) {
        return FALSE;
    } else {
        return TRUE;
    }
}


function logIPActivity($user_id, $activity = null, $activity_id = null)
{
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $ci = &get_instance();

    $ci->AuthorModel->logIPActivity($user_id, $ip_address, $activity, $activity_id);
}
