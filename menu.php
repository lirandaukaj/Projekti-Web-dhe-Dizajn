<?php
include_once 'php/Database.php';

class Menu{
  private $conn;
  private $table_name = 'menu';

  public function __construct($dbConn){
    $this->conn=$dbConn;
  }
  public function insertContent($title,$image,$img_title,$description,$button) {
    $checkQuery = "SELECT * FROM menu WHERE title = :title";
    $stmt = $this->conn->prepare($checkQuery);
    $stmt->bindParam(':title', $title);
    $stmt->execute();

    if($stmt->rowCount() > 0) {
      return false;
    }
    $query = "INSERT INTO menu (title,image,img_title,description,button) VALUES (:title, :image, :img_title,:description, :button)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':title',$title);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':img_title', $img_title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':button',$button);
    return $stmt->execute();
  }

  public function getContent() {
    $query = "SELECT * FROM menu";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $menuContent = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $menuContent;
  }
}
$db = new Database();
$conn = $db->getConnection();
$menu = new Menu($conn);
$menuContent = $menu->getContent();


if(empty($menuContent)) {
  $menu->insertContent(
    "MENU",
     "",
     "",
     "",
     ""
  );
  $menu->insertContent(
    "Breakfast",
    "",
    "",
    "",
    "",
  );
  $menu->insertContent(
    "",
    "img/crepes.png",
    "Nutella Crepes",
    "A warm crepe with Nutella and fresh banana slices, lightly dusted with powdered sugar.",
    "Order"
  );
  $menu->insertContent(
    "",
    "img/oats.png",
    "Berry Crunch Bowl",
     "A berry crunch bowl with granola, fresh strawberries, and pomegranate seeds.",
     "Order"
  );
  $menu->insertContent(
    "",
    "img/waffles.png",
    "Fruity Waffles",
    "Crispy waffles topped with fresh fruit and vanilla ice cream.",
    "Order"
  );
  $menu->insertContent(
    "",
    "img/pancakes.png",
    "Classic Pancakes",
    "Soft pancakes served with a mix of fresh berries and sliced fruits.",
    "Order"
  );
  $menu->insertContent(
    "",
    "img/avocadotoast.png",
    "Avocado Toast",
    "Toast with avocado, soft eggs, and pine nuts for a simple and tasty snack.",
    "Order"
  );
  $menu->insertContent(
    "",
    "img/bagel.png",
    "Egg Bagel",
    "Toasted bagel filled with eggs, greens, and cured meat for a tasty meal.",
    "Order"
  );
  $menu->insertContent(
    "",
    "img/croissants.png",
    "Croissants",
    "Crispy croissants dressed with chocolate, almonds, and sugar.",
    "Order"
  );
  $menu->insertContent(
    "",
    "img/eggs.png",
    "Scrambled Eggs",
    "Soft scrambled eggs served with slices of black bread.",
    "Order"
  );
 
}
$menuContent = $menu->getContent();
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

