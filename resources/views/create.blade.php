<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>New user</title>
</head>
<body>
<div class="container">
    <h1 class="text-primary my-5">Create a new user</h1>
    <form class="needs-validation mb-2" method="post" novalidate>
        <div class="card">
            <div class="card-body">

                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name"
                               @if(isset($user)) value="{{$user->first_name}}" @endif required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name"
                               @if(isset($user)) value="{{$user->last_name}}" @endif required>
                    </div>

                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password"
                                   @if(isset($user)) value="{{$user->password}}" @endif
                                   aria-describedby="inputGroupPrepend"
                                   @if(!isset($user)) required @endif >

                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="email">email</label>
                            <input type="text" name="email" class="form-control" id="email"
                                   @if(isset($user)) value="{{$user->email}}" @endif
                                   aria-describedby="inputGroupPrepend"
                                   required>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                @if(isset($edit) )
                    <button class="btn btn-primary" type="submit" name="_method" value="put">update user</button>
                @else
                    <button class="btn btn-primary" type="submit" >create user</button>
                    @endif

            </div>
        </div>
    </form>
    @if(isset($errors))
        @foreach($errors as $error)
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
        @endforeach
    @endif

</div>
</body>

</html>
