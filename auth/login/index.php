<?php 

include_once '../../config/dbConfig.php';

include_once "../../partials/header.php";


?>

    <main class="login">
        <h2 class="header">LOGIN</h2>
        <section class="login-form">
            <form action="../authenticate.php" method="post">
                <label for="username">Username</label>
                <input type="text"
                       class=""
                       name="username"
                       id="username"
                       value="<?php  if (isset($_COOKIE["username"])) {
                        echo $_COOKIE["username"];
                        }
                        else{
                        echo "";
                        } ?>" required>
                <label for="pswd">Password</label>
                <input type="password" class="" name="password" id="pswd" placeholder="" required>
                <input type="submit" class="submit">
            </form> 
            <div class="login-options">
                <div>
                    <a href="../register">Don't ahave an account? <span>REGISTER</span></a>
                </div>
            </div>
        </section>
    </main>
    <div class="msg"></div>
 
    


