<?php
include_once 'php/Database.php';
$db = new Database();
$conn = $db->getConnection();

$query = "SELECT * FROM aboutus";
$stmt = $conn->prepare($query);
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
</section>
<section id="section2">
  <div id="main-text">
    <h1 id="menu"><?php echo $aboutUsContent[0]['title']; ?></h1>
  </div>
  <div id="cooking-team">
   <img src="img/<?php echo $aboutUsContent[0]['image']; ?>" alt="Chefs">
  </div>
  <div id="desc">
    <p><?php echo $aboutUsContent[0]['text']; ?></p>
  </div>
</section>
  
  <section id="section3">
    <div id="heading">
      <h1><?php echo $aboutUsContent[1]['title'];?></h1>
    </div>
    <div id="desc1">
      <p><?php echo $aboutUsContent[1]['text'];?></p>
    </div>
  </section>

  <section id="section4">
    <div id ="header">
      <h1><?php echo $aboutUsContent[2]['title'];?></h1>
    </div>
    <div id="desc2">
      <p><?php echo $aboutUsContent[2]['text'];?></p>
    </div>
    <img src="img/<?php echo $aboutUsContent[2]['image'];?>" alt="" id="image">
    <div id="list">
      <ul>
        <?php
foreach ($aboutUsContent[2]['listArray'] as $item) {
  echo "<li>" . htmlspecialchars($item) . "</li>";
}
        ?>
      </ul>
    </div>
  </section>
  <section id="section5">
    <div id="header1">
      <h1><?php echo $aboutUsContent[3]['title'];?></h1>
    </div>
    <div id="desc3">
      <p><?php echo $aboutUsContent[3]['text']?></p>
    </div>
    <img src="img/<?php echo $aboutUsContent[3]['image'] ?>" alt="" id="image1">


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