<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STS CMR - Login Account</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 card-header">
                <h3 class="text text-info">Account Manager - Login</h3>
                <h5><a href="<?=baseurl();?>"> Back to home</a></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form action="<?=baseurl();?>/auth/login" method="post">
                    <div class="row">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="" />
                    </div>

                    <div class="row mt-2">
                        <label for="email">Mail</label>
                        <input type="email" class="form-control" name="email" id="" />
                    </div>
                    <br>
                    <div class="row m-2">
                        <button class="btn btn-sm btn-primary my-2" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>