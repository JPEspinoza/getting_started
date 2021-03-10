<?php
#PAGE 2: FORMS AND PARAMS

require_once("../../config.php");

require_login();
if (isguestuser()){
	die();
}

$PAGE->set_context(context_system::instance());

$name = get_string("name", "local_test");
$PAGE->set_url("/local/test/index.php");
$PAGE->set_title($name);
$PAGE->set_heading($name);

echo $OUTPUT->header();

echo $OUTPUT->footer();