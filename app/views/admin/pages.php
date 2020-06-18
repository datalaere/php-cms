<?php include(Config::get('app.views') . 'templates/header.php'); ?>
<h2>Admin: Pages</h2>
<p><a href="<?php e(Config::get('app.url')) ?>/admin/create/page">Add new page</a></p>

<?php if(empty($data['pages'])): ?>
    <p>No pages</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Label</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Show</th>
                <th>Update</th>
                <th>Destroy</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['pages'] as $page): ?>
                <tr>
                    <td><?php e($page->label); ?></td>
                    <td><?php e($page->title); ?></td>
                    <td><?php e($page->slug); ?></td>
                    <td><a href="<?php e(Config::get('app.url')) ?>/pages/show/<?php e($page->slug); ?>">View</a></td>
                    <td><a href="">Edit</a></td>
                    <td><a href="">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php include(Config::get('app.views') . 'templates/footer.php'); ?>
