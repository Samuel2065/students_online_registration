<?php

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['register4'] = $_POST;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form 1</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../bs.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-7.0.0-web/css/all.min.css">
</head>

<style>
    body{
        Background: url('./assets/vecteezy_isometric-style-illustration-of-login-to-website_6552114.jpg') no-repeat center center fixed;
        Background-size: cover;
    }
    
</style>

<body>
    <div class="form-container">
       <div class="title d-flex flex-column align-item-center justify-content-center my-2">
            <img src="../assets/ztflogo.png" alt="ZTF Logo" class="logo mb-3">
            <div class="text-title">
                <h1 class="fs-5">Applied Field Reason / Motivations</h1>
                <span class="fw-bold">Fill this form to register <i class="fw-light">Veuillez remplir ce formulaire pour
                        vous inscrire</i></span>
            </div>
        </div>
    <form action="{{ url('/register5') }}" method="post" enctype="multipart/form-data" id="">
        @csrf
            <div class="form-group mb-3">
                <label for="motivation_reason">Reasons for applying to the field selected</label>
                <textarea name="motivation_reason" id="motivation_reason" class="form-control" cols="30" rows="10"></textarea>
            </div>

           <div class="d-flex justify-content-end mt-4">
                <div class="btn-group" role="group">
                    <button type="reset" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-redo me-1"></i>Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-right me-1"></i>Next
                    </button>
                </div>          
            </div>
        </form>
    </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>