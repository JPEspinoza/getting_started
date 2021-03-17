<?php
#PAGE 4: THE DATABASE

#The database starts with understading SQL
#designing the database
#then making the database in moodle using the XMLDB editor
#to finally interact with it through $DB

require_once("../../config.php");

require_login();
if (isguestuser()) {
	die();
}

$PAGE->set_context(context_system::instance());

$PAGE->set_url("/local/getting_started/page4.php");
$PAGE->set_title(get_string("pluginname", "local_getting_started"));
$PAGE->set_heading(get_string("page4", "local_getting_started"));

echo $OUTPUT->header();

$next_page = get_string("next_page", "local_getting_started");
echo "<a href='page5.php'> $next_page </a>";

echo $OUTPUT->footer();
