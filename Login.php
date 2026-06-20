<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TASKLY</title>
    <link rel="icon" href="Images/Logo.png" />

    <!-- Bootstrap Library, Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="CSS/Styles.css" />
    <link rel="stylesheet" href="CSS/Navbar.css" />
    <link rel="stylesheet" href="CSS/RegisterForms.css">
    <link rel="stylesheet" href="CSS/Addons/DarkModeStyles.css" />
    <link rel="stylesheet" href="CSS/Addons/KeyFrames.css" />
    <link rel="stylesheet" href="CSS/Addons/MediaQueries.css" />
    <link rel="stylesheet" href="CSS/Addons/Sun.css" />
    <link rel="stylesheet" href="CSS/Addons/Moon.css" />
</head>

<body onload="heroSectionHeight(); dataFormsStartup(); adjustDataFormsOnResize(); toggleDataForms();"
    onresize="heroSectionHeight(); dataFormsStartup(); adjustDataFormsOnResize();">
    <!-- Sun Light Mode -->
    <div class="sunDiv parent-sun">
        <div class="sunDiv sun">
            <div class="sunDiv rotate">
            </div>
        </div>
    </div>

    <!-- Moon Dark Mode -->
    <div class="moonDiv">
        <div class="moon" id="white"></div>
    </div>

    <!-- Stars Dark Mode -->
    <canvas id="stars"></canvas>

    <nav class="navbar navbar-expand-sm" id="navbar">
        <div class="container">
            <a class="navbar-brand logo" href="index.php">
                <img src="Images/Logo.png" alt="Logo Taskly">
                <h1>
                    <span>T</span>
                    <span>A</span>
                    <span>S</span>
                    <span>K</span>
                    <span>L</span>
                    <span>Y</span>
                </h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list text-white fs-1"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex justify-content-center align-items-center gap-3 my-2 my-md-0">
                    <div>
                        <input class="visually-hidden" type="checkbox" role="switch" id="Mode">
                        <label for="Mode" class="mode-icon"></label>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <?php
        if (isset($_GET['msg'])) {
            if ($_GET['msg'] == 'AR') {
                echo '
                <div class="alert alert-danger text-center" id="alert" role="alert">
                    <strong>Account already exists!</strong> Please try to Sign IN.
                </div>';
            } else if ($_GET['msg'] == 'SR') {
                echo '<div class="alert alert-success text-center" id="alert" role="alert">
                    <strong>Account created successfully!</strong> Please Sign IN.
                </div>';
            } else if ($_GET['msg'] == 'login_failed') {
                echo '<div class="alert alert-danger text-center" id="alert" role="alert">
                    <strong>Login failed!</strong> Please check your credentials and try again.
                </div>';
            } else if ($_GET['msg'] == 'login_required') {
                echo '<div class="alert alert-warning text-center" id="alert" role="alert">
                    <strong>Login required!</strong> Please log in to access this page.
                </div>';
            }
        }

        if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) {
                echo '<div class="alert alert-danger text-center" id="alert" role="alert">
                    <strong>Error:</strong> ' . $error .
                    '</div>';
            }
        }
        ?>

        <div class="container dataForms row" id="dataForms">
            <button class="showSignUp" id="showSignUp" onclick="showSignUpForm();">
                <span>Sign<br>IN</span>
                <span>Sign<br>UP</span>
            </button>
            <div class="login col-md-6" id="login">
                <h1>Sign In</h1>
                <div class="social-links">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-google"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
                <p>or use your account</p>
                <form action="handle_login.php" method="POST" id="loginForm">
                    <div>
                        <input type="email" name="email" id="loginEmail" placeholder="Email" class="form-control"
                            required>
                    </div>
                    <div>
                        <input type="password" minlength="8" name="password" id="password" placeholder="Password"
                            class="form-control" required>
                    </div>
                    <div>
                        <div class="form-check form-switch d-flex align-items-center gap-2">
                            <input class="form-check-input" type="checkbox" role="switch" id="RememberMe">
                            <label class="form-check-label" for="RememberMe">Remember me</label>
                        </div>
                        <a href="#" class="f-pass-btn">Forgot Password?</a>
                    </div>
                    <div>
                        <button class="submitBtn" type="submit" value="SignIN">Sign IN</button>
                    </div>
                </form>
            </div>

            <div class="register col-md-6" id="register">
                <h1>Create Account</h1>
                <div class="social-links">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-google"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
                <p>or use you email for registration</p>
                <form action="handle_register.php" method="POST" id="registerForm">
                    <div>
                        <div class="input-group">
                            <input type="text" name="fname" id="fname" placeholder="First Name" aria-label="First name"
                                class="form-control" required>
                            <input type="text" name="lname" id="lname" placeholder="Last Name" aria-label="Last name"
                                class="form-control" required>
                        </div>
                    </div>
                    <div>
                        <input type="email" name="email" id="email" placeholder="Email" class="form-control" required>
                    </div>
                    <div>
                        <input type="password" minlength="8" name="newpassword" id="newpassword" placeholder="Password"
                            class="form-control" minlength="8" required>
                    </div>
                    <div>
                        <button class="submitBtn" type="submit" value="SignUP">Sign UP</button>
                    </div>
                </form>
            </div>

            <div class="overlay col-md-6" id="overlay"></div>
        </div>
    </section>


    <!-- Bootstrap Library -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <!-- Js Files -->
    <script src="Javascript/StarsBG.js"></script>
    <script src="Javascript/Scripts.js"></script>

</body>

</html>

<?php
$_SESSION['errors'] = null;
$_GET['msg'] = null;
?>