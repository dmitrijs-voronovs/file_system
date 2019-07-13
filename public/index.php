<?php 
    include_once('../private/initialize.php');
    $title = "main page";
    
    include_once(SHARED_PATH . '/header.php');

    if(is_post_request()) {
        $bad_topic = $_POST["topics"];
        // sanitize values 
        $topic = Classes\Topic::sanitize_all($bad_topic);
        // check action (create or update)
        $topicObj = Classes\Topic::update_or_create($topic);
    };
?>

<header>
    <h1>topics</h1>
</header>

<main>
    <?php echo Classes\Topic::get_form(); ?>

    <div class="topics">
    </div>

</main>

<footer>
    <h3 class="author">Made by Dmitrijs Voronovs</h3>
</footer>

<?php include_once(SHARED_PATH . '/footer.php'); ?>