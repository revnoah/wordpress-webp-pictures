=== WebP Pictures ===
Contributors: revnoah
Donate link: https://donate.noahjstewart.com/
Tags: webp image
Requires at least: 5.3
Tested up to: 6.2.0
Stable tag: 6.2.0
Requires PHP: 7.4.2
License: ISC
License URI: https://opensource.org/licenses/ISC

WordPress plugin to replace img with picture tags, and output optimized WebP versions using common functionality built into PHP.

== Description ==

WordPress plugin to replace img with picture tags, and output optimized WebP versions using common functionality built into PHP.

== Features ==

*   Replaces HTML output of img tags
*   Can improve site performance and search ranking

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/webp-pictures` directory, or install the plugin through 
the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress

== Frequently Asked Questions ==

= 

= Will this plugin work with older versions of WordPress or PHP? =

Probably, but it may not function as expected.

== Screenshots ==

1. Testing installation

== Changelog ==

= 1.0.7 =
* testing WordPress 5.3

= 1.0.6 =
* added support for javascript files
* updated readme

= 1.0.5 =
* added icon and banner assets
* added copy of license

= 1.0.4 =
* added readme.txt to plugin archive
* updates and cleanup

= 1.0.3 =
* added template hinting for frontend and backend stylesheets
* refactored code slightly to address code smell

= 1.0.2 =
* added action to add classes to frontend body class
* added settings for displaying on the frontend and backend
* updated phpcs profile
* updated helper function to return array
* fixed nested files in includes folder
* minor updates to readme

= 1.0.1 =
* updated structure
* added gulp and npm workflow
* added markdown files to help with collaboration
* scaffolded out phpunit.xml, tests and bootstrap.php files but tests incomplete
* added phpcs.xml file and customized style rules
* modified code to adhere to phpcs rules, eliminating errors and warnings
* removed general text field from settings

= 1.0.0 =
* Initial commit

== Upgrade Notice ==

= 1.0.5 =
Initial release of plugin to the WordPress community

== About This Plugin ==

This plugin was created by Noah J. Stewart in response to a specific problem. In January 2019, 
Noah Stewart was contacted by his father Jim Stewart regarding a WordPress photo gallery plugin 
that his astronomy club was using. They were having trouble customizing a few of the role-based 
options in a popular gallery plugin. Like any good graphic artist, Jim was trying to improve 
the interface for the site users. The simplest approach to the problem was to use css to 
selectively hide certain elements, ie. invisible content users with the **author** role that 
should be visible to users with the **administrator** role. 
