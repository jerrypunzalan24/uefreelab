<div id = 'color-overlay'>
</div>
@include ("navbar")
<div class = 'ui container' style ='padding-top:100px'>
  <div class ='content' style='padding:10px'> 
    <div class ='ui centered card' style='width:55%'>
      <div class ='content'>
        <div class ='header'>
          <h2 class ='title'>Verify assigned terminal</h2>
          <p style ='font-size:0.65em'>Enter your student number to continue</p>
        </div>
      </div>
      <div class ='content'>
        @if (session('error')!==null)
        <div class="ui error message" style ='font-size:0.9em'>
          <i class ='close icon' onclick = "$('.error.message').hide()"></i>
          <div class="header" >Error</div> {{session('error')}}
        </div>
        @elseif (session('message')!==null)
        <div class ='ui message' style ='font-size: 0.9em'>
          <i class ='close icon'></i>
          <div class ='header'>Info</div> {{session('message')}}
        </div>
        @endif
        <form method ='post' class ='ui large form'>
          <div class ='field'>
            @csrf
            <input type ='number'  name ='studentnumber' placeholder ='Student number'/>
          </div>
          <input type ='submit' name = 'verify' class ='ui positive button' value ='Verify'/>
        </form>
      </div>
    </div>

  </div>
</div>
@include("../scripts")
</div>