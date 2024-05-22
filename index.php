<?php
$uri = explode('/', $_SERVER['REQUEST_URI']);
$view = "views/";

// show the things
require_once("views/head.php");

if ($uri[1] == "contact") {
  require_once("views/contact.php");
} else if ($uri[1] == "about") {
  require_once("views/studio.php");
} else if ($uri[1] == "projects" || $uri[1] == "research" || $uri[1] == "work") {
  require_once("views/work.php");
} else {
  require_once("views/home.php");
}

require_once("views/foot.php");
?>