<?php
    if(count($menuContent) > 0) {
        $currentCategory = '';  
  

        echo "<section id='section2'>";

   foreach($menuContent as $content) {
            
    if (empty($content['title']) && empty($content['img_title']) && empty($content['description'])) {
                continue;  
            }
   
      if (!empty($content['title']) && $content['title'] != $currentCategory) {
     
                $currentCategory = $content['title'];
                echo "<div class='body-text'><h1>{$content['title']}</h1></div>";
                
            }
            
            if (!empty($content['img_title']) && !empty($content['description'])) {
                echo "
                 <div class='container'>
                  <div class='card'>
                    <img src='{$content['image']}' alt='Foto1'>
                    <div class='description'>
                      <h3>{$content['img_title']}</h3>
                      <p>{$content['description']}</p>
                      <button>{$content['button']}</button>
                    </div>
                  </div>
                  </div>
        
                ";
            }
        }
    } else {
        echo "<p>No menu items available.</p>";
    }
    ?>
  
    <!-- <div class="card">
    <img src="img/oats.png" alt="Foto2">
      <div class="description">
        <h3>Berry Crunch Bowl</h3>
        <p>
          A berry crunch bowl with granola, fresh strawberries, and pomegranate seeds.</p>
        <button>Order</button>
      </div>
    </div>
    <div class="card">
      <img src="img/waffles.png" alt="Foto3">
      <div class="description">
        <h3>Fruity Waffles</h3>
        <p>
          Crispy waffles topped with fresh fruit and vanilla ice cream.</p>
        <button>Order</button>
      </div>
    </div>
    <div class="card">
      <img src="img/pancakes.png" alt="Foto4">
      <div class="description">
        <h3>Classic Pancakes</h3>
        <p>Soft pancakes served with a mix of fresh berries and sliced fruits.</p>
        <button>Order</button>
      </div>
    </div>
    <div class="card">
      <img src="img/avocadotoast.png" alt="Foto5">
      <div class="description">
        <h3>Avocado Toast</h3>
        <p>Toast with avocado, soft eggs, and pine nuts for a simple and tasty snack.</p>
        <button>Order</button>
      </div>
    </div>
    <div class="card">
      <img src="img/bagel.png" alt="Foto7">
      <div class="description">
        <h3>Egg Bagel</h3>
        <p>Toasted bagel filled with eggs, greens, and cured meat for a tasty meal.
        </p>
        <button>Order</button>
      </div>
    </div>
    <div class="card">
      <img src="img/croissants.png" alt="Foto6">
      <div class="description">
        <h3>Croissants</h3>
        <p>Crispy croissants dressed with chocolate, almonds, and sugar.</p>
        <button>Order</button>
      </div>
    </div>
    <div class="card">
      <img src="img/eggs.png" alt="Foto8">
      <div class="description">
        <h3>Scrambled Eggs</h3>
        <p>Soft scrambled eggs served with slices of black bread.</p>
        <button>Order</button>
      </div>
    </div>
  </div> -->
  <div class="body-text">
    <h1>Dinner</h1>
  </div>
  <div class="container">
    <div class="card">
      <img src="img/steak.png" alt="Foto9">
      <div class="description">
        <h3>Juicy Steak</h3>
        <p>A juicy steak with a crisp, browned outside and tender inside.</p>
        <button>Order</button>
      </div>
    </div>
    <div class="card">
      <img src="img/pasta.png" alt="Foto10">
      <div class="description">
        <h3>Penne Bolognese</h3>
        <p>Penne pasta topped with a rich, savory bolognese sauce</p>
        <button>Order</button>
      </div>
    </div>
    <div class="card">
      <img src="img/rice.png" alt="Foto11">
      <div class="description">
        <h3>Thai Fried Rice</h3>
        <p>Thai rice with beans and meat made with soft, fragrant rice, tender beans, and flavorful meat.</p>
        <button>Order</button>
      </div>
    </div>
    <div class="card">
      <img src="img/meat.png" alt="Foto12">
      <div class="description">
        <h3>Chicken with Patatoes</h3>
        <p>A savory dish featuring tender, perfectly cooked chicken paired with crispy potatoes.</p>
        <button>Order</button>
      </div>
    </div>
    <div class="card">
      <img src="img/pizza.png" alt="Foto13">
      <div class="description">
        <h3>Pizza</h3>
        <p>Various pizzas with fresh toppings, cheese, and a crispy crust.</p>
        <button>Order</button>
      </div>
    </div>
    <div class="card">
      <img src="img/burger.png" alt="Foto14">
      <div class="description">
        <h3>Golden Burger</h3>
        <p>A flavorful burger with fresh toppings and a toasted bun, served with crispy french fries.</p>
        <button>Order</button>
      </div>
    </div>
    <div class="card">
      <img src="img/fish.png" alt="Foto15">
      <div class="description">
        <h3>Grilled Fish</h3>
        <p>Grilled fish with a perfectly cooked fillet, served with fresh sides and a light seasoning.</p>
        <button>Order</button>
      </div>
    </div>
    <div class="card">
      <img src="img/sushi.png" alt="Foto16">
      <div class="description">
        <h3>Sushi</h3>
        <p>Different sushi made with fresh ingredients, seasoned rice, and prepared to perfection.</p>
        <button>Order</button>
      </div>
    </div>
  </div>
  <div class="body-text">
    <h1>Special Drinks</h1>
  </div>
    <div class="container">
      <div class="card1">
        <img src="img/margarita.png" alt="Foto17">
        <div class="description1">
          <h3>Classic Margarita</h3>
          <p>A Margarita with tequila, lime juice, and a salted rim. Refreshing and tangy, served cold.</p>
          <button>Order</button>
        </div>
      </div>
      <div class="card1">
        <img src="img/mojito.png" alt="Foto18">
        <div class="description1">
          <h3>Mojito</h3>
          <p>Rum, fresh mint, lime, and soda water combined for a crisp, refreshing drink.</p>
          <button>Order</button>
        </div>
      </div>
      <div class="card1">
        <img src="img/aperol.png" alt="Foto19">
        <div class="description1">
          <h3>Aperol Spritz</h3>
          <p>A refreshing cocktail with Aperol, prosecco, and soda.</p>
          <button>Order</button>
        </div>
      </div>
      <div class="card1">
        <img src="img/colada.png" alt="Foto20">
        <div class="description1">
          <h3>Piña Colada</h3>
          <p>A creamy blend of coconut, pineapple, and rum for a refreshing tropical drink.</p>
          <button>Order</button>
        </div>
      </div>
      <div class="card1">
        <img src="img/martini.png" alt="Foto21">
        <div class="description1">
          <h3>Dirty Martini</h3>
          <p>A classic martini with olive brine, offering a savory twist on the traditional cocktail.</p>
          <button>Order</button>
        </div>
      </div>
      <div class="card1">
        <img src="img/daiquriri.png" alt="Foto22">
        <div class="description1">
          <h3>Vodka Daiquiri</h3>
          <p>A refreshing cocktail made with vodka, lime juice, and simple syrup.</p>
          <button>Order</button>
        </div>
      </div>
      <div class="card1">
        <img src="img/sunrise.png" alt="Foto23">
        <div class="description1">
          <h3>Tequila Sunrise</h3>
          <p>A vibrant cocktail with tequila, orange juice, and grenadine, creating a sunrise effect.</p>
          <button>Order</button>
        </div>
      </div>
      <div class="card1">
        <img src="img/mango.png" alt="Foto24">
        <div class="description1">
          <h3>Spicy Mango Margarita</h3>
          <p>A refreshing margarita with mango, a kick of spice, and a tangy twist.</p>
          <button>Order</button>
        </div>
      </div>
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