<?php



$editedu_kategorije = "";

$editedu_ime = "";
$editedu_kategorija = "";
$editedu_kropis = "";
$editedu_dugopis = "";
$editedu_trajanje = "";
$editedu_cijena = "";
$editedu_tagovi = "";

$editedu_metadescription = "";
$editedu_ogtitle = "";
$editedu_ogdescription = "";

$id_edu = "";

$accordionData = "";

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Start session
$userr = "";
if (isset($_GET['username'])) {
  // Get the username from the URL
  $userr = $_GET['username'];
  $_SESSION['username'] = $userr;
} else {
  // Handle the case where 'username' is not set in $_GET
  // Redirect, exit, show an error message, etc.
}

// Check if user is authenticated, redirect to login page if not
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
  header("Location: login.php");
  exit;
}
include __DIR__ . '/../funkcije.php';
//include '../funkcije.php';
if (isset($_POST['logout'])) {
  // Unset all session variables
  $_SESSION = array();

  // Destroy the session
  session_destroy();

  // Redirect to the login page or any other page
  header("Location: login.php"); // Change 'login.php' to your login page URL
  exit;
}



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

// POČETAK BLOG


// SQL query to retrieve data
$sql = "SELECT * FROM blog";
$result = $conn->query($sql);

// Initialize an empty string to store HTML content
$htmlContent = "";

$skriven = "";
$ganja = "Sakrij";
// Check if there are any rows returned
if ($result->num_rows > 0) {
  $htmlContent .= "<div class='row' style='margin:0!important;padding:0!important;'>";
  // Output data of each row
  while ($row = $result->fetch_assoc()) {
    $skriven = "";
    $ganja = "Sakrij";
    if ($row["hidden"] > 0) {
      $skriven = 'opacity:0.1;';
      $ganja = "Prikaži";
    }
    if (isset($row["sadrzaj"])) {
      $truncated_sadrzaj = strlen($row["sadrzaj"]) > 180 ? substr($row["sadrzaj"], 0, 180) . "..." : $row["sadrzaj"];
    } else {

    }

    $htmlContent .= "<div class='col-md-4 col-12 blog-item " . $row["kategorija"] . "' data-hidden='" . $row["hidden"] . "' data-category='" . $row["kategorija"] . "'><img style='height:50%;width:100%;object-fit:none;" . $skriven . "' src='" . $row["slika"] . "' class='img-fluid' alt='Column Image 1'/>" .
      "<div class='row mb-4'>" .
      "<div class='col-6'>" .
      "<p>" . $row["datum"] . "</p>" .
      "</div>" .
      "<div class='col-6 text-right'>" .
      "<div class='dropdown d-flex justify-content-end'>" .
      " <button class='btn-dots text-right' type='button' id='klipan' data-bs-toggle='dropdown' aria-expanded='false'>" .
      "   <i class='fas fa-ellipsis-h text-right'></i>" .
      "</button>" .
      "<div class='dropdown-menu sise' aria-labelledby='klipan'> " .
      "<a class='dropdown-item edit-btn' data-item-edit='" . $row["id"] . "' href='#'>Uredi</a>" .
      " <a class='dropdown-item hide-btn' data-item-hide='" . $row["id"] . "' href='#'>$ganja</a>" .
      " <a class='dropdown-item delete-btn' data-item-id='" . $row["id"] . "' href='#'>Izbriši</a> " .
      " <a class='dropdown-item pin-btn' data-item-pin='" . $row["id"] . "' href='#'>Prikvači</a>" .
      "</div>" .
      "       </div>" .
      "</div>" .
      "</div>" .
      "<h2>" . $row["naslov"] . "</h2>" .
      "<p>" . $truncated_sadrzaj . "</p>" .
      "</div>";
  }
  $htmlContent .= "</div>";

} else {
  $htmlContent = "Trenutno nema blogova.";
}

// KRAJ BLOG


$sqls = "SELECT * FROM obavijesti ORDER BY pozicija ASC";
$results = $conn->query($sqls);

// Initialize an empty string to store HTML content
$htmlContentHome = "";

$vagina1 = "";
$vagina2 = "";
$vagina3 = "";

$sqlsin = "SELECT * FROM obavijesti ORDER BY pozicija ASC";
$rezultat = $conn->query($sqlsin);

if ($rezultat->num_rows > 0) {
  // Output data of each row
  while ($red = $rezultat->fetch_assoc()) {

    if ($red["pozicija"] == 1) {
      $vagina1 = "disabled";
    }

    if ($red["pozicija"] == 2) {
      $vagina2 = "disabled";
    }

    if ($red["pozicija"] == 3) {
      $vagina3 = "disabled";
    }

  }
}

// Check if there are any rows returned
if ($results->num_rows > 0) {
  $htmlContentHome .= "<div class='row' style='margin:0!important;padding:0!important;'>";
  // Output data of each row
  while ($row = $results->fetch_assoc()) {




    $htmlContentHome .= "<div class='col-md-4 col-12' ><p class='position text-center'>Trenutna pozicija: " . $row["pozicija"] . "</p>" .
      "<img src='" . $row["slika"] . "' class='img-fluid'/>" .
      "<h5>" . $row["naslov"] . "</h5>" .
      "<button class='delpos delete-home-btn' data-item-home='" . $row["id"] . "'><i class='fa fa-trash' aria-hidden='true'></i> Izbriši</button>" .
      "<button class='delpos dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>" .
      "<i class='fa-solid fa-location-dot'></i> Pozicija" .
      "</button>" .
      "<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>" .
      "<li><a class='dropdown-item poz0' data-item-poz0='" . $row["id"] . "' href='#'>On hold</a></li>" .
      "<li><a class='dropdown-item " . $vagina1 . " poz1' data-item-poz1='" . $row["id"] . "' href='#'>Pozicija 1</a></li>" .
      "<li><a class='dropdown-item " . $vagina2 . " poz2' data-item-poz2='" . $row["id"] . "' href='#'>Pozicija 2</a></li>" .
      "<li><a class='dropdown-item " . $vagina3 . " poz3' data-item-poz3='" . $row["id"] . "' href='#'>Pozicija 3</a></li>" .
      "</ul>" .
      "</div>";
  }
  $htmlContentHome .= "</div>";

} else {
  $htmlContentHome = "Trenutno nema obavijesti.";
}



// POČETAK EDUKACIJE

$sql = "SELECT * FROM kategorije";
$result = $conn->query($sql);

$edukacije = ""; // Initialize variable to store all dropdown menus

$kategorije = "";

$eduhidden = "";

$kathidden = "Sakrij";
$spedu = "Sakrij";

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {

    $eduhidden = "";
    $kathidden = "Sakrij";


    if ($row["hidden"] > 0) {
      $eduhidden = "style='background-color: rgba(212, 208, 208, 0.452)'";
      $kathidden = "Prikaži";
    }

    $ime_kategorije = $row["ime"];

    $id_kategorije = $row["id"];

    $kategorije .= "<option value='" . $id_kategorije . "'>" . $ime_kategorije . "</option>";


    $dropdown_items = ""; // Initialize variable to store dropdown items for each dropdown menu

    // Retrieve dropdown items from another table based on the current kategorije ID
    // Replace "your_other_table" with the name of your other table
    $dropdown_sql = "SELECT * FROM edukacije WHERE kategorija = '" . $id_kategorije . "'";
    $dropdown_result = $conn->query($dropdown_sql);

    $dikiz = "";

    $dropdown_items .= "<div class='dropright' >" .
      "<button class='dropdown-item' " . $dikiz . " >Kategorija &raquo;</button>" .
      "<div class='dropdown-menu'>" .
      "<a class='dropdown-item editedukat-btn' data-item-editedukat='" . $row["id"] . "' href='#'>Uredi</a>" .
      "<a class='dropdown-item hide-btn-kategorijeedu' href='#' data-item-hidkatedu='" . $row["id"] . "'>" . $kathidden . "</a>" .
      "<a class='dropdown-item delete-btn-kategorijeedu' href='#' data-item-delkatedu='" . $row["id"] . "'>Izbriši</a>" .
      "</div>" .
      "</div>";

    if ($dropdown_result->num_rows > 0) {
      while ($dropdown_row = $dropdown_result->fetch_assoc()) {

        $dikiz = "";
        $spedu = "Sakrij";

        if ($dropdown_row["hidden"] >= 1) {
          $dikiz = "style='background-color: rgba(212, 208, 208, 0.452)'";
          $spedu = "Prikaži";
        }

        // Generate dropdown items
        $dropdown_items .= "<div class='dropright' >" .
          "<button class='dropdown-item' " . $dikiz . " >" . $dropdown_row["ime"] . " &raquo;</button>" .
          "<div class='dropdown-menu'>" .
          "<a class='dropdown-item editedu-btn' data-item-editedu='" . $dropdown_row["id"] . "' href='#'>Uredi</a>" .
          "<a class='dropdown-item hide-btn-edukacije' href='#' data-item-hideedu='" . $dropdown_row["id"] . "'>" . $spedu . "</a>" .
          "<a class='dropdown-item delete-btn-edukacije' href='#' data-item-obrisiedu='" . $dropdown_row["id"] . "'>Izbriši</a>" .
          "</div>" .
          "</div>";


      }
    }




    // Generate dropdown menu for current kategorije
    $edukacije .=
      "<div class='dropright pb-3'>" .
      "<button class='btn btn-light btn-lg' " . $eduhidden . " >" . $row["ime"] . " &raquo;</button>" .
      "<div class='dropdown-menu'>" .
      $dropdown_items . // Insert dropdown items
      "</div>" .
      "</div>" .
      "<br>";
  }
} else {
  $edukacije = "0";
}

// KRAJ EDUKACIJE


// KREIRAJ BLOG KATEGORIJE

$sql = "SELECT * FROM kategorije_blogovi";
$result = $conn->query($sql);

$kategorije_blogovi = "";
$kategorije_array = array();

$kategorije_drop = "";

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {

    $ime_kategorije = $row["ime"];
    $kategorije_array[] = $row["ime"]; // Add category to the array
    $kategorije_blogovi .= "<option value='" . $ime_kategorije . "'>" . $ime_kategorije . "</option>";

    $kategorije_drop .= "<option value='" . $row["ime"] . "'>" . $row["ime"] . "</option>";
  }
} else {
  $kategorije_blogovi = "";
}

// KRAJ BLOG KATEGORIJA

