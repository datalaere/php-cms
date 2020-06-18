<?php include(Config::get('app.views') . 'templates/header.php'); ?>
<h2>Pages</h2>
<?php if(empty($data['pages'])): ?>
    <p>No pages</p>
<?php else: ?>
    <ul>
    <?php foreach($data['pages'] as $page): ?>
        <li><a href="<?php e(Config::get('app.url')) ?>/pages/show/<?php e($page->slug); ?>"><?php e($page->label); ?></a></li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php include(Config::get('app.views') . 'templates/footer.php'); ?>
