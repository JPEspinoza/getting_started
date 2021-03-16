<?PHP
#PARAMS
#params are data that's included from outside the page and can be used to control what is displayed

require_once("../../config.php");

$PAGE->set_context(context_system::instance());

require_login();
if (isguestuser()) {
	die();
}

$PAGE->set_url("/local/test/index.php");
$PAGE->set_title($name);
$PAGE->set_heading($name);