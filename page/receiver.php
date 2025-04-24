<?php
header("Content-Type: text/html; charset=UTF-8");

// 1. Get values safely
$who = isset($_POST['s1']) ? trim($_POST['s1']) : null;
$what = isset($_POST['s2']) ? trim($_POST['s2']) : null;
$towhom = isset($_POST['s3']) ? trim($_POST['s3']) : null;

if (!$who) {
    echo "Error: 's1' is required.";
    exit;
}

// 2. Prepare file
$filename1 = $who . ".txt";
$filename2 = $towhom . ".txt";

// 3. If what and towhom are provided, include them
if ($what && $towhom) {
    $line1 = "<p class='msgto'><span class='date'>" . date("Y.m.d H:i:s") . "</span><span class='name'> " . $who . " said:</span><br/><span class='content'>" . $what . "</span></p>";
    $line2 = "<p class='msgfrom'><span class='date'>" . date("Y.m.d H:i:s") . "</span><span class='name'> " . $who . " said:</span><br/><span class='content'>" . $what . "</span></p>";
    
    // 3a. Append to files (creates if doesn't exist)
    $fp = fopen($filename1, "a");
    fwrite($fp, $line1);
    fclose($fp);
    $fp = fopen($filename2, "a");
    fwrite($fp, $line2);
    fclose($fp);    
}

// 5. Reopen to read entire content
$fp = fopen($filename1, "r");
$contents = filesize($filename1) > 0 ? fread($fp, filesize($filename1)) : '';
fclose($fp);

// 6. Output result
echo $contents;
?>