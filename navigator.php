<html>
  <head>
<link rel="stylesheet" href="page.css" type="text/css">
<script>
  // Functions for the hover-over
  function hoverbar(id) {
    document.getElementById(id).classList.toggle("show");
  }

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
  }
</script>
<style>
  /* Dropdown Button */
.dropbtn {
    background-color: green;
    padding: 8px;
    border: none;
    cursor: pointer;
    color: #66ff99;
    font-family: "Lucida Grande";
    text-decoration: none;
    margin-bottom: 4px;
    font-size: 18px;
    font-weight: bold;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
    background-color: #3e8e41;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #eeeeee;
    min-width: 160px;
    margin: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    white-space: nowrap;
    overflow: hidden
}

/* Links inside the dropdown */
.dropdown-content a {
    padding: 6px 8px;
    text-decoration: none;
    display: inline-block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}
</style>
</head>
<body>
<div class="navbar">
    <h3 class="navbar" align="center">
      <a class="navbar" href="index.php" target="_top">Home</a> | 
      <a class="navbar" href="view.php" target="_top">View</a> | 
      <div class="dropdown"><button class="dropbtn" onClick="hoverbar('profile-drop-menu')">Profiles</button><div id="profile-drop-menu" class="dropdown-content"><a href="login.php" target="_top">Login</a> | <a href="usersearch.php" target="_top">Search for user</a></div></div> |
      <?php if (!isset($_COOKIE['userid'])) echo '<a class="navbar" href="login.php" target="_top">Login</a>'; else echo '<a class="navbar" href="login_handler.php?logout" target="_top">Logout</a>'; ?>
      <?php include_once "sql.inc"; if (isset($_COOKIE['tim'])) echo ' | <a href="control_panel.php" class="navbar" target="_top">Control Panel</a>'; ?>
      &nbsp;&nbsp;&nbsp;
      Search: <form action="view.php" method="GET" target="_top" class="navbar"><input type="search" name="search" placeholder="Search the Handbook..."><input type="submit" value="Search"></form></li>
    </h3>
    <h1 class="navbar"><?php echo $_GET['header']; ?></h1>
</div>
</body>
</html>