if (isset($_GET['id'])) {
  $item_id = $_GET['id'];

  // Perform deletion query
  $sql = "DELETE FROM blog WHERE id = $item_id";
  if ($conn->query($sql) === TRUE) {
    deleteFilesInFolder('../blogovi');
    sleep(1);
    kreirajBlogove("admin");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
    // echo "<p>Item with ID $item_id has been deleted successfully.</p>";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}

if (isset($_GET['obrisiedu'])) {
  $item_id = $_GET['obrisiedu'];

  // Perform deletion query
  $sql = "DELETE FROM edukacije WHERE id = $item_id";

  if ($conn->query($sql) === TRUE) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
    // echo "<p>Item with ID $item_id has been deleted successfully.</p>";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}


if (isset($_GET['delkatedu'])) {
  $item_id = $_GET['delkatedu'];

  // Perform deletion query
  $sql = "DELETE FROM kategorije WHERE id = $item_id";

  if ($conn->query($sql) === TRUE) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
    // echo "<p>Item with ID $item_id has been deleted successfully.</p>";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}

if (isset($_GET['home'])) {
  $item_id = $_GET['home'];

  // Perform deletion query
  $sql = "DELETE FROM obavijesti WHERE id = $item_id";

  if ($conn->query($sql) === TRUE) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
    // echo "<p>Item with ID $item_id has been deleted successfully.</p>";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}

if (isset($_GET['pin'])) {
  $item_id = $_GET['pin'];

  // Prepare SQL query
  $sql = "SELECT * FROM blog WHERE id = $item_id";

  // Execute SQL query
  $result = $conn->query($sql);

  // Check if any rows were returned
  if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
      if ($row["pinned"] > 0) {
        $sql = "UPDATE blog SET pinned = 0 WHERE id = $item_id";
      } else {
        $sql = "UPDATE blog SET pinned = 1 WHERE id = $item_id";
      }
    }
  } else {
    // echo "0 results";
  }

  // Perform deletion query


  if ($conn->query($sql) === TRUE) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
    // echo "<p>Item with ID $item_id has been pinned successfully.</p>";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}

if (isset($_GET['hide'])) {
  $item_id = $_GET['hide'];

  // Prepare SQL query
  $sql = "SELECT * FROM blog WHERE id = $item_id";

  // Execute SQL query
  $result = $conn->query($sql);

  // Check if any rows were returned
  if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
      if ($row["hidden"] > 0) {
        $sql = "UPDATE blog SET hidden = 0 WHERE id = $item_id";
      } else {
        $sql = "UPDATE blog SET hidden = 1 WHERE id = $item_id";
      }
    }
  } else {
    // echo "0 results";
  }

  // Perform deletion query


  if ($conn->query($sql) === TRUE) {
    deleteFilesInFolder('../blogovi');
    sleep(1);
    kreirajBlogove("admin");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
    // echo "<p>Item with ID $item_id has been pinned successfully.</p>";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}

if (isset($_GET['hideedu'])) {
  $item_id = $_GET['hideedu'];

  // Prepare SQL query
  $sql = "SELECT * FROM edukacije WHERE id = $item_id";

  // Execute SQL query
  $result = $conn->query($sql);

  // Check if any rows were returned
  if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
      if ($row["hidden"] > 0) {
        $sql = "UPDATE edukacije SET hidden = 0 WHERE id = $item_id";
      } else {
        $sql = "UPDATE edukacije SET hidden = 1 WHERE id = $item_id";
      }
    }
  } else {
    // echo "0 results";
  }

  // Perform deletion query


  if ($conn->query($sql) === TRUE) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
    // echo "<p>Item with ID $item_id has been pinned successfully.</p>";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}


if (isset($_GET['hidkatedu'])) {
  $item_id = $_GET['hidkatedu'];

  // Prepare SQL query
  $sql = "SELECT * FROM kategorije WHERE id = $item_id";

  // Execute SQL query
  $result = $conn->query($sql);

  // Check if any rows were returned
  if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
      if ($row["hidden"] > 0) {
        $sql = "UPDATE kategorije SET hidden = 0 WHERE id = $item_id";
      } else {
        $sql = "UPDATE kategorije SET hidden = 1 WHERE id = $item_id";
      }
    }
  } else {
    // echo "0 results";
  }

  // Perform deletion query


  if ($conn->query($sql) === TRUE) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
    // echo "<p>Item with ID $item_id has been pinned successfully.</p>";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}

if (isset($_GET['poz1'])) {
  $item_id = $_GET['poz1'];

  // Prepare SQL query
  $sql = "SELECT * FROM obavijesti WHERE id = $item_id";

  // Execute SQL query
  $result = $conn->query($sql);

  // Check if any rows were returned
  if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
      if ($row["pozicija"] == 1) {
        // $sql = "UPDATE edukacije SET hidden = 0 WHERE id = $item_id";
      } else {
        $sql = "UPDATE obavijesti SET pozicija = 1 WHERE id = $item_id";
      }
    }
  } else {
    // echo "0 results";
  }
  if ($conn->query($sql) === TRUE) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
    // echo "<p>Item with ID $item_id has been pinned successfully.</p>";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}

if (isset($_GET['poz2'])) {
  $item_id = $_GET['poz2'];

  // Prepare SQL query
  $sql = "SELECT * FROM obavijesti WHERE id = $item_id";

  // Execute SQL query
  $result = $conn->query($sql);

  // Check if any rows were returned
  if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
      if ($row["pozicija"] == 2) {
        // $sql = "UPDATE edukacije SET hidden = 0 WHERE id = $item_id";
      } else {
        $sql = "UPDATE obavijesti SET pozicija = 2 WHERE id = $item_id";
      }
    }
  } else {
    // echo "0 results";
  }
  if ($conn->query($sql) === TRUE) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
    // echo "<p>Item with ID $item_id has been pinned successfully.</p>";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}

if (isset($_GET['poz3'])) {
  $item_id = $_GET['poz3'];

  // Prepare SQL query
  $sql = "SELECT * FROM obavijesti WHERE id = $item_id";

  // Execute SQL query
  $result = $conn->query($sql);

  // Check if any rows were returned
  if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
      if ($row["pozicija"] == 3) {
        // $sql = "UPDATE edukacije SET hidden = 0 WHERE id = $item_id";
      } else {
        $sql = "UPDATE obavijesti SET pozicija = 3 WHERE id = $item_id";
      }
    }
  } else {
    // echo "0 results";
  }
  if ($conn->query($sql) === TRUE) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
    // echo "<p>Item with ID $item_id has been pinned successfully.</p>";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}

if (isset($_GET['poz0'])) {
  $item_id = $_GET['poz0'];

  // Prepare SQL query
  $sql = "SELECT * FROM obavijesti WHERE id = $item_id";

  // Execute SQL query
  $result = $conn->query($sql);

  // Check if any rows were returned
  if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
      if ($row["pozicija"] == 0) {
        // $sql = "UPDATE edukacije SET hidden = 0 WHERE id = $item_id";
      } else {
        $sql = "UPDATE obavijesti SET pozicija = 0 WHERE id = $item_id";
      }
    }
  } else {
    // echo "0 results";
  }
  if ($conn->query($sql) === TRUE) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
    // echo "<p>Item with ID $item_id has been pinned successfully.</p>";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}



// KREIRAJ KATEGORIJU
/*
if (isset($_POST['kategorija_submit'])) {
  // Process form 1 data
  $kategorija_ime = $_POST['ime_kat'];
  // $form1_email = $_POST['form1_email'];

  $sql = "INSERT INTO kategorije (ime) VALUES ('$kategorija_ime')";

  if ($conn->query($sql) === TRUE) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
    // echo "<p>Item with ID $item_id has been pinned successfully.</p>";
  } else {
    //echo "Error deleting record: " . $conn->error;
  }
}*/



if (isset($_POST['kategorija_submit']) && $_SERVER["REQUEST_METHOD"] == "POST") {

  $kategorija_ime = $_POST['ime_kat'];

  $kategorija_tagovi = $_POST['edukat_tagovi'];

  $sql = "INSERT INTO kategorije (ime, tagovi) VALUES ('$kategorija_ime', '$kategorija_tagovi')";

  if ($conn->query($sql) === TRUE) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}


// KREIRANJE BLOG KATEGORIJE

if (isset($_POST['kategorija_blog_submit'])) {
  // Process form 1 data
  $kategorija_ime = $_POST['ime_kat_blog'];
  // $form1_email = $_POST['form1_email'];

  $sql = "INSERT INTO kategorije_blogovi (ime) VALUES ('$kategorija_ime')";

  if ($conn->query($sql) === TRUE) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
    // echo "<p>Item with ID $item_id has been pinned successfully.</p>";
  } else {
    //echo "Error deleting record: " . $conn->error;
  }
}

// brisanje fileova

function deleteFilesInFolder($folderPath)
{
  // Check if the folder exists
  if (is_dir($folderPath)) {
    // Get list of files in the folder
    $files = scandir($folderPath);

    // Loop through the files
    foreach ($files as $file) {
      // Check if the file is not "." or ".."
      if ($file != '.' && $file != '..') {
        // Construct the full path to the file
        $filePath = $folderPath . '/' . $file;

        // Check if the file is a regular file (not a directory)
        if (is_file($filePath)) {
          // Attempt to delete the file
          if (unlink($filePath)) {
            // echo "File $file deleted successfully.<br>";
          } else {
            // echo "Error deleting file $file.<br>";
          }
        }
      }
    }
    // echo "All files deleted successfully.";
  } else {
    // echo "The folder does not exist.";
  }
}

// KREIRANJE BLOGA

if (isset($_POST['blog_submit']) && $_SERVER["REQUEST_METHOD"] == "POST") {
  // Process form data
  if (isset($_FILES["blog_slika"]) && $_FILES["blog_slika"]["error"] == UPLOAD_ERR_OK) {
    // Upload main image to server
    $targetDir = "blog/";
    $fileName = basename($_FILES["blog_slika"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["blog_slika"]["tmp_name"], $targetFilePath)) {
      // Insert data into database
      $blog_naslov = $_POST['blog_naslov'];
      $blog_kategorija = $_POST['blog_kategorija'];
      $blog_tekst = $_POST['blog_tekst'];
      $blog_tagovi = $_POST['blog_tagovi'];
      $currentDate = date("d.m.Y");
      $og_title = $_POST['og_title'];
      $og_description = $_POST['og_description'];
      $meta_robots_indexing = $_POST['meta_robots_indexing'];
      $meta_robots_following = $_POST['meta_robots_following'];
      $meta_description = $_POST['meta_description'];
      $meta_author = $_SESSION['username'];
      $cannonical = $_POST['cannonical'];
      $og_type = $_POST['og_type'];
      // Check if alt image text is provided
      $druga_slika = "";
      if (isset($_FILES["blog_slika_tekst"]) && $_FILES["blog_slika_tekst"]["error"] == UPLOAD_ERR_OK) {
        // Upload alt image text to server
        $fileNameTekst = basename($_FILES["blog_slika_tekst"]["name"]);
        $targetFilePathTekst = $targetDir . $fileNameTekst;

        if (move_uploaded_file($_FILES["blog_slika_tekst"]["tmp_name"], $targetFilePathTekst)) {
          $druga_slika = $targetFilePathTekst;
          $blog_slike_naslov = isset($_POST['blog_slike_naslov']) ? $_POST['blog_slike_naslov'] : "";
          $blog_alt = isset($_POST['blog_alt']) ? $_POST['blog_alt'] : "";
        }
      }

      // Insert main image and alt image text paths into database
      $sql = "INSERT INTO blog (naslov, sadrzaj, slika, datum, tags, kategorija, slika_tekst, og_title, og_description, meta_robots_indexing, meta_robots_following,
           meta_description, meta_author, cannonical, og_type) 
                  VALUES ('$blog_naslov', '$blog_tekst', '$targetFilePath', '$currentDate', '$blog_tagovi', '$blog_kategorija', '$druga_slika', '$og_title', '$og_description'
                  , '$meta_robots_indexing', '$meta_robots_following', '$meta_description', '$meta_author', '$cannonical', '$og_type')";

      if ($conn->query($sql) === TRUE) {
        deleteFilesInFolder('../blogovi');
        sleep(1);
        kreirajBlogove("admin");
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } else {
      echo "Sorry, there was an error uploading your main image.";
    }
  }
}

// KREIRANJE edukacije

if (isset($_POST['edukacija_submit']) && $_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_FILES["edukacija_img"]) && $_FILES["edukacija_img"]["error"] == UPLOAD_ERR_OK) {
    // Upload main image to server
    $targetDirCategory = "uploads/";
    $fileNameCategory = basename($_FILES["edukacija_img"]["name"]);
    $targetFilePathCategory = $targetDirCategory . $fileNameCategory;

    if (move_uploaded_file($_FILES["edukacija_img"]["tmp_name"], $targetFilePathCategory)) {




      $edu_naslov = $_POST['ime_edu'];
      $edu_kategorija = $_POST['edu_kategorija'];
      $edu_kropis = $_POST['kropis_edu'];
      $edu_dugopis = $_POST['dugopis_edu'];

      $edu_trajanje = $_POST['edu_trajanje'];
      $edu_cijena = $_POST['edu_cijena'];

      $edu_ciljevi = ".";
      $edu_tagovi = $_POST['edu_tagovi'];


      $og_title_edu = $_POST['og_title_edu'];
      $og_description_edu = $_POST['og_description_edu'];
      $meta_robots_indexing_edu = $_POST['meta_robots_indexing_edu'];
      $meta_robots_following_edu = $_POST['meta_robots_following_edu'];
      $meta_description_edu = $_POST['meta_description_edu'];
      $meta_author_edu = $_SESSION['username'];
      $cannonical_edu = $_POST['cannonical_edu'];
      $og_type_edu = $_POST['og_type_edu'];

      
      //sva ova sranja samo za harmoniku

      // Prepare data for insertion
      $cardHeadings = $_POST['cardHeadings'];
      $cardContents = $_POST['cardContents'];

      // Remove leading and trailing whitespace, including newlines
      $cardContents = array_map('trim', $cardContents);

      // Combine headings and contents into a single array
      $accordionData = [];
      for ($i = 0; $i < count($cardHeadings); $i++) {
        // Optionally, replace newlines with a space
        // $content = str_replace("\n", "", $cardContents[$i]);

        // $content = str_replace("\"", "\\\"", $cardContents[$i]);

        $content = preg_replace("/[\r\n]+/", "", $cardContents[$i]);
        // $content = str_replace(" ", "", $cardContents[$i]);

        // Or, remove newlines altogether


        $accordionData[] = array(
          'heading' => $cardHeadings[$i],
          'content' => $content
        );
      }

      // Convert array to JSON format
      $edu_sadrzaj = json_encode($accordionData, JSON_UNESCAPED_UNICODE);

      // kraj harmonike

      //sva ova sranja samo za ciljeve

      // Prepare data for insertion
      $ciljHeadings = $_POST['ciljHeadings'];

      // Combine headings and contents into a single array
      $accordionData2 = [];
      for ($i = 0; $i < count($ciljHeadings); $i++) {
        $accordionData2[] = array(
          'heading' => $ciljHeadings[$i]
        );
      }

      // Convert array to JSON format
      $edu_ciljevi = json_encode($accordionData2, JSON_UNESCAPED_UNICODE);

      // kraj ciljeva

      // Insert main image and alt image text paths into database
      $sql = "INSERT INTO edukacije (ime, kategorija, kratki_opis, dugi_opis, ciljevi, trajanje, cijena, tagovi, sadrzaj, slika, meta_description, meta_author, meta_robots_indexing, 
      meta_robots_following, og_title, og_description, og_type, cannonical) 
                  VALUES ('$edu_naslov', '$edu_kategorija', '$edu_kropis', '$edu_dugopis', '$edu_ciljevi', '$edu_trajanje', '$edu_cijena', '$edu_tagovi', '$edu_sadrzaj',
                   '$targetFilePathCategory', '$meta_description_edu', '$meta_author_edu', '$meta_robots_indexing_edu', '$meta_robots_following_edu', '$og_title_edu',
                   '$og_description_edu', '$og_type_edu', '$cannonical_edu')";

      if ($conn->query($sql) === TRUE) {
        sleep(1);
        kreirajEdukacije("admin");
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
      } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
  }
}


