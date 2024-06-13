<?php
header('Content-Type: text/html; charset=UTF-8');
include 'funkcije.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
$sql = "SELECT * FROM kategorije";
$result = $conn->query($sql);

// Initialize an empty string to store HTML content
$kategorije = "";
$tagoviedu = "";
$penis = "";
// Check if there are any rows returned
if ($result->num_rows > 0) {
  // Output data of each row
  while ($row = $result->fetch_assoc()) {
    
    $edukacije = "";
    $edukacije2 = "";
    // $slika = "admin.excelum.hr/" . $row["slika"];
    $sql2 = "SELECT * FROM edukacije";
    $result2 = $conn->query($sql2);
    $temp = "active";
    $brojac = 0;
	
	$penis = $row['tagovi'];
	
	
	
    if ($row["hidden"] < 1) {

      if ($result2->num_rows > 0) {
        // Output data of each row
        while ($row2 = $result2->fetch_assoc()) {
			
			// if (is_null($row2["slika"]) || $row2["slika"] === '') {
			
			// } else{
				$slika = "admin.excelum.hr/" . $row2["slika"];
			// }
			
          $formatted_text_upper = str_replace(' ', '-', $row2["ime"]);
          $formatted_text = strtolower($formatted_text_upper);

          // POCETAK KREIRANJE FAJLA

          $filename = $formatted_text . ".html";
          $file_path = 'excelum-edukacije/' . $filename;
		   
		   kreirajEdukacije("obican");

          if ($row2["kategorija"] === $row["id"] && $row2["hidden"] < 1) {

            if ($brojac > 0) {
              $temp = "";
            }
            $edukacije .= '<div class="' . $temp . ' gradient-border"><span>' . $row2["ime"] . '</span></div>';
            $edukacije2 .= '<li class="' . $temp . '">
                          <div>
                            <div class="left-image">
                              <img class="img-fluid" src="' . $slika . '" alt="">
                            </div>
                            <div class="right-content">
                              <h4>' . $row2["ime"] . '</h4>
                              <p>' . $row2["kratki_opis"] . '</p>
                              <div class="text-button">
                                <span><a href="excelum-edukacije/' . $formatted_text . '">Saznaj više</a></span>
                                <span class="last-span"><button class="gumbek" style="width: 30%;" onclick="window.location.href=\'../edukacije-prijava\'">Prijavi se</button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </li>';
            $brojac = $brojac + 1;

          }

          $tagoviedu = "";
        }
        $penis = "";
      }
      
      $kategorije .= '<div class="container">
                          <section class="our-courses section" id="courses" style="padding-top: 5px !important;">
                              <div class="container">
                                  <div class="row">
                                      <div class="col-lg-12">
                                          <div class="naccs">
                                              <div class="tabs">
                                                  <div class="row">
                                                      <div class="col-lg-3">
                                                          <div class="menu">
                                                              ' . $edukacije . '
                                                          </div>
                                                      </div>
                                                      <div class="col-lg-9">
                                                          <ul class="nacc">
                                                              ' . $edukacije2 . '
                                                          </ul>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </section>
                      </div>';
      
    }
    $slika = "";
  }

} else {
  $kategorije = "0 results";
}

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

  <title>Edukacije</title>
  <!--
