<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>login</title>
    <meta charset="UTF-8" />
    <title>login</title>
    <link
      href="https://fonts.googleapis.com/css?family=Roboto"
      rel="stylesheet"
      type="text/css"
    />
    <link rel="stylesheet" href="../../css/Login.css" />
  </head>
  <body>
   
    <section class="forms-section">
      <h1 class="section-title" style="color: #5ce1e6">Liability Manager</h1>
      <img src="../../images/lm.png" alt="" width="200px" height="200px" />
      <div class="forms">
        <div class="form-wrapper is-active">
          <button type="button" class="switcher switcher-login">
            Login
            <span class="underline"></span>
          </button>
          <form class="form form-login" id="login" method="POST" action="/login.php">
            <fieldset>
              <legend>Please, enter your email and password for login.</legend>
              <div class="input-block">
                <label for="login-email">E-mail</label>
                <input form="login" id="login-email" type="email" name="email" required />
              </div>
              <div class="input-block">
                <label for="login-password">Password</label>
                <input form="login" id="login-password" type="password" name="password" required />
              </div>
              
            </fieldset>
            <button type="submit" form="login" class="btn-login">Login</button>
            <button><a href="adminlogin.php">Admin</a></button>
          </form>
        </div>
        <div class="form-wrapper">
          <button type="button" class="switcher switcher-signup">
            Sign Up
            <span class="underline"></span>
          </button>
          <form class="form form-signup">
            <fieldset>
              <legend>
                Please, enter your email, password and password confirmation for
                sign up.
              </legend>
              <div class="input-block">
                <label for="signup-email">E-mail</label>
                <input id="signup-email" type="email" required />
              </div>
              <div class="input-block">
                <label for="signup-password">Password</label>
                <input id="signup-password" type="password" required />
              </div>
              <div class="input-block">
                <label for="signup-password-confirm">Confirm password</label>
                <input id="signup-password-confirm" type="password" required />
              </div>
            </fieldset>
            <button type="submit" class="btn-signup">Continue</button>
          </form>
        </div>
      </div>
    </section>
    <!-- partial -->
    <script src="../../js/Login.js"></script>
  </body>
</html>
