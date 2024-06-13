<?php

function kreirajBlogove($param){
    


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

		// POCETAK KREIRANJE FAJLA
		
		$tagoviblog = "";
		
		$birtija = "";
		
		$cntr = 0;
		
		$myArray = array();

        $randomIndices = array_keys($myArr); // Get the array keys
        shuffle($randomIndices); // Shuffle the array keys
    
        foreach ($randomIndices as $i) {
            
            if ($myArr[$i][4] == $row["kategorija"] && $myArr[$i][5] != $row["id"] && $myArr[$i][6] == 0) {
				$cntr = $cntr + 1;
                // $myArray[] = $myArr[$i];
				$mojMaliPoni = strlen($myArr[$i][1]) > 180 ? substr($myArr[$i][1], 0, 180) . "..." : $myArr[$i][1];
				
				$f1 = str_replace(' ', '-', $myArr[$i][0]);
				$f2 = strtolower($f1);
				
				$birtija .= "<div class='col-md-4 col-12 blog-item' style='margin-bottom:2%;'>
					<div class='card'>
					<img src='../admin.excelum.hr/" . $myArr[$i][2] . "' class='img-fluid' alt='Image Slider 1' />
						<div class='card-body text-start'>
						<p class='card-text'>" . $myArr[$i][3] . "</p>
						<h5 class='card-title fw-bold'>" . $myArr[$i][0] . "</h5>
						<p class='card-text'>" . $mojMaliPoni . "</p>
						<a href='".$f2."' class='stretched-link'></a>
						</div>
					</div>
				</div>";
            }
            if($cntr == 3){
                break;
            }
        }
        if($cntr==0){
            $birtija = "Nema drugih blogova u ovoj kategoriji, pogledajte ostale!";
        }
		$cntr = 0;
		

          // POCETAK KREIRANJE FAJLA

          $filename = $formatted_text . ".php";
          if($param === "obican"){
			$file_path = 'blogovi/' . $filename;
			} else{
			$file_path = '../blogovi/' . $filename;
			}				

        // $filename = $row["id"] . ".html"; // Change this to whatever filename you want
        // $file_path = 'blogovi/' . $filename;

        if (file_exists($file_path)) {
            //echo "File '$filename' already exists. Please choose a different name.";
        } else {
            // Your HTML content to be written to the new file
            $naslov = $row['naslov'];
            $datum = $row['datum'];
            $sadrzaj = $row['sadrzaj'];
            $cat = $row['kategorija'];
			
			$meta_description = $row['meta_description'];
            $meta_author = $row['meta_author'];
            $meta_robots_indexing = $row['meta_robots_indexing'];
            $meta_robots_following = $row['meta_robots_following'];
			
			$og_title = $row['og_title'];
            $og_description = $row['og_description'];
            $og_url = "https://excelum.hr/blogovi/" . $filename;
            $og_image = "https://admin.excelum.hr/" . $row["slika"];
			$kanonski = "";
			$og_type = $row['og_type'];

            $cannonical = $row['cannonical'];

            if($cannonical == 1)
            $kanonski = "<link rel='canonical' href='".$og_url."'>";

            $slika = "<img src='../admin.excelum.hr/" . $row["slika"] . "' class='img-fluid' alt='Image Slider 1' />";
			
			$tagici = $row['tags'];

            $sentences = explode(",", $tagici);

            // Trim whitespace from each element in the array
            $sentences = array_map('trim', $sentences);
			

            foreach ($sentences as $sentence) {
              $tagoviblog .= '<span class="badge rounded-pill text-bg-secondary">' . $sentence . '</span>';
            }

            // Start output buffering
            ob_start();

            // Include the HTML template file
			// if($param === "obican"){
			// include 'blogtemplate.php';
			// } else{
				// include '../blogtemplate.php';
			// }
			
			$currentDir = getcwd();
			chdir(__DIR__);
			include 'blogtemplate.php';
			chdir($currentDir);

            // Get the content of the output buffer
            $content = ob_get_clean();

            // Write the content to the HTML file
            file_put_contents($file_path, $content);
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


}

function kreirajEdukacije($param){
	
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
    $sql2 = "SELECT * FROM edukacije";
    $result2 = $conn->query($sql2);
    $temp = "active";
    $brojac = 0;
	

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
          // $file_path = 'excelum-edukacije/' . $filename;
		  
		  if($param === "obican"){
			$file_path = 'excelum-edukacije/' . $filename;
			} else{
			$file_path = '../excelum-edukacije/' . $filename;
			}

          if (file_exists($file_path)) {
          } else {
            $naslov = $row2['ime'];
            $trajanje = $row2['trajanje'];
            $cijena = $row2['cijena'];
            $dugi_opis = $row2['dugi_opis'];
			
			$meta_description = $row2['meta_description'];
            $meta_author = $row2['meta_author'];
            $meta_robots_indexing = $row2['meta_robots_indexing'];
            $meta_robots_following = $row2['meta_robots_following'];
			
			$og_title = $row2['og_title'];
            $og_description = $row2['og_description'];
            $og_url = "https://excelum.hr/blogovi/" . $filename;
            $og_image = "https://admin.excelum.hr/" . $row2["slika"];
			$kanonski = "";
			$og_type = $row2['og_type'];

            $cannonical = $row2['cannonical'];

            if($cannonical == 1)
            $kanonski = "<link rel='canonical' href='".$og_url."'>";
			


            // harmonika je otud

            $accordionData = $row2['sadrzaj'];
			
			$accordionDataCleaned = preg_replace('/[[:cntrl:]]/', '', $accordionData);

            $accordionArray = json_decode($accordionDataCleaned, true);

			// echo "Error decoding JSON: " . json_last_error_msg();
            // Initialize the variable to store HTML for the accordion
            $accordionHTML = '';

            // Check if the array is not empty
            if (!empty($accordionArray)) {
              // Output the HTML for the accordion
              foreach ($accordionArray as $index => $accordionItem) {

                $accordionHTML .= '<div class="card">
                <div class="card-header" id="heading' . ($index + 1) . '">
                    <h3 class="mb-0">
                        <button type="button" class="btn btn-link"
                            data-toggle="collapse"
                            data-target="#collapse' . ($index + 1) . '">
                            <i class="fa fa-plus"></i>
                            ' . htmlspecialchars($accordionItem['heading']) . '
                        </button>
                    </h3>
                </div>
                <div id="collapse' . ($index + 1) . '" class="collapse"
                    aria-labelledby="heading' . ($index + 1) . '"
                    data-parent="#accordionExample">
                    <div class="card-body">
					<ul class="listica">
                         
                        ' . $accordionItem['content'] . '
					</ul>
                    </div>
                </div>
            </div>';
			
			// echo htmlspecialchars($accordionItem['content']);


              }
            } else {
              $accordionHTML = '';
            }

            // kraj harmonike


            // ciljevi su otud

            $ciljeviData = $row2['ciljevi'];

            //harmonika
            $ciljeviArray = json_decode($ciljeviData, true);

            // Initialize the variable to store HTML for the accordion
            $ciljeviHTML = '';

            // Check if the array is not empty
            if (!empty($ciljeviArray)) {
              // Output the HTML for the accordion
              foreach ($ciljeviArray as $index => $ciljItem) {

                $ciljeviHTML .= '<li>' . htmlspecialchars($ciljItem['heading']) . '</li>';

              }
            } else {
              $ciljeviHTML = '<li>Ciljevi za ovu edukaciju nisu navedeni</li>';
            }



            // kraj ciljeva

            $tagici = $row2['tagovi'];

            $sentences = explode(",", $tagici);

            // Trim whitespace from each element in the array
            $sentences = array_map('trim', $sentences);

            foreach ($sentences as $sentence) {
              $tagoviedu .= '<span class="badge rounded-pill text-bg-secondary">' . $sentence . '</span>';
            }

            // $tagoviedu .= '<span class="badge rounded-pill text-bg-secondary">Secondary</span>';

            ob_start();

            include 'edukacijatemplate.php';

            $content = ob_get_clean();

            file_put_contents($file_path, $content);
          }

		}
	  }		
}


?>