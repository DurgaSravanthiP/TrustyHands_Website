<?php
session_start();
session_unset();
session_destroy();
header("Location: research_homepage1.php");
exit();
?>