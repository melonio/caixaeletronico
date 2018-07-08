<?php
session_start();
unset($_SESSION['nome']);
unset($_SESSION['online']);

header("Location: index.php");