<div class="row mb10">
    <div class="col-xs-12">
        <a ui-sref="service.list" class="btn btn-black btn-sm mb20"><i class="fa fa-chevron-left mr5"></i>&nbsp;Back to services</a>
        <a ui-sref="service.calendar" class="btn btn-black btn-sm mb20"><i class="fa fa-calendar-o mr5"></i>&nbsp;My Calendar</a>
    </div>
</div>
<div class="row">
    <span class="text-center col-sm-12"><h2>Login</h2></span>
</div>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <form class="login_form" action="javascript:void(0);" method="get">
            <input ng-model="user.username" class="form-control" type="text" name="username" placeholder="Username or email">
            <input ng-model="user.password" class="form-control" type="password" name="password" placeholder="PASSWORD">
            <!--div class="clearfix">
                <div class="pull-left"><input type="checkbox" id="categorymanufacturer1"><label for="categorymanufacturer1">Keep me signed</label></div>
                <div class="pull-right"><a class="forgot_pass" href="javascript:void(0);">Forgot password?</a></div>
            </div-->
            <div class="center"><input type="submit" value="Login" ng-click="login(user)"></div>
        </form>
    </div>
</div>

<style>
    input[type="password"]{
        height: 50px;
        margin-bottom: 20px;
        width: 100%;
        padding: 10px;
        text-transform: none;
        font-family: 'Roboto', sans-serif;
        font-weight: 400;
        line-height: 20px;
        font-size: 11px;
        color: #666;
        font-style: normal;
        border-radius: 0;
        background: #fff;
        border: 2px solid #e9e9e9;
        box-shadow: none;
        transition: all 0.3s ease-in-out;
        -webkit-transition: all 0.3s ease-in-out;
    }
    input[type="text"]{
        text-transform: none !important;
    }
</style>