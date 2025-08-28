<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form 2</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="./bs.css">
    <link rel="stylesheet" href="./assets/fontawesome-free-7.0.0-web/css/all.min.css">
</head>
<style>
    body{
        Background: url('./assets/vecteezy_isometric-style-illustration-of-login-to-website_6552114.jpg') no-repeat center center fixed;
        Background-size: cover;
    }
    
</style>

<body>
    <div class="form-container">
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Errors:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="title d-flex flex-column align-item-center justify-content-center my-2">
            <img src="../assets/ztflogo.png" alt="ZTF Logo" class="logo mb-3">
            <div class="text-title">
                <h1 class="fs-5">Guidance Informations / Information Parentales</h1>
                <span class="fw-bold">Fill this form to register <i class="fw-light">Veuillez remplir ce formulaire pour
                        vous inscrire</i></span>
            </div>
        </div>

        <form action="{{ url('/register2') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="">
                <div class="form-group mb-3 w-75">
                    <label for="father_name" class="form-label">Father's name / Nom du Pere:</label>
                    <input type="text" name="father_name" class="form-control" placeholder="Your answer"  required value="{{ old('father_name') }}">
                </div>
            </div>

            <div class="form-group mb-3 flex-direction-column w-25">
                <label for="father_tel" class="form-label">Phone/Téléphone</label>
                <input type="tel" name="father_tel" class="form-control" placeholder="Your answer" required value="{{ old('father_tel') }}">
            </div>

            <div class="">
                <div class="form-group mb-3 w-75">
                    <label for="mother_name" class="form-label">Mother's name / Nom de la Mere:</label>
                    <input type="text" name="mother_name" class="form-control" placeholder="Your answer" required value="{{ old('mother_name') }}">
                </div>
            </div>

            <div class="form-group mb-3 w-25">
                <label for="mother_tel" class="form-label">Phone/Téléphone</label>
                <input type="tel" name="mother_tel" class="form-control" placeholder="Your answer" required value="{{ old('mother_tel') }}">
            </div>

            <div class="form-group mb-3">
                <label for="tutor_name" class="form-label">Guidance's name / Nom du Tuteur:</label>
                <input type="text" name="tutor_name" class="form-control" placeholder="Your answer" required value="{{ old('tutor_name') }}">
            </div>

            <div class="form-group mb-3">
                <label for="tutor_tel" class="form-label">Guidance's Tel Number / Numero du Tuteur:</label>
                <input type="tel" name="tutor_tel" class="form-control" placeholder="Your answer" required value="{{ old('tutor_tel') }}">
            </div>

            <div class="form-group mb-3">
                <label for="urgence_tel" class="form-label">Emergency Number / Numero D'urgence</label>
                <input type="tel" name="urgence_tel" class="form-control" placeholder="Your answer" required value="{{ old('urgence_tel') }}">
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

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    <script>
</body>
</html>