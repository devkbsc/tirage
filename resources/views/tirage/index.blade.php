<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Participants</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>List of Participants</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('tirage.create') }}"> Create Participant</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Participant Name</th>
                    <th>Participant Email</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = 1;
                @endphp

                @foreach ($tirages as $tirage)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $tirage->name }}</td>
                        <td>{{ $tirage->email }}</td>
                        <td>
                            <form action="{{ route('tirage.destroy',$tirage->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('tirage.edit',$tirage->id) }}">Edit Participant</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $tirages->links() !!}
    </div>
</body>
</html>