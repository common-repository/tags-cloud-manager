<?php
  if( isset($_POST['tcm-publish']) || isset($_POST['tcm-update'] ) ) {
    if ( !isset( $_REQUEST['_wpnonce'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'tcm-nonce' ) ) {
?>
       <div class="error notice">
        <p><?php esc_html_e('Error : Direct access may be harm your content...', 'tcm'); ?></p>
      </div>
<?php
    }

    else if( isset($_POST['tcm-update']) ){

      $tcm_option_name = $_POST['tcm-slug'];

      $tcm_id = $_GET['id'];

      $tcm_current = date("Y/m/d g:i:s a");
      $tcm_cloud = array(
        'tcm_title' => sanitize_text_field($_POST['tcm-title']),
        'tcm_taxonomy' => sanitize_text_field($_POST['tcm-taxonomy']),
        'tcm_order_by' => sanitize_text_field($_POST['tcm-order-by']),
        'tcm_order' => sanitize_text_field($_POST['tcm-order']),
        'tcm_unit' => sanitize_text_field($_POST['tcm-measure']),
        'tcm_format' => sanitize_text_field($_POST['tcm-format']),
        'tcm_link' => sanitize_text_field($_POST['tcm-link']),
        'tcm_echo' => sanitize_text_field($_POST['tcm-echo']),
        'tcm_count' => sanitize_text_field($_POST['tcm-show-count']),
        'tcm_exclude' => sanitize_text_field($_POST['tcm-exclude']),
        'tcm_smallest' => sanitize_text_field($_POST['tcm-s-font']),
        'tcm_largest' => sanitize_text_field($_POST['tcm-l-font']),
        'tcm_limit' => sanitize_text_field($_POST['tcm-limit']),
        'tcm_post_type' => sanitize_text_field($_POST['tcm-post-type']),
        'tcm_separator' => sanitize_text_field($_POST['tcm-separator']),
        'tcm_modified' => sanitize_text_field($tcm_current),
        'tcm_style' => sanitize_text_field($_POST['tcm-styles'])
      );

      if( $_POST['tcm-styles'] == 1 ){
        $tcm_cloud['tcm_border_top'] = $_POST['tcm-border-top'];
        
        if( $_POST['tcm-border-top'] == 'on' ){
          $tcm_cloud['tcm_border_width_top'] = $_POST['tcm-border-width-top'];
          $tcm_cloud['tcm_border_style_top'] = $_POST['tcm-border-style-top'];
          $tcm_cloud['tcm_border_color_top'] = $_POST['tcm-border-color-top'];
        }

        $tcm_cloud['tcm_border_bottom'] = $_POST['tcm-border-bottom'];

        if( $_POST['tcm-border-bottom'] == 'on' ){
          $tcm_cloud['tcm_border_width_bottom'] = $_POST['tcm-border-width-bottom'];
          $tcm_cloud['tcm_border_style_bottom'] = $_POST['tcm-border-style-bottom'];
          $tcm_cloud['tcm_border_color_bottom'] = $_POST['tcm-border-color-bottom'];
        }

        $tcm_cloud['tcm_border_left'] = $_POST['tcm-border-left'];

        if( $_POST['tcm-border-left'] == 'on' ){
          $tcm_cloud['tcm_border_width_left'] = $_POST['tcm-border-width-left'];
          $tcm_cloud['tcm_border_style_left'] = $_POST['tcm-border-style-left'];
          $tcm_cloud['tcm_border_color_left'] = $_POST['tcm-border-color-left'];
        }

        $tcm_cloud['tcm_border_right'] = $_POST['tcm-border-right'];

        if( $_POST['tcm-border-right'] == 'on' ){
          $tcm_cloud['tcm_border_width_right'] = $_POST['tcm-border-width-right'];
          $tcm_cloud['tcm_border_style_right'] = $_POST['tcm-border-style-right'];
          $tcm_cloud['tcm_border_color_right'] = $_POST['tcm-border-color-right'];
        }

        $tcm_cloud['tcm_separator_check'] = $_POST['tcm-separator-check'];
        $tcm_cloud['tcm_text_color'] = $_POST['tcm-text-color'];
        $tcm_cloud['tcm_text_hover_color'] = $_POST['tcm-text-hover-color'];
        $tcm_cloud['tcm_bg_color'] = $_POST['tcm-bg-color'];

        $tcm_cloud['tcm_padding_top'] = $_POST['tcm-padding-top'];
        $tcm_cloud['tcm_padding_bottom'] = $_POST['tcm-padding-bottom'];
        $tcm_cloud['tcm_padding_left'] = $_POST['tcm-padding-left'];
        $tcm_cloud['tcm_padding_right'] = $_POST['tcm-padding-right'];

        $tcm_cloud['tcm_margin_top'] = $_POST['tcm-margin-top'];
        $tcm_cloud['tcm_margin_bottom'] = $_POST['tcm-margin-bottom'];
        $tcm_cloud['tcm_margin_left'] = $_POST['tcm-margin-left'];
        $tcm_cloud['tcm_margin_right'] = $_POST['tcm-margin-right'];

        $tcm_cloud['tcm_border_radius_top_left'] = $_POST['tcm-border-radius-top-left'];
        $tcm_cloud['tcm_border_radius_top_right'] = $_POST['tcm-border-radius-top-right'];
        $tcm_cloud['tcm_border_radius_bottom_left'] = $_POST['tcm-border-radius-bottom-left'];
        $tcm_cloud['tcm_border_radius_bottom_right'] =  $_POST['tcm-border-radius-bottom-right'];

        $tcm_cloud['tcm_separator_decoration'] = $_POST['tcm-separator-decoration'];
        $tcm_cloud['tcm_text_decoration'] = $_POST['tcm-text-decoration'];

        $tcm_cloud['tcm_text_decoration_line'] = $_POST['tcm-text-decoration-line'];
        $tcm_cloud['tcm_text_decoration_style'] = $_POST['tcm-text-decoration-style'];
        $tcm_cloud['tcm_text_decoration_color'] = $_POST['tcm-text-decoration-color'];
      }

      /*echo "<pre>";
      print_r($tcm_cloud);
      echo "</pre>";
      exit;*/

      $tcm_serialized_cloud = maybe_serialize( $tcm_cloud );

      $temp = update_option( $tcm_option_name, $tcm_serialized_cloud );
      if( $temp == 1 ){
        $tcm_nonce_field = wp_create_nonce( 'tcm-nonce-2' );

        $header_url = admin_url()."admin.php?page=tcm_add_new&action=edit&id=".$tcm_id."&tcm_msg=".$_POST['tcm-title']."&tcm_status=Updated";
?>
        <script>
          window.location.href = "<?php echo $header_url; ?>";
        </script>
<?php
      }else{
?>
        <div class="error notice">
            <p><?php esc_html_e('Error : Something went wrong...', 'ee-email-shortcode'); ?></p>
        </div>
<?php
      }
    }

    else if( isset($_POST['tcm-publish']) ){

      $tcm_option_name = $_POST['tcm-slug'];

      $tcm_current = date("Y/m/d g:i:s a");
      $tcm_cloud = array(
        'tcm_title' => sanitize_text_field($_POST['tcm-title']),
        'tcm_taxonomy' => sanitize_text_field($_POST['tcm-taxonomy']),
        'tcm_order_by' => sanitize_text_field($_POST['tcm-order-by']),
        'tcm_order' => sanitize_text_field($_POST['tcm-order']),
        'tcm_unit' => sanitize_text_field($_POST['tcm-measure']),
        'tcm_format' => sanitize_text_field($_POST['tcm-format']),
        'tcm_link' => sanitize_text_field($_POST['tcm-link']),
        'tcm_echo' => sanitize_text_field($_POST['tcm-echo']),
        'tcm_count' => sanitize_text_field($_POST['tcm-show-count']),
        'tcm_exclude' => sanitize_text_field($_POST['tcm-exclude']),
        'tcm_smallest' => sanitize_text_field($_POST['tcm-s-font']),
        'tcm_largest' => sanitize_text_field($_POST['tcm-l-font']),
        'tcm_limit' => sanitize_text_field($_POST['tcm-limit']),
        'tcm_post_type' => sanitize_text_field($_POST['tcm-post-type']),
        'tcm_separator' => sanitize_text_field($_POST['tcm-separator']),
        'tcm_modified' => sanitize_text_field($tcm_current),
        'tcm_style' => sanitize_text_field($_POST['tcm-styles'])
      );

      if( $_POST['tcm-styles'] == 1 ){
        $tcm_cloud['tcm_border_top'] = $_POST['tcm-border-top'];

        if( $_POST['tcm-border-top'] == 'on' ){
          $tcm_cloud['tcm_border_width_top'] = $_POST['tcm-border-width-top'];
          $tcm_cloud['tcm_border_style_top'] = $_POST['tcm-border-style-top'];
          $tcm_cloud['tcm_border_color_top'] = $_POST['tcm-border-color-top'];
        }

        $tcm_cloud['tcm_border_bottom'] = $_POST['tcm-border-bottom'];

        if( $_POST['tcm-border-bottom'] == 'on' ){
          $tcm_cloud['tcm_border_width_bottom'] = $_POST['tcm-border-width-bottom'];
          $tcm_cloud['tcm_border_style_bottom'] = $_POST['tcm-border-style-bottom'];
          $tcm_cloud['tcm_border_color_bottom'] = $_POST['tcm-border-color-bottom'];
        }

        $tcm_cloud['tcm_border_left'] = $_POST['tcm-border-left'];

        if( $_POST['tcm-border-left'] == 'on' ){
          $tcm_cloud['tcm_border_width_left'] = $_POST['tcm-border-width-left'];
          $tcm_cloud['tcm_border_style_left'] = $_POST['tcm-border-style-left'];
          $tcm_cloud['tcm_border_color_left'] = $_POST['tcm-border-color-left'];
        }

        $tcm_cloud['tcm_border_right'] = $_POST['tcm-border-right'];

        if( $_POST['tcm-border-right'] == 'on' ){
          $tcm_cloud['tcm_border_width_right'] = $_POST['tcm-border-width-right'];
          $tcm_cloud['tcm_border_style_right'] = $_POST['tcm-border-style-right'];
          $tcm_cloud['tcm_border_color_right'] = $_POST['tcm-border-color-right'];
        }

        $tcm_cloud['tcm_separator_check'] = $_POST['tcm-separator-check'];
        $tcm_cloud['tcm_text_color'] = $_POST['tcm-text-color'];
        $tcm_cloud['tcm_text_hover_color'] = $_POST['tcm-text-hover-color'];
        $tcm_cloud['tcm_bg_color'] = $_POST['tcm-bg-color'];

        $tcm_cloud['tcm_padding_top'] = $_POST['tcm-padding-top'];
        $tcm_cloud['tcm_padding_bottom'] = $_POST['tcm-padding-bottom'];
        $tcm_cloud['tcm_padding_left'] = $_POST['tcm-padding-left'];
        $tcm_cloud['tcm_padding_right'] = $_POST['tcm-padding-right'];

        $tcm_cloud['tcm_margin_top'] = $_POST['tcm-margin-top'];
        $tcm_cloud['tcm_margin_bottom'] = $_POST['tcm-margin-bottom'];
        $tcm_cloud['tcm_margin_left'] = $_POST['tcm-margin-left'];
        $tcm_cloud['tcm_margin_right'] = $_POST['tcm-margin-right'];

        $tcm_cloud['tcm_border_radius_top_left'] = $_POST['tcm-border-radius-top-left'];
        $tcm_cloud['tcm_border_radius_top_right'] = $_POST['tcm-border-radius-top-right'];
        $tcm_cloud['tcm_border_radius_bottom_left'] = $_POST['tcm-border-radius-bottom-left'];
        $tcm_cloud['tcm_border_radius_bottom_right'] =  $_POST['tcm-border-radius-bottom-right'];


        $tcm_cloud['tcm_separator_decoration'] = $_POST['tcm-separator-decoration'];
        $tcm_cloud['tcm_text_decoration'] = $_POST['tcm-text-decoration'];

        $tcm_cloud['tcm_text_decoration_line'] = $_POST['tcm-text-decoration-line'];
        $tcm_cloud['tcm_text_decoration_style'] = $_POST['tcm-text-decoration-style'];
        $tcm_cloud['tcm_text_decoration_color'] = $_POST['tcm-text-decoration-color'];
      }

      /*echo "<pre>";
      print_r($tcm_cloud);
      echo "</pre>";
      exit;*/

      $tcm_serialized_cloud = maybe_serialize( $tcm_cloud );
      $temp = add_option( $tcm_option_name, $tcm_serialized_cloud, '', 'yes' );
      if($temp == 1){
        $tcm_nonce_field = wp_create_nonce( 'tcm-nonce-2' );

        global $wpdb;
        $edit_result=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."options");  

        $edit_option_id = '';

        for($i=count($edit_result)-1; $i > 0; $i--){
          $edit_option_name = $edit_result[$i]->option_name;
          if( $edit_option_name == $tcm_option_name ){
            $edit_option_id = $edit_result[$i]->option_id;
            break;
          }
        }

        $header_url = admin_url()."admin.php?page=tcm_add_new&action=edit&id=".$edit_option_id."&tcm_msg=".$_POST['tcm-title']."&tcm_status=Inserted&_wpnonce=".$tcm_nonce_field;
?>
      <script>
        window.location.href = "<?php echo $header_url; ?>";
      </script>
<?php
      }else{
?>
        <div class="error notice">
            <p><?php esc_html_e('Error : Something went wrong...', 'ee-email-shortcode'); ?></p>
        </div>
<?php
      }
    }
  }
?>
