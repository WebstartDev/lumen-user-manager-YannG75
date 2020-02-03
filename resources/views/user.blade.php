<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>User</title>
</head>
<body>
<div class="container">
    <a href="/users" class="text-decoration-none"><h1 class="text-secondary">User</h1></a>

    <div class="d-flex flex-row mb-2 justify-content-between">
        @if(isset($success))
        <div class="alert alert-success">
            {{$success}}
        </div>
            @elseif(isset($errors))
            <div class="alert alert-danger">
                {{$errors}}
            </div>
        @endif
        <div class="d-flex"><a href="/users/{{$user->id}}/edit" class="mr-2">
                <button type="button" class="btn btn-outline-primary border-0">Edit</button>
            </a>

            <form action="/users/{{$user->id}}/destroy" method="post">
                <button type="submit" name="_method" value="delete" class="btn btn-outline-primary border-0">Delete</button>
            </form>
        </div>

            <a href="/api/users/{{$user->id}}">
                <button class="btn btn-outline-info">API</button></a>
    </div>

    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">User informations</th>


        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">id</th>
            <td>{{$user->id}}</td>
        </tr>

        <tr>
            <th>first name</th>
            <td>{{$user->first_name}}</td>
        </tr>

        <tr>
            <th>last name</th>
            <td>{{$user->last_name}}</td>
        </tr>

        <tr>
            <th>email</th>
            <td>{{$user->email}}</td>
        </tr>



        </tbody>
    </table>
</div>

</body>
</html>
