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
    
    #get the current time
    $time = strtotime(date("d-m-Y H:s:i"));

    #make the file name
    #the name includes the user and the time, so the names can't repeat
    $name = "$uploader-$time.$ext";

    #store the file
    $success = $mform->save_file("userfile", "$path/$name");

    if ($success) {
        echo "<p> Success, file uploaded at $path/$name </p>";

        #we create an object to store in the db
        $object = new stdClass();
        $object->uploader = $uploader;
        $object->filename = $name;

        #we insert the object into the db, in the table called "getting_started"
        $DB->insert_record("local_getting_started", $object);
    } else {
        echo "<p> Error, couldn't upload the file </p>";
    }
} else {
    $mform->display();
}

echo "<a href='page6.php'> Next Page </a>";

echo $OUTPUT->footer();
