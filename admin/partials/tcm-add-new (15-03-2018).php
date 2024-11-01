<?php

  include('tcm-code.php');

  $edit_tcm_style = 0;
  $border = 0;
  $edit_tcm_border_top = 'off';
  $edit_tcm_border_bottom = 'off';
  $edit_tcm_border_left = 'off';
  $edit_tcm_border_right = 'off';
  $edit_tcm_separator_check = 'off';
  $edit_tcm_text_decoration = 'off';

  $border_styles = array(
    'none' => 'None',
    'dotted' => 'Dotted',
    'dashed' => 'Dashed',
    'solid' => 'Solid',
    'double' => 'Double',
    'groove' => 'Groove',
    'ridge' => 'Ridge',
    'inset' => 'Inset',
    'outset' => 'Outset',
  );

  $text_decoration_styles = array(
    'solid' => 'Solid',
    'dotted' => 'Dotted',
    'dashed' => 'Dashed',
    'double' => 'Double',
    'wavy' => 'Wavy',
  );
  $text_decoration_lines = array(
    'none' => 'None',
    'underline' => 'Underline',
    'overline' => 'Overline',
    'line-through' => 'Line Through',
  );

  if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
    global $wpdb;

    $edit_result=$wpdb->get_results("SELECT option_name FROM ".$wpdb->prefix."options WHERE option_id = ".$_REQUEST['id']);  
    
    $edit_option_name = $edit_result[0]->option_name;

    $temp_option_name = explode('-',$edit_option_name);
    
    $edit_get_option = maybe_unserialize( get_option( $edit_option_name ) );
/*
    echo "<pre>";
    print_r($edit_result);
    echo "</pre>";
    exit;*/

    $edit_shortcode = '[tcm id="'.$temp_option_name[0].'" title="0" taxonomy="'.$edit_get_option['tcm_taxonomy'].'"]';

    $edit_title = $edit_get_option['tcm_title'];
    $edit_slug = $temp_option_name[0].'-tcm-'.$edit_get_option['tcm_taxonomy'].'-';
    $edit_taxonomy = $edit_get_option['tcm_taxonomy'];
    $edit_tcm_order_by = $edit_get_option['tcm_order_by'];
    $edit_tcm_order = $edit_get_option['tcm_order'];
    $edit_tcm_unit = $edit_get_option['tcm_unit'];
    $edit_tcm_format = $edit_get_option['tcm_format'];
    $edit_tcm_link = $edit_get_option['tcm_link'];
    $edit_tcm_echo = $edit_get_option['tcm_echo'];
    $edit_tcm_count = $edit_get_option['tcm_count'];
    $edit_tcm_exclude = $edit_get_option['tcm_exclude'];
    $edit_tcm_smallest = $edit_get_option['tcm_smallest'];
    $edit_tcm_largest = $edit_get_option['tcm_largest'];
    $edit_tcm_limit = $edit_get_option['tcm_limit'];
    $edit_tcm_post_type = $edit_get_option['tcm_post_type'];
    $edit_tcm_separator = $edit_get_option['tcm_separator'];
    $edit_tcm_modified = $edit_get_option['tcm_modified'];

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

      <?php if($edit_tcm_format != 'list'){ ?>
        float: left;
      <?php } ?>
      display: inline-block;
    }

    <?php
      if( $edit_tcm_separator_decoration != 'on' ){
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
  }


?>

<div class="wrap tcm-custom">
  <h1 class="wp-heading-inline">
    <?php 
      if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
        esc_html_e($edit_shortcode,'tcm');
      }
      else{
        esc_html_e('Add New Tags-Cloud','tcm'); 
      }
    ?>
  </h1>

  <?php 
    if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
      echo '<input type="hidden" name="edit-tcm-hidden" id="edit-tcm-hidden" value="'.$temp_option_name[0].'">';
      echo '<input type="hidden" name="edit-tcm-hidden-id" id="edit-tcm-hidden-id" value="'.$_GET['id'].'">';
    }
  ?>

<div class="row">
  <div class="tab col-sm-2">
    <div id="submitdiv" class="">
      <div class="inside">
        <div class="submitbox" id="submitpost">
          <div id="major-publishing-actions">
            <button class="tablinks" onclick="openTab(event, 'Create')">Cloud Creation</button>
            <button class="tablinks" onclick="openTab(event, 'Design')" id="defaultOpen">Cloud Designing</button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <form name="tcm_add_new_form" action="<?php echo admin_url(); ?>admin.php?page=tcm_add_new&id=<?php echo $_GET['id']; ?>" method="post" id="tcm_add_new_form" class="col-sm-10">
  <div id="Create" class="tabcontent">
    <div id="poststuff">
      <div id="post-body" class="metabox-holder columns-2">
        <div id="post-body-content" style="position: relative;">
          <div id="titlediv"><!-- 
          	<div id="titlewrap" class="tcm-title">
              <input class="tcm-form" name="tcm-title" id="tcm-title" type="text" placeholder="<?php esc_html_e(' Tags-Cloud Title','tcm'); ?>" required>
      			</div> -->


            <div id="titlewrap" class="tcm-add row">
              <!-- <div style="float:left; width:59%;"> -->
              <div class="col-sm-8">
                
                <div id="submitdiv" class="postbox ">
                  <div class="inside">
                    <div class="submitbox" id="submitpost">
                      <div id="major-publishing-actions">
                        <div id="publishing-action">
                          <?php
                            if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
                          ?>
                              <input class="tcm-form" name="tcm-title" id="tcm-title" type="text" value="<?php echo $edit_title; ?>" placeholder="<?php esc_html_e(' Tags-Cloud Title','tcm'); ?>" required>

                              <input class="tcm-form" name="tcm-slug" id="tcm-slug" type="hidden" value="<?php echo $edit_slug; ?>">
                          <?php
                            }else{
                          ?>
                              <input class="tcm-form" name="tcm-title" id="tcm-title" type="text" placeholder="<?php esc_html_e(' Tags-Cloud Title','tcm'); ?>" required>

                              <input class="tcm-form" name="tcm-slug" id="tcm-slug" type="hidden">
                          <?php
                            }
                          ?>
                        </div>
                        <div class="clear"></div>
                      </div>
                    </div>
                  </div>  
                </div>
                
              </div>

              <!-- <div style="float:right; width:40%;"> -->
              <div class="col-sm-4">
                
                  <div id="submitdiv" class="postbox ">
                    <div class="inside">
                      <div class="submitbox" id="submitpost">
                        <div id="major-publishing-actions">
                          <div id="publishing-action">
                            <?php
                              $all_terms = get_taxonomies();
                              if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
                                if($all_terms){
                                  asort($all_terms);
                            ?>
                                  <select class="tcm-form form-control" name="tcm-taxonomy-1" id="tcm-taxonomy" disabled>
                                  <option value="0">Select Taxonomy</option>
                            <?php
                                  foreach ($all_terms as $key => $value) {

                            ?>
                                    <option value="<?php echo $key; ?>" <?php echo ($key == $edit_taxonomy) ? 'SELECTED' : ''; ?> ><?php echo $value; ?></option>
                            <?php
                                  }
                            ?>
                                  </select>
                            <?php
                                }
                            ?>
                                <input class="tcm-form" name="tcm-taxonomy" id="tcm-taxonomy" type="hidden" value="<?php echo $edit_taxonomy; ?>" placeholder="<?php esc_html_e(' Taxonomy','tcm'); ?>">
                            <?php
                              }else{
                                if($all_terms){
                                  asort($all_terms);
                            ?>
                                  <select class="tcm-form form-control" name="tcm-taxonomy" id="tcm-taxonomy">
                                  <option value="0" SELECTED>Select Taxonomy</option>
                            <?php
                                  foreach ($all_terms as $key => $value) {

                            ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php
                                  }
                            ?>
                                  </select>
                            <?php
                                }
                                /*<input class="tcm-form" name="tcm-taxonomy" id="tcm-taxonomy" type="text" placeholder="<?php esc_html_e(' Taxonomy','tcm'); ?>" required>*/
                              }
                            ?>
                          </div>
                          <div class="clear"></div>
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>

            </div>

