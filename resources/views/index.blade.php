<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>User list</title>
</head>
<body>
<div class="container">

    <h1>Users</h1>
    @if(isset($success))
        <div class="alert alert-success" role="alert">
            {{$success}}
        </div>
            @endif
    <div class="d-flex flex-row-reverse mb-4 pr-4">
        <a href="api/users"><button class="btn btn-outline-info ml-3">API</button></a>
        <a href="users/create"><button class="btn btn-primary">Create</button></a>


    </div>
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th class="text-center" scope="col">First name</th>
            <th class="text-center" scope="col">Last name</th>
            <th class="text-center" scope="col">email</th>
            <th class="text-center" scope="col">action</th>

        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td class="text-center">{{$user->first_name}}</td>
                <td class="text-center">{{$user->last_name}}</td>
                <td class="text-center">{{$user->email}}</td>
                <td class="text-center"><a href="/users/{{$user->id}}"><button type="button" class="btn btn-info" value="{{$user->id}}"> Détails</button></a></td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>

</body>
</html>
