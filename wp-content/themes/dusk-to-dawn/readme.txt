== Changelog ==

= 1.1 Nov 5 2012 =
* Bugfix: filtering attachment link URLs that don't have pretty permalinks will cause a 404 when viewing an unattached attachment
* Move functions for grabbing bits of content into a new file, for separation and organization
* Clean out unused functions
* Escaping fixes; make sure attribute escaping occurs after printing
* Add styling for HTML5 email inputs
* Updates for the "audio" post format, remove outdated code from js/audio-player.js, use core version of swfobject and list as a dependency of js/audio-player.js, remove unneeded jQuery dependency
* Prevent large images in the post_content from vertically distorting in IE8
* PNG and JPG image compression
* Add Jetpack compatibility file
* Remove loading of $locale.php
* Add a check is_ssl() to define a protocol for Google fonts in order to ensure it's available for both protocols. 
* Switch to add_theme_support( 'custom-background' ) from add_custom_background()