<?php 

include '../../config/dbConfig.php';

include_once "../../partials/header.php"; ?>


    <main class="login register">
        <h2 class="header">REGISTER</h2>
        <section class="login-form">
            <form action="register.php" method="post" class="">
                <input type="hidden" name="is_active" value="1">
                <input type="hidden" name="is_admin" value="1">
                <label for="username">Username</label>
                <input type="text" class="" name="username" id="username" placeholder="" required>
                <label for="email">Email</label>
                <input type="email" class="" name="email" id="email" placeholder="" required>
                <label for="pswd">Password</label>
                <input type="password" class="" name="password" id="pswd" placeholder="" required>
                <input type="submit" class="submit">
            </form>
            <div class="login-options">
                <a href="../login">Already have an account? <span>login now</span></a>
            </div>
            <div class="msg"></div>
        </section>


    </main>
    
<?php include_once '../../partials/footer.php';


