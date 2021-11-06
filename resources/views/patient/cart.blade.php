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
        <h1>Hospital</h1>
        <a href="{{ route('logout') }}" class="mr-5">Logout</a>
    </nav>
    <hr>
    <div class="container">
        <div style="border-radius: 50px;
    box-shadow:  -9px 9px 18px #e6e6e6,
    9px -9px 18px #ffffff;
    padding: 50px; display: flex; justify-content:space-between">
            <div>
                <h2 class="mb-5">{{ $user->first_name . ' ' . $user->last_name }}</h2>
                <p><b>DoB: </b>{{ $user->dob }}</p>
                <p><b>Phone Number: </b>{{ $user->phone_number }}</p>
                <p><b>Passport Number: </b>{{ $user->passport_number }}</p>
                <p><b>Address: </b>{{ $user->address }}</p>
            </div>
            <div>
                <h1 class="text-center">Recent</h1>
                <ul>
                    @foreach ($recents as $recent)
                        <li><a
                                href="{{ route('patient-show-history', ['title' => $recent->title, 'id' => $recent->id]) }}">{{ $recent->title }}</a><span>
                                - {{ $recent->created_at }}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div style="display: flex; flex-wrap:wrap">
            @foreach ($doctors as $doctor)
                <a href="{{ route('patient-doctor', ['title' => $doctor->category->title]) }}"
                    class="btn btn-secondary p-3 m-3">{{ $doctor->category->title }}</a>
            @endforeach
        </div>
    </div>
</body>

</html>
