<p>This is the requested post:</p>

<ul>
    <?php foreach($posts as $post){ ?>
        <li><?php echo 'ID: ' . $post->id; ?></li>
        <li><?php echo 'Author: ' . $post->author; ?></li>
        <li><?php echo 'Content: ' . $post->content; ?></li>
    <?php } ?>
</ul>


