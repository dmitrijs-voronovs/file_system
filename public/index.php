<?php 
    include_once('../private/initialize.php');
    $title = "main page";
    
    include_once(SHARED_PATH . '/header.php');

    if(is_post_request()) {
        $topic = $_POST["topics"];
        var_dump($topic);
        // sanitize values 
        $topicObj = new Classes\Topic($topic);
        $topicObj->save();
        var_dump($topicObj);
    };
?>

<header>
    <h1>topics</h1>
</header>

<main>
    <?php echo Classes\Topic::get_form(); ?>

    id + prev_id + level + title
    <div class="topics">
    </div>

</main>

<footer>
    <h3 class="author">Made by Dmitrijs Voronovs</h3>
</footer>

<?php include_once(SHARED_PATH . '/footer.php'); ?>