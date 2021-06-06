<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to My-Test</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>vendors/bootstrap-4/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>vendors/bootstrap-4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= ASSETS_URL; ?>css/style.css">
    <style>
       
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <header>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="<?= BASE_URL; ?>">My-Test</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <div class="col offset-3">
                        <form class="form-submit" name="form">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control ml-2 col-md-6 col-sm-12" name="firstName" placeholder="First Name" aria-label="Name" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control ml-2 col-md-6 col-sm-12" name="lastName" placeholder="Last Name" aria-label="Name" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control ml-2 col-md-6 col-sm-12" name="email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control ml-2 col-md-6 col-sm-12" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Password" aria-label="Email">
                        </div>
                        <div id="message">
                                <h6>Password must contain the following:</h6>
                                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                <p id="number" class="invalid">A <b>number</b></p>
                                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                <p id="lengthMax" class="invalid">Maximum <b>16 characters</b></p>
                            </div>
                        <div class="input-group">
                            <h6 class="ml-1">Hobbies</h6>
                        </div>
                        <div class="input-group mb-3">
                            <input type="checkbox" id="dance" name="hobbies[]" class="form-group ml-2 mt-2" value="dance">
                            <label for="dance" class="ml-2">Dance</label>
                            <input type="checkbox" id="yoga" name="hobbies[]" class="form-group ml-2 mt-2" value="yoga">
                            <label for="yoga" class="ml-2">Yoga</label>
                            <input type="checkbox" id="cook" name="hobbies[]" class="form-group ml-2 mt-2" value="cooking">
                            <label for="cook" class="ml-2">Cooking</label>
                            <input type="checkbox" id="blog" name="hobbies[]" class="form-group ml-2 mt-2" value="blogging">
                            <label for="blog" class="ml-2">Blogging</label>
                        </div>
                        <div class="input-group">
                            <input type="file" name="profilePic" class="custom-file">
                        </div>
                        <button type="submit" class="btn btn-success url-btn" data-url="<?= BASE_URL; ?>webservice/registration/insert">Submit</button>
                        </form>

                    </div>
                </div>

        </div>
    </div>
</div>
<div class="container">
    
</div>

<script src="<?= BASE_URL; ?>vendors/jquery/jquery-3.5.1.js"></script>
<script src="<?= BASE_URL; ?>vendors/sweetalert2/sweetalert2.js"></script>
<script src="<?= BASE_URL; ?>vendors/bootstrap-4/js/bootstrap.js"></script>
<script src="<?= BASE_URL; ?>vendors/bootstrap-4/js/bootstrap.min.js"></script>
<script src="<?= ASSETS_URL; ?>js/custom.js"></script>
</body>
</html>