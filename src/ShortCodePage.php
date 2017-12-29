<?php
/*
Short Code Page
------
Short Code that creates the front in 

*/
add_shortcode( 'updateusersc', 'updateusersc' );

function updateusersc(){
    $nonce = wp_create_nonce( 'my-nonce' );

    //These two are place holders to show the data that can be user - this can be deleted
    $wordpressUserData = array('FirstName','LastName','Email','Website');
    $additionalModified = array('Title','Address','Address2','City','State','Zip','Country','Phone','Cell');

    /////Field Seperate by comma    
    $wordpressUserData = explode( ',', get_uufp_wordpress());
    //Change this for fields you wish to add
    $additionalField = get_option( 'wpse_addition_user_field' ); 
    /////Field seperated by comma 
    $additionalModified = explode( ',', get_uufp_custom());
  
    //Get the user data
    global $current_user;
    get_currentuserinfo();

    //Collect this for post actions - located in UpdateList
    if(isset($_POST)){
        if($_POST['_wp_current_user_update']){
            update_the_user($_POST);
        }
    }
    //Form for HTML
    pageForm($nonce,$wordpressUserData,$additionalModified,$current_user);
    
    
}

?>