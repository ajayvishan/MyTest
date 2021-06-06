<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to My-Test</title>
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap-4/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap-4/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>

    </style>
    <script src="<?= base_url('vendors/jquery/jquery-3.5.1.js') ?>"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <header>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="<?= BASE_URL; ?>">My-Test</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?= BASE_URL; ?>">Home <span class="sr-only">(current)</span></a>
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
        <div class="col">
            <div class="row">
                <?php
                error_reporting(0);
                $res = $this->db->select("id, firstName, lastName, email, hobbies, profilePic")->where("id", $id)->get("users")->result()[0];
                if ($this->db->affected_rows() > 0) {
                    ?>
                    <div class="col offset-3">
                        <form class="form-submit" name="form">
                            <input type="hidden" name="id" value="<?= $res->id ?>">

                            <img id="img" src="<?= UPLOAD_URL; ?>profile/<?= $res->profilePic ?>" alt="" width="150">

                            <div class="input-group mb-3">
                                <input type="text" class="form-control ml-2 col-md-6 col-sm-12" name="firstName"
                                       placeholder="First Name" aria-label="Name" value="<?= $res->firstName ?>">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control ml-2 col-md-6 col-sm-12" name="lastName"
                                       placeholder="Last Name" aria-label="Name" value="<?= $res->lastName ?>">
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control ml-2 col-md-6 col-sm-12" name="email"
                                       placeholder="Email" aria-label="Email" aria-describedby="basic-addon1"
                                       value="<?= $res->email ?>">
                            </div>

                            <div class="input-group">
                                <h6 class="ml-1">Hobbies</h6>
                            </div>

                            <div class="input-group mb-3">
                                <?php
                                $hobbies = explode(",", $res->hobbies);
                                ?>
                                <script>
                                    $(document).ready(function () {
                                        let hobbies = <?= json_encode($hobbies) ?>;

                                        for (let i = 0; i < hobbies.length; i++) {
                                            $(`input[value=${hobbies[i]}]`).attr("checked", "true");
                                        }
                                    });
                                </script>
                                <input type="checkbox" id="dance" name="hobbies[]" class="form-group ml-2 mt-2"
                                       value="dance">
                                <label for="dance" class="ml-2">Dance</label>
                                <input type="checkbox" id="yoga" name="hobbies[]" class="form-group ml-2 mt-2"
                                       value="yoga">
                                <label for="yoga" class="ml-2">Yoga</label>
                                <input type="checkbox" id="cook" name="hobbies[]" class="form-group ml-2 mt-2"
                                       value="cooking">
                                <label for="cook" class="ml-2">Cooking</label>
                                <input type="checkbox" id="blog" name="hobbies[]" class="form-group ml-2 mt-2"
                                       value="blogging">
                                <label for="blog" class="ml-2">Blogging</label>
                            </div>
                            <div class="input-group">
                                <input type="file" name="profilePic" class="custom-file">
                            </div>
                            <button type="submit" class="btn btn-success url-btn"
                                    data-url="<?= BASE_URL; ?>webservice/registration/update">Submit
                            </button>
                        </form>

                    </div>
                    <?php
                } else {
                    ?>
                    <p>Invalid</p>
                    <?php
                }
                ?>
            </div>

        </div>
    </div>
</div>
<div class="container">

</div>


<script src="<?= BASE_URL; ?>vendors/sweetalert2/sweetalert2.js"></script>
<script src="<?= BASE_URL; ?>vendors/bootstrap-4/js/bootstrap.js"></script>
<script src="<?= BASE_URL; ?>vendors/bootstrap-4/js/bootstrap.min.js"></script>
<script src="<?= ASSETS_URL; ?>js/custom.js"></script>
</body>
</html>