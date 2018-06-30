@include ("adminside.dashboardheader")
@include ("adminside.adminsidebar")
@include ("modals")
<base href ='/dashboard/terminal/'>
<div class ='ui segment' style ='width:45%'>
  <div class ='header'>
    <h5 class ='title' style ='font-weight:500'></h5>
  </div>
  <div class ='content' style =' font-size:0.9em'>
    @if(session('success')!==null)
    <div class ='ui blue message'>
      <i class ='close icon'></i>
      <div class ='header'>Success</div>
      {{session('success')}}
    </div>
    @endif
    <div class ='ui buttons'>
    <button class ='ui blue button addbtn' id = 'laboratories' style ='margin-bottom:10px'><i class ='ui plus icon'></i>Add</button><br/>
    <button class ='ui green button' id = 'range' style ='margin-bottom:10px'><i class ='ui sitemap icon'></i>Assign IP by range</button>
    </div>
    <div class ='ui basic buttons' style ='width:100%'>
      @foreach($buttons as $button)
      <button class ='ui basic button terminal'>{{$button->lab_name}}</button>
      @endforeach
    </div>
    <table class ='ui fixed celled striped table'>
      <thead>
        <tr>
          <th>Terminal Name</th>
          <th>IP Address</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id ='terminalbody'>
        @foreach($results as $result)
        <tr>
          <td><b id =''>{{$result->name}}</b></td>
          <td id = 'ipAddress'>{{$result->ip}}</td>
          <td><div class ='ui buttons' style ='width:100%'>
            <button class ='ui blue button editbtn lab' onclick = "editentry({{$result->lab_id}},'terminal',this)"><i class ='ui edit icon'></i>Edit</button>
            <button class ='ui red button' onclick = "deleteentry({{ $result->lab_id }})"><i class ='ui trash icon'></i>Delete</button>
          </div></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@include ("../scripts")
</div>
</div>
<script>
  $('.terminal').click(function(){
    $.ajax({
      type:"POST",
      url:"/filterterminal",
      data:{name: $(this).html()},
      success:function(html){
        $('#terminalbody').html(html)
      },
      error:function(html){
        console.log(html)
      }
    })
  })
</script>