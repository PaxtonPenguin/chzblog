<?php
    if (is_dir("uploads/")) {
        exit("already ran script");
    }
    $f = fopen("add.php", "r+");

    $oldstr = file_get_contents("add.php");
    $str_to_insert = "date_default_timezone_set('" . $_POST["tz"] . "');";
    $specificLine = "timezone-hyhyh";

    while (($buffer = fgets($f)) !== false) {
        if (strpos($buffer, $specificLine) !== false) {
            $pos = ftell($f); 
            $newstr = substr_replace($oldstr, $str_to_insert, $pos, 0);
            file_put_contents("add.php", $newstr);
            break;
        }
    }
    fclose($f);

    $f2 = fopen("add.php", "r+");

    $oldstr2 = file_get_contents("add.php");
    $str_to_insert2 = "admin => " . $_POST["password"];
    $specificLine2 = "password-peepy";

    while (($buffer2 = fgets($f2)) !== false) {
        if (strpos($buffer2, $specificLine2) !== false) {
            $pos2 = ftell($f2); 
            $newstr2 = substr_replace($oldstr2, $str_to_insert2, $pos2, 0);
            file_put_contents("add.php", $newstr2);
            break;
        }
    }
    fclose($f2);

    if ($_POST["box"] == "on") {
        $rss = fopen("rss.xml", "w");
        $title = $_POST["name"];
        $desc = $_POST["desc"];
        $link = $_POST["location"];
        $date = date("r");
        $itself = $_POST["location"] . "rss.xml";
        file_put_contents("rss.xml", "<rss version='2.0'\n\t<channel>\n\t\t<title>" . $title . "</title>\n\t\t<description>" . $desc . "</description>\n\t\t<link>" . $link . "</link>\n\t\t<lastBuildDate>" . $date . "</lastBuildDate>\n\t\t<atom:link href='" . $itself . "' rel='self' type='application/rss+xml'");
        fclose($rss);
    }

    $f3 = fopen("index.html", "r+");

    $oldstr3 = file_get_contents("index.html");
    $str_to_insert3 = "<h1>" . $_POST["name"] . " <a href='add.html'><button style='float: right; margin-top: 10px;'>add to blog</button></a></h1>";
    $specificLine3 = "blog-name";

    while (($buffer3 = fgets($f3)) !== false) {
        if (strpos($buffer3, $specificLine3) !== false) {
            $pos3 = ftell($f3); 
            $newstr3 = substr_replace($oldstr3, $str_to_insert3, $pos3, 0);
            file_put_contents("index.html", $newstr3);
            break;
        }
    }
    fclose($f2);

    mkdir("uploads/");
    header("Location: index.html");
?>