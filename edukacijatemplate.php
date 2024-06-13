<!DOCTYPE html>
<html lang="hr">

  <head>

    <meta meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo $meta_description; ?>">
    <meta name="author" content="<?php echo $meta_author; ?>">
    <meta name="robots" content="<?php echo $meta_robots_indexing; ?>, <?php echo $meta_robots_following; ?>">
    <meta property="og:title" content="<?php echo $og_title; ?>">
    <meta property="og:description" content="<?php echo $og_description; ?>">
    <meta property="og:url" content="<?php echo $og_url; ?>">
    <meta property="og:image" content="<?php echo $og_image; ?>">
    <meta property="og:type" content="<?php echo $og_type; ?>">
    <?php echo $kanonski; ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">

    <title><?php echo $naslov; ?></title>
	
	<meta name="keywords" content="<?php echo $penis; ?>">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">

    <link rel="stylesheet" href="../assets/css/templatemo-softy-pinko.css">
	
<script src="https://kit.fontawesome.com/f51814c8d1.js" crossorigin="anonymous"></script>

<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
    </script>

<style>
        .accordion {
            margin: 15px;
        }
        .accordion .fa {
            margin-right: 0.2rem;
        }
        .listica1 > li {
padding-left: 5%;
  margin: 0;
  list-style: disc;
  list-style-position: inside;
}

    </style>

<script>
        $(document).ready(function () {
            // Add minus icon for collapse element which
            // is open by default
            $(".collapse.show").each(function () {
                $(this).prev(".card-header").find(".fa")
                    .addClass("fa-minus").removeClass("fa-plus");
            });
            // Toggle plus minus icon on show hide
            // of collapse element
            $(".collapse").on('show.bs.collapse', function () {
                $(this).prev(".card-header").find(".fa")
                    .removeClass("fa-plus").addClass("fa-minus");
            }).on('hide.bs.collapse', function () {
                $(this).prev(".card-header").find(".fa")
                    .removeClass("fa-minus").addClass("fa-plus");
            });
        });
    </script>
    </head>
	
	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8JZ4S5F5S1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-8JZ4S5F5S1');
</script>
    
    <body>
    
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="http://excelum.hr" class="logo">
                            <img src="../assets/Excelum.png" style="width:150px;" alt="Excelum"/>
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="http://excelum.hr">Home</a></li>
                            <!-- <li><a href="about.html">O nama</a></li> -->
                            <li><a href="../edukacije"  class="active">Edukacije</a></li>
                            <li><a href="../blog">Blog</a></li>
							<li class="d-lg-none"><a href="../blog.html">Excelum marketing</a></li>
							<li class="d-lg-none"><a href="../blog.html">Konzulting</a></li>
							<li class="d-lg-none"><a href="../blog.html">Ostale usluge</a></li>
							<li class="dropdown d-none d-lg-block">
							<div class="dropdown">
							<a class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" >Ostalo</a>	
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<li><a class="dropdown-item" href="excelum-marketing.hr">Excelum marketing</a></li>
								<li><a class="dropdown-item" href="#">Konzulting</a></li>
								<li><a class="dropdown-item" href="#">Ostale usluge</a></li>
							</ul>
							</div>
							</li>

                            <li><a href="../kontakt">Kontakt</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
<br>

    <!-- ***** Blog Start ***** -->
    <section class="section" id="blog">
        <div class="container">
            <!-- ***** Section Title Start ***** -->
			<div class="col-lg-12" style="background-color: #F7F7F7; border-radius:15px; padding: 20px;">
            <div class="row" style="padding:25px;">
                <div class="col-lg-12">
                    <div class="center-heading">
                        <h1 class="section-title"><?php echo $naslov; ?></h1>
                    </div>
                </div>
                        <p>
						<?php echo $dugi_opis; ?>
						</p>
				<br>
            </div>
            <!-- ***** Section Title End ***** -->

</div>

			<div class="accordion">
        <h2 style="padding: 15px;">
            Sadržaj edukacije
        </h2>
        
 
        <div class="accordion" id="accordionExample">
            <?php echo $accordionHTML; ?>
    </div>
	
	<div class="col-lg-12" style="background-color: #F7F7F7; border-radius:15px; padding: 20px;">
            <!-- ***** Section Title End ***** -->
			
		
			
			<h2 style="padding: 15px;">
            Ciljevi:
        </h2>
			
	<ul class="listica">
 <?php echo $ciljeviHTML; ?>
</ul>
</div>
<div class="info">
    <div class="kutijica col-lg-5">
        <h2 class="cijena" style="font-weight:bold;padding: 15px;">
                    Cijena:
                </h2>
                
        <h3><?php echo $cijena; ?></h3>
        </div>
        <div class="kutijica col-lg-5">
        <h2 style="font-weight:bold;padding: 15px;">
                    Trajanje:
                </h2>
                
        <h3><?php echo $trajanje; ?></h3>
        </div>
		
        </div>
		<div class="row">
		<div class="col-sm-5 col-12">
		<?php echo $tagoviedu; ?>
		</div>
        </div>
		
        <div class="kraj col-lg-4" style="text-align: center; margin: 0 auto !important"><button class="gumbek" onclick="window.location.href='../edukacije-prijava'">Prijavi se</button></div>


                
            </div>
        </div>
    </section>
    <!-- ***** Blog End ***** -->
    
    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <ul class="social">
                        <li><a href="https://www.facebook.com/Excelum" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/excelum1/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="https://www.youtube.com/channel/UCy0OhNdo3KduTWuewArb4nw" target="_blank"><i class="fa fa-youtube"></i></a></li>
                        <li><a href="https://www.instagram.com/excelumedukacije/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="https://www.tiktok.com/@excelum" target="_blank"><i class="fa-brands fa-tiktok"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p class="copyright">Copyright &copy; 2023 Excelum.hr - Design: Excelum Marketing Team</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- jQuery -->
    <script src="../assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="../assets/js/scrollreveal.min.js"></script>
    <script src="../assets/js/waypoints.min.js"></script>
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <script src="../assets/js/imgfix.min.js"></script> 
    
    <!-- Global Init -->
    <script src="../assets/js/custom.js"></script>

  </body>
</html>