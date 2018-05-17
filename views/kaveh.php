<main>

  <section>
    <?php foreach($users as $user): ?>
      <p><?php echo $user->getUsername(); ?></p>
      <p><?php echo $user->getId(); ?></p>
      <p><?php echo $user->getEmail(); ?></p>
    <?php endforeach;?>
  </section>

</main>