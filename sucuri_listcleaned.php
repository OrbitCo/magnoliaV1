<?php

@set_time_limit(0);
@ini_set("max_execution_time",0);
@set_time_limit(0);
@ignore_user_abort(TRUE);
if (extension_loaded('xdebug'))
{
    echo 'Xdebug detected - exitting...';
    die();
}

/* If running via terminal. */
if(!isset($_SERVER['REMOTE_ADDR']) && isset($_SERVER['SHELL']))
{
    parse_str(implode('&', array_slice($argv, 1)), $_GET);
}

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



define('SUCURI_KEY', 'kduhgop32lkj');

$toorder = array();

function encrypt($content, $key, $shift)
{
    $result = '';

    $contentLength = strlen($content);
    $keyLength = strlen($key);

    // XOR the first 'shift' bytes
    $shift %= $keyLength;
    $processedLength = min($keyLength - $shift, $contentLength);
    // substr() returns false for an empty $content string, so we do an additional check
    $result = '';
    if ($processedLength > 0) {
        $result = substr($content, 0, $processedLength) ^ substr($key, $shift, $processedLength);
    }

    $restLength = ($contentLength - $processedLength) % $keyLength;
    $mainPartEnd = $contentLength - $restLength;

    for ($i = $processedLength; $i < $mainPartEnd; $i += $keyLength) {
        $result .= $key ^ substr($content, $i, $keyLength);
    }

    if ($restLength > 0) {
        $result .= substr($content, $mainPartEnd) ^ substr($key, 0, $restLength);
    }

    return $result;
}

function scanallfiles($dir)
{
    global $toorder;
    $dh = opendir($dir);
    if(!$dh)
    {
        return(0);
    }

    if($dir == "./")
    {
        $dir = ".";
    }

    while (($myfile = readdir($dh)) !== false)
    {
        if($myfile == "." || $myfile == "..")
        {
            continue;
        }

        if(strpos($myfile, "sucuribackup.") !== FALSE && substr($myfile, -15, 15) !== "wordpressupdate")
        {
            $mydate = explode("_sucuribackup.", $myfile);
            $newpos = strpos($myfile, "_sucuribackup");
            $newfile = substr($myfile, 0, $newpos);

            $path = str_replace("/.sucuriquarantine", "", "$dir/$newfile");
            if (isset($_GET['order']))
            {
                array_push($toorder, array($mydate[1], "File fixed (malware removed): $path [" . @date('Y-m-d H:i:s', substr($mydate[1], 0, 10)) . "]\n"));
            }
            else if (isset($_GET['date']))
            {
                echo "File fixed (malware removed): $path [" . @date('Y-m-d H:i:s', substr($mydate[1], 0, 10)) . "]\n";
            }
            else
            {
                echo "File fixed (malware removed): $path\n";
            }
            continue;
        }

        if(strpos($myfile, "sucuridbbackup.") !== FALSE && !isset($_GET['no-db']))
        {
            $pattern = "/WHERE \"ID\" = '\S*' AND \"\S*\"/";
            $queries = preg_grep($pattern, file("$dir/$myfile"));
            $contents = file_get_contents("$dir/$myfile");
            $contents = encrypt($contents, SUCURI_KEY, 0);

            $mydate = explode("_sucuridbbackup.", $myfile);

            preg_match('/search-(\S*)_sucuridbbackup./', $myfile, $match) ||
            preg_match('/manual-(\S*)_sucuridbbackup./', $myfile, $match) ||
            preg_match('/cleanup-(\S*)_sucuridbbackup./', $myfile, $match);

            $table = 'not found';
            if (is_array($match) && isset($match[1])) {
                $table = $match[1];
            }

            preg_match_all("/ SET \"(\S*)\"/", $contents, $field);
            preg_match_all("/ WHERE \"(\S*)\" = /", $contents, $id);
            preg_match_all("/ = '(\S*)' AND /", $contents, $value);

            for($i=0; $i<sizeof($field[1]); $i++){
                if (isset($_GET['order']))
                {
                    array_push($toorder, array($mydate[1], "Database entry fixed (malware removed): " . $table . "." . $field[1][$i] . ", " . $id[1][$i] . "=" . $value[1][$i] . " [" . @date('Y-m-d H:i:s', substr($mydate[1], 0, 10)) . "]\n"));
                }
                else if (isset($_GET['date']))
                {
                    echo "Database entry fixed (malware removed): " . $table . "." . $field[1][$i] . ", " . $id[1][$i] . "=" . $value[1][$i] . " [" . @date('Y-m-d H:i:s', substr($mydate[1], 0, 10)) . "]\n";
                }
                else
                {
                    echo "Database entry fixed (malware removed): " . $table . "." . $field[1][$i] . ", " . $id[1][$i] . "=" . $value[1][$i] . "\n";
                }
            }

            continue;
        }

        if(is_dir($dir."/".$myfile))
        {
            scanallfiles($dir."/".$myfile);
        }

    }
    closedir($dh);
}

echo "<pre>\n";

/* Scanning all files. */
$dir = "./.sucuriquarantine";
if(isset($_GET['up']))
{
    $dir = "../";
}
if(isset($_GET['upup']))
{
    $dir = "../../";
}
if(isset($_GET['upupup']))
{
    $dir = "../../../";
}
if(isset($_GET['not-fast']))
{
    $dir = "./";
}
scanallfiles($dir);

if(isset($_GET['order']))
{
    rsort($toorder);
    foreach ($toorder as $key => $value)
    {
        $line = str_replace("/.sucuriquarantine", "", $value[1]);
        echo $line;
    }
}

echo "</pre>\n"
?>
