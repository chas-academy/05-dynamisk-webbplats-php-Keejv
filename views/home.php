<main class="container">

  <section>
    <?php foreach($posts as $post): ?>
      <h1>
          <a href="<?php echo '/post/' . $post->getId() ?>">
              <?php echo $post->getTitle() ?>
          </a>
      </h1>
      <h4><?php echo $post->getPostDate() ?></h4>

      <p>
          <?php echo $post->getContent() ?>
      </p>
    <?php endforeach;?>
  </section>

</main>