<?php

require_once("../../config.php");

#require the forms lib
require_once("$CFG->libdir/formslib.php");

#next_form is the name of the form
class example_form extends moodleform
{
    #all forms need a definition
    public function definition()
    {
        #get variable to edit the form
        $mform = $this->_form;

        #add a textbox called 'name'
        $mform->addElement('text', 'name', get_string('username'));

        #set 'name' to type TEXT
        $mform->setType('name', PARAM_TEXT);

        #set 'name' default value
        $mform->setDefault('name', get_string('username'));

        #add submit and cancel buttons
        $this->add_action_buttons(true, get_string('submit'));
    }

    #the validation is optional
    function validation($data, $files)
    {
        #create an error array so we can return multiple errors at once
        $errors = array();

        #if name has lenght 0 fail
        if ($data['name'] === "") {
            #add the error to the array
            $errors[] = "Name can't be empty";
        }

        #return the errors, they will be shown when the 
        return $errors;
    }
}


class upload_file_form extends moodleform
{
    public function definition()
    {
        $mform = $this->_form;

        #the second parameter is the name of the file uploaded
        $mform->addElement('filepicker', 'userfile', 'File to upload');
        $mform->setType('userfile', PARAM_FILE);

        $this->add_action_buttons(true, get_string('submit'));
    }
}
