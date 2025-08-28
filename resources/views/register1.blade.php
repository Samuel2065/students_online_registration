<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 1</title>

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
        
        <div class="title d-flex flex-column align-item-center justify-content-center my-2">
            <img src="./assets/ztflogo.png" alt="ZTF Logo" class="logo mb-3">
            <div class="text-title">
                <h1 class="fs-5">Personal Information / Information Personnel</h1>
                <span class="fw-bold">Fill this form to register <i class="fw-light">Veuillez remplir ce formulaire pour
                        vous inscrire</i></span>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        @if($errors->any()) <div class="alert alert-danger"><strong>Errors:</strong></div>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ url('/register1') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="full_name" class="form-label">Full Name / Noms et Prénoms:</label>
                <div class="form-control d-flex align-item-center">
                    <i class="fa fa-user"></i>
                     <input type="text" name="full_name" class="border-0 outline-0 bg-transparent px-2 w-97" placeholder="Your name" required value="{{ old('full_name') }}">
                </div>
               
            </div>

            <div class="form-group mb-3">
                <label for="email" class="form-label">Email / Email:</label>
                <div class="form-control d-flex align-item-center">
                    <i class="fa fa-envelope"></i>
                    <input type="email" name="email" class="border-0 outline-0 bg-transparent px-2 w-97" placeholder="Your email" required value="{{ old('email') }}">
                </div>                
            </div>

            <div class="form-group mb-3">
                <label for="dob" class="form-label">Date of Birth / Date de Naissance:</label>
                <input type="date" name="dob" class="form-control" required value="{{ old('dob') }}">
            </div>

            <div class="form-group mb-3">
                <label for="picture" class="form-label">Upload picture:</label>
                <input type="file" name="picture" class="form-control" required value="{{ old('picture') }}">
            </div>

            <div class="form-group mb-3">
                <label for="birth_certificate" class="form-label">Upload birth certificate:</label>
                <input type="file" name="birth_certificate" class="form-control" required value="{{ old('birth_certificate') }}">
            </div>

            <!-- <div class="d-flex my-3 gap-2">
                <div class="w-50 card p-2 border-1 border-dashed">
                    <div class="default-content d-flex flex-column align-items-center justify-content-center">
                         <i class="fa fa-file-upload"></i> -->
                        <!-- <label>Upload your picture here</label>
                        <input type="file" name="picture" class="form-control mt-2" style="display:none;" id="photoInput" accept="image/*" required> -->
                        <!-- <button type="button" id="photoBtn" class="btn btn-outline-secondary btn-sm mt-2">Choose a picture</button>
                        <div id="photoPreview" class="mt-2"></div> -->
                    <!-- </div>
                </div>                
            </div>  -->

            <!-- <div class="d-flex my-3 gap-2">
                <div class="w-50 card p-2 border-1 border-dashed">
                    <div class="default-content d-flex flex-column align-items-center justify-content-center">
                        <i class="fa fa-file-upload"></i>
                        <label>Upload your Birth Certificate here</label>
                        <input type="file" name="birth_certificate" class="form-control mt-2" id="birthCertInput" accept=".pdf,image/*" required>
                        <small class="form-text text-muted">Accepted formats: PDF, JPG, PNG</small>
                        <button type="button" id="birthCertBtn" class="btn btn-outline-secondary btn-sm mt-2">Choose a file</button>
                        <div id="birthCertPreview" class="mt-2"></div>
                    </div>
                </div>
            </div> -->
            
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

    <script>
    // Clic sur le bouton déclenche le file input caché
    // document.getElementById('photoBtn').addEventListener('click', function() {
    //     document.getElementById('photoInput').click();
    // });
    // document.getElementById('birthCertBtn').addEventListener('click', function() {
    //     document.getElementById('birthCertInput').click();
    // });

    // // Prévisualisation de la photo
    // document.getElementById('photoInput').addEventListener('change', function(e) {
    //     const preview = document.getElementById('photoPreview');
    //     preview.innerHTML = '';
    //     const file = e.target.files[0];
    //     if (file) {
    //         const reader = new FileReader();
    //         reader.onload = function(evt) {
    //             const img = document.createElement('img');
    //             img.src = evt.target.result;
    //             img.style.maxWidth = '100px';
    //             img.style.maxHeight = '100px';
    //             preview.appendChild(img);
    //         };
    //         reader.readAsDataURL(file);
    //     }
    // });

    // // Prévisualisation de l'acte de naissance (image ou PDF)
    // document.getElementById('birthCertInput').addEventListener('change', function(e) {
    //     const preview = document.getElementById('birthCertPreview');
    //     preview.innerHTML = '';
    //     const file = e.target.files[0];
    //     if (file) {
    //         if (file.type.startsWith('image/')) {
    //             const reader = new FileReader();
    //             reader.onload = function(evt) {
    //                 const img = document.createElement('img');
    //                 img.src = evt.target.result;
    //                 img.style.maxWidth = '100px';
    //                 img.style.maxHeight = '100px';
    //                 preview.appendChild(img);
    //             };
    //             reader.readAsDataURL(file);
    //         } else if (file.type === 'application/pdf') {
    //             const pdfIcon = document.createElement('i');
    //             pdfIcon.className = 'fa fa-file-pdf fa-2x text-danger me-2';
    //             preview.appendChild(pdfIcon);
    //             const fileName = document.createElement('span');
    //             fileName.textContent = file.name;
    //             preview.appendChild(fileName);
    //         } else {
    //             preview.textContent = 'Type de fichier non supporté';
    //         }
    //     }
    // });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    <script>
</body>
</html>