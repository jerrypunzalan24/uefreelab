@include("dashboardheader")
@include ("adminside/adminsidebar")
@include("modals")
      <div class ='ui segment' style ='width:45%'>
        <div class ='header'>
          <h5 class ='title' style ='font-weight:500'></h5>
        </div>
        <div class ='content' style =' font-size:0.9em'>
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
        </div>
      </div>
@include ("../scripts")
</div>
</div>