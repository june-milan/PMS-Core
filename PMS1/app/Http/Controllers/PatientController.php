<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\EmergencyContact;
use App\Models\EmergencyInformation;
use App\Models\EmergencyPatient;
use App\Models\HealthHistories;
use App\Models\InsuranceInformation;
use App\Models\VitalSigns;
use Carbon;
use GuzzleHttp\Client;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        return view('admin_med.patient.records', compact('patients'));
    }

    public function indexm()
    {
        $patients = Patient::all();
        return view('admin_med.patient.recordsm', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patient_registration')->with('title', 'Add Patient');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "patient_type" => ['required', 'string'],
            "first_name" => ['required', 'string', 'max:15'],
            "middle_name" => ['required', 'string', 'max:15'],
            "last_name" => ['required', 'string', 'max:15'],
            "extension" => ['nullable', 'string', 'max:3'],
            "sex" => ['required'],
            "civil_status" => ['required'],
            "dob" => ['required', 'date_format:m-d-Y'],
            "phone" => ['required', 'string', 'digits:11'],
            "email" => ['required', 'email', 'max:30'],
            "employment" => ['required', 'string'],
            "nationality" => ['required', 'string', 'max:15'],
            "religion" => ['required', 'string', 'max:20'],
            "street_address" => ['required', 'string', 'max:30'],
            "street_address_2" => ['required', 'string', 'max:255'],
            "city" => ['required', 'string', 'max:15'],
            "state" => ['required', 'string', 'max:15'],
            "zip" => ['required', 'string', 'max:4'],
            // Emergency
            "emergency_first_name" => ['required', 'string', 'max:15'],
            "emergency_middle_name" => ['required', 'string', 'max:15'],
            "emergency_last_name" => ['required', 'string', 'max:15'],
            "relationship" => ['required', 'string', 'max:10'],
            "emergency_phone" => ['required', 'string', 'digits:11'],
            "emergency_phone_2" => ['required', 'string', 'digits:11'],
            "emergency_email" => ['required', 'email', 'max:30'],
            // Health History
            "reason_registration" => ['required', 'string'],
            "additional_note" => ['nullable', 'string'],
            "history_operation" => ['required', 'string'],
            "history_note" => ['nullable', 'string'],
            "current_condition" => ['required', 'string'],
            "condition_note" => ['nullable', 'string'],
            "taking_medications" => ['required', 'string'],
            "medications_note" => ['nullable', 'string'],
            "food_allergy" => ['required', 'string'],
            "food_allergy_note" => ['nullable', 'string'],
            "drug_allergy" => ['required', 'string'],
            "drug_allergy_note" => ['nullable', 'string'],
            "patient_smoke" => ['required', 'string'],
            "patient_alcohol" => ['required', 'string'],
            "family_history" => ['required', 'array'],
            // Insurance Information
            "primary_holder" => ['nullable', 'string'],
            "insurance_company" => ['nullable', 'string', 'max:255'],
            "insurance_number" => ['nullable', 'string', 'max:255'],
            "effective_date" => ['nullable', 'date_format:m-d-Y'],
            "expiration_date" => ['nullable', 'date_format:m-d-Y'],
            "plan_type" => ['nullable', 'string', 'max:255'],
            "holder_first_name" => ['nullable', 'string', 'max:255'],
            "holder_last_name" => ['nullable', 'string', 'max:255'],
            "holder_dob" => ['nullable', 'date_format:m-d-Y'],
            "holder_phone" => ['nullable', 'string', 'max:11'],
            "holder_email" => ['nullable', 'email', 'max:255'],
            "holder_street_address" => ['nullable', 'string', 'max:255'],
            "holder_street_address_2" => ['nullable', 'string', 'max:255'],
            "holder_city" => ['nullable', 'string', 'max:255'],
            "holder_state" => ['nullable', 'string', 'max:255'],
            "holder_zip" => ['nullable', 'string', 'max:10'],
        ]);

        $existingPatient = Patient::where('first_name', $validated['first_name'])
            ->where('middle_name', $validated['middle_name'])
            ->where('last_name', $validated['last_name'])
            ->where('dob', $validated['dob'])
            ->first();

        // Check if the patient already exists based on first_name, middle_name, and last_name
        if ($existingPatient) {
            // Redirect back with an error message
            return redirect()->back()->withErrors(['duplicate' => 'A patient with this name already exists.'])->withInput();
        }

        // Convert dates to 'Y-m-d' format
        $dates = ['dob', 'effective_date', 'expiration_date', 'holder_dob'];
        foreach ($dates as $date) {
            if (!empty($validated[$date])) {
                $validated[$date] = Carbon\Carbon::createFromFormat('m-d-Y', $validated[$date])->format('Y-m-d');
            }
        }

        // Create HealthHistory, InsuranceInformation, EmergencyContact, and Patient records in one go
        $healthHistory = HealthHistories::create([
            'reason_registration' => $validated['reason_registration'],
            'additional_note' => $validated['additional_note'],
            'history_operation' => $validated['history_operation'],
            'history_note' => $validated['history_note'],
            'current_condition' => $validated['current_condition'],
            'condition_note' => $validated['condition_note'],
            'taking_medications' => $validated['taking_medications'],
            'medications_note' => $validated['medications_note'],
            'food_allergy' => $validated['food_allergy'],
            'food_allergy_note' => $validated['food_allergy_note'],
            'drug_allergy' => $validated['drug_allergy'],
            'drug_allergy_note' => $validated['drug_allergy_note'],
            'patient_smoke' => $validated['patient_smoke'],
            'patient_alcohol' => $validated['patient_alcohol'],
            'family_history' => json_encode($validated['family_history']),
        ]);

        $insuranceInformation = InsuranceInformation::create([
            'primary_holder' => $validated['primary_holder'],
            'insurance_company' => $validated['insurance_company'],
            'insurance_number' => $validated['insurance_number'],
            'effective_date' => $validated['effective_date'],
            'expiration_date' => $validated['expiration_date'],
            'plan_type' => $validated['plan_type'],
            'holder_first_name' => $validated['holder_first_name'],
            'holder_last_name' => $validated['holder_last_name'],
            'holder_dob' => $validated['holder_dob'],
            'holder_phone' => $validated['holder_phone'],
            'holder_email' => $validated['holder_email'],
            'holder_street_address' => $validated['holder_street_address'],
            'holder_street_address_2' => $validated['holder_street_address_2'],
            'holder_city' => $validated['holder_city'],
            'holder_state' => $validated['holder_state'],
            'holder_zip' => $validated['holder_zip'],
        ]);

        $emergencyContact = EmergencyContact::create([
            "emergency_first_name" => $validated['emergency_first_name'],
            "emergency_middle_name" => $validated['emergency_middle_name'],
            "emergency_last_name" => $validated['emergency_last_name'],
            "relationship" => $validated['relationship'],
            "emergency_phone" => $validated['emergency_phone'],
            "emergency_phone_2" => $validated['emergency_phone_2'],
            "emergency_email" => $validated['emergency_email'],
        ]);

        Patient::create([
            "patient_type" => $validated['patient_type'],
            "first_name" => $validated['first_name'],
            "middle_name" => $validated['middle_name'],
            "last_name" => $validated['last_name'],
            "extension" => $validated['extension'],
            "sex" => $validated['sex'],
            "civil_status" => $validated['civil_status'],
            "dob" => $validated['dob'],
            "phone" => $validated['phone'],
            "email" => $validated['email'],
            "employment" => $validated['employment'],
            "nationality" => $validated['nationality'],
            "religion" => $validated['religion'],
            "street_address" => $validated['street_address'],
            "street_address_2" => $validated['street_address_2'],
            "city" => $validated['city'],
            "state" => $validated['state'],
            "zip" => $validated['zip'],
            "patient_status" => "Active",
            "health_history_id" => $healthHistory->health_history_id,
            "insurance_information_id" => $insuranceInformation->insurance_information_id,
            "emergency_contact_id" => $emergencyContact->emergency_contact_id,
        ]);

        $request->session()->flash('success', 'New Patient was added successfully!');

        return redirect('/dashboard');

    }

    /**
     * Display the specified resource.
     */
    public function show($patient_id)
    {
        $patient = Patient::with(['health_histories', 'insurance_information'])->findOrFail($patient_id);

        return view('admin_med.patient.view', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($patient_id)
    {
        $patient = Patient::with(['health_histories', 'insurance_information'])->findOrFail($patient_id);

        return view('admin_med.patient.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $patient_id)
    {
        $validated = $request->validate([
            "dob" => ['required', 'date_format:Y-m-d'],
            "nationality" => ['required', 'string', 'max:255'],
            "religion" => ['required', 'string', 'max:255'],
            "sex" => ['required'],
            "street_address" => ['required', 'string', 'max:255'],
            "phone" => ['required', 'string', 'digits:11'],
            "civil_status" => ['required'],
            "employment" => ['required', 'string'],
            "email" => ['required', 'email', 'max:255'],
            //
            "food_allergy_note" => ['nullable', 'string'],
            "condition_note" => ['nullable', 'string'],
            "history_note" => ['nullable', 'string'],
        ]);

        $patient = Patient::findOrFail($patient_id);

        $patient->update([
            'dob' => $validated['dob'],
            'nationality' => $validated['nationality'],
            'religion' => $validated['religion'],
            'sex' => $validated['sex'],
            'street_address' => $validated['street_address'],
            'phone' => $validated['phone'],
            'civil_status' => $validated['civil_status'],
            'employment' => $validated['employment'],
            'email' => $validated['email'],
        ]);

        // Update health history data
        // If health_history_id is present, update the health history record
        if ($patient->health_history_id) {
            $healthHistory = HealthHistories::find($patient->health_history_id);
            if ($healthHistory) {
                $healthHistory->update([
                    'food_allergy_note' => $validated['food_allergy_note'],
                    'condition_note' => $validated['condition_note'],
                    'history_note' => $validated['history_note'],
                ]);
            }
        }

        return redirect('/dashboard')->with('success', 'Patient was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }

    public function emergency_person_store(Request $request)
    {
        info('Request data:', $request->all()); // Log incoming request data

        // Remove '_token' and any fields not required by the microservice
        $data = $request->except('_token', 'emergency_date', 'emergency_dob');

        try {
            // Send the data to the validation microservice
            $response = Http::post('https://data-validation-microservice-1.onrender.com/api/validate/emergency-patient', $data);

            // Log response from the microservice for debugging
            info('Validation Microservice Response:', $response->json());

            // Check if the validation was successful
            if ($response->successful()) {
                if (isset($response['data'])) {
                    $validated = $response['data']; // Get the validated data from the microservice

                    // Convert 24-hour time to 12-hour format with AM/PM
                    if (!empty($validated['emergency_time'])) {
                        $dateTime = \DateTime::createFromFormat('H:i', $validated['emergency_time']);
                        if ($dateTime) {
                            $validated['emergency_time'] = $dateTime->format('g:i A');
                        }
                    }

                    // Check if an emergency patient already exists
                    $existingPatient = EmergencyPatient::where('emergency_first_name', $validated['emergency_first_name'])
                        ->where('emergency_middle_name', $validated['emergency_middle_name'])
                        ->where('emergency_last_name', $validated['emergency_last_name'])
                        ->where('emergency_dob', $request->input('emergency_dob'))
                        ->first();

                    if ($existingPatient) {
                        return redirect()->back()->withErrors(['error' => 'An emergency patient with this name already exists.'])->withInput();
                    }

                    // Convert dates if necessary (only for your local processing)
                    $validated['emergency_date'] = $request->input('emergency_date');
                    $validated['emergency_dob'] = $request->input('emergency_dob');

                    // Create new EmergencyPatient record with validated data
                    $emergencyPatient = EmergencyPatient::create([
                        'patient_temporary_id' => $validated['patient_temporary_id'],
                        'emergency_date' => $validated['emergency_date'],
                        'emergency_time' => $validated['emergency_time'],
                        'emergency_first_name' => $validated['emergency_first_name'],
                        'emergency_middle_name' => $validated['emergency_middle_name'],
                        'emergency_last_name' => $validated['emergency_last_name'],
                        'emergency_extension' => $validated['emergency_extension'],
                        'emergency_dob' => $validated['emergency_dob'],
                        'emergency_sex' => $validated['emergency_sex'],
                        'emergency_age' => $validated['emergency_age'],
                        'priority_level' => $validated['priority_level'],
                        'status' => 'Active',
                    ]);

                    // Store the vital signs data
                    VitalSigns::create([
                        'diagnosis_date' => $emergencyPatient->emergency_date,
                        'diagnosis_time' => $emergencyPatient->emergency_time,
                        'B_P' => $validated['B_P'],
                        'temperature' => $validated['temperature'],
                        'heart_rate' => $validated['heart_rate'],
                        'pulse_rate' => $validated['pulse_rate'],
                        'respiratory_rate' => $validated['respiratory_rate'],
                        'vitals_note' => $validated['vitals_note'],
                        'emergency_patient_id' => $emergencyPatient->emergency_patient_id,
                    ]);

                    // Only send email if the priority level is between 1 and 3
                    $priorityLevelsForEmail = ['1 - Resuscitation', '2 - Emergent', '3 - Urgent'];

                    if (in_array($validated['priority_level'], $priorityLevelsForEmail)) {
                        // Data to send to the email notification microservice
                        $emailData = [
                            'emergency_first_name' => $validated['emergency_first_name'],
                            'emergency_last_name' => $validated['emergency_last_name'],
                            'emergency_age' => $validated['emergency_age'],
                            'priority_level' => $validated['priority_level'],
                        ];

                        // Send POST request to the email notification microservice
                        $response = Http::post('https://email-notification-microservice-xzv1.onrender.com/add-emergency-patient', $emailData);

                        // Flash success message and redirect
                        // $request->session()->flash('success', 'Emergency Patient data stored successfully!');
                        if ($response->successful()) {
                            // Email sent successfully, you can log it or flash a success message if needed
                            $request->session()->flash('success', 'Emergency Patient data stored successfully and email notification sent!');
                        } else {
                            // Handle error when sending email
                            $request->session()->flash('error', 'Emergency Patient data stored successfully, but there was an issue sending the email.');
                        }
                    } else {
                        // No email sent, just flash success message for data stored
                        $request->session()->flash('success', 'Emergency Patient data stored successfully!');
                    }

                    return redirect('/emergency-records');
                } else {
                    // Log and handle if 'data' key is missing
                    info('Data key missing in response:', $response->json());
                    return redirect()->back()->withErrors(['error' => 'Validation microservice did not return the expected data structure.'])->withInput();
                }
            } else {
                // Log the error if validation failed
                info('Validation failed:', $response->json());
                return redirect()->back()->withErrors(['error' => 'Validation failed. Check the data provided.'])->withInput();
            }
        } catch (\Exception $e) {
            // Log any exceptions that occur
            info('Error occurred:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while processing the request: ' . $e->getMessage()])->withInput();
        }
    }


    public function generateUniqueId()
    {
        do {
            $id = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT). ' - TEMP';
        } while (DB::table('emergency_patients')->where('patient_temporary_id', $id)->exists());

        return response()->json(['id' => $id]);
    }

    public function emergency_index()
    {
        $emergency_patients = EmergencyPatient::all();

        return view('admin_med.patient.emergency.emergency_records', compact('emergency_patients'));
    }

    public function emergency_patient_show($emergency_patient_id)
    {
        $emergency_patient = EmergencyPatient::with(['vital_signs', 'emergency_information'])->findOrFail($emergency_patient_id);

        if (!$emergency_patient) {
            return response()->json(['message' => 'Emergency Patient not found'], 404);
        }

        return view('admin_med.patient.emergency.emergency_view', compact('emergency_patient'));
    }

    public function emergency_patient_edit($emergency_patient_id)
    {
        $emergency_patient = EmergencyPatient::with(['emergency_information'])->findOrFail($emergency_patient_id);

        if (!$emergency_patient) {
            return response()->json(['message' => 'Emergency Patient not found'], 404);
        }

        return view('admin_med.patient.emergency.emergency_edit', compact('emergency_patient'));
    }

    public function emergency_patient_update(Request $request, $emergency_patient_id)
    {
        info($request->all());
        $validated = $request->validate([
            'emergency_first_name' => 'required|string|max:255',
            'emergency_middle_name' => 'nullable|string|max:255',
            'emergency_last_name' => 'required|string|max:255',
            'emergency_extension' => 'nullable|string|max:10',
            'emergency_sex' => 'nullable|in:Male,Female', // Ensure it's Male or Female
            'ep_nationality' => 'nullable|string|max:255',
            'ep_religion' => 'nullable|string|max:255',
            'ep_full_address' => 'nullable|string|max:500',
            'ep_phone' => 'nullable|string|max:15|regex:/^[0-9]{10,15}$/', // Example: 10 to 15 digits for phone
            'ep_civil_status' => 'nullable|string|max:50',
            'ep_employment' => 'nullable|string|max:50',
            'ep_email' => 'nullable|email|max:255', // Valid email format
        ]);

        $emergency_patient = EmergencyPatient::findOrFail($emergency_patient_id);

        // Check if emergency information exists
        if ($emergency_patient->emergency_information) {
            // If emergency information exists, update it
            $emergency_info = $emergency_patient->emergency_information;

            $emergency_info->ep_nationality = $validated['ep_nationality'];
            $emergency_info->ep_religion = $validated['ep_religion'];
            $emergency_info->ep_full_address = $validated['ep_full_address'];
            $emergency_info->ep_phone = $validated['ep_phone'];
            $emergency_info->ep_civil_status = $validated['ep_civil_status'];
            $emergency_info->ep_employment = $validated['ep_employment'];
            $emergency_info->ep_email = $validated['ep_email'];
            // Save updated information
            $emergency_info->save();
        } else {
            // If no emergency information exists, create a new record
            $emergency_info = new EmergencyInformation();
            $emergency_info->ep_nationality = $validated['ep_nationality'];
            $emergency_info->ep_religion = $validated['ep_religion'];
            $emergency_info->ep_full_address = $validated['ep_full_address'];
            $emergency_info->ep_phone = $validated['ep_phone'];
            $emergency_info->ep_civil_status = $validated['ep_civil_status'];
            $emergency_info->ep_employment = $validated['ep_employment'];
            $emergency_info->ep_email = $validated['ep_email'];
            // Save new emergency information
            $emergency_info->save();

            // Update the emergency_patient with the new emergency_information_id
            $emergency_patient->emergency_information_id = $emergency_info->emergency_information_id;
            $emergency_patient->save();
        }

        $emergency_patient->update([
            'emergency_first_name' => $validated['emergency_first_name'],
            'emergency_middle_name' => $validated['emergency_middle_name'],
            'emergency_last_name' => $validated['emergency_last_name'],
            'emergency_extension' => $validated['emergency_extension'],
            'emergency_sex' => $validated['emergency_sex'],
            'emergency_dob' => $request->input('emergency_dob'),
        ]);

        return redirect('/emergency-records')->with('success', 'Emergency Patient was successfully updated');
    }

}

