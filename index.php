<?php
#if you put the link as just "/local/getting_started/" without including the file
#the index file loads by default

#this page just redirects to page1, start there

require_once("../../config.php");

redirect("page1.php");
