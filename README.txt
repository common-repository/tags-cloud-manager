=== Plugin Name ===
Contributors: kadiwala, kaumudi
Donate link: https://about.me/aakifkadiwala
Tags: cloud manager, tags cloud, seo, categories cloud, cloud shortcodes
Requires at least: 3.0.1
Tested up to: 5.8.3
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Creating Clouds of taxonomies/tags as per requirements with your design assumptions.

== Description ==

Creating Clouds of taxonomies/tags as per requirements with your design assumptions.

All the Setting Options has been added to admin panel.
Only you have to create a Tag Cloud from admin panel with Custom Design as per Requirements/Assumptions.

If you don't want Any Design, No Problem...
That's option is also available, you can select Simple Design and place CSS as per your design. ( Simple Design/Custom Design ).

== Setting options ==

= Tag Cloud Settings =
* Title
* Order by ( Name/Count )
* Show Count ( on/off )
* Format ( Flat/List )
* Link of the Tag CLoud ( View/Edit )
  ( Edit link is only for admin login based on selected Post Type )
* Number of Tags/Taxonomies to be displayed
* Separator
* Font Size & Measure
* Exclude ID's with comma separator

= Tag Cloud Design Settings =
* Cloud Style ( Simple Style/Custom Style )
* Text Color, Text Hover Color, Background Color
* Text Decoration ( On/Off )
  Line ( Underline/Overline/Line Through ), Line Style ( Solid/Dashed/Dotted/Doublle/Wavy ), Line Color
* Border Color, Border Style ( Solid/Dashed/Dotted/Doublle/Inset/Outset/Groove/Ridge ), Border Width, Border Radius
* Padding, Margin
* Separation ( On/Off )
* Separation Decoration ( On/Off )


== Shortcode ==

We can place the shortcode in any Page/Post, which is created like - 
<pre>
[tcm id="{tag_cloud_id}" title="false" taxonomy="{taxonomy/tag}"]
</pre>

If you want to Display Tag Cloud Title, So please update shortcode to like - 
<pre>
[tcm id="{tag_cloud_id}" title="true" taxonomy="{taxonomy/tag}"]
</pre>


== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `tcm.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
