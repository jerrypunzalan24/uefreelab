@include ("navbar")

<!--
University of the East Freelab System
Developed by: UE CCSS R&D Unit
Lead developer: Jeremiah F. Punzalan
-->
<div id = 'color-overlay'>
	
</div>
@include ("styles")
<p style ='position:absolute;bottom:0;right:10;;color:white;font-weight:100'>Developed by UE CCSS	R&D</p>
<div class ='ui container' style='padding-top:100px'>
	<div class ='ui card' style ='width:50%;margin:auto;background-color:rgba(0,0,0,0.5);box-shadow:none' id = 'rightdesc'>
		<div class ='content'>
			@if (session('error')!==null)
			<div class="ui error message" style ='font-size:0.9em'>
				<i class ='close icon'></i>
				<div class="header" >Error</div> Student {{session('error')}} is already scheduled
			</div>
			@endif
			<form method ='post' class ='ui large form'>
				@csrf
				<div class ='two fields'>
					<div class ='field '  style ='padding-right:0px'>
						<label style ='color:white;font-weight:100'>Firstname</label>
						<input type ='text' class ='trans'  name ='fname' placeholder = 'First Name' />
						<p id = 'error' style ='color:red'></p>
					</div>
					<div class ='field' style ='padding-right:0px'>
						<label style ='color:white;font-weight:100'>Lastname</label>
						<input type ='text' class ='trans' placeholder = 'Last name' name ='lname'/>
						<p id = 'error' style ='color:red'></p>
					</div>
				</div>
				<div class ='field' style ='padding-right:0px'>
					<label style ='color:white;font-weight:100'>Student number</label>
					<input type ='number' class ='quantity trans'  name ='studentnumber' placeholder = 'Student number'/>
					<p id = 'error'style ='color:red'></p>
				</div>
				<div class ='two fields'>
					<div class ='field' style ='padding-right:0px'>
						<label style ='color:white;font-weight:100'>Course</label>
						<input type ='text' class ='trans'  name ='course' placeholder = 'Course'/>
						<p id = 'error'style ='color:red'></p>
					</div>
					<div class ='field'>
						<label style ='color:white;font-weight:100'>Subject assigned</label>
						<input type ='text' class ='trans' name ='subject' placeholder ='Use subject code'>
					</div>
				</div>
				<div class ='field'>
					<input type ='submit' class ='ui button positive fluid' name ='btnSubmit' value = 'Check Schedules'/>
				</div>
			</div>
		</form>
	</div>
</div>

</div>
@include ("scripts")
<script>
	$(document).ready(function(){

		var count = 1
		setInterval(function(){
			console.log("Works")
			$('body').css('-webkit-transition','background 0.6s linear')
			if(count%2==0){
				$('body').css('background-image', 'url({{asset("assets/img/1.jpg")}})')
			}
			else{
				$('body').css('background-image', 'url({{asset("assets/img/0.jpg")}})')
			}
			count += 1
		},5000)

		$('.ui.grid').fadeIn()
		$('#leftdesc').css('height',$('#rightdesc').height())
		$('.message .close').click(function(){
			$(this).closest('.message').hide()		
			$('#leftdesc').css('height',$('#rightdesc').height())

		})
		$('form input').change(function(){
			if($(this).val() != ''){
				$(this).closest('div.field').removeClass('error')
			// $(this).closest('div.field').children().last().remove()
		}
	})
		$('form').submit(function(e){
			var valid = true
			$('form input').each(function(){
				if($(this).val() == ''){
					valid = false
					$(this).closest('div.field').addClass('error')
				// if($(this).attr('name') != 'timein'){
				// 	$(this).closest('div.field').append(`    <div class="ui pointing red basic label">
				// 		Please enter a value
				// 		</div>`)		
				// }
				// else{
				// 	$(this).closest('div.field').append(`    <div class="ui left pointing red basic label">
				// 		Please enter a value
				// 		</div>`)		
				// }
			}
		})
			if(!valid){
				e.preventDefault()
			}
		})
	})
</script>