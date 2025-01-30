<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seray</title>
  <link rel="stylesheet" href="css/homePage.css">
</head>
<body>
  <section id="section1">
    <div class="container">
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
    </div>
  </section>

  <section id="section2">
    <div class="images">
      <img src="img/foto1.png" alt="Slideshow" id="images">
      <div class="button">
        <button onclick="changeImg()">NEXT</button>
      </div>
  </section>
  <section id="section3">
    <div class="main-desc">
      <h1>ABOUT US</h1>
    </div>
    <div class="desc">
      <h2>Where Flavorful Moments are Shared with Friends</h2>
    </div>
      <div class="text">
        <p>Seray Restaurant was founded with a vision to redefine modern dining. From the beginning, our goal has been to create a space where innovative cuisine meets exceptional service, offering a fresh take on what a restaurant experience can be.With a focus on contemporary flavors and a vibrant atmosphere, Seray blends creativity and passion into every dish.From the sleek design to the carefully curated menu, everything at Seray is crafted to provide a unique and unforgettable dining experience.Join us and discover what makes Seray Restaurant a modern culinary destination like no other.</p>
      </div>
      <div id="photoMain">
        <img src="img/founder.png" alt="fotojasht">
      </div>
      <div id="chefs">
        <img src="img/staff1.png" alt="">
        <img src="img/staff2.png" alt="">
        <img src="img/staff3.png" alt="">
      </div>
    
  </section>
  <section id="section4">
    <div id="container1">
      <div class="main-desc">
        <h1>THIS WEEK'S SPECIALS</h1>
      </div>
      <div id="tekst">
        <p>Come and indulge in our chef's handpicked creations !</p>
      </div>
      <div class="foodcontainer">
        <div class="foto">
            <img src="img/pic1.png" alt="">
            <div class="description">
                <p>SHRIMP BOMB ROLL</p>
            </div>
        </div>
        <div class="foto">
            <img src="img/pic2.png" alt="">
            <div class="description">
                <p>GARLIC BASIL PASTA</p>
            </div>
        </div>
        <div class="foto">
            <img src="img/pic3.png" alt="">
            <div class="description">
                <p> GRILLED SALMON</p>
            </div>
        </div>
     </div>
     <div class="butoni">
     <a href="menu.php"><button>MENU</button></a> 
   </div>

    </div>
  </section>
  <section id="section5">
    <div id="contenti">
    <div class="main-desc1">
      <h1>SPECIAL DISCOUNTS</h1>
    </div>
    <div id="txt">
      <p>
        At Seray, we believe dining should be as rewarding as it is enjoyable.When you become a member, you unlock <b>exclusive discounts,tailored offers, and exciting promotions </b> that make every visit special. Share your experiences through <b>REVIEWS</b>, and we'll show our appreciation with extra perks that enhance your time with us. Join the Seray community today and enjoy exceptional food, outstanding service, and benefits designed just for you!</p>
        <Br>
    </div>
    <div id="bullet">
      <h4>Contact us for a special discount</h4>
      <form action="php/ContactUs.php"  method="POST">
        <textarea name="contactus" id="contactus" required></textarea><br>
        <button type="submit" id="conButton">Submit</button>
    </form>
    </div>

    <div class="butoni">
      <a href="register.php"><button>Join Us</button></a>
    </div>
  </div>
  </section>
  <section id="section6">
    <div class="eventsContainer">
      <div id="header">
        <h1>OUR EVENTS</h1>
      </div>
      <div id="picture">
        <img src="img/eventsHomePage.png" alt="">
      </div>
    </div>
    <div id="eventsDescription">
      <p id="main-heading">At Seray, every event is a celebration</p>
      <p>At Seray, we're more than just a place to dine—we're a hub for creating unforgettable memories. Our vibrant atmosphere sets the stage for unique events that bring people together over great food, music, and shared experiences.Imagine evenings filled with the soulful sounds of live music as talented local artists take the stage, creating the perfect backdrop for your night out. Our themed dinners transport you to another world, with menus and décor designed to immerse you in a one-of-a-kind culinary journey.Wine enthusiasts will love our carefully curated wine-tasting evenings, where you can explore exceptional pairings while mingling with fellow connoisseurs. For those who love to roll up their sleeves, our interactive cooking classes are the perfect way to learn, laugh, and savor together with other food lovers.
      Seasonal celebrations at Seray bring an extra dose of joy, whether it's a festive holiday feast, a summer soirée, or a cozy winter gathering. No matter the occasion, our events are crafted with care to surprise, delight, and inspire.</p>
    </div>
    <div class="butoni">
      <a href="events.php"><button>Events</button></a>
    </div>
  </section>
  <script src="javascript/homePage.js"></script>
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
      <p> <b>ADDRESS:</b>Prishtina,Rruga Fehmi Agani</p>
      <p><b>PHONE:</b> +383 44 111 555</p>
      <p> <b>EMAIL: </b>seray@gmail.com</p>
      <p><b>OPEN:</b>9:00-00:00</p>
    </div>
  </section>
</footer>
</html>