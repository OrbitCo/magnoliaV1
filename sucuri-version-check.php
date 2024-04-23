<?php

/* Function requested by Giannis to test if tool was uploaded correctly */
if ( isset( $_GET['test'] ) ) exit;

@set_time_limit(0);
@ini_set("max_execution_time", 0);
@set_time_limit(0);
@ignore_user_abort(true);
if (extension_loaded('xdebug') && !isset($_GET['robot'])) {
    echo 'Xdebug detected - exitting...';
    die();
}

// Version to be updated on every build
$myversion='20221215_2200';

function isTerminal()
{
    return !isset($_SERVER['REMOTE_ADDR']) && isset($_SERVER['SHELL']);
}

if (!isTerminal()){
    echo "<head><style>.noselect {
        -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none;   /* Chrome/Safari/Opera */
        -khtml-user-select: none;    /* Konqueror */
        -moz-user-select: none;      /* Firefox */
        -ms-user-select: none;       /* IE/Edge */
        user-select: none;           /* non-prefixed version, currently
                                  not supported by any browser */
    }</style></head>";
}

/* If running via terminal. */
if (isTerminal())  parse_str(implode('&', array_slice($argv, 1)), $_GET);

/**
 * Prevents the non-supervised execution of the cleanup script.
 *
 * The main idea of this condition is to automatically delete this and other
 * scripts that were uploaded by one of our security analysts to a customer's
 * website during a regular malware cleanup.
 *
 * If the analyst forgets to delete these files and a web crawler finds them,
 * the direct execution of the script without the required parameters will
 * trigger the deletion of the cleanup suite.
 *
 * @option srun Stop the automatic deletion of the unsupervised scripts.
 */

if (!isset($_GET['srun'])) {
    @unlink('sucuri-cleanup.php');
    @unlink('sucuri-version-check.php');
    @unlink('sucuri-wpdb-clean.php');
    @unlink('sucuri-db-cleanup.php');
    @unlink('sucuri-db-clean.php');
    @unlink('sucuri_listcleaned.php');
    @unlink('sucuri-filemanager.php');
    @unlink('sucuri-toolbox.php');
    @unlink('sucuri-toolbox-client.php');
    @unlink('sucuri-adminer.php');
    @unlink('sucuri-magento2.php');
    @unlink('sucuri_db_clean.php');
    @unlink('google936278b9bb435851.html');
    @unlink('google79c13c5605e6f406.html');
    @unlink('googlee6cb14d10ed8d0d2.html');
    @unlink('googlec55310faa35e04c1.html');
    @unlink(__FILE__);
    exit(0);
}


