@include ("navbar")

<!--
University of the East Freelab System
Developed by: UE CCSS R&D Unit
Lead developer: Jeremiah F. Punzalan
-->
<div id = 'color-overlay'>
	
</div>
@include ("styles")
<div style ='position:absolute;bottom:10;right:10;'>
	<img src ='{{asset('assets/img/rnd-logo.png')}}' style ='width:40px;vertical-align:middle' />
	<span style ='color:white;font-weight:100'>Developed by UE CCSS	R&D</span>
</div>
<div style ='position:absolute;top:60;left:10;color:#F9F9F9;font-weight:100'>
	<h1 style ='font-size:4em;margin-bottom:0px;text-shadow:2px 3px 2px #232323;font-family:Bebas;letter-spacing:3px'>UNIVERSITY OF THE <strong style ='color:#FF5E5E'>EAST</strong></h1>
	<h1 style ='margin-top:5px;font-size:3em;text-shadow:2px 3px 2px #232323;font-family:Bebas;letter-spacing:3px'>FREELAB SYSTEM</h1>
</div>
<div class ='ui container' style='padding-top:150px'>
	<div class ='ui card' style ='width:50%;margin-left:auto;background-color:rgba(0,0,0,0.5);box-shadow:none' id = 'rightdesc'>
		<div class ='content'>
			@if (session('error')!==null)
			<div class="ui error message" style ='font-size:0.9em'>
				<i class ='close icon'></i>
				<div class="header" >Error</div> Student {{session('error')}} is already scheduled
			</div>
			@elseif (session('notfound')!==null)
			<div class ='ui error message' style ='font-size:0.9em'>
				<i class ='close icon'></i>
				<div class ='header'>Error</div> Student number '{{session('notfound')}}' not found.
			</div>
			@endif
			<form method ='post' class ='ui large form' id = 'registeredForm'>
				@csrf
				<div class ='field' style ='padding-right:0px'>
					<label style ='color:white;font-weight:100'>Student number</label>
					<input type ='number' class ='quantity trans'  name ='studentnumber' placeholder = 'Student number' autocomplete="off" />
					<p id = 'error'style ='color:red'></p>
				</div>
				<div class ='two fields'>
					<div class ='field '  style ='padding-right:0px'>
						<label style ='color:white;font-weight:100'>Firstname</label>
						<input type ='text' autocomplete="false" class ='trans'  name ='fname' placeholder = 'First Name' />
						<p id = 'error' style ='color:red'></p>
					</div>
					<div class ='field' style ='padding-right:0px'>
						<label style ='color:white;font-weight:100'>Lastname</label>
						<input type ='text' autocomplete="false" class ='trans' placeholder = 'Last name' name ='lname'/>
						<p id = 'error' style ='color:red'></p>
					</div>
				</div>
				<div class ='two fields'>
					<div class ='field' style ='padding-right:0px'>
						<label style ='color:white;font-weight:100'>Course</label>
						<input type ='text' autocomplete="off" class ='trans'  name ='course' placeholder = 'Course'/>
						<p id = 'error'style ='color:red'></p>
					</div>
					<div class ='field'>
						<label style ='color:white;font-weight:100'>Subject assigned</label>
						<input type ='text' autocomplete="off" class ='trans' name ='subject' placeholder ='Use subject code'>
					</div>
				</div>
				<div class ='two fields'>
					<div class ='field'>
						<input type ='submit' class ='ui button positive fluid' name ='btnSubmit' value = 'Check Schedules'/>
					</div>
					<div class ='field'>
						<input type ='submit' id ='registered' class ='ui button positive fluid' value = 'I already registered here.'/>
					</div>
				</div>
			</form>
			<form method ='POST' id ='reservedForm' style ='display:none' class ='ui large form'>
				@csrf
				<div class ='field'>
					<label style ='color:white;font-weight:100'>Enter your student number</label>
					<input type ='text' class ='trans' name ='studentnumber' placeholder ='Student number' REQUIRED autocomplete="off">
				</div>
				<div class ='two fields'>
					<div class ='field'>
						<input type ='submit' class ='ui button positive fluid' name ='btnReserveSubmit'>
					</div>
					<div class ='field'>
						<input type ='submit' class ='ui button positive fluid' id ='goback' value ='Go Back'/>
					</div>
				</div>
			</form>
		</div>
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

		$('#registered').click(function(e){
			e.preventDefault()
			$('#registered').attr('disabled',true)
			$('input[name=btnSubmit]').attr('disabled',true)
			$('#goback').attr('disabled',false)
			$('input[name=btnReserveSubmit]').attr('disabled',false)
			$('#registeredForm').hide()
			$('#reservedForm').show()
		})
		$('#goback').click(function(e){
			e.preventDefault()
			$('#goback').attr('disabled',true)
			$('input[name=btnReserveSubmit]').attr('disabled',true)
			$('#registered').attr('disabled',false)
			$('input[name=btnSubmit]').attr('disabled',false)
			$('#registeredForm').show()
			$('#reservedForm').hide()
		})
		$('form#registeredForm').submit(function(e){
			var valid = true
			$('form input').each(function(){
				if($(this).val() == ''){
					valid = false
					$(this).closest('div.field').addClass('error')
				}
			})
			if(!valid){
				e.preventDefault()
				$('#rightdesc').transition({
					animation: 'shake',
					duration: '1s',})	
			}
		})
	})
</script>