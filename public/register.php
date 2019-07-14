<?php
include_once('../private/initialize.php');

$title = 'Register';
include_once(SHARED_PATH . '/header.php');

if(is_post_request()) {
    $bad_topic = $_POST["users"];
    // sanitize values 
    $topic = Classes\User::sanitize_all($bad_topic);
    
    // initialize class
    $topicObj = new Classes\User($topic);
    // save to db or display errors
    if ($topicObj->save()) redirect_to('login.php');
};
if (!isset($topicObj)) $topicObj = new Classes\User();
?>
<main id="register">
    <h1>register</h1>
    <?php 
        echo $topicObj->display_errors();
        // After unsuccessful registration, typed username will be saved 
        echo Classes\User::get_form(["username"=>$topic["username"] ?? ""], false, "register.php"); 
    ?>
</main>

<?php include_once(SHARED_PATH . '/footer.php'); ?>