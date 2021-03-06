@include ("adminside.dashboardheader")
@include ("adminside.adminsidebar")
@include ("modals")
<base href ='/uefreelab/public/dashboard/labsched/'>
<div class ='ui segment' style ='width:45%'>
  <div class ='header'>
    <h5 class ='title' style ='font-weight:500'></h5>
  </div>
  <div class ='content' style =' font-size:0.9em'>
    <div class ='ui yellow message'>
      <div class ='header'>Warning</div>
      <p>Deleting one or all schedule will affect student records who are taking the schedule. Make sure to print or backup all student data</p>
    </div>
        <form method ='POST' id ='deleteform' action ='deleteall'>
        @csrf
        <a class ='ui blue button addbtn' id = 'labsched' style ='margin-bottom:10px'><i class ='ui plus icon'></i>Add</a>
        <a class ='ui red button' onclick ="$('#deletemodal').modal('show')"><i class ='ui trash icon'></i>Delete all</a>
        <input name ='deletebtn' class ='ui red button' type ='hidden' style ='margin-bottom:10px' value ='Delete all'>
      </form>
      <form method = 'POST' action ='upload' id ='fileupload' style ='display:inline-block'>
        @csrf
        <div style ='overflow:hidden;position:relative;'>
          <a class ='ui icon green button'>
            <i class ='file icon'></i>Upload schedule
          </a>
          <input type ='file' name ='importsched' style='opacity:0;position:absolute;left:0;top:0;width:100%;height:100%'value =''/> 
        </div>
      </form>
  </div>
  @if(session('success')!==null)
  <div class ='ui blue message'>
    <i class ='close icon'></i>
    <div class ='header'>Success</div>
    {{session('success')}}
  </div>
  @endif
  <div class ='ui basic buttons' style ='width:100%'>
    @foreach($buttons as $button)
    <button class ='ui button filterbtn lab '>{{$button->lab_name}}</button>
    @endforeach
  </div>
  <table class= 'ui fixed celled striped table responsive' >
    <thead>
      <tr>
        <th>Time</th>
        <th>Description</th>
        <th style ='width:60px'>Lab name</th>
        <th style ='width:80px'>Status</th>
        <th style ='width:80px'>Schedule</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id = 'labtbody' >
      @foreach ($results as $result)
      <tr>
        <td><b id = 'timer'>{{ $result->time_in }} - {{ $result->time_out}}</b></td> 
        <td id ='schedname  '>{{$result->description === "" ?  "Available Schedule" : $result->description}}</td>   
        <td id = 'labname'>{{ $result->lab_name }}</td>
        <td id = 'status'>{{ $result->status == 0 ? "Available" :"Not available" }}</td>
        <td id = 'schedule'>{{ $result->schedule }}</td>
        <td><div class ='ui buttons' style= 'width:100%'>
          <button class ='ui blue button editbtn labsched' onclick ="editentry({{$result->reserved_lab_id}}, 'labsched',this)" ><i class ='ui edit icon'></i>Edit</button> 
          <button class ='ui red button' onclick = "deleteentry({{ $result->reserved_lab_id }})"><i class ='ui trash icon'></i>Delete</button>
        </div></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
@include ("../scripts")
</div>
</div>
<script>
  $('#fileupload').change(function(){
    $('#fileupload').submit()
  })
  $(document).ready(function(){
    $('#schedtimein').timepicker();
    $('#schedtimeout').timepicker();
  })
</script>