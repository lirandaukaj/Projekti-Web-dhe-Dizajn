<?php
include_once 'php/Database.php';
class events{
  private $conn;
  private $table = 'events';

  public function __construct($dbConn){
    $this->conn=$dbConn;
  }
  public function insertContent($titulli,$pershkrimi,$foto){
    $checkQuery = "SELECT * FROM events WHERE titulli = :titulli";
    $stmt = $this->conn->prepare($checkQuery);
    $stmt->bindParam(':titulli',$titulli);
    $stmt->execute();

    if($stmt->rowCount() > 0){
      return false;
    }
    $query = "INSERT INTO events (titulli,pershkrimi,foto) VALUES (:titulli, :pershkrimi,:foto)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':titulli',$titulli);
    $stmt->bindParam(':pershkrimi',$pershkrimi);
    $stmt->bindParam(':foto',$foto);
    return $stmt->execute();
  }

  public function getContent(){
    $query = "SELECT * FROM events";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $eventsContent = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // foreach($eventsContent as $key => $content) {
    //   if(isset($content))
    // }

    return $eventsContent;
  }
}
  $db = new Database();
  $conn = $db->getConnection();
  $events = new events($conn);
  $eventsContent = $events->getContent();

  if(empty($eventsContent)){
    $events->insertContent(
      "EVENTS",
      "At our restaurant, we love bringing people together through vibrant events that celebrate food, culture, and community! From themed dinner nights and live music performances to exclusive chef's specials and wine tastings, there's always something exciting happening.
                  Whether you're joining us for a cozy date night, a family gathering, or a fun evening with friends,our events promise unforgettable experiences filled with delicious flavors, warm ambiance, and great company. <br>Keep an eye on our calendar for upcoming events, and let us make your evenings truly special!
                  At our restaurant, we believe that great food is the heart of every memorable gathering. Our events are designed to not only tantalize your taste buds but also to create lasting connections and joyful moments. Picture yourself savoring exquisite dishes crafted with passion, while enjoying the rhythm of live entertainment or the insights of a talented chef during an interactive cooking session.
                  We take pride in curating a dynamic lineup of experiences that reflect the rich diversity of flavors and cultures, ensuring there's something for everyone. <Br>From seasonal festivals celebrating local produce to culinary workshops that ignite your creativity, we strive to turn ordinary evenings into extraordinary adventures.
                  Whether you're celebrating a milestone, exploring new cuisines, or simply looking for a reason to unwind, our events are your perfect escape. Don't just dine—immerse yourself in the art of food and community. Stay tuned for what's next, and let us add a touch of magic to your moments!",
    "img/events.png"
    );
    $events->insertContent(
      "Wine Tasting",
      "Sip, savor, and explore a curated selection of fine wines at our exclusive tasting event. Guided by a professional sommelier, enjoy expert insights, delightful pairings, and an elegant ambiance. Perfect for wine lovers and curious beginners alike!",
      "img/winetasting.png",
    );
    $events->insertContent(
      "Chef's specials",
      "Indulge your taste buds with a night of exclusive creations at our Chef's Specials Night! This one-of-a-kind event showcases the culinary artistry and innovation of our talented chef, featuring a specially curated menu available for one night only.",
    "img/chefsspecials.png"
   
    );
    $events->insertContent(
      "Rhythms and Flavors",
      "Join us for an evening of tasty dishes and live classical music. Enjoy the relaxing atmosphere as talented musicians fill the room with gentle melodies, creating the perfect backdrop for your meal. Rhythms and Flavors is all about good food and beautiful music coming together.",
      "img/livemusic.png"
    );
    $events->insertContent(
      "Global Gourmet Experience",
      "Take your taste buds on a journey with an evening dedicated to international cuisine. Explore a menu inspired by flavors from across the globe, featuring unique dishes crafted with fresh, local ingredients. Flavors of the World is the perfect way to experience a variety of cultures through food, all in one unforgettable night.",
       "img/gourment.png"
    );
  }
  $eventsContent = $events->getContent();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="css/events.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>
