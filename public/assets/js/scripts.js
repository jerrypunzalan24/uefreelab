
function deleteentry(x){
  $('input[id=id]').val(x)
  $('#prompt').modal('show')
}
function checkpassword(){
  if($('input[name=confirmpass]').val() != ''){
    var check = $('input[name=confirmpass').val() == $('input[name=password]').val()
    if(!check)
      $('input[name=confirmpass], input[name=password]').css('border-color', 'red')
    else
      $('input[name=confirmpass], input[name=password]').css('border-color', 'rgba(0,0,0,0.15)')
    $('input[name=btnadd]').attr('disabled', !check)
  }
}
function checkoldpass(x){
  $.ajax({
    type:"POST",
    url:"dashboard/accounts",
    data:{
      id: $('input[name=id]').val(),
      password:$(x).val(),
      username: '',
      validateedit: true
    },
    success:function(html){
      if(!html.passworderror)
        $(x).css('border-color','red')
      else
        $(x).css('border-color','rgba(0,0,0,0.15)')
      $('input[name=submit]').attr('disabled', !html.passworderror)
    }
  })
}
function checkduplicate(x,y){
  var formData = new FormData()
  formData.append('username',$(x).val())
  if(y == 1)
    formData.append('validateadd', true)
  if(y == 2){
    formData.append('id',$('input[name=id]').val())
    formData.append('validateedit', true)
    formData.append('password','')
  }
  $.ajax({
    type:"POST",
    url:"/dashboard/accounts",
    contentType:false,
    processData:false,
    data:formData,
    success:function(html){
      if(html.usernameerror)
        $(x).css('border-color','red')
      else
        $(x).css('border-color','rgba(0,0,0,0.15')
    $('input[name=btnadd]').attr('disabled', html.usernameerror)
    }
  })
}
function editentry(x, y,z){
  var id = y
  console.log($(z).closest('tr').find('#timer').html())
  $('input[name=id]').val(x)
  $('input[name=submit').attr('disabled',false)
  if(id =='lab'){
    var labname  = $(z).closest('tr').find('#labname').html()
    var capacity = $(z).closest('tr').find('#capacity').html()
    $('#formcontentedit').html(`
      <div class ='field'>
      <label>Lab name </label>
      <input type = 'text' name ='labname' value ='${labname}'placeholder ='Lab name'/>
      </div>
      <div class ='field'>
      <label>Capacity</label>
      <input type ='number' name = 'capacity' value ='${capacity}' placeholder = 'Capacity'/>
      </div>
      `)
  }
  else if(id =='terminal'){
    var ipaddress = $(z).closest('tr').find('#ipAddress').html()
    $('#formcontentedit').html(`
      <div class ='field'>
      <input type ='text' name ='ipAdd' value ='${ipaddress}' placeholder ='IP Address'>
      </div>
      `)
  }

  else if(id =='labsched'){
    var labname  = $(z).closest('tr').find('#labname').html()
    var status   = $(z).closest('tr').find('#status').html()
    var schedule = $(z).closest('tr').find('#schedule').html()
    var timein   = $(z).closest('tr').find('#timer').html().split(' - ')[0]
    var timeout  = $(z).closest('tr').find('#timer').html().split(' - ')[1]
    var statusValue = (status == "Available") ? 0 : 1
    $('#formcontentedit').html(`
      <div class ='two fields'>
      <div class ='field'>
      <label>Status</label>
      <select class ='ui fluid dropdown' name ='status'>
      <option value ='0' >Available</option>
      <option value = '1' >Not available</option>
      </select>
      </div>
      <div class ='field'>
      <label>Schedule</label>
      <input type ='text' name ='schedule' value = '${schedule}' placeholder = 'Schedule' />
      </div>
      </div>
      <h4 class ='ui dividing header'>Lab Time</h4>
      <div class = 'two fields'>
      <div class ='field'>
      <input type ='text' placeholder = 'Time in' name ='timein' value ='${timein}'/>
      </div>
      <div class ='field'>
      <input type ='text' placeholder = 'Time out' name ='timeout' value ='${timeout}'/>
      </div>
      </div>
      `)
    $(`option[value=${statusValue}]`).attr('selected',true)
  }
  else if(id == 'acc'){
    var firstname = $(z).closest('tr').find('#fullname').html().split(' ')[0]
    var lastname  = $(z).closest('tr').find('#fullname').html().split(' ')[1]
    var username  = $(z).closest('tr').find('#username').html()
    $('#formcontentedit').html(`
      <div class = 'field'>
      <div class ='two fields'>
      <div class ='field'>
      <label>First name</label>
      <input type ='text' name ='firstname' value = '${firstname}' placeholder ='First name'/>
      </div>
      <div class ='field'>
      <label>Last name</label>
      <input type ='text' name ='lastname' value ='${lastname}' placeholder ='Last name'/>
      </div>
      </div>
      <div class ='two fields'>
      <div class ='field'>
      <label>Username</label>
      <input type ='text' onchange ='checkduplicate(this, 2)' name ='username' value ='${username}' placeholder = 'Username'/>
      </div>
      <div class ='field'>
      <label>Role</label>
      <select class ='ui dropdown' name ='role'>
      <option value ='0'>Admin</option>
      <option value ='1'>Facilitator</option>
      </select>
      </div>
      </div>
      <h4 class ='ui dividing header'>Change password</h4>
      <div class ='two fields'>
      <div class ='field'>
      <label>Old password</label>
      <input type ='password' onchange ='checkoldpass(this)' name ='oldpass' placeholder ='Old password'/>
      </div>
      <div class ='field'>
      <label>New password</label>
      <input type ='password' name ='newpass' placeholder ='New password'/>
      </div>
      </div>
      `)
  }
  $('#modal').modal('show')
}
  $('.addbtn').click(function(){
    $('input[name=btnadd]').attr('disabled',false)
    if($(this).attr('id') == 'studentsinlab'){
      $('#formcontentadd').html(`
        <div class ='two fields'>
        <div class ='field'>
        <label>First Name</label>
        <input type ='text' name ='firstname' placeholder = 'First name'/>
        </div>
        <div class ='field'>
        <label>Last Name</label>
        <input type ='text' name ='lastname' placeholder = 'Last Name'/>
        </div>
        </div>
        <div class ='field'>
        <label>Student Number</label>
        <input type ='text' name ='studentnumber' placeholder = 'Student number'/>
        </div>
        <h4 class ='ui dividing header'>Choose a schedule</h4>
        <div class ='field'></div>

        `)
      $('#addmodal').modal('show')
    }
    else if($(this).attr('id') == 'acc'){
      $('#formcontentadd').html(`
        <div class = 'field'>
        <div class ='two fields'>
        <div class ='field'>
        <label>First name</label>
        <input type ='text' name ='firstname' placeholder ='First name' REQUIRED/>
        </div>
        <div class ='field'>
        <label>Last name</label>
        <input type ='text' name ='lastname' placeholder ='Last name' REQUIRED/>
        </div>
        </div>
        <div class ='two fields'>
        <div class ='field'>
        <label>Username</label>
        <input type ='text' onchange = 'checkduplicate(this, 1)' name ='username' REQUIRED placeholder = 'Username'/>
        </div>
        <div class ='field'>
        <label>Role</label>
        <select class ='ui dropdown' name ='role'>
        <option value ='0'>Admin</option>
        <option value ='1'>Facilitator</option>
        </select>
        </div>
        </div>
        <h4 class ='ui dividing header'>Password</h4>
        <div class ='two fields'>
        <div class ='field'>
        <label>Password</label>
        <input type ='password' onchange ='checkpassword()' REQUIRED id = 'pass' name ='password' placeholder ='Password'/>
        </div>
        <div class ='field'>
        <label>Confirm password</label>
        <input type ='password' onchange = 'checkpassword()' REQUIRED name ='confirmpass' placeholder ='Confirm password'/>
        </div>
        </div>
        `)
      $('#addmodal').modal('show')
    }
    else if($(this).attr('id') == 'labsched'){
      var labs = ''
      $.ajax({
        type:'POST',
        data:{},
        url: "/dashboard/labsched/getlabs",
        success: function(html){
          $('#formcontentadd').html(`<div class ='two fields'>
            <div class ='field'>
            <label>Time in</label>
            <input type ='text' name = 'timein' placeholder = 'Time in' REQUIRED/>
            </div>
            <div class ='field'>
            <label>Time out</label>
            <input type ='text' name ='timeout' placeholder = 'Time out' REQUIRED/>
            </div>
            </div>
            <div class = 'two fields'>
            <div class ='field'>
            <label>Status</label>
            <select class ='ui dropdown' name ='status'>
            <option value ='0'>Available</option>
            <option value ='1'>Not available</option>
            </select>
            </div>
            <div class = 'field'>
            <label>Schedule</label>
            <input type ='text' name ='schedule' placeholder ='Schedule' REQUIRED/>
            </div>
            </div>
            <div class ='field'>
            <label>Lab</label>
            <select class = 'ui fluid dropdown' name ='lab'>
            ${html}
            </select>
            </div>
            `)
          $('#addmodal').modal('show')
        },
        error:function(html){
          console.log(html)
        }
      })
    }
    else if($(this).attr('id') == 'laboratories'){
      $('#formcontentadd').html(`
        <div class ='field'>
        <label>Lab Name</label>
        <input type = 'text' name ='labname' placeholder = 'Lab name'/>
        </div>
        <div class ='field'>
        <label>Capacity</label>
        <input type ='number' name ='capacity' placeholder = 'Capacity'/>
        </div>
        `)
      $('#addmodal').modal('show')
    }
  })
  $('.editbtn').click(function(){
  })

  $('a.subitem').click(function(){
    $('.headitem').removeClass('blue inverted')
    $(this).parent().addClass('blue inverted')
  })
