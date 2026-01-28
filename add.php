<?php
date_default_timezone_set('UTC');
$shapasswd = "please fill in sha256 hashed password :]";
$blog_temp = "<!DOCTYPE html>\n<html>\n<head>\n<title>" . $_POST["title"] . "</title>\n</head>\n<body>\n<a href='../../../index.html'>back</a>\n<hr>\n<h2>" . $_POST["title"] . "</h2>\n" . str_replace("\n", "<br>", $_POST["text"]) . "\n<br>\n<i>posted on " . date("m/d/Y h:i A") . " UTC</i>\n<hr>\n</body>\n</html>";
$stupid = date("Y") . "/" . date("m") . "/" . date("d");

//if (hash("sha256", $_POST["password"]) == $shapasswd) {

//make the year's directory and add it to main page
if (!is_dir(date("Y"))) {
    mkdir(date("Y"));
    $f = fopen("index.html", "r+");

    $oldstr = file_get_contents("index.html");
    $str_to_insert = "<details>\n<summary>" . date("Y") . "</summary>\n<!--posts" . date("Y") . "-->\n</details>\n";
    $specificLine = "ys";

    while (($buffer = fgets($f)) !== false) {
        if (strpos($buffer, $specificLine) !== false) {
            $pos = ftell($f); 
            $newstr = substr_replace($oldstr, $str_to_insert, $pos, 0);
            file_put_contents("index.html", $newstr);
            break;
        }
    }
    fclose($f);
}
//same thing but don't add to main page and also month
if (!is_dir(date("Y") . "/" . date("m"))) {
    mkdir(date("Y") . "/" . date("m"));
}

//blah blah
if (!is_dir(date("Y") . "/" . date("m") . "/" . date("d"))) {
    mkdir(date("Y") . "/" . date("m") . "/" . date("d"));
}

//open the file
$file = fopen("" . $stupid . "/index.html", "w+");
echo "opened the file";

//actually add the blog post
file_put_contents("" . $stupid . "/index.html", $blog_temp);
fclose($file);

//add the thing to the main page's years collumn
$sf = fopen("index.html", "r+");

$oldstr2 = file_get_contents("index.html");
$str_to_insert2 = "<a href='" . $stupid . "/index.html" . "'>" . $_POST["title"] . "</a>\n<br>\n";
$specificLine2 = "posts" . date("Y");

while (($buffer2 = fgets($sf)) !== false) {
    if (strpos($buffer2, $specificLine2) !== false) {
        $pos2 = ftell($sf); 
        $newstr2 = substr_replace($oldstr2, $str_to_insert2, $pos2, 0);
        file_put_contents("index.html", $newstr2);
        break;
    }
}
fclose($sf);

//do the same thing again
$ssf = fopen("index.html", "r+");
$oldstr23 = file_get_contents("index.html");
$str_to_insert23 = "<a href='" . $stupid . "/index.html" . "'><h2>" . $_POST["title"] . "</h2><a>\n<br>\n<i><p>posted on" . date("m/d/Y") . "</p></i>\n<br>\n";
$specificLine23 = "titles";

while (($buffer23 = fgets($ssf)) !== false) {
    if (strpos($buffer23, $specificLine23) !== false) {
        $pos23 = ftell($ssf); 
        $newstr23 = substr_replace($oldstr23, $str_to_insert23, $pos23, 0);
        file_put_contents("index.html", $newstr23);
        break;
    }
}
fclose($ssf);

//redirect
header("Location: " . $stupid . "/index.html");
//} else {
//   echo "wrong password";
//}
?>