// EDIT BLOG

if (isset($_POST['editblog_submit']) && $_SERVER["REQUEST_METHOD"] == "POST") {
  // Process form 1 data

  $blog_naslov = $_POST['blog_naslov'];
  $blog_kategorija = $_POST['blog_kategorija'];
  $blog_tekst = $_POST['blog_tekst'];
  $blog_tagovi = $_POST['blog_tagovi'];
  $currentDate = date("d.m.Y");
  $og_title = $_POST['og_title'];
  $og_description = $_POST['og_description'];
  $meta_robots_indexing = $_POST['meta_robots_indexing'];
  $meta_robots_following = $_POST['meta_robots_following'];
  $meta_description = $_POST['meta_description'];
  $meta_author = $_SESSION['username'];
  $cannonical = $_POST['cannonical'];
  $og_type = $_POST['og'];
  $blogID = $_POST['editblog_id'];


  if (isset($_FILES["editblog_slika"]) && $_FILES["editblog_slika"]["error"] == UPLOAD_ERR_OK) {

    $targetDir = "blog/";
    $fileName = basename($_FILES["editblog_slika"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $check = getimagesize($_FILES["editblog_slika"]["tmp_name"]);
    if ($check !== false) {
      // Allow certain file formats
      if (in_array($fileType, array("jpg", "jpeg", "png", "gif"))) {
        // Upload file to server
        if (move_uploaded_file($_FILES["editblog_slika"]["tmp_name"], $targetFilePath)) {
          // Insert image file path into database




          // $sql = "INSERT INTO blog (naslov, sadrzaj, slika, datum, kategorija) VALUES ('$blog_naslov', '$blog_tekst', '$targetFilePath', '$currentDate', '$blog_kategorija')";

          $sql = "UPDATE blog 
						SET sadrzaj = '$blog_tekst',
						naslov = '$blog_naslov',
						slika = '$targetFilePath',
						tags = '$blog_tagovi',
						kategorija = '$blog_kategorija',
            og_title = '$og_title',
            og_description = '$og_description',
            meta_robots_indexing = '$meta_robots_indexing',
            meta_robots_following = '$meta_robots_following',
            meta_description = '$meta_description',
            meta_author = '$meta_author',
            cannonical = '$cannonical',
            og_type = '$og_type'
						WHERE id = '$blogID'";


          if ($conn->query($sql) === TRUE) {
            deleteFilesInFolder('../blogovi');
            sleep(1);
            kreirajBlogove("admin");
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
          } else {
          }

          if (mysqli_query($conn, $insertSql)) {
          } else {
            echo "Error: " . $insertSql . "<br>" . mysqli_error($conn);
          }
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
      } else {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      }
    } else {
      echo "File is not an image.";
    }
  } else {

    $sql = "UPDATE blog 
						SET sadrzaj = '$blog_tekst',
						naslov = '$blog_naslov',
						datum = '$currentDate',
						tags = '$blog_tagovi',
						kategorija = '$blog_kategorija',
            og_title = '$og_title',
            og_description = '$og_description',
            meta_robots_indexing = '$meta_robots_indexing',
            meta_robots_following = '$meta_robots_following',
            meta_description = '$meta_description',
            meta_author = '$meta_author',
            cannonical = '$cannonical',
            og_type = '$og_type'
						WHERE id = '$blogID'";


    if ($conn->query($sql) === TRUE) {
      deleteFilesInFolder('../blogovi');
      sleep(1);
      kreirajBlogove("admin");
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
    } else {
    }
  }




  // Check if image file is a actual image or fake image



}

// KRAJ EDIT BLOG

// EDIT EDUKACIJA KATEGORIJA

if (isset($_POST['editedukat_submit']) && $_SERVER["REQUEST_METHOD"] == "POST") {
  // Process form 1 data

  $edu_imekat = $_POST['ime_kat'];
  $edu_tagovikat = $_POST['edu_tagovikat'];

  $edu_katID = $_POST['editkat_id'];


  if (isset($_FILES["kategorije_edukacija_img"]) && $_FILES["kategorije_edukacija_img"]["error"] == UPLOAD_ERR_OK) {

    $targetDir = "uploads/";
    $fileName = basename($_FILES["kategorije_edukacija_img"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $check = getimagesize($_FILES["kategorije_edukacija_img"]["tmp_name"]);
    if ($check !== false) {
      // Allow certain file formats
      if (in_array($fileType, array("jpg", "jpeg", "png", "gif"))) {
        // Upload file to server
        if (move_uploaded_file($_FILES["kategorije_edukacija_img"]["tmp_name"], $targetFilePath)) {
          // Insert image file path into database
          $sql = "UPDATE kategorije 
						SET ime = '$edu_imekat',
						tagovi = '$edu_tagovikat',
						slika = '$targetFilePath'
						WHERE id = '$edu_katID'";


          if ($conn->query($sql) === TRUE) {
            deleteFilesInFolder('../excelum-edukacije');
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
          } else {
          }

          if (mysqli_query($conn, $insertSql)) {
          } else {
            echo "Error: " . $insertSql . "<br>" . mysqli_error($conn);
          }
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
      } else {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      }
    } else {
      echo "File is not an image.";
    }
  } else {

    $sql = "UPDATE kategorije 
						SET ime = '$edu_imekat',
						tagovi = '$edu_tagovikat'
						WHERE id = '$edu_katID'";


    if ($conn->query($sql) === TRUE) {
      deleteFilesInFolder('../excelum-edukacije');
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
    } else {
    }
  }




  // Check if image file is a actual image or fake image



}

// KRAJ EDIT EDUKACIJA KATEGORIJA


// KREIRAJ OBAVIJEST

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_FILES["sliketina"]) && $_FILES["sliketina"]["error"] == UPLOAD_ERR_OK) {
    $sql = "SELECT * FROM obavijesti";

    // Execute SQL query
    $result = $conn->query($sql);

    // Check if any rows were returned
    if ($result->num_rows >= 3) {
      // $message = "Već postoje 3 obavijesti!";
      // echo "<script>prompt('$message');</script>";
    } else {
      /// Process form 1 data

      // SLIKE

      $targetDir = "uploads/";
      $fileName = basename($_FILES["sliketina"]["name"]);
      $targetFilePath = $targetDir . $fileName;
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

      // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["sliketina"]["tmp_name"]);
      if ($check !== false) {
        // Allow certain file formats
        if (in_array($fileType, array("jpg", "jpeg", "png", "gif"))) {
          // Upload file to server
          if (move_uploaded_file($_FILES["sliketina"]["tmp_name"], $targetFilePath)) {
            // Insert image file path into database

            $naslov = $_POST['naslov_obavijesti'];
            $link = $_POST['link_obavijesti'];
            $ime = $_POST['ime_slike'];
            $alt = $_POST['alt_slike'];
            $sql = "INSERT INTO obavijesti (naslov, link, slika, ime_slike, alt_slike) VALUES ('$naslov', '$link', '$targetFilePath', '$ime', '$alt')";

            if ($conn->query($sql) === TRUE) {
              header("Location: " . $_SERVER['PHP_SELF']);
              exit();
              // echo "<p>Item with ID $item_id has been pinned successfully.</p>";
            } else {
              //echo "Error deleting record: " . $conn->error;
            }


            if (mysqli_query($conn, $insertSql)) {
              // echo "The file ". htmlspecialchars($fileName). " has been uploaded and saved to database.";
            } else {
              echo "Error: " . $insertSql . "<br>" . mysqli_error($conn);
            }
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        } else {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
      } else {
        echo "File is not an image.";
      }

      // KRAJ SLIKA



    }
  } else {

  }
}






// Close connection
$conn->close();

// Include your database connection file or use PDO or mysqli

?>


<!DOCTYPE html>
<html>

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="/assets/images/Excelum logo sivi.png">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Excelum CMS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://kit.fontawesome.com/68b247d654.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">




</head>

<body>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>



  <!-- jQuery library (required) 
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
  <script src="script.js"></script>


  <script>

    function editBlog() {

      setTimeout(function () {
        var myModal = new bootstrap.Modal(document.getElementById("editModal"));
        myModal.toggle();
      }, 250);



    }

    function editedukat() {

      setTimeout(function () {
        var myModal = new bootstrap.Modal(document.getElementById("editEduKatModal"));
        myModal.toggle();
      }, 250);



    }

    function editedu() {

      setTimeout(function () {
        var myModal = new bootstrap.Modal(document.getElementById("editEduModal"));
        myModal.toggle();
      }, 250);



    }

  </script>

  <style>
    html,
    body {
      color: #dcdcdc !important;
      background-image: none !important;
      background-color: #292929 !important;
      font-family: Montserrat;
    }

    .modal {
      color: black;
    }
  </style>



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

  <script>

    document.addEventListener('DOMContentLoaded', function () {
      // Find all buttons with the class "closeModalBtn"
      var closeModalBtns = document.querySelectorAll('.closeModalBtn');

      // Add a click event listener to each button
      closeModalBtns.forEach(function (button) {
        button.addEventListener('click', function () {
          // Reload the window when any button is clicked
          console.log('Button clicked');
          window.location.href = 'https://admin.excelum.hr/index.php';
        });
      });
    });




    var cardCount3 = 0;

    // Function to add a new accordion card

    function addEditEduCardPostojeci(glava, rep) {
      cardCount3++;
      var cardHtml = `
            <div class="card">
                <div class="card-header" id="heading${cardCount3}">
                    <h5 class="mb-0">
                        <input type="text" class="form-control" id="cardHeading${cardCount3}" name="cardHeadings[]" placeholder="Sadrzaj ${cardCount3} Naslov" value="${glava}">
                        <span class="ml-2" data-bs-toggle="collapse" data-bs-target="#collapse${cardCount3}" aria-expanded="true" aria-controls="collapse${cardCount3}">
                            <i class="fa fa-arrow-down"></i>
                        </span>
                        <button type="button" class="btn-close delete-card" aria-label="Close">
                            
                        </button>
                    </h5>
                </div>
                <div id="collapse${cardCount3}" class="collapse" aria-labelledby="heading${cardCount3}" data-parent="#editEduHarmonika">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="cardContent${cardCount3}">Sadrzaj ${cardCount3} tekst:</label>
                            <textarea class="form-control add-li-on-enter" id="cardContent${cardCount3}" name="cardContents[]" rows="3" placeholder="Upisi tekst">${rep}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
      document.addEventListener('DOMContentLoaded', function () {
        $('#editEduHarmonika').append(cardHtml);
        $('.add-li-on-enter').off('keydown').on('keydown', function (event) {
          const key = event.key;

          // Check if the pressed key is Enter
          if (key === 'Enter') {
            event.preventDefault(); // Prevent default Enter behavior (new line)

            const cursorPosition = this.selectionStart; // Get cursor position
            const text = this.value; // Get current textarea value

            // Split the textarea value into two parts
            const beforeCursor = text.substring(0, cursorPosition);
            const afterCursor = text.substring(cursorPosition);

            // Construct the new textarea value with <li></li> inserted at cursor position
            const newValue = beforeCursor + '\n<li></li>' + afterCursor;

            // Update the textarea value
            this.value = newValue;

            // Move the cursor position to after the inserted <li></li>
            this.selectionStart = cursorPosition + 5; // +9 to move cursor after <li></li> and \n
            this.selectionEnd = cursorPosition + 5;
          }
        });
      });
    }
    document.addEventListener('DOMContentLoaded', function () {
      function addEditEduCard() {



        cardCount3++;
        var cardHtml = `
            <div class="card">
                <div class="card-header" id="heading${cardCount3}">
                    <h5 class="mb-0">
                        <input type="text" class="form-control" id="cardHeading${cardCount3}" name="cardHeadings[]" placeholder="Sadrzaj ${cardCount3} Naslov">
                        <span class="ml-2" data-bs-toggle="collapse" data-bs-target="#collapse${cardCount3}" aria-expanded="true" aria-controls="collapse${cardCount3}">
                            <i class="fa fa-arrow-down"></i>
                        </span>
                        <button type="button" class="btn-close delete-card" aria-label="Close">
                            
                        </button>
                    </h5>
                </div>
                <div id="collapse${cardCount3}" class="collapse" aria-labelledby="heading${cardCount3}" data-parent="#accordion">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="cardContent${cardCount3}">Sadrzaj ${cardCount3} tekst:</label>
                            <textarea class="form-control add-li-on-enter" id="cardContent${cardCount3}" name="cardContents[]" rows="3" placeholder="Upisi tekst"><li></li></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#editEduHarmonika').append(cardHtml);

        $('.add-li-on-enter').off('keydown').on('keydown', function (event) {
          const key = event.key;

          // Check if the pressed key is Enter
          if (key === 'Enter') {
            event.preventDefault(); // Prevent default Enter behavior (new line)

            const cursorPosition = this.selectionStart; // Get cursor position
            const text = this.value; // Get current textarea value

            // Split the textarea value into two parts
            const beforeCursor = text.substring(0, cursorPosition);
            const afterCursor = text.substring(cursorPosition);

            // Construct the new textarea value with <li></li> inserted at cursor position
            const newValue = beforeCursor + '\n<li></li>' + afterCursor;

            // Update the textarea value
            this.value = newValue;

            // Move the cursor position to after the inserted <li></li>
            this.selectionStart = cursorPosition + 5; // +9 to move cursor after <li></li> and \n
            this.selectionEnd = cursorPosition + 5;
          }
        });
      }

      // Event listener for Add Card button
      $('#dodajEditEduSadrzaj').click(function () {
        addEditEduCard();
      });

      // Event delegation for delete button
      $('#editEduHarmonika').on('click', '.delete-card', function () {
        $(this).closest('.card').remove();
        cardCount3--;
      });


    });

    var cardCount4 = 0;


    function addEditEduPostojeciCiljCard(tekst) {
      cardCount4++;
      var cardHtml2 = `
            <div class="card">
                <div class="card-header" id="heading${cardCount4}">
                    <h5 class="mb-0">
                        <input type="text" class="form-control" id="ciljHeading${cardCount4}" name="educiljHeadings[]" placeholder="Cilj ${cardCount4} Naslov" value="${tekst}">
                        <button type="button" class="btn-close delete-card" aria-label="Close">
                            
                        </button>
                    </h5>
                </div>
            </div>
        `;
      document.addEventListener('DOMContentLoaded', function () {
        $('#ciljeviEdit').append(cardHtml2);
      });
    }
    document.addEventListener('DOMContentLoaded', function () {
      function addEditEduCiljCard() {
        cardCount4++;
        var cardHtml2 = `
            <div class="card">
                <div class="card-header" id="heading${cardCount4}">
                    <h5 class="mb-0">
                        <input type="text" class="form-control" id="ciljHeading${cardCount4}" name="educiljHeadings[]" placeholder="Cilj ${cardCount4} Naslov">
                        <button type="button" class="btn-close delete-card" aria-label="Close">
                            
                        </button>
                    </h5>
                </div>
            </div>
        `;
        $('#ciljeviEdit').append(cardHtml2);
      }

      // Event listener for Add Card button
      $('#addCiljBtnEdit').click(function () {
        addEditEduCiljCard();
      });

      // Event delegation for delete button
      $('#ciljeviEdit').on('click', '.delete-card', function () {
        $(this).closest('.card').remove();
        cardCount4--;
      });

    });
  </script>



  <?php
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

  if (isset($_GET['editedu'])) {
    $item_id = $_GET['editedu'];

    // Prepare SQL query
    $sql = "SELECT * FROM edukacije WHERE id = $item_id";

    // Execute SQL query
    $result = $conn->query($sql);

    // Check if any rows were returned
    if ($result->num_rows > 0) {
      // Output data of each row
      while ($row = $result->fetch_assoc()) {


        $sql2 = "SELECT * FROM kategorije";
        $result2 = $conn->query($sql2);

        $editedu_kategorije = "";

        if ($result2->num_rows > 0) {
          while ($row2 = $result2->fetch_assoc()) {

            $id_editedukat = $row2["id"];

            $prava = $row["kategorija"];
            if ($id_editedukat === $prava) {
              $editedu_kategorije .= "<option selected value='" . $id_editedukat . "'>" . $row2["ime"] . "</option>";
            } else {
              $editedu_kategorije .= "<option value='" . $id_editedukat . "'>" . $row2["ime"] . "</option>";
            }
          }
        } else {
          $editedu_kategorije = "";
        }

        $editedu_ime = $row["ime"];
        $editedu_kategorija = $row["kategorija"];
        $editedu_kropis = $row["kratki_opis"];
        $editedu_dugopis = $row["dugi_opis"];
        $editedu_trajanje = $row["trajanje"];
        $editedu_cijena = $row["cijena"];
        $editedu_tagovi = $row["tagovi"];

        $editedu_metadescription = $row["meta_description"];
        $editedu_ogtitle = $row["og_title"];
        $editedu_ogdescription = $row["og_description"];

        $id_edu = $row["id"];

        $accordionData = $row['sadrzaj'];

        $accordionArray = json_decode($accordionData, true);

        // Initialize the variable to store HTML for the accordion
        $accordionHTML = '';

        // Check if the array is not empty
        if (!empty($accordionArray)) {
          // Output the HTML for the accordion
          foreach ($accordionArray as $index => $accordionItem) {
            $glava = htmlspecialchars($accordionItem['heading']);
            $rep = htmlspecialchars($accordionItem['content']);
            echo "<script>addEditEduCardPostojeci('$glava', '$rep');</script>";
          }
        } else {
          $accordionHTML = '';
        }

        $ciljData = $row['ciljevi'];

        $ciljArray = json_decode($ciljData, true);

        // Initialize the variable to store HTML for the accordion
        $ciljHTML = '';

        // Check if the array is not empty
        if (!empty($ciljArray)) {
          // Output the HTML for the accordion
          foreach ($ciljArray as $index => $ciljItem) {
            $tekst = htmlspecialchars($ciljItem['heading']);
            echo "<script>addEditEduPostojeciCiljCard('$tekst');</script>";
          }
        } else {
          $ciljHTML = '';
        }

        echo "<script>editedu();</script>";
      }
    } else {
      // echo "0 results";
    }
  }

  // EDIT EDUKACIJA
  
  if (isset($_POST['editedukacija_submit']) && $_SERVER["REQUEST_METHOD"] == "POST") {




    $edu_naslov = $_POST['ime_edu'];
    $edu_kategorija = $_POST['edu_kategorija'];
    $edu_kropis = $_POST['kropis_edu'];
    $edu_dugopis = $_POST['dugopis_edu'];

    $edu_trajanje = $_POST['edu_trajanje'];
    $edu_cijena = $_POST['edu_cijena'];

    $edu_ciljevi = ".";
    $edu_tagovi = $_POST['edu_tagovi'];

    $edu_id = $_POST['editedu_id'];

      $og_title_edu = $_POST['og_title_edu'];
      $og_description_edu = $_POST['og_description_edu'];
      $meta_robots_indexing_edu = $_POST['meta_robots_indexing_edu'];
      $meta_robots_following_edu = $_POST['meta_robots_following_edu'];
      $meta_description_edu = $_POST['meta_description_edu'];
      $meta_author_edu = $_SESSION['username'];
      $cannonical_edu = $_POST['cannonical_edu'];
      $og_type_edu = $_POST['og_type_edu'];
    

    //sva ova sranja samo za harmoniku
  
    // Prepare data for insertion
    if (isset($_POST['cardHeadings'])) {
      $cardHeadings = $_POST['cardHeadings'];
      $cardContents = $_POST['cardContents'];

      // Remove leading and trailing whitespace, including newlines
      $cardContents = array_map('trim', $cardContents);

      // Combine headings and contents into a single array
      $accordionData = [];
      for ($i = 0; $i < count($cardHeadings); $i++) {
        // Optionally, replace newlines with a space
        // $content = str_replace("\n", "", $cardContents[$i]);
  
        // $content = str_replace("\"", "\\\"", $cardContents[$i]);
  
        $content = preg_replace("/[\r\n]+/", "", $cardContents[$i]);


        // Or, remove newlines altogether
        // $content = str_replace("\n", "", $cardContents[$i]);
  
        $accordionData[] = array(
          'heading' => $cardHeadings[$i],
          'content' => $content
        );
      }

    }

    // Convert array to JSON format
    $edu_sadrzaj = json_encode($accordionData, JSON_UNESCAPED_UNICODE);
    // var_dump($edu_sadrzaj);
    // kraj harmonike
  
    //sva ova sranja samo za ciljeve
  
    // Prepare data for insertion
    if (isset($_POST['educiljHeadings'])) {
      $ciljHeadings = $_POST['educiljHeadings'];

      // Combine headings and contents into a single array
      $accordionData2 = [];
      for ($i = 0; $i < count($ciljHeadings); $i++) {
        $accordionData2[] = array(
          'heading' => $ciljHeadings[$i]
        );
      }

      // Convert array to JSON format
      $edu_ciljevi = json_encode($accordionData2, JSON_UNESCAPED_UNICODE);
    } else {
      $edu_ciljevi = "[]";
    }



    // kraj ciljeva
  
    if (isset($_FILES["editedukacija_img"]) && $_FILES["editedukacija_img"]["error"] == UPLOAD_ERR_OK) {
      // Upload main image to server
      $targetDirCategory = "uploads/";
      $fileNameCategory = basename($_FILES["editedukacija_img"]["name"]);
      $targetFilePathCategory = $targetDirCategory . $fileNameCategory;

      if (move_uploaded_file($_FILES["editedukacija_img"]["tmp_name"], $targetFilePathCategory)) {

        $sql = "UPDATE edukacije 
        SET ime = '$edu_naslov', 
            kategorija = '$edu_kategorija', 
            kratki_opis = '$edu_kropis', 
            dugi_opis = '$edu_dugopis', 
            ciljevi = '$edu_ciljevi', 
            trajanje = '$edu_trajanje', 
            cijena = '$edu_cijena', 
            tagovi = '$edu_tagovi', 
            sadrzaj = '$edu_sadrzaj',
            og_title = '$og_title_edu',
            og_description = '$og_description_edu',
            meta_robots_indexing = '$meta_robots_indexing_edu',
            meta_robots_following = '$meta_robots_following_edu',
            meta_description = '$meta_description_edu',
            meta_author = '$meta_author_edu',
            cannonical = '$cannonical_edu',
            og_type = '$og_type_edu',
			slika = '$targetFilePathCategory'
        WHERE id = $edu_id";

      }

    } else {
      $sql = "UPDATE edukacije 
        SET ime = '$edu_naslov', 
            kategorija = '$edu_kategorija', 
            kratki_opis = '$edu_kropis', 
            dugi_opis = '$edu_dugopis', 
            ciljevi = '$edu_ciljevi', 
            trajanje = '$edu_trajanje', 
            cijena = '$edu_cijena', 
            tagovi = '$edu_tagovi', 
            sadrzaj = '$edu_sadrzaj',
            og_title = '$og_title_edu',
            og_description = '$og_description_edu',
            meta_robots_indexing = '$meta_robots_indexing_edu',
            meta_robots_following = '$meta_robots_following_edu',
            meta_description = '$meta_description_edu',
            meta_author = '$meta_author_edu',
            cannonical = '$cannonical_edu',
            og_type = '$og_type_edu'
        WHERE id = $edu_id";
    }

    // Insert main image and alt image text paths into database
  


    if ($conn->query($sql) === TRUE) {
      deleteFilesInFolder('../excelum-edukacije');
      sleep(1);
      kreirajEdukacije("admin");
      echo "<script>window.location.href = 'https://admin.excelum.hr/index.php';</script>";
      // header("Location: " . $_SERVER['PHP_SELF']);
      // exit();
    } else {
      // echo "Error: " . $sql . "<br>" . $conn->error;
    }

  }
  ?>


  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var textarea = document.getElementById("txtarea-input");

      textarea.addEventListener("keydown", function (event) {
        if (event.key === "Enter" && event.target === textarea) {
          event.preventDefault();
          var cursorPosition = textarea.selectionStart;
          var textBeforeCursor = textarea.value.substring(0, cursorPosition);
          var textAfterCursor = textarea.value.substring(cursorPosition);
          textarea.value = textBeforeCursor + "<br>" + textAfterCursor;
          textarea.selectionStart = textarea.selectionEnd = cursorPosition + 4; // Set cursor position after "<br>"
        }
      });
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var textarea = document.getElementById("txtarea-input1");

      textarea.addEventListener("keydown", function (event) {
        if (event.key === "Enter" && event.target === textarea) {
          event.preventDefault();
          var cursorPosition = textarea.selectionStart;
          var textBeforeCursor = textarea.value.substring(0, cursorPosition);
          var textAfterCursor = textarea.value.substring(cursorPosition);
          textarea.value = textBeforeCursor + "<br>" + textAfterCursor;
          textarea.selectionStart = textarea.selectionEnd = cursorPosition + 4; // Set cursor position after "<br>"
        }
      });
    });
  </script>
  <?php
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
  if (isset($_GET['edit'])) {
    $item_id = $_GET['edit'];

    // Prepare SQL query
    $sql = "SELECT * FROM blog WHERE id = $item_id";

    // Execute SQL query
    $result = $conn->query($sql);

    // Check if any rows were returned
    if ($result->num_rows > 0) {
      // Output data of each row
      while ($row = $result->fetch_assoc()) {


        $sql2 = "SELECT * FROM kategorije_blogovi";
        $result2 = $conn->query($sql2);

        $editblog_kategorije = "";

        if ($result2->num_rows > 0) {
          while ($row2 = $result2->fetch_assoc()) {

            $prava = $row["kategorija"];
            if ($row2["ime"] === $prava) {
              $editblog_kategorije .= "<option selected value='" . $row2["ime"] . "'>" . $row2["ime"] . "</option>";
            } else {
              $editblog_kategorije .= "<option value='" . $row2["ime"] . "'>" . $row2["ime"] . "</option>";
            }
          }
        } else {
          $editblog_kategorije = "";
        }

        $naslov_blog = $row["naslov"];
        $tagovi_blog = $row["tags"];
        $sadrzaj_blog = $row["sadrzaj"];
        $id_blog = $row["id"];
        $meta_description = $row["meta_description"];
        $meta_author = $row["meta_author"];
        $meta_robots_indexing = $row["meta_robots_indexing"];
        $meta_robots_following = $row["meta_robots_following"];
        $og_title = $row["og_title"];
        $og_description = $row["og_description"];
        $og_type = $row["og_type"];
        $cannonical = $row["cannonical"];


        echo "<script>editBlog();</script>";
      }
    } else {
      // echo "0 results";
    }
  }

  if (isset($_GET['editedukat'])) {
    $item_id = $_GET['editedukat'];

    // Prepare SQL query
    $sql = "SELECT * FROM kategorije WHERE id = $item_id";

    // Execute SQL query
    $result = $conn->query($sql);

    // Check if any rows were returned
    if ($result->num_rows > 0) {
      // Output data of each row
      while ($row = $result->fetch_assoc()) {

        $edukat_ime = $row["ime"];

        $edukat_tagovi = $row["tagovi"];

        $id_edukat = $row["id"];

      }
      echo "<script>editedukat();</script>";
    } else {
      // echo "0 results";
    }
  }
  ?>



  <div class="container-fluid">
    <div class="row flex-nowrap p-2">
      <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
        <i class="fa fa-bars"></i>
      </button>

      <div class="offcanvas offcanvas-start" style="background:linear-gradient(to bottom, #0097b2, #56c474);"
        data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
        aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
          <div class="col-8 d-flex justify-content-end">
            <a href="#" class="text-black text-decoration-none dropdown-toggle" id="dropdownUser1"
              data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-user fa-2xl"></i>
              <span class="d-sm-inline mx-1">
                <?php echo htmlspecialchars($_SESSION['username']); ?>
              </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
              <li><a class="dropdown-item" href="#">Settings*</a></li>
              <li><a class="dropdown-item" href="#">Profile*</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form method="post">
                  <a class="dropdown-item" href="#" type="submit" name="logout"
                    onclick="document.getElementById('logoutForm').submit(); return false;">Sign out</a>
                </form>
              </li>
            </ul>

          </div>


          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>

        </div>
        <div class="offcanvas-body text-center">
          <hr>
          <img class="img-fluid pt-3" src="assets/images/Excelum logo sivi.png" alt="">
          <p class=" font-italic">APOS & Excelum marketing team</p>
        </div>
        <div class="offcanvas-footer text-center pb-3 pt-3">
          <hr>
          <form id="logoutForm" method="post">
            <a href="#" style="text-decoration: none; color:black;"
              onclick="document.getElementById('logoutForm').submit(); return false;">
              <i class="fa fa-power-off fa-2xl"></i>
              <span class="d-sm-inline mx-1">Logout</span>
            </a>
            <input type="hidden" name="logout">
          </form>
        </div>
      </div>

    </div>
    <main class="col ps-md-2 pt-2">

      <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editModal">Uredi blog</h5>
              <button type="button" class="btn-close closeModalBtn" data-bs-dismiss="modal" id="closeModalBtn"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation"><a class="nav-link active" id="tab1-tab" data-bs-toggle="tab"
                    data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1"
                    aria-selected="true">Općenito</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" id="tab2-tab" data-bs-toggle="tab"
                    data-bs-target="#tab2" type="button" role="tab" aria-controls="tab" aria-selected="false">SEO</a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">

                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-12">

                        <form method="POST" action="" id="bezentera" enctype="multipart/form-data">
                          <input type="text" style="display:none;" name="editblog_id" value="<?php echo $id_blog; ?>">
                          <input type="text" class="txt-input" name="blog_naslov" placeholder="Naslov..."
                            value="<?php echo $naslov_blog; ?>">
                          <select class="custom-select form-select form-select-lg" name="blog_kategorija"
                            id="blog_kategorija">
                            <option id="penis" disabled>Odaberi kategoriju...</option>
                            <?php echo $editblog_kategorije; ?>
                          </select>
                          <br>
                          <input type="file" name="editblog_slika">
                          <textarea class="txtarea-input1" name="blog_tekst" id="txtarea-input1" cols="30" rows="10"
                            placeholder="Tekst..."><?php echo $sadrzaj_blog; ?></textarea>
                          <button type="button" class="edits" onclick="editText('bold')"><i
                              class="fas fa-bold"></i></button>
                          <button type="button" class="edits" onclick="editText('italic')"><i
                              class="fa-solid fa-italic"></i></button>
                          <button type="button" class="edits" onclick="editText('underline')"><i
                              class="fa-solid fa-underline"></i></button><br>
                          <button type="button" class="edits" onclick="editText('h1')">H1</button>
                          <button type="button" class="edits" onclick="editText('h2')">H2</button>
                          <button type="button" class="edits" onclick="editText('h3')">H3</button><br>
                          <button type="button" class="edits" onclick="editText('link')"><i
                              class="fa-solid fa-link"></i></button>
                          <button type="button" class="edits" onclick="editText('list')"><i
                              class="fa-solid fa-list"></i></button>
                          <input type="file" id="dodatni_input_blog" style="width:33%;" name="blog_slika_tekst"
                            onclick="editText('dodatna_slika')">
                          <!-- <input style="display:none;" type="file" id="formFile" class="file-input-edits">
                                  <label for="formFile" class="file-input-edits" style="text-align: center;"><i
                                      class="fa fa-upload" aria-hidden="true"></i></label> -->


                          <input type="text" class="txt-input" name="blog_tagovi" placeholder="Tagovi..."
                            value="<?php echo $tagovi_blog; ?>">

                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade show" id="tab2" role="tabpanel" aria-labelledby="tab1-tab">

                  <div class="container-fluid">
                    <div class="row">

                      <div class="col-12 pt-3">
                        <h4 class="fw-bold">Meta description</h4>
                        <textarea class="txtarea-input w-100 br-3" rows="4" name="meta_description"
                          id=""><?php echo $meta_description; ?></textarea>
                        <div class="row pb-3">
                          <div class="col-6">
                            <h4 class="fw-bold">Meta Robots</h4>
                            <div class="row">
                              <div class="col-4">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="meta_robots_indexing"
                                    id="flexRadioDefault1" value="index" checked>
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    index
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="meta_robots_indexing"
                                    id="flexRadioDefault2" value="noindex">
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    noindex
                                  </label>
                                </div>
                              </div>
                              <div class="col-8">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="meta_robots_following"
                                    id="flexRadioDefault1" value="follow" checked>
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    follow
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="meta_robots_following"
                                    id="flexRadioDefault2" value="nofollow">
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    nofollow
                                  </label>
                                </div>
                              </div>
                            </div>

                          </div>
                          <div class="col-6">
                            <h4 class="fw-bold">Cannonical tag</h4>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="cannonical" id="flexRadioDefault1"
                                value="1" checked>
                              <label class="form-check-label" for="flexRadioDefault1">
                                da
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="cannonical" id="flexRadioDefault2"
                                value="0">
                              <label class="form-check-label" for="flexRadioDefault2">
                                ne
                              </label>
                            </div>
                          </div>
                        </div>
                        <h4 class="fw-bold">Open graph</h4>
                        <label for="">OG title</label> <br>
                        <input type="text" class="txt-input" class="w-100" name="og_title"
                          value="<?php echo $og_title; ?>">
                        <label for="">OG description</label>
                        <input type="text" class="txt-input" class="w-100" name="og_description"
                          value="<?php echo $og_description; ?>">
                        <div class="row pb-3">
                          <div class="col-2"><label for="">OG type</label></div>
                          <div class="col-10">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="og" id="flexRadioDefault1"
                                value="article" checked>
                              <label class="form-check-label" for="flexRadioDefault1">
                                article
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="og" id="flexRadioDefault2"
                                value="website">
                              <label class="form-check-label" for="flexRadioDefault2">
                                website
                              </label>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-2"><label for="">OG image</label></div>
                          <div class="col-10">
                            <input type="file" class="w-100">
                          </div>
                        </div>



                        <h4 class="fw-bold">Tagovi</h4>
                        <input type="text" class="txt-input" class="w-100" name="blog_tagovi"
                          value="<?php echo $tagovi_blog; ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary closeModalBtn" data-bs-dismiss="modal"
                id="closeModalBtn">Odustani</button>
              <button type="submit" class="btn btn-primary" name="editblog_submit">Uredi</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="editEduKatModal" tabindex="-1" role="dialog" aria-labelledby="editEduKatModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editEduKatModal">Uredi kategoriju edukacija</h5>
              <button type="button" class="btn-close closeModalBtn" data-bs-dismiss="modal" id="closeModalBtn"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <form id="bezentera" method="post" enctype="multipart/form-data" onkeydown="if(event.keyCode === 13) { 
    return false;
}">
                <input type="text" style="display:none;" name="editkat_id" value="<?php echo $id_edukat; ?>">
                <input type="text" class="txt-input" id="ime_kat" name="ime_kat" placeholder="Ime kategorije..."
                  value="<?php echo $edukat_ime; ?>">
                <input type="text" class="txt-input" id="edu_tagovikat" name="edu_tagovikat" placeholder="Tagovi..."
                  value="<?php echo $edukat_tagovi; ?>">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary closeModalBtn" data-bs-dismiss="modal"
                id="closeModalBtn">Zatvori</button>
              <button type="submit" class="btn btn-primary" name="editedukat_submit">Spremi</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="editEduModal" tabindex="-1" role="dialog" aria-labelledby="editEduModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editEduModal">Uredi edukaciju</h5>
              <button type="button" class="btn-close closeModalBtn" data-bs-dismiss="modal" id="closeModalBtn"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <ul class = "nav nav-tabs" role ="tablist">
                              <li class="nav-item" role="presentation"><a class="nav-link active" id="tab7-tab" data-bs-toggle="tab" data-bs-target="#tab7" type="button" role="tab" aria-controls="tab7" aria-selected="true">Općenito</a></li>
                              <li class="nav-item" role="presentation"><a class="nav-link" id="tab8-tab" data-bs-toggle="tab" data-bs-target="#tab8" type="button" role="tab" aria-controls="tab" aria-selected="false">SEO</a></li>
                            </ul>
                        <div class="tab-content">
                          <div class="tab-pane fade show active" id="tab7" role="tabpanel" aria-labelledby="tab1-tab">
              <form method="post" enctype="multipart/form-data">

                <input type="text" class="txt-input" id="ime_edu" name="ime_edu" value="<?php echo $editedu_ime; ?>"
                  placeholder="Ime edukacije...">
                <input type="text" style="display:none;" id="editedu_id" name="editedu_id"
                  value="<?php echo $id_edu; ?>">
                <div class="input-group mb-2" style="width:100% !important;">
                  <select class="custom-select form-select-lg" name="edu_kategorija"
                    id="edu_kategorija">
                                <option value="showAll">Prikaži sve</option>
                                <?php echo $editedu_kategorije; ?>

                              </select>
                            </div>
              <input type="file" name="editedukacija_img">
                            <input type="text" class="txt-input" id="kropis_edu" name="kropis_edu" value="<?php echo $editedu_kropis; ?>" placeholder="Kratak opis edukacije...">
                            <input type="text" class="txt-input" id="dugopis_edu" name="dugopis_edu" value="<?php echo $editedu_dugopis; ?>" placeholder="Duži opis edukacije...">
                            <!-- Default dropright button -->
              <h5 style="color:black">Sadržaj</h5>
                            <div id="editEduHarmonika">
              <!-- Accordion cards will be dynamically added here -->
              </div>
              <button type="button" class="btn btn-primary mt-3" id="dodajEditEduSadrzaj">Dodaj sadrzaj</button>
              <h5 style="color:black">Ciljevi</h5>
                            <div id="ciljeviEdit">
              <!-- Accordion cards will be dynamically added here -->
              </div>
              <button type="button" class="btn btn-primary mt-3" id="addCiljBtnEdit">Dodaj cilj</button>
                            <input type="text" class="txt-input" id="edu_trajanje" name="edu_trajanje" value="<?php echo $editedu_trajanje; ?>" placeholder="Trajanje...">
                            <input type="text" class="txt-input" id="edu_cijena" name="edu_cijena" value="<?php echo $editedu_cijena; ?>" placeholder="Cijena...">
                            <!--<input type="text" class="txt-input" id="editedu_tagovi" name="editedu_tagovi" value="" placeholder="Tagovi...">-->


                          </div>
                          <div class="tab-pane fade show" id="tab8" role="tabpanel" aria-labelledby="tab8-tab">

