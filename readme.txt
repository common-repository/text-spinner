=== Text Spinner ===
Contributors: wpgurus
Tags: text spinner, spinner, seo, wordpress seo, spintax, unique content, php spintax, shortcode
Donate link: https://wpgurus.net/text-spinner
Requires at least: 2.5
Tested up to: 5.2
Stable tag: 1.3.0
License: License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows you to use spintax in your posts, pages and theme files

== Description ==
This tiny plugin allows you to use spintax like `{phrase 1|phrase 2|phrase 3}` in your posts, pages and theme files. Just enclose the content that you want to be processed in the shortcode [wpts_spin][/wpts_spin] and a unique copy will be generated on each page load. Alternatively, you can pass the spintax string to the function `wpts_spin()` and echo the returned value.

The plugin can help you avoid duplicate content penalties. For instance if you have a sizable block of text that needs to appear throughout the website then you can write spintax for it and use the above-mentioned shortcode or template tag to generate unique copies.

Nested spintax like `{phrase 1|phrase 2|{sub-phrase 1|sub-phrase 2|sub-phrase 3}}` is also supported by the plugin.

**Example 1:**

*Shortcode:*

`[wpts_spin]{phrase 1|phrase 2|phrase 3}[/wpts_spin]`

*Function:*

`<?php wpts_spin('{phrase 1|phrase 2|phrase 3}'); ?>`

*Sample Output:*

* phrase 1
* phrase 2
* phrase 3

**Example 2 (Nested Spintax):**

*Shortcode:*

`[wpts_spin]{phrase 1|phrase 2|{sub-phrase 1|sub-phrase 2|sub-phrase 3}}[/wpts_spin]`

*Function:*

`<?php wpts_spin( '{phrase 1|phrase 2|{sub-phrase 1|sub-phrase 2|sub-phrase 3}}' ); ?>`

*Sample Output:*

* phrase 1
* sub-phrase 2

**Example 3 (Caching):**

*Shortcode:*

`[wpts_spin cache="604800"]{phrase 1|phrase 2|phrase 3}[/wpts_spin]`

*Function:*

`<?php wpts_spin( '{phrase 1|phrase 2|phrase 3}', array( 'cache' => '604800' ) ); ?>`

*Sample Output:*

Same as Example 1 but the output will be cached for a week (604800 seconds).

== Installation ==
1. Use WordPress' plugin installer to install the plugin.
2. Use the shortcode [wpts_spin] in posts or pages.

== Frequently Asked Questions ==
= How deep can the nesting be? =
It can be as deep as you like. However a nested string might take more time to be processed.

= The same content is appearing on every page load. What could be the problem? =
The plugin works only when the page is rendered dynamically. If the post or page is being loaded from a cache then the same content might keep appearing on every page load.

== Changelog ==
= 1.3.0 =
* Added caching for performance

= 1.2.0 =
* Checked compatibility with WordPress 4.9

= 1.1.0 =
* Checked compatibility with WordPress 4.7

= 1.0.0 =
* Checked compatibility with WordPress 4.6

= 0.1 =
* Initial release