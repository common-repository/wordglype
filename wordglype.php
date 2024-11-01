<?php
/* 
 Plugin Name: WordGlype
 Plugin URI: http://www.JeffsSite.us
 Description: Plugin for runing glype proxy script on your server. Type the word "wordglypebar" with out "" in a post for the glype bar.
 Author: Jeff Schefke Of JPN Enterprise
 Version: 0.1V 
 Author URI: http://www.JeffsSite.us
 */  

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

// Add Proxy bar with Word "wordglypebar"

function word_function ($text) {
	$text = str_replace('wordglypebar', 'Enter URL<form action="wp-content/plugins/wordglype/glype/includes/process.php?action=update" method="post" onsubmit="return updateLocation(this);" class="form"> <input type="text" name="u" id="input" size="40" class="textbox"> <input type="submit" value="Go" class="button"><p>Powerd By <a href="http://www.glype.com">Glype.com</a><p>Plugin By <a href="http://www.wordglype.tk">WordGlype.tk</a></p>', $text);
	return $text;
}
// Add filter to content for bar
add_filter('the_content', 'word_function');

?>
