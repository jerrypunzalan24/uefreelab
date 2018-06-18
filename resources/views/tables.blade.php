      <div class ='ui segment' style ='width:45%'>
        <div class ='header'>
          <h5 class ='title' style ='font-weight:500'></h5>
        </div>
        <div class ='content' style =' font-size:0.9em'>
          {% if studentsinlab %}
          <button class ='ui blue button addbtn' id ='studentsinlab' style ='margin-bottom:10px'>Add</button><br/>
          <table class= 'ui fixed celled striped table' >
            <thead>
              <tr>
                <th>Student number</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Course</th>
                <th>Time in</th>
                <th>Assigned Terminal</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id = 'onlabtbody'>
              {% for result in results %}
              <tr>
                <td>{{ result.studentnumber }}</td>
                <td>{{ result.student_firstname }}</td>
                <td>{{ result.student_lastname }}</td>
                <td>{{result.course}}</td>
                <td>{{ result.student_timein }}</td>
                <td>{{ result.terminal_name }} </td>
                <td>
                  <form method ='post' style ='margin-bottom:0px'>
                    {% csrf_token %}
                    <input type ='hidden' name ='id' value ='{{result.student_id}}'/>
                    <input type ='submit' name ='timeout' class ='ui blue button' value ='Time out' />
                  </form>
                </td>
              </tr>
              {% endfor %}
            </tbody>
          </table>
            {% elif allstudents %}

            <table class= 'ui fixed celled striped table' >

              <thead>
                <th>Student number</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Course</th>
                <th>Time in</th>
                <th>Time out</th>
                <th>Assigned Terminal</th>
              </thead>
              <tbody>
                {% for result in results %}
                <tr>
                  <td>{{result.studentnumber }}</td>
                  <td>{{ result.student_firstname }}</td>
                  <td>{{ result.student_lastname }}</td>
                  <td>{{result.course}}</td>
                  <td>{{ result.student_timein}}</td>
                  <td>{{ result.student_timeout }}:00</td>
                  <td>{{result.terminal_name}}</td>
                </tr>
                {% endfor %}
              </tbody>
            </table>
            {% elif labsched %}
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
            {% elif laboratories %}
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
                {% for result in results %}
                <tr>
                  <td><b id ='labname'>{{result.lab_name}}</b></td>
                  <td id = 'capacity'>{{result.capacity}}</td>
                  <td><div class ='ui buttons'>
                    <button class ='ui blue button editbtn lab' onclick = "editentry({{result.lab_id}},'lab',this)">Edit</button>
                    <button class ='ui red button' onclick = "deleteentry({{ result.lab_id }})">Delete</button>
                  </div></td>
                </tr>
                {% endfor %}
              </tbody>
            </table>
            {% elif accounts %}
            <button class = 'ui blue button addbtn' id = 'acc' style ='margin-bottom:10px'>Add</button><br/>
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
                {% for result in results %}
                <tr>
                  <td id = 'fullname'>{{result.firstname}} {{result.lastname}}</td>
                  <td id = 'username'>{{result.username}}</td>
                  <td id = 'role'>{{result.role}}</td>
                  <td>
                    <div class ='ui buttons'>
                      <button class ='ui blue button editbtn acc' onclick ="editentry({{result.accounts_id}}, 'acc', this)">Edit</button>
                      <button class ='ui red button' onclick = "deleteentry({{result.accounts_id}})">Delete</button>
                    </div>
                  </td>
                </tr>
                {% endfor %}
              </tbody>
            </table>
            {% endif %}
          </div>
        </div>
      </div>