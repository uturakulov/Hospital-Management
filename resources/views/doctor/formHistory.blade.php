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
    <a href="{{ route('doctor-home') }}" class="btn btn-secondary ml-5 mt-3" style="width: 10%">&#8592; Back</a>
    @if ($page == 'add')
        <h3 class="text-center mt-5">Add New History</h3>
        <form action="{{ route('add-history') }}" method="POST" style="width: 100%;
    max-width: 630px;
    padding: 15px;
    margin: 0 auto">
            {{ csrf_field() }}
            <select name="patient_id" class="form-control mb-3">
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->first_name . ' ' . $patient->last_name }}
                    </option>
                @endforeach
            </select>
            <textarea name="comment" cols="30" rows="10" class="form-control mb-3 ckeditor"></textarea>
            <input type="hidden" name="doctor_id" value="{{ $user->id }}">
            <button type="submit" class="btn btn-success w-25">Add</button>
        </form>

    @else
        <h3 class="text-center mt-5">Edit History</h3>
        <form action="{{ route('update-history', ['id' => $history->id]) }}" method="POST" style="width: 100%;
    max-width: 630px;
    padding: 15px;
    margin: 0 auto">
            {{ csrf_field() }}
            <select name="patient_id" class="form-control mb-3">
                <option value="{{ $history->patient->id }}" selected>
                    {{ $history->patient->first_name . ' ' . $history->patient->last_name }}</option>
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->first_name . ' ' . $patient->last_name }}
                    </option>
                @endforeach
            </select>
            <textarea name="comment" cols="30" rows="10"
                class="form-control mb-3 ckeditor">{{ $history->comment }}</textarea>
            <button type="submit" class="btn btn-success w-25">Add</button>
        </form>
    @endif

</body>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>

</html>
