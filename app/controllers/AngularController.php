<?php

class AngularController extends \BaseController {
    protected $layout = 'angularView';
    protected $themes = "default";
    /**
     * Display a listing of the resource.
     * GET /apis
     *
     * @return Response
     */
    public function index()
    {
        $theme = $this->theme;
        return $theme->scope('frontend.index')->render();
    }
    public function services(){
        $theme = $this->theme;
        return $theme->scope('frontend.service')->render();
    }
    public function serviceDetail(){
        $theme = $this->theme;
        return $theme->scope('frontend.serviceDetail')->render();
    }
    public function timeAvailable(){
        $theme = $this->theme;
        return $theme->scope('frontend.timeAvailable')->render();
    }
    public function cart(){
        $theme = $this->theme;
        return $theme->scope('frontend.cart')->render();
    }
    public function checkout(){
        $theme = $this->theme;
        return $theme->scope('frontend.checkout')->render();
    }
}