<?php
#PAGE 3: THE DATABASE

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

$name = get_string("name", "local_test");
$PAGE->set_url("/local/test/index.php");
$PAGE->set_title($name);
$PAGE->set_heading($name);

echo $OUTPUT->header();

echo $OUTPUT->footer();
