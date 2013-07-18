=== JM Last Twit Shortcode ===
Contributors: jmlapam
Tags: twitter, tweet, API 1.1, shortcode
DonateLink: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=tweetpressfr%40gmail%2ecom&item_name=JM%20Last%20Twit%20Shortcode&no_shipping=0&no_note=1&tax=0&currency_code=EUR&bn=PP%2dDonationsBF&charset=UTF%2d8
Requires at least: 
Tested up to: 3.5.2
License: GPLv2 or later
Stable tag: trunk
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A plugin meant to add your last tweet with the lattest API way :

== Description ==

Once activated the plugin displays your latest tweet according to your settings with authenticated connexion and thanks to a shortcode. 
See **FAQ** here and/or option page of plugin on your installation

<a href="http://twitter.com/tweetpressfr">Follow me on Twitter</a>

––––
En Français 
–––––––––––––––––––––––––––––––––––

Une fois activé le plugin s'occupe d'afficher votre dernier tweet avec une connexion authentifiée et grâce à un shortcode. 
Voir la **FAQ** et/ou la page d'options du plugin sur votre installation

<a href="http://twitter.com/tweetpressfr">Me suivre sur Twitter</a>

== Installation ==

1. Upload plugin files to the /wp-content/plugins/ directory
2. Activate the plugin through the Plugins menu in WordPress
3. Then go to settings > JM Last Twit Shortcode to configure the plugin
4. Do not forget to create your application on <a href="https://dev.twitter.com/apps/" target="_blank">dev.twitter</a>

––––
En Français 
–––––––––––––––––––––––––––––––––––

1. Chargez les fichiers de l'archive dans le dossier /wp-content/plugins/ 
2. Activez le plugin dans le menu extensions de WordPress
3. Allez dans réglages > JM Last Twit Shortcode pour configurer le plugin
4. N'oubliez pas de créer votre application sur <a href="https://dev.twitter.com/apps/" target="_blank">dev.twitter</a>

<a href="http://www.dailymotion.com/tweetpress#video=x10ja68">présentation du plugin en version 3.1.9</a>
<a href="http://www.dailymotion.com/video/xxv3p6_creer-une-application-twitter-basique-pour-recuperer-des-tokens_tech">Tutoriel vidéo pour créer son application sur Twitter</a>

== Frequently asked questions ==

= I get an error message = 
1. If it's `Please update your settings to provide valid credentials` then your credentials (token, keys) are missing or not valid so please check it again.
2. If it's `Call to undefined function curl_init()` then the curl extension is not active on your server. Developers who use WampServer might activate curl extension in PHP > PHP Extension > curl
3. If there are no message but you do not get your Tweet it's probably to Twitter itself so please <a href="http://dev.twitter.com/status/" title="Twitter API Status health">check this link </a>

= How can I get more than 1 tweet? = 
Simple, just use the parameter "count" in shorcode, see example :
`[jmlt count="4"]`
This will display the last 4 tweets from the user specified in option page

= How can I get tweets from another Twitter account? =
`[jmlt username="TweetPressFr"]`
This will display tweet from TweetPressFr

= How can I set cache ? =
`[jmlt cache="1800"]`
This will store tweets during 30 minutes allowing you to limit your API requests 

= How can I delete cache? =
`delete_site_transient( $transient );`
This will delete transient.

----
En Français
–––––––––––––––––––––––––––––––––––

= J'ai un message d'erreur = 
1. S'il s'agit de `Please update your settings to provide valid credentials` vos identifiants (token, clés) sont manquants ou ne sont pas valides vérifiez-les à nouveau SVP.
2. S'il s'agit de `Call to undefined function curl_init()` alors l'extension curl est désactivée sur votre serveur. Les développeurs sous WampServer peuvent activer cette extension dans PHP > PHP Extension > curl
3. Si vous n'avez pas de message d'erreur mais n'obtenez toujours pas vos Tweet c'est probablement du à Twitter lui-même donc SVP <a href="http://dev.twitter.com/status/" title="Twitter API Status health">utilisez ce lien </a>

= Et pour avoir plus d'un tweet? = 
Simple, utilisez le paramètre "count" dans le shorcode, par exemple :
`[jmlt count="4"]`
affichera les 4 derniers tweets de l'utilisateur spécifié en page d'option

= Et pour afficher les tweets d'un autre compte? = 
Utilisez le paramètre "username" dans le shortcode :
`[jmlt username="TweetPressFr"]`
affichera le dernier tweet du compte TweetPressFr

= Comment je fixe le cache ? =
`[jmlt cache="1800"]`
Cela mettra les tweets en cache durant 30 minutes et permettra de limiter les requêtes API

= Comment purger le cache? =
`delete_site_transient( $transient );`
Cela effacera les transients


== Screenshots ==
1. front-end result with default styles
2. quicktags in posts
3. use in widget
4. front-end result when use in widget while using in post


== Changelog ==

