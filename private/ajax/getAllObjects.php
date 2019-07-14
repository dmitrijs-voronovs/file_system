<?php
include_once('../initialize.php');

// as JS loads all of the topics starting from the base level e.g.
// level 0, Topics should be sorted starting from the lowest level.
// Also the ones, that were created the most recently should apper
// at the top.
echo json_encode(Classes\Topic::find_all(
    'ORDER BY level ASC, created_at DESC'
));