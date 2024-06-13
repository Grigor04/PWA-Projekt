<?php
// Database configuration
$host = "localhost"; // MySQL server hostname
$username = "root"; // MySQL username
$password = ""; // MySQL password
$database = "!excelumnovi"; // MySQL database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve data
$sql = "SELECT * FROM obavijesti ORDER BY pozicija ASC";
$result = $conn->query($sql);

// Initialize an empty string to store HTML content
$htmlContent = "";
$karoserija = "";

$provjera = 0;

$variable = 'active';

$brojac = 0;



// Check if there are any rows returned
if ($result->num_rows > 0) {
	$luka = 'col-lg-7';
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // You can access other columns similarly
		
		if ($row["pozicija"] > 0){
			
			$brojac = $brojac + 1;
	
        if ($provjera > 0) {
            $variable = "";
			}

            $karoserija .= "<div class='carousel-item $variable' style='background: #edeae0;'>" .
            "<div class='row d-flex '>" .
            "<div class='col-1'>" .
            "</div>".
            "<div class='col-6'>" .
            "<img src='admin.excelum.hr/" . $row["slika"] . "' alt='" . $row["alt_slike"] . "' name='" . $row["ime_slike"] . "' class='img-fluid rounded p-2'>" .
            "</div>".

           

            "<div class='col-4 pt-4 pb-4 .d-md-block .d-none text-left ' style='font-family: Montserrat, sans-serif; font-weight: Bold; text-align: left; padding-left:0 !important;'>" .
            "<h3 id='obavijest-text-mobile' class='font-weight-bold' style='font-family: Montserrat, sans-serif; font-weight: 700; font-size:20px;' >" . $row["naslov"] . "</h3><br>" .
            "<a class='gumbek' id='obavijest-gumb-mobile' href='" . $row["link"] . "' style='padding:10px !important; margin: 0px !important; font-size: 12px;'>Saznajte više</a>" .
            "</div>".

         

           
            "</div>".
            "</div>";

            $provjera = 1;
			
		}
    }
	
	if($brojac > 0){
	
	$htmlContent .= "<div class='col-12 col-lg-5'>" .
 
                    "<div id='carouselExampleDark' class='carousel rounded-4 carousel-dark slide' data-bs-ride='carousel'>" .
/*                         "<div class='carousel-indicators'>" .
                          "<button type='button' data-bs-target='#carouselExampleDark' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide 1'></button>" .
                          "<button type='button' data-bs-target='#carouselExampleDark' data-bs-slide-to='1' aria-label='Slide 2'></button>" .
                          "<button type='button' data-bs-target='#carouselExampleDark' data-bs-slide-to='2' aria-label='Slide 3'></button>" .
                        "</div>" . */
                        
                        "<div class='carousel-inner'>" .
						" $karoserija " .
                        "</div>" .
                        "<button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleDark' data-bs-slide='prev'>" .
                          "<span class='carousel-control-prev-icon' aria-hidden='true'></span>" .
                          "<span class='visually-hidden'>Previous</span>" .
                        "</button>" .
                        "<button class='carousel-control-next' type='button' data-bs-target='#carouselExampleDark' data-bs-slide='next'>" .
                          "<span class='carousel-control-next-icon' aria-hidden='true'></span>" .
                          "<span class='visually-hidden'>Next</span>" .
                        "</button>" .
                      "</div>" .
                     
                    "</div>";
					
	}else{
		$luka = 'col-md-12';
	}
	
} else {
    $luka = 'col-md-12';
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

  <head>
  <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="53f11f58-265e-4cb2-979f-629b2cdec3cd" data-blockingmode="auto" type="text/javascript"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">
	<link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Home</title>
	
	<meta name="google-site-verification" content="RzPm56YBlWiKr-tmX15EZZPgZRf6TDovTOpOrJv-Po4" />

    <!-- Additional CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-softy-pinko.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


    <script src="https://kit.fontawesome.com/f51814c8d1.js" crossorigin="anonymous"></script>
    </head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-8JZ4S5F5S1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
    
        gtag('config', 'G-8JZ4S5F5S1');
    </script>

	
<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
.carousel-control-next{
    margin-right:-3%;
}
.carousel-control-prev{
    margin-left:-3%;
}
@media only screen and (max-width: 720px) {
    #obavijest-text-mobile{
    font-size:15px !important;
}
    #obavijest-gumb-mobile{
    font-size: 10px !important;
}
}

