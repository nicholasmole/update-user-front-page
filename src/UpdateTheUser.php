<?php
/*
Update the User
---------
Function that is called when you try to update the user data
Calls Standard Wordpress Fields
Then Add-User-Fields
Then Checks Password is set correctly


*/

//Helper Update The User
function update_the_user($new_value){
    //first part wordpress_Data
    //Not universal needs to be modified to fit all cases
    $update_user_array = array(
        'ID' => get_the_current_user()->ID,
        'first_name' => $new_value['first_name'],
        'last_name'  => $new_value['last_name'],
        'user_email' => $new_value['email_name'],
        'user_url'   => $new_value['website_name']
    );
    wp_update_user( $update_user_array ); 

    //Second Part add-user-fields fields
    $additionalModified = explode( ',', get_uufp_custom());
    
    //Loop through array
    for ($i = 0; $i < count($additionalModified); $i++) {
        //Loop Post
        foreach($_POST as $key => $val) {
            if($key == strtolower($additionalModified[$i].'_name' )){
                //Update this KEY
                update_user_meta( get_the_current_user()->ID,  strtolower($additionalModified[$i]) , $val);
            }
        }
    }

    //Test Password Set - if errors respond.
    $errors = '';
    $nonce = $_REQUEST['_wpnonce'];
    if ( ! wp_verify_nonce( $nonce, 'my-nonce' ) ) {
        if(($new_value['user_pass'] == '' && $new_value['user_pass_confirm'] == '') ){
            //both fields empty
            $errors = 1;
        }
        if(($new_value['user_pass'] != '' && $new_value['user_pass_confirm'] == '')||($new_value['user_pass'] == '' && $new_value['user_pass_confirm'] != '') ){
            //field empty
            $errors = 1;
        }
        if($new_value['user_pass'] != $new_value['user_pass_confirm']) {
            // passwords do not match
            $errors = 1;
        }
        if(!$errors) {
            $user_data = array(
                'ID' => get_the_current_user()->ID,
                'user_pass' => $_POST['user_pass']
            );
            wp_update_user($user_data);
        }
    }

}

?>