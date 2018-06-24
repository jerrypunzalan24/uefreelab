@include ("adminside.dashboardheader")
@include ("adminside.adminsidebar")
@include ("modals")
<base href ='/dashboard/terminal/'>
<div class ='ui segment' style ='width:45%'>
  <div class ='header'>
    <h5 class ='title' style ='font-weight:500'></h5>
  </div>
  <div class ='content' style =' font-size:0.9em'>
  @if(session('success')!==null)
  <div class ='ui blue message'>
    <i class ='close icon'></i>
    <div class ='header'>Success</div>
    {{session('success')}}
  </div>
  @endif
    <button class ='ui blue button addbtn' id = 'laboratories' style ='margin-bottom:10px'>Add</button><br/>
    <table class ='ui fixed celled striped table'>
      <thead>
        <tr>
          <th>Terminal Name</th>
          <th>IP Address</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($results as $result)
        <tr>
          <td><b id =''>{{$result->name}}</b></td>
          <td id = 'ipAddress'>{{$result->ip}}</td>
          <td><div class ='ui buttons'>
            <button class ='ui blue button editbtn lab' onclick = "editentry({{$result->lab_id}},'terminal',this)">Edit</button>
            <button class ='ui red button' onclick = "deleteentry({{ $result->lab_id }})">Delete</button>
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