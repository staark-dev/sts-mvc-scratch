<?php declare(strict_types=1); class_exists('Controller') or exit; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-control" content="no-cache" />
    <title><?php echo navbar() ?>  - User Management</title>

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
        
<div class="container my-5 py-2">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <h4>List of all users Created !</h4>
                <table id="mytable" class="table table-bordred table-striped">
                    <thead>
                        <th><input type="checkbox" id="checkall" /></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Register</th>

                        <th>Edit</th>
                        <th>Delete</th>
                </thead>
                <tbody>
                        <?php foreach($data as $users): ?>
                            <tr id="user-<?php echo $users['uID'] ?>">
                                <td><input type="checkbox" class="checkthis" id="<?php echo $users['uID'] ?>" /></td>
                                <?php if(strcmp(strval($users['uID']), '0')): ?>
                                <td><a href="/user/profile/<?php echo $users['name'] ?>/<?php echo $users['uID'] ?>" class="user-link text-sm text-info"><?php echo $users['name'] ?></a></td>
                                <td><?php echo $users['email'] ?></td>
                                <td><?php echo $users['date'] ?></td>
                                <?php endif; ?>
                                <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                            </tr>
                        <?php endforeach; ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    </div>
</body>
</html>

