@include("adminside.dashboardheader")
@include ("adminside.adminsidebar")
@include("modals")
      <div class ='ui segment' style ='width:45%'>
        <div class ='header'>
          <h5 class ='title' style ='font-weight:500'></h5>
        </div>
        <div class ='content' style =' font-size:0.9em'><!--
          <button class ='ui blue button addbtn' id ='studentsinlab' style ='margin-bottom:10px'>Add</button><br/>
        -->
          <table class= 'ui fixed celled striped table' >
            <thead>
              <tr>
                <th>Student number</th>
                <th>Full name</th>
                <th>Subject</th>
                <th>Course</th>
                <th>Time in</th>
                <th>Assigned Terminal</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id = 'onlabtbody'>
              @foreach($results as $result)
              <tr>
                <td>{{ $result->studentnumber }}</td>
                <td>{{ $result->firstname }} {{ $result->lastname }}</td>
                <td>{{$result->subject}}</td>
                <td>{{$result->course}}</td>
                <td>{{ $result->time_in }}</td>
                <td>{{ $result->name }} </td>
                <td>
                  <form method ='post' action = 'dashboard/timeout' style ='margin-bottom:0px'>
                    @csrf
                    <input type ='hidden' name ='id' value ='{{$result->student_id}}'/>
                    <input type ='hidden' name ='studentnumber' value = '{{$result->studentnumber}}'>
                    <input type ='submit' name ='timeout' class ='ui blue button' value ='Time out' />
                  </form>
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