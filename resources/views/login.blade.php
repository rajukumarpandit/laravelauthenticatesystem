@extends("layout.main")
@section("title")
    login page
@endsection
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h1>Login Panel</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{route('user.login')}}" method="post">
                            @csrf
                            @if(Session::has('succ'))
                                    <div id="msg" class="from-group alert alert-success">{{Session::get('succ')}}</div>
                            @endif
                            @if(Session::has('err'))
                                    <div id="errors" class="from-group alert alert-danger">{{Session::get('err')}}</div>
                            @endif
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
                                <button type="submit" class="btn btn-primary">LogIn</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p>You have no account <a href="{{route('register')}}">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

    $(document).ready(function(){
        setTimeout(function() { 
            $('#errors').hide();
            $('#msg').hide();
        }, 3000);
    });
</script>
    
@endpush