<html>
  <head>
    <link rel="stylesheet" href="navigation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  </head>
  <body>
    <!-- topbar start -->
    <div class="topbar">
      <h1>LALA CRAFT</h1>
      <a href="/handicraft/Guest/index.php"><button>Logout</button></a>
    </div>
    <div class="nav-buttons">
      <button class="left" title="Home" onclick="home()"><i class="fa-solid fa-house"></i></button>
      <button class="middle" title="My Orders" onclick="orders()"><i class="fa-solid fa-clock-rotate-left"></i></button>
      <button class="middle" title="Cart" onclick="cart()"><i class="fa-solid fa-cart-shopping"></i></button>
      <button class="middle" title="Complaints" onclick="complaints()"><i class="fa-solid fa-box-archive"></i></button>
      <button class="right" title="My Profile" onclick="profile()"><i class="fa-solid fa-user"></i></button>
    </div>
  </body>
</html>

<script>
  function home(){
    window.location='index.php';
  }
  function orders(){
    window.location='my_orders.php';
  }
  function cart(){
    window.location='cart.php';
  }
  function complaints(){
    window.location='complaint_view.php';
  }
  function profile(){
    window.location='my_profile.php';
  }
</script>