<div class="container">

    <form id="postForm" action="/admin/post/<?php echo $post->getId() ?>/update" method="POST">

        <div class="form-group">
            <label for="title">Post title</label>
            <input id="title" name="title" value="<?php echo $post->getTitle() ?>" type="text" class="form-control" />
        </div>

        <div class="form-group">
            <select name="category_id" class="form-control">
                <?php foreach ($categories as $category): ?>
                    <?php if ((int) $category->getId() !== $post->getCategoryId()): ?>
                        <option value="<?php echo $category->getId() ?>">
                            <?php echo $category->getName() ?>
                        </option>
                    <?php else: ?>
                        <option value="<?php echo $category->getId() ?>" selected="selected">
                            <?php echo $category->getName(); ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <select name="tags[]" multiple="multiple" class="form-control">
                <?php $postTags = $post->getTagIds(); ?>
                <option value="NULL">
                    <?php echo 'No tags' ?>
                </option>
                <?php foreach ($tags as $tag): ?>
                    <?php if (array_search($tag->getId(), $postTags) === false): ?>
                        <option value="<?php echo $tag->getId() ?>">
                            <?php echo $tag->getName() ?>
                        </option>
                    <?php else: ?>
                        <option value="<?php echo $tag->getId() ?>" selected="selected">
                            <?php echo $tag->getName(); ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <textarea class="form-control" name="content" rows="10" cols="50"><?php echo $post->getContent() ?></textarea>
        </div>

        <a class="btn btn-secondary" href="/admin/dashboard" title="Avbryt">Cancel</a>
        <button class="btn btn-primary" type="submit">Update post</button>
    <form>
</div>
