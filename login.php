<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <section id="section1">
          <header>
            <div id="logo">
              <img src="img/logo.png" alt="Logo">
            </div>
            <div id="text-logo">
              <h1>Seray</h1>
            </div>
    
            <nav>
              <ul>
                <li><a href="homePage.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="aboutUs.php">About Us</a></li>
                <li><a href="register.php"><button>Join Us</button></a></li>
              </ul>
            </nav>
          </header>
       
      </section>
      <section id="section2">
        <div class="container2">
            <div id="loginform">
                <div class="mainheading">
                    <p>Welcome Back !</p>
                    <p id="teksti">We are so glad to see you again,<br> Log in to pick up where you left off.</p>

                </div>
                <div class="forma">
                    <div id="txt">
                        Seray
                    </div>

                    <form>
                        <input type="text" placeholder="Email" id="email"><br>
                        <input type="password" placeholder="Password" id="password"><br>
                        <button type="submit">LOG IN</button>
                    </form>
                </div>


            </div>
        </div>
      </section>

      <script src="javascript/login.js"></script>
    
</body>
<footer class="footer">
  <section class="section4">
    <div class="logo">
      <img src="img/logo.png" alt="logo">
      <h1>Seray</h1>
    </div>
    <div class="links">
      <a href="homePage.php">HOME</a>
      <a href="menu.php">MENU</a>
      <a href="events.php">EVENTS</a>
      <a href="aboutUs.php">ABOUT US</a>
      <a href="register.php">JOIN US</a>
    </div>
    <div class="contact">
      <h3>RESTAURANT INFORMATION</h3><br>
      <p><b>ADDRESS:</b>Prishtina,Rruga Fehmi Agani</p>
      <p><b>Phone:</b> +383 44 111 555</p>
      <p> <b>Email:</b> seray@gmail.com</p>
      <p><b>OPEN:</b>9:00-00:00</p>
    </div>
  </section>
</footer>
</html>