<?php

include_once('resources/init.php');

if (!isset($_GET['id'])) {
	header('Location: index.php');
	die();
}

$num_results = $_GET['num_results'];
$page = $_GET['page'];

//go back a page if last on current page
$page = ($num_results % 6 == 1) ? $page - 1 : $page;

delete_name($_GET['id']);

header("Location: index.php?page={$page}");
die();