</style>
    
    <body>

        <div id="preloader">
            <div class="jumper">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="#" class="logo">
                            <img src="assets/Excelum.png" style="width:150px;" alt="Excelum"/>
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="#" class="active">Home</a></li>
                            <!-- <li><a href="about.html">O nama</a></li> -->
                            <li><a href="edukacije">Edukacije</a></li>
                            <li><a href="blog">Blog</a></li>

                            <li><a href="kontakt">Kontakt</a></li>
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

    <!-- ***** Welcome Area Start ***** -->
    <div class="welcome-area" id="welcome">
        <video autoplay muted loop id="myVideo">
            <source src="assets/images/video5.mp4" type="video/mp4">
          </video>
        <!-- ***** Header Text Start ***** -->
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <!-- <div class="offset-xl-3 col-xl-6 offset-lg-2 col-lg-6 col-md-6 col-sm-12"> -->
                        <!-- <h1 style="font-weight: bold;">Dobrodošli u svijet Exceluma!</h1> -->
                        <!-- <p>Iskoristite bogato iskustvo i znanje naših edukatora. -->
                           <!-- <br> Pogledajte što vam nudimo: -->
                     <!-- </p> -->
                        <!-- <a href="#features" class="main-button-slider">Pogledaj ponudu</a> -->
                    <!-- </div> -->
					<div class="col-12 <?php echo $luka; ?> justify-content-center align-self-center">
                        <h1 style="font-weight: bold;">Dobrodošli u svijet Exceluma!</h1>
                        <p>Iskoristite bogato iskustvo i znanje naših edukatora.
                           <br> Pogledajte što vam nudimo:
                     </p>
                        <!-- <a href="#features" class="main-button-slider">Pogledaj ponudu</a> -->
                    </div>
					<?php echo $htmlContent; ?>
                    
                    
					
                </div>
            </div>
        </div>
        <!-- ***** Header Text End ***** -->
    </div>
    <!-- ***** Welcome Area End ***** -->

    <!-- ***** Features Small Start ***** -->
    <section class="section home-feature">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <!-- ***** Features Small Item Start ***** -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="features-small-item" style="background-color: #EDEAE0;">
                                <h5 class="features-title" style="color: #266544; font-weight: bold;">Edukacije</h5>
                                <p style="color: #266544; font-weight: 500;">Razvijte svoje Microsoft Office i Power Platform vještine</p>
                                <div class="">
									<button class="gumbek" onclick="window.location.href='edukacije'">Saznajte više</button>
                                    <!-- <i><img src="assets/images/featured-item-01.png" alt=""></i> -->
                                </div>
                                
                            </div>
                        </div>
                        <!-- ***** Features Small Item End ***** -->

                        <!-- ***** Features Small Item Start ***** -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="features-small-item" style="background-color: #EDEAE0">
                                <h5 class="features-title" style="color: #266544; font-weight: bold;">Konzulting</h5>
                                <p style="color: #266544; font-weight: 500;">Vaš partner pri optimizaciji i digitalizaciji poslovanja</p>
                                <div class="">
								<button class="gumbek" href="edukacije">Saznajte više</button>
                                    <!-- <i><img src="assets/images/featured-item-01.png" alt=""></i> -->
                                </div>
                                
                            </div>
                        </div>
                        <!-- ***** Features Small Item End ***** -->

                        <!-- ***** Features Small Item Start ***** -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="features-small-item" style="background-color: #EDEAE0">
                                <h5 class="features-title" style="color: #266544; font-weight: bold;">Gotova rješenja</h5>
                                <p style="color: #266544; font-weight: 500;">Izrada aplikacija, ecommerce rješenja i marketing content paketi</p>
                                <div class="">
								<button class="gumbek" href="edukacije">Saznajte više</button>
                                    <!-- <i><img src="assets/images/featured-item-01.png" alt=""></i> -->
                                </div>
                                
                            </div>
                        </div>
                        <!-- ***** Features Small Item End ***** -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Small End ***** -->

    <!-- ***** Features Big Item Start ***** -->
    <section class="section padding-top-70 padding-bottom-0" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 align-self-center">
                    <img src="assets/images/docilja.png" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-6 col-md-12 col-sm-12 align-self-center mobile-top-fix">
                    <div class="left-heading">
                        <h2 class="section-title" style="font-weight: bold;">Dođimo do cilja zajedno</h2>
                    </div>
                    <div class="left-text">
                        <p>Bogatstvo edukacija, stručna konzultiranja i digitalizacija, kvalitetna digitalna rješenja, samo su dio profesionalne ponude Excelum usluga. <br>
                            Naš primarni cilj je ostvarenje Vašeg cilja. Unaprijedite svoje poslovanje brzo, kvalitetno i povoljno.
                            </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="hr"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->

    <!-- ***** Features Big Item Start ***** -->
    <section class="section padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 align-self-center mobile-bottom-fix">
                    <div class="left-heading">
                        <h2 class="section-title" style="font-weight: bold;">Vaš predavač</h2>
                    </div>
                    <div class="left-text">
                        <p>Dennis Ramulić magistar je edukacije matematike i fizike s desetak godina iskustva u obrazovnom sustavu i privatnom sektoru, gdje se uz karijeru razvija u stručnjaka za agilne, Lean i Kaizen metodologije rada. Iskustvo rada stekao je ponajviše u financijama, nabavi, upravljanju zalihom te poslovnim procesima, dok se zadnjih nekoliko godina bavi digitalizacijom poslovanja, razvojem RPA rješenja te uvođenjem naprednih analitičkih metoda u poslovanje. 
                            Iskustvo u obrazovanju ostavilo je svoj utjecaj pa se danas bavi educiranjem u nekoliko edukacijskih centara, a specijalnost su mu MS Excel, Power Platforma (Power BI, Automate i Apps), ostale Office 365 aplikacije te digitalizacija poslovanja, podatkovna analitika, Lean, BPM i RPA.
                            </p>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-5 col-md-12 col-sm-12 align-self-center mobile-bottom-fix-big">
                    <img src="assets/images/vaspredavac.png" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->

    <!-- ***** Home Parallax Start ***** -->
    <section class="mini" id="work-process">
        <div class="mini-content">
            <div class="container">
               
                        
                            <div class="row">
                                <div class="col-md-6 col-12 text-center mb-4"><h1>Izdvojeno iz ponude</h1></div>
                                <div class="col-md-6 col-12 text-left pt-3"><p>Otkrijte naše najpopularnije edukacije</p></div>
                            </div>
                            
                        
                   

                <!-- ***** Mini Box Start ***** -->
                <div class="row">

                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                        <a href="https://excelum.hr/excelum-edukacije/microsoft-word-osnovna-razina" class="mini-box">
                            <i><img src="assets/images/office-slider.png" alt=""></i>
                            <strong>MS Office edukacije</strong>
                            <span>Edukacije podijeljene u 2 razine: osnovni i napredni</span>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                        <a href="https://excelum.hr/excelum-edukacije/power-apps-osnovna-razina" class="mini-box">
                            <i><img src="assets/images/powerapps-slider.png" alt=""></i>
                            <strong>Power Apps edukacije</strong>
                            <span>Edukacije podijeljene u 2 razine: osnovni i napredni</span>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                        <a href="https://excelum.hr/excelum-edukacije/excel-osnovna-razina" class="mini-box">
                            <i><img src="assets/images/excel-slider.png" alt=""></i>
                            <strong>Excel edukacije</strong>
                            <span>Edukacije podijeljene u 3 razine: osnovni, napredni i ekspertni</span>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                        <a href="https://excelum.hr/excelum-edukacije/power-bi-osnovna-razina" class="mini-box">
                            <i><img src="assets/images/powerbi-slider.png" alt=""></i>
                            <strong>PowerBI edukacije</strong>
                            <span>Edukacije podijeljene u 3 razine: osnovni, napredni i ekspertni</span>
                        </a>
                    </div>

                </div>
                <!-- ***** Mini Box End ***** -->
            </div>
        </div>
    </section>
    <!-- ***** Home Parallax End ***** -->

    <!-- ***** Testimonials Start ***** -->
    
    <!-- ***** Testimonials End ***** -->

    <!-- ***** Counter Parallax Start ***** -->
    <!-- <section class="counter"> -->
        <!-- <div class="content"> -->
            <!-- <div class="container"> -->
                <!-- <div class="row"> -->
                    <!-- <div class="col-lg-3 col-md-6 col-sm-12"> -->
                        <!-- <div class="count-item decoration-bottom"> -->
                            <!-- <strong>126</strong> -->
                            <!-- <span>Projekata</span> -->
                        <!-- </div> -->
                    <!-- </div> -->
                    <!-- <div class="col-lg-3 col-md-6 col-sm-12"> -->
                        <!-- <div class="count-item decoration-top"> -->
                            <!-- <strong>63</strong> -->
                            <!-- <span>Zadovoljnih klijenata</span> -->
                        <!-- </div> -->
                    <!-- </div> -->
                    <!-- <div class="col-lg-3 col-md-6 col-sm-12"> -->
                        <!-- <div class="count-item decoration-bottom"> -->
                            <!-- <strong>18</strong> -->
                            <!-- <span>Nagrada</span> -->
                        <!-- </div> -->
                    <!-- </div> -->
                    <!-- <div class="col-lg-3 col-md-6 col-sm-12"> -->
                        <!-- <div class="count-item"> -->
                            <!-- <strong>27</strong> -->
                            <!-- <span>Tečajeva</span> -->
                        <!-- </div> -->
                    <!-- </div> -->
                <!-- </div> -->
            <!-- </div> -->
        <!-- </div> -->
    <!-- </section> -->
    <!-- ***** Counter Parallax End ***** -->   
    
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
     <!-- Bootstrap -->
    <!--<script src="assets/js/popper.js"></script>-->
    
    
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>