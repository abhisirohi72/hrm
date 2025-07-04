<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Card</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-lg rounded">
                    {{-- <img src="{{ asset('/storage/emp/images') . '/' . $employee->image }}" class="card-img-top"
                        alt="Card Image"> --}}
                        <div style="text-align: center;">
                            <img src="{{ 'file://' . public_path('storage/users/' . $employee->image) }}" style="width: 100px;" class="card-img-top"
                        alt="Card Image">
                        </div>
                    <div class="card-body">
                        <h5 class="card-title">Employee Icard</h5>
                        <h5>Name: {{ $employee->full_name}}</h5>
                        <p>Department: {{ $employee->departments->name}}</p>
                        <p>Branch: {{ $employee->branches->name}}</p>
                        <p>Email: {{ $employee->email}}</p>
                        <p>Mobile: {{ $employee->mobile}}</p>
                        <p>Address: {{ $employee->address}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