<body>
    <section id="section1">
        <div class="container">
      <header>
        <div id="logo">
        <img src="img/logo.png" alt="Logo" id="foto">
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
    <?php
      if(count($eventsContent)) {
        $topSection = $eventsContent[0];
    ?>
          <!-- <div class="container1"> -->
          <div class="main-event">
            <h1 class="main-event__headline"><?php echo $topSection["titulli"] ?></h1>
            <div class="main-event__holder">
              <div class="main-event__description">
                <p>
                  <?php echo $topSection["pershkrimi"] ?>
                </p>
              </div>
              <figure>
                <img src="/Projekti-Web-dhe-Dizajn/<?php echo $topSection['foto'] ?>" alt="<?php echo $topSection['titulli'] ?>">
              </figure>
            </div>
          </div>
          <!-- </div> -->
    <?php
      }  
    ?>
    <section id="section3">
        <!-- <div class="container2"> -->
          <?php 
            if(count($eventsContent)) {
              foreach($eventsContent as $key => $event) {
                if($key === 0) {
                  continue;
                }
          ?>
              <div class="pjesa2">
                <div class="image" method="POST">
                  <img  name= "image" src="/Projekti-Web-dhe-Dizajn/<?php echo $event['foto'] ?>" alt="<?php echo $event['titulli'] ?>">
                </div>
                <div class="description" method= "POST">
                  <h2 name = "title"><?php echo $event['titulli'] ?></h2>
                  <p name = "description"><?php echo $event['pershkrimi'] ?></p><br><br>
                  <div class="elem">
                    <p><i class="fa-regular fa-calendar"></i> Saturday 11th of August</p><br>
                    <p><i class="fa-regular fa-clock"></i> 19:00</p><br>
                    <a href="register.php"><button>Click For More !</button></a>
                  </div>
                </div>
              </div>
              <?php
                if(count($eventsContent) !== $key + 1) {
              ?>
                  <hr class="line" />
              <?php
                }
              }
            }
          ?>
            <!-- <div class="pjesa2">
                <div class="image">
                <img src="img/winetasting.png" alt="winetasting">
                </div>
                <div class="description">
                <h2>Wine Tasting</h2>
                <p>Sip, savor, and explore a curated selection of fine wines at our exclusive tasting event. Guided by a professional sommelier, enjoy expert insights, delightful pairings, and an elegant ambiance. Perfect for wine lovers and curious beginners alike!</p><br><br>
                <div class="elem">
                <p><i class="fa-regular fa-calendar"></i> Saturday 11th of August</p><br>
                <p><i class="fa-regular fa-clock"></i> 19:00</p><br>
                <a href="register.php"><button>Click For More !</button></a>
              </div>
                </div>
            
            </div>
            <hr class="line">
            <div class="pjesa2">
              <div class="image">
                <img src="img/chefsspecials.png" alt="chefsspecials">
              </div>
              <div class="description">
                <h2>Chef's specials</h2>
                <p>Indulge your taste buds with a night of exclusive creations at our Chef's Specials Night! This one-of-a-kind event showcases the culinary artistry and innovation of our talented chef, featuring a specially curated menu available for one night only.</p><br><br>
                <div class="elem">
                <p><i class="fa-regular fa-calendar"></i> Wednesday 15th of August</p><br>
                <p><i class="fa-regular fa-clock"></i> 20:00</p><br>
                <a href="register.php"><button>Click For More !</button></a>
              </div>
              </div>
            </div>
            <hr class="line">
            <div class="pjesa2">
              <div class="image">
              <img src="img/livemusic.png" alt="Live Music">
              </div>
              <div class="description">
              <h2>Rhythms and Flavors</h2>
              <p>Join us for an evening of tasty dishes and live classical music. Enjoy the relaxing atmosphere as talented musicians fill the room with gentle melodies, creating the perfect backdrop for your meal. Rhythms and Flavors is all about good food and beautiful music coming together.</p><br><br>
              <div class="elem">
              <p><i class="fa-regular fa-calendar"></i> Friday 17th of August</p><br>
              <p><i class="fa-regular fa-clock"></i> 20:00</p><br>
              <a href="register.php"><button>Click For More !</button></a>
            </div>
              </div>
          
          </div>
          <hr class="line">
          <div class="pjesa2">
            <div class="image">
            <img src="img/gourmet.png" alt="Global gourmet">
            </div>
            <div class="description">
            <h2>Global Gourmet Experience</h2>
            <p>Take your taste buds on a journey with an evening dedicated to international cuisine. Explore a menu inspired by flavors from across the globe, featuring unique dishes crafted with fresh, local ingredients. Flavors of the World is the perfect way to experience a variety of cultures through food, all in one unforgettable night.</p><br><br>
            <div class="elem">
            <p><i class="fa-regular fa-calendar"></i> Tuesday 21th of August</p><br>
            <p><i class="fa-regular fa-clock"></i> 17:00</p><br>
            <a href="register.php"><button>Click For More !</button></a>
          </div>
        </div>
        
        </div> -->
        <!-- </div> -->
       
    </section>

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