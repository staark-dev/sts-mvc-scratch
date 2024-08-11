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
                        <li><a class="dropdown-item" href="<?php echo 'http://127.0.2.36/auth/accounts/Admin/1'; ?>/settings">Settings</a></li>
                        <li><a class="dropdown-item" href="<?php echo 'http://127.0.2.36/auth/accounts/Admin/1'; ?>">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?php echo baseurl() ?>/auth/sign-out">Sign out</a></li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <?php if($_SERVER['REQUEST_URI'] !== "/"): ?>
<div class="container mt-5">
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb breadcrumb-chevron p-3 bg-body-tertiary rounded-3">
            <?php breadcrumbs() ?>
        </ol>
    </nav>
</div>
<?php endif; ?>
        <!-- /Breadcrumb -->
        
<div class="container mt-5">
    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                        <div class="mt-3">
                            <h4><?php echo $_SESSION['user_session']['user']; ?></h4>
                            <p class="text-secondary mb-1">Full Stack Developer</p>
                            <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                            <button class="btn btn-primary">Follow</button>
                            <button class="btn btn-outline-primary">Message</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
                        <span class="text-secondary">https://bootdey.com</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6> 
                        <span class="text-secondary">bootdey</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6> 
                        <span class="text-secondary">@bootdey</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6> 
                        <span class="text-secondary">bootdey</span>
                    </li>
                    
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6> 
                        <span class="text-secondary">bootdey</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Full Name</h6>
                        </div>
                        
                        <div class="col-sm-9 text-secondary"> Kenneth Valdez</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary"> fip@jukmuh.al</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Phone</h6>
                        </div>
                        <div class="col-sm-9 text-secondary"> (239) 816-9029</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Mobile</h6>
                        </div>
                        <div class="col-sm-9 text-secondary"> (320) 380-4539</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Address</h6>
                        </div>
                        <div class="col-sm-9 text-secondary"> Bay Area, San Francisco, CA</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12"> <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
</body>
</html>


