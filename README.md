Simply read this plugin from page 1 onward, it will teach you some basics about how to program for moodle

Some extra things to know:
- db stores the definition of this plugin database and how is the database upgraded if you change it
- lang stores the localization of the plugin in all languages you might want the plugin to be translated to
- version.php stores the moodle version required for the plugin, the version of the plugin and the plugin name
- lib.php holds some moodle callback functions for more advanced functionality

index.php is the page that loads by default if you dont specify a file in the url
- localhost/local/page1.php -> will load page1.php
- localhost/local/ -> will load index.php

