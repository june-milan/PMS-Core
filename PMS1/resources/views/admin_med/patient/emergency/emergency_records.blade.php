@extends('admin_med.layout.index')

@section('med_content')
    <div class="content-body">
        <div class="container-fluid">
            @include('admin_med.patient.emergency.register_button')

            <div class="row">
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class=" display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Last name</th>
                                            <th>First name</th>
                                            <th>Priority Level</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($emergency_patients as $emergency_patient)
                                            <tr>
                                                <td>{{ $emergency_patient->emergency_last_name }}</td>
                                                <td>{{ $emergency_patient->emergency_first_name }}</td>
                                                <td>{{ $emergency_patient->priority_level }}</span></td>
                                                <td>{{ $emergency_patient->status }}</span></td>
                                                <td>
                                                    <a href="javascript:void()" class="btn btn-square btn-primary mr-4"
                                                        data-toggle="tooltip" type="button" data-placement="top" title="View"
                                                        onclick="window.location='{{ route('patients.emergency_patient_show', ['emergency_patient_id' => $emergency_patient->emergency_patient_id]) }}'">
                                                        <i class="fa fa-eye color-muted"></i> </a>
                                                    <a href="javascript:void()" class="btn btn-square btn-secondary mr-4"
                                                        data-toggle="tooltip" type="button" data-placement="top" title="Edit"
                                                        onclick="window.location='{{ route('patients.emergency_patient_edit', ['emergency_patient_id' => $emergency_patient->emergency_patient_id]) }}'"><i
                                                            class="fa fa-pencil color-muted"></i> </a>
                                                    <a href="javascript:void()" class="btn btn-square btn-danger"
                                                        data-toggle="tooltip" type="button" data-placement="top" title="Close"><i
                                                            class="fa fa-close color-danger"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


        </div>
    </div>
@endsection