= 3.2.9 =
* 04 July 2013
* Improve CSS and add a real example I use on one of my site : http://apis.tweetpress.fr/twitter-feed
* Make styling easier by changing span and adding markup
* Next update will include some js to improve Ux (refresh)
* Have a nice day ^^


= 3.2.8 =
* 29 june 2013
* problem with SVN, update failed yesterday. 
* count is fixed, you can grab as many tweets as possible

= 3.2.7 =
* 28 june 2013
* wrong instructions for CSS on option page (sorry :/). Now it's fixed.

= 3.2.6 =
* 28 june 2013
* Make the plugin respect the display requirements according to https://dev.twitter.com/terms/display-requirements

= 3.2.5 =
* 27 june 2013
* MAJOR UPDATE !
* Change transient system to allow you define cache time in shortcode, just put [jmlt cache="1800"] to store tweets during 30 minutes.
* This will fix 429 errors and now you can use the shortcode several time on your website (1 transient for 1 username)
* Fix bug with current_time(), now it will take local time even if your timezone settings are wrong


= 3.2.4 =
* 22 june 2013
* Remove support for multiple timeline because twitter has changed it rate limits for mentions_timeline, home_timeline and retweets_of_me see https://dev.twitter.com/docs/rate-limiting/1.1/limits
* Now it 15/tweets/user/window and not available for app which triggers error 429
* So you can still use user_timeline (180/tweets/user and 300/tweets/app per window)

= 3.2.3 =
* 22 june 2013
* Improve option page with some explanation (how to use and style the tweets)
* Add class to let you apply your own CSS to the text of your tweets, thanks **sam** to report it and for your suggestion.

= 3.2.2 =
* 19 june 2013
* move the 'tweetfeed' class from the li to the ul to make it easier to style with your own CSS

= 3.2.1 =
* 18 june 2013
* add option to show twittar (Twitter Avatar), just use [jmlt show_twittar="on"] in your post

= 3.2.0 =
* uncomment line 175 to let transient work !!!

= 3.1.9 =
* 2 june 2013
* MAJOR UPDATE
* display more than 1 tweet (new parameter for shortcode -> "count")
* transients are fixed (simple and multisite)
* have fun :=)

= 3.1.8 =
* 15 May 2013
* MAJOR UPDATE
* change library
* display last tweet from any timeline you want

= 3.1.7 =
* 03 May 2013
* wrong position for transient function

= 3.1.6 =
* 03 May 2013
* fix versionning issue in repository

= 3.1.5 =
* 03 May 2013
* fix bug regarding transients in some configurations
* fix bug with use in widget while using in post: 'cannot redeclare function'
* add buttons (shortcuts) in HTML editor

= 3.1 =
* 25 apr 2013
* make error test more accurate
* add opt out for default styles
* add possibility to use shortcode in a widget text

= 3.0 =
* 07 apr 2013
* Reproduce Twitter Style for embedded tweets


= 2.9 =
* 04 apr 2013
* Update library oAuth
* Find a proper way to hide content (delete ugly text-indent:-9999px property)
* Add cool features to make your tweet look pretty much like embedded tweets... 
* Sign in is coming soon

= 2.8 =
* 13 mar 2013
* Important ! Fix transient. 2.7 was a bad update. Sorry guys.
* Correct wrong hook for translation we need in frontend

= 2.7 =
* 10 mar 2013
* Important ! Fix missing get_site_transient. Now contents will update without any problem.

= 2.6 =
* 01 mar 2013
* Important ! forget to delete wrong condition. Next update will include a sign in.


= 2.5 =
* 01 mar 2013
* Important ! fix typo on line 85 "error" > "errors". Next update will include a sign in.

= 2.4 =
* 23 fev 2013
* fix error with condition in 2.2. Actually that can't work because error 200 is not an error !

= 2.3 =
* 22 fev 2013
* fix the way the plugin displays error messages.

= 2.2 =
* 17 fev 2013
* bugfix Multisite : replace get_transient with get_site_transient thanks to great comment by sethmatics

= 2.1 =
* 09 fev 2013
* Add intents (reply, favorite, retweet) with sprites CSS

= 2.0 =
* 09 fev 2013
* Minor Update (minor security fix)

= 1.1.9 =
* 04 fev 2013
* Add missing markup

= 1.1.8 =
* 04 fev 2013
* Remove undefined </div> that breaks design

= 1.1.7 =
* 31 jan 2013
* Adds some warning in case Twitter Api Status is down


= 1.1.6 =
* 27 jan 2013
* Includes timeline parameter for shortcode, enjoy...

= 1.1.5 =
* 25 jan 2013
* Updates public host URL  (really important!)

= 1.1.4 =
* 25 jan 2013
* Adds transient (thanks for the comment Juliobox)

= 1.1.3 =
* 22 jan 2013
* Initial release

== Upgrade notice ==
Nothing
= 1.1.3 =


