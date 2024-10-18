

@extends('admin_med.layout.index')

@section('med_content')
    <div class="content-body">
        <div class="container-fluid">
            @include('components.messages')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="">Patient Details</h4>
                        </div>
                        <div class="card-body">

                            <div class="media">
                                <div class="media-left">
                                    <a href="#"><img class="media-object mr-3"
                                            src="{{ asset('admin_medcss/theme/./images/avatar/4.png') }} "
                                            alt="..."></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading text-primary">{{ $emergency_patient->emergency_first_name }} {{ $emergency_patient->emergency_middle_name }} {{ $emergency_patient->emergency_last_name }} {{ $emergency_patient->emergency_extension }}</h4>
                                    <p>&#8203</p>
                                </div>
                            </div>

                            <ul class="nav nav-tabs">

                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#patientInfo1">Patient Information</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#vitalSigns">Vital Signs</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#diagnosisAndProcedure">Diagnosis and Procedure</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#doctorsOrder">Doctor's Order</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#nursesNotes">Nurse's Notes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#intakeAndOutput">Intake & Output</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#medicationLog">Medication Log</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#ivFluid">IV Fluid</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#charges">Charges</a>
                                </li>



                            </ul>

                            <div class="tab-content">

                                <!-- Patient Info Tab -->
                                <div class="tab-pane fade show active" id="patientInfo1" role="tabpanel">
                                    <div class="pt-4">
                                        @include('admin_med.patient.chart_tabs.patient_info')
                                    </div>
                                </div>
                                 <!-- End of Patient Info Tab -->

                                <!-- Vital Signs Tab -->
                                <div class="tab-pane fade" id="vitalSigns">
                                    @include('blank4')
                                </div>
                                <!-- End of Vital Signs Tab -->

                                <div class="tab-pane fade" id="diagnosisAndProcedure">
                                    <div class="pt-4">


                                    </div>

                                </div>



                                <div class="tab-pane fade" id="doctorsOrder">
                                    <div class="pt-4">


                                    </div>

                                </div>

                                <div class="tab-pane fade" id="nursesNotes">
                                    <div class="pt-4">


                                    </div>

                                </div>

                                <div class="tab-pane fade" id="intakeAndOutput">
                                    <div class="pt-4">


                                    </div>

                                </div>

                                <div class="tab-pane fade" id="medicationLog">
                                    <div class="pt-4">


                                    </div>

                                </div>

                                <div class="tab-pane fade" id="ivFluid">
                                    <div class="pt-4">


                                    </div>

                                </div>
                                <div class="tab-pane fade" id="charges">
                                    <div class="pt-4">


                                    </div>

                                </div>
                            <!--End of Testing Tab -->

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
