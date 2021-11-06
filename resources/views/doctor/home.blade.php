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
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <h1>{{ $user->category->title ?? 'NA' }}</h1>
        <h3>{{ $user->first_name . ' ' . $user->last_name }}</h3>
        <a href="{{ route('doctor-add-history') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i></a>

        <table class="table table-bordered table-hover">
            <tr>
                <th>Patient First Name</th>
                <th>Patient Last Name</th>
                <th>Comment</th>
                <th>Created</th>
            </tr>
            @foreach ($histories as $history)
                <tr>
                    <td>{{ $history->patient->first_name ?? 'NA' }}</td>
                    <td>{{ $history->patient->last_name ?? 'NA' }}</td>
                    <td>{!! strlen($history->comment) > 50 ? substr($history->comment, 0, 50) . '...' : $history->comment !!}
                    </td>
                    <td>{{ $history->created_at }}</td>
                    <td>
                        <a href="{{ route('show-history', ['id' => $history->id]) }}" class="btn btn-primary"><i
                                class="fa fa-eye"></i></a>
                        <a href="{{ route('edit-history', ['id' => $history->id]) }}" class="btn btn-success"><i
                                class="fa fa-edit"></i></a>
                        <a href="{{ route('delete-history', ['id' => $history->id]) }}" class="btn btn-danger"><i
                                class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $histories->links() }}
    </div>
</body>

</html>
