<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function create_unique_slug($string, $table)
{
    $CI = &get_instance();
    $slug = url_title($string, '-', TRUE);
    $i = 0;
    $params = array ();
    $params['slug'] = $slug;
    if ($CI->input->post('id')) {
        $params['id !='] = $CI->input->post('id');
    }
    
    while ($CI->db->where($params)->get($table)->num_rows()) {
        if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
            $slug .= '-' . ++$i;
        } else {
            $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
        }
        $params ['slug'] = $slug;
    }
    return $slug;
}
//////////////generate random password/////////////////
function random_password() 
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $password = array(); 
    $alpha_length = strlen($alphabet) - 1; 
    for ($i = 0; $i < 8; $i++) 
    {
        $n = rand(0, $alpha_length);
        $password[] = $alphabet[$n];
    }
    return implode($password); 
}