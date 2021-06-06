<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to My-Test</title>
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap-4/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap-4/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>

    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <header>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">My-Test</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?= base_url() ?>">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="registration">View Registration</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Hobbies</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $res = $this->db->select("id, firstName, lastName, email, profilePic, hobbies")->get("users")->result();
                    if ($this->db->affected_rows() > 0) {
                        $sr = 1;
                        foreach ($res as $user) {
                            ?>
                            <tr>
                                <td><?= $sr++; ?></td>
                                <td>
                                    <img class="img" src="uploads/profile/<?= $user->profilePic ?>?img=<?= time(); ?>"
                                         alt="" width="80">
                                </td>

                                <td><?= $user->firstName ?> <?= $user->lastName ?></td>
                                <td><?= $user->email ?></td>
                                <td><?php foreach (explode(",", $user->hobbies) as $hobbies) {
                                        print_r(ucwords($hobbies) . " ");
                                    } ?></td>
                                <td>
                                    <a href="edit-registration/<?= $user->id ?>" class="btn btn-info btn-sm">
                                        <i class="material-icons">create</i>
                                    </a>

                                    <button class="btn btn-danger btn-sm delete" data-id="<?= $user->id ?>">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td>No Result found...</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="container">

</div>

<script src="<?= base_url('vendors/jquery/jquery-3.5.1.js') ?>"></script>
<script src="<?= base_url('vendors/sweetalert2/sweetalert2.js') ?>"></script>
<script src="<?= base_url('vendors/bootstrap-4/js/bootstrap.min.js') ?>"></script>

<script>
    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        let form = $(this);
        let id = $(this).attr("data-id");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be Delete!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    url: "webservice/registration/delete",
                    type: 'post',
                    dataType: 'json',
                    data: {id},
                    success: function (data) {
                        console.log(data);
                        if (data.type == "success") {

                            let tr = $("table tbody").children().length;
                            $(form).parent().parent().remove();

                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );

                            if (tr == 1) {
                                $("table tbody").html("<tr><td>No result found...</td></tr>");

                            }

                        }

                        if (data.swal) {
                            Swal.fire(data.swal);
                        }


                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            }
        });
    });
</script>
</body>
</html>