<!-- 1st row -->
            <div id="titlewrap" class="tcm-add row">
              <!-- <div style="float:left; width:100%;"> -->
                <!-- <div style="float:left; width:43%;"> -->
                <div class="col-sm-4">
                  <div id="submitdiv" class="postbox ">
                    <!-- <h2 class="hndle ui-sortable-handle">
                        <span>Order By </span>
                    </h2> -->
                    <div class="inside">
                      <div class="submitbox" id="submitpost">
                        <div id="major-publishing-actions">
                          <div id="publishing-action">
                            <h2 class="hndle ui-sortable-handle">
                                <span>Order By </span>
                            </h2>
                            <?php
                              if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
                                if( $edit_tcm_order_by == 'count' ){
                            ?>
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-order-by" id="tcm-name" type="radio" value="name" Required>Name 
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-order-by" id="tcm-count" type="radio" value="count" required Checked>Count 
                            <?php
                                }
                              }
                              if( !isset($_REQUEST['action']) || isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && $edit_tcm_order_by == 'name' ){
                            ?>
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-order-by" id="tcm-name" type="radio" value="name" Required Checked>Name 
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-order-by" id="tcm-count" type="radio" value="count" required>Count 
                            <?php
                              }
                            ?>
                          </div>
                          <div class="clear"></div>
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>

                <!-- <div style="float:right; width:56%;"> -->
                <div class="col-sm-4">
                  <div id="submitdiv" class="postbox ">
                    <!-- <h2 class="hndle ui-sortable-handle">
                        <span>Order </span>
                    </h2> -->
                    <div class="inside">
                      <div class="submitbox" id="submitpost">
                        <div id="major-publishing-actions">
                          <div id="publishing-action">
                            <h2 class="hndle ui-sortable-handle">
                                <span>Order </span>
                            </h2>
                            <?php
                              if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
                                if( $edit_tcm_order == 'DESC' ){
                            ?>
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-order" id="tcm-asc" type="radio" value="ASC" Required>ASC 
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-order" id="tcm-desc" type="radio" value="DESC" required Checked>DESC 
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-order" id="tcm-rand" type="radio" value="RAND" required>RAND 
                            <?php
                                }
                                if( $edit_tcm_order == 'RAND' ){
                            ?>
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-order" id="tcm-asc" type="radio" value="ASC" Required>ASC 
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-order" id="tcm-desc" type="radio" value="DESC" required>DESC 
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-order" id="tcm-rand" type="radio" value="RAND" required Checked>RAND 
                            <?php
                                }
                              }
                              if( !isset($_REQUEST['action']) || isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && $edit_tcm_order == 'ASC' ){
                          ?>
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-order" id="tcm-asc" type="radio" value="ASC" Required Checked>ASC 
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-order" id="tcm-desc" type="radio" value="DESC" required>DESC 
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-order" id="tcm-rand" type="radio" value="RAND" required>RAND 
                            <?php
                              }
                            ?>
                          </div>
                          <div class="clear"></div>
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>

                <!-- <div style="float:left; width:56%;"> -->
                <div class="col-sm-4">
                  <div id="submitdiv" class="postbox ">
                    <!-- <h2 class="hndle ui-sortable-handle">
                        <span>Font Measure</span>
                    </h2> -->
                    <div class="inside">
                      <div class="submitbox" id="submitpost">
                        <div id="major-publishing-actions">
                          <div id="publishing-action">
                            <h2 class="hndle ui-sortable-handle">
                                <span>Font Measure </span>
                            </h2>
                            <?php
                              if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
                                if( $edit_tcm_unit == 'px' ){
                            ?>
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-measure" id="tcm-pt-measure" type="radio" value="pt" Required>pt&nbsp;(Points)
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-measure" id="tcm-px-measure" type="radio" value="px" required Checked>px&nbsp;(Pixels)
                                  <!-- &nbsp;&nbsp;<input class="tcm-form" name="tcm-measure" id="tcm-ems-measure" type="radio" value="ems" required>em&nbsp;(Ems) -->
                            <?php
                                }else if( $edit_tcm_unit == 'ems' ){
                            ?>
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-measure" id="tcm-pt-measure" type="radio" value="pt" Required>pt&nbsp;(Points)
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-measure" id="tcm-px-measure" type="radio" value="px" required>px&nbsp;(Pixels)
                                  <!-- &nbsp;&nbsp;<input class="tcm-form" name="tcm-measure" id="tcm-ems-measure" type="radio" value="ems" required Checked>em&nbsp;(Ems) -->
                            <?php
                                }
                              }
                              if( !isset($_REQUEST['action']) || isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && $edit_tcm_unit == 'pt' ){
                            ?>
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-measure" id="tcm-pt-measure" type="radio" value="pt" Required Checked>pt&nbsp;(Points)
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-measure" id="tcm-px-measure" type="radio" value="px" required>px&nbsp;(Pixels)
                                <!-- &nbsp;&nbsp;<input class="tcm-form" name="tcm-measure" id="tcm-ems-measure" type="radio" value="ems" required>em&nbsp;(Ems) -->
                            <?php
                              }
                            ?>
                          </div>
                          <div class="clear"></div>
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>

                <div class="col-sm-3">
                  <div id="submitdiv" class="postbox ">
                    <!-- <h2 class="hndle ui-sortable-handle">
                        <span>Show Count </span>
                    </h2> -->
                    <div class="inside">
                      <div class="submitbox" id="submitpost">
                        <div id="major-publishing-actions">
                          <div id="publishing-action">
                            <h2 class="hndle ui-sortable-handle">
                                <span>Show Count </span>
                            </h2>
                            <?php
                              if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
                                if( $edit_tcm_count == '1' ){
                            ?>
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-show-count" id="tcm-show-count-on" type="radio" value="1" required Checked>on
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-show-count" id="tcm-show-count-off" type="radio" value="0" Required>off 
                            <?php
                                }
                              }
                              if( !isset($_REQUEST['action']) || isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && $edit_tcm_count == '0' ){
                            ?>
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-show-count" id="tcm-show-count-on" type="radio" value="1" required>on
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-show-count" id="tcm-show-count-off" type="radio" value="0" Required Checked>off 
                            <?php
                              }
                            ?>

                          </div>
                          <div class="clear"></div>
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>

                <div class="col-sm-3">
                  <div id="submitdiv" class="postbox ">
                    <!-- <h2 class="hndle ui-sortable-handle">
                        <span>Format</span>
                    </h2> -->
                    <div class="inside">
                      <div class="submitbox" id="submitpost">
                        <div id="major-publishing-actions">
                          <div id="publishing-action">
                            <h2 class="hndle ui-sortable-handle">
                                <span>Format </span>
                            </h2>
                            <?php
                              if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
                                if( $edit_tcm_format == 'list' ){
                            ?>
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-format" id="tcm-flat" type="radio" value="flat" Required>Flat
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-format" id="tcm-list" type="radio" value="list" required Checked>List
                            <?php
                                }
                              }
                              if( !isset($_REQUEST['action']) || isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && $edit_tcm_format == 'flat' ){
                            ?>
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-format" id="tcm-flat" type="radio" value="flat" Required Checked>Flat
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-format" id="tcm-list" type="radio" value="list" required>List
                            <?php
                              }
                            ?>

                          </div>
                          <div class="clear"></div>
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>

                <div class="col-sm-3">
                  <div id="submitdiv" class="postbox ">
                    <!-- <h2 class="hndle ui-sortable-handle">
                        <span>Link </span>
                    </h2> -->
                    <div class="inside">
                      <div class="submitbox" id="submitpost">
                        <div id="major-publishing-actions">
                          <div id="publishing-action">
                            <h2 class="hndle ui-sortable-handle">
                                <span>Link </span>
                            </h2>
                            <?php
                              if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
                                if( $edit_tcm_link == 'edit' ){
                            ?>
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-link" id="tcm-view" type="radio" value="view" Required>View 
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-link" id="tcm-edit" type="radio" value="edit" required Checked>Edit 
                            <?php
                                }
                              }
                              if( !isset($_REQUEST['action']) || isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && $edit_tcm_link == 'view' ){
                            ?>
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-link" id="tcm-view" type="radio" value="view" Required Checked>View 
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-link" id="tcm-edit" type="radio" value="edit" required>Edit 
                            <?php
                              }
                            ?>

                          </div>
                          <div class="clear"></div>
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>

                <!-- <div class="col-sm-3">
                  <div id="submitdiv" class="postbox ">
                    <div class="inside">
                      <div class="submitbox" id="submitpost">
                        <div id="major-publishing-actions">
                          <div id="publishing-action">
                            <strong class="tcm_label">Echo - </strong>
                            <?php
                              if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
                                if( $edit_tcm_echo == 'true' ){
                            ?>
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-echo" id="tcm-echo-true" type="radio" value="true" required Checked>Enable
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-echo" id="tcm-echo-false" type="radio" value="false" Required>Disable
                            <?php
                                }
                              }
                              if( !isset($_REQUEST['action']) || isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && $edit_tcm_echo == 'false' ){
                            ?>
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-echo" id="tcm-echo-true" type="radio" value="true" required>Enable
                                  &nbsp;&nbsp;<input class="tcm-form" name="tcm-echo" id="tcm-echo-false" type="radio" value="false" Required Checked>Disable
                            <?php
                              }
                            ?>
                            
                          </div>
                          <div class="clear"></div>
                        </div>
                      </div>
                    </div>  
                  </div>
                </div> -->

                <div class="col-sm-3">
                  <div id="submitdiv" class="postbox ">
                    <div class="inside">
                      <div class="submitbox" id="submitpost">
                        <div id="major-publishing-actions">
                          <div id="publishing-action">
                            <h2 class="hndle ui-sortable-handle">
                                <span>Exclude </span>
                            </h2>
                            <?php
                              if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && $edit_tcm_exclude){
                            ?>
                                <input class="tcm-form" name="tcm-exclude" id="tcm-exclude" value="<?php echo $edit_tcm_exclude; ?>" type="text" placeholder="<?php esc_html_e(' Exclude Tags Id','tcm'); ?>">
                            <?php
                              }else{
                            ?>
                                <input class="tcm-form" name="tcm-exclude" id="tcm-exclude" type="text" placeholder="<?php esc_html_e(' Exclude Tags Id','tcm'); ?>">
                            <?php
                              }
                            ?>
                          </div>
                          <div class="clear"></div>
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>

                <div class="col-sm-3">
                  <div id="submitdiv" class="postbox ">
                    <div class="inside">
                      <div class="submitbox" id="submitpost">
                        <div id="major-publishing-actions">
                          <div id="publishing-action">
                            <h2 class="hndle ui-sortable-handle">
                                <span>Cloud Limit </span>
                            </h2>
                            <?php
                              if( isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && $edit_tcm_limit ){
                                $edit_temp_link = $edit_tcm_limit;
                              }else{
                                $edit_temp_link = 10;
                              }
                            ?>
                              <input class="tcm-form form-control" name="tcm-limit" id="tcm-limit" type="number" value="<?php echo $edit_temp_link; ?>" placeholder="<?php esc_html_e(' Cloud Limit','tcm'); ?>" required>
                            
                          </div>
                          <div class="clear"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div id="submitdiv" class="postbox ">
                    <div class="inside">
                      <div class="submitbox" id="submitpost">
                        <div id="major-publishing-actions">
                          <div id="publishing-action">
                            <h2 class="hndle ui-sortable-handle">
                              <span>Separator </span>
                            </h2>
                            <?php
                              if( isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && $edit_tcm_separator ){
                                $edit_temp_separator = $edit_tcm_separator;
                              }else{
                                $edit_temp_separator = '';
                              }
                            ?>

                            <input class="tcm-form" name="tcm-separator" id="tcm-separator" type="text" value="<?php echo $edit_temp_separator; ?>" placeholder="<?php esc_html_e(' Separator','tcm'); ?>">
                          </div>
                          <div class="clear"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div id="submitdiv" class="postbox ">
                    <div class="inside">
                      <div class="submitbox" id="submitpost">
                        <div id="major-publishing-actions">
                          <div id="publishing-action">
                            <h2 class="hndle ui-sortable-handle">
                              <span>Smallest Size </span>
                            </h2>                          
                            <?php
                              if( isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && $edit_tcm_smallest ){
                                $edit_temp_smallest = $edit_tcm_smallest;
                              }else{
                                $edit_temp_smallest = 12;
                              }
                            ?>
                            <input class="tcm-form" name="tcm-s-font" id="tcm-s-font" type="number" value="<?php echo $edit_temp_smallest; ?>" placeholder="<?php esc_html_e(' Smallest Font Size','tcm'); ?>" required>
                          </div>
                          <div class="clear"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div id="submitdiv" class="postbox ">
                    <div class="inside">
                      <div class="submitbox" id="submitpost">
                        <div id="major-publishing-actions">
                          <div id="publishing-action">
                            <h2 class="hndle ui-sortable-handle">
                              <span>Largest Size </span>
                            </h2>                          
                            <?php
                              if( isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && $edit_tcm_largest ){
                                $edit_temp_largest = $edit_tcm_largest;
                              }else{
                                $edit_temp_largest = 16;
                              }
                            ?>

                            <input class="tcm-form" name="tcm-l-font" id="tcm-l-font" type="number" value="<?php echo $edit_temp_largest; ?>" placeholder="<?php esc_html_e(' Largest Font Size','tcm'); ?>" required>
                          </div>
                          <div class="clear"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

            </div>
          </div>
        </div>
        <!-- /post-body-content -->
        <div id="postbox-container-1" class="postbox-container">
          <div id="side-sortables" class="meta-box-sortables ui-sortable" style="">
            <div class="tcm-add row">
              <div class="col-sm-7">
                <div id="submitdiv" class="postbox ">
                  <div class="inside">
                    <div class="submitbox" id="submitpost">
                      <div id="major-publishing-actions">
                        <div id="publishing-action">
                          <select class="tcm-form" name="tcm-post-type" id="tcm-post-type" required>

                            <?php
                              if( isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && $edit_tcm_post_type ){
                                
                                if( $edit_tcm_post_type == 'post' ){
                                  echo '<option value="post" SELECTED> Post (Default) </option>';
                                }else{
                                  echo '<option value="post"> Post (Default) </option>';
                                }

                                foreach( get_post_types(array('public'   => true,'_builtin' => false), 'names') as $post ) { 
                                  if( $post == $edit_tcm_post_type ){
                                    echo '<option value="'.$post.'" SELECTED> ' . $post . ' </option>'; 
                                  }else{
                                    echo '<option value="'.$post.'"> ' . $post . ' </option>'; 
                                  }
                                }

                              }else{
                                echo '<option value="post" SELECTED> Post (Default) </option>';
                                foreach( get_post_types(array('public'   => true,'_builtin' => false), 'names') as $post ) { 
                                    echo '<option value="'.$post.'"> ' . $post . ' </option>'; 
                                }
                              }
                            ?>

                          </select>
                        </div>
                        <div class="clear"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <?php
                if( isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' ){
                  $edit_tcm_btn = 'block';
                }else{
                  $edit_tcm_btn = 'none';
                }
              ?>

              <div class="tcm-submit col-sm-5" style="display: <?php echo $edit_tcm_btn; ?>;">
                <div id="submitdiv" class="postbox ">
                  <div class="inside">
                    <div class="submitbox" id="submitpost">
                      <div id="major-publishing-actions">
                        <div id="publishing-action">
                          <?php wp_nonce_field( 'tcm-nonce', '_wpnonce'); ?>

                          <?php 
                            if( isset($_REQUEST['action']) && $_REQUEST['action']=='edit'){
                          ?>
                          <input name="tcm-update" id="tcm-update" class="button button-primary button-large tcm-submit" value="Update" type="submit">
                          <?php
                            } else{
                          ?>
                          <input name="tcm-publish" id="tcm-publish" class="button button-primary button-large tcm-submit" value="Publish" type="submit">
                          <?php
                            }
                          ?>
                        </div>
                        <div class="clear">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="tcm-add row" >
              <div class="col-sm-12">
                <div id="submitdiv" class="tcm_cloud_content tcm-cloud">
                  <h2 class="hndle ui-sortable-handle">
                    <span>Style Preview</span>
                  </h2>

                  <?php if($edit_tcm_format == 'list'){ ?>
                    <ul class="wp-tag-cloud" role="list">
                      <li>
                  <?php } ?>
                    <a href="http://localhost/ak/Testing/wp-admin/term.php?taxonomy=category&amp;tag_ID=15&amp;post_type=post" class="tag-cloud-link tag-link-0 tag-link-position-1" style="font-size: 12pt;" aria-label="Tag-1 (2 items)">Tag-1<span class="tag-link-count"> (2)</span></a>
                  <?php if($edit_tcm_format == 'list'){ ?>
                      </li>
                  <?php } ?>

                  <?php if( $edit_tcm_separator_check == 'on' && $edit_tcm_format != 'list' ){ ?>
                    <a href="#" class="tcm_separator"><?php echo $edit_tcm_separator; ?></a>
                  <?php } ?>

                  <?php if($edit_tcm_format == 'list'){ ?>
                      <li>
                  <?php } ?>
                    <a href="http://localhost/ak/Testing/wp-admin/term.php?taxonomy=category&amp;tag_ID=15&amp;post_type=post" class="tag-cloud-link tag-link-0 tag-link-position-1" style="font-size: 13pt;" aria-label="TagTag-2 (3 items)">TagTag-2<span class="tag-link-count"> (2)</span></a>
                  <?php if($edit_tcm_format == 'list'){ ?>
                      </li>
                  <?php } ?>

                  <?php if( $edit_tcm_separator_check == 'on' && $edit_tcm_format != 'list' ){ ?>
                    <a href="#" class="tcm_separator"><?php echo $edit_tcm_separator; ?></a>
                  <?php } ?>

                  <?php if($edit_tcm_format == 'list'){ ?>
                      <li>
                  <?php } ?>
                    <a href="http://localhost/ak/Testing/wp-admin/term.php?taxonomy=category&amp;tag_ID=15&amp;post_type=post" class="tag-cloud-link tag-link-0 tag-link-position-1" style="font-size: 12pt;" aria-label="TagTagTag-3 (2 items)">TagTagTag-3<span class="tag-link-count"> (2)</span></a>
                  <?php if($edit_tcm_format == 'list'){ ?>
                      </li>
                  <?php } ?>

                  <?php if( $edit_tcm_separator_check == 'on' && $edit_tcm_format != 'list' ){ ?>
                    <a href="#" class="tcm_separator"><?php echo $edit_tcm_separator; ?></a>
                  <?php } ?>

                  <?php if($edit_tcm_format == 'list'){ ?>
                      <li>
                  <?php } ?>
                    <a href="http://localhost/ak/Testing/wp-admin/term.php?taxonomy=category&amp;tag_ID=15&amp;post_type=post" class="tag-cloud-link tag-link-0 tag-link-position-1" style="font-size: 14pt;" aria-label="Tag-6 (4 items)">Tag-6<span class="tag-link-count"> (2)</span></a>
                  <?php if($edit_tcm_format == 'list'){ ?>
                      </li>
                  <?php } ?>

                  <?php if( $edit_tcm_separator_check == 'on' && $edit_tcm_format != 'list' ){ ?>
                    <a href="#" class="tcm_separator"><?php echo $edit_tcm_separator; ?></a>
                  <?php } ?>

                  <?php if($edit_tcm_format == 'list'){ ?>
                      <li>
                  <?php } ?>
                    <a href="http://localhost/ak/Testing/wp-admin/term.php?taxonomy=category&amp;tag_ID=1&amp;post_type=post" class="tag-cloud-link tag-link-1 tag-link-position-2" style="font-size: 16pt;" aria-label="Uncategorized (6 items)">Uncategorized<span class="tag-link-count"> (6)</span></a>
                  <?php if($edit_tcm_format == 'list'){ ?>
                      </li>
                    </ul>
                  <?php } ?>
                </div>
              </div>
            </div>



          </div>

        </div>
      </div>
    </div>
    </div>
     <!-- END Create -->


     <!-- START Design -->
    <div id="Design" class="tabcontent">
    <div id="poststuff">
      <div id="post-body" class="metabox-holder columns-2">
        <div id="post-body-content" style="position: relative;">
          <div id="titlewrap" class="tcm-add">
            <div class="row">
              <div class="col-sm-5">
                <div id="submitdiv" class="postbox ">
                  <div class="inside">
                    <div class="submitbox" id="submitpost">
                      <div id="major-publishing-actions">
                        <div id="publishing-action">
                          <h2 class="hndle ui-sortable-handle">
                              <span>Cloud Style </span>
                          </h2>
                          <?php
                            if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
                              if($edit_tcm_style == 1){
                          ?>
                                <input class="tcm-form" name="tcm-styles" id="tcm-styles-simple" type="radio" value="0" required>Simple Style
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-styles" id="tcm-styles-custom" type="radio" value="1" Required Checked>Custom Style
                          <?php
                              }else{
                          ?>
                                <input class="tcm-form" name="tcm-styles" id="tcm-styles-simple" type="radio" value="0" required Checked>Simple Style
                                &nbsp;&nbsp;<input class="tcm-form" name="tcm-styles" id="tcm-styles-custom" type="radio" value="1" Required>Custom Style
                          <?php
                              }
                            }else{
                          ?>
                              <input class="tcm-form" name="tcm-styles" id="tcm-styles-simple" type="radio" value="0" required Checked>Simple Style
                              &nbsp;&nbsp;<input class="tcm-form" name="tcm-styles" id="tcm-styles-custom" type="radio" value="1" Required>Custom Style
                          <?php
                            }
                          ?>
                        </div>
                        <div class="clear"></div>
                      </div>
                    </div>
                  </div>  
                </div>
              </div>

              <div class="tcm-custom-style col-sm-7" style=" <?php echo ($edit_tcm_style == 0) ? 'display: none' : 'display: block'; ?>">
                <div id="submitdiv" class="postbox ">
                  <div class="inside">
                    <div class="submitbox" id="submitpost">
                      <div id="major-publishing-actions">
                        <div id="publishing-action">
                          <h2 class="hndle ui-sortable-handle">
                              <span>Hover Effect </span>
                          </h2>
                          <?php
                            if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
                              
                            }
                          ?>
                        </div>
                        <div class="clear"></div>
                      </div>
                    </div>
                  </div>  
                </div>
              </div>

            </div>
          </div>
            

          <div id="titlewrap" class="tcm-add tcm-custom-style" style="<?php echo ($edit_tcm_style == 0) ? 'display: none' : 'display: block'; ?>">
            <div class="row">
              <div class="col-sm-8">
                <div class="row">
                  <div class="col-sm-12">
                    <div id="submitdiv" class="postbox ">
                      <div class="inside">
                        <div class="submitbox" id="submitpost">
                          <div id="major-publishing-actions">
                            <div id="publishing-action">
                              <h2 class="hndle ui-sortable-handle">
                                  <span>Border </span>
                              </h2>
                              <div class="row">
                                <div class="col-sm-3">
                                  <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                                    <div class="inside">
                                      <div class="submitbox" id="submitpost">
                                        <div id="major-publishing-actions">
                                          <div id="publishing-action">
                                            <center>
                                              <span>Top </span><br/>
                                              <input class="tcm-form" title="Top Border ?" name="tcm-border-top" id="tcm-border-top" type="checkbox">
                                            </center>
                                          </div>
                                          <div class="clear"></div>
                                        </div>
                                      </div>
                                    </div>  
                                  </div>

                                  <div class="border-top" style="display: none">
                                    <div id="submitdiv" class="postbox border-top" style="margin-bottom:0px !important">
                                      <div class="inside">
                                        <div class="submitbox" id="submitpost">
                                          <div id="major-publishing-actions">
                                            <div id="publishing-action">
                                                <input class="tcm-form" name="tcm-border-width-top" id="tcm-border-width-top" placeholder="Width" title="Border Width" value="0" type="number">
                                            </div>
                                            <div class="clear"></div>
                                          </div>
                                        </div>
                                      </div>  
                                    </div>

                                    <div id="submitdiv" class="postbox border-top" style="margin-bottom:0px !important">
                                      <div class="inside">
                                        <div class="submitbox" id="submitpost">
                                          <div id="major-publishing-actions">
                                            <div id="publishing-action">
                                                <select class="tcm-form" name="tcm-border-style-top" id="tcm-border-style-top" title="Border Style"><option value="none">None</option><option value="dotted">Dotted</option><option value="dashed">Dashed</option><option value="solid">Solid</option><option value="double">Double</option><option value="groove">Groove</option><option value="ridge">Ridge</option><option value="inset">Inset</option><option value="outset">Outset</option></select>                                        </div>
                                            <div class="clear"></div>
                                          </div>
                                        </div>
                                      </div>  
                                    </div>

                                    <div id="submitdiv" class="postbox border-top" style="margin-bottom:0px !important">
                                      <div class="inside">
                                        <div class="submitbox" id="submitpost">
                                          <div id="major-publishing-actions">
                                            <div id="publishing-action">
                                                <input class="tcm-form" name="tcm-border-color-top" id="tcm-border-color-top" value="#BBBBBB" placeholder="Color" title="Border Color" type="color">
                                            </div>
                                            <div class="clear"></div>
                                          </div>
                                        </div>
                                      </div>  
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-3">
                                  <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                                    <div class="inside">
                                      <div class="submitbox" id="submitpost">
                                        <div id="major-publishing-actions">
                                          <div id="publishing-action">
                                            <center>
                                              <span>Bottom </span><br/>
                                              <input class="tcm-form" title="Bottom Border ?" name="tcm-border-bottom" id="tcm-border-bottom" type="checkbox">
                                            </center>
                                          </div>
                                          <div class="clear"></div>
                                        </div>
                                      </div>
                                    </div>  
                                  </div>

                                  <div class="border-bottom" style="display: none">
                                    <div id="submitdiv" class="postbox border-bottom" style="margin-bottom:0px !important">
                                      <div class="inside">
                                        <div class="submitbox" id="submitpost">
                                          <div id="major-publishing-actions">
                                            <div id="publishing-action">
                                                <input class="tcm-form" name="tcm-border-width-bottom" id="tcm-border-width-bottom" placeholder="Width" title="Border Width" value="0" type="number">
                                            </div>
                                            <div class="clear"></div>
                                          </div>
                                        </div>
                                      </div>  
                                    </div>

                                    <div id="submitdiv" class="postbox border-bottom" style="margin-bottom:0px !important">
                                      <div class="inside">
                                        <div class="submitbox" id="submitpost">
                                          <div id="major-publishing-actions">
                                            <div id="publishing-action">
                                                <select class="tcm-form" name="tcm-border-style-bottom" id="tcm-border-style-bottom" title="Border Style"><option value="none">None</option><option value="dotted">Dotted</option><option value="dashed">Dashed</option><option value="solid">Solid</option><option value="double">Double</option><option value="groove">Groove</option><option value="ridge">Ridge</option><option value="inset">Inset</option><option value="outset">Outset</option></select>                                        </div>
                                            <div class="clear"></div>
                                          </div>
                                        </div>
                                      </div>  
                                    </div>

                                    <div id="submitdiv" class="postbox border-bottom" style="margin-bottom:0px !important">
                                      <div class="inside">
                                        <div class="submitbox" id="submitpost">
                                          <div id="major-publishing-actions">
                                            <div id="publishing-action">
                                                <input class="tcm-form" name="tcm-border-color-bottom" id="tcm-border-color-bottom" value="#BBBBBB" placeholder="Color" title="Border Color" type="color">
                                            </div>
                                            <div class="clear"></div>
                                          </div>
                                        </div>
                                      </div>  
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-3">
                                  <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                                    <div class="inside">
                                      <div class="submitbox" id="submitpost">
                                        <div id="major-publishing-actions">
                                          <div id="publishing-action">
                                            <center>
                                              <span>Left </span><br/>
                                              <input class="tcm-form" title="Left Border ?" name="tcm-border-left" id="tcm-border-left" checked="" type="checkbox">
                                            </center>
                                          </div>
                                          <div class="clear"></div>
                                        </div>
                                      </div>
                                    </div>  
                                  </div>

                                  <div class="border-left" style="display: block">
                                    <div id="submitdiv" class="postbox border-left" style="margin-bottom:0px !important">
                                      <div class="inside">
                                        <div class="submitbox" id="submitpost">
                                          <div id="major-publishing-actions">
                                            <div id="publishing-action">
                                                <input class="tcm-form" name="tcm-border-width-left" id="tcm-border-width-left" placeholder="Width" title="Border Width" value="13" type="number">
                                            </div>
                                            <div class="clear"></div>
                                          </div>
                                        </div>
                                      </div>  
                                    </div>

                                    <div id="submitdiv" class="postbox border-left" style="margin-bottom:0px !important">
                                      <div class="inside">
                                        <div class="submitbox" id="submitpost">
                                          <div id="major-publishing-actions">
                                            <div id="publishing-action">
                                                <select class="tcm-form" name="tcm-border-style-left" id="tcm-border-style-left" title="Border Style"><option value="none">None</option><option value="dotted">Dotted</option><option value="dashed">Dashed</option><option value="solid">Solid</option><option value="double" selected="">Double</option><option value="groove">Groove</option><option value="ridge">Ridge</option><option value="inset">Inset</option><option value="outset">Outset</option></select>                                        </div>
                                            <div class="clear"></div>
                                          </div>
                                        </div>
                                      </div>  
                                    </div>

                                    <div id="submitdiv" class="postbox border-left" style="margin-bottom:0px !important">
                                      <div class="inside">
                                        <div class="submitbox" id="submitpost">
                                          <div id="major-publishing-actions">
                                            <div id="publishing-action">
                                                <input class="tcm-form" name="tcm-border-color-left" id="tcm-border-color-left" value="#f1a1a1" placeholder="Color" title="Border Color" type="color">
                                            </div>
                                            <div class="clear"></div>
                                          </div>
                                        </div>
                                      </div>  
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-3">
                                  <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                                    <div class="inside">
                                      <div class="submitbox" id="submitpost">
                                        <div id="major-publishing-actions">
                                          <div id="publishing-action">
                                            <center>
                                              <span>Right </span><br/>
                                              <input class="tcm-form" title="Right Border ?" name="tcm-border-right" id="tcm-border-right" type="checkbox">
                                            </center>
                                          </div>
                                          <div class="clear"></div>
                                        </div>
                                      </div>
                                    </div>  
                                  </div>

                                  <div class="border-right" style="display: none">
                                    <div id="submitdiv" class="postbox border-right" style="margin-bottom:0px !important">
                                      <div class="inside">
                                        <div class="submitbox" id="submitpost">
                                          <div id="major-publishing-actions">
                                            <div id="publishing-action">
                                                <input class="tcm-form" name="tcm-border-width-right" id="tcm-border-width-right" placeholder="Width" title="Border Width" value="0" type="number">
                                            </div>
                                            <div class="clear"></div>
                                          </div>
                                        </div>
                                      </div>  
                                    </div>

                                    <div id="submitdiv" class="postbox border-right" style="margin-bottom:0px !important">
                                      <div class="inside">
                                        <div class="submitbox" id="submitpost">
                                          <div id="major-publishing-actions">
                                            <div id="publishing-action">
                                                <select class="tcm-form" name="tcm-border-style-right" id="tcm-border-style-right" title="Border Style"><option value="none">None</option><option value="dotted">Dotted</option><option value="dashed">Dashed</option><option value="solid">Solid</option><option value="double">Double</option><option value="groove">Groove</option><option value="ridge">Ridge</option><option value="inset">Inset</option><option value="outset">Outset</option></select>                                        </div>
                                            <div class="clear"></div>
                                          </div>
                                        </div>
                                      </div>  
                                    </div>

                                    <div id="submitdiv" class="postbox border-right" style="margin-bottom:0px !important">
                                      <div class="inside">
                                        <div class="submitbox" id="submitpost">
                                          <div id="major-publishing-actions">
                                            <div id="publishing-action">
                                                <input class="tcm-form" name="tcm-border-color-right" id="tcm-border-color-right" value="#BBBBBB" placeholder="Color" title="Border Color" type="color">
                                            </div>
                                            <div class="clear"></div>
                                          </div>
                                        </div>
                                      </div>  
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-sm-8">
                        <div id="submitdiv" class="postbox ">
                          <div class="inside">
                            <div class="submitbox" id="submitpost">
                              <div id="major-publishing-actions">
                                <div id="publishing-action">
                                  <h2 class="hndle ui-sortable-handle">
                                      <span>Radius </span>
                                  </h2>
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <div id="submitdiv" class="postbox border" style="margin-bottom:0px !important">
                                        <div class="inside">
                                          <div class="submitbox" id="submitpost">
                                            <div id="major-publishing-actions">
                                              <div id="publishing-action">
                                                  <span>Top Left </span><br/>
                                                  <input class="tcm-form" name="tcm-border-radius-top-left" id="tcm-border-radius-top-left" type="number" placeholder="Top Left Readius" title="Top Left Radius" value="0">
                                              </div>
                                              <div class="clear"></div>
                                            </div>
                                          </div>
                                        </div>  
                                      </div>
                                    </div>

                                    <div class="col-sm-6">
                                      <div id="submitdiv" class="postbox border" style="margin-bottom:0px !important">
                                        <div class="inside">
                                          <div class="submitbox" id="submitpost">
                                            <div id="major-publishing-actions">
                                              <div id="publishing-action">
                                                  <span>Top Right </span><br/>
                                                  <input class="tcm-form" name="tcm-border-radius-top-right" id="tcm-border-radius-top-right" type="number" placeholder="Top Right Readius" title="Top Right Radius" value="0">
                                              </div>
                                              <div class="clear"></div>
                                            </div>
                                          </div>
                                        </div>  
                                      </div>
                                    </div>

                                    <div class="col-sm-6">
                                      <div id="submitdiv" class="postbox border" style="margin-bottom:0px !important">
                                        <div class="inside">
                                          <div class="submitbox" id="submitpost">
                                            <div id="major-publishing-actions">
                                              <div id="publishing-action">
                                                  <span>Bottom Left </span><br/>
                                                  <input class="tcm-form" name="tcm-border-radius-bottom-left" id="tcm-border-radius-bottom-left" type="number" placeholder="Bottom Left Readius" title="Bottom Left Radius" value="0">
                                              </div>
                                              <div class="clear"></div>
                                            </div>
                                          </div>
                                        </div>  
                                      </div>
                                    </div>

                                    <div class="col-sm-6">
                                      <div id="submitdiv" class="postbox border" style="margin-bottom:0px !important">
                                        <div class="inside">
                                          <div class="submitbox" id="submitpost">
                                            <div id="major-publishing-actions">
                                              <div id="publishing-action">
                                                  <span>Bottom Right </span><br/>
                                                  <input class="tcm-form" name="tcm-border-radius-bottom-right" id="tcm-border-radius-bottom-right" type="number" placeholder="Bottom Right Readius" title="Bottom Right Radius" value="0">
                                              </div>
                                              <div class="clear"></div>
                                            </div>
                                          </div>
                                        </div>  
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div> 
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="row">
                          <div class="col-sm-12">
                          </div>

                          <div class="col-sm-12">
                            <!-- //ak -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
              </div>

            </div>
          </div>


          <div id="titlewrap" class="tcm-add tcm-custom-style tcm-decoration" style="<?php echo ($edit_tcm_style == 0) ? 'display:none' : 'display: block'; ?>">
            <div style="float:left; width:100%;">

              <div id="submitdiv" class="postbox ">
                <h2 class="hndle ui-sortable-handle">
                    <span>Decoration </span>
                </h2>
                <div class="inside">
                  <div class="submitbox" id="submitpost">
                    <div id="major-publishing-actions">
                      <div id="publishing-action">

                        <div style="float:right; width:25%;">
                          <div style="float:left; width:100%; <?php echo ( isset($edit_tcm_separator_check) && $edit_tcm_separator_check != 'on' ) ? 'display: none' : 'display: block'; ?>" class="tcm-separator-decoration">
                              <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                                <!-- <h2 class="hndle ui-sortable-handle">
                                    <span>Separator</span>
                                </h2> -->
                                <div id="submitdiv" class="postbox border" style="margin-bottom:0px !important">
                                  <div class="inside">
                                    <div class="submitbox" id="submitpost">
                                      <div id="major-publishing-actions">
                                        <div id="publishing-action">
                                            <input class="tcm-form" name="tcm-separator-decoration" id="tcm-separator-decoration" type="checkbox" <?php echo ( isset($edit_tcm_separator_decoration) && $edit_tcm_separator_decoration == 'on' ) ? 'Checked' : ''; ?> title="Separator Decoration">Separator Decoration
                                        </div>
                                        <div class="clear"></div>
                                      </div>
                                    </div>
                                  </div>  
                                </div>

                              </div>
                          </div>
                        </div>

                        <div style="float:left; width:75%;">
                          <div style="float:left; width:100%;">
                            <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                              <!-- <h2 class="hndle ui-sortable-handle">
                                  <span>Separator</span>
                              </h2> -->
                              <div id="submitdiv" class="postbox border" style="margin-bottom:0px !important">
                                <div class="inside">
                                  <div class="submitbox" id="submitpost">
                                    <div id="major-publishing-actions">
                                      <div id="publishing-action">
                                          <input class="tcm-form" name="tcm-text-decoration" id="tcm-text-decoration" type="checkbox" <?php echo ( isset($edit_tcm_text_decoration) && $edit_tcm_text_decoration == 'on' ) ? 'Checked' : ''; ?> title="Text Decoration">Text Decoration
                                      </div>
                                      <div class="clear"></div>
                                    </div>
                                  </div>
                                </div>  
                              </div>

                            </div>
                          </div>
                          <div style="float:left; width:33%; <?php echo ( isset($edit_tcm_text_decoration) && $edit_tcm_text_decoration != 'on' ) ? 'display: none' : 'display: block'; ?>" class="tcm-text-decoration">
                              <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                                <h2 class="hndle ui-sortable-handle">
                                    <span>Line </span>
                                </h2> 
                                <div id="submitdiv" class="postbox border" style="margin-bottom:0px !important">
                                  <div class="inside">
                                    <div class="submitbox" id="submitpost">
                                      <div id="major-publishing-actions">
                                        <div id="publishing-action">
                                            <?php
                                              if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
                                                echo '<select class="tcm-form" name="tcm-text-decoration-line" id="tcm-text-decoration-line" title="Text Decoration Line">';
                                                foreach ($text_decoration_lines as $key => $value) {
                                                  if($key == $edit_tcm_text_decoration_line){
                                                    echo '<option value="'.$key.'" SELECTED>'.$value.'</option>';
                                                  }else{
                                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                                  }
                                                }
                                                echo '</select>';
                                              }else{
                                                echo '<select class="tcm-form" name="tcm-text-decoration-line" id="tcm-text-decoration-line" title="Text Decoration Line">';
                                                foreach ($text_decoration_lines as $key => $value) {
                                                  echo '<option value="'.$key.'">'.$value.'</option>';
                                                }
                                                echo '</select>';
                                              }
                                            ?>
                                        </div>
                                        <div class="clear"></div>
                                      </div>
                                    </div>
                                  </div>  
                                </div>

                              </div>
                          </div>

                          <div style="float:left; width:34%; <?php echo ( isset($edit_tcm_text_decoration) && $edit_tcm_text_decoration != 'on' ) ? 'display: none' : 'display: block'; ?>" class="tcm-text-decoration">
                              <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                                <h2 class="hndle ui-sortable-handle">
                                    <span>Style </span>
                                </h2>                                
                                <div id="submitdiv" class="postbox border" style="margin-bottom:0px !important">
                                  <div class="inside">
                                    <div class="submitbox" id="submitpost">
                                      <div id="major-publishing-actions">
                                        <div id="publishing-action">
                                            <?php
                                              if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
                                                echo '<select class="tcm-form" name="tcm-text-decoration-style" id="tcm-text-decoration-style" title="Text Decoration Style">';
                                                foreach ($text_decoration_styles as $key => $value) {
                                                  if($key == $edit_tcm_text_decoration_style){
                                                    echo '<option value="'.$key.'" SELECTED>'.$value.'</option>';
                                                  }else{
                                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                                  }
                                                }
                                                echo '</select>';
                                              }else{
                                                echo '<select class="tcm-form" name="tcm-text-decoration-style" id="tcm-text-decoration-style" title="Text Decoration Style">';
                                                foreach ($text_decoration_styles as $key => $value) {
                                                  echo '<option value="'.$key.'">'.$value.'</option>';
                                                }
                                                echo '</select>';
                                              }
                                            ?>
                                        </div>
                                        <div class="clear"></div>
                                      </div>
                                    </div>
                                  </div>  
                                </div>

                              </div>
                          </div>

                          <div style="float:left; width:33%; <?php echo ( isset($edit_tcm_text_decoration) && $edit_tcm_text_decoration != 'on' ) ? 'display: none' : 'display: block'; ?>" class="tcm-text-decoration">
                              <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                                <h2 class="hndle ui-sortable-handle">
                                    <span>Color </span>
                                </h2>                                
                                <div id="submitdiv" class="postbox border" style="margin-bottom:0px !important">
                                  <div class="inside">
                                    <div class="submitbox" id="submitpost">
                                      <div id="major-publishing-actions">
                                        <div id="publishing-action">
                                          <input class="tcm-form" name="tcm-text-decoration-color" id="tcm-text-decoration-color" type="color" value="<?php echo ( isset($edit_tcm_text_decoration_color) && $edit_tcm_text_decoration_color ) ? $edit_tcm_text_decoration_color : '#000000'; ?>" placeholder="Text Decoration Color" title="Text Decoration Color">
                                        </div>
                                        <div class="clear"></div>
                                      </div>
                                    </div>
                                  </div>  
                                </div>

                              </div>
                          </div>
                        </div>

                      </div>
                      <div class="clear"></div>
                    </div>
                  </div>
                </div>  
              </div>

            </div>
          </div>
            
        </div>

        <?php
          if( isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' ){
            $edit_tcm_btn = 'block';
          }else{
            $edit_tcm_btn = 'none';
          }
        ?>

        <div id="postbox-container-1" class="postbox-container tcm-custom-style" style="<?php echo ($edit_tcm_style == 0) ? 'display: none' : 'display: block'; ?>">
          <div id="submitdiv" class="postbox tcm-submit" style="display: <?php echo $edit_tcm_btn; ?>">
            <div class="inside">
              <div class="submitbox" id="submitpost">
                <div id="major-publishing-actions">
                  <div id="">
                    <!-- <input class="tcm-form button button-primary button-large tcm-preview" name="tcm-preview" id="tcm-preview" type="button" value="Cloud Preview"> -->
                    <?php 
                      if( isset($_REQUEST['action']) && $_REQUEST['action']=='edit'){
                    ?>
                    <input name="tcm-update" id="tcm-update" class="button button-primary button-large tcm-submit" value="Update" type="submit">
                    <?php
                      } else{
                    ?>
                    <input name="tcm-publish" id="tcm-publish" class="button button-primary button-large tcm-submit" value="Publish" type="submit">
                    <?php
                      }
                    ?>
                  </div>
                  <div class="clear"></div>
                </div>
              </div>
            </div>  
          </div>

          <div id="submitdiv" class="postbox ">
            <div class="inside">
              <div class="submitbox" id="submitpost">
                <h2 class="hndle ui-sortable-handle">
                    <span>Padding </span>
                </h2>
                <div id="major-publishing-actions">
                  <div class="tcm-add" style="float:left; width:100%;">

                    <div style="float:left; width:25%;">
                      <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                        <div class="inside">
                          <div class="submitbox" id="submitpost">
                            <div id="major-publishing-actions">
                              <div id="publishing-action">
                                    <input class="tcm-form" title="Padding Top" name="tcm-padding-top" id="tcm-padding-top" value="<?php echo ( isset($edit_tcm_padding_top) && $edit_tcm_padding_top ) ? $edit_tcm_padding_top : 0; ?>" type="number">
                              </div>
                              <div class="clear"></div>
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div>

                    <div style="float:left; width:25%;">
                      <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                        <div class="inside">
                          <div class="submitbox" id="submitpost">
                            <div id="major-publishing-actions">
                              <div id="publishing-action">
                                    <input class="tcm-form" title="Padding Right" name="tcm-padding-right" id="tcm-padding-right" value="<?php echo ( isset($edit_tcm_padding_right) && $edit_tcm_padding_right ) ? $edit_tcm_padding_right : 0; ?>" type="number">
                              </div>
                              <div class="clear"></div>
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div>

                    <div style="float:left; width:25%;">
                      <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                        <div class="inside">
                          <div class="submitbox" id="submitpost">
                            <div id="major-publishing-actions">
                              <div id="publishing-action">
                                    <input class="tcm-form" title="Padding Bottom" name="tcm-padding-bottom" id="tcm-padding-bottom" value="<?php echo ( isset($edit_tcm_padding_bottom) && $edit_tcm_padding_bottom ) ? $edit_tcm_padding_bottom : 0; ?>" type="number">
                              </div>
                              <div class="clear"></div>
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div>

                    <div style="float:left; width:25%;">
                      <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                        <div class="inside">
                          <div class="submitbox" id="submitpost">
                            <div id="major-publishing-actions">
                              <div id="publishing-action">
                                    <input class="tcm-form" title="Padding Left" name="tcm-padding-left" id="tcm-padding-left" value="<?php echo ( isset($edit_tcm_padding_left) && $edit_tcm_padding_left ) ? $edit_tcm_padding_left : 0; ?>" type="number">
                              </div>
                              <div class="clear"></div>
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div>

                  </div>
                  <div class="clear"></div>
                </div>
              </div>
            </div>  
          </div>

          <div id="submitdiv" class="postbox ">
            <div class="inside">
              <div class="submitbox" id="submitpost">
                <h2 class="hndle ui-sortable-handle">
                    <span>Margin </span>
                </h2>
                <div id="major-publishing-actions">
                  <div class="tcm-add" style="float:left; width:100%;">

                    <div style="float:left; width:25%;">
                      <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                        <div class="inside">
                          <div class="submitbox" id="submitpost">
                            <div id="major-publishing-actions">
                              <div id="publishing-action">
                                    <input class="tcm-form" title="Margin Top" name="tcm-margin-top" id="tcm-margin-top" value="<?php echo ( isset($edit_tcm_margin_top) && $edit_tcm_margin_top ) ? $edit_tcm_margin_top : 0; ?>" type="number">
                              </div>
                              <div class="clear"></div>
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div>

                    <div style="float:left; width:25%;">
                      <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                        <div class="inside">
                          <div class="submitbox" id="submitpost">
                            <div id="major-publishing-actions">
                              <div id="publishing-action">
                                    <input class="tcm-form" title="Margin Right" name="tcm-margin-right" id="tcm-margin-right" value="<?php echo ( isset($edit_tcm_margin_right) && $edit_tcm_margin_right ) ? $edit_tcm_margin_right : 0; ?>" type="number">
                              </div>
                              <div class="clear"></div>
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div>

                    <div style="float:left; width:25%;">
                      <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                        <div class="inside">
                          <div class="submitbox" id="submitpost">
                            <div id="major-publishing-actions">
                              <div id="publishing-action">
                                    <input class="tcm-form" title="Margin Bottom" name="tcm-margin-bottom" id="tcm-margin-bottom" value="<?php echo ( isset($edit_tcm_margin_bottom) && $edit_tcm_margin_bottom ) ? $edit_tcm_margin_bottom : 0; ?>" type="number">
                              </div>
                              <div class="clear"></div>
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div>

                    <div style="float:left; width:25%;">
                      <div id="submitdiv" class="postbox" style="margin-bottom:0px !important">
                        <div class="inside">
                          <div class="submitbox" id="submitpost">
                            <div id="major-publishing-actions">
                              <div id="publishing-action">
                                    <input class="tcm-form" title="Margin Left" name="tcm-margin-left" id="tcm-margin-left" value="<?php echo ( isset($edit_tcm_margin_left) && $edit_tcm_margin_left ) ? $edit_tcm_margin_left : 0; ?>" type="number">
                              </div>
                              <div class="clear"></div>
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div>

                  </div>
                  <div class="clear"></div>
                </div>
              </div>
            </div>  
          </div>

          <div class="tcm-add" style="float:left; width:100%;">
            
            <div style="float:left; width:40%;">
              <div id="submitdiv" class="postbox ">
                <h2 class="hndle ui-sortable-handle">
                    <span>Text Color </span>
                </h2>
                <div class="inside">
                  <div class="submitbox" id="submitpost">
                    <div id="major-publishing-actions">
                      <div id="publishing-action">
                        <input class="tcm-form" name="tcm-text-color" id="tcm-text-color" type="color" value="<?php echo ( isset($edit_tcm_text_color) && $edit_tcm_text_color ) ? $edit_tcm_text_color : '#000000'; ?>" placeholder="Color" title="Text Color">

                      </div>
                      <div class="clear"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div style="float:right; width:59%;">
              <div id="submitdiv" class="postbox ">
                <h2 class="hndle ui-sortable-handle">
                    <span>Background Color </span>
                </h2>
                <div class="inside">
                  <div class="submitbox" id="submitpost">
                    <div id="major-publishing-actions">
                      <div id="publishing-action">
                        <input class="tcm-form" name="tcm-bg-color" id="tcm-bg-color" type="color" value="<?php echo ( isset($edit_tcm_bg_color) && $edit_tcm_bg_color ) ? $edit_tcm_bg_color : '#ffffff'; ?>" placeholder="Color" title="Background   Color">
                      </div>
                      <div class="clear">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="tcm-add" style="float:left; width:100%;">
            <div style="float:left; width:34%;">
              <div id="submitdiv" class="postbox ">
                <h2 class="hndle ui-sortable-handle">
                    <span>Separator </span>
                </h2>
                <div class="inside">
                  <div class="submitbox" id="submitpost">
                    <div id="major-publishing-actions">
                      <div id="publishing-action">
                        <input class="tcm-form" name="tcm-separator-check" id="tcm-separator-check" type="checkbox" <?php echo ( isset($edit_tcm_separator_check) && $edit_tcm_separator_check == 'on' ) ? 'Checked' : ''; ?> title="Separator Status">on/off
                      </div>
                      <div class="clear"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tcm-add" style="float:right; width:65%;">
              <div style="float:left; width:57%;">
                <div id="submitdiv" class="postbox ">
                  <h2 class="hndle ui-sortable-handle">
                      <span>Text Hover </span>
                  </h2>
                  <div class="inside">
                    <div class="submitbox" id="submitpost">
                      <div id="major-publishing-actions">
                        <div id="publishing-action">
                          <input class="tcm-form" name="tcm-text-color" id="tcm-text-color" type="color" value="<?php echo ( isset($edit_tcm_text_color) && $edit_tcm_text_color ) ? $edit_tcm_text_color : '#000000'; ?>" placeholder="Color" title="Text Color">

                        </div>
                        <div class="clear"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- <div style="float:right; width:42%;">
                <div id="submitdiv" class="postbox ">
                  <h2 class="hndle ui-sortable-handle">
                      <span>Background </span>
                  </h2>
                  <div class="inside">
                    <div class="submitbox" id="submitpost">
                      <div id="major-publishing-actions">
                        <div id="publishing-action">
                          <input class="tcm-form" name="tcm-bg-color" id="tcm-bg-color" type="color" value="<?php echo ( isset($edit_tcm_bg_color) && $edit_tcm_bg_color ) ? $edit_tcm_bg_color : '#000000'; ?>" placeholder="Color" title="Background   Color">
                        </div>
                        <div class="clear">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
          </div>

        </div>
      </div>
    </div>
    </div>
    <br class="clear">
  </form>
</div>  
</div>

<?php
  if( isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' ){
    include('tcm-update-script.php'); 
  }else{
    include('tcm-add-script.php'); 
  }
?>
<script type="text/javascript">
  document.getElementById("defaultOpen").click();
</script>