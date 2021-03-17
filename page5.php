<?PHP
#PAGE 5: UPLOADING FILES
#this is fucking painful 

require_once("../../config.php");
require_once("forms.php");

$PAGE->set_context(context_system::instance());

require_login();
if (isguestuser()) {
    die();
}

$PAGE->set_url("/local/getting_started/page5.php");
$PAGE->set_title("File upload");
$PAGE->set_heading("File upload");

echo $OUTPUT->header();

$mform = new upload_file_form();

if ($mform->is_cancelled()) {
    echo ("Form cancelled");
} else if ($data = $mform->get_data()) {

    #the path to store the file
    $path = "$CFG->dataroot/local/getting_started";

    #if the path doesn't exist, create it
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    #get the uploaded file extension
    $ext = pathinfo($mform->get_new_filename('userfile'), PATHINFO_EXTENSION);

    #get the uploader user id
    $uploader = $USER->id;

    #get the id of the last uploaded file and add 1 to get the new file id
    $table = "local_getting_started"; #table to read from
    $conditions = null; #select everything, no conditions
    $id = $DB->count_records($table, $conditions) + 1;

    #store the file
    $success = $mform->save_file("userfile", "$path/$id.$ext");

    if ($success) {
        echo "<p> Success, file uploaded at $path/$id.$ext </p>";

        #we create an object to store in the db
        $object = new stdClass();
        $object->uploader = $uploader;

        #we insert the object into the db
        $DB->insert_record($table, $object);
    } else {
        echo "<p> Error, couldn't upload the file </p>";
    }
} else {
    $mform->display();
}

echo "<br><a href='page6.php'> Next Page </a>";

echo $OUTPUT->footer();
