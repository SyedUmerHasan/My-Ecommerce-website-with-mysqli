<?php
class Database
{
  protected $servername ="";
  protected $username ="";
  protected $password = "";
  protected $database = "";
  protected $tablename = "";
  protected $conn="";


  function __construct($databasename,$table)
  {
    $this->servername = "localhost";
    $this->username = "root";
    $this->password = "";
    $this->database = $databasename;
    $this->tablename = $table;
    $this->StartConnection();
    $this->SessionStart();
    if(isset($_SESSION["logged_in"],$_SESSION["login_page"]))
    {
      if($_SESSION["logged_in"] == false && $_SESSION["login_page"] == false)
      {
        $this->gotoLoginPage();
      }
    }
  }
  public function SessionStart()
  {
    if(!isset($_SESSION))
    {
        session_start();
    }
  }
  public function SessionClose()
  {
    session_destroy();
    session_start();
    $_SESSION["firstname"] = null;
    $_SESSION["lastname"] = null;
    $_SESSION["username"] = null;
    $_SESSION["mobilenumber"] = null;
    $_SESSION["emailaddress"] = null;
    $_SESSION["password"] = null;
    $_SESSION["active"] = null;
    $_SESSION["message"] = null;
    $_SESSION["errormessage"] = null;
    $_SESSION["logged_in"] = false;

  }
  public function Login($email,$pass)
  {
    $email = $this->escapestrings($email);
    $pass = $this->escapestrings($pass);
    $sql = "SELECT * FROM user WHERE emailaddress='$email'";
    $result = mysqli_query($this->getconnectionstring(), $sql);

    $numrows = mysqli_num_rows($result);
    if ($numrows == 0)
    {
      $_SESSION["logged_in"] = true;
      $_SESSION['errormessage'] = "User with that email does not exist";
      // header("location: registrationform.php");
    }
    else
    {
      $user = mysqli_fetch_assoc($result);
      if($_POST["password"] == $user["password"])
      {
        $_SESSION["emailaddress"] = $user["emailaddress"];
        $_SESSION["firstname"] = $user["firstname"];
        $_SESSION["lastname"] = $user["lastname"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["mobilenumber"] = $user["mobilenumber"];
        $_SESSION["active"] = $user["active"];
        $_SESSION["logged_in"] = true;

        header("location: index.php");
      }
      else
      {
        $_SESSION["logged_in"] = false;
        $_SESSION["errormessage"] = "You have entered wrong password,try again";
        // header("location: registrationform.php");
      }
    }

  }


  public function gotoLoginPage()
  {
    header("location: login.php");
  }


  public function setdatabasename($databasename)
  {
    $this->database = $databasename;
  }
  public function  getdatabasename()
  {
    return $this->database;
  }
  public function  settablename($table)
  {
    $this->tablename = $table;
  }
  public function  gettablename()
  {
    return $this->tablename;
  }
  public function setusername($user)
  {
    $this->username = $user;
  }
  public function  getusername()
  {
    return $this->username;
  }
  public function  setpassword($pass)
  {
    $this->password = $pass;
  }
  public function  getpassword()
  {
    return $this->password;
  }
  public function  setconnectionstring($connection)
  {
    $this->conn = $connection;
  }
  public function  getconnectionstring()
  {
    return $this->conn;
  }

  public function StartConnection()
  {
    $connect = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
    $this->setconnectionstring($connect);
    if (mysqli_connect_error()) {
        die("Database connection failed: " . mysqli_connect_error());
        echo "Connection Error <br>";
        return false;
      }
    // echo "Connection Created using EcommerceDatabase <br>";
    return true;
  }
  public function InsertUser($firstname,$lastname,$username,$mobilenumber,$emailaddress,$password,$hash)
  {
    if (!$this->conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO user (firstname,lastname,username,mobilenumber,emailaddress,password,hash) VALUES ('$firstname','$lastname','$username','$mobilenumber','$emailaddress','$password','$hash')";
    if (mysqli_query($this->conn, $sql)) {
        echo "New record created successfully";

        $_SESSION['active'] = 0;
        // $_SESSION['logged_in'] = true;
        $_SESSION['message'] = "Confirmation link has been sent to $emailaddress, please verify your
        account by clinking on the link in the message
        ";

        $to       =  $emailaddress;
        $subject  = "Account Verification (orderkarao.pk)";
        $messagebody ='Hello '.$username.',

        Thank you for signing up!

        Please click the link below to acivate your account:

        https://codeforgeeks.000webhostapp.com/verify.php?email='.$emailaddress.'&hash='.$hash;

        mail($to,$subject,$messagebody);



    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
    }
  }

  public function CheckUserAvailablity($email)
  {
      $sql = "SELECT * FROM user WHERE emailaddress='$email'";
      $result = mysqli_query($this->conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        return false;
      }
      else {
      return true;
      }
  }

  public function finduserdetails($email)
  {
      $sql = "SELECT * FROM user WHERE emailaddress='$email'";
      $result = mysqli_query($this->conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        return $result;
      }
      else {
        return NULL;
      }
  }

  public function UpdateActiveStatus($email,$hash)
  {
    $sql = "UPDATE user SET active='1' WHERE emailaddress='$email'";

    if (mysqli_query($this->conn, $sql)) {
      $_SESSION["activatemessage"] = "Your account has been activated";
      $_SESSION["active"] = 1;
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($this->conn);
        $_SESSION["activatemessage"] = "Account has already been activated or the URL is invalid";
    }
  }
  public function escapestrings($myvar)
  {
    $myvariable =  mysqli_real_escape_string ($this->getconnectionstring() , $myvar );
    return $myvariable;
  }
  public function ActivateAccount()
  {
    if(isset($_GET["email"]) && isset($_GET["hash"]) )
    {
      $emailaddress =  mysqli_real_escape_string ($this->getconnectionstring() , $_GET["email"] );
      $hash =  mysqli_real_escape_string ($this->getconnectionstring() , $_GET["hash"] );
      $sql = "SELECT * FROM user WHERE emailaddress=$emailaddress AND hash=$hash";
      $this->UpdateActiveStatus($emailaddress,$hash);
    }
  }
  public function DeleteUser($id)
  {
    if (!$this->conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "DELETE FROM user WHERE id=$id";
    if (mysqli_query($this->conn, $sql)) {
        echo "User deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
    }
  }


  public function StartUserConnection()
  {
    $sql = "CREATE TABLE IF NOT EXIST `user` (
    `id` int(6) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `firstname` varchar(25) NOT NULL,
    `lastname` varchar(25) NOT NULL,
    `username` varchar(50) NOT NULL,
    `mobilenumber` varchar(25) NOT NULL,
    `emailaddress` varchar(30) NOT NULL,
    `password` varchar(50) NOT NULL,
    `reg_time` timestamp NULL DEFAULT NULL,
    `newsletterpermission` tinyint(1) DEFAULT NULL)";

      if ($conn->query($sql) === TRUE) {
          return true;
      } else {
          if($conn->error =="Table 'user' already exists")
          {
            echo "Table Connection Created using EcommerceDatabase<br>";
            return true;
          }
          else {
            echo "Table Connection Not Created using EcommerceDatabase<br>
            Error 404 Not Found<br>";
            return false;
          }
      }
  }
  function LoginForm()
  {
    $emailaddress = $this->escapestrings($_POST["emailaddress"]);
    $sql = "SELECT * FROM user WHERE emailaddress=$emailaddress";
    $result = mysqli_query($this->getconnectionstring(), $sql);
    $password = $this->escapestrings($_POST["password"]);
    if (mysqli_num_rows($result) > 0)
    {
      $user = mysqli_fetch_assoc($result);
      if(password_verify($_POST["password"],$_USER["password"]))
      {
        $_SESSION["emailaddress"] = $user["emailaddress"];
        $_SESSION["firstname"] = $user["firstname"];
        $_SESSION["lastname"] = $user["lastname"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["mobilenumber"] = $user["mobilenumber"];
        $_SESSION["active"] = $user["active"];
        $_SESSION["logged_in"] = true;

        header("location: index.php");
      }
      else
      {
        $_SESSION["logged_in"] = false;
        $_SESSION["errormessage"] = "You have entered wrong password,try again";
        header("location: registrationform.php");
      }
    }
    else
    {
        $_SESSION["logged_in"] = false;
        $_SESSION['errormessage'] = "User with that email does not exist";
        header("location: registrationform.php");
    }
  }
  function __destruct()
  {
    // echo "Connection Closed using EcommerceDatabase<br>";
    mysqli_close($this->conn);
 }
  public function CloseConnection()
  {
    mysqli_close($this->conn);
  }
}
 ?>
