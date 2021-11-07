<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>
    <nav class="d-flex justify-content-between align-items-center m-3">
        <h1>Hospital | Admin</h1>
        <div>
            <a href="{{ route('admin-doctor') }}" class="mr-5">Doctors</a>
            <a href="{{ route('admin-patients') }}" class="mr-5">Patients</a>
            <a href="{{ route('logout') }}" class="mr-5">Logout</a>
        </div>
    </nav>
    <hr>
    @if ($page == 'create')
        <form action="{{ route('admin-store-patient') }}" method="POST" style="width: 100%;
        max-width: 530px;
        padding: 15px;
        margin: 0 auto">
            {{ csrf_field() }}
            <h1 class="h3 mb-5 font-weight-normal text-center">Add Patient</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="list-style: none">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="d-flex justify-content-between">
                <div>
                    <label for="inputFName">First Name</label>
                    <input type="text" name="first_name" id="inputFName" class="form-control mb-3">
                    <label for="inputLName">Last Name</label>
                    <input type="text" name="last_name" id="inputLName" class="form-control mb-3">
                    <label for="inputDob">Date of Birth</label>
                    <input type="date" name="dob" id="inputDob" class="form-control mb-3">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" id="inputPassword" class="form-control mb-3">
                </div>
                <div>
                    <label>Passport Number</label>
                    <input type="text" name="passport_number" id="inputPassword" class="form-control mb-3">
                    <label>Address</label>
                    <input type="text" name="address" id="inputPassword" class="form-control mb-3">
                    <label for="inputEmail">Email address</label>
                    <input type="email" name="email" id="inputEmail" class="form-control mb-3" autofocus="">
                    <label for="inputPassword">Password</label>
                    <input type="text" name="password" id="inputPassword" class="form-control mb-3">
                </div>
            </div>
            <label for="inputLName">Polyclinic</label>
            <select name="polyclinic_id" class="form-control mb-3">
                @foreach ($polyclinics as $polyclinic)
                    <option value="{{ $polyclinic->id }}">{{ $polyclinic->title }}</option>
                @endforeach
            </select>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
        </form>
    @else
        <form action="{{ route('admin-update-patient', ['id' => $patient->id]) }}" method="POST" style="width: 100%;
    max-width: 530px;
    padding: 15px;
    margin: 0 auto">
            {{ csrf_field() }}
            <h1 class="h3 mb-5 font-weight-normal text-center">Update Patient</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="list-style: none">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="d-flex justify-content-between">
                <div>
                    <label for="inputFName">First Name</label>
                    <input type="text" name="first_name" id="inputFName" class="form-control mb-3"
                        value="{{ $patient->first_name }}">
                    <label for="inputLName">Last Name</label>
                    <input type="text" name="last_name" id="inputLName" class="form-control mb-3"
                        value="{{ $patient->last_name }}">
                    <label for="inputDob">Date of Birth</label>
                    <input type="date" name="dob" id="inputDob" class="form-control mb-3"
                        value="{{ date('Y-m-d', strtotime($patient->dob)) }}">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" id="inputPassword" class="form-control mb-3"
                        value="{{ $patient->phone_number }}">
                </div>
                <div>
                    <label>Passport Number</label>
                    <input type="text" name="passport_number" id="inputPassword" class="form-control mb-3"
                        value="{{ $patient->passport_number }}">
                    <label>Address</label>
                    <input type="text" name="address" id="inputPassword" class="form-control mb-3"
                        value="{{ $patient->address }}">
                    <label for="inputEmail">Email address</label>
                    <input type="email" name="email" id="inputEmail" class="form-control mb-3" autofocus=""
                        value="{{ $patient->email }}">
                    <label for="inputPassword">Password</label>
                    <input type="text" name="password" id="inputPassword" class="form-control mb-3">
                </div>
            </div>
            <label for="inputLName">Polyclinic</label>
            <select name="polyclinic_id" class="form-control mb-3">
                <option value="{{ $patient->polyclinic->id }}">{{ $patient->polyclinic->title ?? 'NA' }}</option>
                @foreach ($polyclinics as $polyclinic)
                    <option value="{{ $polyclinic->id }}">{{ $polyclinic->title }}</option>
                @endforeach
            </select>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
        </form>
    @endif

</body>

</html>
