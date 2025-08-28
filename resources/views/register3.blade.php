<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form 3</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="./bs.css">
    <link rel="stylesheet" href="./assets/fontawesome-free-7.0.0-web/css/all.min.css">
</head>

<style>
    body{
        Background: url('./assets/vecteezy_isometric-style-illustration-of-login-to-website_6552114.jpg') no-repeat center center fixed;
        Background-size: cover;
    }

    .modal-body {
        max-height: 500px;
        overflow-y: auto;
    }
    .form-label {
        font-weight: bold;
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
                <span class="fw-bold">Fill this form to register <i class="fw-light">Veuillez remplir ce formulaire pour vous inscrire</i> </span>
            </div>
        </div>

        <form action="{{ url('/register3') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- School Name --}}
            <div class="form-group mb-3">
                <label for="school_name" class="form-label">School Name</label>
                <input type="text" name="school_name" id="school_name" class="form-control" required>
            </div>

            {{-- Exam Type --}}
            <div class="form-group mb-3">
                <label for="academic_background" class="form-label">Select Exam</label>
                <select name="academic_background" id="academic_background" class="form-select" required>
                    <option value="">-- Choose Exam --</option>
                    <option value="GCE">GCE</option>
                    <option value="BACC">BACC</option>
                </select>
            </div>

            {{-- GCE Section --}}
            <div id="gce-section" style="display:none;">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Please add your O-Level and A-Level papers below
                </div>
                <button type="button" class="btn btn-outline-primary mb-2 me-2" data-bs-toggle="modal" data-bs-target="#olevelModal">
                    <i class="fas fa-plus me-1"></i>Add O-Level Papers
                </button>
                <button type="button" class="btn btn-outline-success mb-2" data-bs-toggle="modal" data-bs-target="#alevelModal">
                    <i class="fas fa-plus me-1"></i>Add A-Level Papers
                </button>
            </div>

            {{-- O-Level Modal --}}
            <div class="modal fade" id="olevelModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">O-Level Papers</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped" id="olevelTable">
                                <thead class="table-dark">
                                    <tr><th>No</th><th>Paper</th><th>Grade</th><th>Action</th></tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <button type="button" class="btn btn-success" id="addOlevelRow">
                                <i class="fas fa-plus me-1"></i>Add Row
                            </button>
                            <div class="mt-3">
                                <label class="form-label">Upload O-Level Certificate</label>
                                <input type="file" name="gce_olevel_slip" class="form-control" accept=".pdf,.jpg,.png">
                                <small class="form-text text-muted">Accepted formats: PDF, JPG, PNG</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- A-Level Modal --}}
            <div class="modal fade" id="alevelModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">A-Level Papers</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped" id="alevelTable">
                                <thead class="table-dark">
                                    <tr><th>No</th><th>Paper</th><th>Grade</th><th>Action</th></tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <button type="button" class="btn btn-success" id="addAlevelRow">
                                <i class="fas fa-plus me-1"></i>Add Row
                            </button>
                            <div class="mt-3">
                                <label class="form-label">Upload A-Level Certificate</label>
                                <input type="file" name="gce_alevel_slip" class="form-control" accept=".pdf,.jpg,.png">
                                <small class="form-text text-muted">Accepted formats: PDF, JPG, PNG</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BACC Section --}}
            <div id="bacc-section" style="display:none;">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Please provide your BACC details below
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="bacc_average" class="form-label">Average</label>
                        <input type="text" name="bacc_average" id="bacc_average" class="form-control" placeholder="Ex: 15.50">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="bacc_series" class="form-label">Series</label>
                        <input type="text" name="bacc_series" id="bacc_series" class="form-control" placeholder="Ex: Série C">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="bacc_slip" class="form-label">Upload Certificate</label>
                    <input type="file" name="bacc_slip" id="bacc_slip" class="form-control" accept=".pdf,.jpg,.png">
                    <small class="form-text text-muted">Accepted formats: PDF, JPG, PNG</small>
                </div>
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

    <script>
    
        document.getElementById('academic_background').addEventListener('change', function () {
            const gce = document.getElementById('gce-section');
            const bacc = document.getElementById('bacc-section');

            // Masquer les deux sections d'abord
            gce.style.display = 'none';
            bacc.style.display = 'none';

            // Afficher la section correspondante
            if (this.value === 'GCE') {
                gce.style.display = 'block';
                console.log('GCE section displayed'); // Pour debug
            } else if (this.value === 'BACC') {
                bacc.style.display = 'block';
                console.log('BACC section displayed'); // Pour debug
            }
        });

        const subjects = ['Mathematics', 'English', 'Biology', 'Chemistry', 'Physics', 'Geography', 'History', 'French', 'Literature', 'Economics', 'Computer Science'];
        const grades = ['A', 'B', 'C', 'D', 'E', 'F'];

        function createRow(tableId, maxRows) {
            const table = document.getElementById(tableId).querySelector('tbody');
            const lastRow = table.rows[table.rows.length - 1];

            if (table.rows.length >= maxRows) {
                alert(`Maximum ${maxRows} rows allowed.`);
                return;
            }

            if (lastRow) {
                const gradeSelect = lastRow.querySelector('.grade-select');
                if (!gradeSelect || !gradeSelect.value) {
                    alert('Please select a grade before adding another row.');
                    return;
                }
            }

            const index = table.rows.length;
            const row = table.insertRow();

            // CORRECTION: Utiliser les bons noms de champs
            const paperFieldName = tableId === 'olevelTable' ? 'gce_olevel_papers' : 'gce_alevel_papers';
            const gradeFieldName = tableId === 'olevelTable' ? 'gce_olevel_grades' : 'gce_alevel_grades';

            row.innerHTML = `
                <td class="text-center">${index + 1}</td>
                <td>
                    <select class="form-select subject-select" name="${paperFieldName}[]" required>
                        <option value="">-- Select Subject --</option>
                        ${subjects.map(s => `<option value="${s}">${s}</option>`).join('')}
                    </select>
                </td>
                <td>
                    <select class="form-select grade-select" name="${gradeFieldName}[]" required>
                        <option value="">-- Select Grade --</option>
                        ${grades.map(g => `<option value="${g}">${g}</option>`).join('')}
                    </select>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;

            // Réorganiser les numéros après ajout
            updateRowNumbers(tableId);
        }

        function removeRow(button) {
            const row = button.closest('tr');
            const tableId = row.closest('table').id;
            row.remove();
            updateRowNumbers(tableId);
        }

        function updateRowNumbers(tableId) {
            const table = document.getElementById(tableId).querySelector('tbody');
            Array.from(table.rows).forEach((row, index) => {
                row.cells[0].textContent = index + 1;
            });
        }

        document.getElementById('addOlevelRow').addEventListener('click', () => createRow('olevelTable', 11));
        document.getElementById('addAlevelRow').addEventListener('click', () => createRow('alevelTable', 5));
    </script>
            


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous">
</script>
</body>
</html>


        