<div class="container-fluid">
  <div class="row">

    <div class="col-12 pt-3">
      <h4 class="fw-bold">Meta description</h4>
      <textarea class="txtarea-input w-100 br-3" rows="4" name="meta_description_edu" id=""><?php echo $editedu_metadescription; ?></textarea>
      <div class="row pb-3">
      <div class="col-6">
      <h4 class="fw-bold">Meta Robots</h4>
      <div class="row">
        <div class="col-4">
        <div class="form-check">
      <input class="form-check-input" type="radio" name="meta_robots_indexing_edu" id="flexRadioDefault1" value="index" checked>
      <label class="form-check-label" for="flexRadioDefault1">
        index
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="meta_robots_indexing_edu" id="flexRadioDefault2" value="noindex">
      <label class="form-check-label" for="flexRadioDefault2">
        noindex
      </label>
    </div>
        </div>
        <div class="col-8">
        <div class="form-check">
      <input class="form-check-input" type="radio" name="meta_robots_following_edu" id="flexRadioDefault1" value="follow" checked>
      <label class="form-check-label" for="flexRadioDefault1">
        follow
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="meta_robots_following_edu" id="flexRadioDefault2" value="nofollow">
      <label class="form-check-label" for="flexRadioDefault2">
        nofollow
      </label>
    </div>
        </div>
      </div>
      
      </div>
      <div class="col-6">
      <h4 class="fw-bold">Cannonical tag</h4>
      <div class="form-check">
      <input class="form-check-input" type="radio" name="cannonical_edu" id="flexRadioDefault1" value="1" checked>
      <label class="form-check-label" for="flexRadioDefault1">
        da
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="cannonical_edu" id="flexRadioDefault2" value="0">
      <label class="form-check-label" for="flexRadioDefault2">
        ne
      </label>
    </div>
      </div>
      </div>
      <h4 class="fw-bold">Open graph</h4>
      <label for="">OG title</label> <br>
      <input type="text" class="txt-input" name="og_title_edu" value="<?php echo $editedu_ogtitle; ?>" class="w-100">
      <label for="">OG description</label>
      <input type="text" class="txt-input" name="og_description_edu" value="<?php echo $editedu_ogdescription; ?>" class="w-100">
      <div class="row pb-3">
        <div class="col-2"><label for="">OG type</label></div>
        <div class="col-10">
        <div class="form-check">
      <input class="form-check-input" type="radio" name="og_type_edu" id="flexRadioDefault1" value="article" checked>
      <label class="form-check-label" for="flexRadioDefault1">
        article
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="og_type_edu" id="flexRadioDefault2" value="website">
      <label class="form-check-label" for="flexRadioDefault2">
        website
      </label>
    </div>
        </div>
      </div>

      <div class="row">
        <div class="col-2"><label for="">OG image</label></div>
        <div class="col-10">
        <input type="file" class="w-100">
        </div>
      </div>

      
      
      <h4 class="fw-bold">Tagovi</h4>
      <input type="text" class="txt-input" name="edu_tagovi" class="w-100" value="<?php echo $editedu_tagovi; ?>">
    </div></div></div></div></div>   
