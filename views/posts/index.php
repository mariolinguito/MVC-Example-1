<p>This is a list of the posts: </p>

<ul>
    <?php foreach($posts as $post){ ?>
        <li>
            <?php echo $post->id . ' - ' . $post->author; ?> -
            <a href="?controller=posts&action=show&id=<?php echo $post->id; ?>">See content</a> /
            <a href="?controller=posts&action=delete&id=<?php echo $post->id; ?>">Delete post</a>
        </li>
    <?php } ?>
</ul>

<p>Add your post:</p>

<form action="?controller=posts&action=add" method="POST">
    <input type="text" name="author" placeholder="Author">
    <input type="text" name="content" placeholder="Content">
    <input type="submit" value="Submit now">
</form>

<p>Update a post:</p>

<form action="?controller=posts&action=update" method="POST">
    <input type="number" maxlength="3" name="id" placeholder="ID">
    <input type="text" name="author" placeholder="New author">
    <input type="text" name="content" placeholder="New content">
    <input type="submit" value="Update now">
</form>
