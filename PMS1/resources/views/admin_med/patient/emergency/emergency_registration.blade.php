<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Register a Patient</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <form action="/emergency/store" class="step-form-horizontal" method="POST" onsubmit="">
                @csrf
                    <div>
                        <h4>Information</h4>
                        <section>
                            <div class="form-group">
                                <label for="regDateTime">Registration Date and Time</label>

                                <div class="reg-date-time">

                                    <div class="reg-date">
                                        <input type="date" id="regDate" name="emergency_date" class="form-control">
                                    @if ($errors->has('emergency_date'))
                                    @foreach ($errors->get('emergency_date') as $error)
                                        <span style="color:red;">{{ $error }}</span><br>
                                    @endforeach
                                    @endif
                                    </div>


                                    <div class="reg-time">
                                        <input type="time" id="regTime" name="emergency_time" class="form-control">
                                    @if ($errors->has('emergency_time'))
                                    @foreach ($errors->get('emergency_time') as $error)
                                        <span style="color:red;">{{ $error }}</span><br>
                                    @endforeach
                                    @endif
                                    </div>


                                </div>

                                <small class="time-label">Hour Minutes</small>
                            </div>

                            <div class="row form-material align-items-center">

                                {{-- <div class="col-lg-4 mb-2">
                                    <div class="form-group form-inline">
                                        <label for="unidentifiedCB" class="unidentified-label">Unidentified Patient</label>
                                        <input type="checkbox" id="unidentifiedCB" name="" class="unidentifiedCB">
                                    </div>
                                </div>

                                <div class="col-lg-4 mb-2">
                                    <button type="button" id="generateID-btn" class="generate-btn" >
                                        Generate Temporary ID
                                    </button>
                                </div>


                                <input type="hidden" name="patient_temporary_id">
                                @if ($errors->has('patient_temporary_id'))
                                    @foreach ($errors->get('patient_temporary_id') as $error)
                                        <span style="color:red;">{{ $error }}</span><br>
                                    @endforeach
                                @endif --}}

                                <!-- <div class="col-lg-4 mb-2">
                                    <div class="form-group form-inline">

                                        <input type="checkbox" id="unidentifiedCB" class="unidentifiedCB">
                                        <label for="unidentifiedCB" class="unidentified-label">Unidentified Patient</label>
                                    </div>
                                </div>

                                <div class="col-lg-4 mb-2">
                                    <button type="button" id="generateID-btn" class="generate-btn">
                                        Generate Temporary ID
                                    </button>
                                </div>

                                <input type="hidden" id="patientTemporaryID" name="patient_temporary_id">
                                @if ($errors->has('patient_temporary_id'))
                                    @foreach ($errors->get('patient_temporary_id') as $error)
                                        <span style="color:red;">{{ $error }}</span><br>
                                    @endforeach
                                @endif -->



                                <!-- WORKING CODE FOR UNIDENTIFIED -->
                                <div class="col-lg-4 mb-2">
                                    <div class="form-group form-inline">
                                        <!-- Move the input before the label for proper CSS targeting -->
                                        <input type="checkbox" id="unidentifiedCB" class="unidentifiedCB">
                                        <label for="unidentifiedCB" class="unidentified-label">Unidentified Patient</label>
                                    </div>
                                </div>

                                <div class="col-lg-4 mb-2">
                                    <button type="button" id="generateID-btn" class="generate-btn">
                                        Generate Temporary ID
                                    </button>
                                </div>

                                <div class="col-lg-4 mb-2">
                                    <span class="selection-message" id="sex-selection-message"></span>
                                </div>

                                <input type="hidden" id="patientTemporaryID" name="patient_temporary_id">
                                @if ($errors->has('patient_temporary_id'))
                                    @foreach ($errors->get('patient_temporary_id') as $error)
                                        <span style="color:red;">{{ $error }}</span><br>
                                    @endforeach
                                @endif
                            </div>
                            <!-- END of WORKING CODE FOR UNIDENTIFIED -->


                            <div class="row form-material">
                                <div class="col-lg-3 mb-2">
                                    <div class="form-group">
                                        <label class="text-label">Patient Name</label>
                                        <input type="text" name="emergency_first_name"
                                            class="form-control" placeholder="First Name">
                                    @if ($errors->has('emergency_first_name'))
                                    @foreach ($errors->get('emergency_first_name') as $error)
                                        <span style="color:red;">{{ $error }}</span><br>
                                    @endforeach
                                    @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-2">
                                    <div class="form-group">
                                        <label class="text-label">&#8203</label>
                                        <input type="text" name="emergency_middle_name"
                                            class="form-control" placeholder="Middle Name">
                                            @if ($errors->has('emergency_middle_name'))
                                            @foreach ($errors->get('emergency_middle_name') as $error)
                                                <span style="color:red;">{{ $error }}</span><br>
                                            @endforeach
                                            @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-2">
                                    <div class="form-group">
                                        <label class="text-label">&#8203</label>
                                        <input type="text" id="emergency_last_name" name="emergency_last_name"
                                            class="form-control" placeholder="Last Name">
                                            @if ($errors->has('emergency_last_name'))
                                            @foreach ($errors->get('emergency_last_name') as $error)
                                                <span style="color:red;">{{ $error }}</span><br>
                                            @endforeach
                                            @endif
                                    </div>
                                </div>

                                <div class="col-lg-3 mb-2">
                                    <div class="form-group">
                                        <label class="text-label">&#8203</label>
                                        <input type="text" name="emergency_extension"
                                            class="form-control" placeholder="Ext. Name">
                                            @if ($errors->has('emergency_extension'))
                                            @foreach ($errors->get('emergency_extension') as $error)
                                                <span style="color:red;">{{ $error }}</span><br>
                                            @endforeach
                                            @endif
                                    </div>
                                </div>


                                <div class="col-lg-3 mb-4">
                                    <label class="text-label">Date of Birth</label>
                                    <input type="date" class="form-control" name="emergency_dob" id="birthOfDate" required>
                                    @if ($errors->has('emergency_dob'))
                                        @foreach ($errors->get('emergency_dob') as $error)
                                            <span style="color:red;">{{ $error }}</span><br>
                                        @endforeach
                                    @endif
                                </div>


                                <div class="col-lg-3 mb-4">
                                    <div class="form-group">
                                        <label class="text-label">Sex</label>
                                        <select class="custom-select form-control" name="emergency_sex" aria-label="Sex" required>
                                            <option value="">Please Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        @if ($errors->has('emergency_sex'))
                                            @foreach ($errors->get('emergency_sex') as $error)
                                                <span style="color:red;">{{ $error }}</span><br>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>



                                <div class="col-lg-3 mb-4">
                                    <div class="form-group">
                                        <label class="text-label">Age</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="patientAge" name="emergency_age" placeholder="Age" readonly>
                                            @if ($errors->has('emergency_age'))
                                                @foreach ($errors->get('emergency_age') as $error)
                                                    <span style="color:red;">{{ $error }}</span><br>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>




                                <div class="col-lg-3 mb-4">
                                    <div class="form-group">
                                        <label class="text-label">Priority Level <span
                                                class="form-required text-danger">*</span></label>
                                        <select class="custom-select form-control"
                                            id="" name="priority_level"
                                            data-component="dropdown" required=""
                                            aria-label="Priority Level">
                                            <option value="">Please Select</option>
                                            <option value="1 - Resuscitation">1 - Resuscitation</option>
                                            <option value="2 - Emergent">2 - Emergent </option>
                                            <option value="3 - Urgent">3 - Urgent</option>
                                            <option value="4 - Less Urgent">4 - Less Urgent</option>
                                            <option value="5 - Non-Urgent">5 - Non-Urgent</option>
                                        </select>
                                        @if ($errors->has('priority_level'))
                                            @foreach ($errors->get('priority_level') as $error)
                                                <span style="color:red;">{{ $error }}</span><br>
                                            @endforeach
                                            @endif
                                    </div>
                                </div>


                                <div class="col-lg-3 mb-5">
                                    <h4 style="margin-bottom: -15px;"> Vital Signs </h4>
                                </div>
                                <div class="w-100"></div>

                                <div class="col-lg-3 mb-3">
                                    <div class="form-group">
                                        <label class="text-label">Blood Pressure
                                            <span class="form-required text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="bloodPressure" name="B_P" placeholder="BP" oninput="validateBloodPressure()" required>
                                            @if ($errors->has('B_P'))
                                                @foreach ($errors->get('B_P') as $error)
                                                    <span style="color:red;">{{ $error }}</span><br>
                                                @endforeach
                                            @endif
                                        </div>
                                        <span id="bpError" style="color:red; display:none;">Please enter a valid format (eg., 100/80).</span>
                                    </div>
                                </div>

                                <div class="col-lg-3 mb-3">
                                    <div class="form-group">
                                        <label class="text-label">Temperature
                                            <span class="form-required text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="temperature" name="temperature" placeholder="Temp (C)" oninput="validateTemperature()">
                                            @if ($errors->has('temperature'))
                                                @foreach ($errors->get('temperature') as $error)
                                                    <span style="color:red;">{{ $error }}</span><br>
                                                @endforeach
                                            @endif
                                        </div>
                                        <span id="temperatureError" style="color:red; display:none;">Please enter a valid format (e.g., 20-45).</span>
                                    </div>
                                </div>

                                <div class="col-lg-3 mb-3">
                                    <div class="form-group">
                                        <label class="text-label">Heart Rate/Minute
                                            <span class="form-required text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="heartRate" name="heart_rate" placeholder="Heart Rate" oninput="validateHeartRate()">
                                            @if ($errors->has('heart_rate'))
                                                @foreach ($errors->get('heart_rate') as $error)
                                                    <span style="color:red;">{{ $error }}</span><br>
                                                @endforeach
                                            @endif
                                        </div>
                                        <span id="heartRateError" style="color:red; display:none;">Please enter a valid heart rate (e.g., 60-100 BPM).</span>
                                    </div>
                                </div>
                                <div class="w-100"></div>

                                <div class="col-lg-3 mb-3">
                                    <div class="form-group">
                                        <label class="text-label">Pulse Rate/Minute
                                            <span class="form-required text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="pulseRate" name="pulse_rate" placeholder="Pulse Rate" oninput="validatePulseRate()">
                                            @if ($errors->has('pulse_rate'))
                                                @foreach ($errors->get('pulse_rate') as $error)
                                                    <span style="color:red;">{{ $error }}</span><br>
                                                @endforeach
                                            @endif
                                        </div>
                                        <span id="pulseRateError" style="color:red; display:none;">Please enter a valid pulse rate (e.g., 60-100 BPM).</span>
                                    </div>
                                </div>

                                <div class="col-lg-3 mb-3">
                                    <div class="form-group">
                                        <label class="text-label">Respiration Rate/Minute
                                            <span class="form-required text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="respirationRate" name="respiratory_rate" placeholder="Respiration Rate" oninput="validateRespirationRate()">
                                            @if ($errors->has('respiratory_rate'))
                                                @foreach ($errors->get('respiratory_rate') as $error)
                                                    <span style="color:red;">{{ $error }}</span><br>
                                                @endforeach
                                            @endif
                                        </div>
                                        <span id="respirationRateError" style="color:red; display:none;">Please enter a valid respiration rate (e.g., 12-20 BPM).</span>
                                    </div>
                                </div>

                                <div class="col-lg-3 mb-3">
                                    <div class="form-group">
                                        <label class="text-label">Note</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="note" name="vitals_note" placeholder="Note:" >
                                            @if ($errors->has('vitals_note'))
                                                @foreach ($errors->get('vitals_note') as $error)
                                                    <span style="color:red;">{{ $error }}</span><br>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </section>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn sweet-confirm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="toastr-success-top-right">Save changes</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>

{{--
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('generateID-btn').addEventListener('click', function() {
            var id = 'TEMP-' + ('000000' + Math.floor(Math.random() * 1000000)).slice(-6);
            document.getElementById('patientTemporaryID').value = id;
        });
    });
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('generateID-btn').addEventListener('click', function() {
            fetch('/generate-unique-id')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('patientTemporaryID').value = data.id;
                    document.getElementById('emergency_last_name').value = data.id; // Set the value to the last name input
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('generateID-btn').addEventListener('click', function() {
            fetch('/generate-unique-id')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('patientTemporaryID').value = data.id;
                    // Check the checkbox when the button is clicked
                    document.getElementById('unidentifiedCB').checked = true;
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script> --}}
