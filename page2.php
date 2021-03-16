<?php
#PAGE 2: FORMS

require_once("../../config.php");

#we require our form library, where we program the forms we wil luse
require_once("forms.php");

require_login();
if (isguestuser()) {
	die();
}

$PAGE->set_context(context_system::instance());

$name = get_string("name", "local_test");

$PAGE->set_title($name);
$PAGE->set_heading($name);

echo $OUTPUT->header();

#instance your form
#you can read what the form will have in forms -> example_form
$mform = new example_form();

#handle the form
#first case runs if the form is cancelled
if ($mform->is_cancelled()) {
	echo ("Form cancelled");
}
#this case runs when the form is successful
else if ($fromform = $mform->get_data()) {
	#data is in $fromform now
	$name = $fromform->name;
	echo ("Your name is: $name");
	$next_page = get_string("next_page");
	echo "<a href='page3.php> $next_page </a>";
}
#this case runs when the data validation fails or the form hasnt been shown yet
else {
	#since the form hasn't been shown its shown now
	#once the user submits it this page will reload but the relevant path will be taken
	$mform->display();
}

echo $OUTPUT->footer();
