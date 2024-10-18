@extends('admin_med.layout.index')

@section('med_content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="">Patient Details</h4>
                        </div>
                        <div class="card-body">
                            <!-- Nav tabs -->
                            {{-- <div class="custom-tab-1"> --}}
                            <div class="media">
                                <div class="media-left">
                                    <a href="#"><img class="media-object mr-3"
                                            src="{{ asset('admin_medcss/theme/./images/avatar/4.png') }} "
                                            alt="..."></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading text-primary">{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }} {{ $patient->extension }}</h4>
                                    <p>&#8203</p>
                                </div>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#patientInfo1">Patient
                                        Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#medRecord1">Medical Record</a>
                                </li>
                                {{-- <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#contact1">Contact</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#message1">Message</a>
                                    </li> --}}
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="patientInfo1" role="tabpanel">
                                    <div class="pt-4">
                                        <h4 class="card-title mb-4">General Information</h4>
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <div class="col-lg-12">
                                                    <dl>
                                                        <dt class="mb-2">Age:</dt>
                                                        <dd class="mb-4">{{ $patient->dob }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-12">
                                                    <dl>
                                                        <dt class="mb-2">Nationality</dt>
                                                        <dd class="mb-4">{{ $patient->nationality }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-12">
                                                    <dl>
                                                        <dt class="mb-2">Religion</dt>
                                                        <dd class="mb-4">{{ $patient->religion }}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="col-lg-12">
                                                    <dl>
                                                        <dt class="mb-2">Sex:</dt>
                                                        <dd class="mb-4">{{ $patient->sex }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-12">
                                                    <dl>
                                                        <dt class="mb-2">Full Address:</dt>
                                                        <dd>{{ $patient->street_address }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-12">
                                                    <dl>
                                                        <dt class="mb-2">Phone Number:</dt>
                                                        <dd>{{ $patient->phone }}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="col-lg-12">
                                                    <dl>
                                                        <dt class="mb-2">Civil Status:</dt>
                                                        <dd class="mb-4">{{ $patient->civil_status }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-12">
                                                    <dl>
                                                        <dt class="mb-2">Employment:</dt>
                                                        <dd>{{ $patient->employment }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-12">
                                                    <dl>
                                                        <dt class="mb-2">Email:</dt>
                                                        <dd>{{ $patient->email }}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                        <h4 class="card-title mb-4">Medical Data</h4>
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <div class="col-lg-12">
                                                    <dl>
                                                        <dt class="mb-2">Complaints:</dt>
                                                        <dd class="mb-4">{{ $patient->health_histories->reason_registration }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-12">
                                                    <dl>
                                                        <dt class="mb-2">Diagnosis:</dt>
                                                        <dd class="mb-4">
                                                            @if ($patient->health_histories)
                                                                <?php
                                                                $familyHistoryArray = json_decode($patient->health_histories->family_history, true);
                                                                $familyHistoryString = implode(', ', $familyHistoryArray);
                                                                ?>
                                                                {{ $familyHistoryString }}
                                                            @else
                                                                <p>No family history available.</p>
                                                            @endif
                                                        </dd>
                                                        {{-- Should be null --}}
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="col-lg-12">
                                                    <dl>
                                                        <dt class="mb-2">Allergies:</dt>
                                                        <dd class="mb-4">{{ $patient->health_histories->food_allergy_note }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-12">
                                                    <dl>
                                                        <dt class="mb-2">Chronic/Other Illness:</dt>
                                                        <dd>{{ $patient->health_histories->condition_note }}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="col-lg-12">
                                                    <dl>
                                                        <dt class="mb-2">Surgeries Done:</dt>
                                                        <dd class="mb-4">{{ $patient->health_histories->history_note }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-12">
                                                    <dl>
                                                        <dt class="mb-2">Vices:</dt>
                                                        <dd>
                                                            @php
                                                                $vices = [];

                                                                // Check for smoking
                                                                if ($patient->health_histories->patient_smoke === 'Yes') {
                                                                    $vices[] = 'Smoking';
                                                                }

                                                                 // Check for drinking
                                                                 if ($patient->health_histories->patient_alcohol === 'Yes') {
                                                                    $vices[] = 'Drinking';
                                                                }

                                                                 // Combine vices or show default message
                                                                 $vicesDisplay = !empty($vices) ? implode(' and ', $vices) : 'No vices';
                                                            @endphp

                                                            {{ $vicesDisplay }}
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="medRecord1">
                                    <div class="pt-4">
                                        <h4>Medical Record</h4>
                                        <p>Something Goes Here.
                                        </p>
                                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu
                                            stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                        </p>
                                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu
                                            stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                        </p>
                                    </div>
                                </div>
                                {{-- <div class="tab-pane fade" id="contact1">
                                        <div class="pt-4">
                                            <h4>This is contact title</h4>
                                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                                            </p>
                                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="message1">
                                        <div class="pt-4">
                                            <h4>This is message title</h4>
                                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                            </p>
                                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                            </p>
                                        </div>
                                    </div> --}}
                            </div>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
