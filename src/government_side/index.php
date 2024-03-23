

<?php include 'layouts/_index_layout.php'; ?>
<body>
  <div class="wrapper">
    <div class="illustration">
      <img src="https://img.freepik.com/free-vector/mobile-login-concept-illustration_114360-83.jpg" alt="Login Illustration">
    </div>
    <div class="form-container">
      <h2>Login</h2>
      <div class="text">
        <br>
        <h4>Welcome back! Login to your account.</h4>
      </div>
      <form id="loginForm" action="http://localhost/pawican/public/government/login" method="post">
        <div class="input-box">
          <label for="email">Email</label>
          <input type="text" id="email" placeholder="Enter your email" required>
        </div>
        <div class="input-box">
          <label for="password">Password</label>
          <input type="password" id="password" placeholder="Enter your password" required>
        </div>
        <div class="input-box button">
          <input type="submit" value="Login">
        </div>
        <div class="text">
          <h3>Read more about our <a href="privacy.html">Privacy & Policy</a></h3>
          <h3><a href="index.html">Back to home</a></h3>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
