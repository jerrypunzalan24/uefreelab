@include ("styles")
@include ("navbar")
<div id = 'color-overlay'>
  
</div>
<style>
body{
  background-image: url({{ asset("assets/img/bg.jpg") }});
  background-size: 100%;
}
#color-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index:-1;
  background-color: #2D9659;
  /*background-color: #EC9CFF;*/
/*  background-color: #FF768F;*/
  opacity: 0.3;
}
</style>
<div class ='ui container' style ='padding-top:100px'>
<div class ='ui centered card' style ='width:65%' >
  <div class ='content' style ='background-color: #EDEDED'>
        <div class ='header' >
          <h2 class ='title' style ='font-weight:500'>Success</h2>
        </div>
      </div>
        <div class ='content'>
        You have successfully reserved your schedule. Enjoy<br/>
        Your assigned terminal is <b>{{$terminal}}</b>
        </div>
        <div class ='extra content'>
          <a href = '/' class ='ui button primary'>Go back</a>
        </div>
</div>
@include ("scripts")