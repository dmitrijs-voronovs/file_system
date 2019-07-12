<?php
include_once('../initialize.php');

if(is_post_request()){
    echo json_encode(Classes\Topic::find_all());
}