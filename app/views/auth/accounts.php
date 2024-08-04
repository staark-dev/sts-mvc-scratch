<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STS CMR - Sign Up Account</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
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
                            <?php
                                foreach($data as $users) {
                                    echo "<tr>";
                                    echo '<td><input type="checkbox" class="checkthis" /></td>';
                                    foreach($users as $key => $val) {
                                        echo '<td>'. $val .'</td>';
                                    }
                                    echo '<td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>';
                                    echo '<td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>';
                                    echo "</tr>";
                                }
                            ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>