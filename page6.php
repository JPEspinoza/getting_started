<?PHP
#PAGE 6: READING UPLOADED FILES 
#to read files uploaded we need to implement a function to get us the file from an url, this function can be found in lib.php
#important reads
#https://docs.moodle.org/dev/File_API
#https://docs.moodle.org/dev/Using_the_File_API_in_Moodle_forms

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

/*
#this code checks the number of files in the file area
$files = file_get_file_area_info(context_system::instance()->id,"local_getting_started", "files");
var_dump($files);
*/

#get all uploaded files
$files = $DB->get_records("local_getting_started");

foreach ($files as $file) {
    #we make the url that gets us the data
    $url = moodle_url::make_pluginfile_url(context_system::instance()->id, "local_getting_started", "files", 0, "/", "$file->filename");

    #and simply show it
    echo "<p> <a href='$url'> $file->filename by $file->uploader </a> </p>";
}



echo $OUTPUT->footer();
