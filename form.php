<?php
require_once("../../../wp-load.php");

use Forms\InsertDataIntoCsv;

header('Content-type: application/json');

if ($_POST['customForm']) {
	$date = new DateTime('NOW');
	$agreement = $_POST['customForm']['agreement'] ? 'Tak' : 'Nie';
	$descriptionString = '<p>Formularz przesłał: ' . $_POST['customForm']['email'] . '</p>';
	$descriptionString .= '<p>Imię i nazwisko: ' . $_POST['customForm']['firstName'] . ' ' . $_POST['customForm']['lastName'] . '</p>';
	$descriptionString .= '<p>Login: ' . $_POST['customForm']['login'] . '</p>';
	$descriptionString .= '<p>Miasto: ' . $_POST['customForm']['city'] . '</p>';
	$descriptionString .= '<p>Zaakceptowano warunki: ' . $agreement . '</p>';

	$postTitle = 'Formularz od ' . $_POST['customForm']['firstName'] . ' ' . $_POST['customForm']['lastName'];

	$postData = [
		'post_title' => $postTitle,
		'post_content' => $descriptionString,
		'post_status' => 'publish',
		'post_type' => 'forms',
		'post_author' => 1,
	];

	$csvData = [
		$_POST['customForm']['firstName'],
		$_POST['customForm']['lastName'],
		$_POST['customForm']['login'],
		$_POST['customForm']['email'],
		$_POST['customForm']['city'],
		$agreement,
		$date->format('Y-m-d H:i:s'),
	];
	$addToCsv = new InsertDataIntoCsv(get_template_directory(), $csvData);

	$post_id = wp_insert_post($postData, true);

	if (0 === $post_id || $post_id instanceof WP_Error) {
		echo json_encode('Napotkano błąd podczas tworzenia formularza.');
	}

	foreach ($_POST['customForm'] as $key=>$value) {
		add_post_meta($post_id, $key, $value);
	}

	echo json_encode('Formularz zapisany.');
}