<?PHP

function xmldb_local_getting_started_upgrade($oldversion)
{
    global $DB;

    $dbman = $DB->get_manager();
    if ($oldversion < 2021031601) {

        // Define table local_getting_started to be created.
        $table = new xmldb_table('local_getting_started');

        // Adding fields to table local_getting_started.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('uploader', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);

        // Adding keys to table local_getting_started.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for local_getting_started.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Getting_started savepoint reached.
        upgrade_plugin_savepoint(true, 2021031601, 'local', 'getting_started');
    }
}
