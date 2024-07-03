@extends("layout.main")
@section("title")
    register
@endsection
@section("content")
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h1>Register Panel</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('user.register')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">User Name</label>
                            <input type="text" name="name" class="form-control">
                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control">
                            <span class="text-danger">@error('email'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                            <span class="text-danger">@error('password'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <p>You have already registered  <a href="{{route('login')}}">Login</a></p>
                </div>
            </div> 
        </div>
    </div>
@endsection