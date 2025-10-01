<?php
ob_start(); // ✅ Start output buffering to prevent premature output

define('PREVENT_DIRECT_ACCESS', TRUE);

/*
 * ------------------------------------------------------
 * Session Initialization (MUST run before any output)
 * ------------------------------------------------------
 */
$config = require_once 'app/config/config.php'; // ✅ Load config early if needed

if (headers_sent($file, $line)) {
    die("⚠️ Headers already sent in $file on line $line. Cannot start session.");
}

session_name($config['sess_cookie_name'] ?? ini_get('session.name'));
$expiration = (int)($config['sess_expiration'] ?? ini_get('session.gc_maxlifetime'));
session_set_cookie_params($expiration);

if (!isset($_SESSION)) {
    session_start();
}

/*
 *---------------------------------------------------------------
 * SYSTEM DIRECTORY NAME
 *---------------------------------------------------------------
 */
$system_path = 'scheme';

/*
 *---------------------------------------------------------------
 * APPLICATION DIRECTORY NAME
 *---------------------------------------------------------------
 */
$application_folder = 'app';

/*
 *---------------------------------------------------------------
 * PUBLIC DIRECTORY NAME
 *---------------------------------------------------------------
 */
$public_folder = 'public';

/*
 * ------------------------------------------------------
 * Define Application Constants
 * ------------------------------------------------------
 */
define('ROOT_DIR',  __DIR__ . DIRECTORY_SEPARATOR);
define('SYSTEM_DIR', ROOT_DIR . $system_path . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . $application_folder . DIRECTORY_SEPARATOR);
define('PUBLIC_DIR', $public_folder);

/*
 * ------------------------------------------------------
 * Boot the Framework
 * ------------------------------------------------------
 */
require_once SYSTEM_DIR . 'kernel/LavaLust.php';

ob_end_flush(); // ✅ Send output after everything is ready
?>
