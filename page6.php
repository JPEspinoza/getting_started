<?PHP
#PAGE 5: READING UPLOADED FILES 

require_once("../../config.php");

$PAGE->set_context(context_system::instance());

require_login();
if (isguestuser()) {
    die();
}

$PAGE->set_url("/local/test/page6.php");
$PAGE->set_title("File read");
$PAGE->set_heading("File read");

echo $OUTPUT->header();

$files = $DB->get_records("test_files");

foreach($files as $file) {
    $messagetext = file_rewrite_pluginfile_urls("Test", "pluginfile.php", 30, "local_test", "upload", $file->path);
    var_dump($messagetext);

    echo "<br>";
}

echo $OUTPUT->footer();
