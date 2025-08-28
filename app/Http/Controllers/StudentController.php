<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;

class StudentController extends Controller
{
    public function register1()
    {
        return view('register1');
    }

    public function register1Post(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dob' => 'required|date',
            'birth_certificate' => 'required|file|mimes:pdf,jpeg,png,jpg,gif|max:2048',
        ]);

        if($request->hasFile('picture')) {
            $validatedData['picture'] = $request->file('picture')->store('pictures', 'public');
        }
        if($request->hasFile('birth_certificate')) {
            $validatedData['birth_certificate'] = $request->file('birth_certificate')->store('birth_certificates', 'public');
        }

        // $request->session()->put('register1', [
        //     'full_name' => $validatedData['full_name'],
        //     'email' => $validatedData['email'],
        //     'picture' => $validatedData['picture'],
        //     'dob' => $validatedData['dob'],
        //     'birth_certificate' => $validatedData['birth_certificate'],
        // ]);


        // // Handle file uploads
        // $picturePath = $request->file('picture')->store('pictures', 'public');
        // $birthCertificatePath = $request->file('birth_certificate')->store('birth_certificates', 'public');

        // Store data in session
        // $request->session()->put('register1', [
        //     'full_name' => $validatedData['full_name'],
        //     'email' => $validatedData['email'],
        //     'picture' => $picturePath,
        //     'dob' => $validatedData['dob'],
        //     'birth_certificate' => $birthCertificatePath,
        // ]);

        $student = Student::create($validatedData);

        $request->session()->put('student_id', $student->id);

        return redirect('/register2')->with('success', 'Step 1 completed successfully.');
    }

    // Display registration step 2
    public function register2(Request $request)
    {
        // 1
        return view('register2');
    }
    
    public function register2Post(Request $request)
    {
        $validatedData = $request->validate([
            'father_name' => 'required|string|max:255',
            'father_tel' => 'required|string|max:15',
            'mother_name' => 'required|string|max:255',
            'mother_tel' => 'required|string|max:15',
            'tutor_name' => 'required|string|max:15',
            'tutor_tel' => 'required|string|max:15',
            'urgence_tel' => 'required|string|max:15',
        ]);

        $studentId = $request->session()->get('student_id');

        if (!$studentId) {
            return redirect('/register1')->with('error', 'Please complete the first form.');
        }

        Student::where('id', $studentId)
            ->update($validatedData);

        // $step2Data = $request->session()->get('register1');
        
        // if(!$step2Data) {
        //     return redirect('/register1')->with('error', 'Please complete step 1 first');
        // }
        
        return redirect('/register3')->with('success', 'Step 2 completed successfully.');
    }
    
    public function register3(Request $request)
    {
        return view('register3');
    }

    public function register3Post(Request $request)
    {
            // Debug : voir toutes les données reçues
        \Log::info('Request data:', $request->all());
        
        // Debug : voir spécifiquement les papers
        \Log::info('O-Level Papers:', $request->get('gce_olevel_papers', []));
        \Log::info('O-Level Grades:', $request->get('gce_olevel_grades', []));
        
        $validatedData = $request->validate([
            // ... vos règles
        ]);
        
        // Debug : voir les données après validation
        \Log::info('Validated data:', $validatedData);

        // dd($request->all());

        $validatedData = $request->validate([
            'school_name' => 'required|string|max:255',
            'academic_background' => 'required|in:GCE,BACC',

            // GCE Fields
            'gce_alevel_papers' => 'nullable|array',
            'gce_alevel_papers.*' => 'nullable|string|max:255',
            'gce_alevel_grades' => 'nullable|array',
            'gce_alevel_grades.*' => 'nullable|string|max:2',
            'gce_alevel_slip' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'gce_olevel_papers' => 'nullable|array',
            'gce_olevel_papers.*' => 'nullable|string|max:255',
            'gce_olevel_grades' => 'nullable|array',
            'gce_olevel_grades.*' => 'nullable|string|max:2',
            'gce_olevel_slip' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',

            // BACC Fields
            'bacc_average' => 'nullable|numeric',
            'bacc_series' => 'nullable|string|max:255',
            'bacc_slip' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Save to DB

        if ($request->hasFile('gce_olevel_slip')) {
            $validatedData['gce_olevel_slip'] = $request->file('gce_olevel_slip')->store('gce_olevel_slips', 'public');
        }

        if ($request->hasFile('gce_alevel_slip')) {
            $validatedData['gce_alevel_slip'] = $request->file('gce_alevel_slip')->store('gce_alevel_slips', 'public');
        }

        if ($request->hasFile('bacc_slip')) {
            $validatedData['bacc_slip'] = $request->file('bacc_slip')->store('bacc_slips', 'public');
        }

        $validatedData['gce_alevel_papers'] = isset($validatedData['gce_alevel_papers']) ? json_encode($validatedData['gce_alevel_papers']) : null;
        $validatedData['gce_alevel_grades'] = isset($validatedData['gce_alevel_grades']) ? json_encode($validatedData['gce_alevel_grades']) : null;
        $validatedData['gce_olevel_papers'] = isset($validatedData['gce_olevel_papers']) ? json_encode($validatedData['gce_olevel_papers']) : null;
        $validatedData['gce_olevel_grades'] = isset($validatedData['gce_olevel_grades']) ? json_encode($validatedData['gce_olevel_grades']) : null;


        $request->session()->put('register3', $validatedData); 


        $studentId = $request->session()->get('student_id');


        if (!$studentId) {
            return redirect('/register1')->with('error', 'Please complete the first form.');
        }

        // Update student record
        Student::where('id', $request->session()->get('student_id'))->update($validatedData);

             

        return redirect()->route('register4');
    }

    public function register4(Request $request)
    {
        return view('register4');
    }

    public function register4Post(Request $request) 
    {
        $validatedData = $request->validate([
            'field' => 'nullable|string|max:2048', // 2MB max
            'speciality' => 'nullable|string|max:2048' // 2MB max',
        ]);

        $studentId = $request->session()->get('student_id');

        if (!$studentId) {
            return redirect('/register1')->with('error', 'Please complete the first form.');
        }

        Student::where('id', $studentId)
            ->update($validatedData);
        // $step4Data = $request->session()->get('register3');

        // if(!$step4Data) {
        //     return redirect('/register3')->with('error', 'Please complete first form.');
        // }

        return redirect('/register5')->with('success', 'Step 4 completed successfully.');
    }

    public function register5(Request $request)
    {
        // if (!$request->session()->has('register4')) {
        //     return redirect('/register4')->with('error', 'Please complete the fourth form first.');
        // }
        return view('register5');
    }

    public function register5Post(Request $request)
    {
        $validatedData = $request->validate([
            'motivation_reason' => 'nullable|string|max:2048', // 2MB max
        ]);

        $studentId = $request->session()->get('student_id');

        if (!$studentId) {
            return redirect('/register1')->with('error', 'Please complete the first form.');
        }

        Student::where('id', $studentId)
            ->update($validatedData);

        // if(!$step4Data) {
        //     return redirect('/register4')->with('error', 'Please complete the fourth form first.');
        // }

        return redirect('/register6')->with('success', 'Step 5 completed successfully.');
    }

    public function register6(Request $request)
    {
        // if (!$request->session()->has('register5')) {
        //     return redirect('/register5')->with('error', 'Please complete the fifth form first.');
        // }
        return view('register6');
    }

    public function register6Post(Request $request)
    {
        $validatedData = $request->validate([
            'field' => 'nullable|string|max:2048', // 2MB max
            'speciality' => 'nullable|string|max:2048' // 2MB max',
        ]);

        $studentId = $request->session()->get('student_id');

        if (!$studentId) {
            return redirect('/register1')->with('error', 'Please complete the first form.');
        }

        Student::where('id', $studentId)
            ->update($validatedData);

        // $step6Data = $request->session()->get('register5');

        // if(!$step6Data) {
        //     return redirect('/register5')->with('error', 'Please complete the fifth form first');
        // }

        // $studentData = array_merge(
        //     session()->get('register1', []),
        //     session()->get('register2', []),
        //     session()->get('register3', []),
        //     session()->get('register4', []),
        //     session()->get('register5', []),

        //     $validatedData
        // );

        //  // Store data in the database
        // student::create([
        //     'full_name' => $step1Data['full_name'],
        //     'email' => $step1Data['email'],
        //     'picture' => $step1Data['picture'],
        //     'dob' => $step1Data['dob'],
        //     'birth_certificate' => $step1Data['birth_certificate'],
        //     'father_name' => $validatedData['father_name'],
        //     'father_tel' => $validatedData['father_tel'],
        //     'mother_name' => $validatedData['mother_name'],
        //     'mother_tel' => $validatedData['mother_tel'],
        //     'tutor_name' => $validatedData['tutor_name'],
        //     'tutor_tel' => $validatedData['tutor_tel'],
        //     'urgence_tel' => $validatedData['urgence_tel'],
        //     'school_name' => $validatedData['school_name'],
        //     'exam' => $validatedData['exam'],
        //     'gce_alevel_papers' => $validatedData['gce_alevel_papers'],
        //     'gce_alevel_slip' => $validatedData['gce_alevel_slip'],
        //     'gce_olevel_papers' => $validatedData['gce_olevel_papers'],
        //     'gce_olevel_slip' => $validatedData['gce_olevel_slip'],
        //     'bacc_series' => $validatedData['bacc_series'],
        //     'bacc_average' => $validatedData['bacc_average'],
        //     'bacc_slip' => $validatedData['bacc_slip'],
        //     'field' => $validatedData['field'],
        //     'speciality' => $validatedData['speciality'],
        //     'motivation_reason' => $validatedData['motivation_reason'],
        //     'other_background' => $validatedData['other_background'],
        // ])->save();

        // // Clear session data
        // $request->session()->forget('register1');

        return redirect('/register1')->with('success', 'Registration completed successfully.');
    }
    
}

