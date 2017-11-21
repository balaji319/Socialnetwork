	@extends('profile.master')

@section('content')

<div class="col-md-12">
    <div class="row" style="padding:10px">
		<div class="col-md-3 left-sidebar hidden-xs hidden-sm">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="col-md-6">
						<h4 align="center" style="margin-left: -78px; margin-top: 12px;">Messenger</h4>
					</div>
					<div class="col-md-6">
						<a href="{{url('/newMessage')}}">
	           			  <img src="{{url('../')}}/images/compose.jpg" style="margin-top: 4px;" title="Send New Messages" height="40px" class="pull-right" >
	           		    </a>
					</div>
					<hr>
				</div>
					<div  class="panel-body">		
						<ul v-for="privatemsg in privatemesgs">
					<!-- If user read msg it's status 1 -->
						  <li v-if="privatemsg.status == 1" @click="messages(privatemsg.id)" style="list-style:none; margin-top:10px; background-color:#F3F3F3;    width: 100%;" class="row">
						  	 <div class="col-md-3 pull-left">
					             <img :src="'{{url('../')}}/images/'+privatemsg.image"
					           style="width:50px; border-radius:100%; margin:5px; height: 43px;">
					         </div>
							  <div class="col-md-9 pull-left" style="margin-top:5px">
						          <b> @{{privatemsg.name}}</b><br>
						          <small>Gender: @{{privatemsg.gender}}</small>
						      </div>							
						</li>
						<!-- If user unread msg it's status 0 -->
						  <li v-else @click="messages(privatemsg.id)" style="list-style:none; margin-top:10px; background-color:white;    width: 100%;" class="row">
						  	 <div class="col-md-3 pull-left">
					             <img :src="'{{url('../')}}/images/'+privatemsg.image"
					           style="width:50px; border-radius:100%; margin:5px">
					         </div>
							  <div class="col-md-9 pull-left" style="margin-top:5px">
						          <b> @{{privatemsg.name}}</b><br>
						          <small>Gender: @{{privatemsg.gender}}</small>
						      </div>							
						</li>    
					</ul>
				</div>
			</div>
		</div>

	<div class="col-md-6 left-sidebar hidden-xs hidden-sm">
		<div class="panel panel-default">
			 <div class="panel-heading"> 
			 	<h3 align="center">Messages</h3>
			 </div>
			 <div class="panel-body">		 	
				<div v-for="msg in usermessages">
					<div v-if="msg.user_from == <?php echo Auth::user()->id; ?>">
						<div class="col-md-12">
							<img :src="'{{url('../')}}/images/'+ msg.image" width="45px"  class="img-circle pull-right msg_img">
							<div class="col-md-5 user1">
								 @{{msg.msg}}

							</div>
						</div>
					 </div>
					<div v-else>
						<div class="col-md-12" style="margin-top:10px">
							<img :src="'{{url('../')}}/images/'+ msg.image" width="45px"  class="img-circle pull-left msg_img">
							<div class="col-md-5  user2">
							@{{msg.msg}}
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" v-model="conID">
				<textarea class="col-md-12 form-control textmsgarea" rows="3" cols="119" v-model="msgFrom" @keydown="inputHandler" placeholder="Send Message"></textarea>
			 </div>
		</div>
	</div> 


	<div class="col-md-3 left-sidebar hidden-xs hidden-sm">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 align="center">User Info</h3>
			</div>
			<div  class="panel-body">		
				
			</div>
		</div>
	</div>



</div>


@endsection