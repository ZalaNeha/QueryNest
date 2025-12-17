<div class="container">
  <h1 class="heading">Login</h1>

  <form action="./server/requests.php" method="post">

    <div class="col-12 col-md-6 offset-md-3 margin-bottom-15">
      <label for="email" class="form-label">User Email</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="Enter User Email">
    </div>

    <div class="col-12 col-md-6 offset-md-3 margin-bottom-15">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="password" placeholder="Enter User Password">
    </div>

    <div class="col-12 col-md-6 offset-md-3 margin-bottom-15">
      <button type="submit" name="login" class="btn btn-primary bls">Login</button>
    </div>

  </form>
  <div class="text-center mt-3">
    <p>
      Don’t have an account?
      <a href="?signup=true" class="fw-bold">Signup here</a>
    </p>
  </div>
</div>