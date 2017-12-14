<?php


//function for removing the word name from fields
function removeTheWordName($wordpressUserData){
    $wordpressUserData = strtolower($wordpressUserData);
    
    return $wordpressUserData = str_replace('name','',$wordpressUserData);
}

//Get the current User
function get_the_current_user(){
    global $current_user;
    return $current_user;
}

//Helper get URL
function get_current_url(){
    $current_url = str_replace(home_url( ), "", get_permalink( get_the_ID() ));
    return $current_url;
}

//Helper Error message if password submitted Get:POST value , Return: Error Message
function error_password($new_value){
    if(!$new_value){ 
        return '';
    }
    //test password
    $nonce = $_REQUEST['_wpnonce'];
    if ( ! wp_verify_nonce( $nonce, 'my-nonce' ) ) {
        if(($new_value['user_pass'] == '' && $new_value['user_pass_confirm'] == '')){
            return "";
        }
        if(($new_value['user_pass'] != '' && $new_value['user_pass_confirm'] == '')||($new_value['user_pass'] == '' && $new_value['user_pass_confirm'] != '') ){
            //field empty
            return "Please fill out both to change password";
        }
        if($new_value['user_pass'] != $new_value['user_pass_confirm']) {
            // passwords do not match
            return "Passwords do not match";
        }
        if($new_value['user_pass'] == $new_value['user_pass_confirm']) {
            // passwords do not match
            return "Passwords Change Successful";
        }
    }
    return '';
}

function get_uufp_wordpress(){
    
    return get_option( 'wpse_uufp_wordpress' ); 
    
}
function get_uufp_custom(){
    
    return get_option( 'wpse_uufp_custom' ); 
    
}
//Filters the New Value
function regulate_new_value($new_value){
    //Removes Quotes
    $new_value=str_replace('\\', "", $new_value);
    $new_value=str_replace('"', "", $new_value);
    $new_value=str_replace("'", "", $new_value);

    //Removes Duplicates
    $result_value = explode( ',', $new_value) ;
    $new_value=array_unique($result_value);
    $result_value = "";
    foreach($new_value as $uufp) { $result_value .= $uufp;if ($uufp !== end($new_value))$result_value .=  ',';}

    return $result_value;
}
//Updates the Wordpress Standard
function change_uufp_wordpress_value($new_value){
    if($new_value != ''){
        $new_value=regulate_new_value($new_value);      
        update_option( 'wpse_uufp_wordpress', $new_value);
    }
}
//Updates the Custom Fields
function change_uufp_custom_value($new_value){
    if($new_value != ''){
        $new_value=regulate_new_value($new_value);    
        update_option( 'wpse_uufp_custom', $new_value);
    }
}
?>