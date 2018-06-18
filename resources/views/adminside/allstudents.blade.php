{% include "adminside/dashboardheader.html" %}
{% include "adminside/adminsidebar.html" %}
{% include "modals.html" %}
<div class ='ui segment' style ='width:45%'>
  <div class ='header'>
    <form method = 'POST'>
      
      {% csrf_token %}
    </form>
    <h5 class ='title' style ='font-weight:500'></h5>
  </div>
  <div class ='content' style =' font-size:0.9em'>

    <table class= 'ui fixed celled striped table' >

      <thead>
        <th>Student number</th>
        <th>Full name</th>
        <th>Course</th>
        <th>Time in</th>
        <th>Time out</th>
        <th>Assigned Terminal</th>
      </thead>
      <tbody>
        {% for result in results %}
        <tr>
          <td>{{result.studentnumber }}</td>
          <td>{{ result.student_firstname }} {{ result.student_lastname }}</td>
          <td>{{result.course}}</td>
          <td>{{ result.student_timein}}</td>
          <td>{{ result.student_timeout }}:00</td>
          <td>{{result.terminal_name}}</td>
        </tr>
        {% endfor %}
      </tbody>
    </table>
  </div>
</div>
{% include "../scripts.html" %}
</div>
</div>