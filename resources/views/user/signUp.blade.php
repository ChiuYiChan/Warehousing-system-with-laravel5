

@include('components.validationErrorMessage')

<form action="/user/sign-up" method="post">
  <div>
    <!--<input type="hidden" name="_token" value="{{csrf_token()}}">-->
    {!! csrf_field() !!}

    <label for="uname"><b>Email</b></label>
    <input type="text" placeholder="Enter Username" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit">register</button>

  </div>
</form>