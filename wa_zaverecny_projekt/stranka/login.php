<?php
session_start();
include 'config.php';
include 'location_functions.php';

if(isset($_GET['lang'])){
    $_SESSION['lang'] = $_GET['lang'];
}
if($_SESSION['lang'] == "en"){
    $header_prihlasenie = "Log in";
    $loginInput = "Login:";
    $passwordInput = "Password:";
    $registrationBtn = "Sign up";
    $loginBtn = "Log in";
    
    $header_registracia = "Sign up";
    $error_prihlasovaci_login_prazdny_hodnota = $error_registracny_login_hodnota = "Login is required field";
    $error_admin_hodnota = "Admin login already exist";
    $error_prihlasovacie_heslo_prazdne_hodnota = $error_registracny_pass_hodnota = "Password is required field";
    $error_opakovane_heslo_hodnota = "Retype password is required field";
    $error_heslo_hodnota = "Passwords don\'t match";
    $opakuj_heslo = "Retype password:";
    $backBtn = "Back";
    $signupBtn = "Sign up";
    
    $error_prihlasovaci_login_hodnota = "Wrong login";
    $error_prihlasovacie_heslo_hodnota = "Wrong password";
    
    $uspesna_registracia_hodnota = "You have already registered, you can log in";
} else {
    $header_prihlasenie = "Prihlásenie";
    $loginInput = "Prihlasovacie meno:";
    $passwordInput = "Heslo:";
    $registrationBtn = "Registrácia";
    $loginBtn = "Prihlásiť sa";
    
    $header_registracia = "Registrácia";
    $error_prihlasovaci_login_prazdny_hodnota = $error_registracny_login_hodnota = "Nezadané prihlasovacie meno";
    $error_admin_hodnota = "Takýto admin už existuje";
    $error_prihlasovacie_heslo_prazdne_hodnota = $error_registracny_pass_hodnota = "Nezadané heslo";
    $error_opakovane_heslo_hodnota = "Nezadané opakované heslo";
    $error_heslo_hodnota = "Heslá nie sú rovnaké";
    $opakuj_heslo = "Opakuj heslo:";
    $backBtn = "Naspäť";
    $signupBtn = "Zaregistruj sa";
    
    $error_prihlasovaci_login_hodnota = "Zlé prihlasovacie meno";
    $error_prihlasovacie_heslo_hodnota = "Zlé heslo";
    
    $uspesna_registracia_hodnota = "Už si zaregistrovaný, môžeš sa prihlásiť";
}
/*** Koniec casti ***/

try {
    $connect = new PDO("mysql:host={$server}; dbname={$db}; charset=utf8", $user, $pass);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOExpception $e){
    echo $e->getMessage();
}

$string = '<div class="jumbotron vertical-center">';
$string .= '<div style="text-align: center;"><h2>'.$header_prihlasenie.'</h2></div>';
$string .= '<div class="row vertical-align">';
$string .= '<label class="col-xs-5 col-xs-offset-1">';
$string .= $loginInput;
$string .= '</label>';
$string .= '<input id="loginInput" class="col-xs-5 col-xs-offset-0" type="text" name="login">';
$string .= '</div>';
$string .= '<div class="row vertical-align">';
$string .= '<label class="col-xs-5 col-xs-offset-1">';
$string .= $passwordInput;
$string .= '</label>';
$string .= '<input id="passwordInput" class="col-xs-5 col-xs-offset-0" type="password" name="password">';
$string .= '</div>';
$string .= '<div style="text-align: center; margin-top: 20px;">';
$string .= '<input id="registrationBtn" type="button" name="login" class="btn btn-warning" value="'.$registrationBtn.'">';
$string .= '<input type="submit" name="signin" class="btn btn-success" value="'.$loginBtn.'">';
$string .= '</div>';
$string .= '</div>';

