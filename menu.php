<?php
include_once 'php/Database.php';

class Menu{
  private $conn;
  private $table_name = 'menu';

  public function __construct($dbConn){
    $this->conn=$dbConn;
  }
  
public function insertContent($image, $img_title, $description, $button, $category) {

  $query = "SELECT COUNT(*) FROM menu WHERE img_title = :img_title";
  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(':img_title', $img_title);
  $stmt->execute();
  $count = $stmt->fetchColumn();

  if ($count > 0) {
      return false;
  }

  
  $query = "INSERT INTO menu (image, img_title, description, button, category) 
            VALUES (:image, :img_title, :description, :button, :category)";
  
  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(':image', $image);
  $stmt->bindParam(':img_title', $img_title);
  $stmt->bindParam(':description', $description);
  $stmt->bindParam(':button', $button);
  $stmt->bindParam(':category', $category);

  return $stmt->execute();
}



 
  public function getContentByCategory($category) {
    $query = "SELECT * FROM menu WHERE category = :category";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':category', $category);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
$db = new Database();
$conn = $db->getConnection();
$menu = new Menu($conn);
$breakfastItems = $menu->getContentByCategory('Breakfast');
$dinnerItems = $menu->getContentByCategory('Dinner');
$drinksItems = $menu->getContentByCategory('Drinks');



