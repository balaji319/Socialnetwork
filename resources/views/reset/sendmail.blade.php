<div style="background-color:grey;margin:10px">
	<h2>Hi , {{$user->name}}</h2>
	<p>You are account has been created on Staff Collection So, Set your Password For Login </p>
	<p>You Need To <a href="{{url('sendEmailDone',['email'=>$user->email,'verifyToken'=>$user->verifyToken])}}">Click Here</a> </p>
</div>