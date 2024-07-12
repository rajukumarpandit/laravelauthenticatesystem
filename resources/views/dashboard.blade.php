@extends("layout.main")
@section("title")
    Dashboard
@endsection
@section("content")
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <div class="container-fluid">
            <h1>Dashboard</h1>
            <div>
                <p>Hello, {{Auth::user()->name}}</p>
            </div>
            <div>
                <a class="btn btn-danger" href="{{route('logout')}}">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                    @if(Session::has('succ'))
                        <div id="msg" class="from-group alert alert-success">{{Session::get('succ')}}</div>
                    @endif   
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row p-2">
            <!-- Button to Open the Modal -->
            <div class="col-6">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add</button>
            </div>
        </div>
        <div class="row p-2">
            <!-- table show dynamic data -->
            <table class="table table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Task</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->task}}</td>
                        @if($task->status=='done')
                        <td><button type="button" id="btns" class="btn btn-primary" data-bs-toggle="modal" value="{{$task->id}}" data-bs-target="#myModals">{{$task->status}}</button></td>
                        @else
                        <td><button type="button" id="btns" class="btn btn-danger" data-bs-toggle="modal" value="{{$task->id}}" data-bs-target="#myModals">{{$task->status}}</button></td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center text-danger" colspan="3">Data not found!</td>
                    </tr>
                        
                    @endforelse
                </tbody>
            </table>
        </div>
  
    <!-- The Modal for add task-->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Add Todo Task</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
                <form id="formdata">
                    @csrf
                    <div class="form-group">
                        <label for="">Task</label>
                        <input type="text" name="task" class="form-control">
                        <input type="hidden" name="user_id" value="{{Auth::User()->id}}">
                    </div>
                    
                    <div class="form-group mt-2">
                        <button type="submit" id="btnRes" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    <!-- The Modal for change status-->
    <div class="modal" id="myModals">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change Status</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            <form id="changestatus">
                @csrf
                <input type="hidden" name="task_id" id="taskid">
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-select">
                        <option value="pending">pending</option>
                        <option value="done">done</option>
                    </select>
                </div>
                
                <div class="form-group mt-2">
                    <button type="submit" id="btnRes" class="btn btn-primary">Submit</button>
                </div>
            </form>
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
            $('#msg').hide();
        }, 3000);

        /*
        this code for add new task
        */
        $("#formdata").on("submit", function(e){
            e.preventDefault();
            var formData=$(this).serializeArray();
            $.ajax({
                type: 'POST',
                url: "{{route('todo.add')}}",
                data: formData,
                headers: {'API_KEY':'helloatg'},
                success: function(response){
                    if(response.status==true){
                        $('#mytable').load(location.href + " #mytable");
                        $("#formdata").find('input').val('');
                        $('#myModal').modal('hide');  
                    }
                    if(response.status==false){
                        console.log(response.message);
                    }
                    
                }
            })
        });
    
        /*
        this code used get and set task id for status updation
        */
       
        $(document).on('click', '#btns', function(){
           var taskid = $(this).val();
           $('#taskid').val(taskid);
           
        })


        /*
        this code for change status
        */
        $("#changestatus").on("submit", function(e){
            e.preventDefault();
            var formData=$(this).serializeArray();
            $.ajax({
                type: 'POST',
                url: "{{route('todo.status')}}",
                data: formData,
                headers: {'API_KEY':'helloatg'},
                success: function(response){
                    if(response.status==true){
                        $('#mytable').load(location.href + " #mytable");
                        $("#changestatus").find('input').val('');
                        $('#myModals').modal('hide'); 
                    }
                    if(response.status==false){
                        console.log(response.message);
                    }
                    
                }
            })
        });
    });

</script>
    
@endpush