<?php
include_once('../initialize.php');

echo json_encode(Classes\Topic::find_all(
    'ORDER BY level ASC, created_at DESC'
));