<div class="container">
  <?php echo $message ?? ''; ?>
  <form class="form-signin" method="POST" action="/login">
    <div class="form-label-group">
      <label for="email">Email</label>
      <input name="email" type="text" id="email" class="form-control" placeholder="email" required autofocus>
    </div>

    <div class="form-group form-label-group">
      <label for="password">Password</label>
      <input name="password" type="password" id="password" class="form-control" placeholder="Password" required>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  </form>
</div>