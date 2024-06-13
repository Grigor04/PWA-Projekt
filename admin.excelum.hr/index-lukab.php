<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <script src="https://kit.fontawesome.com/68b247d654.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-dcWb8RFks9UjYQqQjNXEZl/UZerQrv9cuzs+1xk0VMjjM7x1pNKCF6OMfrvRBc4w9ZgqYtzsd95gRY1M3ga1zw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        body{
            background: linear-gradient(to right, #0097b2, #7dd858);    font-family: 'Poppins', sans-serif;
            margin: top 100vh;
            font-family: 'Raleway', sans-serif;
            display: flex;
            justify-content: center; /* Horizontal centering */
            align-items: center; /* Vertical centering */
            height: 100vh;
            margin: 0;
        }
        .container{
            
            display: flex;
            justify-content: center;
            margin-top: 50%;
        }
        .container input[type="text"],
        .container input[type="password"],
        .container input[type="submit"] {
            padding: 10px 40px;
            border: 1px solid #000;
            border-radius: 20px;
            display: inline-block;  
            box-sizing: border-box;
            outline: none;
            background-color: black;
            color:aliceblue;
        }
        .container-fluid input[type="submit"] {
            cursor: pointer;           
        }
        .btn{
            padding: 10px 40px;
            width:100%;
            border: 1px solid #000;
            border-radius: 20px;
            display: inline-block;  
            box-sizing: border-box;
            outline: none;
            background-color: black;
            color:aliceblue;
        }
        .input-icons {
            width: 100%;
            margin-bottom: 10px;
        }
 
        .container i {
            position: absolute;
        }
 
        .icon {
            color:whitesmoke;
            padding: 14px;
            min-width: 40px;
        }
 
        .input-field {
            width: 100%;
        }
    </style>    
</head>
<body>
    <div class="container mt-4">
        
        <form>
            <div class="text-center mb-3">
                <img src="Excelum-removebg-preview.png" class="rounded" alt="..." style="width: 315px; height: 42px;">
              </div>
            <div class="form-group">
                <i class="fa fa-user icon"></i>
                <input type="text" placeholder="Username" class="input-field" required>  
                        
            </div>
            <div class="form-group">
                <i class="fa fa-lock icon"></i>
                <input type="password" placeholder="Password" class="input-field" required>    
            </div>
            <button type="submit" class="btn">Submit</button>
          </form>
    </div>
</body>
</html>