SOFTY PINKO
https://templatemo.com/tm-535-softy-pinko
-->

  <!-- Additional CSS Files -->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

  <link rel="stylesheet" href="assets/css/templatemo-softy-pinko.css">
  <script src="https://kit.fontawesome.com/f51814c8d1.js" crossorigin="anonymous"></script>

  <style>
    @media screen and (max-width: 767px) {
      .gumbek {
        width: 5.5rem !important;
        height: 3rem;
      }
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
            <a href="../public_html" class="logo">
              <img src="assets/Excelum.png" style="width:150px;" alt="Excelum" />
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li><a href="../public_html">Home</a></li>
              <!-- <li><a href="about.html">O nama</a></li> -->
              <li><a href="edukacije" class="active">Edukacije</a></li>
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

  <div class="container">
    <section class="our-courses section" id="courses" style="padding-bottom: 0px !important;">
      <div class="container">

        <div class="row">
          <div class="col-lg-6 offset-lg-3">
            <div class="section-heading">
              <h6 style="padding-top: 25px !important;">EXCELUM EDUKACIJE</h6>
              <h4>Pronađite edukaciju za <em>sebe</em></h4>
              <p>Excelum nudi veliki broj profesionalnih edukacija stručnjaka s iskustvom iz raznih područja poput
                nabave, prodaje, financija, upravljanja i unaprjeđenju procesa, digitalizacije poslovanja te znanja
                upotrebe raznolikih aplikacija poput Microsoft Office 365 alata, Power alata, Python programiranja i
                mnogih drugih.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  
<!--            <div class="col-lg-12">
              <div class="naccs">
                <div class="tabs">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="menu">
                        <div class="active gradient-border"><span>Microsoft Office osnovni paket</span></div>
                        <div class="gradient-border"><span>Microsoft Office napredni paket</span></div>
                        <div class="gradient-border"><span>Excel osnovni</span></div>
                        <div class="gradient-border"><span>Excel napredni</span></div>
                        <div class="gradient-border"><span>Excel ekspertni</span></div>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <ul class="nacc">
                        <li class="active">
                          <div>
                            <div class="left-image">
                              <img src="assets/images/office.png" alt="">
                              
                            </div>
                            <div class="right-content">
                              <h4>Microsoft Office osnovni paket</h4>
                              <p>Upoznavanje i upotreba osnovnih funkcionalnosti aplikacija u Microsoft Office 365 paketu: Word, Power Point, Outlook, Forms, Teams, Sharepoint, Onedrive i drugi. Za korisnike koji se do sada nisu susreli odnosno imaju minimalno iskustva u upotrebi navedenih aplikacija.</p>
                                                            <div class="text-button">
                                <span><a href="excelum-edukacije/office-osnovni">Saznaj više</a></span>
                                <span class="last-span"><button class="gumbek" style="width: 30%;" onclick="window.location.href='../edukacije-prijava'">Prijavi se</button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li>
                          <div>
                            <div class="left-image">
                              <img src="assets/images/office.png" alt="">
                              
                            </div>
                            <div class="right-content">
                              <h4>Microsoft Office napredni paket</h4>
                              <p>Naprednije funkcionalnosti i korisni tips & tricks za bržu i svestraniju svakodnevnu upotrebu Microsoft Office aplikacija: Word, Power Point, Outlook, Forms, Teams, Sharepoint, Onedrive i drugi. Za korisnike koji su upoznati aplikacijama i rade s njima svakodnevno te žele naučiti</p>
                                                            <div class="text-button">
                                <span><a href="excelum-edukacije/office-napredni">Saznaj više</a></span>
                                <span class="last-span"><button class="gumbek" style="width: 30%;" onclick="window.location.href='../edukacije-prijava'">Prijavi se</button></span>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li>
                          <div>
                            <div class="left-image">
                              <img src="assets/images/excel.png" alt="">
                              
                            </div>
                            <div class="right-content">
                              <h4>Excel osnovni</h4>
                              <p>Upoznavanje s mogućnostima i funkcijama Microsoft Excel aplikacije. Za korisnike koji se do sada nisu susreli s aplikacijom ili koriste samo osnovne funkcionalnosti aplikacije.</p>
                                                           <div class="text-button">
                                <span><a href="excelum-edukacije/excel-osnovni">Saznaj više</a></span>
                                <span class="last-span"><button class="gumbek" style="width: 30%;" onclick="window.location.href='../edukacije-prijava'">Prijavi se</button></span>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li>
                          <div>
                            <div class="left-image">
                              <img src="assets/images/excel.png" alt="">
                              
                            </div>
                            <div class="right-content">
                              <h4>Excel napredni</h4>
                              <p>Upoznavanje s naprednim mogućnostima, ubrzavanje rada, povezivanje i učitavanje podataka, rad s naprednim funkcijama, grafovima i vizualnim prikazom podataka. Za korisnike koji koriste aplikaciju svakodnevno te žele naučiti više te povećati svoju učinkovitost rada na višu razinu.</p>
                              
                              <div class="text-button">
                                <span><a href="excelum-edukacije/excel-napredni">Saznaj više</a></span>
                                <span class="last-span"><button class="gumbek" style="width: 30%;" onclick="window.location.href='../edukacije-prijava'">Prijavi se</button></span>
                              </div>
                            </div>
                          </div>
                          </li>
                          <li>
                            <div>
                              <div class="left-image">
                                <img src="assets/images/excel.png" alt="">
                               
                              </div>
                              <div class="right-content">
                                <h4>Excel ekspertni</h4>
                                <p>Upoznavanje s VBA kodiranjem, automatizacija zadataka i procesa pomoću aplikacije, učitavanje, modeliranje i povezivanje podataka, napredna analitika te ostale mogućnosti aplikacije koje svakodnevnom korisniku smanjuju opseg rada i opterećenja te mu pomažu automatizirati rad kako bi se više posvetio vlastitom razvoju i razvoju svojeg poslovanja. Za sve korisnike Excel aplikacije koji žele više.</p>
                                                                <div class="text-button">
                                  <span><a href="excelum-edukacije/excel-ekspertni">Saznaj više</a></span>
                                  <span class="last-span"><button class="gumbek" style="width: 30%;" onclick="window.location.href='../edukacije-prijava'">Prijavi se</button></span>
                                </div>
                              </div>
                            </div>
                            </li>
                        </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </section>
  </div>
          </div>
        </div>
      </section>
</div>-->

  <?php echo $kategorije; ?>

<!--<div class="container">
  <section class="our-courses section" id="courses">
      <div class="container">
  <div class="row">
          <div class="col-lg-12">
            <div class="naccss">
              <div class="tabs">
                <div class="row">
                  <div class="col-lg-3">
                    <div class="menu">
                      <div class="active gradient-border"><span>PowerBI osnovni</span></div>
                      <div class="gradient-border"><span>PowerBI napredni</span></div>
                      <div class="gradient-border"><span>PowerBI ekspertni</span></div>
                      <div class="gradient-border"><span>Power Apps/ Automate osnovni</span></div>
                      <div class="gradient-border"><span>Power Apps/ Automate napredni</span></div>
                    </div>
                  </div>
                  <div class="col-lg-9">
                    <ul class="nacc">
                      <li class="active">
                        <div>
                          <div class="left-image">
                            <img src="assets/images/powerbi.png" alt="">
                            
                          </div>
                          <div class="right-content">
                            <h4>PowerBI osnovni</h4>
                            <p>Upoznavanje s mogućnostima Power BI aplikacije, učitavanje, čišćenje i transformacija podataka, modeliranje (povezivanje) podataka, kreiranje vizuala i izrada prvog reporta. Za korisnike koji se do sada nisu susreli s Power BI aplikacijom ali žele automatizirati i unaprijediti svoje Excel/ email reporte i dashboarde.</p>
                            
                            <div class="text-button">
                              <span><a href="excelum-edukacije/powerbi-osnovni">Saznaj više</a></span>
                              <span class="last-span"><button class="gumbek" style="width: 30%;" onclick="window.location.href='../edukacije-prijava'">Prijavi se</button></span>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div>
                          <div class="left-image">
                            <img src="assets/images/powerbi.png" alt="">
                          
                          </div>
                          <div class="right-content">
                            <h4>PowerBI napredni</h4>
                            <p>Temeljitije upoznavanje s DAX programskih jezikom, napredne vizualizacije podataka, kompleksnije mogućnosti interakcije korisnika s dashboardima, automatizacija stvaranja izvještaja. Za korisnike koji su se već susreli s Power BI aplikacijom te ju koriste u sklopu svog svakodnevnog posla.</p>
                            
                            <div class="text-button">
                              <span><a href="excelum-edukacije/powerbi-napredni">Saznaj više</a></span>
                              <span class="last-span"><button class="gumbek" style="width: 30%;" onclick="window.location.href='../edukacije-prijava'">Prijavi se</button></span>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div>
                          <div class="left-image">
                            <img src="assets/images/powerbi.png" alt="">
                          
                          </div>
                          <div class="right-content">
                            <h4>PowerBI ekspertni</h4>
                            <p>Rad s Power Query M, DAX, specijalnim vizualizacijama, potpuna automatizacija reporta, povezivanje na baze podataka, Row level security, web API konekcije i dr. Za napredne korisnike Power BI aplikacije i data scientiste koji žele u potpunosti naučiti i savladati sve mogućnosti aplikacije.</p>
                            
                            <div class="text-button">
                              <span><a href="excelum-edukacije/powerbi-ekspertni">Saznaj više</a></span>
                              <span class="last-span"><button class="gumbek" style="width: 30%;" onclick="window.location.href='../edukacije-prijava'">Prijavi se</button></span>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div>
                          <div class="left-image">
                            <img src="assets/images/powerapps.png" alt="">
                          
                          </div>
                          <div class="right-content">
                            <h4>Power Apps/ Automate osnovni</h4>
                            <p>Stvaranje automatizacija i aplikacija pomoću Microsoftove low code – no code Power Platforme. Za zaposlenike koji žele stvoriti novu vrijednosti u vlastitim poslovnim procesima.</p>
                            
                            <div class="text-button">
                              <span><a href="excelum-edukacije/powerapps-osnovni">Saznaj više</a></span>
                              <span class="last-span"><button class="gumbek" style="width: 30%;" onclick="window.location.href='../edukacije-prijava'">Prijavi se</button></span>
                            </div>
                          </div>
                        </div>
                        </li>
                        <li>
                          <div>
                            <div class="left-image">
                              <img src="assets/images/powerapps.png" alt="">
                            
                            </div>
                            <div class="right-content">
                              <h4>Power Apps/ Automate napredni</h4>
                              <p>Stvaranje automatizacija i aplikacija pomoću Microsoftove low code – no code Power Platforme. Za zaposlenike koji žele stvoriti novu vrijednosti u vlastitim poslovnim procesima.</p>
                                                            <div class="text-button">
                                <span><a href="excelum-edukacije/powerapps-napredni">Saznaj više</a></span>
                                <span class="last-span"><button class="gumbek" style="width: 30%;" onclick="window.location.href='../edukacije-prijava'">Prijavi se</button></span>
                              </div>
                            </div>
                          </div>
                          </li>
                      </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>-->

  <!-- ***** Pricing Plans Start ***** -->

  <!-- ***** Pricing Plans End ***** -->


  <!-- ***** Footer Start ***** -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <ul class="social">
            <li><a href="https://www.facebook.com/Excelum" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://www.linkedin.com/company/excelum1/" target="_blank"><i class="fa fa-linkedin"></i></a>
            </li>
            <li><a href="https://www.youtube.com/channel/UCy0OhNdo3KduTWuewArb4nw" target="_blank"><i
                  class="fa fa-youtube"></i></a></li>
            <li><a href="https://www.instagram.com/excelumedukacije/" target="_blank"><i
                  class="fa fa-instagram"></i></a></li>
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