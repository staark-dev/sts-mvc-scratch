<?php class_exists('Controller') or exit; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo navbar() ?>  - View Profile - <?php echo $_SESSION['user_session']['user']; ?> </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" crossorigin="anonymous" href="<?php echo baseurl() ?>/public/assets/bootstrap/css/style.css" />
    <script src="<?php echo baseurl() ?>/public/assets/bootstrap/js/main.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
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
            <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto" role="search">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
            </form>
            <div class="text-end">
                <?php if(!isset($_SESSION['user'])): ?>
                <a href="<?php echo baseurl() ?>/auth/login" class="btn btn-light text-dark me-2">Login</a>
                <a href="<?php echo baseurl() ?>/auth/signup" class="btn btn-primary">Sign-up</a>
                <?php else: ?>
                <a href="http://127.0.2.36/auth/accounts/User/2" class="btn btn-light text-dark me-2"><?php echo $_SESSION['user_session']['user']; ?></a>
                <a href="<?php echo baseurl() ?>/auth/sign-out" class="btn btn-primary">Sign Out</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
    <div class="container-fluid">
        
<div class="container mt-5">
    <div class="row align-items-center">
        <div class="col-sm-3 left-side align-items-center p-3 my-0">
            <div class="my-2 p-2">
                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" class="card-img-top" alt="..." />
            </div>
            <div style="text-align: center;">
                <h4 class="text text-white"><strong><?php echo $data['name']; ?></strong></h4>
                <span class="text text-sm text-white">Join Date: <?php echo date("d/m/Y", strtotime($data['date'])); ?></span><br>
                <?php echo ($data['status']) ? '<span class="text text-sm text-success">Account Active</span>' : '<span class="text text-sm text-danger">Account Inactive</span>'; ?><br>
                <span class="text text-sm text-white">
                    <a class="fs-5 text-white" href="mailto:<?php echo $data['email']; ?>"><i class="bi bi-envelope-at-fill"></i></a>
                    <i class="fs-5 text-white bi bi-browser-edge"></i>
                    <i class="fs-5 bi bi-telephone-forward"></i>
                </span>
            </div>
        </div>
        <div class="col-md-8 right-side align-items-left">
            Other Profile Info
        </div>
    </div>
</div>

    </div>
</body>
</html>


