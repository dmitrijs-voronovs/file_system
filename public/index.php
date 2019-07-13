<?php 
    include_once('../private/initialize.php');

    requires_login();

    $title = "Topics";
    include_once(SHARED_PATH . '/header.php');

    if(is_post_request()) {
        $bad_topic = $_POST["topics"];
        // sanitize values 
        $topic = Classes\Topic::sanitize_all($bad_topic);
        // check action (create or update)
        $topicObj = Classes\Topic::update_or_create($topic);
    };   
    // echo Classes\User::getLoggedUser()->id;
?>
    
<main>
    <h1>topics</h1>
    <?php echo Classes\Topic::get_form(); ?>

    <div class="topics">
    </div>

</main>

<?php include_once(SHARED_PATH . '/footer.php'); ?>