@component('mail::message')

   <div class="c">
    <img style="text-align: center;" src="{{config('app.url')}}logo.png" >
   </div>

<h1> Hello, {{$data['name']}} </h1>

<p style="color: black;">
    Welcome to Oasis Football Scouting, use the Code below to verify your email.
</p>

    
<center><h1 class="text-align: center;"> {{$data['otp']}} </h1></center>

<p style="color: black;">
    If you have any complaints please contact our support.
</p>

@endcomponent