</div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary closeModalBtn" data-bs-dismiss="modal" id="closeModalBtn">Zatvori</button>
                            <button type="submit" class="btn btn-primary" name="editedukacija_submit">Spremi</button>
                          </div>
              
              </form>
              
                        </div>
                      </div>
                    </div>

      <!-- <a href="#" data-bs-target="#sidebar" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"
          class="border rounded-3 p-1 text-decoration-none"><i class="fa fa-bars fa-xl text-black"></i></a>-->
      <!-- <div class="page-header pt-3 text-center" style="justify-content: space-between;"> -->
      <!-- <h2>Excelum CMS</h2> -->
      <!-- <button>EDUKACIJE</button> -->
      <!-- <button>BLOG</button> -->
      <!-- <button>HOMEPAGE</button>                     -->
      <!-- </div> -->


      <div class="tabs-content">
        <div class="row">
          <div class="page-header pt-3 text-center" style="justify-content: space-between;">
            <h1 style="font-family: Montserrat; font-weight: 200;">EXCELUM CMS <i class="fa-solid fa-server"></i></h1>
            <!-- <button id="appartment-tab" data-bs-toggle="tab" data-bs-target="#appartment" type="button" role="tab" aria-controls="appartment" aria-selected="false">EDUKACIJE</button> -->
            <!-- <button id="villa-tab" data-bs-toggle="tab" data-bs-target="#villa" type="button" role="tab" aria-controls="villa" aria-selected="false">BLOG</button> -->
            <!-- <button id="penthouse-tab" data-bs-toggle="tab" data-bs-target="#penthouse" type="button" role="tab" aria-controls="penthouse" aria-selected="false">HOMEPAGE</button>                     -->
          </div>
          <div class="nav-wrapper ">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="appartment-tab" data-bs-toggle="tab" data-bs-target="#appartment"
                  type="button" role="tab" aria-controls="appartment" aria-selected="true">Edukacije</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="villa-tab" data-bs-toggle="tab" data-bs-target="#villa" type="button"
                  role="tab" aria-controls="villa" aria-selected="false">Blog</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="penthouse-tab" data-bs-toggle="tab" data-bs-target="#penthouse"
                  type="button" role="tab" aria-controls="penthouse" aria-selected="false">Home Page</button>
              </li>
            </ul>
          </div>

          <!-- <hr> -->
          <br>
          <br>
          <br>

          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="appartment" role="tabpanel" aria-labelledby="appartment-tab">

              <!--EDUKACIJE -->

              <div class="row">
                <div class="col-12">

                  <div class="container">

                    <div class="row">
                      <div class="col-8 text-left">
                        <h3 style="margin-bottom: 30px;">Grupe edukacija</h3>
                      </div>
                      <div class="col-4 d-flex justify-content-end">
                        <div class="btn-group dropstart">
                          <div role="button" class="btn-c remove-arrow" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-plus fa-s"></i>
                          </div>
                          <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#kategorija">Kreiraj kategoriju</a></li>
                          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edukacija">Kreiraj edukaciju</a></li>
                        </ul>
                          <!--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#kategorija">Kreiraj
                              kategoriju</a>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edukacija">Kreiraj
                              edukaciju</a>
                          </div>-->
                        </div>
                        


                      </div>
                    </div>

                    <div class="modal fade" id="edukacija" tabindex="-1" role="dialog" aria-labelledby="edukacija"
                      aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="edukacija">Kreiraj edukaciju</h5>
                            <button type="button" class="btn-close closeModalBtn" data-bs-dismiss="modal" id="closeModalBtn" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                          <ul class = "nav nav-tabs" role ="tablist">
                              <li class="nav-item" role="presentation"><a class="nav-link active" id="tab5-tab" data-bs-toggle="tab" data-bs-target="#tab5" type="button" role="tab" aria-controls="tab5" aria-selected="true">Općenito</a></li>
                              <li class="nav-item" role="presentation"><a class="nav-link" id="tab6-tab" data-bs-toggle="tab" data-bs-target="#tab6" type="button" role="tab" aria-controls="tab6" aria-selected="false">SEO</a></li>
                            </ul>
                        <div class="tab-content">
                          <div class="tab-pane fade show active" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">

              <form method="post" enctype="multipart/form-data">
              
                            <input type="text" class="txt-input" id="ime_edu" name="ime_edu" placeholder="Ime edukacije...">
                            <div class="input-group mb-2" style="width:100% !important;">
                              <select class="custom-select form-select-lg" name="edu_kategorija" id="edu_kategorija">
                                <option value="showAll" selected>Prikaži sve</option>
                                <?php echo $kategorije; ?>

                              </select>
                            </div>
              <input type="file" name="edukacija_img">
                            <input type="text" class="txt-input" id="kropis_edu" name="kropis_edu" placeholder="Kratak opis edukacije...">
                            <input type="text" class="txt-input" id="dugopis_edu" name="dugopis_edu" placeholder="Duži opis edukacije...">
                            <!-- Default dropright button -->
              <h5 style="color:black">Sadržaj</h5>
                            <div id="accordion">
              <!-- Accordion cards will be dynamically added here -->
              </div>
              <button type="button" class="btn btn-primary mt-3" id="addCardBtn">Dodaj sadrzaj</button>
              <h5 style="color:black">Ciljevi</h5>
                            <div id="ciljevi">
              <!-- Accordion cards will be dynamically added here -->
              </div>
              <button type="button" class="btn btn-primary mt-3" id="addCiljBtn">Dodaj cilj</button>
                            <input type="text" class="txt-input" id="edu_trajanje" name="edu_trajanje" placeholder="Trajanje...">
                            <input type="text" class="txt-input" id="edu_cijena" name="edu_cijena" placeholder="Cijena...">
                            <!--<input type="text" class="txt-input" id="edu_tagovi" name="edu_tagovi" placeholder="Tagovi...">-->


                          </div>
                  

                          <div class="tab-pane fade show" id="tab6" role="tabpanel" aria-labelledby="tab6-tab">

