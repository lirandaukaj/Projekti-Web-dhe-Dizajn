 <?php
 
 session_start();
 include_once 'Database.php';
 include_once 'User.php';
 
 class Login {
     private $user;
 
     public function __construct(User $user) {
         $this->user = $user;
     }
 
     public function login($email, $password) {
         if ($this->user->login($email, $password)) {
             $this->loginUser();
         } else {
             $this->invalidMessage();
         }
     }
 
     private function loginUser() {
         $redirectPage = ($_SESSION['role'] === 'admin') ? '../dashboard.php' : '../homePage.php';
         header("Location: $redirectPage");
         exit;
     }
 
     private function invalidMessage() {
         echo "<script>alert('Invalid email or password!'); window.location = '../login.php'; </script>";
     }
 }
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $db = new Database();
     $connection = $db->getConnection();
     $user = new User($connection);
     $auth = new Login($user);
 
     $email = $_POST['email'];
     $password = $_POST['password'];
 
     $auth->login($email, $password);
 }



