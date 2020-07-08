<?php
include 'koneksi.php';
include 'subproses.php';


if (isset($_POST['submit'])) {
	$user_input = getUserInput($_POST);

	$get_all_rule = getAllRule();

	$status_id = getStatusId($get_all_rule, $user_input);

	$result = checkRule($status_id);

	$status = $result['status'];
	$info = $result['info'];
	$penanganan = $result['penanganan'];

	include 'hasil.php';
}
var_dump($get_all_proses);
die;
