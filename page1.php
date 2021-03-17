<?php
#PAGE 1: MAKING A PAGE

#include moodle itself into your custom page
require_once("../../config.php");

#set context
#the context is extremely important, https://docs.moodle.org/310/en/Context
#its basically a permission system to disallow users to access admin pages or courses they arent in
#usually this is already done in the plugins though, so we usually don't have to worry about it
$PAGE->set_context(context_system::instance());

#self explanatory, the context should prevent guest users from seeing the page but just in case
require_login();
if (isguestuser()) {
	die();
}

#this is how you get strings from the lang folder, the language is chosen automatically
$language = get_string("language", "local_getting_started");
$name = get_string("name", "local_getting_started");

#setup the page
$PAGE->set_url("/local/getting/getting_started/page1.php");
$PAGE->set_title($name);
$PAGE->set_heading($name);

#Here we finished setting up the page itself, now we output things to see in the browser

#The moodle header
echo $OUTPUT->header();

#you output your page between the header and footer
#you can output your page with the $OUTPUT class, the html_writer class or alternatively you can echo pure HTML
#html_writer and $OUTPUT are the best practices, and make things like tables significantly easier
#I like HTML as its far simpler, but its less portable and changing the theme might break it

#this is basic HTML, <p> is a paragraph. As you can see we have a variable inside the string, which is one of PHP special moves
$language = get_string("language", "local_getting_started");
echo ("<p> $language </p>");

#<a> is a link
$next_page = get_string("next_page", "local_getting_started");
echo ("<a href='page2.php'> $next_page </a>");

#the moodle bottom
echo $OUTPUT->footer();
