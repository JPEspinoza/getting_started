<?PHP
#PAGE 5: UPLOADING FILES 

require_once("../../config.php");
require_once("forms.php");

$PAGE->set_context(context_system::instance());

require_login();
if (isguestuser()) {
    die();
}

$PAGE->set_url("/local/test/page5.php");
$PAGE->set_title("File upload");
$PAGE->set_heading("File upload");

echo $OUTPUT->header();

$mform = new upload_file_form();

if ($mform->is_cancelled()) {
    echo ("Form cancelled");
} else if ($fromform = $mform->get_data()) {
    $itemid = $fromform->userfile;

    $file = $mform->save_stored_file('userfile', 30, 'local_test', 'upload', $itemid);

    $data = new stdClass();
    $data->path = "$itemid";

    $DB->insert_record("test_files", $data);

    if ($file) {
        echo "File uploaded";
    } else {
        echo "upload failed";
    }
    echo "<br><a href='page6.php'> Next Page </a>";
} else {
    $mform->display();
}

echo $OUTPUT->footer();
