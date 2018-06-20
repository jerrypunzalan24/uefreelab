@include ("adminside.dashboardheader")
@include ("adminside.adminsidebar")
@include ("modals")
<base href ='/dashboard/laboratories/'>
<div class ='ui segment' style ='width:45%'>
  <div class ='header'>
    <h5 class ='title' style ='font-weight:500'></h5>
  </div>
  <div class ='content' style =' font-size:0.9em'>
    <button class ='ui blue button addbtn' id = 'laboratories' style ='margin-bottom:10px'>Add</button><br/>
    <table class ='ui fixed celled striped table'>
      <thead>
        <tr>
          <th>Lab name</th>
          <th>Capacity</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($results as $result)
        <tr>
          <td><b id ='labname'>{{$result->lab_name}}</b></td>
          <td id = 'capacity'>{{$result->lab_capacity}}</td>
          <td><div class ='ui buttons'>
            <button class ='ui blue button editbtn lab' onclick = "editentry({{$result->lab_id}},'lab',this)">Edit</button>
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