<?php class_exists('Controller') or exit; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo navbar() ?>  - User Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" crossorigin="anonymous" href="<?php echo baseurl() ?>/public/assets/bootstrap/css/style.css" />
    <script src="<?php echo baseurl() ?>/public/assets/bootstrap/js/main.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo baseurl() ?>"><?php echo navbar() ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo baseurl() ?>"><i class="bi bi-house-door"></i> Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo baseurl() ?>/users"><i class="bi bi-people-fill"></i> Users</a>
                </li>
            </ul>

            <ul class="navbar-nav me-0 mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo baseurl() ?>/auth/login"><i class="bi bi-person-lock text-sm"></i> Login</a>
                </li>

                <li class="nav-item bg-success rounded">
                    <a class="nav-link bg-success rounded text-white" href="<?php echo baseurl() ?>/auth/accounts"><i class="bi bi-person-add"></i> Sign Up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <div class="container-fluid">
        
    <div class="container">
        <div class="row">
            <div class="col-md-6 card-header">
                <h3 class="text text-info">Account Manager - Sign Up</h3>
                <h5><a href="<?=baseurl();?>"> Back to home</a></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form action="<?=baseurl();?>/auth/accounts/create" method="post">
                    <div class="row">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="" />
                    </div>

                    <div class="row mt-2">
                        <label for="email">Mail</label>
                        <input type="email" class="form-control" name="email" id="" />
                    </div>
                    <input type="hidden" name="date" value="<?=date("Y-m-d H:i:s");?>" />
                    <br>
                    <div class="row m-2">
                        <button class="btn btn-sm btn-primary my-2" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
</body>
</html>

