<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Pet Store Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</head>

<body>

    <nav>
        <label class="logo">Pet Store</label>

        <ul>
            <li><a href="">Home</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="admin/index.php" class="btn btn-success">Admin Login</a></li>
            <li><a href="customer/index.php" class="btn btn-success">Customer Login</a></li>
        </ul>
    </nav>


    <div class="section1">

        <label class="img_text">We Take Pets with Care</label>
        <img class="main_img" src="petStoremanage.jpg">
    </div>


    <div class="container">

        <div class="row">

            <div class="col-md-4">

                <img class="welcome_img" src="welcome.jpg">

            </div>

            <div class="col-md-8">

                <h1>Welcome to Pet Store</h1>

                <p>PetsWorld is a one-stop shop for all pet owners, offering a comprehensive range of pet supplies for
                    dogs, cats, rabbits, rodents, fishes, etc. Starting from nutritious foods to delicious treats and
                    going far up to healthcare, grooming and training products, we at PetsWorld have everything to
                    ensure the excellent well-being of your pets.

                    All you need to do is select your desired pet products at PetsWorld and leave the rest to us to make
                    them reach your doorsteps in the shortest possible time</p>

            </div>


        </div>


    </div>


    <center>
        <h1>OUR PETS IN STORE</h1>
    </center>


    <div class="container">

        <div class="row">

            <div class="col-md-4">

                <img class="animal" src="dog1.jpg">

                <p>
                    <center><b>DOGS</b></center>
                </p>

            </div>

            <div class="col-md-4">

                <img class="animal" src="cat1.jpg">
                <p>
                    <center><b>CAT</b></center>
                </p>

            </div>

            <div class="col-md-4">

                <img class="animal" src="rabbit.jpg">
                <p>
                    <center><b>RABBIT</b></center>
                </p>

            </div>


        </div>


    </div>

    <center>
        <div class="row">
            <h1>To Place Order </h1><a href="customer/signup.php">
                <h1 class="adm"> SIGN UP</h1>
        </div>
    </center>



</body>

</html>