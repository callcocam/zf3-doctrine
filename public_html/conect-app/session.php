<?php
session_start();
if (!isset($_SESSION['user'])) {
	$_SESSION['user'] = [];
}
if (!isset($_POST)) {
	$_SESSION['user'] = [];
}
$_SESSION['user'] = $_POST;