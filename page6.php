<?PHP
#PAGE 6: READING UPLOADED FILES 

require_once("../../config.php");

$PAGE->set_context(context_system::instance());

require_login();
if (isguestuser()) {
    die();
}

$PAGE->set_url("/local/getting_started/page6.php");
$PAGE->set_title("File read");
$PAGE->set_heading("File read");

echo $OUTPUT->header();

$url = moodle_url::make_pluginfile_url(context_system::instance()->id, "local_getting_started", "files", 0, '/', "a.pdf");
redirect($url);

echo $OUTPUT->footer();
