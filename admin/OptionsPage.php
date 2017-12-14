<?php

add_action( 'admin_menu', 'uufp_menu' );

//Add the side menu options for fields
function uufp_menu() {
	add_options_page( 'UUFP Create Fields', 'UUFP Create Fields', 'manage_options', 'uufp_unique_slug', 'my_uufp_plugin_options' );
}

//Create the page

function my_uufp_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    //Collect this for post actions - located in UpdateList
    if(isset($_POST)){
        
        if($_POST['_wp_this_is_worpressfields']){
            change_uufp_wordpress_value($_POST['actiondefault']);
        }
        if($_POST['_wp_this_is_customfields']){
            change_uufp_custom_value($_POST['actioncustom']);
        }
        
    }
    
    ?>

    <div class="updated" style="border-color:#fff;">
        <h1>Edit Front Page Editable Fields</h1>
        <p>Here is where you save the wordpress and custom fields used in uufp.</p>
        <small> Warning. Not all fields are compatable yet</small>
            <div class="updated" style="border-color:#fff; background: rgba(105,105,105,0.1) ;font-size: 24px;veritcal-align:middle;">
            
                
                <!--<form action="<?php //content_url() echo plugin_dir_path(__FILE__) . 'src/UpdateList.php'; ?>"  method="POST">-->
                <table>
                <div>
                    <tr>
                    <form method="post" action="?page=uufp_unique_slug">
                        <td>
                            <large>Wordpress Standard Fields:</large>
                        </td>
                        <td>
                            <input name="actiondefault" value="<?php  
                                $cur_UUFP_WP = explode( ',', get_uufp_wordpress()) ;
                            foreach($cur_UUFP_WP as $uufp) { echo $uufp;if ($uufp !== end($cur_UUFP_WP))echo ','; } ?>">
                            <input type="hidden" name="_wp_this_is_worpressfields" value="_wp_this_is_worpressfields">
                        </td>
                        <td>
                            <button href="?page=uufp_unique_slug" type="submit" class="button button-primary button-large" value="DeleteUpdate">SAVE FIELDS</button>
                        </td>
                    </form>
                    </tr>
                </div>
                <br/>
                <div>
                    <tr>
                    <form method="post" action="?page=uufp_unique_slug">
                        <td>    
                            <large>Custom Created Fields:</large>
                        </td>
                        <td>
                            <input name="actioncustom" value="<?php  
                                $cur_UUFP_WP = explode( ',', get_uufp_custom()) ;
                                foreach($cur_UUFP_WP as $uufp) { echo $uufp;if ($uufp !== end($cur_UUFP_WP))echo ',';  } ?>">
                            <input type="hidden" name="_wp_this_is_customfields" value="_wp_this_is_customfields">
                        </td>
                        <td>
                            <button href="?page=uufp_unique_slug" type="submit" class="button button-primary button-large" value="DeleteUpdate">SAVE ADDITION FIELDS</button>
                        </td>
                    </form>
                    
                    </tr>
                    <tr>
                        <td>
                            <div style="font-size:10px;">Fields create via <a href="https://github.com/xzito/plugin_add-user-fields">add-user-fields</a> by Nick Mole</div>
                        </td>
                    </tr>
                </div>
                </table>
            </div>
	</div>
                

    <?php

}


?>