if(isset($_POST['signup'])){
    if(isset($_POST['login'], $_POST['password'], $_POST['repeatPassword']) && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['repeatPassword'])){

        $statement = $connect->prepare('SELECT login FROM admins WHERE login = :login');
        $statement->bindParam(":login", $_POST['login']);
        $statement->execute();

        if($statement->rowCount() == 0){
            if($_POST['password'] === $_POST['repeatPassword']){
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' => 12));
                $statement = $connect->prepare('INSERT INTO admins (login, password) VALUES (:login, :password)');
                $statement->bindParam(":login", $_POST['login']);
                $statement->bindParam(":password", $password);
                $statement->execute();
                $uspesna_registracia = true;
                
            } else {
                $error_heslo = true;
            }
        } else {
            $error_admin = true;
        }

    } else {
        if(empty($_POST['login'])){
            $error_registracny_login = true;
        }
        if(empty($_POST['password'])){
            $error_registracny_pass = true;
        }
        if(empty($_POST['repeatPassword'])){
            $error_opakovane_heslo = true;
        }
    }
    
    if(isset($error_registracny_login) || isset($error_admin) || isset($error_registracny_pass) || isset($error_opakovane_heslo) || isset($error_heslo)){
    $string = '<div style="text-align: center;"><h2>'.$header_registracia.'</h2></div>';
        if(isset($error_registracny_login)){
            $string .= '<div class="error">'.$error_registracny_login_hodnota.'</div>';
        } elseif(isset($error_admin)){
            $string .= '<div class="error">'.$error_admin_hodnota.'</div>';
        }
        $string .= '<div class="row vertical-align">';
        $string .= '<label class="col-xs-5 col-xs-offset-1">';
        $string .= $loginInput;
        $string .= '</label>';
        $string .= '<input id="loginInput" class="col-xs-5 col-xs-offset-0" type="text" name="login">';
        $string .= '</div>';
        if(isset($error_registracny_pass)){
            $string .= '<div class="error">'.$error_registracny_pass_hodnota.'</div>';
        }
        $string .= '<div class="row vertical-align">';
        $string .= '<label class="col-xs-5 col-xs-offset-1">';
        $string .= $passwordInput;
        $string .= '</label>';
        $string .= '<input id="passwordInput" class="col-xs-5 col-xs-offset-0" type="password" name="password">';
        $string .= '</div>';
        if(isset($error_opakovane_heslo)){
            $string .= '<div class="error">'.$error_opakovane_heslo_hodnota.'</div>';
        }elseif(isset($error_heslo)){
            $string .= '<div class="error">'.$error_heslo_hodnota.'</div>';
        }
        $string .= '<div class="row vertical-align">';
        $string .= '<label class="col-xs-5 col-xs-offset-1">';
        $string .= $opakuj_heslo;
        $string .= '</label>';
        $string .= '<input id="repeatPasswordInput" class="col-xs-5 col-xs-offset-0" type="password" name="repeatPassword">';
        $string .= '</div>';
        $string .= '<div style="text-align: center; margin-top: 20px;">';
        $string .= '<input id="backBtn" type="button" name="login" class="btn btn-warning" value="'.$backBtn.'">';
        $string .= '<input type="submit" name="signup" class="btn btn-success" value="'.$signupBtn.'"';
        $string .= '</div>';
    } else {
        $string = '<div class="jumbotron vertical-center">';
                $string .= '<div style="text-align: center;"><h2>'.$header_prihlasenie.'</h2></div>';
                $string .= '<div style="text-align: center;"><h3>'.$uspesna_registracia_hodnota.'</h3></div>';
                $string .= '<div class="row vertical-align">';
                $string .= '<label class="col-xs-5 col-xs-offset-1">';
                $string .= $loginInput;
                $string .= '</label>';
                $string .= '<input id="loginInput" class="col-xs-5 col-xs-offset-0" type="text" name="login">';
                $string .= '</div>';
                $string .= '<div class="row vertical-align">';
                $string .= '<label class="col-xs-5 col-xs-offset-1">';
                $string .= $passwordInput;
                $string .= '</label>';
                $string .= '<input id="passwordInput" class="col-xs-5 col-xs-offset-0" type="password" name="password">';
                $string .= '</div>';
                $string .= '<div style="text-align: center; margin-top: 20px;">';
                $string .= '<input id="registrationBtn" type="button" name="login" class="btn btn-warning" value="'.$registrationBtn.'">';
                $string .= '<input type="submit" name="signin" class="btn btn-success" value="'.$loginBtn.'">';
                $string .= '</div>';
                $string .= '</div>';
    }
} elseif(isset($_POST['signin'])){
    if(isset($_POST['login'], $_POST['password']) && !empty($_POST['login']) && !empty($_POST['password'])){
        $statement = $connect->prepare('SELECT login, password FROM admins WHERE login = :login');
        $statement->bindParam(":login", $_POST['login']);

        $statement->execute();

        if($statement->rowCount() == 1){
            $statement->setFetchMode(PDO::FETCH_OBJ);
            while($row = $statement->fetch()){
                if(password_verify($_POST['password'], $row->password)){
                    $_SESSION['login'] = $row->login;
                    header("location: index.php");
                } else {
                    $error_prihlasovacie_heslo = true;
                }
            }
        } else {
            $error_prihlasovaci_login = true;
        }
    } else {
        if(empty($_POST['login'])){
            $error_prihlasovaci_login_prazdny = true;
        }if(empty($_POST['password'])){
            $error_prihlasovacie_heslo_prazdne = true;
        }
        
    }
    $string = '<div class="jumbotron vertical-center">';
        $string .= '<div style="text-align: center;"><h2>'.$header_prihlasenie.'</h2></div>';
        if(isset($error_prihlasovaci_login_prazdny)){
            $string .= '<div class="error col-xs-5 col-xs-offset-0">'.$error_prihlasovaci_login_prazdny_hodnota.'</div>';
        } elseif(isset($error_prihlasovaci_login)){
            $string .= '<div class="error col-xs-5 col-xs-offset-0">'.$error_prihlasovaci_login_hodnota.'</div>';
        }
        $string .= '<div class="row vertical-align">';
        $string .= '<label class="col-xs-5 col-xs-offset-1">';
        $string .= $loginInput;
        $string .= '</label>';
        $string .= '<input id="loginInput" class="col-xs-5 col-xs-offset-0" type="text" name="login">';
        $string .= '</div>';
        if(isset($error_prihlasovacie_heslo_prazdne)){
            $string .= '<div style="float: right; margin-right: 50px;" class="error">'.$error_prihlasovacie_heslo_prazdne_hodnota.'</div>';
        } elseif(isset($error_prihlasovacie_heslo)){
            $string .= '<div style="float: right; margin-right: 50px;" class="error">'.$error_prihlasovacie_heslo_hodnota.'</div>';
        }
        $string .= '<div class="row vertical-align">';
        $string .= '<label class="col-xs-5 col-xs-offset-1">';
        $string .= $passwordInput;
        $string .= '</label>';
        $string .= '<input id="passwordInput" class="col-xs-5 col-xs-offset-0" type="password" name="password">';
        $string .= '</div>';
        $string .= '<div style="text-align: center; margin-top: 20px;">';
        $string .= '<input id="registrationBtn" type="button" name="login" class="btn btn-warning" value="'.$header_registracia.'">';
        $string .= '<input type="submit" name="signin" class="btn btn-success" value="'.$loginBtn.'">';
        $string .= '</div>';
        $string .= '</div>';
        
}

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Log in</title>
        <meta charset="UTF-8">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style-menu.css">
        <link rel="stylesheet" href="css/style.css">

        <style>
            #loginDiv {
                display: table;
                top: 100px;
                border: 1px solid #6ef8ce;
                height: 300px;
                background-color: #dbf5ed;
                border-radius: 5px;
                -webkit-box-shadow: 0px 0px 43px 2px rgba(0, 0, 0, 0.1);
                -moz-box-shadow: 0px 0px 43px 2px rgba(0, 0, 0, 0.1);
                box-shadow: 0px 0px 43px 2px rgba(0, 0, 0, 0.1);
            }
            
            #loginInput,
            #passwordInput,
            #repeatPasswordInput {
                width: 150px;
                margin: 5px 0px 5px 0px;
            }
            
            label {
                font-size: 13px;
                margin: 5px 0px 5px 0px;
            }
            
            body {
              position: absolute;
              height: 100%;
              width: 100%;
            }

            .jumbotron {
               display: table-cell;
               vertical-align: middle;
                background-color: transparent !important;
            }
            
            .error{
                color: red;
                font-size: 12px;
                text-align: right;
                width: 100%;
            }
        </style>
    </head>

    <body class="inner">
      <?php include 'menu.php';
        
        
        ?>
           <form method="post" action="login.php">
            <div id="loginDiv" class="col-xs-4 col-xs-offset-4">
               
                <?php echo $string; ?>
               
            </div>
             </form>
        <script>
            $(document).ready(function(){
                var login_string = "";
                <?php if(isset($_SESSION['lang'])){ 
                            $lang = $_SESSION['lang'];
                        } else {
                            $lang = "sk";
                        }?>
                var string = '<div style="text-align: center;"><h2><?php echo $lang == "sk" ? "Registrácia" : "Sign up"; ?></h2></div>';
                   string +=  '<div class="row vertical-align">';
                   string += '<label class="col-xs-5 col-xs-offset-1">';
                   string += '<?php echo $lang == "sk" ? "Prihlasovacie meno:" : "Login:"; ?>';
                   string += '</label>';
                   string += '<input id="loginInput" class="col-xs-5 col-xs-offset-0" type="text" name="login">';
                   string += '</div>';
                   string += '<div class="row vertical-align">';
                   string += '<label class="col-xs-5 col-xs-offset-1">';
                   string += '<?php echo $lang == "sk" ? "Heslo:" : "Password:"; ?>';
                   string += '</label>';
                   string += '<input id="passwordInput" class="col-xs-5 col-xs-offset-0" type="password" name="password">';
                   string += '</div>';
                   string += '<div class="row vertical-align">';
                   string += '<label class="col-xs-5 col-xs-offset-1">';
                   string += '<?php echo $lang == "sk" ? "Opakuj heslo:" : "Retype password:"; ?>';
                   string += '</label>';
                   string += '<input id="repeatPasswordInput" class="col-xs-5 col-xs-offset-0" type="password" name="repeatPassword">';
                   string += '</div>';
                   string += '<div style="text-align: center; margin-top: 20px;">';
                   string += '<input id="backBtn" type="button" name="login" class="btn btn-warning" value="<?php echo $lang == "sk" ?              "Naspäť" : "Back"; ?>">';
                   string += '<input type="submit" name="signup" class="btn btn-success" value="<?php echo $lang == "sk" ? "Zaregistruj sa" :                 "Sign up"; ?>">';
                   string += '</div>';
                
                $(document).on('click', '#registrationBtn', function(){
                   login_string = $('.jumbotron').html();
                    $('.jumbotron').html(string);
                });
                
                $(document).on('click', '#backBtn', function(){
                    $('.jumbotron').html(login_string);
                });
            });
        </script>
    </body>
<html>