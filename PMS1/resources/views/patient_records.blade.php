<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syncore Medical Hospital</title>
    <link rel="icon" href="/build/assets/syncore.png">

    <link rel="stylesheet" href="{{ asset('/css/patient_records.css') }}">

</head>

<body>
<div class="Patient-Records">
    <table class="Patient-Records-Table" border="1">
        <form action="/logout" method="POST">
            @csrf
            <button class="block py-2 pr-4 pl-3">Logout</button>
        </form>
        <tr>
            <th>
                <div class="Patient-Name-Header">Patient Name</div>
            </th>
            <th class="Registration-Date">
                <div class="Registration-Date-Header">Registration Date</div>
            </th>
            <th class="Patient-Status">
                <div class="Patient-Status-Header">Status</div>
            </th>
            <th class="Patient-Action">Actions</th>
        </tr>


{{-- >>>>>>> Stashed changes --}}
        @foreach($patients as $patient)
        <tr>
            <td class="Patient-Name-Data">{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</td>
            <td class="Registration-Date-Data">{{ $patient->created_at->format('m/d/Y') }}</td>
            <td class="Status-Data">{{ $patient->patient_type }}</td>
            <td class="Patient-Action">
                <!-- Add actions here, e.g., view, edit, delete -->
                <a class="patient-view" href="{{ route('patients.show', ['patient_id' => $patient->patient_id]) }}">View</a>
                <a class="patient-edit" href="">Edit</>
                <a class="delete" href="">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="add-patient">

        <a href="/create">
            <button class="add-patient-button">Add New Patient</button>
        </a>
{{-- >>>>>>> Stashed changes --}}
    </div>
</div>

</body>

</html>
