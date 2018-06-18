
    <div class ='ui tiny modal' id ='deletemodal'>
      <i class ='close icon'></i>
      <div class ='header'>
        <h5 class ='modal-title'>Deleting all schedule</h5>
      </div>
      <div class ='content' align ='center'>
        <p>All schedules will be deleted. </p>
        <p style ='color:red;font-weight:bold'>Your student records will be deleted as well. Are you sure?</p>
      </div>
      <div class ='actions'>
        <a href ='#' class ='ui red button' onclick = "$('#deleteform').submit()">Yes</a>
        <a href ='#' class= 'ui blue button' onclick="$('#deletemodal').modal('hide')">No</a>
      </div>
    </div>
    <div class ='ui tiny modal' id = 'addmodal'>
      <div class ='header'>Add entry</div>
      <div class ='content'>
        <form method ='POST' class ='ui form'>
          {% csrf_token %}
          <div id = 'formcontentadd'></div>
        </div>
        <div class ='actions'>
          <input class ='ui blue button' name ='btnadd' type ='submit' value ='Add'/>
        </div>
      </form>
    </div>
    <div class="ui tiny modal" id = 'modal'>
      <div class="header">Edit</div>
      <div class="content">
        <form method ='POST' class ='ui form'>
          {% csrf_token %}
          <input type ='hidden' name ='id' />
          <div id = 'formcontentedit'>

          </div>
        </div>
        <div class ='actions'>
          <input class ='ui blue button' name ='submit' type ='submit' value ='Edit'>
        </div>
      </form>
    </div>
    <div class="ui mini modal" id = 'prompt'>
      <div class="header">Deleting record</div>
      <div class="content">
        Are you sure?
      </div>
      <div class ='actions'>
        <div class ='two column row'>
          <form method ='POST'>
            {% csrf_token %}
            <input type ='hidden' name ='id' id = 'id'/>
            <input type ='submit' name ='btnDelete' value = 'Yes' class ='ui red button'/>
            <a class ='ui right green button' onclick = "$('#prompt').modal('hide')">No</a>
          </form>
        </div>
      </div>
    </div>
<div class="ui modal" id="roomsModal" >
	<i class ='close icon'></i>
	<div class ='header'>
		<h5 class ='modal-title'>Available schedule for </h5>
	</div>
	<div class ='scrolling content'>
		<table class= 'ui celled table '>
			<thead>
				<tr>
					<th>Start time</th>
					<th>End time</th>
					<th>Status</th>
					<th>Schedule</th>
					<th>Capacity</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<div class ='ui modal' id ='deletemodal'>
	<i class ='close icon'></i>
	<div class ='header'>
		<h5 class ='modal-title'>Deleting all schedule</h5>
	</div>
	<div class ='content'>
		<a class ='red button' href ='#'>Yes</a>
	</div>
</div>
