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

#select 5 files
$path = "$CFG->dataroot/local/getting_started";
$files = $DB->get_records("local_getting_started", null, '', '*', 0, 5);

foreach ($files as $file) {
    echo "<a href='$path/$file->filename'> <p> File </p> </a>";
}


echo $OUTPUT->footer();
