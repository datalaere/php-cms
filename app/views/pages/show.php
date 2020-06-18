<?php include(Config::get('app.views') . 'templates/header.php'); ?>

<h2><?php e($data['page']->title); ?></h2>
<span class="faded">Created on: <?php e($data['created']->format('d. M Y')); ?></span>
<?php if($data['page']->updated): ?><br>
    <span class="faded">Last updated on: <?php e($data['updated']->format('d. M Y h:i')); ?></span>
<?php endif; ?>
<p><?php e($data['page']->body); ?></p>

<?php include(Config::get('app.views') . 'templates/footer.php'); ?>