<div class="container-fluid">
  <div class="row">

    <div class="col-12 pt-3">
      <h4 class="fw-bold">Meta description</h4>
      <textarea class="txtarea-input w-100 br-3" rows="4" name="meta_description_edu" id=""></textarea>
      <div class="row pb-3">
      <div class="col-6">
      <h4 class="fw-bold">Meta Robots</h4>
      <div class="row">
        <div class="col-4">
        <div class="form-check">
      <input class="form-check-input" type="radio" name="meta_robots_indexing_edu" id="flexRadioDefault1" value="index" checked>
      <label class="form-check-label" for="flexRadioDefault1">
        index
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="meta_robots_indexing_edu" id="flexRadioDefault2" value="noindex">
      <label class="form-check-label" for="flexRadioDefault2">
        noindex
      </label>
    </div>
        </div>
        <div class="col-8">
        <div class="form-check">
      <input class="form-check-input" type="radio" name="meta_robots_following_edu" id="flexRadioDefault1" value="follow" checked>
      <label class="form-check-label" for="flexRadioDefault1">
        follow
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="meta_robots_following_edu" id="flexRadioDefault2" value="nofollow">
      <label class="form-check-label" for="flexRadioDefault2">
        nofollow
      </label>
    </div>
        </div>
      </div>
      
      </div>
      <div class="col-6">
      <h4 class="fw-bold">Cannonical tag</h4>
      <div class="form-check">
      <input class="form-check-input" type="radio" name="cannonical_edu" id="flexRadioDefault1" value="1" checked>
      <label class="form-check-label" for="flexRadioDefault1">
        da
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="cannonical_edu" id="flexRadioDefault2" value="0">
      <label class="form-check-label" for="flexRadioDefault2">
        ne
      </label>
    </div>
      </div>
      </div>
      <h4 class="fw-bold">Open graph</h4>
      <label for="">OG title</label> <br>
      <input type="text" class="txt-input" name="og_title_edu" class="w-100">
      <label for="">OG description</label>
      <input type="text" class="txt-input" name="og_description_edu" class="w-100">
      <div class="row pb-3">
        <div class="col-2"><label for="">OG type</label></div>
        <div class="col-10">
        <div class="form-check">
      <input class="form-check-input" type="radio" name="og_type_edu" id="flexRadioDefault1" value="article" checked>
      <label class="form-check-label" for="flexRadioDefault1">
        article
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="og_type_edu" id="flexRadioDefault2" value="website">
      <label class="form-check-label" for="flexRadioDefault2">
        website
      </label>
    </div>
        </div>
      </div>

      <div class="row">
        <div class="col-2"><label for="">OG image</label></div>
        <div class="col-10">
        <input type="file" class="w-100">
        </div>
      </div>

      
      
      <h4 class="fw-bold">Tagovi</h4>
      <input type="text" class="txt-input" name="edu_tagovi" class="w-100">
    </div></div></div></div></div>   
