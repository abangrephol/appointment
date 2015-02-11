<?php

class SiteController extends \BaseController {
    protected $layout = 'default';
    protected $themes = "default";


    /**
     * Display a listing of the resource.
     * GET /users
     *
     * @return Response
     */
    public function index()
    {
        //
        $theme = $this->theme;
        return $theme->scope('site.index')->render();
    }
    public function dashboard()
    {
        $theme = $this->theme;
        $theme->layout('panelDashboard');
        return $theme->scope('site.index')->render();
    }
    public function login()
    {
        //if(Auth::check()){
        //    return Redirect::to('/');
        //}else{
            $theme = $this->theme;
            $theme->layout('auth');
            return $theme->scope('site.login')->render();
        //}

    }
    public function iframe(){
        $theme = $this->theme;
        $theme->layout('iframe') ;
        return $theme->scope('site.index')->render();
    }
    public  function setting(){
        $theme = $this->theme;
        $theme->layout('form');
        $theme->set('title','Settings');
        return $theme->scope('site.setting')->render();
    }
    public  function settingGeneral(){
        $theme = $this->theme;
        return $theme->layout('tab')->scope('site.settingGeneral')->render();
    }
    public  function settingHour(){
        $theme = $this->theme;
        $data = array('hour'=>Setting::get(Sentry::getUser()->subscription_id.'.app.bussinessHour'));
        return $theme->layout('tab')->scope('site.settingBusinessHour',$data)->render();
    }

    public function frontend_index(){
        $theme = $this->theme;
        $theme->layout('frontend.default');
        $data = array('services'=>Services::all());
        return $theme->scope('frontend.index',$data)->render();
    }
    public function frontend(){
        $theme = $this->theme;
        $theme->layout('angular');
        return $theme->scope('frontend.angular')->render();
    }
    public function feScript(){
        $theme = $this->theme;
        $theme->layout('appsys');
        return $theme->scope('frontend.angular')->render();
    }
    /**
     * Show the form for creating a new resource.
     * GET /users/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /users
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /users/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /users/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /users/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /users/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        return 'oke';
    }

}