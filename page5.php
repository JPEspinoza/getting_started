<?PHP
#PAGE 5: UPLOADING FILES

require_once("../../config.php");
require_once("forms.php");

$context = context_system::instance();

$PAGE->set_context($context);

require_login();
if (isguestuser()) {
    die();
}

$PAGE->set_url("/local/getting_started/page5.php");
$PAGE->set_title(get_string("pluginname", "local_getting_started"));
$PAGE->set_heading(get_string("page5", "local_getting_started"));

echo $OUTPUT->header();

#we add the upload form, which contains a filepicker
$mform = new upload_file_form();

if ($mform->is_cancelled()) {
    $form_cancelled = get_string("form_cancelled", "local_getting_started");
    echo ("<p> $form_cancelled </p>");
} else if ($data = $mform->get_data()) {

    #we extract the extension from the uploaded file, since we need to store it
    $extension = pathinfo($mform->get_new_filename('userfile'), PATHINFO_EXTENSION);

    #we create a new name for the file, to get a unique one we get the user id and the unix time
    $time = strtotime(date("d-m-Y H:s:i"));
    $name = "$USER->id-$time.$extension";

    #we store the file
    #userfile is the filepicker name
    #context->id is the context we want the file to have? I don't know how it works
    #local_getting_started is the component name (plugin name)
    #files is the filearea name, it can be anything we want
    #0 is the itemid, the file area unique id
    # / is the folder within the filearea, / is the root, or the first foler
    #$name is the new name for the file
    $result = $mform->save_stored_file("userfile", $context->id, "local_getting_started", "files", 0, "/", $name);

    if($result) 
    {
        $file_uploaded = get_string("file_uploaded", "local_getting_started");
        echo "<p> $file_uploaded: $name </p>";

        #we create a new entry in the db, storing the user who uploaded the thing and the file name
        $object = new stdClass();
        $object->uploader = $USER->id;
        $object->filename = $name;
        $DB->insert_record("local_getting_started", $object);
    }
    else {
        $file_failure = get_string("file_uploaded_file", "local_getting_started");
        echo "<p> $file_failure </p>";
    }

} else {
    $mform->display();
}

$next_page = get_string("next_page", "local_getting_started");
echo "<a href='page6.php'> $next_page </a>";

echo $OUTPUT->footer();