</div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary closeModalBtn" data-bs-dismiss="modal" id="closeModalBtn">Zatvori</button>
                            <button type="submit" class="btn btn-primary" name="edukacija_submit">Spremi</button>
                          </div>
              
              </form>
              
                        </div>
                      </div>
                    </div>
          

                    <div class="modal fade" id="kategorija" tabindex="-1" role="dialog" aria-labelledby="kategorija"
                      aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="kategorija">Kreiraj kategoriju edukacija</h5>
                            <button type="button" class="btn-close closeModalBtn" data-bs-dismiss="modal" id="closeModalBtn" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">

                            <form id="bezentera" method="post" enctype="multipart/form-data"onkeydown="if(event.keyCode === 13) { 
    return false;
}"
              
              >

                              <input type="text" class="txt-input" id="ime_kat" name="ime_kat"
                                placeholder="Ime kategorije...">
                                
                              <input type="text" class="txt-input" id="edukat_tagovi" name="edukat_tagovi"
                                placeholder="Tagovi...">

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary closeModalBtn" data-bs-dismiss="modal" id="closeModalBtn">Zatvori</button>
                            <button type="submit" class="btn btn-primary" name="kategorija_submit">Spremi</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <?php echo $edukacije; ?>
                  </div>

                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="villa" role="tabpanel" aria-labelledby="villa-tab">

              <!--BLOG -->

              <div class="row">
                <div class="col-12">

                  <div class="container">
                    <div class="row justify-content-start">
                      <div class="col-4  text-left" id="head">
                        <h3>Blog postovi</h3>
                      </div>
                      <div class="col-2 pt-2" id="head">
                        <select class="custom-select form-select form-select-lg mb-2" id="category3" name="category3" onchange=' filterData3()' required>
                    <option id="category3" value="showAll" selected disabled>Aktivnost</option>
                    <option id="category3" value="showAll">Prikaži sve</option>
                    <option id="category3" value="0">Aktivni</option>
                    <option id="category3" value="1">Neaktivni</option>
                  </select>
                </div>
                <div class="col-2 pt-2" id="head">
                  <select class="custom-select form-select form-select-lg mb-2" id="category" name="category"
                    onchange='filterData()' required>
                    <option id="category" value="showAll" selected disabled>Kategorija</option>
                    <option id="category" value="showAll">Prikaži sve</option>
                    <?php echo $kategorije_drop; ?>
                  </select>
                  <!---<button class="btn-dr dropdown-toggle" type="button" id="dropdownMenuButton"
                          data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Kategorija
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            
                        </div>-->
                </div>
                <div class="col-4 d-flex justify-content-end" id="head">
                  <div class="dropstart btn-group">

                    <div class="btn-c remove-arrow" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      <i class="fa-solid fa-plus fa-s"></i>
                    </div>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Kreiraj
                        blog</a>
                      <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#kategorija_blog">Kreiraj
                        kategoriju</a>
                    </div>
                  </div>
                </div>
            </div>


            <div class="modal fade" id="kategorija_blog" tabindex="-1" role="dialog" aria-labelledby="kategorija_blog"
              aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="kategorija_blog">Kreiraj kategoriju blogova</h5>
                    <button type="button" class="btn-close closeModalBtn" data-bs-dismiss="modal" id="closeModalBtn"
                      aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                    <form method="post" id="bezentera" onkeydown="if(event.keyCode === 13) {
    alert('You have pressed Enter key, use submit button instead'); 
    return false;
}">

                      <input type="text" class="txt-input" id="ime_kat_blog" name="ime_kat_blog"
                        placeholder="Ime kategorije...">
                      <!--<div class="wrapper">
                                <div class="content">
                                  <ul class="lista">
                                    <input class="tagovi" type="text" spellcheck="false" placeholder="Tagovi...">
                                  </ul>
                                </div>
                                <div class="details">
                                     <p><span>10</span> tagova preostalo</p>
                                  <button class="navbar-btn">Makni sve</button>
                                </div>
                              </div>-->


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closeModalBtn" data-bs-dismiss="modal"
                      id="closeModalBtn">Zatvori</button>
                    <button type="submit" class="btn btn-primary" name="kategorija_blog_submit">Spremi</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kreiraj blog</h5>
                    <button type="button" class="btn-close closeModalBtn" data-bs-dismiss="modal" id="closeModalBtn"
                      aria-label="Close"></button>
                  </div>
                  <div class="modal-body">


                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item" role="presentation"><a class="nav-link active" id="tab3-tab"
                          data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab" aria-controls="tab3"
                          aria-selected="true">Općenito</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" id="tab4-tab" data-bs-toggle="tab"
                          data-bs-target="#tab4" type="button" role="tab" aria-controls="tab4"
                          aria-selected="false">SEO</a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane fade show active" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">

                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-12">

                              <form method="POST" action="" enctype="multipart/form-data">

                                <input type="text" class="txt-input" name="blog_naslov" placeholder="Naslov...">
                                <select class="custom-select form-select form-select-lg" name="blog_kategorija"
                                  id="blog_kategorija">
                                  <option id="category" disabled selected>Odaberi kategoriju...</option>
                                  <?php echo $kategorije_blogovi; ?>
                                </select>
                                <br>
                                <input type="file" name="blog_slika">
                                <textarea class="txtarea-input" name="blog_tekst" id="txtarea-input" cols="30" rows="10"
                                  placeholder="Tekst..."></textarea>
                                <button type="button" class="edits" onclick="formatText('bold')"><i
                                    class="fas fa-bold"></i></button>
                                <button type="button" class="edits" onclick="formatText('italic')"><i
                                    class="fa-solid fa-italic"></i></button>
                                <button type="button" class="edits" onclick="formatText('underline')"><i
                                    class="fa-solid fa-underline"></i></button><br>
                                <button type="button" class="edits" onclick="formatText('h1')">H1</button>
                                <button type="button" class="edits" onclick="formatText('h2')">H2</button>
                                <button type="button" class="edits" onclick="formatText('h3')">H3</button><br>
                                <button type="button" class="edits" onclick="formatText('link')"><i
                                    class="fa-solid fa-link"></i></button>
                                <button type="button" class="edits" onclick="formatText('list')"><i
                                    class="fa-solid fa-list"></i></button>

                                <input type="file" id="dodatni_input_blog" style="width:33%;" name="blog_slika_tekst"
                                  onclick="formatText('dodatna_slika')">
                                <!--<button type="button" class="edits" onclick="formatText('dodatna_slika')"><input type="file" name="blog_slika_tekst"></button>-->
                                <!--<button class="edits" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-image"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                      <li><input type="file" name="blog_slika_tekst"></li>
                                      <li><hr class="dropdown-divider"></li>
                                      <li><button type="button" class="dropdown-item">Naslov</button></li>
                                      <li><button type="button" class="dropdown-item">Tekst</button></li>
                                    </ul>-->

                                <!--<input style="display:none;" type="file" id="formFile" class="file-input-edits">
                                  <label for="formFile" class="file-input-edits" style="text-align: center;"><i
                                      class="fa fa-upload" aria-hidden="true"></i></label>
                                      

                                  <input type="text" class="txt-input" name="blog_tagovi" placeholder="Tagovi...">-->

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade show" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">

                        <div class="container-fluid">
                          <div class="row">

                            <div class="col-12 pt-3">
                              <h4 class="fw-bold">Meta description</h4>
                              <textarea class="txtarea-input w-100 br-3" rows="4" name="meta_description"
                                id=""></textarea>
                              <div class="row pb-3">
                                <div class="col-6">
                                  <h4 class="fw-bold">Meta Robots</h4>
                                  <div class="row">
                                    <div class="col-4">
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="meta_robots_indexing"
                                          id="flexRadioDefault1" value="index" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                          index
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="meta_robots_indexing"
                                          id="flexRadioDefault2" value="noindex">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                          noindex
                                        </label>
                                      </div>
                                    </div>
                                    <div class="col-8">
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="meta_robots_following"
                                          id="flexRadioDefault1" value="follow" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                          follow
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="meta_robots_following"
                                          id="flexRadioDefault2" value="nofollow">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                          nofollow
                                        </label>
                                      </div>
                                    </div>
                                  </div>

                                </div>
                                <div class="col-6">
                                  <h4 class="fw-bold">Cannonical tag</h4>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cannonical"
                                      id="flexRadioDefault1" value="1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                      da
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cannonical"
                                      id="flexRadioDefault2" value="0">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                      ne
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <h4 class="fw-bold">Open graph</h4>
                              <label for="">OG title</label> <br>
                              <input type="text" class="txt-input" name="og_title" class="w-100">
                              <label for="">OG description</label>
                              <input type="text" class="txt-input" name="og_description" class="w-100">
                              <div class="row pb-3">
                                <div class="col-2"><label for="">OG type</label></div>
                                <div class="col-10">
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="og_type" id="flexRadioDefault1"
                                      value="article" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                      article
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="og_type" id="flexRadioDefault2"
                                      value="website">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                      website
                                    </label>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-2"><label for="">OG image</label></div>
                                <div class="col-10">
                                  <input type="file" class="w-100">
                                </div>
                              </div>



                              <h4 class="fw-bold">Tagovi</h4>
                              <input type="text" class="txt-input" name="blog_tagovi" class="w-100">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closeModalBtn" data-bs-dismiss="modal"
                      id="closeModalBtn">Odustani</button>
                    <button type="submit" class="btn btn-primary" name="blog_submit">Kreiraj</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- EDIT BLOG MODAL -->



            <div class="row pt-5">
              <div id="dataDisplay">
                <?php echo $htmlContent; ?>
              </div>

            </div>


          </div>


        </div>
      </div>
  </div>
  <div class="tab-pane fade" id="penthouse" role="tabpanel" aria-labelledby="penthouse-tab">

    <!--HOME PAGE -->
    <div class="container">
      <div class="row">
        <div class="col-8 text-left">
          <h3>Trenutne obavijesti</h3>
        </div>
        <div class="col-4 d-flex justify-content-end">
          <div class="dropstart btn-group">
            <a role="button" class="btn-c remove-arrow dropdown-toggle" type="button" id="dropdownMenuButton"
              data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-plus fa-s"></i>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#obavijest">Kreiraj
                  obavijest</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container pt-3">
      <div class="row">
        <div id="dataDisplay">
          <?php echo $htmlContentHome; ?>
        </div>
      </div>
    </div>

    <div class="modal fade" id="obavijest" tabindex="-1" role="dialog" aria-labelledby="obavijest" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="obavijest">Kreiraj obavijest</h5>
            <button type="button" class="btn-close closeModalBtn" data-bs-dismiss="modal" id="closeModalBtn"
              aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="" enctype="multipart/form-data">


              <input type="text" class="txt-input" name="naslov_obavijesti" placeholder="Naslov obavijesti...">
              <input type="text" class="txt-input" name="link_obavijesti" placeholder="Link blog posta..."> <br>
              <!--     <input type="file" class="txt-input" id="ime_kat" placeholder="Fotografija..."> 

                            <input style="display:none;" type="file" name="image" accept="image/*">
                            <label class="label1" for="formFile">Fotografija... </label>-->

              <input type="file" name="sliketina" id="sliketina">
              <input type="text" class="txt-input" name="ime_slike" placeholder="Ime slike...">
              <input type="text" class="txt-input" name="alt_slike" placeholder="Alt slike...">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary closeModalBtn" data-bs-dismiss="modal"
              id="closeModalBtn">Odustani</button>
            <button type="submit" class="btn btn-primary" name="obavijest_submit">Kreiraj</button>

          </div>

          </form>

        </div>

      </div>
    </div>



  </div>


  </div>
  </div>
  </div>
  </div>
  </div>
  </main>



  </div>
  </div>




  <script>



    var kategorije = <?php echo json_encode($kategorije_array); ?>;

    function filterData() {
      var selectedCategory = document.getElementById('category').value;
      var blogItems = document.getElementsByClassName('blog-item');

      console.log(selectedCategory);

      for (var i = 0; i < blogItems.length; i++) {
        var currentItem = blogItems[i];
        var itemCategory = currentItem.dataset.category; // Assuming you have data-category attribute on each blog item
        console.log(selectedCategory);
        if (selectedCategory === 'showAll' || selectedCategory === itemCategory) {
          currentItem.style.display = 'block';
        } else {
          currentItem.style.display = 'none';

        }


      }
    }

    function filterData2() {
      var selectedCategory = document.getElementById('category2').value;
      var blogItems = document.getElementsByClassName('blog-item');

      for (var i = 0; i < blogItems.length; i++) {
        var currentItem = blogItems[i];
        var itemCategory = currentItem.dataset.category; // Assuming you have data-category attribute on each blog item
        console.log(selectedCategory);
        if (selectedCategory === 'showAll' || selectedCategory === itemCategory) {
          currentItem.style.display = 'block';
        } else {
          currentItem.style.display = 'none';

        }


      }
    }

    function filterData3() {
      var selectedCategory = document.getElementById('category3').value;
      var blogItems = document.getElementsByClassName('blog-item');

      for (var i = 0; i < blogItems.length; i++) {
        var currentItem = blogItems[i];
        var itemCategory = currentItem.dataset.hidden; // Assuming you have data-category attribute on each blog item
        console.log(selectedCategory);
        if (selectedCategory === 'showAll' || selectedCategory === itemCategory) {
          currentItem.style.display = 'block';
        } else {
          currentItem.style.display = 'none';

        }


      }
    }
    // Select all elements with the class 'delete-btn'
    var deleteButtons = document.querySelectorAll('.delete-btn');

    // Loop through each delete button
    deleteButtons.forEach(function (button) {
      // Add click event listener to each delete button
      button.addEventListener('click', function () {
        // Get the item ID from the 'data-item-id' attribute
        var itemId = button.getAttribute('data-item-id');

        // Prompt the user for confirmation
        if (confirm("Jesi siguran da to želiš obrisati?")) {
          // Redirect to delete_item.php with the item ID as parameter
          window.location.href = "index.php?id=" + itemId;
        }
      });
    });

    var deleteButtons = document.querySelectorAll('.delete-btn-edukacije');

    // Loop through each delete button
    deleteButtons.forEach(function (button) {
      // Add click event listener to each delete button
      button.addEventListener('click', function () {
        // Get the item ID from the 'data-item-id' attribute
        var itemId = button.getAttribute('data-item-obrisiedu');


        // Prompt the user for confirmation
        if (confirm("Jesi siguran da to želiš obrisati?")) {
          // Redirect to delete_item.php with the item ID as parameter
          window.location.href = "index.php?obrisiedu=" + itemId;
        }
      });
    });



    var deletekatButtons = document.querySelectorAll('.delete-btn-kategorijeedu');

    // Loop through each delete button
    deletekatButtons.forEach(function (button) {
      // Add click event listener to each delete button
      button.addEventListener('click', function () {
        // Get the item ID from the 'data-item-id' attribute
        var itemId = button.getAttribute('data-item-delkatedu');


        // Prompt the user for confirmation
        if (confirm("Jesi siguran da to želiš obrisati?")) {
          // Redirect to delete_item.php with the item ID as parameter
          window.location.href = "index.php?delkatedu=" + itemId;
        }
      });
    });

    // Select all elements with the class 'delete-btn'
    var deleteHomeButtons = document.querySelectorAll('.delete-home-btn');

    // Loop through each delete button
    deleteHomeButtons.forEach(function (button) {
      // Add click event listener to each delete button
      button.addEventListener('click', function () {
        // Get the item ID from the 'data-item-id' attribute
        var itemId = button.getAttribute('data-item-home');

        // Prompt the user for confirmation
        if (confirm("Jesi siguran želiš obrisati ovu obavijest?")) {
          // Redirect to delete_item.php with the item ID as parameter
          window.location.href = "index.php?home=" + itemId;
        }
      });
    });

    var pinButtons = document.querySelectorAll('.pin-btn');
    pinButtons.forEach(function (button) {
      // Add click event listener to each delete button
      button.addEventListener('click', function () {
        // Get the item ID from the 'data-item-id' attribute
        var itemId = button.getAttribute('data-item-pin');

        // Prompt the user for confirmation
        if (confirm("Jesi siguran da to želiš pinnati / odpinnati?")) {
          // Redirect to delete_item.php with the item ID as parameter
          window.location.href = "index.php?pin=" + itemId;
        }
      });
    });
    var pinButtons = document.querySelectorAll('.hide-btn');
    pinButtons.forEach(function (button) {
      // Add click event listener to each delete button
      button.addEventListener('click', function () {
        // Get the item ID from the 'data-item-id' attribute
        var itemId = button.getAttribute('data-item-hide');

        // Prompt the user for confirmation
        if (confirm("Jesi siguran da to želiš sakriti / ponovno prikazati?")) {
          // Redirect to delete_item.php with the item ID as parameter
          window.location.href = "index.php?hide=" + itemId;
        }
      });
    });

    var hideeduButtons = document.querySelectorAll('.hide-btn-edukacije');
    hideeduButtons.forEach(function (button) {
      // Add click event listener to each delete button
      button.addEventListener('click', function () {
        // Get the item ID from the 'data-item-id' attribute
        var itemId = button.getAttribute('data-item-hideedu');

        // Prompt the user for confirmation
        if (confirm("Jesi siguran da to želiš sakriti / ponovno prikazati?")) {
          // Redirect to delete_item.php with the item ID as parameter
          window.location.href = "index.php?hideedu=" + itemId;
        }
      });
    });

    var hidekateduButtons = document.querySelectorAll('.hide-btn-kategorijeedu');
    hidekateduButtons.forEach(function (button) {
      // Add click event listener to each delete button
      button.addEventListener('click', function () {
        // Get the item ID from the 'data-item-id' attribute
        var itemId = button.getAttribute('data-item-hidkatedu');

        // Prompt the user for confirmation
        if (confirm("Jesi siguran da to želiš sakriti / ponovno prikazati?")) {
          // Redirect to delete_item.php with the item ID as parameter
          window.location.href = "index.php?hidkatedu=" + itemId;
        }
      });
    });

    var poz1Buttons = document.querySelectorAll('.poz1');
    poz1Buttons.forEach(function (button) {
      // Add click event listener to each delete button
      button.addEventListener('click', function () {
        // Get the item ID from the 'data-item-id' attribute
        var itemId = button.getAttribute('data-item-poz1');

        // Prompt the user for confirmation
        if (confirm("Jesi siguran da to želiš napraviti?")) {
          // Redirect to delete_item.php with the item ID as parameter
          window.location.href = "index.php?poz1=" + itemId;
        }
      });
    });

    var poz2Buttons = document.querySelectorAll('.poz2');
    poz2Buttons.forEach(function (button) {
      // Add click event listener to each delete button
      button.addEventListener('click', function () {
        // Get the item ID from the 'data-item-id' attribute
        var itemId = button.getAttribute('data-item-poz2');

        // Prompt the user for confirmation
        if (confirm("Jesi siguran da to želiš napravitii?")) {
          // Redirect to delete_item.php with the item ID as parameter
          window.location.href = "index.php?poz2=" + itemId;
        }
      });
    });

    var poz3Buttons = document.querySelectorAll('.poz3');
    poz3Buttons.forEach(function (button) {
      // Add click event listener to each delete button
      button.addEventListener('click', function () {
        // Get the item ID from the 'data-item-id' attribute
        var itemId = button.getAttribute('data-item-poz3');

        // Prompt the user for confirmation
        if (confirm("Jesi siguran da to želiš napraviti?")) {
          // Redirect to delete_item.php with the item ID as parameter
          window.location.href = "index.php?poz3=" + itemId;
        }
      });
    });

    var poz0Buttons = document.querySelectorAll('.poz0');
    poz0Buttons.forEach(function (button) {
      // Add click event listener to each delete button
      button.addEventListener('click', function () {
        // Get the item ID from the 'data-item-id' attribute
        var itemId = button.getAttribute('data-item-poz0');

        // Prompt the user for confirmation
        if (confirm("Jesi siguran da to želiš napraviti?")) {
          // Redirect to delete_item.php with the item ID as parameter
          window.location.href = "index.php?poz0=" + itemId;
        }
      });
    });

    var editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(function (button) {
      // Add click event listener to each delete button
      button.addEventListener('click', function () {
        // Get the item ID from the 'data-item-id' attribute
        var itemId = button.getAttribute('data-item-edit');

        window.location.href = "index.php?edit=" + itemId;
      });
    });

    var editButtons = document.querySelectorAll('.editedukat-btn');
    editButtons.forEach(function (button) {
      // Add click event listener to each delete button
      button.addEventListener('click', function () {
        // Get the item ID from the 'data-item-id' attribute
        var itemId = button.getAttribute('data-item-editedukat');

        window.location.href = "index.php?editedukat=" + itemId;
      });
    });

    var editEduButtons = document.querySelectorAll('.editedu-btn');
    editEduButtons.forEach(function (button) {
      // Add click event listener to each delete button
      button.addEventListener('click', function () {
        // Get the item ID from the 'data-item-id' attribute
        var itemId = button.getAttribute('data-item-editedu');

        window.location.href = "index.php?editedu=" + itemId;
      });
    });



  </script>



  <script>
    $(document).ready(function () {
      $('#tagsInput').tagsinput({
        confirmKeys: [13, 44] // Allow Enter key and comma to add tags
      });

      // Listen for 'itemAdded' event to display tags below input
      $('#tagsInput').on('itemAdded', function (event) {
        var tag = event.item;
        $('#tagsContainer').append('<span class="badge badge-primary mr-1">' + tag + '</span>');
      });

      // Listen for 'itemRemoved' event to remove tags from display
      $('#tagsInput').on('itemRemoved', function (event) {
        var tag = event.item;
        $('#tagsContainer').find('.badge:contains("' + tag + '")').remove();
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      var cardCount = 0;

      // Function to add a new accordion card
      function addAccordionCard() {
        cardCount++;
        var cardHtml = `
            <div class="card">
                <div class="card-header" id="heading${cardCount}">
                    <h5 class="mb-0">
                        <input type="text" class="form-control" id="cardHeading${cardCount}" name="cardHeadings[]" placeholder="Sadrzaj ${cardCount} Naslov">
                        <span class="ml-2" data-bs-toggle="collapse" data-bs-target="#collapse${cardCount}" aria-expanded="true" aria-controls="collapse${cardCount}">
                            <i class="fa fa-arrow-down"></i>
                        </span>
                        <button type="button" class="btn-close delete-card" aria-label="Close">
                            
                        </button>
                    </h5>
                </div>
                <div id="collapse${cardCount}" class="collapse" aria-labelledby="heading${cardCount}" data-parent="#accordion">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="cardContent${cardCount}">Sadrzaj ${cardCount} tekst:</label>
                            <textarea class="form-control add-li-on-enter" id="cardContent${cardCount}" name="cardContents[]" rows="3" placeholder="Upisi tekst">
<li></li></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#accordion').append(cardHtml);

        // Add event listener for dynamically added textareas
        $('.add-li-on-enter').off('keydown').on('keydown', function (event) {
          const key = event.key;

          // Check if the pressed key is Enter
          if (key === 'Enter') {
            event.preventDefault(); // Prevent default Enter behavior (new line)

            const cursorPosition = this.selectionStart; // Get cursor position
            const text = this.value; // Get current textarea value

            // Split the textarea value into two parts
            const beforeCursor = text.substring(0, cursorPosition);
            const afterCursor = text.substring(cursorPosition);

            // Construct the new textarea value with <li></li> inserted at cursor position
            const newValue = beforeCursor + '\n<li></li>' + afterCursor;

            // Update the textarea value
            this.value = newValue;

            // Move the cursor position to after the inserted <li></li>
            this.selectionStart = cursorPosition + 5; // +9 to move cursor after <li></li> and \n
            this.selectionEnd = cursorPosition + 5;
          }
        });
      }

      // Event listener for Add Card button
      $('#addCardBtn').click(function () {
        addAccordionCard();
      });

      addAccordionCard();

      // Event delegation for delete button
      $('#accordion').on('click', '.delete-card', function () {
        $(this).closest('.card').remove();
        cardCount--;
      });




      var cardCount2 = 0;

      // Function to add a new accordion card
      function addCiljCard() {
        cardCount2++;
        var cardHtml2 = `
            <div class="card">
                <div class="card-header" id="heading${cardCount2}">
                    <h5 class="mb-0">
                        <input type="text" class="form-control" id="ciljHeading${cardCount2}" name="ciljHeadings[]" placeholder="Cilj ${cardCount2} Naslov">
                        <button type="button" class="btn-close delete-card" aria-label="Close">
                            
                        </button>
                    </h5>
                </div>
            </div>
        `;
        $('#ciljevi').append(cardHtml2);
      }

      // Event listener for Add Card button
      $('#addCiljBtn').click(function () {
        addCiljCard();
      });

      addCiljCard();

      // Event delegation for delete button
      $('#ciljevi').on('click', '.delete-card', function () {
        $(this).closest('.card').remove();
        cardCount2--;
      });

    });
  </script>


</body>

</html>