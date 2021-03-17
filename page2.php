<?php
#PAGE 2: FORMS

require_once("../../config.php");

#we require our form library, where we program the forms we will use
require_once("forms.php");

require_login();
if (isguestuser()) {
	die();
}

$PAGE->set_context(context_system::instance());

$PAGE->set_url("/local/getting/getting_started/page2.php");
$PAGE->set_title(get_string("pluginname", "local_getting_started"));
$PAGE->set_heading(get_string("page2", "local_getting_started"));

echo $OUTPUT->header();

#instance your form
#you can read what the form will have in forms -> example_form
$mform = new example_form();

#handle the form
#first case runs if the form is cancelled
if ($mform->is_cancelled()) {
	$formcancelled = get_string("form_cancelled", "local_getting_started");
	echo ("<p>$formcancelled</p>");
}
#this case runs when the form is successful
else if ($fromform = $mform->get_data()) {
	#data is in $fromform now
	$name = $fromform->name;
	$yourname = get_string("username", "local_getting_started");
	$next_page = get_string("next_page", "local_getting_started");

	echo ("<p> $yourname: $name </p>");
	echo ("<a href='page3.php'> $next_page </a>");
}
#this case runs when the data validation fails or the form hasnt been shown yet
else {
	#since the form hasn't been shown its shown now
	#once the user submits it this page will reload but the relevant path will be taken
	$mform->display();
}

echo $OUTPUT->footer();
