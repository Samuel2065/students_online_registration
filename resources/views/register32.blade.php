
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
            <img src="./assets/ztflogo.png" alt="ZTF Logo" class="logo mb-3">
            <div class="text-title">
                <h1 class="fs-5">Academic Background / Background Academique</h1>
                <span class="fw-bold">Fill this form to register <i class="fw-light">Veuillez remplir ce formulaire pour
                        vous inscrire</i></span>
            </div>
        </div>
    <form action="{{ url('/register3') }}" method="post" enctype="multipart/form-data" id="">
        @csrf
        <div class="form-group">
            <label for="school_name">School name:</label>
            <input type="text" id="school_name" name="school_name" class="form-control" value="{{ old('school_name') }}" placeholder="Your answer" required>
        </div>

        <div class="form-group">
            <label for="exam">Academic Background / Background Academic:</label>
            <select id="exam" name="exam" class="form-select" required>
                <option value="">--Select Exam Type--</option>
                <option value="gce" {{ old('exam') === 'gce' ? 'selected' : '' }}>GCE</option>
                <option value="bacc" {{ old('exam') === 'bacc' ? 'selected' : '' }}>BACC</option>
            </select>
        </div>

        <!-- GCE Options -->
        <div id="gce-options" class="d-none">
            <button type="button" class="btn btn-outline-secondary me-2" id="add-alevel-btn">Add A Level Papers</button>
            <button type="button" class="btn btn-outline-secondary" id="add-olevel-btn">Add O Level Papers</button>
        </div>

        <!-- A Level Modal -->
        <div class="modal fade" id="alevelModal" tabindex="-1" aria-labelledby="alevelModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="alevelModalLabel">A Level Papers</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table" id="alevel-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Paper Name</th>
                                    <th>Grade</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="gce_alevel_papers[0][subject]" id="" class="form-select subject-select">
                                            <option value="">Select Subject</option>
                                            <option value="Mathematics">Mathematics</option>
                                            <option value="Physics">Physics</option>
                                            <option value="Chemistry">Chemistry</option>
                                            <option value="Biology">Biology</option>
                                            <option value="Geography">Geography</option>
                                            <option value="History">History</option>
                                            <option value="English">English</option>
                                            <option value="Computer Science">Computer Science</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gce_alevel_papers[0][grade]" id="" class="form-select" disable>
                                            <option value="">Select Grade</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                        </select>    
                                    </td>   
                                    <td>
                                        <button type="button" class="btn btn-danger remove-alevel-row">Remove</button>
                                    </td> 
                                </tr>
                            </tbody>
                        </table>

                        <button type="button" class="btn btn-primary" id="add-alevel-row">Add Paper</button>

                        <div class="form-group mt-2">
                            <label for="gce_alevel_slip">A-level Slip:</label>
                            <input type="file" id="gce_alevel_slip" name="gce_alevel_slip" class="form-control" placeholder="Upload your A-level slip">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- O Level Options -->
            <div class="modal fade" id="olevelModal" tabindex="-1" aria-labelledby="olevelModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="olevelModalLabel">O Level Papers</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table" id="olevel-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Paper Name</th>
                                    <th>Grade</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="gce_olevel_papers[0][subject]" id="" class="form-select subject-select">
                                            <option value="">Select Subject</option>
                                            <option value="Mathematics">Mathematics</option>
                                            <option value="Physics">Physics</option>
                                            <option value="Chemistry">Chemistry</option>
                                            <option value="Biology">Biology</option>
                                            <option value="Geography">Geography</option>
                                            <option value="History">History</option>
                                            <option value="Economics">Economics</option>
                                            <option value="English Literature">English Literature</option>
                                            <option value="Computer Science">Computer Science</option>
                                            <option value="Religious Studies">Religious Studies</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gce_olevel_papers[0][grade]" id="" class="form-select" disable>
                                            <option value="">Select Grade</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                        </select>    
                                    </td>   
                                    <td>
                                        <button type="button" class="btn btn-danger remove-olevel-row">Remove</button>
                                    </td> 
                                </tr>
                            </tbody>
                        </table>

                        <button type="button" class="btn btn-primary" id="add-olevel-row">Add Paper</button>

                        <div class="form-group mt-2">
                            <label for="gce_olevel_slip">O-level Slip:</label>
                            <input type="file" id="gce_olevel_slip" name="gce_olevel_slip" class="form-control" placeholder="Upload your O-level slip">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>





        <!-- BACC Options -->
        <div id="bacc-options" style="display:none;" class="my-3">
            <div class="form-group">
                <label for="bacc_average">Moyenne:</label>
                <input type="number" step="" id="bacc_average" name="bacc_average" class="form-control" value="{{ old('bacc_average') }}" placeholder="Entrez votre moyenne">
            </div>
            <div class="form-group mt-2">
                <label for="">Serie</label>
                <select name="bacc_series" id="bacc_series">
                    <option value="">Select series</option>
                    <option value="A" {{old('bacc_series') == 'A' ? 'selected' : ''}}>A</option>
                    <option value="C" {{old('bacc_series') == 'C' ? 'selected' : ''}}>C</option>
                    <option value="D" {{old('bacc_series') == 'D' ? 'selected' : ''}}>D</option>
                    <option value="E" {{old('bacc_series') == 'E' ? 'selected' : ''}}>E</option>
                    <option value="TI" {{old('bacc_series') == 'TI' ? 'selected' : ''}}>TI</option>
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="bacc_slip">Relevé:</label>
                <input type="file" id="bacc_slip" name="bacc_slip" class="form-control" placeholder="Upload your BACC slip">
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Initialize form elements or add event listeners here
                const examSelect = document.getElementById('exam');
                const gceOptions = document.getElementById('gce-options');
                const baccOptions = document.getElementById('bacc-options');

                examSelect.addEventListener('change', function() {
                    if (this.value === 'gce') {
                        gceOptions.classList.remove('d-none');
                        baccOptions.classList.add('d-none');
                    } else if (this.value === 'bacc') {
                        gceOptions.classList.add('d-none');
                        baccOptions.classList.remove('d-none');
                    } else {
                        gceOptions.classList.add('d-none');
                        baccOptions.classList.add('d-none');
                    }
                });

                // A-Level table Management
                let alevelRowCount = 1;
                const maxAlevelRows = 5;

                document.getElementById('addAlevelRow').addEventListener('click', function() {
                    if (alevelRowCount < maxAlevelRows) {
                        const tbody = document.querySelector('#alevel-table tbody');
                        const newRow = createSubjectRow('gce_alevel_papers', alevelRowCount);
                        tbody.appendChild(newRow);
                        alevelRowCount++;
                        updateRowButtons('alevel-table');
                    }
                });

                // O-Level table Management
                let olevelRowCount = 1;
                const maxOlevelRows = 11;

                document.getElementById('addOlevelRow').addEventListener('click', function() {
                    if (olevelRowCount < maxOlevelRows) {
                        const tbody = document.querySelector('#olevel-table tbody');
                        const newRow = createSubjectRow('gce_olevel_papers', olevelRowCount);
                        tbody.appendChild(newRow);
                        olevelRowCount++;
                        updateRowButtons('olevel-table');
                    }
                });

                // Function to create a new row for subjects
                function createSubjectRow(prefix, index) {
                    const row = document.createElement('tr');
                    const subjects = prefix === 'gce_alevel_papers' ? 
                        ['Mathematics', 'Physics', 'Chemistry', 'Biology', 'English', 'French', 'History', 'Geography'] :
                        
                        ['Mathematics', 'English', 'Physics', 'Chemistry', 'Biology', 'History', 'Geography', 'French', 'Economics', 'Literature', 'Computer Science', 'Religious Studies'];
                    
                    row.innerHTML = `
                        <td>
                            <select class="form-select subject-select" name="${prefix}[${index}][subject]">
                                <option value="">Select Subject</option>
                                ${subjects.map(subject => <option value="${subject}">${subject}</option>).join('')}
                            </select>
                        </td>
                        <td>
                            <select class="form-select grade-select" name="${prefix}[${index}][grade]" disabled>
                                <option value="">Select Grade</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                        </td>
                    `;

                    // Add event listeners
                    const subjectSelect = row.querySelector('.subject-select');
                    const gradeSelect = row.querySelector('.grade-select');
                    const removeBtn = row.querySelector('.remove-row');

                    subjectSelect.addEventListener('change', function() {
                        gradeSelect.disabled = !this.value;
                        if (!this.value) gradeSelect.value = '';
                        updateAddButtonState();
                    });

                    gradeSelect.addEventListener('change', function() {
                        updateAddButtonState();
                    });

                    removeBtn.addEventListener('click', function() {
                        row.remove();
                        if (prefix === 'gce_alevel_papers') alevelRowCount--;
                        else olevelRowCount--;
                        updateRowButtons(prefix === 'gce_alevel_papers' ? 'alevel-table' : 'olevel-table');
                        updateAddButtonState();
                    });

                    return row;
                }

                function updateRowButtons(tableId) {
                    const rows = document.querySelectorAll(#${tableId} tbody tr);
                    rows.forEach((row, index) => {
                        const removeBtn = row.querySelector('.remove-row');
                        removeBtn.disabled = rows.length === 1;
                    });
                }

                function updateAddButtonState() {
                    updateTableAddButton('alevel-table', 'addAlevelRow', maxAlevelRows);
                    updateTableAddButton('olevel-table', 'addOlevelRow', maxOlevelRows);
                }

                function updateTableAddButton(tableId, buttonId, maxRows) {
                    const rows = document.querySelectorAll(#${tableId} tbody tr); 
                    const addBtn = document.getElementById(buttonId);
                    
                    let canAdd = rows.length < maxRows;
                    
                    // Check if all previous rows have grades selected
                    for (let i = 0; i < rows.length; i++) {
                        const gradeSelect = rows[i].querySelector('.grade-select');
                        if (!gradeSelect.value) {
                            canAdd = false;
                            break;
                        }
                    }
                    
                    addBtn.disabled = !canAdd;
                }

                // Initial setup for existing rows
                document.querySelectorAll('.subject-select').forEach(select => {
                    select.addEventListener('change', function() {
                        const gradeSelect = this.closest('tr').querySelector('.grade-select');
                        gradeSelect.disabled = !this.value;
                        if (!this.value) gradeSelect.value = '';
                        updateAddButtonState();
                    });
                });

                document.querySelectorAll('.grade-select').forEach(select => {
                    select.addEventListener('change', function() {
                        updateAddButtonState();
                    });
                });

                document.querySelectorAll('.remove-row').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const tableId = this.closest('table').id;
                        this.closest('tr').remove();
                        if (tableId === 'alevel-table') alevelRowCount--;
                        else olevelRowCount--;
                        updateRowButtons(tableId);
                        updateAddButtonState();
                    });
                });

                // Initialize
                updateAddButtonState();
                updateRowButtons('alevel-table');
                updateRowButtons('olevel-table');
            });
        </script>


        <div class="d-flex justify-content-end">
            <div class="btn-group" role="group" aria-label="Default button group">
                <button type="button" class="btn btn-outline-primary" onclick="window.location.href='./register2'">Previous</button>
                <button type="reset" class="btn btn-outline-primary">Reset</button>
                <button type="submit" class="btn btn-outline-primary">Next</button>
            </div>
        </div>

    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous">
    </script>

</body>

</html>
