=== Performance Checker by DMUK ===
Contributors: systemdude
Donate link: https://diversify.me.uk/donate/
Tags: performance checker, load testing, test data, bulk posts creation, test data
Requires at least: 5.6
Tested up to: 6.6
Requires PHP: 7.4
Stable tag: 2.26
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Automatically generate bulk test posts in WordPress to simulate load for performance testing.

== Description ==

DMUK (Diversify.me.uk) WordPress Performance Checker is a WordPress plugin designed to help developers and testers create bulk content to test installations with large databases. It enables users to generate test posts and allocate them to test categories in bulk, ensuring that existing posts and categories are not affected. The plugin also provides a simple interface to remove all test data with one click, returning the installation to its original state.

Features:
* Create bulk test posts with customizable content size.
* Allocate test posts to specific test categories.
* Easily remove all test data to restore the original state.
* Prevents existing posts and categories from being affected.
* Displays current database size and feedback after operations.

== Installation ==

1. Upload the plugin folder 'wp-performance-checker' to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Click 'DMUK Perf Check' in the WordPress Dashboard to open the 'WordPress Performance Checker' to configure and use the plugin.

== Frequently Asked Questions ==

= How do I create test posts? =

Click on the 'DMUK Perf Check' menu option in the WordPress admin dashboard. Enter the number of posts, the number of paragraphs, and select a test category. Click the 'Create Test Posts' button to generate the posts. More posts can be added in subsequent batches to different categories, allowing you to quickly and easily develop a test environment with different posts, post sizes, and categories.

= How do I delete the test posts? =

Click the 'DMUK Perf Check' menu option in the WordPress admin dashboard and click the 'Delete ALL Test Posts' button to remove all test posts created by the plugin.

= Will this plugin affect my existing posts and categories? =

No, the plugin should not affect existing data. It is designed to create and manage test posts and categories without affecting your existing posts and categories. However, we advise backing up your site when installing any plugins, themes, or running any scripts.

== Screenshots ==

These can be viewed on the website at https://diversify.me.uk/wordpress-performance-checker-plugin-help/#Screenshot along with additional help and instructions.

== Changelog ==

= 1.0 =
* Initial release.

= 2.0 =
* Increased capacity and comprehensive uninstall implemented.

= 2.24 =
* Admin screen enhanced and installation guide and help screens added.

= 2.25 =
* Default batch sizes reduced to avoid timeouts due to individual server settings.

== Upgrade Notice ==

= 1.0 =
Initial release of the plugin.

= 2.0 =
Increased capacity and comprehensive uninstall implemented.

= 2.24 =
Admin screen enhanced, and installation guide and help screens added.

= 2.25 =
* Default batch sizes reduced to avoid timeouts due to individual server settings.

== License ==

This plugin is licensed under the GPLv2 or later. For more information, visit [https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html).

== Disclaimer ==

By using or acting on any scripts, downloads, advice, suggestions, recommendations or information provided by us, you accept full liability and the fact that we are not liable for any costs or losses however incurred. You should always backup your data before installing any plugin or theme, running scripts or amending content.
