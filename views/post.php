<main class="container">
  <section>
      <h1>
          <?php echo $post->getTitle() ?>
      </h1>
      <h4><?php echo $post->getPostDate() ?></h4>

      <p>
          <?php echo $post->getContent() ?>
      </p>

      <small>Some day comments will go here…</small>
  </section>

  <a href="/">Back to all posts</a>

</main>