@extends("layout.main")
@section("title")
    Dashboard
@endsection
@section("content")
<div class="container">
    <div class="row">
        <div class="col-6"><h1>Dashboard</h1></div>
        <div class="col-6"><a href="{{route('logout')}}">Logout</a></div>
    </div>
</div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                    @if(Session::has('succ'))
                        <div id="msg" class="from-group alert alert-success">{{Session::get('succ')}}</div>
                    @endif
                    <h3> Hello, <span>{{Auth::user()->name}}</span></h3>
                    
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

    $(document).ready(function(){
        setTimeout(function() { 
            $('#msg').hide();
        }, 3000);
    });
</script>
    
@endpush