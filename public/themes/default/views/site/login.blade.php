<div class="signinpanel">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        {{ Form::open(array('route' => array('login'),'method'=>'POST')) }}
            <h4 class="nomargin">Sign In</h4>
            <p class="mt5 mb20">Login to access your account.</p>
            @if (Session::has('flash_error'))
            <div id="flash_error">{{ Session::get('flash_error') }}</div>
            @endif
            <input type="text" class="form-control uname" name="username" placeholder="Username">
            <input type="password" class="form-control pword" name="password" placeholder="Password">
            <a href=""><small>Forgot Your Password?</small></a>
            <button class="btn btn-success btn-block">Sign In</button>
        {{ Form::close() }}
    </div>
    <div class="col-sm-3"></div>
</div>
