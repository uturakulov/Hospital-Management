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
    <a href="{{ route('patient-home') }}" class="btn btn-secondary ml-5 mt-3" style="width: 10%">&#8592; Back</a>
    <div class="container">
        @if (count($histories) == 0)
            <h1 class="alert alert-danger text-center">No history is available :(</h1>
        @else
            @foreach ($histories as $history)
                <div style="border-radius: 50px;
    box-shadow:  -9px 9px 18px #e6e6e6,
    9px -9px 18px #ffffff;
    padding: 30px; margin-bottom:30px">
                    <h2 class="mb-5">{{ $history->first_name . ' ' . $history->last_name }}</h2>
                    <p><b>Title: </b>{{ $history->title }}</p>
                    <p><b>Comment:
                        </b>{!! strlen($history->comment) > 50 ? substr($history->comment, 0, 50) . '...' : $history->comment !!}
                    </p>
                    <p><b>Created: </b>{{ $history->created_at }}</p>
                    <a href="{{ route('patient-show-history', ['title' => $history->title, 'id' => $history->id]) }}"
                        class="btn btn-success"><i class="fa fa-eye"></i></a>
                </div>
            @endforeach
        @endif
    </div>
</body>

</html>
