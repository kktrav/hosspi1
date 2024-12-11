<?php
$conn = mysqli_connect('localhost', 'root', '', 'contact_db') or die('Connection failed');

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name']));
    $email = mysqli_real_escape_string($conn, filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $number = mysqli_real_escape_string($conn, htmlspecialchars($_POST['number']));
    $date = mysqli_real_escape_string($conn, htmlspecialchars($_POST['date']));

    // Ensure email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $insert = mysqli_query($conn, "INSERT INTO `contact_form`(name, email, number, date) VALUES('$name','$email','$number','$date')") or die('Query failed');
        if ($insert) {
            $message[] = 'Appointment made successfully!';
        } else {
            $message[] = 'Appointment failed';
        }
    } else {
        $message[] = 'Invalid email format';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Hospital Website</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- header section starts -->
<header class="header">
    <a href="#" class="logo"> <i class="fas fa-heartbeat"></i> <strong>WC</strong>medical </a>
    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#about">about</a>
        <a href="#services">services</a>
        <a href="#doctors">doctors</a>
        <a href="#appointment">appointment</a>
        <a href="#review">review</a>
        <a href="#blogs">blogs</a>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>
<!-- header section ends -->

<!-- appointment section starts -->
<section class="appointment" id="appointment">
    <h1 class="heading"> <span>appointment</span> now </h1>
    <div class="row">
        <div class="image">
            <img src="image/appointment-img.svg" alt="">
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <?php
            if (isset($message)) {
                foreach ($message as $msg) {
                    echo '<p class="message">' . htmlspecialchars($msg) . '</p>';
                }
            }
            ?>
            <h3>make appointment</h3>
            <input type="text" name="name" placeholder="your name" class="box" required>
            <input type="number" name="number" placeholder="your number" class="box" required>
            <input type="email" name="email" placeholder="your email" class="box" required>
            <input type="date" name="date" class="box" required>
            <input type="submit" name="submit" value="appointment now" class="btn">
        </form>
    </div>
</section>
<!-- appointment section ends -->

<!-- js file link -->
<script src="js/script.js"></script>

</body>
</html>
