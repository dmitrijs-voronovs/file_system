<?php
include_once('../initialize.php');

$bad_topic = $_POST['topics'];
$topic = Classes\Topic::sanitize_all($bad_topic);
echo Classes\Topic::get_form($topic, $_POST["include_pk"] ?? false);