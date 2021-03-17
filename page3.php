<?PHP
#PAGE 3: PARAMS
#params are data that's included from outside the page and can be used to control what is displayed

require_once("../../config.php");

$PAGE->set_context(context_system::instance());

require_login();
if (isguestuser()) {
	die();
}

#this is the parameter, you can reload this page with an edited parameter to display something else
#the parameter is called action, its default value is "view" and its a text parameter
#the parameter usually goes on the url itself, you can see it if you try the plugin
$action = optional_param("action", "view", PARAM_TEXT);

$PAGE->set_url("/local/getting_started/page3.php");
$PAGE->set_title(get_string("pluginname", "local_getting_started"));
$PAGE->set_heading(get_string("page3", "local_getting_started"));

echo $OUTPUT->header();

$current_action = get_string("current_action", "local_getting_started");
$action_string = get_string("action", "local_getting_started");

#if the action is view we add a button that reload this page in the "add" version
if ($action == "view") {
	echo "<p> $current_action view </p>";

	#we create an URL with the parameter "action" set to "add"
	#the empty field is the url of where you want to go, usually used with redirects
	$url = new moodle_url("", array("action" => "add"));

	#we create a button to the next page with the modified url
	echo "<a href=$url> <button class='btn btn-primary'> $action_string: add </button> </a>";
} else if ($action == "add") {
	echo "<p> $current_action add </p>";

	$next_page = get_string("next_page", "local_getting_started");
	echo "<a href='page4.php'> $next_page </a>";
}

echo $OUTPUT->footer();