  $menu->insertContent(
  
    "img/crepes.png",
    "Nutella Crepes",
    "A warm crepe with Nutella and fresh banana slices, lightly dusted with powdered sugar.",
    "Order",
    "Breakfast"
  );
  $menu->insertContent(
    "img/oats.png",
    "Berry Crunch Bowl",
     "A berry crunch bowl with granola, fresh strawberries, and pomegranate seeds.",
     "Order",
     "Breakfast"
  );
  $menu->insertContent(
    "img/waffles.png",
    "Fruity Waffles",
    "Crispy waffles topped with fresh fruit and vanilla ice cream.",
    "Order",
    "Breakfast"
  );
  $menu->insertContent(
    "img/pancakes.png",
    "Classic Pancakes",
    "Soft pancakes served with a mix of fresh berries and sliced fruits.",
    "Order",
    "Breakfast"
  );
  $menu->insertContent(
    "img/avocadotoast.png",
    "Avocado Toast",
    "Toast with avocado, soft eggs, and pine nuts for a simple and tasty snack.",
    "Order",
    "Breakfast"
  );
  $menu->insertContent(
    "img/bagel.png",
    "Egg Bagel",
    "Toasted bagel filled with eggs, greens, and cured meat for a tasty meal.",
    "Order",
    "Breakfast"
  );
  $menu->insertContent(
    "img/croissants.png",
    "Croissants",
    "Crispy croissants dressed with chocolate, almonds, and sugar.",
    "Order",
    "Breakfast"
  );
  $menu->insertContent(
    "img/eggs.png",
    "Scrambled Eggs",
    "Soft scrambled eggs served with slices of black bread.",
    "Order",
    "Breakfast"
  );
  $menu->insertContent(
    "img/steak.png",
    "Juicy Steak",
    "A juicy steak with a crisp, browned outside and tender inside.",
    "Order",
    "Dinner"
  );
  $menu->insertContent(
    "img/pasta.png",
    "Penne Bolognese",
    "Penne pasta topped with a rich, savory bolognese sauce.",
    "Order",
     "Dinner"
  );
  $menu->insertContent(
    "img/rice.png",
    "Thai Fried Rice",
    "Thai rice with beans and meat made with soft, fragrant rice, tender beans, and flavorful meat.",
    "Order",
     "Dinner"
  );
  $menu->insertContent(
    "img/meat.png",
    "Chicken with Patatoes",
    "A savory dish featuring tender, perfectly cooked chicken paired with crispy potatoes.",
    "Order",
     "Dinner"
  );
  $menu->insertContent(
    "img/pizza.png",
    "Pizza",
    "Various pizzas with fresh toppings, cheese, and a crispy crust.",
    "Order",
     "Dinner"
  );
  $menu->insertContent(
    "img/burger.png",
    "Golden Burger",
    "A flavorful burger with fresh toppings and a toasted bun, served with crispy french fries.",
    "Order",
     "Dinner"
  );
  $menu->insertContent(
    "img/fish.png",
    "Grilled Fish",
    "Grilled fish with a perfectly cooked fillet, served with fresh sides and a light seasoning.",
    "Order",
     "Dinner"
  );
  $menu->insertContent(
    "img/sushi.png",
    "Sushi",
    "Different sushi made with fresh ingredients, seasoned rice, and prepared to perfection.",
    "Order",
     "Dinner"
  );
    $menu->insertContent(
    "img/margarita.png",
    "Classic Margarita",
    "A Margarita with tequila, lime juice, and a salted rim. Refreshing and tangy, served cold.",
    "Order",
     "Drinks"
  );
  $menu->insertContent(
    "img/mojito.png",
    "Mojito",
    "Rum, fresh mint, lime, and soda water combined for a crisp, refreshing drink.",
    "Order",
    "Drinks"
  );
  $menu->insertContent(
    "img/aperol.png",
    "Aperol Spritz",
    "A refreshing cocktail with Aperol, prosecco, and soda.",
    "Order",
     "Drinks"
  );
  $menu->insertContent(
    "img/colada.png",
    "Piña Colada",
    "A creamy blend of coconut, pineapple, and rum for a refreshing tropical drink.",
    "Order",
     "Drinks"
  );
  $menu->insertContent(
    "img/martini.png",
    "Dirty Martini",
    "A classic martini with olive brine, offering a savory twist on the traditional cocktail.",
    "Order",
     "Drinks"
  );
  $menu->insertContent(
    "img/daiquriri.png",
    "Vodka Daiquiri",
    "A refreshing cocktail made with vodka, lime juice, and simple syrup.",
    "Order",
     "Drinks"
  );
  $menu->insertContent(
    "img/sunrise.png",
    "Tequila Sunrise",
    "A vibrant cocktail with tequila, orange juice, and grenadine, creating a sunrise effect.",
    "Order",
     "Drinks"
  );
  $menu->insertContent(
    "img/mango.png",
    "Spicy Mango Margarita",
    "A refreshing margarita with mango, a kick of spice, and a tangy twist.",
    "Order",
    "Drinks"
  );


 

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu</title>
  <link rel="stylesheet" href="css/menu.css">
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
<div class="body-text">
    <h1>Breakfast</h1>
</div>
<div class="container">
<?php foreach ($breakfastItems as $item): ?>
    <div class="card">
        <img src="<?= $item['image'] ?>" alt="<?= $item['img_title'] ?>">
        <div class="description">
            <h3><?= $item['img_title'] ?></h3>
            <p><?= $item['description'] ?></p>
            <button><?= $item['button'] ?></button>
        </div>
    </div>
<?php endforeach; ?>
</div>

 
  <div class="body-text">
    <h1>Dinner</h1>
</div>
<div class="container">
<?php foreach ($dinnerItems as $item): ?>
    <div class="card">
        <img src="<?= $item['image'] ?>" alt="<?= $item['img_title'] ?>">
        <div class="description">
            <h3><?= $item['img_title'] ?></h3>
            <p><?= $item['description'] ?></p>
            <button><?= $item['button'] ?></button>
        </div>
    </div>
<?php endforeach; ?>
</div>

  
  <div class="body-text">
    <h1>Special Drinks</h1>
</div>
<div class="container">
<?php foreach ($drinksItems as $item): ?>
    <div class="card1">
        <img src="<?= $item['image'] ?>" alt="<?= $item['img_title'] ?>">
        <div class="description1">
            <h3><?= $item['img_title'] ?></h3>
            <p><?= $item['description'] ?></p>
            <button><?= $item['button'] ?></button>
        </div>
    </div>
<?php endforeach; ?>
</div>


 
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