<?php
header('Content-Type: text/html; charset=UTF-8');
include 'funkcije.php';
// Database configuration
$host = "localhost"; // MySQL server hostname
$username = "root"; // MySQL username
$password = ""; // MySQL password
$database = "!excelumnovi"; // MySQL database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);
$conn->set_charset("utf8mb4");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve data
$sql = "SELECT * FROM blog";
$result = $conn->query($sql);

// Initialize an empty string to store HTML content
$htmlkontent = "";
$karoserija = "";

$provjera = 0;

$pimpek = 'active';

$counter=0;
$pinano="";

$brojac = 0;
$htmlkontent2 = "";
// Check if there are any rows returned

$tagoviblog = "";
//
$myArr = array(); // Initialize an empty array

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Create an inner array with row contents and add it to $myArr
        $myArr[] = array($row["naslov"], $row["sadrzaj"], $row["slika"], $row["datum"], $row["kategorija"], $row["id"], $row["hidden"]);
    }
}


$result->data_seek(0);

if ($result->num_rows > 0) {
    $htmlkontent .= "<div class='row' style='margin:0!important;padding:0!important;'>";
	
	// $htmlkontent .= "<div class='card-deck'>";
    // Output data of each row
    while ($row = $result->fetch_assoc()) {

        
		$formatted_text_first = str_replace(' ', '-', $row["naslov"]);
        $formatted_text = strtolower($formatted_text_first);
        // KRAJ KREIRANJA FAJLAs
        
        if ($row["hidden"] < 1) {
            $truncated_sadrzaj = strlen($row["sadrzaj"]) > 180 ? substr($row["sadrzaj"], 0, 180) . "..." : $row["sadrzaj"];
            
            $htmlkontent .= "<div class='col-md-4 col-12 blog-item " . $row["kategorija"] . "' data-category='" . $row["kategorija"] . "' style='margin-bottom:2%;'>
						<div class='card {$row["kategorija"]}'>
                      <img src='admin.excelum.hr/{$row["slika"]}' class='card-img-top img-fluid' alt='Card image cap' style='height:200px; width:auto; object-fit:none;'>
                      <div class='card-body text-start'>
                        <p class='card-text'>{$row["datum"]}</p>
                        <h5 class='card-title fw-bold'>{$row["naslov"]}</h5>
                        <p class='card-text'>{$truncated_sadrzaj}</p>
                        <a href='blogovi/{$formatted_text}' class='stretched-link'></a>
                      </div>
					  </div>
                    </div>";


        }

		// POCETAK KREIRANJE FAJLA
		
		$tagoviblog = "";
		
		$birtija = "";
		
		$cntr = 0;
		
		kreirajBlogove("obican");
		
		
        if($cntr==0){
            $birtija = "Nema drugih blogova u ovoj kategoriji, pogledajte ostale!";
        }
		$cntr = 0;
		
		
        // You can access other columns similarly
        if ($provjera > 0) {
            $pimpek = "";
        }
        if ($row["pinned"] > 0 && $row["hidden"] < 1) {
            $truncated_sadrzaj_carousel = strlen($row["sadrzaj"]) > 180 ? substr($row["sadrzaj"], 0, 180) . "..." : $row["sadrzaj"];

            $karoserija .= "<div class='carousel-item $pimpek' id='karos' style='width:100%;'>" .
                "<a href='blogovi/{$formatted_text}'>".
                "<img class='d-block w-100 img-fluid' src='admin.excelum.hr/" . $row["slika"] . "' alt='First slide'>" .
                "<div class='transparent-box'>" .
                "<p>" . $row["datum"] . "</p>" .
                "<h2>" . $row["naslov"] . "</h2>" .
                "<p>" . $truncated_sadrzaj_carousel . "</p>" .
                "</div>" .
                "</a>" .
                "</div>";
            $provjera = 1;
            $counter++;
        }


    }

    if($counter===0){
        $pinano="style='display:none;'";
    }
    $htmlkontent .= "</div>";
	// $htmlkontent .= "</div>";
} else {
    $htmlkontent = "0 results";
}




$sql = "SELECT * FROM kategorije_blogovi";
$result = $conn->query($sql);

$kategorije = "";

$kategorije_array = array(); // Initialize an array to store categories

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $ime_kategorije = $row["ime"];
		
		$kategorije_array[] = $row["ime"]; // Add category to the array

        $kategorije .= "<option value='" . $row["ime"] . "'>" . $ime_kategorije . "</option>";
		
		

    }
} else {
    $edukacije = "0";
}
// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">



