@include("adminside.dashboardheader")
@include ("adminside.adminsidebar")
@include("modals")
<base href = '/dashboard/'>
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
                <th>Status</th>
                <th>Subject</th>
                <th style ='width:80px'>Course</th>
                <th>Time in</th>
                <th style ='width:80px'>Assigned Terminal</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id = 'onlabtbody'>
              @foreach($results as $result)
              <tr>
                <td>{{ $result->studentnumber }}</td>
                <td>{{ $result->firstname }} {{ $result->lastname }}</td>
                <td>{{$result->active == 0 ? "Active" : "Inactive"}}</td>
                <td>{{$result->subject}}</td>
                <td>{{$result->course}}</td>
                <td>{{ $result->time_in }}</td>
                <td>{{ $result->name }} </td>
                <td>
                    <input type ='hidden' name ='id' value ='{{$result->student_id}}'/>
                    <input type ='hidden' name ='studentnumber' value = '{{$result->studentnumber}}'>
                    <a href = '#' class ='ui blue button timeout' style ='padding:8px;' ><i class ='ui times icon'></i>Time out</a>
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
<script>
  $(document).ready(function(){
    $('.timeout').click(function(e){
      var id = $(this).closest('tr').find('input[name=id]').val()
      var studentnumber = $(this).closest('tr').find('input[name=studentnumber]').val()
      $('input[name=id1]').val(id)
      $('input[name=studentnumber1]').val(studentnumber)
      $('#timeout').modal('show')
    })
  })
</script>