<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="sidebar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

  <input type="checkbox" id="check">
  <!--header area start-->
  <header>
    <label for="check">
      <i class="fas fa-bars" id="sidebar_btn"></i>
    </label>
    <div class="left_area">
      <h3>LALA <span>CRAFT</span></h3>
    </div>
    <div class="right_area">
      <a href="/handicraft/Guest/index.php" class="logout_btn">Logout</a>
    </div>
  </header>
  <!--header area end-->
  <!--sidebar start-->
  <div class="sidebar">
    <a href="index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
    <a href="products_view.php"><i class="fa-solid fa-cash-register"></i><span>Manage Product</span></a>
    <a href="wallet.php"><i class="fa-solid fa-wallet"></i></i><span>Wallet</span></a>
    <button class="dropdown-btn">
      <i class="fa-solid fa-file-import"></i><span>Reports</span>
    </button>
    <div class="dropdown-container">
      <a href="report_category_wise.php"><i class="fa-solid fa-location-dot"></i><span>Category Wise</span></a>
      <a href="report_item_wise.php"><i class="fa-solid fa-building"></i><span>Item Wise</span></a>
      <a href="report_between_dates.php"><i class="fa-brands fa-hubspot"></i><span>Between Dates</span></a>
    </div>
    <a href="shop_profile.php"><i class="fa-solid fa-user"></i><span>Shop Profile</span></a>
    <a href="complaint_view.php"><i class="fa-solid fa-box-archive"></i><span>Complaints</span></a>
  </div>
  <!--sidebar end-->

</body>

<script>
  /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
  var dropdown = document.getElementsByClassName("dropdown-btn");
  var i;

  for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
      var dropdownContent = this.nextElementSibling;
      if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
      } else {
        dropdownContent.style.display = "block";
      }
    });
  }
</script>

</html>