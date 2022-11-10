<main class="d-flex align-items-center justify-content-center height-100">
  <div class="content">
    <header class="text-center">
      <img src="Views/img/pethero.jpg" width="300" height="150" alt="imagen del logo pet hero" />
    </header>
    <form action="Login/login" method="post" class="login-form bg-dark-alpha p-5 bg-light">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Input your email">
      </div>
      <button class="btn btn-dark btn-block btn-lg" type="submit">Sign In</button>
      <a href="<?php echo FRONT_ROOT ?>User/RegisterView">Register</a>
    </form>
  </div>
</main>