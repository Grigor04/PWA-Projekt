<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
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
$sql = "SELECT * FROM edukacije";
$result = $conn->query($sql);

// Initialize an empty string to store HTML content
$kategorije = "";

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
		
		$formatirano = str_replace(' ', '-', $row["ime"]);
		
        $kategorije .= '<option value="' . $formatirano . '">' . $row["ime"] . '</option>';
    }
} else {
    $kategorije = "0 results";
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">

    <title>Edukacije prijava</title>
	
	<style>
select {
  background-color: #f4f7fb;
  height: 40px;
  border: none;
  width: 100%;
  margin-bottom: 20px !important;
}

	#contact-us {
    padding: 230px 0px !important;
}
	body, html {
	bottom:0;
	}
	
	</style>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-softy-pinko.css">
<script src="https://kit.fontawesome.com/f51814c8d1.js" crossorigin="anonymous"></script>

<script>
 
function toggleFields() {
  var selectOption = document.getElementById("selectOption");
  var option1Fields = document.getElementById("option1Fields");
  var option2Fields = document.getElementById("option2Fields");

  if (selectOption.value == "poslovno") {
    option2Fields.style.display = "block";
    option1Fields.style.display = "none";
  } else if (selectOption.value == "privatno") {
    option2Fields.style.display = "none";
    option1Fields.style.display = "block";
  }
}

document.getElementById("privatno").addEventListener("click", function() {
  document.getElementById("selectOption").value = "privatno";
  toggleFields();
});

document.getElementById("poslovno").addEventListener("click", function() {
  document.getElementById("selectOption").value = "poslovno";
  toggleFields();
});



function Funkcija(){
let html = "";
const employeeFormsContainer = document.getElementById("employee-forms");
const employeeCountDropdown = document.getElementById("employee-count");
const employeeCount = employeeCountDropdown.value;
for (let i = 0; i < employeeCount; i++) {
      html += `
        <label for="employee-${i}-name">Ime i prezime ${i + 1}. zaposlenika:</label>
        <input type="text" id="employee-${i}-name" name="zaposlenik-${i+1}-ime-prezime">
        
        <label for="employee-${i}-surname">Email ${i + 1}. zaposlenika:</label>
        <input type="text" id="employee-${i}-surname" name="zaposlenik-${i+1}-email">
		
		<label for="employee-${i}-surname">Broj mobitela ${i + 1}. zaposlenika:</label>
        <input type="text" id="employee-${i}-mobitel" name="zaposlenik-${i+1}-mobitel">
		
		<label for="employee-${i}-surname">Naziv radnog mjesta ${i + 1}. zaposlenika:</label>
        <input type="text" id="employee-${i}-surname" name="zaposlenik-${i+1}-radno-mjesto">
		
		<hr>
      `;
    }
	
	employeeFormsContainer.innerHTML = html;
}
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
                            <img src="assets/Excelum.png" style="width:150px;" alt="Excelum"/>
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="http://excelum.hr">Home</a></li>
                            <!-- <li><a href="about.html">O nama</a></li> -->
                            <li><a href="edukacije">Edukacije</a></li>
                            <li><a href="blog">Blog</a></li>
							<li class="d-lg-none"><a href="blog.html">Excelum marketing</a></li>
							<li class="d-lg-none"><a href="blog.html">Konzulting</a></li>
							<li class="d-lg-none"><a href="blog.html">Ostale usluge</a></li>
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

                            <li><a href="kontakt" class="active">Kontakt</a></li>
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
    <!-- ***** Contact Us Start ***** -->
    <section class="section colored contact-us" id="contact-us">
        <div class="container">
            <!-- ***** Section Title Start ***** -->
            <div class="row">

        <div class="col-lg-12">
          <form id="contact" action="https://formsubmit.co/web.platforma@excelum.hr" method="POST">
            <div class="row">
              <div class="col-lg-12">
                <div class="section-heading">
                  <h6>Kontakt</h6>
                  <h4> <em>Prijavite</em> se!</h4>
                  <p>Kontaktirat ćemo Vas povratno u što kraćem roku!</p>
                </div>
              </div>

              <div class="col-lg-6">
                <label for="select-option">Naziv edukacije:</label>
                <select id="select-option" name="odabrana-edukacija">
                  <?php echo $kategorije; ?>
                </select>
            </div>
<br> &nbsp;
            <div class="col-lg-6">
              <label for="selectOption">Namjena:</label>
              <select id="selectOption" name="namjena" onchange="toggleFields()">
				<option value="">Odaberite namjenu..</option>
                <option value="privatno">Privatno</option>
                <option value="poslovno">Poslovno</option>
              </select>
          </div>

   
              <div class="col-lg-6" id="option1Fields" style="display:none">
                <fieldset>
                  <input type="text" name="ime-prezime" id="ime-prezime" placeholder="Ime i prezime" autocomplete="on">
                  <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="E-mail">
                  <input type="number" name="broj" id="broj" placeholder="Telefon">
                  <button type="submit" id="form-submit" class="main-gradient-button">Prijavi se</button>
                </fieldset>
              </div>
				
              <div class="col-lg-6" id="option2Fields" style="display:none">
                <fieldset>
                  <input type="name" name="ime-tvrtke" id="ime-tvrtke" placeholder="Ime tvrtke" autocomplete="on" >
                  <input type="number" name="oib-tvrtke" id="oib-tvrtke" placeholder="OIB tvrtke" >
                  <input type="text" name="email-tvrtke" id="email-tvrtke" pattern="[^ @]*@[^ @]*" placeholder="E-mail"> 
                  <select id="employee-count" name="broj-zaposlenika" onchange="Funkcija()">
                    <option value="0">Odaberite broj zaposlenika..</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                    <!-- add more options as needed -->
                  </select>
                  
                  <div class="col-lg-12" id="employee-forms"></div>
				  
                  <button type="submit" id="form-submit" class="main-gradient-button">Prijavi se</button>
                </fieldset>
              </div>
              
            </div>
			<input type="hidden" name="_captcha" value="false">
			<input type="hidden" name="_next" value="http://excelum.hr/hvala">
          </form>
        </div>
      </div>
        </div>
    </section>
    <!-- ***** Contact Us End ***** -->
    
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
                    <p class="copyright">Copyright &copy; 2023 EXCELUM.HR - DESIGN: EXCELUM MARKETING TEAM</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

  </body>
</html>