<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <nav class="d-flex justify-content-between align-items-center m-3">
        <h1>Hospital</h1>
        <a href="{{ route('logout') }}" class="mr-5">Logout</a>
    </nav>
    <hr>
    <a href="{{ route('doctor-home') }}" class="btn btn-secondary ml-5 mt-3 mb-3" style="width: 10%">&#8592; Back</a>
    <div class="container">
        <div style="border-radius: 50px;
        box-shadow:  -9px 9px 18px #e6e6e6,
        9px -9px 18px #ffffff;
        padding: 50px">
            <p><b>Patient: </b>{{ $history->patient->first_name ?? 'NA' }}
                {{ $history->patient->last_name ?? 'NA' }}</p>
            <p><b>Doctor: </b>{{ $history->doctor->first_name ?? 'NA' }} {{ $history->doctor->last_name ?? 'NA' }}
            </p>
            <p><b>Comment: </b>{!! $history->comment !!}</p>
            <p><b>Date: </b>{{ $history->created_at }}</p>
        </div>
    </div>
</body>

</html>