$VULN_SOFTWARE = array("wordpress" => array('1.2'=>array(0,1,2,3,4,5,6,),'1.2.1'=>array(0,2,3,4,5,6,),'1.5'=>array(7,8,9,10,2,3,4,5,6,11,),'1.5.1'=>array(12,13,14,2,3,4,5,6,11,),'1.5.1.1'=>array(12,15,16,13,14,10,2,3,4,5,6,11,),'1.5.1.2'=>array(12,17,13,14,2,3,4,5,6,11,),'1.5.1.3'=>array(12,18,13,14,2,3,11,),'1.5.2'=>array(12,13,14,2,3,11,),'2.0'=>array(12,19,13,14,20,21,22,23,24,2,3,11,),'2.0.1'=>array(12,19,13,14,20,21,22,23,24,2,3,11,),'2.0.2'=>array(19,25,13,14,26,20,21,22,23,24,2,3,11,),'2.0.3'=>array(19,13,14,26,20,21,22,23,24,27,2,3,11,),'2.0.4'=>array(19,13,14,26,20,21,22,23,24,27,2,3,11,),'2.0.5'=>array(19,28,13,14,20,21,22,23,24,27,2,3,11,),'2.0.6'=>array(19,29,13,14,20,21,22,23,24,27,2,3,11,),'2.0.7'=>array(19,13,14,20,21,22,23,24,27,2,3,11,),'2.0.8'=>array(13,14,20,21,22,23,24,2,3,11,),'2.0.9'=>array(13,14,20,21,22,23,24,27,2,3,11,),'2.0.10'=>array(19,13,14,20,21,22,23,24,27,2,3,11,),'2.0.11'=>array(19,13,14,20,21,22,23,24,27,2,3,11,),'2.1'=>array(13,14,20,21,22,23,24,27,2,3,11,),'2.1.1'=>array(19,30,13,14,20,21,22,23,24,27,2,3,31,11,),'2.1.2'=>array(19,32,33,13,14,20,21,22,23,24,27,2,3,11,),'2.1.3'=>array(19,34,13,14,20,21,22,23,24,27,2,3,11,),'2.2'=>array(19,35,36,13,14,20,21,22,23,24,27,2,3,11,),'2.2.1'=>array(19,13,14,20,21,22,23,24,27,2,3,11,),'2.2.2'=>array(19,13,14,20,21,22,23,24,27,2,3,11,),'2.2.3'=>array(19,13,14,20,21,22,23,24,27,2,3,11,),'2.3'=>array(13,14,20,21,22,23,24,27,2,3,11,),'2.3.1'=>array(19,37,13,14,20,21,22,23,24,27,2,3,11,),'2.3.2'=>array(19,13,14,20,21,22,23,24,27,2,3,11,),'2.3.3'=>array(19,13,14,20,21,22,23,24,2,3,11,),'2.5'=>array(38,39,13,14,20,21,22,23,24,27,2,3,40,11,),'2.5.1'=>array(19,39,13,14,20,21,22,23,24,27,2,3,40,11,),'2.6'=>array(39,13,14,20,21,22,23,24,27,2,3,41,40,11,),'2.6.1'=>array(19,42,39,13,14,20,21,22,23,24,27,2,3,41,40,11,),'2.6.2'=>array(19,39,13,14,20,21,22,23,24,27,2,3,41,40,11,),'2.6.3'=>array(39,13,14,20,21,22,23,24,27,2,3,41,40,11,),'2.6.5'=>array(19,39,13,14,20,21,22,23,24,2,3,41,40,11,),'2.7'=>array(19,39,13,14,20,21,22,23,24,27,2,3,43,41,40,11,),'2.7.1'=>array(19,39,13,14,20,21,22,23,24,27,2,3,43,41,40,11,),'2.8'=>array(39,13,14,20,21,22,23,24,27,2,3,43,41,40,44,11,45,),'2.8.1'=>array(46,39,13,14,20,21,22,23,24,27,2,3,43,41,40,44,11,45,),'2.8.2'=>array(39,13,14,20,21,22,23,24,27,2,3,43,41,40,44,11,45,),'2.8.3'=>array(47,39,13,14,20,21,22,23,24,27,2,3,43,41,40,44,11,45,),'2.8.4'=>array(39,13,14,20,21,22,23,24,27,2,3,43,41,40,44,11,45,),'2.8.5'=>array(48,39,13,14,20,21,22,23,24,27,2,3,43,41,40,44,11,45,),'2.8.6'=>array(39,13,14,20,21,22,23,24,27,2,3,43,41,40,44,11,45,),'2.9'=>array(49,50,39,13,14,20,21,22,23,24,27,2,3,43,41,40,44,51,11,45,),'2.9.1'=>array(39,13,14,20,21,22,23,24,27,2,3,43,41,40,44,51,11,45,),'2.9.2'=>array(39,13,14,20,21,22,23,24,27,2,3,43,41,40,44,51,11,45,),'3.0'=>array(39,13,14,52,53,54,55,20,21,22,23,24,56,27,57,58,2,3,59,43,60,61,41,40,44,51,11,45,62,),'3.8.5'=>array(59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.8.6'=>array(59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.8.7'=>array(59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.8.8'=>array(59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.8.9'=>array(63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.8.10'=>array(68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.8.11'=>array(71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.8.12'=>array(72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.8.13'=>array(43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.8.14'=>array(75,41,40,44,51,76,11,45,62,77,),'3.8.15'=>array(40,44,51,76,11,45,62,77,),'3.8.16'=>array(51,76,11,45,62,77,),'3.8.17'=>array(77,),'3.9'=>array(78,27,57,79,80,58,2,3,81,82,83,59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.9.1'=>array(78,27,57,79,80,58,2,3,81,82,59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.9.2'=>array(80,58,2,3,81,82,84,59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.9.3'=>array(85,59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.9.4'=>array(59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.9.5'=>array(59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.9.6'=>array(59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.9.7'=>array(63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.9.8'=>array(68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.9.9'=>array(71,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.9.10'=>array(72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.9.11'=>array(43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'3.9.12'=>array(75,41,40,44,51,76,11,45,62,77,),'3.9.13'=>array(40,44,51,76,11,45,62,77,),'3.9.14'=>array(51,76,11,45,62,77,),'3.9.15'=>array(77,),'4.0'=>array(2,3,81,82,83,84,59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.0.1'=>array(83,82,59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.0.2'=>array(59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.0.3'=>array(59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.0.4'=>array(59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.0.5'=>array(59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.0.6'=>array(63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.0.7'=>array(68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.0.8'=>array(71,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.0.9'=>array(72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.0.10'=>array(43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.0.11'=>array(75,41,40,44,51,76,11,45,62,77,),'4.0.12'=>array(40,44,51,76,11,45,62,77,),'4.0.13'=>array(51,76,11,45,62,77,),'4.0.14'=>array(77,),'4.1'=>array(82,83,86,87,59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.1.1'=>array(82,83,85,86,87,59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.1.2'=>array(85,86,59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.1.3'=>array(86,59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.1.4'=>array(86,59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.1.5'=>array(59,63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.1.6'=>array(63,64,65,66,67,68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.1.7'=>array(68,69,70,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.1.8'=>array(71,71,72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.1.9'=>array(72,73,43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.1.10'=>array(43,60,61,74,75,41,40,44,51,76,11,45,62,77,),'4.1.11'=>array(75,41,40,44,51,76,11,45,62,77,),'4.1.12'=>array(40,44,51,76,11,45,62,77,),'4.5.1'=>array(88,74,89,75,41,40,44,90,51,76,11,45,62,91,77,92,),'4.5.2'=>array(89,75,41,93,94,95,40,44,90,51,76,11,45,62,91,77,92,),'4.5.3'=>array(96,40,44,90,51,76,11,45,62,91,77,92,),'4.5.4'=>array(90,51,76,11,45,62,91,77,92,),'4.5.5'=>array(90,91,77,92,),'4.6'=>array(40,44,90,51,76,11,45,62,91,77,92,),'4.6.1'=>array(90,51,76,11,45,62,91,77,92,),'4.6.2'=>array(91,77,92,),'4.7'=>array(90,97,51,98,76,11,45,62,91,77,92,99,),'4.7.1'=>array(91,77,92,99,),));


$VULNERABILITIES = array('WordPress 1.2-1.2.1 - Multiple Cross-Site Scripting (XSS)','WordPress 1.2 - HTTP Response Splitting','WordPress <= 4.0 - Long Password Denial of Service (DoS)','WordPress <= 4.0 - Server Side Request Forgery (SSRF)','WordPress <= 1.5.1.2 - XMLRPC Eval Injection ','WordPress <= 1.5.1.2 - Multiple Cross-Site Scripting (XSS)','WordPress <= 1.5.1.2 - Email Spoofing','WordPress 1.5 wp-trackback.php tb_id Parameter SQL Injection','WordPress <= 1.5 Multiple Vulnerabilities (XSS, SQLi)','WordPress 1.5 template-functions-post.php Multiple Field XSS','WordPress 1.5 & 1.5.1.1 - SQL Injection','WordPress <= 4.7 - Post via Email Checks mail.example.com by Default','Wordpress 1.5.1 - 2.0.2 wp-register.php Multiple Parameter XSS','WordPress 1.5.1 - 3.5 XMLRPC Pingback API Internal/External Port Scanning','WordPress 1.5.1 - 3.5 XMLRPC pingback additional issues','WordPress <= 1.5.1.1 "add new admin" SQL Injection Exploit','WordPress <= 1.5.1.1 SQL Injection Exploit','WordPress <= 1.5.1.2 - XMLRPC SQL Injection','Wordpress <= 1.5.1.3 Remote Code Execution eXploit (metasploit)','WordPress 2.0 - 2.7.1 admin.php Module Configuration Security Bypass ','WordPress 2.0 - 3.0.1 wp-includes/comment.php Bypass Spam Restrictions','WordPress 2.0 - 3.0.1 Multiple Cross-Site Scripting (XSS) in request_filesystem_credentials()','WordPress 2.0 - 3.0.1 Cross-Site Scripting (XSS) in wp-admin/plugins.php','WordPress 2.0 - 3.0.1 wp-includes/capabilities.php Remote Authenticated Administrator Delete Action Bypass','WordPress 2.0 - 3.0 Remote Authenticated Administrator Add Action Bypass','WordPress <= 2.0.2 (cache) Remote Shell Injection Exploit','WordPress 2.0.2 - 2.0.4 Paged Parameter SQL Injection ','WordPress 2.0.3 - 3.9.1 (except 3.7.4 / 3.8.4) CSRF Token Brute Forcing','Wordpress 2.0.5 Trackback UTF-7 Remote SQL Injection Exploit','Wordpress <= 2.0.6 wp-trackback.php Remote SQL Injection Exploit','WordPress 2.1.1 - Comm& Execution Backdoor','WordPress 2.1.1 - RCE Backdoor','WordPress \'year\' Cross-Site Scripting (XSS)','WordPress 2.1.2 Authenticated XMLRPC SQL Injection','Wordpress 2.1.3 admin-ajax.php SQL Injection Blind Fishing Exploit','WordPress 2.2 (wp-app.php) Arbitrary File Upload Exploit','Wordpress 2.2 (xmlrpc.php) Remote SQL Injection Exploit','Wordpress <= 2.3.1 Charset Remote SQL Injection ','Wordpress 2.5 Cookie Integrity Protection ','WordPress 2.5 - 3.3.1 XSS in swfupload','WordPress 2.5-4.6 - Authenticated Stored Cross-Site Scripting via Image Filename','WordPress 2.6.0-4.5.2 - Unauthorized Category Removal from Post','Wordpress 2.6.1 (SQL Column Truncation) Admin Takeover Exploit','WordPress <= 4.4.2 - SSRF Bypass using Octal & Hexedecimal IP addresses','WordPress 2.8-4.6 - Path Traversal in Upgrade Package Uploader','WordPress 2.8-4.7 - Accessibility Mode Cross-Site Request Forgery (CSRF)','Wordpress 2.8.1 (url) Remote Cross Site Scripting Exploit','Wordpress <= 2.8.3 Remote Admin Reset Password ','WordPress <= 2.8.5 Unrestricted File Upload Arbitrary PHP Code Execution','WordPress 2.9 Failure to Restrict URL Access','WordPress 2.9 - Failure to Restrict URL Access','WordPress 2.9-4.7 - Authenticated Cross-Site scripting (XSS) in update-core.php','WordPress <= 3.0.5 wp-admin/press-this.php Privilege Escalation','WordPress <= 3.3.2 Cross-Site Scripting (XSS) in wp-includes/default-filters.php','WordPress <= 3.3.2 wp-admin/media-upload.php sensitive information disclosure or bypass','WordPress <= 3.3.2 wp-admin/includes/class-wp-posts-list-table.php sensitive information disclosure by visiting a draft','WordPress 3.0 - 3.6 Crafted String URL Redirect Restriction Bypass','WordPress 3.0 - 3.9.1 Authenticated Cross-Site Scripting (XSS) in Multisite','WordPress 3.0-3.9.2 - Unauthenticated Stored Cross-Site Scripting (XSS)','WordPress <= 4.2.2 - Authenticated Stored Cross-Site Scripting (XSS)','WordPress <= 4.4.2 - Reflected XSS in Network Settings','WordPress <= 4.4.2 - Script Compression Option CSRF','WordPress 3.0-4.7 - Cryptographically Weak Pseudo-Random Number Generator (PRNG)','WordPress <= 4.2.3 - wp_untrash_post_comments SQL Injection ','WordPress <= 4.2.3 - Timing Side Channel Attack','WordPress <= 4.2.3 - Widgets Title Cross-Site Scripting (XSS)','WordPress <= 4.2.3 - Nav Menu Title Cross-Site Scripting (XSS)','WordPress <= 4.2.3 - Legacy Theme Preview Cross-Site Scripting (XSS)','WordPress <= 4.3 - Authenticated Shortcode Tags Cross-Site Scripting (XSS)','WordPress <= 4.3 - User List Table Cross-Site Scripting (XSS)','WordPress <= 4.3 - Publish Post & Mark as Sticky Permission Issue','WordPress  3.7-4.4 - Authenticated Cross-Site Scripting (XSS)','WordPress 3.7-4.4.1 - Local URIs Server Side Request Forgery (SSRF)','WordPress 3.7-4.4.1 - Open Redirect','WordPress <= 4.5.1 - Pupload Same Origin Method Execution (SOME)','WordPress 3.6-4.5.2 - Authenticated Revision History Information Disclosure','WordPress 3.4-4.7 - Stored Cross-Site Scripting (XSS) via Theme Name fallback','WordPress 3.5-4.7.1 - WP_Query SQL Injection',' WordPress 3.9 & 3.9.1 Unlikely Code Execution','WordPress 3.6 - 3.9.1 XXE in GetID3 Library','WordPress 3.4.2 - 3.9.2 Does Not Invalidate Sessions Upon Logout','WordPress 3.9, 3.9.1, 3.9.2, 4.0 - XSS in Media Playlists','WordPress <= 4.1.1 - Unauthenticated Stored Cross-Site Scripting (XSS)','WordPress 3.9-4.1.1 - Same-Origin Method Execution','WordPress <= 4.0 - CSRF in wp-login.php Password Reset','WordPress <= 4.2 - Unauthenticated Stored Cross-Site Scripting (XSS)','WordPress 4.1-4.2.1 - Genericons Cross-Site Scripting (XSS)','WordPress 4.1 - 4.1.1 - Arbitrary File Upload','WordPress 4.2-4.5.1 - MediaElement.js Reflected Cross-Site Scripting (XSS)','WordPress 4.2-4.5.2 - Authenticated Attachment Name Stored XSS','WordPress 4.3-4.7 - Potential Remote Command Execution (RCE) in PHPMailer','WordPress 4.2.0-4.7.1 - Press This UI Available to Unauthorised Users','WordPress 4.3.0-4.7.1 - Cross-Site Scripting (XSS) in posts list table','WordPress 4.5.2 - Redirect Bypass','WordPress 4.5.2 - oEmbed Denial of Service (DoS)','WordPress 4.5.2 - Password Change via Stolen Cookie','WordPress 4.5.3 - Authenticated Denial of Service (DoS)','WordPress 4.7 - User Information Disclosure via REST API','WordPress 4.7 - Cross-Site Request Forgery (CSRF) via Flash Upload','WordPress 4.7.0-4.7.1 - Unauthenticated Page/Post Content Modification via REST API',);

if ($VULN_SOFTWARE == null) {
    echo "ERROR: Unable to get current versions. Please contact support@sucuri.net for guidance.\n";
    exit(1);
}

// Get file content and find the line with content
function findLineInFile($file, $content)
{
    $fh = @fopen($file, "r");
    if (!$fh) {
        echo "DEBUG: UNABLE TO CHECK " . escapeHtml($file) . "\n";
        return null;
    }
    while (($buffer = fgets($fh, 4096)) !== false) {
        if (strpos($buffer, $content) !== false) {
            fclose($fh);
            return $buffer;
        }
    }
    fclose($fh);
    return null;
}

if (!function_exists('file_get_contents')) { // below PHP 4.3
    function file_get_contents($fileName) {
        $fh = @fopen($fileName);
        if ($fh === false) {
            return false;
        }
        $res = fread($fh, 1048576);
        fclose($fh);
        return $res;
    }
}

define('OPT_TYPE_CONST',      1);
define('OPT_TYPE_VAR',        2);
define('OPT_TYPE_ASSOC',      4);
define('OPT_TYPE_ENV',        8);
define('OPT_TYPE_XML',       16);
define('OPT_TYPE_FIRST',     32);
define('OPT_TYPE_CONST_NUM', 64);
define('OPT_TYPE_PHPDOTENV', 128);

function getOptMatch($m, $type)
{
    return ($type & OPT_TYPE_FIRST) ? $m[0] : $m[count($m) - 1];
}

function getOption($option, $config, $type)
{
    $option = preg_quote($option);

    // String constants (WordPress)
    if (($type & OPT_TYPE_CONST) &&
        preg_match_all('@^\s*define\(\s*([\'"])' . $option . '\1\s*,\s*([\'"])(.*)\2\s*\)\s*;@m', $config, $m)) {
            return stripslashes(getOptMatch($m[3], $type));
    }

    // Numeric constants
    if (($type & OPT_TYPE_CONST_NUM) &&
        preg_match_all('@^\s*define\(\s*([\'"])' . $option . '\1\s*,\s*(\d*)\s*\)\s*;@m', $config, $m)) {
            return stripslashes(getOptMatch($m[2], $type));
    }

    // wp-config.php trick, see
    // http://www.wpbeginner.com/wp-tutorials/useful-wordpress-configuration-tricks-that-you-may-not-know/
    if (($type & OPT_TYPE_ENV) && preg_match('@^\s*define\(\s*([\'"])' . $option . '\1\s*,\s*\$_ENV\s*[[{]\s*' .
        '([\'"]?)DATABASE_SERVER\2\s*[}\]]\s*\)\s*;@m', $config, $m)) {
            return $_ENV['DATABASE_SERVER'];
    }

    // Variables (Joomla, WordPress prefix)
    if (($type & OPT_TYPE_VAR) &&
        preg_match_all('@^\s*(?:public|var)?\s*' . $option . '\s*=\s*(?:([\'"])(.*)\1|([0-9]+))\s*;@m', $config, $m)) {
            $str = getOptMatch($m[2], $type); // Return the string m[2] or the number m[3] if the string was not found
            return $str ? stripslashes($str) : getOptMatch($m[3], $type);
    }

    // Associative arrays (Drupal)
    if (($type & OPT_TYPE_ASSOC) &&
        preg_match_all('@(?:^|,|\()\s*([\'"])' . $option . '\1\s*=>\s*([\'"])(.*?)\2\s*[,)]@m', $config, $m)) {
            return stripslashes(getOptMatch($m[3], $type));
    }

    // Magento XML config
    if (($type & OPT_TYPE_XML) && preg_match_all('@^\s*<' . $option . '>(?:<!\[CDATA\[|\{\{)(.*)(?:}}|\]\]>)</' .
        $option . '>\s*$@m', $config, $m)) {
            return getOptMatch($m[1], $type);
    }
    
    // PHPDotEnv .env config files
    if (($type == OPT_TYPE_PHPDOTENV) && preg_match_all('@^' . $option . '[^\=]*[^\w+]*[^\s*]*@m', $config, $m)) {
            return preg_replace('@^' . $option . '[^\=]*[^\w+]*@m', "",$m[0][0]);
    }

    return '';
}


// Properly escape HTML content
function escapeHTML($string)
{
    global $isPlainText;

    if ($isPlainText) {
        return $string;
    }

    if (!defined('ENT_SUBSTITUTE')) {
        define('ENT_SUBSTITUTE', 0);
    }

    return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$VULNERABLE_PLUGINS = array(
    'fancybox.php' => array('3.0.2', 'https://blog.sucuri.net/2015/02/zero-day-in-the-fancybox-for-wordpress-plugin.html', 'Fancybox'),
    'gravityforms.php' => array('1.8.20', 'https://blog.sucuri.net/2015/02/malware-cleanup-to-arbitrary-file-upload-in-gravity-forms.html', 'Gravity Forms'),
    'hdflvvideoshare.php' => array('2.8', '', 'HDFLV Videoshare'),
    'grpdocsassembly.php' => array('2.0.5', '', 'Group Docs Assembly'),
    'wp-seo.php' => array('3.4.2', '', 'Yoast SEO'),
    'blogvault.php' => array('1.45', 'https://blogvault.net/security-notification/', 'BlogVault'),
    'duplicator.php' => array('1.2.29', '', 'SnapCreek'),
    'wp-gdpr-compliance.php' => array('1.4.3', '', 'WP GDPR Compliance'),
    'propeller-ads.php' => array('1.0.0', 'This plugin is known for having hardcoded links to ad-rotators involved in fraud.', 'PropellerAds'),
    'easy-wp-smtp.php' => array('1.3.9', 'https://blog.sucuri.net/2019/03/0day-vulnerability-in-easy-wp-smtp-affects-thousands-of-sites.html', 'Easy WP SMTP'),
    'social-warfare.php' => array('3.5.3', 'https://blog.sucuri.net/2019/03/zero-day-stored-xss-in-social-warfare.html', 'Social Warfare'),
    'migla-donation.php' => array('2.0.6', 'The plugin Total Donations has a 0day vulnerability, needs to be removed completely to prevent further attacks, not just disabled.', 'Total Donations'),
    'yuzo_related_post.php' => array('5.12.95', 'https://blog.sucuri.net/2019/04/attacks-on-closed-wordpress-plugins.html', 'Yuzo Related Post'),
    'advanced-cf7-db.php' => array('1.6.1', 'https://blog.sucuri.net/2019/04/sql-injection-in-advance-contact-form-7-db.html', 'Advanced Contact Form 7 DB'),
    'yellow-pencil.php' => array('7.2.0', 'https://wpvulndb.com/vulnerabilities/9256', 'Yellow Pencil'),
    'woocommerce-checkout-manager.php' => array('4.3', 'https://blog.sucuri.net/2019/04/insufficient-privilege-validation-in-woocommerce-checkout-manager.html', 'WooCommerce Checkout Manager'),
    'blog-designer.php' => array('1.8.13', '', 'Blog Designer'),
    'wp-live-chat-support.php' => array('8.0.28', 'https://blog.sucuri.net/2019/05/persistent-cross-site-scripting-in-wp-live-chat-support-plugin.html', 'WP Live Chat Support'),
    'fb-messenger-live-chat.php' => array('1.4.8', '', 'Live Chat with Facebook Messenger'),
    'wp-slimstat.php' => array('4.8.1', 'https://blog.sucuri.net/2019/05/slimstat-stored-xss-from-visitors.html', 'Slimstat Analytics'),
    'wp-live-chat-support-pro.php' => array('8.0.12', '', 'WP Live Chat Support Pro'),
    'wp-database-backup.php' => array('5.3', '', 'WP Database Backup'),
    'wp_mail_smtp.php' => array('1.5.1', '', 'WP Mail SMTP by WPForms'),
    'wp-contact-form-7.php' => array('5.3.2', 'https://contactform7.com/2020/12/17/contact-form-7-532/', 'Contact Form 7'),
    'cpabc_appointments.php' => array('1.3.19', '', 'Appointment Booking Calendar'),
    'simple-301-bulk-uploader.php' => array('1.2.5', '', 'Simple 301 Redirects – Addon – Bulk Uploader'),
    'nd-shortcodes.php' => array('6.0', '', 'ND Shortcodes For Visual Composer'),
    'wp-private-content-plus.php' => array('1.32', '', 'WP Private Content Plus'),
    'woocommerce-filters.php' => array('1.3.7', 'https://labs.sucuri.net/unauthenticated-settings-update-in-woocommerce-ajax-filters/', 'Advanced AJAX Product Filters'),
    'file_folder_manager.php' => array('5.4', 'https://labs.sucuri.net/plugins-under-attack-june-2019/', 'File Manager'),
    'mystickymenu.php' => array('2.1.6', 'https://labs.sucuri.net/plugins-under-attack-june-2019/', 'Sticky Menu Plugin'),
    'wp-support-plus.php' => array('9.1.2', 'https://labs.sucuri.net/plugins-under-attack-june-2019/', 'WP Support Plus Responsive Ticket System'),
    'folders.php' => array('2.1.1', 'https://labs.sucuri.net/plugins-under-attack-june-2019/', 'Folders Plugins'),
    'supportcandy.php' => array('2.0.6', 'https://labs.sucuri.net/plugins-under-attack-june-2019/', 'SupportCandy'),
    'rich-reviews.php' => array('1.7.4', 'https://wordpress.org/plugins/rich-reviews/', 'Rich Reviews'),
    'wp-piwik.php' => array('1.0.19', 'https://labs.sucuri.net/plugins-under-attack-june-2019/', 'WP-Matomo (WP-Piwik)'),
    'wp-quick-booking-manager.php' => array('1.2', 'https://wordpress.org/plugins/wp-quick-booking-manager/', 'WP Quick Booking Manager (Closed - Plugin should be manually Removed)'),
    'simple_fields.php' => array('1.4.12', 'https://wordpress.org/support/topic/hack-related-to-simple-fields/', 'Simple Fields'),
    'popup-maker.php' => array('1.8.13', 'https://wpvulndb.com/vulnerabilities/9907', 'Popup Maker'),
    'premium-addons-for-elementor.php' => array('3.7.3', 'https://www.pluginvulnerabilities.com/2019/09/10/hackers-may-already-be-targeting-this-authenticated-persistent-xss-vulnerability-in-premium-addons-for-elementor/', 'Premium Addons for Elementor'),
    'simple-staff-list.php' => array('2.2.1', 'https://labs.sucuri.net/plugins-added-to-malware-campaign-july-2019/', 'Simple Staff List'),
    'otw_post_custom_templates_lite.php' => array('1.12', 'https://labs.sucuri.net/plugins-added-to-malware-campaign-july-2019/', 'Post Custom Templates Lite'),
    'wp-time-capsule.php' => array('1.21.16', 'https://wordpress.org/plugins/wp-time-capsule/', 'Backup and Staging by WP Time Capsule'),
    'popup-builder.php' => array('3.64.1', 'https://wordpress.org/plugins/popup-builder/', 'Popup Builder'),
    'brizy.php' => array('1.0.114', 'https://wpvulndb.com/vulnerabilities/10112', 'Brizy – Page Builder'),
    'flexible-checkout-fields.php' => array('2.3.4', 'https://www.wpdesk.net/blog/flexible-checkout-fields-vulnerability/', 'Flexible Checkout Fields for WooCommerce'),
    'rank-math.php' => array('1.0.41', 'https://wpvulndb.com/vulnerabilities/10157', 'WordPress SEO Plugin – Rank Math'),
    'elementor-pro.php' => array('2.9.4', 'https://wpvulndb.com/vulnerabilities/10214', 'Elementor Pro'),
    'ultimate-elementor.php' => array('1.24.2', 'https://wpvulndb.com/vulnerabilities/10215', 'Ultimate Elementor Pro'),
    'siteorigin-panels.php' => array('2.10.16', 'https://wpvulndb.com/vulnerabilities/10219', 'Page Builder by SiteOrigin'),
    'ninja-forms.php' => array('3.6.11', 'https://wpscan.com/vulnerability/8843d66b-e895-4336-afda-00b99442cdc1', 'Ninja Forms'),
    'file_folder_manager.php' => array('6.9', 'https://wpvulndb.com/vulnerabilities/10389', 'File Manager'),
    'wp-customer-reviews-3.php' => array('3.4.3', 'https://wpvulndb.com/vulnerabilities/10363', 'WP Customer Reviews'),
    'woo-discount-rules.php' => array('2.1.0', 'https://wpvulndb.com/vulnerabilities/10364', 'Discount Rules for WooCommerce'),
    'NextScripts_SNAP.php' => array('4.3.18', 'https://wpvulndb.com/vulnerabilities/10390', 'NextScripts: Social Networks Auto-Poster'),
    'ti-woocommerce-wishlist.php' => array('1.21.12', 'https://wpscan.com/vulnerability/10433', 'TI WooCommerce Wishlist'),
    'ct-ultimate-gdpr.php' => array('2.4', 'https://blog.nintechnet.com/critical-vulnerability-in-wordpress-ultimate-gdpr-ccpa-compliance-toolkit-plugin/', 'Ultimate GDPR & CCPA Plugin for WordPress'),
    'kaswara.php' => array('REPLACE', 'https://wpscan.com/vulnerability/8d66e338-a88f-4610-8d12-43e8be2da8c5', 'Kaswara'),
    'external-media.php' => array('1.0.34', 'https://wpscan.com/vulnerability/4fb90999-6f91-4200-a0cc-bfe9b34a5de9', 'External Media'),
    'wp-simple-301-redirects.php' => array('2.0.4','https://wpscan.com/vulnerability/74c23d56-e81f-47e9-bf8b-33d3f0e81894','Simple 301 Redirects by BetterLinks'),
    'cleantalk.php' => array('5.153.4', 'https://wpscan.com/vulnerability/152171fc-888c-4275-a118-5a1e664ef28b', 'Anti-Spam by CleanTalk'),
    'wp-statistics.php' => array('13.0.8', 'https://patchstack.com/database/vulnerability/wp-statistics/wordpress-wp-statistics-plugin-13-0-7-unauthenticated-time-based-blind-sql-injection-sqli-vulnerability', 'WP Statistics'),
    'store-locator-le.php' => array('REPLACE', 'https://wpscan.com/vulnerability/078e93cd-7cf2-4e23-8171-58d44e354d62', 'Store Locator Plus'),
    'super-forms.php' => array('4.9.703', 'https://wpscan.com/vulnerability/787aa6b0-82dc-4b6d-893b-a54fae43415f', 'WP Super Forms'),
    'woocommerce-stock-manager.php' => array('2.6.0', 'https://wpscan.com/vulnerability/9b73d8fa-f7ae-4516-bd57-269c4981439f', 'WooCommerce Stock Manager'),
    'fluentform.php' => array('3.6.67', 'https://wpscan.com/vulnerability/16070387-e2b2-4b97-8cd8-cc2db80a3995', 'WP Fluent Forms'),
    'zoomsounds.php' => array('6.05', 'https://wpscan.com/vulnerability/07259a61-8ba9-4dd0-8d52-cc1df389c0ad', 'ZoomSounds'),
    'wp-user-avatar.php' => array('3.1.4', 'https://wpscan.com/vulnerability/af54762b-29c9-4529-8ebd-f4ba7fde2c95', 'User Avatar'),
    'woocommerce.php' => array('5.5.1', 'https://wpscan.com/vulnerability/1212fec8-1fde-41e5-af70-abdd7ffe5379', 'WooCommerce'),
    'seopress.php' => array('5.0.4', 'https://nvd.nist.gov/vuln/detail/CVE-2021-34641', 'SEOPress'),
    'download-manager.php' => array('3.2.53', 'https://wpscan.com/vulnerability/394007c5-7923-46fe-bb4c-2377d66ff900', 'Download Manager'),
    'nestedpages.php' => array('3.1.16', 'https://www.wordfence.com/blog/2021/08/nested-pages-patches-post-deletion-vulnerability/', 'Nested Pages'),
    'woocommerce-jetpack.php' => array('5.4.4', 'https://wpscan.com/vulnerability/b5795f8a-78b8-481e-8522-7bd4689c917c', 'Booster for WooCommerce'),
    'redux-framework.php' => array('4.2.13', 'https://wpscan.com/vulnerability/e690b887-de5f-4950-bedf-4a9f5fe9b773', 'Gutenberg Template Library & Redux Framework'),
    'wc-dynamic-pricing-and-discounts.php' => array('2.4.2', 'https://wpscan.com/vulnerability/aeae6454-6cda-4b43-9d96-e0d4d67b4028', 'WooCommerce Dynamic Pricing & Discounts'),
    'wpFastestCache.php' => array('0.9.5', 'https://jetpack.com/2021/10/14/multiple-vulnerabilities-in-wp-fastest-cache-plugin/', 'WP Fastest Cache'),
    'brizy.php' => array('2.3.12', 'https://wpscan.com/vulnerability/28183974-bb74-46dd-9cbb-49722def7cb0', 'Brizy - Page Builder'),
    'access-demo-importer.php' => array('1.0.7', 'https://wpscan.com/vulnerability/037d0476-d3f2-4cb8-a071-ad28bef5418b', 'Access Demo Importer'),
    'sp-dsgvo.php' => array('3.1.24', 'https://wpscan.com/vulnerability/9b4e6bf3-52be-41ec-8f39-b039146796b1', 'WP DSGVO Tools'),
    'directorist-base.php' => array('7.0.6.2', 'https://wpscan.com/vulnerability/4c45df6d-b3f6-49e5-8b1f-edd32a12d71c', 'Directorist – Business Directory Plugin'),
    'capsman-enhanced.php' => array('2.3.2', 'https://www.wordfence.com/blog/2021/12/massive-wordpress-attack-campaign/', 'PublishPress Capabilities'),
    'wp-html-mail.php' => array('3.1', 'https://wpscan.com/vulnerability/77b9763c-cd91-4cb7-bca5-87c3d1373864', 'WP HTML Mail'),
    'wp-responsive-menu.php' => array('3.1.7.1', 'https://wpscan.com/vulnerability/661cb7e3-d7bd-4bc1-bf78-bdb4ba9610d7', 'WP Responsive Menu'),
    'essential_adons_elementor.php' => array('5.0.5', 'https://wpscan.com/vulnerability/0d02b222-e672-4ac0-a1d4-d34e1ecf4a95', 'Essential Addons for Elementor'),
    'xoo-wl-main.php' => array('2.5.2', 'https://wpscan.com/vulnerability/35a5247d-b599-4d95-9f08-1324c870f9d2', 'Waitlist Woocommerce ( Back in stock notifier )'),
    'xoo-wsc.php' => array('2.1', 'https://wpscan.com/vulnerability/35a5247d-b599-4d95-9f08-1324c870f9d2', 'Side Cart Woocommerce (Ajax)'),
    'xoo-el-main.php' => array('2.3', 'https://wpscan.com/vulnerability/35a5247d-b599-4d95-9f08-1324c870f9d2', 'Login/Signup Popup'),
    'phpeverywhere.php' => array('3.0.0', 'https://wpscan.com/vulnerability/bd32c35f-548c-4284-8507-4e7ec9d9d4bd', 'PHP Everywhere'),
    'updraftplus.php' => array('1.22.3', 'https://wpscan.com/vulnerability/d257c28f-3c7e-422b-a5c2-e618ed3c0bf3', 'UpdraftPlus Free'),
    'cleantalk.php' => array('5.174.1', 'https://wpscan.com/vulnerability/4f68d896-1cb7-430c-b187-918c9f92005d', 'Spam protection, AntiSpam, FireWall by CleanTalk'),
    'sg-security.php' => array('1.2.6', 'https://wpscan.com/vulnerability/5600f324-3301-4e1a-a9a8-6e97d45cdadc', 'SiteGround Security'),
    'jupiterx-core.php' => array('2.0.7', 'https://wpscan.com/vulnerability/ff094c7a-9d2c-447f-adf8-b87400f4dc5d', 'Jupiter X Core'),
    'cp-image-store.php' => array('1.0.68', 'https://wpscan.com/vulnerability/83bae80c-f583-4d89-8282-e6384bbc7571', 'CP Image Store'),
    'kivicare-clinic-management-system.php' => array('2.3.9', 'https://wordpress.org/plugins/kivicare-clinic-management-system/#developers', 'KiviCare - Clinic & Patient Management System'),
    'acf.php' => array('5.12.1', 'https://wpscan.com/vulnerability/413576a8-0f20-465e-80cf-7cb0cb22bded', 'Advanced Custom Fields'),
    'wpdev-booking.php' => array('9.1.1', 'https://wpscan.com/vulnerability/cf4ebcab-67d5-4f84-b67c-1be65c23e4df', 'Booking Calendar'),
    'events-manager.php' => array('2.2.81', 'https://blog.sucuri.net/2022/06/vulnerability-patch-roundup-june-2022.html', 'Events Made Easy'),
    'armember-membership.php' => array('3.4.8', 'https://blog.sucuri.net/2022/06/vulnerability-patch-roundup-june-2022.html', 'ARMember'),
    'easync.php' => array('1.1.16', 'https://blog.sucuri.net/2022/06/vulnerability-patch-roundup-june-2022.html', 'eaSYNC'),
    'tatsu.php' => array('3.3.13', 'https://vulners.com/nessus/WEB_APPLICATION_SCANNING_113239', 'Tatsu Builder'),
    'advanced-booking-calendar.php' => array('1.7.0', 'https://wpscan.com/vulnerability/990d1b0a-dbd1-42d0-9a40-c345407c6fe0', 'Advanced Booking Calendar'),
    'bookingpress-appointment-booking.php' => array('1.0.11', 'https://wpscan.com/vulnerability/388cd42d-b61a-42a4-8604-99b812db2357', 'BookingPress'),
    'qc-project-ilist-main.php' => array('4.3.8', 'https://wpscan.com/vulnerability/a8575322-c2cf-486a-9c37-71a22167aac3', 'Infographic Maker - iList'),
    'qc-op-directory-main.php' => array('7.7.2', 'https://wpscan.com/vulnerability/1c83ed73-ef02-45c0-a9ab-68a3468d2210', 'Simple Link Directory'),
    'searchiq.php' => array('3.9', 'https://wpscan.com/vulnerability/0ee7d1a8-9782-4db5-b055-e732f2763825', 'SearchIQ'),
    'nirweb-support.php' => array('2.8.2', 'https://wpscan.com/vulnerability/1a8f9c7b-a422-4f45-a516-c3c14eb05161', 'Nirweb support'),
    'svg-support.php' => array('2.5', 'https://wpscan.com/vulnerability/62b2548e-6b59-48b8-b1c2-9bd47e634982', 'SVG Support'),
    'backupbuddy.php' => array('8.7.4.1', 'https://www.wordfence.com/blog/2022/09/psa-nearly-5-million-attacks-blocked-targeting-0-day-in-backupbuddy-plugin/', 'BackupBuddy'),
    'usc-e-shop.php' => array('2.7.8', 'https://patchstack.com/database/vulnerability/usc-e-shop/wordpress-welcart-e-commerce-plugin-2-7-7-unauth-directory-traversal-vulnerability', 'Welcart e-Commerce'),
);

// This line is updated with the most recent versions in refresh-versions.php on every build
$VERSIONS = array('signature'=>'sucuri-current-versions','joomla'=>array('3.9.1',),'wordpress'=>array('6.1.1',),'drupal'=>array('7.75','8.8.12','8.9.10','9.0.9',),'magento'=>array('1.9.4.5','2.3.6','2.4.4',),'jce'=>array('2.9.1',),'phpbb'=>array('3.3.2',),'vbulletin'=>array('5.6.1',),'jetpack'=>array('9.2.1',),'zenphoto'=>array('1.5.7',),'prestashop'=>array('1.7.7.0',),'opencart'=>array('3.0.3.6',),'oscommerce'=>array('2.3.4.1',),'timthumb'=>array('2.8.13',),'modX'=>array('evolution'=>'1.4.11','revolution'=>'2.8.1',),'typo3'=>array('9.5.24','10.4.11',),'Newsmag'=>array('3',),'Newspaper'=>array('12.1.1',),'jQueryFileUpload'=>array('9.25.1',),'laravel'=>array('8.64.0',),'symfony'=>array('4.4.32','5.3.9',),);

$isNoise = false;
if (isset($_GET['noise'])) {
    $isNoise = true;
}

// =======================
// checkIsUpdated

function checkIsUpdated($version, $latestVersions)
{
    $version = standardizeVersion($version);

    if (is_array($latestVersions)) {
        $lv = $latestVersions[0];
    } else {
        $lv = $latestVersions;
    }

    $checkArrayCount = is_array($latestVersions) ? count($latestVersions) : 0;

    $latest = 1 < $checkArrayCount
        ? findMostSimilar($version, $latestVersions)
        : standardizeVersion($lv);

    return version_compare($version, $latest) >= 0;
}

// finds the most similar version using XOR bitwise operation
// (same chars at the beginning of the string result in lower values of the result,
// lowest result gives the most similar from the beginning)
function findMostSimilar($version, $versions)
{
    $mostSimilar = false;
    $mostSimilarValue = 0;

    foreach ($versions as $currentVersion) {
        $endResult = standardizeVersion($currentVersion);
        $endResult = str_pad($endResult, strlen($version), '0');
        $endResult = unpack('H*', $version ^ $endResult);
        $endResult = base_convert($endResult[1], 16, 10);

        if (!$mostSimilar || $endResult < $mostSimilarValue) {
            $mostSimilar = $currentVersion;
            $mostSimilarValue = $endResult;
        }
    }

    return $mostSimilar;
}

function standardizeVersion($version)
{
    $version = preg_replace('/ Patch Level (\d+)/i', 'pl$1', $version);

    return $version;
}

// ============================================
// checkPlugin

function checkWpPlugin($path, $fileName)
{
    global $VULNERABLE_PLUGINS;

    list($safeVersion, $url, $pluginName) = $VULNERABLE_PLUGINS[$fileName];

    $pluginVersion = getWpPluginVersion("$path/$fileName");

    if ($pluginVersion && ($safeVersion == "REPLACE")) {

        $info = array('name' => $pluginName, 'version' => $pluginVersion, 'dir' => $path.'/'.$fileName,
            'replaceplugin' => true, 'oldplugin' => true,);

        if ($url) {
            $info['url'] = $url;
        }

        return $info;
    }

    if ($pluginVersion && !checkIsUpdated($pluginVersion, $safeVersion)) {
        $info = array('name' => $pluginName, 'version' => $pluginVersion, 'dir' => $path.'/'.$fileName,
            'oldplugin' => true, );

        if ($url) {
            $info['url'] = $url;
        }

        return $info;
    }

    return false;
}

function getWpPluginVersion($file)
{
    $version = findLineInFile($file, 'Version:');
    if ($version === null) {
        return false;
    }

    $version = explode(':', $version);

    if (isset($version[1])) {
        return trim($version[1]);
    }

    return false;
}

// ============================================
// checkVersionInFile and friends

function checkWordPressAndZenPhotoVersion($fileName, $path)
{
    global $VERSIONS, $CMS;

    if (strpos($path, 'administrator/components/com_jevents') !== false ||
        strpos($path, 'tiny-compress-images/test/wp-includes') !== false) {
        return false;
    }

    $version = findLineInFile($path.'/'.$fileName, 'wp_version = ');
    if ($version !== null) {
        // WordPress
        $realdir = dirname($path);

        $explosion = explode("'", $version);

        if (isset($explosion[1])) {
            $version = $explosion[1];
        }

        $CMS = '1';

        return array('name' => 'WordPress', 'version' => $version, 'dir' => $realdir,
            'updated' => checkIsUpdated($version, $VERSIONS['wordpress']),
            'config' => $realdir.'/wp-config.php', 'source' => $path . '/' . $fileName, );
    }

    // Zen Photo
    $version = findLineInFile($path.'/'.$fileName, 'ZENPHOTO_VERSION');
    if ($version == null) {
        return false;
    }

    $version = trim($version);
    $version = explode("'", $version);
    $version = $version[3];

    return array('name' => 'Zenphoto', 'version' => $version, 'dir' => $path.'/'.$fileName,
        'updated' => checkIsUpdated($version, $VERSIONS['zenphoto']), );
}

function checkJoomlaVersion($fileName, $path)
{
    global $VERSIONS, $CMS;

    $versionFile = '';
    if (file_exists("$path/includes/version.php")) {
        $versionFile = "$path/includes/version.php";
    } elseif (file_exists("$path/libraries/joomla/version.php")) {
        $versionFile = "$path/libraries/joomla/version.php";
    } elseif (file_exists("$path/libraries/cms/version.php")) {
        $versionFile = "$path/libraries/cms/version.php";
    } elseif (file_exists("$path/libraries/cms/version/version.php") && false === strpos($path, 'breezing-forms')) {
        $versionFile = "$path/libraries/cms/version/version.php";
    } elseif (file_exists("$path/libraries/src/Version.php")) {
        $versionFile = "$path/libraries/src/Version.php";
    } else {
        return false;
    }

    $version1 = findLineInFile($versionFile, 'RELEASE');
    if (!$version1) {
        return false;
    }

    $version1 = explode("'", $version1);
    $version2 = findLineInFile($versionFile, 'DEV_LEVEL');
    $version2 = explode("'", $version2);
    $version = $version1[1].'.'.$version2[1];

    $CMS = '1';

    return array('name' => 'Joomla', 'version' => $version, 'dir' => $path, 'source' => $versionFile,
        'updated' => checkIsUpdated($version, $VERSIONS['joomla']),
        'config' => $path.'/'.$fileName, );
}

function checkJceVersion($fileName, $path)
{
    global $VERSIONS;

    $firstLine = findLineInFile($path.'/'.$fileName, 'install');

    if (false === strpos($firstLine, 'component')) {
        return false;
    }

    $version = findLineInFile($path.'/'.$fileName, '<version>');
    $version = str_replace('<version>', '', $version);
    $version = str_replace('</version>', '', $version);
    $version = trim($version);
    $realdir = dirname($path);

    return array('name' => 'JCE component', 'version' => $version, 'dir' => $realdir,
        'updated' => checkIsUpdated($version, $VERSIONS['jce']), );
}

function checkjQueryFileUploadVersion($fileName, $path)
{
    /** Bring file to a string. */
    $fileContent = @file_get_contents("$path/$fileName");

    /** Exit in case the file does not contain the GitHub Address (not jQFU). */
    if (
        (empty($fileContent)) ||
        (false === strpos($fileContent, 'https://github.com/blueimp/jQuery-File-Upload'))
    ) {
        return false;
    }

    /**
     * Get current file hash, its version if possible and directory.
     * Set by default isUpdated to false until further check.
     */
    $fileHash = md5($fileContent);
    $version = findLineInFile($path.'/'.$fileName, '* jQuery File Upload Plugin');
    $version = trim($version);
    $version = preg_replace('@\*[\s]*jQuery File Upload Plugin[\s]*([\d\s]+)@', '$1', $version);
    if (preg_match('/[0-9]/', $version) === 0) {
        $version = 'Unknown.';
    }
    $realdir = dirname($path);
    $isUpdated = false;

    /**
     * Set isUpdated to true if the file has "IMAGETYPE_PNG" constant cause that
     * proves the file version has the known vulnerabilities patched.
     * @see https://github.com/blueimp/jQuery-File-Upload/blob/master/VULNERABILITIES.md
     * 
     * Otherwise, check if md5 hash matches the last version.
     */
    if (strpos($fileContent, 'IMAGETYPE_PNG') !== false) {
        $isUpdated = true;
    } else {
        /** Check the md5 hash of the last jQuery File Upload "UploadHandler.php". */
        $mostRecentUploadHandler = 'https://raw.githubusercontent.com/blueimp/jQuery-File-Upload/master/server/php/UploadHandler.php';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $mostRecentUploadHandler);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, '20');
        curl_setopt($ch, CURLOPT_MAXREDIRS, '3');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, '30');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Sucuri Version Check '.$myversion);
        $mostRecentUploadHandlerContent = curl_exec($ch);
        curl_close($ch);

        /** Extract the md5 hash. */
        if (strpos($mostRecentUploadHandlerContent, 'jQuery-File-Upload') !== false) {
            $mostRecentUploadHandlerHash = md5($mostRecentUploadHandlerContent);
        } else {
            /** Set to true cause we were unable to verify the last version hash. */
            $isUpdated = true;
        }
    }

    /**
     * Set version to 9.25.1+ if file contains the "IMAGETYPE_PNG" constant
     * or to "Last available at GitHub" if md5 hash matches the latest commit.
     */
    if (empty($mostRecentUploadHandlerHash)) {
        if ($isUpdated) {
            $version = '9.25+';
        }
    } else {
        if ($fileHash === $mostRecentUploadHandlerHash) {
            $isUpdated = true;
            $version = 'Last available at GitHub.';
        }
    }

    /** Send result to main runtime. */
    return array(
        'name' => 'jQuery File Upload plugin',
        'version' => $version.' ',
        'dir' => $realdir,
        'updated' => $isUpdated,
    );
}

function checkDrupalVersion($fileName, $path)
{
    global $VERSIONS, $CMS;

    $version = findLineInFile($path.'/'.$fileName, "define('VERSION'");

    if (!$version) {
        return false;
    }

    $version = trim($version);
    $version = preg_replace("@^define\(\s*['\"]VERSION['\"]\s*,\s*['\"]([\d\.]+)['\"]\s*\);$@", '$1', $version);
    if ($fileName == 'bootstrap.inc') {
        $realdir = dirname($path);
    } else {
        $realdir = dirname(dirname($path));
    }

    $CMS = '1';

    return array('name' => 'Drupal', 'version' => $version, 'dir' => $realdir, 'source' => $path.'/'.$fileName,
        'updated' => checkIsUpdated($version, $VERSIONS['drupal']), );
}

function checkDrupal8Version($fileName, $path)
{
    global $VERSIONS, $CMS;
    
    $version = findLineInFile($path . '/' . $fileName, "const VERSION = '");

    if (!$version) {
        return false;
    }

    $version = trim($version);
    $version = preg_replace("@^const.VERSION.\=\s*\s*['\"]([\d\.]+)['\"]\s*;$@", '$1', $version);
    $realdir = dirname(dirname($path));

    $CMS = '1';
    return array('name' => 'Drupal', 'version' => $version, 'dir' => $realdir, 'source' => $path . '/' . $fileName,
        'updated' => checkIsUpdated($version, $VERSIONS['drupal']) );
}

function checkMagentoVersion($fileName, $path)
{
    global $VERSIONS, $CMS;

    $config = @file_get_contents("$path/$fileName");

    if ((false === $config) || (false === strpos($config, 'public static function getVersionInfo()'))) {
        return false;
    }

    $version = sprintf(
        '%s.%s.%s.%s',
        getOption('major', $config, OPT_TYPE_ASSOC),
        getOption('minor', $config, OPT_TYPE_ASSOC),
        getOption('revision', $config, OPT_TYPE_ASSOC),
        getOption('patch', $config, OPT_TYPE_ASSOC)
    );
    $realdir = dirname($path);

    $CMS = '1';

    return array('name' => 'Magento', 'version' => $version, 'dir' => $realdir, 'source' => $path.'/'.$fileName,
        'updated' => checkIsUpdated($version, $VERSIONS['magento']), );
}

//Magento 2 check
function checkMagento2Version($fileName, $path)
{
    global $VERSIONS, $CMS;
    if (strpos($path, 'dev/tests/integration/framework/Magento/TestFramework/Event') != false) {
        $originpath = $path;
        $path = str_replace('dev/tests/integration/framework/Magento/TestFramework/Event', '', $path);
        if (strpos($path, 'vendor/magento/magento2-base') != false) {
            if (file_exists($path.'composer.json')) {
                $fileName = 'composer.json';
                $config = file_get_contents($path.$fileName);
                preg_match('((?:\"version\"\: \"[0-9]+,)*[0-9]+(?:\.[0-9]+)(?:\.[0-9]+)":?)', $config, $version);
                $version = $version['0'];
                $version = str_replace('"', '', $version);
                $realdir = str_replace('vendor/magento', '', $path);
                $realdir = dirname($realdir);

                $CMS = '1';

                return array('name' => 'Magento 2', 'version' => $version, 'dir' => $realdir, 'source' => $path.$fileName,
                'updated' => checkIsUpdated($version, $VERSIONS['magento']), );
            }
        } else {
            return;
        }
    }
}

function checkModXVersion($fileName, $path)
{
    global $VERSIONS, $CMS;

    $config = @file_get_contents("$path/$fileName");
    if ($config === false) {
        return false;
    }

    $version = getOption('$modx_version', $config, OPT_TYPE_VAR);
    if ($version) {
        return array('name' => 'ModX Evolution', 'version' => $version, 'dir' => $path.'/'.$fileName,
            'updated' => checkIsUpdated($version, $VERSIONS['modX']['evolution']), );
    }

    if (!preg_match_all('@\$v\[\'([\S]+)\'\]\s*=\s*[\'](.*)[\'];@', $config, $m)) {
        return false;
    }
    if (!isset($m[2][0], $m[2][1], $m[2][2], $m[2][3])) {
        return false;
    }

    $realdir = dirname($path);
    if (substr($realdir, -5) == '/core') {
        $realdir = substr_replace($realdir, '', -5);
    }

    $CMS = '1';
    $version = sprintf('%s.%s.%s-%s', $m[2][0], $m[2][1], $m[2][2], $m[2][3]);

    return array('name' => 'ModX Revolution', 'version' => $version, 'dir' => $realdir, 'source' => $path.'/'.$fileName,
        'updated' => checkIsUpdated($version, $VERSIONS['modX']['revolution']), );
}

function checkPhpBbVersion($fileName, $path)
{
    global $VERSIONS, $CMS;

    // Passing null to the 2nd parameter of preg_match is deprecated in PHP 8.1+,
    // so return early when findLineInFile returns null.
    $subject = findLineInFile($path.'/'.$fileName, "'PHPBB_VERSION'");
    if ($subject === null) {
        return false;
    }
    if (!preg_match('~@?define\(.PHPBB_VERSION., +.(\S+).\);~', $subject, $matches)) {
        return false;
    }
    $version = $matches[1];
    $realdir = dirname($path);

    $CMS = '1';

    return array('name' => 'PHPBB', 'version' => $version, 'dir' => $realdir,
        'updated' => checkIsUpdated($version, $VERSIONS['phpbb']), );
}

function checkVbulletinVersion($fileName, $path)
{
    global $VERSIONS, $CMS;

    $version = findLineInFile($path.'/'.$fileName, "'vbulletin'");

    if (!$version) {
        return false;
    }

    $version = str_replace("\t\t\$md5_sum_versions = array('vbulletin' => '", '', $version);
    $version = str_replace("');", '', $version);
    $realdir = dirname($path);

    $CMS = '1';

    return array('name' => 'vBulletin', 'version' => $version, 'dir' => $realdir, 'source' => $path.'/'.$fileName,
        'updated' => checkIsUpdated($version, $VERSIONS['vbulletin']), );
}

function checkOsCommerceVersion($fileName, $path)
{
    global $VERSIONS, $CMS;
    $verRegex = '[0-9.]+[ -]?[0-9a-zA-Z]{0,5}'; // Examples: "2.3.1"   "2.3.3.2"   "2.2-MS2"  "2.2 RC2a"  "2.2RC2a"

    $realdir = dirname($path);

    // See https://github.com/osCommerce/oscommerce2/commits/23/catalog/includes/version.php
    $versionFileNames = array("$path/includes/version.php", "$path/includes/version.txt",
        "$path/includes/OSC/version.txt", );

    $version = false;

    foreach ($versionFileNames as $fileName) {
        $config = @file_get_contents($fileName);
        if ($config && preg_match('/^'.$verRegex.'$/', $config)) {
            $version = $config;
            $versionFile = $fileName;
            break;
        }
    }

    if (!$version) {
        $versionFile = "$path/includes/application_top.php";
        $config = @file_get_contents($versionFile);
        $option = getOption('PROJECT_VERSION', $config, OPT_TYPE_CONST);
        // PROJECT_VERSION can be something like "osCommerce 2.2-MS2" or "osCommerce Online Merchant v2.2 RC1"
        if (preg_match('/('.$verRegex.')$/', $option, $m)) {
            $version = $m[1];
        }
    }

    if (!$version) {
        return false;
    }

    $CMS = '1';

    return array('name' => 'osCommerce', 'version' => $version, 'dir' => $realdir, 'source' => $versionFile,
        'updated' => checkIsUpdated($version, $VERSIONS['oscommerce']), );
}

function checkPrestaShopVersion($fileName, $path)
{
    global $VERSIONS, $CMS;

    $realdir = dirname($path);

    $version = null;

    if (file_exists("$realdir/config/autoload.php")) {
        $versionFile = "$realdir/config/autoload.php";
        $config = @file_get_contents($versionFile);
        $version = getOption('_PS_VERSION_', $config, OPT_TYPE_CONST);
    }

    if (!$version && file_exists("$realdir/docs/readme_en.txt")) {
        $versionFile = "$realdir/docs/readme_en.txt";
        $line = findLineInFile($versionFile, 'NAME: Prestashop ');
        $version = str_replace(array("\r", "\n", 'NAME: Prestashop '), '', $line);
    }

    if (!$version) {
        return false;
    }

    $CMS = '1';

    return array('name' => 'PrestaShop', 'version' => $version, 'dir' => $realdir, 'source' => $versionFile,
        'updated' => checkIsUpdated($version, $VERSIONS['prestashop']), );
}

function checkOpenCartVersion($fileName, $path)
{
    global $VERSIONS, $CMS;

    if (false === strpos($path, 'admin/controller/catalog')) {
        return false;
    }

    $realdir = dirname(dirname(dirname($path)));

    if (!file_exists("$realdir/admin/index.php")) {
        return false;
    }

    $config = @file_get_contents("$realdir/admin/index.php");
    $version = getOption('VERSION', $config, OPT_TYPE_CONST);

    if (!$version) {
        return false;
    }

    $CMS = '1';

    return array('name' => 'OpenCart', 'version' => $version, 'dir' => $realdir,
        'updated' => checkIsUpdated($version, $VERSIONS['opencart']), );
}

function checkTypo3Version($fileName, $path)
{
    global $VERSIONS;

    $realdir = $fileName === 'config_default.php' ? dirname($path) : dirname(dirname(dirname(dirname($path))));

    $config = @file_get_contents($path.'/'.$fileName);

    $version = getOption('TYPO3_version', $config, OPT_TYPE_CONST);
    if (!$version && $fileName === 'config_default.php') {
        // Before 4.8
        $version = getOption('$TYPO_VERSION', $config, OPT_TYPE_VAR);
    }

    if (!$version) {
        return false;
    }

    return array('name' => 'Typo3', 'version' => $version, 'dir' => $realdir, 'source' => $fileName,
        'updated' => checkIsUpdated($version, $VERSIONS['typo3']), );
}

function checkSymfLaravelVersion($fileName, $path)
{
    global $VERSIONS, $CMS;
    
    $version = findLineInFile($path . '/' . $fileName, "const VERSION = '");

    if (!$version) {
        return false;
    }

    $version = trim($version);
    $version = preg_replace("@^const.VERSION.\=\s*\s*['\"]([\d\.]+)['\"]\s*;$@", '$1', $version);
    $realdir = dirname(dirname($path));

    $CMS = '1';
    if (($fileName == 'Application.php') && (false === strpos($path, '/forms-for-campaign-monitor/')) && (false === strpos($path, '/fluentform/')) && (false === strpos($path, '/friendsofphp/')) && (false === strpos($path, '/gd-system-plugin/')) && (false === strpos($path, '/directories/'))) {
        return array('name' => 'Laravel', 'version' => $version, 'dir' => $realdir, 'source' => $path . '/' . $fileName,
        'updated' => checkIsUpdated($version, $VERSIONS['laravel']) );
    } elseif ($fileName == 'Kernel.php') {
       return array('name' => 'Symfony', 'version' => $version, 'dir' => $realdir, 'source' => $path . '/' . $fileName,
        'updated' => checkIsUpdated($version, $VERSIONS['symfony']) );
    }
}

function checkTDThemesVersion($fileName, $path)
{
    global $VERSIONS;

    $version = findLineInFile($path.'/'.$fileName, 'define("TD_THEME_VERSION", ');

    if (!$version) {
        return false;
    }

    $version = trim($version);
    $version = preg_replace("@define\(\"TD_THEME_VERSION\", \"(\S+)\"\);@", '$1', $version);
    $themename = findLineInFile($path.'/'.$fileName, 'define("TD_THEME_NAME", ');
    $themename = trim(preg_replace("@define\(\"TD_THEME_NAME\", \"(\S+)\"\);@", '$1', $themename));
    if (!$themename) {
        return false;
    }

    if (version_compare($version, '12.1.1') < 0) {
        return array('name' => 'tagDiv Theme '.$themename, 'version' => $version, 'vulnerabletheme' => true, 'dir' => $path.'/'.$fileName, 'updated' => false, 'url' => 'https://wpscan.com/vulnerability/038327d0-568f-4011-9b7e-3da39e8b6aea');
    } else {
        return array('name' => 'tagDiv Theme '.$themename, 'version' => $version, 'dir' => $path.'/'.$fileName, 'updated' => checkIsUpdated($version, $VERSIONS[$themename]));
    }
}

function checkTimThumbVersion($fileName, $path)
{
    global $VERSIONS;

    /* Check for timthumb version */
    if (!findLineInFile($path.'/'.$fileName, 'TimThumb')) {
        return false;
    }

    $version = findLineInFile($path.'/'.$fileName, "'VERSION'");
    $rversion = explode("'", $version);

    if (!isset($rversion[3])) {
        return false;
    }

    return array('name' => 'TimThumb', 'version' => $rversion[3], 'dir' => $path.'/'.$fileName,
        'updated' => checkIsUpdated($rversion[3], $VERSIONS['timthumb']), );
}

function checkRevSliderVersion($fileName, $path)
{
    $config = @file_get_contents("$path/$fileName");
    if (false === $config) {
        return false;
    }

    $version = getOption('$revSliderVersion', $config, OPT_TYPE_VAR);
    if (!$version) {
        return false;
    }

    if (version_compare($version, '4.1.5') < 0) {
        return array('name' => 'Slider Revolution', 'version' => $version, 'dir' => $path.'/'.$fileName,
            'oldplugin' => true, 'url' => 'https://www.themepunch.com/faq/how-to-update-the-slider/', );
    }

    return false;
}

function checkShowBizVersion($fileName, $path)
{
    $config = @file_get_contents("$path/$fileName");
    if (false === $config) {
        return false;
    }

    $version = getOption('$showbizVersion', $config, OPT_TYPE_VAR);
    if (!$version) {
        return false;
    }

    if (version_compare($version, '1.7.2') < 0) {
        return array('name' => 'ShowBiz Plugin', 'version' => $version, 'dir' => $path.'/'.$fileName,
            'oldplugin' => true, );
    }

    return false;
}

function checkDzsVideoGalleryVersion($fileName, $path)
{
    if (false === strpos($path, '/wp-content/plugins/dzs-videogallery/')) {
        return false;
    }

    $version = findLineInFile($path.'/'.$fileName, 'DZS Upload');

    if (strpos($version, 'version: 0.') !== false || strpos($version, 'version: 1.0') !== false) {
        return array('name' => 'dzs-videogallery', 'version' => $version, 'dir' => $path.'/'.$fileName,
            'oldplugin' => true, );
    }

    return false;
}

function checkFreemiusVersion($fileName, $path)
{

    if (false === strpos($path, '/freemius')) {
        return false;
    }

    $version = findLineInFile($path.'/'.$fileName, '$this_sdk_version =');
    $patterns[0] = '/[^\$]*\$this_sdk_version = \'/';
    $patterns[1] = '/\';[^\n]*/';
    $replacement = '';
    $version = trim(preg_replace($patterns, $replacement, $version));

    if (version_compare($version, '2.4.2') <= 0) {
        return array('name' => 'Freemius Library', 'version' => $version, 'dir' => $path.'/'.$fileName, 'oldplugin' => true, 'url' => 'https://wpscan.com/vulnerability/6dae6dca-7474-4008-9fe5-4c62b9f12d0a', );
    }

    return false;
}

function checkPhpMailerVersion($fileName, $path)
{

    //confirming we're having right class
    if (!findLineInFile($path.'/'.$fileName, 'https://github.com/PHPMailer/')) {
        return false;
    }

    //extracting only the version string
    $version = findLineInFile($path.'/'.$fileName, "Version:");
    if (preg_match("/\d\.\d\.\d/", $version, $matches)) {
        $version = $matches[0];
    }
    else {
        return false;
    }

    // Compares if plugin version is 6.0.5 or lower (first safe version is 6.0.6)
    if (version_compare($version, '6.0.5') <= 0) {
        return array('name' => 'PHPMailer Class', 'version' => $version, 'dir' => $path.'/'.$fileName,
            'oldplugin' => true, 'url' => 'https://github.com/PHPMailer/PHPMailer/blob/master/SECURITY.md', );
    }

    return false;
}

function checkPluginIndexVersion($fileName, $path)
{
    // if there will be more cases of plugins using index.php as version file, we'll need to add new array of pairs
    // such as "/hybrid-composer" => "1.4.6"
    // and rework this whole function into using this new array

    if (false !== strpos($path, '/hybrid-composer')) {
        //getting the line with version number
        $version = findLineInFile($path.'/'.$fileName, '* Version:');

        // keeping just the version value
        $version = trim(preg_replace("/\* Version: /", '$1', $version));

        // Compares if plugin version is 1.4.6 or lower
        if (version_compare($version, '1.4.6') <= 0) {
            return array('name' => 'WPTF Hybrid Composer', 'version' => $version, 'dir' => $path.'/'.$fileName,
                'oldplugin' => true, 'url' => 'https://labs.sucuri.net/wptf-hybrid-composer-unauthenticated-arbitrary-options-update/', );
        }
    
    } else if (false !== strpos($path, '/image-hover-effects-ultimate')) {
        //getting the line with version number
        $version = findLineInFile($path.'/'.$fileName, 'Version:');

        // keeping just the version value
        $version = trim(preg_replace("/\ Version: /", '$1', $version));

        // Compares if plugin version is 9.6.2 or lower
        if (version_compare($version, '9.6.2') <= 0) {
            return array('name' => 'Image Hover Effects Ultimate', 'version' => $version, 'dir' => $path.'/'.$fileName,
                'oldplugin' => true, 'url' => 'https://wordpress.org/plugins/image-hover-effects-ultimate/#developers - Undisclosed Vulnerability', );
        }
    }

    else if (false !== strpos($path, '/vc-tabs')) {
        //getting the line with version number
        $version = findLineInFile($path.'/'.$fileName, 'OXI_TABS_PLUGIN_VERSION');

        // keeping just the version value
        preg_match("/^[^;]+OXI_TABS_PLUGIN_VERSION.,[\s]*\'([\d\.]+)/", $version, $matches);
        $version = $matches[1];
            
        // Compares if plugin version is 3.5.9 or lower
        if (version_compare($version, '3.5.9') <= 0) {
            return array('name' => 'Tabs', 'version' => $version, 'dir' => $path.'/'.$fileName,
                'oldplugin' => true, 'url' => 'https://wpscan.com/vulnerability/fcc471c3-9e3d-42cb-8a59-4bf1c9d9c81b', );
        }
    }

    // another else if could be added for other plugins with index.php as plugin version file
    // if there will be too many such plugins, this structure can be reworked into another array

    return false;
}

// The plugin is using the filename "Main.php" which is very generic.
// With that, we created a function to detect and alert for such cases.
    
function checkPluginMainVersion($fileName, $path)
{
    if (false !== strpos($path, '/ultimate-faqs')) {
        //getting the line with version number
        $version = findLineInFile($path.'/'.$fileName, 'Version: ');

        // keeping just the version value
        $version = trim(preg_replace("/Version: /", '$1', $version));

        // Compares if plugin version is 1.8.21 or lower
        if (version_compare($version, '1.8.21') <= 0) {
            return array('name' => 'Ultimate FAQ', 'version' => $version, 'dir' => $path.'/'.$fileName,
            'oldplugin' => true, 'url' => 'https://labs.sucuri.net/malware-campaign-evolves-to-target-new-plugins-may-2019/', );
        }
    }

    // another else if could be added for other plugins with Main.php as plugin version file
    // if there will be too many such plugins, this structure can be reworked into another array

    return false;
}

function checkPluginInitVersion($fileName, $path)
{
    // if there will be more cases of plugins using index.php as version file, we'll need to add new array of pairs
    // such as "/hybrid-composer" => "1.4.6"
    // and rework this whole function into using this new array

    //workaround to ensure we're checking init.php in the plugin root
    if (false !== strpos($path.$fileName, '/ithemes-syncinit.php')) {
        //getting the line with version number
        $version = findLineInFile($path.'/'.$fileName, 'Version:');

        // keeping just the version value
        $version = trim(preg_replace("/Version: /", '$1', $version));

        // Compares if plugin version is 1.4.6 or lower
        if (version_compare($version, '2.0.17') <= 0) {
            return array('name' => 'iThemes Sync', 'version' => $version, 'dir' => $path.'/'.$fileName,
                'oldplugin' => true, 'url' => 'https://ithemes.com/important-ithemes-sync-vulnerability-patched/', );
        }
    }

    // Added support to InfiniteWP Client since it uses init.php as the initializer for the plugin
    if (false !== strpos($path.$fileName, '/iwp-client')) {
        //getting the line with version number
        $version = findLineInFile($path.'/'.$fileName, 'Version:');

        // keeping just the version value
        $version = trim(preg_replace("/Version: /", '$1', $version));

        // Compares if plugin version is 1.9.4.4 or lower
        if (version_compare($version, '1.9.4.4') <= 0) {
            return array('name' => 'InfiniteWP Client', 'version' => $version, 'dir' => $path.'/'.$fileName,
                'oldplugin' => true, 'url' => 'https://blog.sucuri.net/2020/01/authentication-bypass-vulnerability-in-infinitewp-client.html', );
        }
    }

    // another else if could be added for other plugins with index.php as plugin version file
    // if there will be too many such plugins, this structure can be reworked into another array

    return false;
}

function checkThemeStyleVersion($fileName, $path)
{
    // if there will be more cases of themes using style.css as version file, we'll need to add new array of pairs
    // such as "/onetone/" => "3.0.6"
    // and rework this whole function into using this new array

    if (false !== strpos($path . '/' . $fileName, '/onetone/')) {
        //getting the line with version number
        $version = findLineInFile($path . '/' . $fileName, 'Version:');

        // keeping just the version value
        $version = trim(preg_replace("/Version: /", '$1', $version));

        // Compares if plugin version is 3.0.6 or lower
        if (version_compare($version, '3.0.6') <= 0) {
            return array('name' => 'OneTone Theme', 'version' => $version, 'dir' => $path.'/', 'updated' => false, 'url' => 'https://wpvulndb.com/themes/onetone', );
        }
    }
    
    if (false !== strpos($path . '/' . $fileName, '/jnews/')) {
        //getting the line with version number
        $version = findLineInFile($path . '/' . $fileName, 'Version:');

        // keeping just the version value
        $version = trim(preg_replace("/Version: /", '$1', $version));

        // Compares if theme version is 8.0.6 or lower
        if (version_compare($version, '8.0.6') <= 0) {
            return array('name' => 'Jnews Theme', 'version' => $version, 'dir' => $path.'/', 'updated' => false, 'url' => 'https://wpscan.com/vulnerability/415ca763-fe65-48cb-acd3-b375a400217e', );
        }
    }

    if ((false !== strpos($path . '/' . $fileName, '/jupiter/')) && (false === strpos($path, '/jupiter/framework/')) && (false === strpos($path, '/jupiter/assets/'))) {
        //getting the line with version number
        $version = findLineInFile($path . '/' . $fileName, 'Version:');

        // keeping just the version value
        $version = trim(preg_replace("/[\s*]*Version: /", '$1', $version));

        // Compares if theme version is 6.10.1 or lower
        if (version_compare($version, '6.10.1') <= 0) {
            return array('name' => 'Jupiter Theme', 'version' => $version, 'dir' => $path.'/', 'updated' => false, 'vulnerabletheme' => true,  'url' => 'https://wpscan.com/vulnerability/ff094c7a-9d2c-447f-adf8-b87400f4dc5d', );
        }
    }

    return false;
}


function checkUploadifyVersion($fileName, $path)
{
    return array('name' => 'uploadify');
}

function checkPHPUnitVersion($fileName, $path)
{
    if (false === strpos($path . '/' . $fileName, '/Util/PHP/eval-stdin.php')) {
        return false;
    }
    
    // Check that the file contains the vulnerable code (reading from php://input)
    $contents = @file_get_contents($path . '/' . $fileName, false, null, 0, 1024);
    
    if (strpos($contents, "eval('?>' . file_get_contents('php://input'));") === false) {
        return false; // not vulnerable
    }
    
    // Find the PHPUnit version
    $realdir = dirname(dirname($path));
    
    $version = findLineInFile($realdir . '/Runner/Version.php', 'SebastianBergmann\\Version');
    
    if ($version !== null && preg_match("/SebastianBergmann\\\\Version\\('([0-9.]+)',/", $version, $m)) {   
        $version = $m[1];
    } else {
        $version = findLineInFile($realdir . '/Runner/Version.php', "const VERSION = '");
        if ($version !== null && preg_match("/const VERSION = '([0-9.]+)'/", $version, $m)) {
            $version = $m[1];
        } else {
            $version = 'unknown';
        }
    }

    return array('name' => 'phpunit', 'version' => $version, 'dir' => $path.'/', 'updated' => false);
}

function checkElementorVersion($fileName, $path)
{
    if (false === strpos($path . '/' . $fileName, 'plugins/elementor/elementor.php')) {
        return false;
    }
    
    $version = findLineInFile($path . '/' . $fileName, '* Version:');
    $version = trim(preg_replace("/ \* Version: /", '$1', $version));
    
    if ((version_compare($version, '3.6.3') <= 0) && (version_compare($version, '3.6.0') >= 0)) {
        return array('name' => 'Elementor', 'version' => $version, 'dir' => $path.'/', 'updated' => false, 'url' => 'https://wpscan.com/vulnerability/df62d170-c7d1-43a4-b6dc-20512934c33e', );
    }
}

function checkUltimateMemberVersion($fileName, $path)
{
    if (false === strpos($path . '/' . $fileName, 'plugins/ultimate-member/ultimate-member.php')) {
        return false;
    }
    
    $version = findLineInFile($path . '/' . $fileName, 'Version:');
    $version = trim(preg_replace("/Version: /", '$1', $version));
    
    if (version_compare($version, '2.4.0') < 0) {
        return array('name' => 'Ultimate Member', 'version' => $version, 'dir' => $path.'/', 'updated' => false, 'url' => 'https://blog.sucuri.net/2022/06/vulnerability-patch-roundup-june-2022.html', );
    }
}

function checkThePlusElementorAddonVersion($fileName, $path)
{
    if (false === strpos($path . '/' . $fileName, 'plugins/theplus_elementor_addon/theplus_elementor_addon.php')) {
        return false;
    }

    $version = findLineInFile($path . '/' . $fileName, '* Version:');
    $version = trim(preg_replace("/\* Version: /", '$1', $version));

    if (version_compare($version, '4.1.6') <= 0) {
        return array('name' => 'ThePlusElementorAddon', 'version' => $version, 'dir' => $path.'/', 'oldplugin' => true, 'premium' => true, 'updated' => false, 'url' => 'https://wpscan.com/vulnerability/c311feef-7041-4c21-9525-132b9bd32f89', );
    }
}

function checkdotenv($fileName, $path)
{
    if (empty($_SERVER['HTTP_HOST'])) {
        return false;
    }

    if (false === strpos($path . '/' . $fileName, '.env')) {
        return false;
    }

	$dotenvfile = ($_SERVER['HTTP_HOST'] . '/' . $fileName);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $dotenvfile);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
	$result = @curl_exec($ch);
	curl_close($ch);
	if(strpos($result, 'DB_PASSWORD') !== false) {
		return array('name' => '.env', 'version' => 'vulnerable', 'dir' => $path.'/'.$fileName, 'oldplugin' => true, 'configuration' => true, 'url' => 'https://nvd.nist.gov/vuln/detail/CVE-2017-16894', );
	}
}

/**
 * Convert Object to an array
 *
 * Receives the object and converts it to an array recursively.
 * @param   $obj    Object to convert
 * @return  $ret    Array
 *
 */
function object_to_array($obj) {
    if(is_object($obj) || is_array($obj)) {
        $ret = (array) $obj;
        foreach($ret as &$item) {
            $item = object_to_array($item);
        }
        return $ret;
    }
    else {
        return $obj;
    }
}

/**
 * Checks plugin versions and if there's a new version
 *
 * Receives directory to check on with a WordPress installation
 * @param   $dir    String - Directory to check for a WordPress installation on
 * @return  $res    Array - Containing message data to display
 *
 */
function checkPluginVersions($dir)
{
    include_once($dir . 'wp-load.php');
    include_once($dir . 'wp-admin/includes/misc.php');
    include_once($dir . 'wp-admin/includes/file.php');
	
	if ( ! function_exists( 'get_plugins' ) ) {
            require_once $dir . 'wp-admin/includes/plugin.php';
        }
	$all_plugins = get_plugins();
	
	include_once $dir . 'wp-admin/includes/class-wp-upgrader.php';
	wp_cache_flush();
	$updates_transient = get_site_transient('update_plugins');
	$updates_transient = object_to_array($updates_transient);
	foreach($updates_transient['response'] as $id => $result) {
            $version = $all_plugins[$updates_transient['response'][$id]['plugin']]['Version'];
		
            if (!isset($updates_transient['response'][$id]['upgrade_notice'])){
                $upgrade_notice = '';
            }
            else{
                // catch only first non-empty line
                $upgrade_notice_a = preg_split('#\r?\n#', ltrim($updates_transient['response'][$id]['upgrade_notice']), 0);
                $upgrade_notice = $upgrade_notice_a[0];
            }
		
            $res = array('name' => $updates_transient['response'][$id]['slug'], 'version' => $version, 'dir' => $dir . 'wp-content/plugins/' . $updates_transient['response'][$id]['plugin'], 'updated' => false, 'url' => 'New Version: ' . $updates_transient['response'][$id]['new_version'] . ' ' . strip_tags($upgrade_notice) , );
            printFoundVersion('Plugin Check', $res);
	}
    return false;
}

function checkHtaccess($fileName, $path)
{
    return array('name' => 'htaccess');
}

// ==================================
// The main version check loop

$VERSION_CHECKS = array(
    'system.module' => 'checkDrupalVersion',
    'bootstrap.inc' => 'checkDrupalVersion',
    'Drupal.php' => 'checkDrupal8Version',
    'Mage.php' => 'checkMagentoVersion',
    'Magento.php' => 'checkMagento2Version',
    'version.inc.php' => 'checkModXVersion',
    'configuration.php' => 'checkJoomlaVersion',
    'jce.xml' => 'checkJceVersion',
    'constants.php' => 'checkPhpBbVersion',
    'diagnostic.php' => 'checkVBulletinVersion',
    'version.php' => 'checkWordPressAndZenPhotoVersion',
    'checkout_shipping_address.php' => 'checkOsCommerceVersion',
    'revslider.php' => 'checkRevSliderVersion',
    'showbiz.php' => 'checkShowBizVersion',
    'TranslatedConfiguration.php' => 'checkPrestaShopVersion',
    'manufacturer.php' => 'checkOpenCartVersion',
    'upload.php' => 'checkDzsVideoGalleryVersion',
    'uploadify.php' => 'checkUploadifyVersion',
    '.htaccess' => 'checkHtaccess',
    'config_default.php' => 'checkTypo3Version',
    'SystemEnvironmentBuilder.php' => 'checkTypo3Version',
    'td_config.php' => 'checkTDThemesVersion',
    'tagdiv-config.php' => 'checkTDThemesVersion',
    'UploadHandler.php' => 'checkjQueryFileUploadVersion',
    'index.php' => 'checkPluginIndexVersion',
    'Main.php' => 'checkPluginMainVersion',
    'start.php' => 'checkFreemiusVersion',
    'init.php' => 'checkPluginInitVersion',
    'phpmailer.php' => 'checkPhpMailerVersion',
    'style.css' => 'checkThemeStyleVersion',
    'eval-stdin.php' => 'checkPHPUnitVersion',
    'elementor.php' => 'checkElementorVersion',
    'ultimate-member.php' => 'checkUltimateMemberVersion',
    'theplus_elementor_addon.php' => 'checkThePlusElementorAddonVersion',
    '.env' => 'checkdotenv',
    'Kernel.php' => 'checkSymfLaravelVersion',
    'Application.php' => 'checkSymfLaravelVersion',
);

function runVersionCheck($path, $checkFound)
{
    global $VULNERABLE_PLUGINS, $VERSION_CHECKS, $isNoise, $CMS;

    $dh = @opendir($path);
    if (!$dh) {
        if ($isNoise) {
            echo 'Open directory failed: '.escapeHtml($path)."\n";
        }

        return;
    }
  
    call_user_func($checkFound, $path, 'trace');

    while (($fileName = @readdir($dh)) !== false) {
        if ($fileName === '.' || $fileName == '..' || strpos($fileName, 'sucuribackup.') !== false) {
            continue;
        }

        $fullName = $path.'/'.$fileName;
        if (@is_link($fullName)) {
            if ($isNoise) {
                echo 'Skipping symlink directory: '.escapeHtml($fullName)."\n";
            }
            continue;
        }

        $res = false;
        if (isset($VERSION_CHECKS[$fileName])) {
            $CMS = '0';
            $res = call_user_func($VERSION_CHECKS[$fileName], $fileName, $path);
        } elseif (strpos($fileName, '.php') !== false &&
            (strpos($fileName, 'thumb') !== false ||
            strpos($fileName, 'Thumb') !== false ||
            strpos($fileName, 'crop') !== false)) {
            $res = checkTimThumbVersion($fileName, $path);
            $CMS = '0';
        } elseif (false !== strpos($path, '/wp-content/plugins/') && isset($VULNERABLE_PLUGINS[$fileName])) {
            $CMS = '0';
            $res = checkWpPlugin($path, $fileName);
        }
        if ($res) {
            call_user_func($checkFound, $fullName, $res);
        }

        if (@is_dir($fullName)) {
            if ($isNoise) {
                echo '    Reading Dir: '.escapeHtml($fullName)."\n";
            }
            runVersionCheck($fullName, $checkFound);
            @flush();
        }
    }
    closedir($dh);
}

// jsonDcode implementation that works with small jsons

class JSONError
{
}

$JSON_ESCAPE_CHARS = array('"' => '"', '\\' => '\\', '/' => '/', 'b' => "\10",
    'f' => "\f", 'n' => "\n", 'r' => "\r", 't' => "\t");

function jsonParseStr($json, &$pos)
{
    global $JSON_ESCAPE_CHARS;
    
    if ($pos >= strlen($json)) {
        return new JSONError;
    }
    
    $str = '';

    $start = $pos;
    
    while ($json[$pos] !== '"') {
        if ($json[$pos] !== '\\') {
            $pos++;
            if ($pos >= strlen($json)) {
                return new JSONError; // unterminated string
            }
            continue;
        }
        $str .= substr($json, $start, $pos - $start);

        $pos++;
        if ($pos >= strlen($json)) {
            return new JSONError; // unterminated escape sequence
        }
        
        if (isset($JSON_ESCAPE_CHARS[$json[$pos]])) {
            $str .= $JSON_ESCAPE_CHARS[$json[$pos]];
            $pos++;
            if ($pos >= strlen($json)) {
                return new JSONError; // unterminated string
            }
        } elseif ($json[$pos] === 'u' && $pos + 5 < strlen($json) &&
            ctype_xdigit(substr($json, $pos + 1, 4))) {
            $charCode = hexdec(substr($json, $pos + 1, 4));
            $pos += 5;
            // Encode UTF-8 (characters outside BMP are not supported in this version)
            if ($charCode < 0x80) {
                $str .= chr($charCode);
            } elseif ($charCode < 0x800) {
                $str .= chr(($charCode >> 6) | 0xC0) . chr(($charCode & 0x3F) | 0x80);
            } else {
                $str .= chr(($charCode >> 12) | 0xE0) . chr((($charCode >> 6) & 0x3F) | 0x80) .
                    chr(($charCode & 0x3F) | 0x80);
            }
        } else {
            return new JSONError; // invalid escape sequence
        }
        $start = $pos;
    }
    $str .= substr($json, $start, $pos - $start);
    
    $pos++;
    return $str;
}

function jsonSkipSpaces($json, &$pos)
{
    if ($pos >= strlen($json)) {
        return false;
    }
    
    while ($json[$pos] === ' ' || $json[$pos] === '\t' || $json[$pos] === '\n' || $json[$pos] === '\r') {
        $pos++;

        if ($pos >= strlen($json)) {
            return false;
        }
    }
    
    return true;
}

function jsonParseArray($json, &$pos, $isAssoc)
{
    $array = array();
    
    // Check for an empty array
    if (!jsonSkipSpaces($json, $pos)) {
        return new JSONError;
    }
    if ($json[$pos] === ']') {
        $pos++;
        return $array;
    }
    
    for (;;) {
        // Value
        $value = jsonParseAtom($json, $pos, $isAssoc);
        if (is_object($value) && get_class($value) === 'JSONError') {
            return $value;
        }
        $array[] = $value;

        // A comma or a closing bracket
        if (!jsonSkipSpaces($json, $pos)) {
            return new JSONError;
        }
    
        if ($json[$pos] === ']') {
            $pos++;
            return $array;
        } elseif ($json[$pos] !== ',') {
            return new JSONError; // expected bracket or comma
        }
        
        $pos++;
    }
}

function jsonParseObject($json, &$pos, $isAssoc)
{
    $object = $isAssoc ? array() : new stdClass;
    
    // Check for an empty object
    if (!jsonSkipSpaces($json, $pos)) {
        return new JSONError;
    }
    if ($json[$pos] === '}') {
        $pos++;
        return $object;
    }
    
    for (;;) {
        // Name
        if (!jsonSkipSpaces($json, $pos) || $json[$pos] !== '"') {
            return new JSONError;
        }
        $pos++;
        
        $name = jsonParseStr($json, $pos);
        if (is_object($name) && get_class($name) === 'JSONError') {
            return $name;
        }
    
        if (!jsonSkipSpaces($json, $pos) || $json[$pos] !== ':') {
            return new JSONError;
        }
        $pos++;
        
        // Value
        $value = jsonParseAtom($json, $pos, $isAssoc);
        if (is_object($value) && get_class($value) === 'JSONError') {
            return $value;
        }
        if ($isAssoc) {
            $object[$name] = $value;
        } else {
            // Add numeric names as strings
            // (if we convert array to an object instead, then the numeric keys will be inaccessible)
            $object->{$name} = $value;
        }

        // A comma or a closing brace
        if (!jsonSkipSpaces($json, $pos)) {
            return new JSONError;
        }
    
        if ($json[$pos] === '}') {
            $pos++;
            return $object;
        } elseif ($json[$pos] !== ',') {
            return new JSONError; // expected bracket or comma
        }
        $pos++;
    }
}

function jsonParseAtom($json, &$pos, $isAssoc)
{
    if (!jsonSkipSpaces($json, $pos)) {
        return new JSONError;
    }
    $ch = $json[$pos];
    
    if ($ch === '"') {
        $pos++;
        return jsonParseStr($json, $pos);
    } elseif ($ch === '-' || '0' <= $ch && $ch <= '9') {
        $atom = substr($json, $pos);
        if (preg_match('/^-?(?:0|[1-9][0-9]{0,8}+)(?![.eE])/', $atom, $match)) {
            $pos += strlen($match[0]);
            return intval($atom);
        } elseif (preg_match('/^-?(?:0|[1-9][0-9]*+)(?:\.[0-9]++)?(?:[eE][+-]?[0-9]++)?/', $atom, $match)) {
            $pos += strlen($match[0]);
            return floatval($atom);
        } else {
            return new JSONError; // Invalid number
        }
    } elseif ($ch === '[') {
        $pos++;
        return jsonParseArray($json, $pos, $isAssoc);
    } elseif ($ch === '{') {
        $pos++;
        return jsonParseObject($json, $pos, $isAssoc);
    } elseif ($ch === 'f' && substr($json, $pos, 5) === 'false') {
        $pos += 5;
        return false;
    } elseif ($ch === 't' && substr($json, $pos, 4) === 'true') {
        $pos += 4;
        return true;
    } elseif ($ch === 'n' && substr($json, $pos, 4) === 'null') {
        $pos += 4;
        return null;
    } else {
        return new JSONError;
    }
}

function jsonDcode($json, $isAssoc = false, $allowInternal = true)
{
    if (function_exists('json_decode') && $allowInternal) {
        return json_decode($json, $isAssoc);
    }
    
    $pos = 0;
    $ret = jsonParseAtom($json, $pos, $isAssoc);
    
    if (jsonSkipSpaces($json, $pos) || is_object($ret) && get_class($ret) === 'JSONError') {
        return null;
    }
    
    return $ret;
}

// ======================================================
// DB abstraction layer

class MySQLCommon
{
    function escapeName($name)
    {
        // See https://dev.mysql.com/doc/refman/5.7/en/identifiers.html
        return '"' . str_replace('"', '""', $name) . '"';
    }

    function begin()
    {
        $this->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;');
        $this->query('BEGIN;');
    }

    function commit()
    {
        $this->query('COMMIT;');
    }

    function rollback()
    {
        $this->query('ROLLBACK;');
    }

    function getTablesColumns($config, $withCompositeKeys = false)
    {
        $scannedTypes = array(
            'varchar' => 1, 'char' => 1,
            'tinytext' => 1, 'mediumtext' => 1, 'text' => 1, 'longtext' => 1,
            'binary' => 1, 'varbinary' => 1,
            'tinyblob' => 1, 'blob' => 1, 'mediumblob' => 1, 'longblob' => 1);

        // Get all tables
        $tablesResult = $this->query('SHOW FULL TABLES;');

        $allTables = array();
        while ($tablesRow = $this->fetchRow($tablesResult)) {
            $tablesRows[] = $tablesRow;
        }
        foreach ($tablesRows as $tablesRow) {
            // Report tables that does not begin with the Wordpress prefix
            $table = $tablesRow[0];
            if ($tablesRow[1] === 'SEQUENCE') { // MariaDB sequence
                continue;
            }
            if (!empty($config['prefix']) && 0 !== strncmp($table, $config['prefix'], strlen($config['prefix'])) &&
                !isset($_GET['dump'])) {
                printMsg("\nWARN: Table " . $table . ' does not start with prefix ' .
                    $config['prefix'] . ';', ' whitelists and CMS-specific rules will not work for this table');
            }

            $allTables[$table] = array();

            // Get all columns
            $columnsResult = $this->query('SHOW COLUMNS FROM ' . $this->escapeName($table) . ';', true);
            if ($columnsResult === false) {
                printMsg("\nWARN: Failed to list columns for " . $table);
                continue;
            }
            $uniqueString = null;
            $compositePrimary = false;
            $compositeKeys = array();
            while ($columnsRow = $this->fetchAssoc($columnsResult)) {
                $type = $columnsRow['Type'];
                $pos = strpos($type, "(");
                if ($pos !== false) {
                    $type = substr($type, 0, $pos);
                }

                if (strtoupper($columnsRow['Key']) === 'PRI') {
                    if (isset($allTables[$table]['idname'])) {
                        $compositePrimary = true;
                    }

                    if ($withCompositeKeys) {
                        $compositeKeys[] = $columnsRow['Field'];
                    }

                    $allTables[$table]['idname'] = $columnsRow['Field'];
                }

                $type = strtolower(trim($type));
                if (!isset($scannedTypes[$type])) {
                    continue;
                }

                // Prefer unique string keys to display wp_options.option_name instead of the numeric ID
                if (strtoupper($columnsRow['Key']) === 'UNI') {
                    $uniqueString = $columnsRow['Field'];
                }

                $allTables[$table][] = $columnsRow['Field'];
            }

            if ($uniqueString !== null) {
                $allTables[$table]['idname'] = $uniqueString;
            } elseif ($withCompositeKeys && count($compositeKeys) > 1) {
                /* return idname as an array of primary keys */
                $allTables[$table]['idname'] = $compositeKeys[0];

                //patch to attempt to fix composite keys index in drupal table field_data_body and others
                if($allTables[$table]['idname'] == 'entity_type'){
                    $allTables[$table]['idname'] = 'entity_id';
                }
            } elseif ($compositePrimary) { // Disable the cleanup for composite primary keys and no primary key
                unset($allTables[$table]['idname']);
            }
        }
        return $allTables;
    }

    function getColumnNamesTypes($table)
    {
        $columnsResult = $this->query('SHOW COLUMNS FROM ' . $this->escapeName($table) . ';');

        $binaryTypes = array('binary' => 1, 'varbinary' => 1,
            'tinyblob' => 1, 'blob' => 1, 'mediumblob' => 1, 'longblob' => 1);

        $numericTypes = array('tinyint' => 1, 'smallint' => 1, 'mediumint' => 1,
            'int' => 1, 'integer' => 1, 'bigint' => 1,
            'decimal' => 1, 'dec' => 1, 'numeric' => 1, 'fixed' => 1,
            'float' => 1, 'real' => 1, 'double' => 1, 'double precision' => 1);

        $names = array();
        $types = array();

        while ($columnsRow = $this->fetchAssoc($columnsResult)) {
            $names[] = $columnsRow['Field'];

            $type = $columnsRow['Type'];
            $pos = strpos($type, "(");
            if ($pos !== false) {
                $type = substr($type, 0, $pos);
            }
            $type = strtolower(trim($type));

            if (isset($numericTypes[$type])) {
                $types[] = 'num';
            } elseif (isset($binaryTypes[$type])) {
                $types[] = 'bin';
            } elseif ($type === 'bit') {
                $types[] = 'bit';
            } else {
                $types[] = 'other';
            }
        }

        return array($names, $types);
    }

    function exportRow($row, $types)
    {
        for ($i = 0; $i < count($row); $i++) {
            if ($row[$i] === null) {
                $row[$i] = 'NULL';
            } elseif ($types[$i] === 'bin') {
                // Story binary data as hex to avoid encoding problems
                $row[$i] = 'UNHEX(' . $this->escapeStr(bin2hex($row[$i])) . ')';
            } elseif ($types[$i] === 'bit') {
                // TODO: tests under PHP 4
                // See https://stackoverflow.com/questions/15106985/
                $row[$i] = "b'" . decbin($row[$i]) . "'";
            } elseif ($types[$i] === 'num') {
                $row[$i] = (string)$row[$i];
            } else {
                $row[$i] = $this->escapeStr($row[$i]);
            }
        }
        return implode(', ', $row);
    }

    function getCreateTableSql($table)
    {
        $res = $this->query('SHOW CREATE TABLE ' . $this->escapeName($table) . ';');
        $row = $this->fetchRow($res);

        if (!$row) {
            exit('Unexpected empty result from SHOW CREATE TABLE');
        }

        return $row[1] . ";\n\n";
    }

    function getCreateDBSql($db)
    {
        $res = $this->query('SHOW CREATE DATABASE ' . $this->escapeName($db) . ';');
        $row = $this->fetchRow($res);

        if (!$row) {
            exit('Unexpected empty result from SHOW CREATE DATABASE');
        }

        return $row[1] . ";\nUSE " . $this->escapeName($db) . ";\n\n";
    }

    function getDumpHeader()
    {
        return
            "SET NAMES 'utf8';\n" .
            "SET sql_mode='NO_AUTO_VALUE_ON_ZERO,ANSI_QUOTES,STRICT_TRANS_TABLES';\n" .
            "SET foreign_key_checks=0;\n";
    }

    function setModes()
    {
        $this->query("SET NAMES 'utf8';");
        $this->query("SET sql_mode='PIPES_AS_CONCAT,IGNORE_SPACE," .
            "NO_AUTO_VALUE_ON_ZERO,ANSI_QUOTES,STRICT_TRANS_TABLES';");
    }

    function queryLowMemory($sql, $forceResReturn = false)
    {
        return $this->query($sql, $forceResReturn);
    }
}

class MySQLDriver extends MySQLCommon
{
    var $link;

    function connect($config)
    {
        // Connect to DB
        $host = $config['host'];
        if (isset($config['port'])) {
            $host .= ':' . $config['port'];
        }
        $this->link = @mysql_connect($host, $config['user'], $config['pass']);
        if ($this->link === false) {
            return 'Could not connect to MySQL database: ' . mysql_error();
        }

        mysql_select_db($config['db'], $this->link);

        $this->setModes();
        return true;
    }

    function disconnect()
    {
        mysql_close($this->link);
    }

    function escapeStr($str)
    {
        return "'" . mysql_real_escape_string($str, $this->link) . "'";
    }

    function query($sql, $forceResReturn = false)
    {
        global $isPlainText;
        $res = mysql_query($sql, $this->link);
        if (!$res) {
            if ($forceResReturn === true) {
                return $res;
            }

            $error = mysql_error($this->link);
            if (!$isPlainText) {
                $error = '<b>' . escapeHtml($error) . '</b>';
            }
            echo "\n" . escapeHtml(substr($sql, 0, 100)) . ' -- ' . $error . "\n";
            exit(1);
        }
        return $res;
    }

    function fetchAssoc($res)
    {
        $row = mysql_fetch_assoc($res);
        if (false === $row) {
            mysql_free_result($res);
        }
        return $row;
    }

    function fetchRow($res)
    {
        $row = mysql_fetch_row($res);
        if (false === $row) {
            mysql_free_result($res);
        }
        return $row;
    }

    function getAffectedRows()
    {
        return mysql_affected_rows($this->link);
    }

    function getName()
    {
        return 'MySQL database';
    }
}

class MySQLIDriver extends MySQLCommon
{
    var $link;

    function connect($config)
    {
        // Connect to DB
        $port = isset($config['port']) ? $config['port'] : null;
        $this->link = @mysqli_connect($config['host'], $config['user'], $config['pass'], $config['db'], $port);
        if ($this->link === false) {
            return 'Could not connect to MySQLi database: ' . mysqli_connect_error();
        }

        $this->setModes();
        return true;
    }

    function disconnect()
    {
        mysqli_close($this->link);
    }

    function escapeStr($str)
    {
        return "'" . mysqli_real_escape_string($this->link, $str) . "'";
    }

    function query($sql, $forceResReturn = false)
    {
        global $isPlainText;
        $res = mysqli_query($this->link, $sql);
        if (!$res) {
            if ($forceResReturn === true) {
                return $res;
            }

            $error = mysqli_error($this->link);
            if (!$isPlainText) {
                $error = '<b>' . escapeHtml($error) . '</b>';
            }

            echo "\n" . escapeHtml(substr($sql, 0, 100)) . ' -- ' . $error . "\n";
            exit(1);
        }
        return $res;
    }

    function fetchAssoc($res)
    {
        $row = mysqli_fetch_assoc($res);
        if (false === $row) {
            mysqli_free_result($res);
        }
        return $row;
    }

    function fetchRow($res)
    {
        $row = mysqli_fetch_row($res);
        if (false === $row) {
            mysqli_free_result($res);
        }
        return $row;
    }

    function getAffectedRows()
    {
        return mysqli_affected_rows($this->link);
    }

    function getName()
    {
        return 'MySQLi database';
    }
}

/**
 * Class MySQLIDriverLowMemory
 *
 * This object consumes less memory when querying the database, but
 * be aware that you cannot keep results in memory without using
 * them first in a loop or cleaning them with mysqli_free_result
 *
 */
class MySQLIDriverLowMemory extends MySQLIDriver
{

    function queryLowMemory($sql, $forceResReturn = false)
    {
        global $isPlainText;
        mysqli_store_result($this->link);
        if ($forceResReturn) {
            $res = mysqli_query($this->link, $sql);
        } else {
            mysqli_real_query($this->link, $sql);
            $res = mysqli_use_result($this->link);
        }

        if (!$res) {
            if ($forceResReturn === true) {
                return $res;
            }

            $error = mysqli_error($this->link);
            if ($error !== '') {
                if (!$isPlainText) {
                    $error = '<b>' . escapeHtml($error) . '</b>';
                }

                echo "\n" . escapeHtml(substr($sql, 0, 100)) . ' -- ' . $error . "\n";
                exit(1);
            }
        }
        return $res;
    }
}

function printFoundVersion($fullName, $res)
{
    global $VULN_SOFTWARE, $VULNERABILITIES, $CMS;
    
    if ($res === 'trace') {
        return;
    }
    
    if ($res['name'] === 'htaccess') {
        if (isset($_GET['ht'])) {
            echo 'Checking htaccess: ' . escapeHtml($fullName) . "\n";
        }
        return;
    } elseif ($res['name'] === 'uploadify') {
        echo 'Warning: uploadify.php found at ' . escapeHtml($fullName) .
            ' . Please be sure that you have secured this plugin properly. You can find more info on: ' .
            "https://blog.sucuri.net/2012/06/uploadify-uploadify-and-uploadify-the-new-timthumb.html\n";
        return;
    } elseif ($res['name'] === 'phpunit') {
        echo 'Warning: PHPUnit ' . $res['version'] . ' found at ' . escapeHtml($fullName) .
            ' . Please be sure that you have secured this plugin properly. You can find more info on: ' .
            "https://labs.sucuri.net/vulnerabilities-digest-january-2020/\n";
        return;
    }

    if ($res['dir'] === '.') {
        if (isset($_GET['robot'])){
            $res['dir'] = '/ (main folder)';
        }
        else{
            $res['dir'] = './';
        }
    }
    
    $info = ' inside: ' . escapeHtml($res['dir']) . ' - Version: ' . escapeHtml($res['version']);
    
    //make all vars empty to display them for rob as empty
    $checkint = $close_tags = $warning_color = $ok_color = $vuln_color = $timthumb_check = $plugin_check = $plugin_updt_link = '';
    if (!isset($_GET['robot']) && !isTerminal()){
        $close_tags = '</b></em>';
        $warning_color = '<em style="color: #b71b1b;"><b>';
        $ok_color = '<em style="color: green;"><b>';
        $vuln_color = '<em style="color: red;"><b>';
        $array_info = explode('/', $info);
        if (isset($array_info[3])){
            switch ($array_info[3]) {
                case "advanced-cf7-db":
                case "appointment-booking-calendar":
                case "contact-form-7":
                case "easy-wp-smtp":
                case "fancybox-for-wordpress":
                case "social-warfare":
                case "woocommerce-checkout-manager":
                case "wordpress-seo":
                case "wp-gdpr-compliance":
                case "wp-live-chat-support":
                case "wp-mail-smtp":
                case "wp-slimstat":
                    $plugin_updt_link = " <label class='noselect'> - <a target='_blank' href='sucuri-cleanup.php?srun&update_plugin&plugin=" . escapeHtml($array_info[3]) . "'>Update this plugin</a></label>";
                    break;
            }
        }
        
        if (!isset($res['url'])){
            $res['url'] = '';
        }
        
        if ($CMS == '1'){
            $checkint = " <label class='noselect'> - <a target='_blank' href='sucuri-cleanup.php?srun&checkint&scandirs=" . escapeHtml($res['dir']) . "'>Checkint this directory</a></label>";
            $warning_color = '<em style="color: #e06b0b;"><b>';
        }        
    }
    if (isset($res['source'])) {
        $info .= ' (from ' . escapeHtml($res['source']) . ')';
    }

    if (isset($res['oldplugin'])) {
        if (isset($res['replaceplugin'])) {

            $info = ' at ' . escapeHtml($res['dir']) . ' - Version: ' . escapeHtml($res['version']) .
                ' - This vulnerable plugin needs to be completely removed.' .
                (isset($res['url']) ? ': ' . $res['url'] : '.');
                    echo $vuln_color . 'Warning: Vulnerable ' . $res['name'] . ' plugin found' . $info . $close_tags . $plugin_updt_link . ".\n";
                    
        } elseif (isset($res['configuration'])) {
            $info = ' at ' . escapeHtml($res['dir']) . ' This configuration file was found to be acessible to the public, steps should be taken to secure it.' .
                (isset($res['url']) ? ': ' . $res['url'] : '.');
                    echo $vuln_color . 'Warning: Vulnerable ' . $res['name'] . ' Configuration file found' . $info . $close_tags . $plugin_updt_link . ".\n";
                    
        }else {

            $info = ' at ' . escapeHtml($res['dir']) . ' - Version: ' . escapeHtml($res['version']) .
                ' - Please update this plugin immediately' .
                (isset($res['url']) ? ': ' . $res['url'] : '.');
                    echo $vuln_color . 'Warning: Vulnerable ' . $res['name'] . ' plugin found' . $info . $close_tags . $plugin_updt_link . ".\n";
        }
    } elseif ($res['updated']) {
        echo $ok_color . 'OK: ' . $res['name'] . ' found (updated)' . $info . $close_tags . "  " . $checkint . "\n";
    } elseif (isset($res['vulnerabletheme'])) {
        $info = ' at ' . escapeHtml($res['dir']) . ' - Version: ' . escapeHtml($res['version']) .
            ' - Please update this theme or switch it immediately' .
            (isset($res['url']) ? ': ' . $res['url'] : '.');
        echo $vuln_color . 'Warning: Vulnerable ' . $res['name'] . ' theme found' . $info . $close_tags . ".\n";
    } else {
        echo $warning_color . 'Warning: Found outdated ' . $res['name'] . $info . "- Please update asap. " . $res['url'] . $close_tags . $checkint . "\n";
    }
    
    if ($res['name'] === 'WordPress') {
        if (isset($_GET['wpvulndb']) && isset($VULN_SOFTWARE['wordpress'][$res['version']])) {
            print( "\nAssociated vulnerabilities:\n" );
            foreach ($VULN_SOFTWARE['wordpress'][$res['version']] as $warningNo) {
                printf("%s - %s\n", str_repeat("\x20", 10), escapeHtml($VULNERABILITIES[$warningNo]));
            }
            print( "\n" );
        }
        if (isset($_GET['list-plugins'])) {
            listWordPressPlugins($res['config']);
        }
    } elseif ($res['name'] === 'TimThumb') {
        if (isset($_GET['ttupdate'])) {
            replaceTimThumb($fullName);
        }
    } elseif ($res['name'] === 'Joomla') {
        if (isset($_GET['list-plugins'])) {
            listJoomlaPlugins($res['config']);
        }
    }
}


// =========================
// TimThumb update functions

function backupFile($file)
{
    $backupCopy = $file . '_sucuribackup.' . time();
    if (!copy($file, $backupCopy)) {
        return false;
    }

    if (filesize($file) !== filesize($backupCopy)) {
        return false;
    }
    
    chmod($backupCopy, 000);

    $newfile = file($file);
    if ($newfile === false || empty($newfile)) {
        return false;
    }
    
    return true;
}

function replaceTimThumb($fileName)
{
    // Download the new version if not already downloaded
    global $NewTimThumb;
   
    if (!$NewTimThumb) {
        $NewTimThumb = file_get_contents('https://raw.githubusercontent.com/GabrielGil/TimThumb/564c00058271147af32da8ac665c00f6a1c4ac29/timthumb.php');
    }

    if (!strpos($NewTimThumb, 'define (\'VERSION')) {
        echo 'FAILED: TimThumb update at ' . escapeHtml($fileName) . " - Error on downloading new version\n";
        return;
    }

    // Backup the old file
    if (!backupFile($fileName)) {
        echo 'FAILED: TimThumb backup at ' . escapeHtml($fileName) . "\n";
        return;
    }

    // Replace the file with the downloaded version
    $fp = fopen($fileName, 'w');
    if (!$fp) {
        echo "Couldn't open ". escapeHtml($fileName) ."\n";
        return;
    }

    if (fwrite($fp, $NewTimThumb) === strlen($NewTimThumb)) {
        echo 'timthumb.php updated at ' . escapeHtml($fileName) . "\n";
    } else {
        echo 'FAILED: Unable to update TimThumb at ' . escapeHtml($fileName) . "\n";
    }

    fclose($fp);
}

// =====================
// List plugins

function printMsg($msg, $details = '')
{
    echo escapeHTML($msg . $details);
}

function getWordPressPlugins($configFileName)
{
    $configContent = file_get_contents($configFileName);
    if (false === $configContent) {
        echo 'Unable to read ' . escapeHtml($configFileName) . "\n\n";
        return array(array(), array());
    }
    
    $config = array(
        'host' => getOption('DB_HOST', $configContent, OPT_TYPE_CONST | OPT_TYPE_ENV),
        'user' => getOption('DB_USER', $configContent, OPT_TYPE_CONST),
        'pass' => getOption('DB_PASSWORD', $configContent, OPT_TYPE_CONST),
        'db' => getOption('DB_NAME', $configContent, OPT_TYPE_CONST),
        'prefix' => getOption('$table_prefix', $configContent, OPT_TYPE_VAR),
    );
    
    if (!$config['host'] || !$config['db'] || !$config['user']) {
        echo "WARN: No DB config\n\n";
        return array(array(), array());
    }
    
    $driver = function_exists('mysqli_connect') ? new MySQLIDriver() : new MySQLDriver();
    $errMsg = $driver->connect($config);
    if ($errMsg !== true) {
        echo escapeHtml($errMsg) . "\n";
        return array(array(), array());
    }
    
    if (!preg_match('/^[a-zA-Z0-9_-]+$/', $config['prefix'])) {
        echo 'Invalid prefix: ' . escapeHtml($config['prefix']) . "\n\n";
        return array(array(), array());
    }
    
    // Plugins
    $plugins = array();
    //First lets check the current transient
    $res = $driver->query('SELECT "option_value" FROM ' . $driver->escapeName($config['prefix'] . 'options') .
    ' WHERE "option_name" = \'_site_transient_update_plugins\';');  
    if ($row = $driver->fetchRow($res)) {
        $plugins = unserialize($row[0]);
            foreach ( $plugins as $key => $value) {
                if ($key == 'checked'){
                    $plugins = array_keys($value);
                    continue;
                }
            }
    }
    //As a fallback lets check the old slugs transient
    else{  
        $res = $driver->query('SELECT "option_value" FROM ' . $driver->escapeName($config['prefix'] . 'options') .
        ' WHERE "option_name" = \'_transient_plugin_slugs\';');
        if ($row = $driver->fetchRow($res)) {
            $plugins = unserialize($row[0]);
        }    
        
    }
    
    if (!is_array($plugins)) {
            echo 'Plugins error: ' . escapeHtml($configFileName) . "\n\n";
            return array(array(), array());
    }
    
    // Themes
    $res = $driver->query('SELECT "option_value" FROM ' . $driver->escapeName($config['prefix'] . 'options') .
        ' WHERE "option_name" = \'_site_transient_theme_roots\';');
    
    $themes = array();
    if ($row = $driver->fetchRow($res)) {
        $themes = unserialize($row[0]);
        if (!is_array($themes)) {
            echo 'Themes error: ' . escapeHtml($configFileName) . "\n\n";
            return array(array(), array());
        }
    }
    
    $driver->disconnect();
    
    return array($plugins, $themes);
}

function sortWordPressPlugins($dir, $plugins)
{
    $outPlugins = array(array(), array(), array(), array());
    $dir .= '/wp-content/plugins/';
    
    foreach ($plugins as $plugin) {
        if (preg_match('@^([^/]+)/.+$@ ', $plugin, $m)) {
            $name = $m[1];
        } else {
            $name = basename($plugin, '.php'); // TODO ???
        }
        
        if (!preg_match('/^[0-9a-zA-Z._-]+$/', $name)) {
            $outPlugins[3][] = 'Invalid name: ' . $name;
            continue;
        }
        
        $fileName = realpath($dir . $plugin);
        if (substr($fileName, 0, strlen(realpath($dir))) !== realpath($dir) || !is_file($fileName)) {
            $outPlugins[3][] = 'Broken plugin: ' . $plugin . '=' . $fileName;
            continue;
        }

        $version = getWpPluginVersion($fileName);
        if (false === $version) {
            $outPlugins[3][] = 'Invalid version for ' . $name;
            continue;
        }
                
        if (!$data = @ file_get_contents('https://api.wordpress.org/plugins/info/1.0/' . $name)) {
            $outPlugins[3][] = 'Could not contact WordPress to check for update: ' . $name .
                ' version ' . $version;
            continue;
        }
        
        $data = (array) unserialize($data);
            
        if (!isset($data['version'])) {
            $outPlugins[2][] = 'Possible premium plugin ' . $name . ' version ' . $version;
            continue;
        }

        if (version_compare($data['version'], $version) > 0) {
            $outPlugins[0][] = $name . ' version ' . $version .
                ' - There is a new version available: ' . $data['version'];
        } else {
            $outPlugins[1][] = $name . ' version ' . $version .
                ' - You are up to date.';
        }
    }
    
    return $outPlugins;
}

function sortWordPressThemes($dir, $themes)
{
    $outThemes = array(array(), array(), array(), array());
    $dir .= '/wp-content';
    $themesDir = realpath($dir . '/themes/');
    
    foreach ($themes as $theme => $subdir) {
        if (!preg_match('/^[0-9a-zA-Z._-]+$/', $theme)) {
            $outThemes[3][] = 'Invalid name: ' . $theme;
            continue;
        }

        $fileName = realpath($dir . $subdir . '/' . $theme . '/style.css');
        if (substr($fileName, 0, strlen($themesDir)) !== $themesDir || !is_file($fileName)) {
            $outThemes[3][] = 'Broken theme: ' . $theme .
                ($theme !== '/themes' ? ', subdir: ' . $subdir : '');
            continue;
        }

        $version = getWpPluginVersion($fileName);
        if (false === $version) {
            $outThemes[3][] = 'Invalid version for ' . $theme;
            continue;
        }

        $url = 'https://api.wordpress.org/themes/info/1.1/?action=theme_information&request[slug]=';
        if (!$data = @ file_get_contents($url . $theme)) {
            $outThemes[3][] = 'Could not contact WordPress to check for update: ' . $theme .
                ' version ' . $version;
            continue;
        }
        
        $data = jsonDcode($data, true);
        
        if (!isset($data['version'])) {
            $outThemes[2][] = 'Possible premium theme ' . $theme . ' version ' . $version;
            continue;
        }
        
        if (version_compare($data['version'], $version) > 0) {
            $outThemes[0][] = $theme . ' version ' . $version .
                ' - There is a new version available: ' . $data['version'];
        } else {
            $outThemes[1][] = $theme . ' version ' . $version .
                ' - You are up to date.';
        }
    }
    
    return $outThemes;
}

function listWordPressPlugins($configFileName)
{
    list($plugins, $themes) = getWordPressPlugins($configFileName);
    $plugins = sortWordPressPlugins(dirname($configFileName), $plugins);
    
    echo "\n [Plugins]\n";
    
    $label = array('Outdated plugins', 'Updated plugins', 'Possible premium plugins', 'Errors');
    foreach ($plugins as $order => $arr) {
        if (count($arr) > 0) {
            echo ' ' . $label[$order] . ":\n";
        }

        foreach ($arr as $msg) {
            echo ' ' . escapeHtml($msg) . "\n";
        }

        if (count($arr) > 0) {
            echo "\n";
        }
    }
    
    echo "\n [Themes]\n";
    
    $themes = sortWordPressThemes(dirname($configFileName), $themes);
    
    $label = array('Outdated themes', 'Updated themes', 'Possible premium themes', 'Errors');
    foreach ($themes as $order => $arr) {
        if (count($arr) > 0) {
            echo ' ' . $label[$order] . ":\n";
        }

        foreach ($arr as $msg) {
            echo ' ' . escapeHtml($msg) . "\n";
        }
        
        if (count($arr) > 0) {
            echo "\n";
        }
    }
}



function listJoomlaPlugins($configFileName)
{
    $configContent = file_get_contents($configFileName);
    
    $config = array(
        'host' => getOption('$host', $configContent, OPT_TYPE_VAR),
        'user' => getOption('$user', $configContent, OPT_TYPE_VAR),
        'pass' => getOption('$password', $configContent, OPT_TYPE_VAR),
        'db' => getOption('$db', $configContent, OPT_TYPE_VAR),
        'prefix' => getOption('$dbprefix', $configContent, OPT_TYPE_VAR),
    );
    if (!$config['host'] || !$config['db'] || !$config['user']) {
        echo "WARN: No DB config\n\n";
        return;
    }
    
    $driver = function_exists('mysqli_connect') ? new MySQLIDriver() : new MySQLDriver();
    $errMsg = $driver->connect($config);
    if ($errMsg !== true) {
        echo escapeHtml($errMsg) . "\n";
        return;
    }
    
    if (!preg_match('/^[a-zA-Z0-9_-]*$/', $config['prefix'])) {
        echo 'Invalid prefix: ' . escapeHtml($config['prefix']) . "\n";
        return;
    }
    
    $res = $driver->query('SELECT "name", "type", "manifest_cache" FROM ' .
        $driver->escapeName($config['prefix'] . 'extensions') .
        ' ORDER BY "type", "name";');
    
    $group = null;
    while ($row = $driver->fetchRow($res)) {
        if ($group === null || $row[1] !== $group) {
            $group = $row[1];
            echo "\n";
        }
        
        $manifest_cache = jsonDcode($row[2], true);

        if (!isset($manifest_cache['version'])) {
            $manifest_cache['version'] = 'N/A';
        }

        printf(
            " Found Joomla %s - %s - version: %s\n",
            escapeHtml($row[1]),
            escapeHtml($row[0]),
            escapeHtml($manifest_cache['version'])
        );
    }
    
    $driver->disconnect();
}


// =====================
// checkHosting

function checkHosting()
{
    if (isset($_SERVER['SERVER_ADDR'])) {
         printf("Server Addr: %s\n\n", $_SERVER['SERVER_ADDR']);
    }

    // Detect Hosting provider
    echo "Hosting Provider: ";

    $provider = @ gethostbyaddr($_SERVER['SERVER_ADDR']);
    if (false !== $provider) {
        $providers = array(
            'secureserver.net' => 'GoDaddy',
            'bluehost.com'     => 'BlueHost',
            'hostgator.com'    => 'HostGator',
            'site5.com'        => 'Site5',
            'amazonaws.com'    => 'Amazon',
            'siteground.com'   => 'Siteground',
            'gridserver.com'   => 'MediaTemple',
            'linode.com'       => 'WPEngine',
            '1e100.net'        => 'Google',
            'dreamhost.com'    => 'DreamHost',
        );
    
        $match = "Unknown provider - $provider.";
        foreach ($providers as $host => $name) {
            if (false !== strpos($provider, $host)) {
                $match = $name;
                break;
            }
        }

        echo "$match\n\n";
    } else {
        echo "Unable to determine.\n\n";
    }

    // Check CloudProxy
    echo "CloudProxy Active: ";

    $addr = @ gethostbyname($_SERVER['HTTP_HOST']);
    $host = @ gethostbyaddr($addr);
    echo preg_match('@^cloudproxy[0-9]+\.sucuri\.net$@', $host) ? "Yes\n\n" : "No\n\n";
}

function checkMayBeHacked()
{
    $User_Agent = "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36";
    $Curl = curl_init();
    curl_setopt($Curl, CURLOPT_URL, "https://www.google.com/search?hl=en&tbo=d&site=&source=hp&q=site:".$_SERVER['HTTP_HOST']);
    curl_setopt($Curl, CURLOPT_USERAGENT, $User_Agent);
    curl_setopt($Curl, CURLOPT_RETURNTRANSFER, TRUE);
    if (!ini_get('safe_mode') && !ini_get('open_basedir')) curl_setopt($Curl, CURLOPT_FOLLOWLOCATION, TRUE);
    $Raw_Google_Output = curl_exec($Curl);
    curl_close($Curl);
    
    $Pattern = "/This site may harm your computer|This site (might|may) be hacked/";
    if (preg_match($Pattern, $Raw_Google_Output, $matches) === 1)
    {
       echo 'Google is flagging this site as \'may be hacked.\'',"\n\n";
       return 1;
    }

    $Pattern2 = "/302 Moved/";
    if (preg_match($Pattern2, $Raw_Google_Output, $matches) === 1)
    {
       echo 'Unable to check alerts on Google SERP.',"\n\n";
       return 2;
    }
    return 0;
}


echo "<pre>\n";
echo "Sucuri version report v1.1.3: " . $myversion . "\n\n";
echo "PHP Version: " . phpversion() . "\n\n";
echo "Server software Version: " . @$_SERVER['SERVER_SOFTWARE'] . "\n\n";

checkHosting();

if (!isTerminal())  checkMayBeHacked();

$path = '.';
if (isset($_GET['up'])) {
    $path = '..';
} elseif (isset($_GET['upup'])) {
    $path = '../..';
} elseif (isset($_GET['upupup'])) {
    $path = '../../..';
}

//Block to run checkPluginVersions()
if (!isset($_GET['robot'])) {
    if (!isset($_GET['skip-plugins'])) {
        if (isset($_GET['dir'])) {
            $dir = $_GET['dir'];
            if (substr($dir, -1) != '/') {
                $dir .= '/';
            }
        }
        else
        {
            $dir = './';
        }
        if (file_exists($dir . 'wp-config.php')) {
            checkPluginVersions($dir);
        }
    }
}

runVersionCheck($path, 'printFoundVersion');

echo "\nCompleted.\n";
echo "</pre>\n";
exit(0);
