<?php
include_once('../initialize.php');

$topicIDs = $_POST['ids'];
Classes\Topic::deleteMany($topicIDs);