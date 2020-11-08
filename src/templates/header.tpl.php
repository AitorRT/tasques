<!DOCTYPE html>
<html lang="en">
<head>
  <title>App</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/css/style.css"  type="text/css">
</head>
<body>
<header>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="?url=home">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="?url=home">Home</a></li>
<!--       <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul> -->
      </li>
      <?php
            if(isset($_SESSION['uname'])){
                echo '<li><a href="?url=dashboard">Dashboard</a></li>';
            }
    ?>
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <?php
      if(isset($_SESSION['uname']) || isset($_SESSION['remember'])){
        echo '<li><a href="?url=logout"><span class="glyphicon glyphicon-user"></span> Logout</a></li>';
      }
      else{
        echo '<li><a href="?url=register"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
              <li><a href="?url=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
      }
    ?>
    </ul>
  </div>
</nav>
</header>
