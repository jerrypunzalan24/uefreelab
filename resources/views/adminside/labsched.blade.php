@include ("adminside.dashboardheader")
@include ("adminside.adminsidebar.")
@include ("modals")
<div class ='ui segment' style ='width:45%'>
  <div class ='header'>
    <h5 class ='title' style ='font-weight:500'></h5>
  </div>
  <div class ='content' style =' font-size:0.9em'>
   <form method ='POST' id ='deleteform'>
    {% csrf_token %}
    <a class ='ui blue button addbtn' id = 'labsched' style ='margin-bottom:10px'>Add</a>
    <a class ='ui red button' onclick ="$('#deletemodal').modal('show')">Delete all</a>
    <input name ='deletebtn' class ='ui red button' type ='hidden' style ='margin-bottom:10px' value ='Delete all'>
  </form>
  <form method = 'POST' id ='fileupload' style ='display:inline-block'>
    {% csrf_token %}
    <div style ='overflow:hidden;position:relative;'>
      <a class ='ui icon green button'>
        <i class ='file icon'></i>Upload schedule
      </a>
      <input type ='file' name ='importsched' style='opacity:0;position:absolute;left:0;top:0;width:100%;height:100%'value =''/> 
    </div>
  </form>
  <div class ='ui basic buttons' style ='width:100%'>
    {% for button in buttons %}
    <button class ='ui button filterbtn lab '>{{button.lab_name}}</button>
    {% endfor %}
  </div>
  <table class= 'ui fixed celled striped table' >
    <thead>
      <tr>
        <th>Time</th>
        <th>Lab name</th>
        <th>Status</th>
        <th>Schedule</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id = 'labtbody' >
      {% for result in results %}
      <tr>
        <td><b id = 'timer'>{{ result.reservelab_starttime }} - {{ result.reservelab_endtime}}</b></td>     
        <td id = 'labname'>{{ result.lab_name }}</td>
        <td id = 'status'>{{ result.status }} </td>
        <td id = 'schedule'>{{ result.schedule }}</td>
        <td><div class ='ui buttons'><button class ='ui blue button editbtn labsched' onclick ="editentry({{result.reserve_lab_id}}, 'labsched',this)" >Edit</button> <button class ='ui red button' onclick = "deleteentry({{ result.reserve_lab_id }})">Delete</button>
        </div></td>
      </tr>
      {% endfor %}
    </tbody>
  </table>
</div>
</div>
{% include "../scripts.html" %}
</div>
</div>