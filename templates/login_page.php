<?php
    require_once (dirname(dirname(__FILE__)) . '/templates/header.php');
    require_once (dirname(dirname(__FILE__)) . '/controller/UserController.php');

    require_once (dirname(dirname(__FILE__)) . '/templates/header.php');
    require_once (dirname(dirname(__FILE__)) . '/controller/UserController.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // parse_str($_POST['login_form'], $formValues);

        $userController = new UserController();
        $userController->login();
    }
?>

<div class="row">
    <header class="column grid_8">
        <section class="box clearfix">
            <ul class="fr">
                <li><a href="/templates/signup_page.php">Create</a></li>
                <li><a href="/templates/login_page.php">Login</a></li>
            </ul>
        </section>
    </header>
    <article class="create login column grid_8">
        <section class="box clearfix">
            <h3>Account creation form</h3>
            <form method="POST">
                <label><span>Username</span>
                    <input name="username" type="text" size="50" value="eq. SamuelLJackstones">
                </label>
                <label><span>Password</span>
                    <input name="password" type="password" size="50" value="Where is the love?">
                </label>
            
                <button>Login</button>                  
            </form>
        </section>
    </article>
</div>