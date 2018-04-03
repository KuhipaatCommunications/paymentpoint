<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
//////////function to check is admin logedin or not/////
function isAdminLoggedIn()
{
    $CI =& get_instance();
    $admin_id = $CI->session->userdata('admin_id');
    if($admin_id == '')
    {
            return false;
    }
    else
    {
            return true;	
    }
}
//////////function to check is user logedin or not/////
function isMemberLoggedIn()
{
	$CI =& get_instance();
	$member_id = $CI->session->userdata(CURRENT_USER_ID);
	if($member_id == '') return 0; else return 1;
}

function isMyself($user_id)
{
    $CI =& get_instance();
    return  $CI->session->userdata(CURRENT_USER_ID) == $user_id?TRUE:FALSE;
}

function cms_menu() {
	$CI =& get_instance();
	$CI->load->model('admin/adminmodel');
	$arr = $CI->adminmodel->cms_menu();
	return $arr;
}
//////function to create unique key///////
function getGUID(){
	mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
	$charid = strtoupper(md5(uniqid(rand(), true)));
	$hyphen = chr(45);// "-"
	$uuid =
		 substr($charid, 0, 8).$hyphen
		.substr($charid, 8, 4).$hyphen
		.substr($charid,12, 4).$hyphen
		.substr($charid,16, 4).$hyphen
		.substr($charid,20,12);
	return $uuid;
}
//////End function to create unique key///////

////////function to create unique id///////////
function get_unique_session_id($pre, $user_id)
{
	$end = $user_id;
	$start = '';
	$characters = range('0','6');
	for ($i = 0; $i < 6 - strlen((string)$end); $i++) {
		$rand = mt_rand(0, count($characters)-1);
		$start .= $characters[$rand];
	}
	return $pre.$start.$end;
}

function encode($var)
{
	$CI =& get_instance();
	return $CI->encryption->encrypt($var);
}

function decode($var)
{
	$CI =& get_instance();
	return $CI->encryption->decrypt($var);
}

function isAccessPermit()
{
    $CI =& get_instance();
    $role_id = $CI->session->userdata('role_id');
    //$access_controller = $CI->session->userdata('access_controller');
    //$access_method = $CI->session->userdata('access_method');
    $CI->load->model('admin/user_model', 'User');
    $role_access= $CI->User->getUserRoleDetails($role_id);
    $access_controller=array();
    $access_method=array();
    if($role_access && !empty($role_access))
    {
        foreach($role_access as $row)
        {
            $access_controller[]=strtolower($row['controller']);
            $access_method[]=strtolower($row['method']);
        }
    }
    $current_controller=$CI->router->fetch_class();
    $current_method=$CI->router->fetch_method();
    $cur_ctr_method=strtolower($current_controller).'/'.strtolower($current_method);
    //echo '<pre>';print_r($current_method);exit;
    if($role_id==1 || (in_array(strtolower($current_controller), $access_controller) && in_array($cur_ctr_method, $access_method)))
        return true;
    else
        redirect('admin/accessdenied');
}
function getAccessControllerAndMethod()
{
    $CI =& get_instance();
    $role_id = $CI->session->userdata('role_id');
    //$access_controller = $CI->session->userdata('access_controller');
    //$access_method = $CI->session->userdata('access_method');
    $CI->load->model('admin/user_model', 'User');
    $role_access= $CI->User->getUserRoleDetails($role_id);
    $access_controller=array();
    $access_method=array();
    if($role_access && !empty($role_access))
    {
        foreach($role_access as $row)
        {
            $access_controller[]=strtolower($row['controller']);
            $access_method[]=strtolower($row['method']);
        }
    }
    return array('a_controller'=>$access_controller, 'a_method'=>$access_method);
}

function getCurrentAdminUserProfileImage()
{
    $CI =& get_instance();
    $admin_id = $CI->session->userdata('admin_id');
    $CI->load->model('common_methods', 'Common');
    $user_det= $CI->Common->getSingle('admin', 'profile_image', array('id'=>$admin_id));
    return $user_det;
}
