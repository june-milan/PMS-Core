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
                            <form action="{{ route('patients.update', ['patient_id' => $patient->patient_id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="patientInfo1" role="tabpanel">
                                    <div class="pt-4">
                                        <h4 class="card-title mb-4">General Information</h4>
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <div class="col-lg-10">
                                                    <dl>
                                                        <dt class="mb-2">Age:</dt>
                                                        <dd class="mb-4">
                                                            <input type="text" class="form-control" name="dob"
                                                             value={{ $patient->dob }} id="mdate">
                                                            {{-- The value="" should have the Date of Birth inputted for the patient --}}
                                                        </dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-10">
                                                    <dl>
                                                        <dt class="mb-2">Nationality</dt>
                                                        <dd class="mb-4">
                                                            <input type="text" class="form-control" name="nationality"
                                                                value={{ $patient->nationality }} id="nationality">
                                                        </dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-10">
                                                    <dl>
                                                        <dt class="mb-2">Religion</dt>
                                                        <dd class="mb-4">
                                                            <input type="text" class="form-control" name="religion"
                                                                value={{ $patient->religion }} id="religion">
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="col-lg-10">
                                                    <dl>
                                                        <dt class="mb-2">Sex:</dt>
                                                        <dd class="mb-4">
                                                            <select class="custom-select form-control" id="sex"
                                                                name="sex" data-component="dropdown" required
                                                                aria-label="Sex">
                                                                <option value="" {{ $patient->sex == "" ? 'selected' : '' }}>Please Select</option>
                                                                <option value="Male" {{ $patient->sex == "Male" ? 'selected' : '' }}>Male</option>
                                                                <option value="Female" {{ $patient->sex == "Female" ? 'selected' : '' }}>Female</option>
                                                                <option value="Intersex" {{ $patient->sex == "Intersex" ? 'selected' : '' }}>Intersex</option>
                                                                <option value="Non-Binary" {{ $patient->sex == "Non-Binary" ? 'selected' : '' }}>Non-Binary</option>
                                                                <option value="Transgender Female (MTF)" {{ $patient->sex == "Transgender Female (MTF)" ? 'selected' : '' }}>Transgender
                                                                    Female (MTF)
                                                                </option>
                                                                <option value="Transgender Male (FTM)" {{ $patient->sex == "Transgender Male (FTM)" ? 'selected' : '' }}>Transgender
                                                                    Male (FTM)
                                                                </option>
                                                                <option value="Prefer Not to Say" {{ $patient->sex == "Prefer Not to Say" ? 'selected' : '' }}>Prefer Not to Say
                                                                </option>
                                                            </select>
                                                        </dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-10">
                                                    <dl>
                                                        <dt class="mb-2">Full Address:</dt>
                                                        <dd>
                                                            {{-- <input type="text" class="form-control" name="street_address"
                                                                value={{ $patient->street_address }} id="fullAddress"> --}}
                                                            <textarea type="text" name="street_address" class="form-control" rows="2"
                                                            id="allergies">{{ $patient->street_address }}</textarea>
                                                        </dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-10">
                                                    <dl>
                                                        <dt class="mb-2">Phone Number:</dt>
                                                        <dd>
                                                            <input type="tel" class="form-control" name="phone"
                                                                value={{ $patient->phone }} id="phoneNumber">
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="col-lg-10">
                                                    <dl>
                                                        <dt class="mb-2">Civil Status:</dt>
                                                        <dd class="mb-4">
                                                            <select class="custom-select form-control" id=""
                                                                name="civil_status" data-component="dropdown" required=""
                                                                aria-label="Civil Status">
                                                                <option value="" {{ $patient->civil_status == "" ? 'selected' : '' }}>Please Select</option>
                                                                <option value="Single" {{ $patient->civil_status == "Single" ? 'selected' : '' }}>Single</option>
                                                                <option value="Married" {{ $patient->civil_status == "Married" ? 'selected' : '' }}>Married</option>
                                                                <option value="Divorced" {{ $patient->civil_status == "Divorced" ? 'selected' : '' }}>Divorced</option>
                                                                <option value="Legally separated" {{ $patient->civil_status == "Legally separated" ? 'selected' : '' }}>Legally separated
                                                                </option>
                                                                <option value="Widowed" {{ $patient->civil_status == "Widowed" ? 'selected' : '' }}>Widowed</option>
                                                                <option value="Other" {{ $patient->civil_status == "Other" ? 'selected' : '' }}>Other</option>
                                                            </select>
                                                        </dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-10">
                                                    <dl>
                                                        <dt class="mb-2">Employment:</dt>
                                                        <dd>
                                                            <select class="custom-select form-control" id=""
                                                                name="employment" data-component="dropdown"
                                                                required="" aria-label="Employment">
                                                                <option value="" {{ $patient->employment == "" ? 'selected' : '' }}>Please Select</option>
                                                                <option value="Employed" {{ $patient->employment == "Employed" ? 'selected' : '' }}>Employed</option>
                                                                <option value="Self-Employed" {{ $patient->employment == "Self-Employed" ? 'selected' : '' }}>Self-Employed
                                                                </option>
                                                                <option value="Unemployed" {{ $patient->employment == "Unemployed" ? 'selected' : '' }}>Unemployed</option>
                                                                <option value="Retired" {{ $patient->employment == "Retired" ? 'selected' : '' }}>Retired</option>
                                                                <option value="Student" {{ $patient->employment == "Student" ? 'selected' : '' }}>Student</option>
                                                                <option value="Other" {{ $patient->employment == "Other" ? 'selected' : '' }}>Other</option>
                                                            </select>
                                                        </dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-10">
                                                    <dl>
                                                        <dt class="mb-2">Email:</dt>
                                                        <dd>
                                                            <input type="email" class="form-control" name="email"
                                                                value={{ $patient->email }} id="email">
                                                        </dd>
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
                                                <div class="col-lg-10">
                                                    <dl>
                                                        <dt class="mb-2">Complaints:</dt>
                                                        <dd class="mb-4">{{ $patient->health_histories->reason_registration }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-10">
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
                                                        {{-- Will be updates after charting --}}
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="col-lg-10">
                                                    <dl>
                                                        <dt class="mb-2">Allergies:</dt>
                                                        <dd class="mb-4">
                                                            <textarea type="text" name="food_allergy_note" class="form-control" rows="2"
                                                                id="allergies">{{ $patient->health_histories->food_allergy_note }}</textarea>
                                                        </dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-10">
                                                    <dl>
                                                        <dt class="mb-2">Chronic/Other Illness:</dt>
                                                        <dd class="mb-4">
                                                            <textarea type="text" name="condition_note" class="form-control" rows="2"
                                                                value="[Chronic/Other Illness1], [Chronic/Other Illness2]" id="coroIllness">{{ $patient->health_histories->condition_note }}</textarea>

                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="col-lg-10">
                                                    <dl>
                                                        <dt class="mb-2">Surgeries Done:</dt>
                                                        <dd class="mb-4">
                                                            <textarea type="text" name="history_note" class="form-control" rows="2"
                                                                value="[Surgeries Done1], [Surgeries Done2]" id="surgeries">{{ $patient->health_histories->history_note }}</textarea>
                                                        </dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-10">
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
                                        <p>
                                            <textarea type="text" name="surgeries" class="form-control" rows="2"
                                                value="[Something Goes Here]" id="medRecord" placeholder="Something Goes Here..."></textarea>
                                        </p>
                                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt
                                            tofu
                                            stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                        </p>
                                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt
                                            tofu
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
                            <div class="container d-flex justify-content-end">
                                <button type="button" class="btn btn-square btn-outline-light btn-lg mx-3" aria-label="Cancel Changes"
                                onclick="window.history.back();">{{ __('Cancel') }}</button>
                                <button type="submit" class="btn btn-square btn-outline-primary btn-lg" aria-label="Save Changes"
                                data-target="">{{ __('Save') }}</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
