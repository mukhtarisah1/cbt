@extends('layouts.layout')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<h3>Add Subject</h3>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSubjectModel">
 Add Subject
</button>

<!-- Modal -->
<div class="modal fade" id="addSubjectModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">

   <form  id="addSubject">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <label for="">Subject</label>
            <input type="text" class="form-control" name="subject" id="" placeholder="Enter Subject name" required>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
        </div>
   </form>

  </div>
</div>

<script>
    $(document).ready(function(){
        
        $("#addSubject").submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();       
            $.ajax(
                {
                    url:"{{ route('addSubject') }}",
                    type:"POST",
                    data:formData,
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if(data.success == true){
                        
                        location.reload();
                    }
                    else{
                       //alert(data.msg);              
                      }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
                });
        });
    });
</script>
@endsection