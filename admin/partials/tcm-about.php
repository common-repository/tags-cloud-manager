<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.elsner.com/
 * @since      1.0.0
 *
 * @package    Manage_Custom_Post_Types
 * @subpackage Manage_Custom_Post_Types/admin/partials
 */
	if ( ! defined( 'WPINC' ) ) {
		die;
	}
?>

<div class="about-wrap tcm-about">
  <h1 class="wp-heading-inline">
  	<?php esc_html_e('Tags Cloud Manager for All the Tags','tcm'); ?>
  </h1>
  <div class="about-text">
  	Thank you for choosing <b>Tags Cloud Manager</b> Plugin.
  </div>

	<div class="tab">
	  <button class="tablinks active" onclick="openTab(event, 'About')">Create Tags Cloud</button>
	  <button class="tablinks" onclick="openTab(event, 'Features')">Assign the Design</button>
	</div>

	<div id="About" class="tabcontent" style="display:block">
	  <h3>Getting Started</h3>
		<p><strong>Step 1</strong> : <a href="?page=tcm_add_new">Add new Cloud</a>, For create a Shortcode of Tags Cloud.</p>
		<p><strong>Step 2</strong> : Setup the values - </p>
		<p class="tcm-steps"><b>Slug</b> of Tag/Taxonomy &nbsp;&nbsp;<select disabled><option>post_tag</option></select></p>
		<p class="tcm-steps">Select a <b>Post Type</b> of Tag - it is used only for administrator, When you choose <b>edit</b> in Link section.
		&nbsp;&nbsp;&nbsp;&nbsp;<select disabled>
	        <option value="post" selected=""> Post (Default) </option>
	      </select>
		</p>
		<p class="tcm-steps">Select all the <b>Radio buttons</b> based on your requirements</p>
		<p class="tcm-steps"><b>Order By</b> : Value to order tags by. Accepts 'Name' or 'Count'. Default 'Name'.</p>
		<p class="tcm-steps"><b>Show Count</b> : Whether to display the tag counts. Default 'On'.</p>
		<p class="tcm-steps"><b>Format</b> : Format to display the tag cloud in. Accepts 'Flat' (tags separated with spaces), 'List' (tags displayed in an unordered list). Default 'Flat'.</p>	
		<p class="tcm-steps"><b>Link</b> : View (uses for all) / Edit (Only for administrator)</p>	
		<p class="tcm-steps"><b>Cloud Limit</b> : The number of tags to return. Accepts any positive integer or zero to return all. Default 10.</p>
		<p class="tcm-steps"><b>Separtor</b> : HTML or text to separate the tags.</p>
		<p class="tcm-steps"><b>Size</b> : Largest & Smallest size of the cloud tags.</p>
		<p class="tcm-steps"><b>Order</b> : How to order the tags. Accepts 'ASC' (ascending), 'DESC' (descending), or 'RAND' (random). Default 'ASC'</p>
		<p class="tcm-steps"><b>Font Measure</b> : CSS text size unit to use with the Smallest and Largest values. Accepts any valid CSS text size unit. Default 'pt'.</p>
		<p class="tcm-steps"><b>Exclude</b> : Enter the id of tags, Which tags you doesn't want to display in the Cloud. &nbsp;&nbsp;<input placeholder="4, 12" disabled type="text"></p>
		<p class="tcm-steps"></p>
		<p><strong>Step 3</strong> : After Save this details, You are able to use this shortcode anywhere you want with <strong>Simple design</strong>.</p>
		<p>Go to 2nd tab (Assign the Design) for Custom Design Instructions of Cloud</p>

	</div>

	<div id="Features" class="tabcontent features">
	  <h3>You can create custom designs for Tag Cloud as per your requirements. </h3>

	  <div>
	  	<img src="<?php echo plugins_url(); ?>/tcm/images/screenshot-addnew-2.png">
	  </div>

	</div>

</div>

