<?php
/**
 * Dinner Lite Metabox
 * 
 * @package dinner_lite
 */

 add_action('add_meta_boxes', 'dinner_lite_add_sidebar_layout_box');

function dinner_lite_add_sidebar_layout_box(){    
    add_meta_box(
                 'dinner_lite_sidebar_layout', // $id
                 __( 'Sidebar Layout', 'dinner-lite' ), // $title
                 'dinner_lite_sidebar_layout_callback', // $callback
                 'page', // $page
                 'normal', // $context
                 'high'); // $priority    
}

$dinner_lite_sidebar_layout = array(         
        'right-sidebar' => array(
                        'value' => 'right-sidebar',
                        'label' => __( 'Right sidebar (default)', 'dinner-lite' ),
                        'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png'
                    ),
        'no-sidebar' => array(
                        'value'     => 'no-sidebar',
                        'label'     => __( 'No sidebar', 'dinner-lite' ),
                        'thumbnail' => get_template_directory_uri() . '/images/no-sidebar.png'
                    )   

    );

function dinner_lite_sidebar_layout_callback(){
    global $post , $dinner_lite_sidebar_layout;
    wp_nonce_field( basename( __FILE__ ), 'dinner_lite_sidebar_layout_nonce' ); 
?>
<table class="form-table">
    <tr>
        <td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template', 'dinner-lite' ); ?></em></td>
    </tr>

    <tr>
        <td>
        <?php  
            foreach( $dinner_lite_sidebar_layout as $field ){  
                $sidebar_layout = get_post_meta( $post->ID, 'dinner_lite_sidebar_layout', true ); ?>

            <div class="radio-image-wrapper" style="float:left; margin-right:30px;">
                <label class="description">
                    <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" /></span><br/>
                    <input type="radio" name="dinner_lite_sidebar_layout" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $sidebar_layout ); if( empty( $sidebar_layout ) ) { checked( $field['value'], 'right-sidebar' ); } ?>/>&nbsp;<?php echo esc_html( $field['label'] ); ?>
                </label>
            </div>
            <?php } // end foreach 
            ?>
            <div class="clear"></div>
        </td>
    </tr>
</table>
<?php        
}

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function dinner_lite_save_sidebar_layout( $post_id ) { 
    global $dinner_lite_sidebar_layout, $post; 

    // Verify the nonce before proceeding.
    if ( ! isset( $_POST[ 'dinner_lite_sidebar_layout_nonce' ] ) || ! wp_verify_nonce( sanitize_key( $_POST[ 'dinner_lite_sidebar_layout_nonce' ] ), basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
        
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }  
    

    foreach( $dinner_lite_sidebar_layout as $field ){  
        //Execute this saving function
        $old = get_post_meta( $post_id, 'dinner_lite_sidebar_layout', true); 
        $new = sanitize_text_field( wp_unslash( $_POST['dinner_lite_sidebar_layout'] ) );
        if ( $new && $new != $old ) {  
            update_post_meta( $post_id, 'dinner_lite_sidebar_layout', $new );  
        } elseif ( '' == $new && $old ) {  
            delete_post_meta( $post_id,'dinner_lite_sidebar_layout', $old );  
        }  
     } // end foreach   
     
}
add_action('save_post', 'dinner_lite_save_sidebar_layout'); 