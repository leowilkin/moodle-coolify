<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = getenv('MOODLE_DB_TYPE') ?: 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost    = getenv('MOODLE_DB_HOST') ?: 'localhost';
$CFG->dbname    = getenv('MOODLE_DB_NAME') ?: 'moodle';
$CFG->dbuser    = getenv('MOODLE_DB_USER') ?: 'moodleuser';
$CFG->dbpass    = getenv('MOODLE_DB_PASSWORD') ?: 'moodlepass';
$CFG->prefix    = getenv('MOODLE_DB_PREFIX') ?: 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => (int)(getenv('MOODLE_DB_PERSISTENT') ?: 0),
  'dbport' => getenv('MOODLE_DB_PORT') ?: '',
  'dbsocket' => getenv('MOODLE_DB_SOCKET') ?: '',
  'dbcollation' => getenv('MOODLE_DB_COLLATION') ?: 'utf8mb4_unicode_ci',
);

$CFG->wwwroot   = rtrim(getenv('APP_URL') ?: 'http://localhost:8080', '/');
$CFG->sslproxy  = true;
$CFG->dataroot  = getenv('MOODLE_DATA') ?: '/Users/leo/moodledata';
$CFG->admin     = getenv('MOODLE_ADMIN_USER') ?: 'admin';

$CFG->directorypermissions = 02777;

require_once(__DIR__ . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
