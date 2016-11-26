<?php
function travbo_post_options_meta_box() {
  add_meta_box(
   'post_options',
   __('Post Options', 'travbo'),
   'travbo_post_options_callback',
   'post',
   'normal',
   'high'

   );
}
add_action('add_meta_boxes', 'travbo_post_options_meta_box' );

function travbo_post_options_callback($post)
{

	$post_options = (array)get_post_meta( $post->ID, '_post_options', true );

  $post_options = wp_parse_args( $post_options, array(
    'video' => '',
    ) );
  $post_options['video'] = isset($post_options['video']) ? $post_options['video'] : '';

  wp_nonce_field( $post->ID, 'travbo_post_options' );
  ?>
  <div class="form-wrap">
    <h4><?php _e('Post Style', 'travbo');?></h4>
    <div>
      <label for="travbo_po_post_header"><?php _e('Thumbnail on Post Header', 'travbo');?></label>
      <select name="post_options[post_header]" id="travbo_po_post_header">
        <option value="1" selected="selected"><?php _e('Yes', 'travbo');?></option>
        <option value="0"><?php _e('No', 'travbo');?></option>
      </select>
    </div>
    <div style="border-bottom: 1px solid #eee; margin: 20px 0;"></div>

    <h4><?php _e('Post Format Options', 'travbo');?></h4>
    <div>
      <label for="travbo_po_video"><?php _e('Video URL', 'travbo');?></label>
      <input type="text" style="width: 100%" name="post_options[video]" id="travbo_po_video" value="<?php echo sanitize_text_field($post_options['video']);?>">
      <p><?php _e('Video url for Video Post Formart. Ex: https://www.youtube.com/watch?v=DK_0jXPuIr0', 'travbo');?></p>
    </div>
    <div style="border-bottom: 1px solid #eee;  margin: 20px 0;"></div>
  </div>
  <?php
}


add_action( 'save_post', 'travbo_post_options_save' );

function travbo_post_options_save($post_id)
{
	
    // Check if our nonce is set.
  if ( ! isset( $_POST['post_options'] ) ) {
    return;
  }

  $nonce = $_POST['travbo_post_options'];

    // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, $post_id ) ) {
    return;
  }

    /*
     * If this is an autosave, our form has not been submitted,
     * so we don't want to do anything.
     */
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return;
    }


    // Check the user's permissions.
    if ( 'page' == $_POST['post_type'] ) {
      if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return;
      }
    } else {
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
      }
    }


    // Sanitize the user input.
    $mydata = $_POST['post_options'];
    $mydata['video'] = sanitize_text_field($mydata['video'] );

    // Update the meta field.
    update_post_meta( $post_id, '_post_options', $mydata );
  }