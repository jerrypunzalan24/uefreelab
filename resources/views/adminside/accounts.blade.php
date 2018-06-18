{% include "adminside/dashboardheader.html" %}
{% include "adminside/adminsidebar.html" %}
{% include "modals.html" %}
<div class ='ui segment' style ='width:45%'>
  <div class ='header'>
    <h5 class ='title' style ='font-weight:500'></h5>
  </div>
  <div class ='content' style =' font-size:0.9em'>
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

  </div>
</div>
{% include "../scripts.html" %}
</div>
</div>