<?php
require("../View/_inc/head.php");
require("../View/_inc/header.php");
require("../Controller/CheckLogin.php");
session_start();
if(isset($_SESSION["FN"]) && $_SESSION["FN"] != null){
	session_unset();
	session_destroy();
} else{
	session_abort();
}


$result = getUserCredentials();
$correctEmail = false;
$correctPwd = false;

(isset($_GET["UserEmail"])) ? $userEmail = $_GET["UserEmail"] : $userEmail = "";
(isset($_GET["Password"])) ? $pwd = $_GET["Password"] : $pwd = "";

for($i = 0; $i < count($result); $i++){
    if(!$correctEmail){
        $correctEmail = ($result[$i]["userEmail"] == $userEmail);
    }
    if(!$correctPwd){
        $correctPwd = $result[$i]["userPW"] == $pwd;
    }
}
session_start();
$correctEmail && $correctPwd ? $_SESSION["LoggedIn"] = true : $_SESSION["LoggedIn"] = false;

if($_SESSION["LoggedIn"]){
    session_abort();
    $row = getDetails($_GET["UserEmail"], $_GET["Password"]);
    $url = "home.php?FN=".urlencode($row["UserFN"])."&SN=".urlencode($row["UserSN"])."&E=".urlencode($row["UserEmail"]);
    header("Location:$url");
}
?>

<section  class="ftco-section">
    <div style=float:left;width:50%; class="container">
    <div class="row justify-content-center">

        <div style=width:700px;margin-bottom:100px;margin-left:200px class="login-wrap p-4 p-md-5">
        <h1 style=width:500px>Skills Build Searcher</h1>
        <h2 style=width:600px>This website uses an AI called Wade to help users discover IBM Skills Build courses that relate to their learning goals and aspirations.
            Users will find that they can enter specific words or phrases relating to a course they would like to use as well as entering a paragraph of
            their goals. Either of these will allow the Wade AI to output the best suited course for the user.
        </h2>
        <h2 style=width:600px>Enter your email and password on the right to gain access to the Wade AI.</h2>
                </div>
    </div>
    </div>

        <div style=float:right;width:50% class="container">
            <div class="row justify-content-center">
                    <div style=width:400px class="login-wrap p-4 p-md-5">
                  <div class="icon d-flex align-items-center justify-content-center">
                      <span class="fa fa-user-o"></span>
                  </div>
                  <h3 class="text-center mb-4">Sign In</h3>
                        <form action="#" class="login-form">
                      <div class="form-group">
                          <input type="text" class="form-control rounded-left" placeholder="Email" name="UserEmail" required>
                      </div>
                <div class="form-group d-flex">
                  <input type="password" class="form-control rounded-left" placeholder="Password" name="Password" required>
                </div>
                <div class="form-group">
                    <input style="margin-left:50px;margin-bottom:10px;letter-spacing:2px;padding-left:20px;padding-right:20px" class="btn btn-primary btn-lg" type="submit" value="Login" id="confirm" name="confirm"/>
                    <span style="margin-left:60px;letter-spacing:2px"><a href="SkillsBuildSearcher/View/signup.php">Sign Up</a></span>
                </div>
              </form>
            </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
<?php
require("../View/_inc/Footer.php");
?>