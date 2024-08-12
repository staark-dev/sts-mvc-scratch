<?php declare(strict_types=1); class_exists('Controller') or exit; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-control" content="no-cache" />
    <title><?php echo navbar() ?>  - User Sign Up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" crossorigin="anonymous" href="<?php echo baseurl() ?>/public/assets/bootstrap/css/style.css" />
    <script src="<?php echo baseurl() ?>/public/assets/bootstrap/js/main.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header">
    <div class="px-3 py-2 text-bg-dark border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                    <img width="85" height="65" src="/public/sts-logo.svg" alt=""/>
                </a>

                <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                    <li>
                        <a href="/" class="nav-link text-secondary">
                            <i class="bi bi-house-door d-block mx-auto mb-1" style="width: 24px; height: 24px; font-size: 24px;"></i>
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="#" class="nav-link text-white">
                            <i class="bi bi-speedometer2 d-block mx-auto mb-1" style="width: 24px; height: 24px; font-size: 24px;"></i>
                            Pricing
                        </a>
                    </li>

                    <li>
                        <a href="/users" class="nav-link text-white">
                            <i class="bi bi-person-circle d-block mx-auto mb-1" style="width: 24px; height: 24px; font-size: 24px;"></i>
                            Customers
                        </a>
                    </li>

                    <li>
                        <a href="#faq" class="nav-link text-white">
                            <i class="bi bi-question-circle-fill d-block mx-auto mb-1" style="width: 24px; height: 24px; font-size: 24px;"></i>
                            FAQs
                        </a>
                    </li>
                    <li>
                        <a href="#calendar" class="nav-link text-white">
                            <i class="bi bi-calendar-event d-block mx-auto mb-1" style="width: 24px; height: 24px; font-size: 24px;"></i>
                            Calendar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="px-3 py-2 border-bottom mb-3">
        <div class="container d-flex flex-wrap justify-content-center">
            <form class="w-50 me-3 col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto" role="search">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
            </form>
            <div class="text-end">
                <?php if(!isset($_SESSION['user'])): ?>
                <a href="<?php echo baseurl() ?>/auth/login" class="btn btn-light text-dark me-2">Login</a>
                <a href="<?php echo baseurl() ?>/auth/signup" class="btn btn-primary">Sign-up</a>
                <?php else: ?>
                <div class="flex-shrink-0 dropdown">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>

                    <ul class="dropdown-menu text-small shadow" style="">
                        <li><a class="dropdown-item" href="#">Inbox</a></li>
                        <li><a class="dropdown-item" href="<?php userlink ?>/settings">Settings</a></li>
                        <li><a class="dropdown-item" href="<?php userlink ?>">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?php echo baseurl() ?>/auth/sign-out">Sign out</a></li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
    <div class="container-fluid">
        <?php if($_SERVER['REQUEST_URI'] !== "/"): ?>
<div class="container mt-5">
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb breadcrumb-chevron p-3 bg-body-tertiary rounded-3">
            <?php breadcrumbs() ?>
        </ol>
    </nav>
</div>
<?php endif; ?>
        
<div class="container py-2">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col mx-1 pt-1">
                    Create an account right now!
                </div>
                
                <div class="d-flex justify-content-end col">
                    <span class="mx-1 pt-1">or sign up with: </span>
                    <a href="http://127.0.2.36/api/login_signup/google" class="btn signup-btn btn-sm btn-link btn-floating mx-1"><i class="bi bi-google"></i></a>
                    <a href="http://127.0.2.36/api/login_signup/apple" class="btn signup-btn btn-sm btn-link btn-floating mx-1"><i class="bi bi-apple"></i></a>
                    <a href="http://127.0.2.36/api/login_signup/github" class="btn signup-btn btn-sm btn-link btn-floating mx-1"><i class="bi bi-github"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <!-- Alerts -->
                <?php if(Session::get('login_errors')): ?>
<div class="row d-flex justify-content-center">
    <div class="col-8 alert alert-danger" role="alert">
    </div>
</div>
<?php endif; ?>
                <!-- /Alerts -->
                <div class="col-10">
                    <form action="<?php home_url() ?>/auth/signup" method="post" accept-charset="UTF-8">
                        <div class="row">
                            <div class="mb-3 col col-md-6">
                                <label for="inputName" class="form-label">User Name</label>
                                <input type="text" name="user_name" class="form-control" id="inputName" required />
                            </div>
    
                            <div class="col col-md-6 mb-3">
                                <label for="inputNameDisplay" class="form-label">Display Name</label>
                                <input type="text" name="user_nameDisplay" class="form-control" id="inputNameDisplay" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email address</label>
                            <input type="email" name="user_email" class="form-control" id="inputEmail" aria-describedby="emailHelp" required />
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>

                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" name="user_password" class="form-control" id="inputPassword" aria-describedby="passwordHelpBlock" required />
                            <div id="passwordHelpBlock" class="form-text">Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.</div>
                        </div>

                        <div class="mb-3">
                            <label for="inputPasswordConfirm" class="form-label">Confirm Password</label>
                            <input type="password" name="user_password_confirm" class="form-control" id="inputPasswordConfirm" aria-describedby="passwordHelpBlock" required />
                            <div id="passwordHelpBlock" class="form-text">Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.</div>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" data-mdb-button-init="" data-mdb-ripple-init=""  style="width: 70%" class="btn btn-primary btn-block mb-4" data-mdb-button-initialized="true">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">Already have an account?&nbsp;&nbsp;<a href="<?php home_url() ?>/auth/login">Login here</a></div>
        </div>
    </div>
</div>

    </div>
</body>
</html>

