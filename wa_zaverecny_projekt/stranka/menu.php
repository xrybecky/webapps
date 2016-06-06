<?php
	session_start();
	
	// prepinac jazykoveho rozhrania
	if ($_GET['lang']) {
		if ($_GET['lang'] == 'sk') {
			$_SESSION["lang"] = 'sk';
		} else if ($_GET['lang'] == 'en') {
			$_SESSION["lang"] = 'en';
		}
	}
	
	// nacitanie nastaveneho jazyka
	if ($_SESSION["lang"]) {
		$lang = $_SESSION["lang"];
	} else {
		$lang = "sk";
	}
	
	// nastavenie stringov poloziek menu
	$menu["header"]["sk"] = "Projektové zadanie WEBTE2";
	$menu["header"]["en"] = "Project WEBTE2";
	$menu["home"]["sk"] = "Domov";
	$menu["home"]["en"] = "Home";
	$menu["app"]["sk"] = "Aplikácia";
	$menu["app"]["en"] = "Application";
	$menu["serv"]["sk"] = "Služby";
	$menu["serv"]["en"] = "Services";
	$menu["news"]["sk"] = "Aktuality";
	$menu["news"]["en"] = "News";
	$menu["tech"]["sk"] = "Technická správa";
	$menu["tech"]["en"] = "Technical report";
	$menu["cont"]["sk"] = "Kontakt";
	$menu["cont"]["en"] = "Contact";
	$menu["login"]["sk"] = "Prihlásiť sa (Admin)";
	$menu["login"]["en"] = "Log in (Admin)";
	$menu["logout"]["sk"] = "Prihlásený";
	$menu["logout"]["en"] = "Logged as";
	
	$menu["stats"]["sk"] = "Štatistika";
	$menu["stats"]["en"] = "Statistics";
	
	$menu["serv"][0] = "REST API";
	$menu["serv"][1] = "JSON-RPC API";
	
	$page = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
?>
		
		<script>
			$(document).ready(function () {
				$('.dropdown-toggle').dropdown();
			});
		</script>
		
		<nav class="navbar navbar-default navbar-fixed-top">
		  <div class="container-fluid">

			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="index.php"><?php echo $menu['header'][$lang]; ?></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav">
				<li class="<?php if ($page[count($page)-1] == 'index.php') echo 'active'; ?>">
					<a href="index.php">
						<img src="imgs/ic_home.png" height="24" width="24" alt="ic_home"/>
						<?php echo $menu['home'][$lang]; ?>
						<span class="sr-only">(current)</span>
					</a>
				</li>
				<li class="<?php if ($page[count($page)-1] == 'aplikacia.php') echo 'active'; ?>">
					<a href="aplikacia.php">
						<img src="imgs/ic_app.png" height="24" width="24" alt="ic_home"/>
						<?php echo $menu['app'][$lang]; ?>
					</a>
				</li>
				<li class="dropdown <?php if ($page[count($page)-1] == 'rest.php' || $page[count($page)-1] == 'jsonRPCDesc.php') echo 'active'; ?>">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">		<img src="imgs/ic_serv.png" height="24" width="24" alt=""/>
						<?php echo $menu['serv'][$lang]; ?>
						<span class="caret"></span>
				  </a>
				  <ul class="dropdown-menu">
					<li><a href="rest.php"><?php echo $menu['serv'][0]; ?></a></li>
					<li><a href="jsonRPCDesc.php"><?php echo $menu['serv'][1]; ?></a></li>
				  </ul>
				</li>
				<li class="<?php if ($page[count($page)-1] == 'aktuality.php') echo 'active'; ?>">
					<a href="aktuality.php">
					<img src="imgs/ic_news.png" height="24" width="24" alt=""/>
					<?php echo $menu['news'][$lang]; ?>
					</a>
				</li>
				<li class="<?php if ($page[count($page)-1] == 'tech.php') echo 'active'; ?>">
					<a href="tech.php">
					<img src="imgs/ic_tech2.png" height="24" width="24" alt=""/>
					<?php echo $menu['tech'][$lang]; ?>
					</a>
				</li>
				<li class="<?php if ($page[count($page)-1] == 'kontakt.php') echo 'active'; ?>">
					<a href="kontakt.php">
					<img src="imgs/ic_contact.png" height="24" width="24" alt=""/>
					<?php echo $menu['cont'][$lang]; ?>
					</a>
				</li>
			  </ul>
			
		
			  <ul class="nav navbar-nav navbar-right">
				
				<?php if (isset($_SESSION['login'])) {?>
					<li>
						<a href="logout.php">
							<img src="imgs/ic_sec.png" height="24" width="24" alt=""/>
							<?php echo $menu['logout'][$lang] . " (".$_SESSION['login'].")"; ?>
						</a>
					</li>
				<?php } else {?>
					<li>
						<a href="login.php">
							<img src="imgs/ic_sec.png" height="24" width="24" alt=""/>
							<?php echo $menu['login'][$lang]; ?>
						</a></li>
				<?php }?>
			  </ul>
			  <ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['login'])) {?>
						<li>
							<a href="location.php">
								<img src="imgs/ic_stats.png" height="24" width="24" alt=""/>
								<?php echo $menu['stats'][$lang]; ?>
							</a>
						</li>
				<?php } ?>
			  </ul>
			  
			  <ul class="nav navbar-nav navbar-right">
				<li>
					<a href="<?php 
							if ($lang == 'sk')
								echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '?lang=en';
							if ($lang == 'en')
								echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '?lang=sk';
						?>">
						<img id="lang_icon" height="20" width="20" alt="language icon" src="imgs/<?php echo $lang == "sk" ? 'en' : 'sk'; ?>.png">
					</a>
				</li>
			  </ul>
			</div><!-- /.navbar-collapse -->
			
		  </div><!-- /.container-fluid -->
		</nav>

