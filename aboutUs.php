<?php
include_once 'php/Database.php';
class aboutUs{
  private $conn;
  private $table_name='aboutus';

  public function __construct($dbConn){
    $this->conn=$dbConn;
  }

public function insertContent($title, $text, $image, $lista) {
  $checkQuery = "SELECT * FROM aboutus WHERE title = :title";
  $stmt = $this->conn->prepare($checkQuery);
  $stmt->bindParam(':title', $title);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
      return false; 
  }
  $query = "INSERT INTO aboutus (title, text, image, lista) VALUES (:title, :text, :image, :lista)";
  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(':title', $title);
  $stmt->bindParam(':text', $text);
  $stmt->bindParam(':image', $image);
  $stmt->bindParam(':lista', $lista);
  return $stmt->execute();
}

public function getContent() {
  $query = "SELECT * FROM aboutus";
  $stmt = $this->conn->prepare($query);
  $stmt->execute();
  $aboutUsContent = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($aboutUsContent as $key => $content) {
      if (isset($content['lista'])) {
          $listItems = explode('.', $content['lista']);
          $listItems = array_map('trim', $listItems);
          $listItems = array_filter($listItems);
          $aboutUsContent[$key]['listArray'] = $listItems;
      }
  }

  return $aboutUsContent;
}
}

$db = new Database();
$conn = $db->getConnection();
$aboutUs = new aboutUs($conn);
$aboutUsContent = $aboutUs->getContent();

if(empty($aboutUsContent)){
$aboutUs->insertContent(
  "ABOUT US",
  "At our restaurant, we take immense pride in our dedicated staff, whose unwavering commitment ensures an exceptional dining experience for every guest. Our team is a harmonious blend of seasoned chefs and enthusiastic cooks, all driven by a shared passion for culinary excellence. Each day, the kitchen buzzes with creativity as our talented cooks collaborate, bringing innovative dishes to life while perfecting classic recipes. Their dedication extends beyond just preparing meals; they infuse every dish with love and meticulous attention to detail, ensuring that each plate is a masterpiece.The positive energy among our staff is palpable, creating a warm and welcoming atmosphere that extends from the kitchen to the dining room. Their camaraderie and mutual respect form the backbone of our restaurant’s success, fostering an environment where everyone thrives. Our cooks, with their diverse backgrounds and unique talents, work tirelessly to exceed expectations, turning every meal into a memorable experience. Their joy and dedication are the secret ingredients that make our restaurant a beloved destination for food lovers.",
  "../img/chefs.jpg",
  ""
);
$aboutUs->insertContent(
  "OUR HISTORY",
  "Our restaurant was born from a simple yet profound idea: to bring people together through the universal language of food. Founded in 2019 by Julian Moretti, a passionate food lover with a dream of creating a space where culinary traditions met innovation, our journey began as a labor of love. Julian's background in culinary training and cultural inspiration shaped the vision for a restaurant that would celebrate both authentic flavors and modern techniques. Starting as a small, cozy eatery with just a handful of team members, Julian worked tirelessly to establish a place where fresh ingredients, exceptional service, and a welcoming atmosphere were paramount. Over the years, the restaurant has grown into a vibrant community favorite, yet it remains deeply rooted in Julian's original vision—a love for great food, warm hospitality, and a commitment to making every guest feel at home.",
  "",
  ""
);
$aboutUs->insertContent(
  "MISSION AND QUALITY",
  "Our mission is to craft authentic dishes with the finest organic ingredients, embodying our passion for culinary excellence and the spirit of teamwork, to deliver an exceptional dining experience that delights every guest.",
  "../img/staff2.png",
  "Use of fresh, organic, and locally sourced ingredients.
 Expertise of skilled chefs passionate about their craft.
 Elegant and sophisticated interior design.
 Prompt and attentive care to ensure customer satisfaction.
Eco-friendly practices, such as reusable materials and minimal packaging.
Attention to creating moments that guests will cherish and remember.
A work environment that promotes creativity and innovation."
);
$aboutUs->insertContent(
  "AWARDS",
  "We are thrilled to share that our restaurant has been honored with the prestigious Award! This recognition celebrates our unwavering commitment to excellence, from using the finest organic ingredients to creating unforgettable Italian dishes with passion and precision. It is a testament to the hard work and teamwork of our dedicated staff, who strive every day to provide an exceptional dining experience. We are deeply grateful to our valued guests for their continued support and trust, which inspire us to reach new heights in culinary artistry.",
  "../img/images.png",
  ""
);
}
$aboutUsContent = $aboutUs->getContent();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <link rel="stylesheet" href="css/aboutUs.css">
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
<section id="section2">
  <?php 
  
  if(count($aboutUsContent) > 0){
    $topSection = $aboutUsContent[0]; 
  ?>
    <div id="main-text">
      <h1 id="menu"><?php echo $topSection['title']; ?></h1>
    </div>
    <div id="cooking-team">
      <img src="/Projekti-Web-dhe-Dizajn/<?php echo $topSection['image']; ?>" alt="Chefs">
    </div>
    <div id="desc">
      <p><?php echo $topSection['text']; ?></p>
    </div>
  <?php } ?>
</section>

<section id="section3">
  <?php 
        if(count($aboutUsContent)) {
        foreach($aboutUsContent as $key => $content) {
          if($key === 0) {
            continue;
          }
    
  ?>
        <div id="main-text">
          <h1 id="menu"><?php echo $content['title']; ?></h1>
        </div>
        <div id="desc">
          <p><?php echo $content['text']; ?></p>
        </div>
  <?php 
        break;
      }
    }
  
  ?>
</section>
<section id="section4">
  <?php 
  if(count($aboutUsContent) > 2) { 
    foreach($aboutUsContent as $key => $content) {
      if($key === 2) { 
        $content['lista'] = explode('.', $content['lista']);
  ?>
        <div id="header">
          <h1><?php echo ($content['title']); ?></h1>
        </div>
        <div id="desc2">
          <p><?php echo (($content['text'])); ?></p>
        </div>
        <img src="img/<?php echo ($content['image']); ?>" alt="" id="image">
        
        <div id="list">
          <ul>
            <?php 
            if(is_array($content['lista']) && !empty($content['lista'])){
              foreach($content['lista'] as $item) { ?>
                <li><?php echo (trim($item)); ?> </li>
              <?php } ?>
            <?php 
            } ?>
          </ul>
        </div>
  <?php 
        break; 
      }
    }
  }
  ?>
</section>
<section id="section5">
  <?php 
  if(count($aboutUsContent) > 3) { 
    foreach($aboutUsContent as $key => $content) {
      if($key === 3) { 
  ?>
        <div id="main-text">
          <h1><?php echo $content['title']; ?></h1>
        </div>
        <div id="desc3">
          <p><?php echo $content['text']; ?></p>
        </div>
        <img src="img/<?php echo $content['image']; ?>" alt="" id="image1">
  <?php 
        
      }
    }
  }
  ?>
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
      <p><b>ADDRESS:</b>Prishtina,Rruga Fehmi Agani</p>
      <p><b>Phone:</b> +383 44 111 555</p>
      <p> <b>Email:</b> seray@gmail.com</p>
      <p><b>OPEN:</b>9:00-00:00</p>
    </div>
  </section>
</footer>
</html>