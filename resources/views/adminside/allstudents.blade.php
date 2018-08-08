@include ("adminside.dashboardheader")
@include ("adminside.adminsidebar")
@include ("modals")
<div class ='ui segment' style ='width:45%'>
  <div class ='header'>
    <a href ='allstudents/print' class ='ui green button'><i class ='print icon'></i> Print</a>
    <h5 class ='title' style ='font-weight:500'></h5>
  </div>
  <div class ='content' style =' font-size:0.9em'>

    <table class= 'ui fixed celled striped table' >

      <thead>
        <th>Student number</th>
        <th>Full name</th>
        <th>Course</th>
        <th>Last Time in</th>
        <th>Last Time out</th>
        <th>Last Assigned Terminal</th>
        <th>Total Hours</th>
        <th>Count</th>
      </thead>
      <tbody>
        @foreach($results as $result)
        <tr>
          <td>{{$result->studentnumber }}</td>
          <td>{{ $result->firstname }} {{ $result->lastname }}</td>
          <td>{{$result->course}}</td>
          <td>{{$result->time_in1}}</td>
          <td>{{$result->student_time_out }}</td>
          <td>{{$result->name}}</td>
          <td>{{$result->hours}}</td>
          <td>{{$result->count}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@include ("../scripts")
</div>
</div>