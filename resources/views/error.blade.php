<div id = 'color-overlay'>
</div>
@include ("navbar")
<div class = 'ui container' style ='padding-top:100px'>
  <div class ='content' style='padding:10px'> 
    <div class ='ui centered card' style='width:55%'>
      <div class ='content'>
        <div class ='header'>
          <h2 class ='title'>Error!</h2>
        </div>
      </div>
      <div class ='content'>
        <p>{{$message}}</p>
      </div>
    </div>

  </div>
</div>
@include("../scripts")
</div>