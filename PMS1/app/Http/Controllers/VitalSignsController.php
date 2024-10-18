<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VitalSigns;
use Illuminate\Http\Request;

class VitalSignsController extends Controller
{
    public function vital_signs_store(Request $request)
    {
        info($request->all());

        $validated = $request->validate([
            'diagnosis_date' => 'required|date', // Ensure a valid date is provided
            'diagnosis_time' => 'required|date_format:H:i', // Ensure time is in the correct format
            'B_P' => 'required|regex:/^\d{1,3}\/\d{1,3}$/', // Validate BP format (e.g., '120/80')
            'heart_rate' => 'required|integer|min:40|max:180', // Allow heart rate between 40 and 180
            'pulse_rate' => 'required|integer|min:40|max:180', // Allow pulse rate between 40 and 180
            'temperature' => 'required|numeric|between:30,45', // Allow temperature between 30 and 45 degrees Celsius
            'oxygen_saturation' => 'required|integer|between:0,100', // Allow O2 saturation between 0 and 100
            'pain_scale' => 'required|integer|between:0,10', // Pain scale should be between 0 and 10
            'respiratory_rate' => 'required|integer|min:10|max:60', // Allow respiratory rate between 0 and 50
            'respiratory_pattern' => 'required|string', // Assuming respiratory pattern is a string
            'weight' => 'required|numeric|min:0', // Weight should be a valid positive number
            'height' => 'required|numeric|min:0', // Height should be a valid positive number
            'bmi' => 'required|numeric|min:10|max:50', // Allow BMI between 10 and 50
            'vitals_note' => 'nullable|string', // Allowing this field to be optional
        ]);

        // Convert 24-hour time to 12-hour format with AM/PM
        if (!empty($validated['diagnosis_time'])) {
            $dateTime = \DateTime::createFromFormat('H:i', $validated['diagnosis_time']);
            if ($dateTime) {
                $validated['diagnosis_time'] = $dateTime->format('g:i A');
            }
        }

        // Convert dates to 'Y-m-d' format
        $validated['diagnosis_date'] = $request->input('diagnosis_date');

        // Initialize emergencyPatientId
        $emergencyPatientId = $request->input('emergency_patient_id');

        // Create Vital Signs
        VitalSigns::create([
            'diagnosis_date' => $validated['diagnosis_date'],
            'diagnosis_time' => $validated['diagnosis_time'],
            'B_P' => $validated['B_P'],
            'heart_rate' => $validated['heart_rate'],
            'pulse_rate' => $validated['pulse_rate'],
            'temperature' => $validated['temperature'],
            'oxygen_saturation' => $validated['oxygen_saturation'],
            'pain_scale' => $validated['pain_scale'],
            'respiratory_rate' => $validated['respiratory_rate'],
            'respiratory_pattern' => $validated['respiratory_pattern'],
            'weight' => $validated['weight'],
            'height' => $validated['height'],
            'bmi' => $validated['bmi'],
            'vitals_note' => $validated['vitals_note'],
            'emergency_patient_id' => $emergencyPatientId,
        ]);

        $request->session()->flash('success', 'Vital Signs was added successfully!');

        return redirect()->back();
    }


    public function vital_signs_show($vital_signs_id)
    {
        $vital_signs = VitalSigns::findOrFail($vital_signs_id);

        if (!$vital_signs) {
            return response()->json(['message' => 'Emergency Patient not found'], 404);
        }

        return view('blank6', compact('vital_signs'));
    }

    public function vital_signs_edit($vital_signs_id)
    {
        $vital_signs = VitalSigns::findOrFail($vital_signs_id);

        if (!$vital_signs) {
            return response()->json(['message' => 'Emergency Patient not found'], 404);
        }

        return view('blank7', compact('vital_signs'));
    }
}
