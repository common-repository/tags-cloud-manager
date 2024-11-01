<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://about.me/aakifkadiwala
 * @since      1.0.0
 *
 * @package    Tcm
 * @subpackage Tcm/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tcm
 * @subpackage Tcm/admin
 * @author     Aakif Kadiwala <aakifkadiwala1995@gmail.com>
 */
class Tcm_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tcm_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tcm_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tcm-admin.css', array(), $this->version, 'all' );
		if( isset($_REQUEST['page']) && $_REQUEST['page'] == 'tcm_add_new'){
			wp_enqueue_style( 'boostrap-min-css', plugin_dir_url( __FILE__ ) . 'css/boostrap.min.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tcm_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tcm_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tcm-admin.js', array( 'jquery' ), $this->version, false );
		if( isset($_REQUEST['page']) && $_REQUEST['page'] == 'tcm_add_new'){
			wp_enqueue_script( 'boostrap-min-js', plugin_dir_url( __FILE__ ) . 'js/boostrap.min.js', array( 'jquery' ), $this->version, false );
		}

	}

	public function tcm_admin_menu(){
		$capability = apply_filters( 'tcm_required_capabilities', 'manage_options' );
		$parent_slug = 'tcm_main_menu';
		global $wpdb;

		add_menu_page( __( 'Tags Cloud Manager', 'tcm' ), __( 'Tags Cloud Manager', 'tcm' ), $capability, $parent_slug, 'tcm_main_menu', 'dashicons-tagcloud', '60');

		add_submenu_page( $parent_slug, __( 'Tags Cloud', 'tcm' ), __( 'Tags Cloud', 'tcm' ), $capability, 'tcm_clouds', 'tcm_clouds' );
		add_submenu_page( $parent_slug, __( 'Add New', 'tcm' ), __( 'Add New', 'tcm' ), $capability, 'tcm_add_new', 'tcm_add_new' );

		add_submenu_page( $parent_slug, __( 'Extras', 'tcm' ), __( '<span class="tcm_menu-title-tag"><b>Extras</b></span>', 'tcm' ), $capability, 'tcm_help', 'tcm_help' );
		add_submenu_page( $parent_slug, __( 'About', 'tcm' ), __( 'About', 'tcm' ), $capability, 'tcm_help', 'tcm_help' );

		remove_submenu_page( $parent_slug, 'tcm_main_menu');
	}

	public function tcm_manage_cloud()
	{
		$cloud_slug = '';
	  if(isset($_POST['cloud_title']) && isset($_POST['cloud_taxonomy']))
	  {
	    // do your stuff and return count;
	    if($_POST['cloud_title'] && $_POST['cloud_taxonomy'])
	    {
	      if( taxonomy_exists( $_POST['cloud_taxonomy'] ) ){
	        global $wpdb;
	        $result=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."options WHERE option_name LIKE '%-tcm-".$_POST['cloud_taxonomy']."-%' ORDER BY option_name DESC " );
	        $total_rec = $wpdb->num_rows;
	        if($total_rec > 0){
	          $temp_option_name = $result[0]->option_name;
	          $temp_option_name = explode('-',$temp_option_name);
	          $temp_option_name = ($temp_option_name[0]*1)+1;
	          $cloud_slug = $temp_option_name;
	        }else{
	          //$cloud_slug = '[tcm id="1" title="'.$_POST['cloud_title'].'" taxonomy="'.$_POST['cloud_taxonomy'].'"]'; 
	          $cloud_slug = 1;
	        }
	      }else{
	        $cloud_slug = 'tcm-wrong-taxonomy';
	      }
	    }

	    echo $cloud_slug;

	  }else{
	      echo $cloud_slug;
	  }
	  exit;
	}

	public function tcm_get_posttype()
	{
		$taxonomy = $_POST['taxonomy'];

		$post_types = get_taxonomy( $taxonomy )->object_type;

		foreach ($post_types as $key => $value) {
			$obj = get_post_type_object( $value );
			$post_type = $obj->labels->name;
			echo '<option value="'.$value.'"> ' . $post_type . ' </option>'; 
		}

		exit;
	}

	public function tcm_clouds ($atts) {
		if (!empty($atts)) {
			$tcm_shortcode_id = $atts['id'];
			$tcm_shortcode_title = $atts['title'];
			$tcm_shortcode_taxonomy = $atts['taxonomy'];

			$shortcode = $tcm_shortcode_id.'-tcm-'.$tcm_shortcode_taxonomy.'-';

		 	global $wpdb;
	        $result=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."options WHERE option_name='".$shortcode."'" );
	        $total_rec = $wpdb->num_rows;
	        if($total_rec > 0){
	        	$tcm_result = maybe_unserialize( get_option($result[0]->option_name) );
	        	$edit_get_option = maybe_unserialize( get_option($result[0]->option_name) );
	        	/*echo "<pre>";
	        	print_r($tcm_result);
	        	echo "</pre>";*/

	        	$tcm_separator = '';

	        	if( $tcm_result['tcm_separator_check'] == 'on' && $tcm_result['tcm_separator'] ){
	        		$tcm_separator = '<a href="#" class="tcm_separator">'.$tcm_result['tcm_separator'].'</a>';
	        	}

	        	$tcm_defaults = array(
			        'smallest' => $tcm_result['tcm_smallest'],
			        'largest' => $tcm_result['tcm_largest'],
			        'unit' => $tcm_result['tcm_unit'],
			        'number' => $tcm_result['tcm_limit'],
			        'format' => $tcm_result['tcm_format'],
			        'separator' => $tcm_separator,
			        'orderby' => $tcm_result['tcm_order_by'],
			        'order' => $tcm_result['tcm_order'],
			        'exclude' => $tcm_result['tcm_exclude'],
			        'include' => '',
			        'link' => $tcm_result['tcm_link'],
			        'post_type' => $tcm_result['tcm_post_type'],
			        'taxonomy' => $tcm_result['tcm_taxonomy'],
			        'echo' => $tcm_result['tcm_echo'],
			        'show_count' => $tcm_result['tcm_count'],
			    );

			    // CUSTOM STYLE
			    
			    $edit_tcm_style = $edit_get_option['tcm_style'];
			    if( $edit_tcm_style == 1 ){
			      $edit_tcm_border_top = $edit_get_option['tcm_border_top'];

			      if( $edit_get_option['tcm_border_top'] == 'on' ){
			        $edit_tcm_border_width_top = $edit_get_option['tcm_border_width_top'];
			        $edit_tcm_border_style_top = $edit_get_option['tcm_border_style_top'];
			        $edit_tcm_border_color_top = $edit_get_option['tcm_border_color_top'];
			        $border = 1;
			      }

			      $edit_tcm_border_bottom = $edit_get_option['tcm_border_bottom'];

			      if( $edit_get_option['tcm_border_bottom'] == 'on' ){
			        $edit_tcm_border_width_bottom = $edit_get_option['tcm_border_width_bottom'];
			        $edit_tcm_border_style_bottom = $edit_get_option['tcm_border_style_bottom'];
			        $edit_tcm_border_color_bottom = $edit_get_option['tcm_border_color_bottom'];
			        $border = 1;
			      }

			      $edit_tcm_border_left = $edit_get_option['tcm_border_left'];

			      if( $edit_get_option['tcm_border_left'] == 'on' ){
			        $edit_tcm_border_width_left = $edit_get_option['tcm_border_width_left'];
			        $edit_tcm_border_style_left = $edit_get_option['tcm_border_style_left'];
			        $edit_tcm_border_color_left = $edit_get_option['tcm_border_color_left'];
			        $border = 1;
			      }

			      $edit_tcm_border_right = $edit_get_option['tcm_border_right'];

			      if( $edit_get_option['tcm_border_right'] == 'on' ){
			        $edit_tcm_border_width_right = $edit_get_option['tcm_border_width_right'];
			        $edit_tcm_border_style_right = $edit_get_option['tcm_border_style_right'];
			        $edit_tcm_border_color_right = $edit_get_option['tcm_border_color_right'];
			        $border = 1;
			      }

			      $edit_tcm_separator_check = ($edit_get_option['tcm_separator_check']) ? $edit_get_option['tcm_separator_check'] : 'off';
			      $edit_tcm_text_color = $edit_get_option['tcm_text_color'];
			      $edit_tcm_text_hover_color = $edit_get_option['tcm_text_hover_color'];
			      $edit_tcm_bg_color = $edit_get_option['tcm_bg_color'];

			      $edit_tcm_padding_top = $edit_get_option['tcm_padding_top'];
			      $edit_tcm_padding_bottom = $edit_get_option['tcm_padding_bottom'];
			      $edit_tcm_padding_left = $edit_get_option['tcm_padding_left'];
			      $edit_tcm_padding_right = $edit_get_option['tcm_padding_right'];

			      $edit_tcm_margin_top = $edit_get_option['tcm_margin_top'];
			      $edit_tcm_margin_bottom = $edit_get_option['tcm_margin_bottom'];
			      $edit_tcm_margin_left = $edit_get_option['tcm_margin_left'];
			      $edit_tcm_margin_right = $edit_get_option['tcm_margin_right'];

			      $edit_tcm_border_radius_top_left = ($edit_get_option['tcm_border_radius_top_left']) ? $edit_get_option['tcm_border_radius_top_left'] : 0;
			      $edit_tcm_border_radius_top_right = ($edit_get_option['tcm_border_radius_top_right']) ? $edit_get_option['tcm_border_radius_top_right'] : 0;
			      $edit_tcm_border_radius_bottom_left = ($edit_get_option['tcm_border_radius_bottom_left']) ? $edit_get_option['tcm_border_radius_bottom_left'] : 0;
			      $edit_tcm_border_radius_bottom_right = ($edit_get_option['tcm_border_radius_bottom_right']) ? $edit_get_option['tcm_border_radius_bottom_right'] : 0;


			      $edit_tcm_separator_decoration = ($edit_get_option['tcm_separator_decoration']) ? $edit_get_option['tcm_separator_decoration'] : 'off' ;
			      $edit_tcm_text_decoration = ($edit_get_option['tcm_text_decoration']) ? $edit_get_option['tcm_text_decoration'] : 'off';
			      
			      if( $edit_tcm_text_decoration == 'on' ){
			        $edit_tcm_text_decoration_line = $edit_get_option['tcm_text_decoration_line'];
			        $edit_tcm_text_decoration_style = $edit_get_option['tcm_text_decoration_style'];
			        $edit_tcm_text_decoration_color = $edit_get_option['tcm_text_decoration_color'];
			      }

				?>
			  	  <style type="text/css">
			  	  	.tcm-cloud li{
			  	  		list-style: none;
			  	  	}
				    .tcm-cloud a{

				      margin : <?php echo $edit_tcm_margin_top.'px '.$edit_tcm_margin_right.'px '.$edit_tcm_margin_bottom.'px '.$edit_tcm_margin_left.'px'; ?>;

				      padding : <?php echo $edit_tcm_padding_top.'px '.$edit_tcm_padding_right.'px '.$edit_tcm_padding_bottom.'px '.$edit_tcm_padding_left.'px'; ?>;

				      <?php if( $edit_get_option['tcm_border_top'] == 'on' ){ ?>
				        border-top : <?php echo $edit_tcm_border_width_top.'px '.$edit_tcm_border_style_top.' '.$edit_tcm_border_color_top;  ?>;
				      <?php } ?>

				      <?php if( $edit_get_option['tcm_border_bottom'] == 'on' ){ ?>
				        border-bottom : <?php echo $edit_tcm_border_width_bottom.'px '.$edit_tcm_border_style_bottom.' '.$edit_tcm_border_color_bottom;  ?>;
				      <?php } ?>

				      <?php if( $edit_get_option['tcm_border_left'] == 'on' ){ ?>
				        border-left : <?php echo $edit_tcm_border_width_left.'px '.$edit_tcm_border_style_left.' '.$edit_tcm_border_color_left;  ?>;
				      <?php } ?>

				      <?php if( $edit_get_option['tcm_border_right'] == 'on' ){ ?>
				        border-right : <?php echo $edit_tcm_border_width_right.'px '.$edit_tcm_border_style_right.' '.$edit_tcm_border_color_right;  ?>;
				      <?php } ?>

				      border-top-left-radius : <?php echo $edit_tcm_border_radius_top_left.'px'; ?>;
				      border-top-right-radius : <?php echo $edit_tcm_border_radius_top_right.'px'; ?>;
				      border-bottom-left-radius : <?php echo $edit_tcm_border_radius_bottom_left.'px'; ?>;
				      border-bottom-right-radius : <?php echo $edit_tcm_border_radius_bottom_right.'px'; ?>;

				      <?php if( $edit_tcm_text_decoration == 'on' ){ ?>
				        text-decoration-line: <?php echo $edit_tcm_text_decoration_line; ?>;
				        text-decoration-style: <?php echo $edit_tcm_text_decoration_style; ?>;
				        text-decoration-color: <?php echo $edit_tcm_text_decoration_color; ?>;
				      <?php }else{ ?>
				        text-decoration: none;
				      <?php } ?>

				      color: <?php echo $edit_tcm_text_color; ?>;
				      background-color: <?php echo $edit_tcm_bg_color; ?>;

				      <?php if($tcm_result['tcm_format'] != 'list'){ ?>
				      	float: left;
				      <?php }else{ ?>
				      	list-style: none;
				      <?php } ?>
				      display: inline-block;

				    }

				<?php if($edit_tcm_text_hover_color){ ?>
					.tcm-cloud a:hover{
						color: <?php echo $edit_tcm_text_hover_color; ?>;
					}
				<?php } ?>

			    <?php
			      if( $edit_tcm_separator_decoration != 'on' && $tcm_separator ){
			    ?>
			        .tcm-cloud a.tcm_separator{
			          border : none;
			          padding : 0px;
			          margin : 0px;

			          float: left;
			          display: inline-block;     
			        }
			    <?php
			      }
			    ?>
			      </style>
				<?php

			    }

			    /*echo "<pre>";
	        	print_r($tcm_defaults);
	        	echo "</pre>";*/

			 	$ii=0;
			    //$tags = get_terms( $args['taxonomy'], array_merge( $args, array( 'orderby' => 'count', 'order' => 'DESC') ) ); // Always query top tags
			    $tags = get_terms( array( 'orderby' => $tcm_result['tcm_order_by'], 'order' => $tcm_result['tcm_order'], 'taxonomy' => $tcm_result['tcm_taxonomy']) );
			 

			    if ( empty( $tags ) || is_wp_error( $tags ) )
			        return;
			 
			    foreach ( $tags as $key => $tag ) {
			        if ( 'edit' == $tcm_defaults['link'] )
			            $link = get_edit_term_link( $tag->term_id, $tag->taxonomy, $tcm_defaults['post_type'] );
			        else
			            $link = get_term_link( intval($tag->term_id), $tag->taxonomy );
			        if ( is_wp_error( $link ) )
			            return;
			 
			        $tags[ $key ]->link = $link;
			        $tags[ $key ]->id = $tag->term_ixd;
			    }
			 
			 	$tcm_return = '<div class="tcm_'.$tcm_shortcode_taxonomy.'_'.$tcm_shortcode_id.' tcm-container">';
			 	if( $tcm_shortcode_title == 'true' ){
			 		$tcm_return .= '<div class="tcm_cloud_title tcm-title"><h2>'.$tcm_result['tcm_title'].'</h2></div>';
			 		$tcm_return .= '<div class="tcm_cloud_content tcm-cloud">';
			 		$tcm_return .= wp_tag_cloud( $tcm_defaults );
			 		/*$tcm_return .= wp_generate_tag_cloud( $tags, $tcm_defaults ); */
			 		$tcm_return .= '</div>';
			 	}else{
			 		$tcm_return .= '<div class="tcm_cloud_content tcm-cloud">';
			 		$tcm_return .= wp_tag_cloud( $tcm_defaults );
			 		/*$tcm_return .= wp_generate_tag_cloud( $tags, $tcm_defaults ); */
			 		$tcm_return .= '</div>';
			 	}
			 	$tcm_return .= '</div>';
			    

			    return $tcm_return;
	        }else{
	        	$tcm_return = '<div class="tcm-container">';
		 		$tcm_return .= '<div class="tcm_shortcode_not_found tcm-error">';
	        	$tcm_return .= '"'.$tcm_shortcode_title.'" Shortcode not found';
	        	$tcm_return .= '</div>';
	        	$tcm_return .= '</div>';
	        	return $tcm_return;
	        }
		}
	}

	public function tcm_wp_title($title) {
		if( isset($_REQUEST['page']) && isset($_REQUEST['action']) && $_REQUEST['page'] == 'tcm_add_new' && $_REQUEST['action'] == 'edit' ){
			$title = 'Edit';
		} else if ( isset($_REQUEST['page']) && !isset($_REQUEST['action']) && $_REQUEST['page'] == 'tcm_add_new' ){
			$title = 'Add New';
		} else if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'tcm_clouds' ){
			$title = 'Tag Clouds';
		} else if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'tcm_help' ){
			$title = 'Help';
		}
	    return $title;
	}

	public function tcm_change_footer_admin () {
		echo 'Developed by <a href="https://profiles.wordpress.org/kadiwala" target="_blank">Aakif Kadiwala</a> & <a href="https://profiles.wordpress.org/kaumudi" target="_blank">Kaumudi Parmar</a></p>';
	}
}
