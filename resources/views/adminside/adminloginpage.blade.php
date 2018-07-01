<div id = 'color-overlay'>
</div>
@include ("../navbar")
<div class = 'ui container' style ='padding-top:100px'>
  <div class ='content' style='padding:10px'> 
    <div class ='ui centered card' style='width:55%'>
      <div class ='content'>
        <div class ='header'>
          <h2 class ='title'>Login</h2>
        </div>
      </div>
      <div class ='content'>
        @if (session('error')!==null)
        <div class="ui error message" style ='font-size:0.9em'>
          <i class ='close icon' onclick = "$('.error.message').hide()"></i>
          <div class="header" >Error</div> {{session('error')}}
        </div>
        @endif
        <form method ='post' class ='ui large form'>
          <div class ='field'>
            @csrf
            <input type ='text'  name ='username' placeholder ='Username'/>
          </div>
          <div class= 'field'>
            <input type ='password'  name ='password' placeholder = 'Password'/>
          </div>
          <input type ='submit' name = 'submit' class ='ui positive button' value ='Login'/>
        </form>
      </div>
    </div>

  </div>
</div>
@include("../scripts")
</div>