<?php

$isLoggedIn = isset($_SESSION['user']) && isset($_SESSION['user']['username']);
?>
<nav class="navbar navbar-expand-md navbar-light bg-light">
  <div class="container">

    <a class="navbar-brand" href="./">
      <!-- QueryNest -->
      <img src="./public/logo.png" class="logo">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link active" href="./">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="?latest=true">Latest Questions</a>
        </li>

        <?php if ($isLoggedIn): ?>

          <li class="nav-item">
            <a class="nav-link" href="?ask=true">Ask A Question</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="?u-id=<?php echo $_SESSION['user']['user_id'] ?>">My Questions</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-danger fw-bold" href="./server/requests.php?logout=true"
              onclick="return confirm('Are you sure you want to logout?')">
              Logout
            </a>
          </li>

          <li class="nav-item">
            <span class="nav-link fw-bold text-success">
              Hi, <?php echo ucfirst($_SESSION['user']['username']); ?>
            </span>
          </li>

        <?php endif; ?>

        <?php if (!$isLoggedIn): ?>
          <li class="nav-item">
            <a class="nav-link" href="?login=true">Login</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="?signup=true">Signup</a>
          </li>
        <?php endif; ?>

      </ul>

    </div>

    <form class="d-flex" action="">
      <input class="form-control me-2" name="search" type="search" placeholder="Search Questions" />
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    
    <button id="darkToggle" type="button" class="btn btn-sm btn-outline-secondary ms-3">
      🌙
    </button>

  </div>
</nav>