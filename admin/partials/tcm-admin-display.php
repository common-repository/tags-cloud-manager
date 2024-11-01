<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://about.me/aakifkadiwala
 * @since      1.0.0
 *
 * @package    Tcm
 * @subpackage Tcm/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php
	if( isset($_REQUEST['action']) && isset($_REQUEST['id']) && $_REQUEST['action'] == 'delete' ){
		if ( !isset( $_REQUEST['_wpnonce'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'tcm_nonce' ) ) {
?>
			<div class="error notice">
		        <p><?php esc_html_e('Error : Something went wrong ..!', 'tcm'); ?></p>
		    </div>
<?php
		}else{
			global $wpdb;

			$result=$wpdb->get_results("SELECT option_name FROM ".$wpdb->prefix."options WHERE option_id = ".$_REQUEST['id']);

			if( $result ){
				$tcm_option_name = $result[0]->option_name;
				$tcm_get_option = maybe_unserialize( get_option( $tcm_option_name ) );

				$table = $wpdb->prefix."options";
				$where=array(
					'option_id' => $_REQUEST['id'],
				);

				if($wpdb->delete($table, $where)){
?>
					<div class="updated notice">
			            <p><?php esc_html_e('"'.$tcm_get_option['tcm_title'].'" Cloud is Successfully deleted', 'tcm'); ?></p>
			        </div>
<?php
				}		
			}else{
?>
				<div class="error notice">
		        	<p><?php esc_html_e('Error : Already Deleted ..!', 'tcm'); ?></p>
		    	</div>	
<?php
			}
		}
	}
	
	if( isset($_REQUEST['tcm_msg']) && isset($_REQUEST['tcm_status']) ){
		if ( !isset( $_REQUEST['_wpnonce'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'tcm-nonce-2' ) ) {
?>
			<div class="error notice">
		        <p><?php esc_html_e('Error : Something went wrong ..!', 'tcm'); ?></p>
		    </div>
<?php
		}else{

?>
			<div class="updated notice">
	            <p><?php esc_html_e('"'.$_REQUEST['tcm_msg'].'" Cloud is Successfully '.strtolower($_REQUEST['tcm_status']), 'tcm'); ?></p>
	        </div>
<?php
            unset($_REQUEST['tcm_msg']);
            unset($_REQUEST['tcm_status']);
		}
	}
	
?>



<?php
	if ( ! class_exists( 'WP_List_Table' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
	}

class E_Shortcode_List_Table extends WP_List_Table {
    
    var $example_data;

    function __construct(){
        global $status, $page, $wpdb;
    
        $result=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."options WHERE option_name LIKE '%-tcm-%' ");
    
        $total_rec = $wpdb->num_rows;
    
        for($i=0; $i<$total_rec; $i++){
        	$tcm_temp_id[$i] = $result[$i]->option_id;
    		$tcm_temp[$i] = maybe_unserialize( get_option($result[$i]->option_name) );
        }
    
        for($i=0; $i<$total_rec; $i++){
    		$start  = date_create($tcm_temp[$i]['tcm_modified']);
    		$temp 	= date("Y/m/d g:i:s a");
    		$end 	= date_create($temp); // Current time and date
    		$diff  	= date_diff( $start, $end );
    		$tcm_diff;

    
    		if($diff->y > 0){	$tcm_diff = esc_html_e($diff->y." Years ago", 'tcm');	}
    		elseif($diff->m > 0){	if($diff->m > 1){ $tcm_diff = esc_html__($diff->m." Months ago", 'tcm'); }else{ $tcm_diff = esc_html__($diff->m." Month ago", 'tcm'); }	}
    		elseif($diff->d > 0){	if($diff->d > 1){ $tcm_diff = esc_html__($diff->d." Days ago", 'tcm'); }else{ $tcm_diff = esc_html__($diff->d." Day ago", 'tcm'); }	}
    		elseif($diff->h > 0){	if($diff->h > 1){ $tcm_diff = esc_html__($diff->h." Hours ago", 'tcm'); }else{ $tcm_diff = esc_html__($diff->h." Hour ago", 'tcm'); }	}
    		elseif($diff->i > 0){	if($diff->i > 1){ $tcm_diff = esc_html__($diff->i." Minutes ago", 'tcm'); }else{ $tcm_diff = esc_html__($diff->i." Minute ago", 'tcm'); }	}
    		elseif($diff->s > 0){	if($diff->s > 1){ $tcm_diff = esc_html__($diff->s." Seconds ago", 'tcm'); }else{ $tcm_diff = esc_html__($diff->s." Second ago", 'tcm'); }	}
    		else{	$tcm_diff = "<span aria-hidden='true'>—</span>";	}
    
    		$this->example_data[$i]['ID']    			= $tcm_temp_id[$i];

    		$temp = explode('-',$result[$i]->option_name);

    		$this->example_data[$i]['tcm_shortcode']	= '[tcm id="'.$temp[0].'" title="false" taxonomy="'.$tcm_temp[$i]["tcm_taxonomy"].'"]';

    		$this->example_data[$i]['tcm_shortcode_2']	= $this->example_data[$i]['tcm_shortcode'].'<span style="color:silver"><br/><b> PostType: </b>'.$tcm_temp[$i]['tcm_post_type'].'&nbsp;&nbsp;&nbsp; <b>Tag: </b>'.$tcm_temp[$i]['tcm_taxonomy'].'</span><span style="color:silver"><br/> Modified '.$tcm_diff.'</span>';

            $this->example_data[$i]['title']		= $tcm_temp[$i]['tcm_title'];
            $this->example_data[$i]['tcm_taxonomy']  	= $tcm_temp[$i]['tcm_taxonomy'];

			if($tcm_temp[$i]['tcm_limit'] > 0){
            	$this->example_data[$i]['tcm_limit']  	= $tcm_temp[$i]['tcm_limit'];
            }else{
            	$this->example_data[$i]['tcm_limit']  	= 'All';
            }

            if($tcm_temp[$i]['tcm_count'] == '1'){
            	$this->example_data[$i]['tcm_count']  	= 'Yes';
            }else{
            	$this->example_data[$i]['tcm_count']  	= 'No';
            }

// Attributes
            $this->example_data[$i]['tcm_attr']		= '<b>Show Count: </b>'.$this->example_data[$i]['tcm_count'].'<br/><b>Order: </b>'.$tcm_temp[$i]['tcm_order_by'].' - '.$tcm_temp[$i]['tcm_order'].'<br/><b>Format: </b>'.$tcm_temp[$i]['tcm_format'].' with '.$tcm_temp[$i]['tcm_link'].' link';

            $this->example_data[$i]['tcm_separator']  	= $tcm_temp[$i]['tcm_separator'];

            if( $this->example_data[$i]['tcm_separator'] ){
            	$tcm_temp_separator = '<b>Separator: </b>'.$this->example_data[$i]['tcm_separator'];
            }else{
            	$tcm_temp_separator ='';
            }
            
// Attributes
            $this->example_data[$i]['tcm_attr_2']	= '<b>Cloud Limit: </b>'.$this->example_data[$i]['tcm_limit'].'<br/><b>Font Size: </b>'.$tcm_temp[$i]['tcm_smallest'].$tcm_temp[$i]['tcm_unit'].' to '.$tcm_temp[$i]['tcm_largest'].$tcm_temp[$i]['tcm_unit'].'<br/>'.$tcm_temp_separator;

            $this->example_data[$i]['tcm_modified_date']	= $tcm_temp[$i]['tcm_modified'];
        }
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'Tag Cloud',     //singular name of the listed records
            'plural'    => 'Tag Clouds',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );

    }


   function column_default($item, $column_name){
        switch($column_name){
        	case 'tcm_shortcode_2':
            case 'tcm_attr':
            case 'tcm_attr_2':
                return $item[$column_name];
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }

    function column_title($item){
        
        $tcm_nonce_field = wp_create_nonce( 'tcm_nonce' );

        //Build row actions
        $actions['edit'] = sprintf('<a href="?page=%s&action=%s&id=%s&_wpnonce=%s">Edit</a>','tcm_add_new','edit',$item['ID'],$tcm_nonce_field);

        $actions['delete'] = sprintf('<a href="?page=%s&action=%s&id=%s&_wpnonce=%s" onCLick="return confirm(\'%s\')">Delete</a>','tcm_clouds','delete',$item['ID'],$tcm_nonce_field,'Are you sure you want to Delete?');
        
        //Return the title contents
        return sprintf('%1$s<span style="color:silver"><br/> %2$s - %3$s</span>%4$s',
            /*$1%s*/ $item['title'],
            /*$2%s*/ $item['tcm_limit'],
            /*$3%s*/ $item['tcm_taxonomy'],
            /*$4%s*/ $this->row_actions($actions)
        );
    }

    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item['ID']                //The value of the checkbox should be the record's id
        );
    }

    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'title'     => 'Title',
            'tcm_shortcode_2'     => 'Shortcode',
            'tcm_attr'	=> 'Attributes',
            'tcm_attr_2'	=> '',
        );
        return $columns;
    }

    function get_sortable_columns() {
        $sortable_columns = array(
            'title'     => array('title',false),     //true means it's already sorted
            'tcm_shortcode_2'  => array('tcm_shortcode',false),
        );
        return $sortable_columns;
    }

    function get_bulk_actions() {
        /*$actions = array(
        	'bulk_delete'    => 'Delete'
        );
        return $actions;*/
    }

    function process_bulk_action() {
        
        $tcm_nonce_field = wp_create_nonce( 'tcm_nonce' );

        //Detect when a bulk action is being triggered...
        if( 'bulk_delete'===$this->current_action() ) {

            $tag_clouds = $_REQUEST['tagcloud'];

            $cnt_i = 0;

            if( $tag_clouds ){
                foreach ($tag_clouds as $value) {
                    global $wpdb;

                    $result=$wpdb->get_results("SELECT option_name FROM ".$wpdb->prefix."options WHERE option_id = ".$value);

                    if( $result ){

                        $table = $wpdb->prefix."options";
                        $where=array(
                            'option_id' => $value,
                        );

                        if($wpdb->delete($table, $where)){
                            $cnt_i++;
                        }       
                    }else{
    ?>
                        <div class="error notice">
                            <p><?php esc_html_e('Error : Already Deleted ..!', 'tcm'); ?></p>
                        </div>  
    <?php
                 }
                
              }
            }
            if( $cnt_i > 0 ){
    ?>
                <div class="updated notice">
                    <p><?php esc_html_e('"'.$cnt_i.'" Cloud(s) is Successfully deleted', 'tcm'); ?></p>
                </div>
    <?php
            
            }
        }
        
    }

    function prepare_items() {
        global $wpdb; //This is used only if making any database queries

        /**
         * First, lets decide how many records per page to show
         */
        $per_page = 10;

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
        
        $this->process_bulk_action();
        
        $data = $this->example_data;
                
        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'ID'; //If no sort, default to title
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'desc'; //If no order, default to asc
            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
        }
        
        if($data){
        	usort($data, 'usort_reorder');
        
            $current_page = $this->get_pagenum();

            $total_items = count($data);
        	$data = array_slice($data,(($current_page-1)*$per_page),$per_page);
        
            $this->items = $data;
            
            $this->set_pagination_args( array(
                'total_items' => $total_items,                  //WE have to calculate the total number of items
                'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
                'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
            ) );
        }
    }


}


    $testListTable = new E_Shortcode_List_Table();
    //Fetch, prepare, sort, and filter our data...
    $testListTable->prepare_items();
?>
<div class="wrap">
        
	<div id="icon-users" class="icon32"><br/></div>
	<h1 class="wp-heading-inline">Tag Clouds<a href="?page=tcm_add_new" class="page-title-action">Add New</a></h1>

	<form id="movies-filter" class="tcm_wp_list" method="get">
	    <!-- For plugins, we also need to ensure that the form posts back to our current page -->
	    <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
	    <!-- Now we can render the completed list table -->
	    <?php $testListTable->display() ?>
	</form>

	<?php //echo do_shortcode('[tcm id="1" title="post_tag" taxonomy="post_tag"]')?>
</div>