<?php


function pageForm($nonce,$wordpressUserData,$additionalModified,$current_user){

    ?>

    <form method="post" action="<?php echo get_current_url(); ?>?_wpnonce={$nonce}">
            <div class="edit-profile-avatar" style="width:175px;">
                <?php echo get_avatar( $current_user->user_email, 32 ); ?>
            </div>
            <table class="table-update-user">   
                <?php
                 if ( count($wordpressUserData) && $wordpressUserData[0] != ''  ): 
                     for($i = 0; $i < count($wordpressUserData); $i++) { ?>
                <?php $valuehere = 'user_'.strtolower($wordpressUserData[$i]); ?>
                    <tr class="nf-field-label">
                        <?php 
                            $_UserField = 'user_'.strtolower($wordpressUserData[$i]);
                            $_UserField = ($_UserField == 'user_website')? 'website' : $_UserField;
                        ?>
                        <td><label class="update-display"><?php echo $wordpressUserData[$i];?></label></td>
                        <td><input class="text-input" name="<?php echo removeTheWordName($wordpressUserData[$i]); ?>_name" type="text" id="<?php echo removeTheWordName($wordpressUserData[$i]); ?>_name" value="<?php echo $current_user->$_UserField; ?>"/></td>
                    </tr>
                <?php }
                endif;
                ?>
            
                <?php
                if ( count($additionalModified) && $additionalModified[0] != ''  ): 
                
                    for ($i = 0; $i < count($additionalModified); $i++) { ?>
                
                        <tr class="nf-field-label">
                            <td><label class="update-display"><?php echo $additionalModified[$i];?></label></td>
                            <td><input class="text-input" name="<?php echo strtolower($additionalModified[$i]); ?>_name" type="text" id="<?php echo strtolower($additionalModified[$i]); ?>_name" value="<?php echo get_user_option(strtolower($additionalModified[$i]), get_current_user_id()); ?>"/></td>
                        </tr>
                <?php 
                    }
                endif;
                ?>
                <tr class="nf-field-label">
                    <td><div class="update-display"><?php echo error_password($_POST); ?></div></td>
                </tr>
                <tr class="nf-field-label">
                    <td>
                        <label class="update-display">Password</label></td>
                    <td><input class="text-input" name="user_pass" type="password" id="user_pass" value=""/></td>
                </tr>

                <tr class="nf-field-label">
                    <td><label class="update-display">Password Confirm</label></td>
                    <td><input class="text-input" name="user_pass_confirm" type="password" id="user_pass_confirm" value=""/></td>
                </tr>

                <input type="hidden" name="_wp_current_user_update" value="_wp_current_user_update"/>
                <tr><td>
                    <button href="<?php echo get_current_url(); ?>?_wpnonce={$nonce}" type="submit" class="button button-primary button-large" value="DeleteUpdate">Save</button>
                </td></tr>
            </table>
        </form>


    <?php

}


?>