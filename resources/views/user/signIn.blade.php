

 @include('components.validationErrorMessage')

<form action="/user/sign-in" method="post">

  <div>
    <label for="email"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="email" value="{{old('email')}}" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit">Login</button>
    
    {!! csrf_field() !!}
  </div>
</form>