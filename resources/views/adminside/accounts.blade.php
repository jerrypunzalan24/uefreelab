@include ("adminside.dashboardheader")
@include ("adminside.adminsidebar")
@include ("modals")
<base href ='/dashboard/accounts/'>
<div class ='ui segment' style ='width:45%'>
  <div class ='header'>
    <h5 class ='title' style ='font-weight:500'></h5>
  </div>
  <div class ='content' style =' font-size:0.9em'>
    <button class = 'ui blue button addbtn' id = 'acc' style ='margin-bottom:10px'>Add</button><br/>
    
  @if(session('success')!==null)
  <div class ='ui blue message'>
    <i class ='close icon'></i>
    <div class ='header'>Success</div>
    {{session('success')}}
  </div>
  @endif
    <table class ='ui fixed celled striped table'>
      <thead>
        <tr>
          <th>Full name</th>
          <th>Username</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($results as $result)
        <tr>
          <td id = 'fullname'>{{$result->firstname}} {{$result->lastname}}</td>
          <td id = 'username'>{{$result->username}}</td>
          <td id = 'role'>{{$result->role == 0 ? "Admin" : "Facilitator"}}</td>
          <td>
            <div class ='ui buttons'>
              <button class ='ui blue button editbtn acc' onclick ="editentry({{$result->id}}, 'acc', this)">Edit</button>
              <button class ='ui red button' onclick = "deleteentry({{$result->id}})">Delete</button>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>
@include ("../scripts")
</div>
</div>