<head>

    <meta meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">

    <title>Blog</title>

    <!-- Additional CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-softy-pinko.css">

    <script src="https://kit.fontawesome.com/f51814c8d1.js" crossorigin="anonymous"></script>


    <style>
        
        footer {
            background-image: linear-gradient(127deg, #a759d1 0%, #7cdbbc 91%);
            padding-top: 30px;
            position: sticky;
            top: 100%;
        }


        .transparent-box {
            position: absolute;
            bottom: 0;
            left: 0;
            width:50%;
            height: 15rem;
            background: rgba(255, 255, 255, 0.9);
            /* Adjust transparency as needed */
            color: black;
            padding: 10px;
            border-top-right-radius: 20px;
        }
		
		.blog-item a{
			text-decoration: none !important;
		}


        @media only screen and (max-width: 720px) {
            #karos{
                height: 100% !important;
                
            }

            .transparent-box {
                font-size: 100%;
                position: relative;
                width: 100%;
                height: 100%;
                background: #7cdbbc;
                border-top-right-radius: 0px;
                color: white;
                padding: 10px;
            }

            .text-center-mobile {
                display: inline-block;
            }

            .desktop {
                display: none;
            }

            #firstm {
                font-size: 300%;
                text-align: center;
            }

            #secondm {

                font-size: 100%;
                text-align: center;
                padding-top: 1%;
            }

        }

        

        @media only screen and (min-width: 720px) {
            #karos{
                height:25vw !important;
            }
            .text-center-mobile {
                display: none;
            }
			
			.carousel-control-prev {
  margin-left: -10% !important;
}

.carousel-control-next {
  margin-right: -10% !important;
}
        }

        .headingmain {
            text-align: center;
        }

        .larger {
            font-size: 250%;
            font-weight: bold;
        }

        #first {
            font-size: 300%;

        }

        #second {
            font-size: 100%;
            text-align: left;
            padding-top: 1%;
        }
		
		
    </style>

</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8JZ4S5F5S1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'G-8JZ4S5F5S1');
</script>

<body>

    <!-- ***** Preloader Start ***** -->
    <!--<div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>-->
    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="../public_html" class="logo">
                            <img src="assets/Excelum.png" style="width:150px;" alt="Excelum" />
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="../public_html">Home</a></li>
                            <!-- <li><a href="about.html">O nama</a></li> -->
                            <li><a href="edukacije">Edukacije</a></li>
                            <li><a href="blog" class="active">Blog</a></li>

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
    <br>

    <!-- ***** Blog Start ***** -->
    <section class="section" id="blog">
        <div class="container">



            

        <div class="mt-3 text-center desktop">
      <span id="first">Excelum blog |</span>
    <span class="text-break" style="display: inline-block; width:30%;" id="second">Pratite novosti vezane uz Excelum i aktualnosti u IT svijetu</span>
    </div>

	<div class="mt-3 text-center-mobile">
      <span id="firstm" style="display: inline-block; width:100%;">Excelum blog</span>
    <span class="text-breakm" style="display: inline-block; width:100%;" id="secondm">Novosti vezane uz Excelum i IT svijet</span>
    </div>

                    <div id="carouselExampleDark" class="carousel carousel-dark slide" <?php echo $pinano; ?> data-bs-ride="carousel"
                    style="padding-top:25px;">
                        <div class="carousel-indicators">
                          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                          
                          <?php echo $karoserija; ?>
                            
                          </div>
                        
                        
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>

            <!--<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                    <php echo $karoserija; ?>
                </div>
                        
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>-->


            <div class="container-fluid text-center">
                <div class="row pt-5 pb-5 d-flex justify-content-center">
                    <div class="col-md-4 col-12">

                        <select class="custom-select form-select-lg mb-3" id="category" name="category" onchange='filterData()'>
                            <option value="showAll" selected>Prikaži sve</option>
                            <?php echo $kategorije; ?>
                        </select>

                    </div>
                </div>



                
                    <?php echo $htmlkontent; ?>
                


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
                        <li><a href="https://www.facebook.com/Excelum" target="_blank"><i
                                    class="fa fa-facebook"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/excelum1/" target="_blank"><i
                                    class="fa fa-linkedin"></i></a></li>
                        <li><a href="https://www.youtube.com/channel/UCy0OhNdo3KduTWuewArb4nw" target="_blank"><i
                                    class="fa fa-youtube"></i></a></li>
                        <li><a href="https://www.instagram.com/excelumedukacije/" target="_blank"><i
                                    class="fa fa-instagram"></i></a></li>
                        <li><a href="https://www.tiktok.com/@excelum" target="_blank"><i
                                    class="fa-brands fa-tiktok"></i></a></li>
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
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	
	<script>
    var kategorije = <?php echo json_encode($kategorije_array); ?>;

    function filterData() {
		
        var selectedCategory = document.getElementById('category').value;
        var blogItems = document.getElementsByClassName('blog-item');
		console.log(selectedCategory);
		console.log("----");
		console.log(blogItems.length);
        for (var i = 0; i < blogItems.length; i++) {
            var currentItem = blogItems[i];
            var itemCategory = currentItem.dataset.category; // Assuming you have data-category attribute on each blog item
				// console.log(itemCategory);
            if (selectedCategory === 'showAll' || selectedCategory === itemCategory) {
                currentItem.style.display = 'block';
            } else {
                currentItem.style.display = 'none';
            }
        }
    }
	</script>


</body>

</html>