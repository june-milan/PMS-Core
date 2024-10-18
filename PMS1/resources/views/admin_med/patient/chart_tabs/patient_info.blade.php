<h4 class="card-title mb-4">General Information</h4>

<div class="row">
    <div class="col-xl-4">
        <div class="col-lg-12">
            <dl>
                <dt class="mb-2">Date of Birth:</dt>
                <dd class="mb-4">{{ \Carbon\Carbon::parse($emergency_patient->emergency_dob)->format('m/d/Y') }}</dd>
            </dl>
        </div>
        <div class="col-lg-12">
            <dl>
                <dt class="mb-2">Nationality</dt>
                <dd class="mb-4">{{ $emergency_patient->emergency_information->ep_nationality ?? 'N/A'}}</dd>
            </dl>
        </div>
        <div class="col-lg-12">
            <dl>
                <dt class="mb-2">Religion</dt>
                <dd class="mb-4">{{ $emergency_patient->emergency_information->ep_religion ?? 'N/A'}}</dd>
            </dl>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="col-lg-12">
            <dl>
                <dt class="mb-2">Sex:</dt>
                <dd class="mb-4">{{ $emergency_patient->emergency_sex }}</dd>
            </dl>
        </div>
        <div class="col-lg-12">
            <dl>
                <dt class="mb-2">Full Address:</dt>
                <dd>{{ $emergency_patient->emergency_information->ep_full_address ?? 'N/A'}}</dd>
            </dl>
        </div>
        <div class="col-lg-12">
            <dl>
                <dt class="mb-2">Phone Number:</dt>
                <dd>{{ $emergency_patient->emergency_information->ep_phone ?? 'N/A'}}</dd>
            </dl>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="col-lg-12">
            <dl>
                <dt class="mb-2">Civil Status:</dt>
                <dd class="mb-4">{{ $emergency_patient->emergency_information->ep_civil_status ?? 'N/A'}}</dd>
            </dl>
        </div>
        <div class="col-lg-12">
            <dl>
                <dt class="mb-2">Employment:</dt>
                <dd>{{ $emergency_patient->emergency_information->ep_employment ?? 'N/A'}}</dd>
            </dl>
        </div>
        <div class="col-lg-12">
            <dl>
                <dt class="mb-2">Email:</dt>
                <dd>{{ $emergency_patient->emergency_information->ep_email ?? 'N/A'}}</dd>
            </dl>
        </div>
    </div>
</div>
<div class="col-12">
    <hr>
</div>



<div class="update-button">
    <button type="button" class="btn btn-square btn-outline-primary btn-lg" aria-label="Update"
        onclick="window.location='{{ route('patients.emergency_patient_edit', ['emergency_patient_id' => $emergency_patient->emergency_patient_id]) }}'">Update
    </button>
</div>

<!-- <div>
    <button type="button" id="updateButton" class="btn btn-square btn-outline-primary btn-lg"
    data-toggle="modal" data-target="#emergencyEdit">{{ __('Update Information') }}</button>

    {{-- @include('admin_med.patient.emergency.emergency_edit') --}}
</div> -->





