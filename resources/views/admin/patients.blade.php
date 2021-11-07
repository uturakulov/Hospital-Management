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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <style>
        thead input {
            width: 100%;
        }

    </style>
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
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="container=fluid p-3">
        <h4 class="text-center"> Patients </h4>
        <a href="{{ route('admin-add-patient') }}" class="btn btn-primary mb-3">Add</a>
        <table class="table table-bordered w-100 table-hover" id="mytable">
            <thead>
                <th>ID</th>
                <th>Full Name</th>
                <th>Phone Number</th>
                <th>Date of Birth</th>
                <th>Passport Number</th>
                <th>Polyclinic</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                    <tr>
                        <td>{{ $patient->id }}</td>
                        <td>{{ $patient->first_name . ' ' . $patient->last_name }}</td>
                        <td>{{ $patient->phone_number }}</td>
                        <td>{{ $patient->dob }}</td>
                        <td>{{ $patient->passport_number }}</td>
                        <td>{{ $patient->polyclinic->title ?? 'NA' }}</td>
                        <td>{{ $patient->email }}</td>
                        <td>{{ strlen($patient->address) > 50 ? substr($patient->address, 0, 50) . '...' : $patient->address }}
                        </td>
                        <td>
                            {{-- <a href="{{ route('admin-show-patient', ['id' => $patient->id]) }}"
                                class="btn btn-primary"><i class="fa fa-eye"></i></a> --}}
                            <a href="{{ route('admin-edit-patient', ['id' => $patient->id]) }}"
                                class="btn btn-success"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('admin-delete-patient', ['id' => $patient->id]) }}"
                                class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#mytable thead tr').clone(true).appendTo('#mytable thead');
            $('#mytable thead tr:eq(1) th').each(function(i) {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder=" Search ' + title + '" />');

                $('input', this).on('keyup change', function() {
                    if (table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            });

            var table = $('#mytable').DataTable({
                orderCellsTop: true,
                fixedHeader: true
            });
        });
    </script>
</body>

</html>
