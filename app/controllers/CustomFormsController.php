<?php

class CustomFormsController extends \BaseController {
    protected $layout = 'panel';
    protected $themes = "default";
    /**
     * Display a listing of the resource.
     * GET /dt/users
     *
     * @return Response
     */
    public function getDatatableAll()
    {

        return Datatable::collection(Subscription::find(Sentry::getUser()->subscription_id)->customform) //array('id','first','last','email','username','is_active')
            ->showColumns('first', 'last','email')
            ->addColumn('active', function($model){
                if($model->is_active)
                    return 'Active';
                else
                    return 'Not Active';
            })
            ->addColumn('action',function($model){
                return Theme::widget("buttonColumn", array("model" => $model,'route'=>'customform'))->render();
            })
            ->searchColumns('first','last','email','active')
            ->orderColumns('id','first','last','email','active')
            ->make();
    }
    /**
     * Display a listing of the resource.
     * GET /employees
     *
     * @return Response
     */
    public function index()
    {
        $theme = $this->theme;
        $theme->set('title','Custom Forms');
        $theme->set('route','customform');
        $routeUrl = 'dt.customforms';
        $columns = array('First Name','Last Name', 'Email' ,'Status','Action');

        $data = array("usersColumn" => $columns,'routeUrl'=>$routeUrl);


        return $theme->scope('custom_forms.index',$data)->render();
    }

    /**
     * Show the form for creating a new resource.
     * GET /employees/create
     *
     * @return Response
     */
    public function create()
    {
        $theme = $this->theme;
        $theme->set('title','New Custom Form');

        return $theme->layout('form')->scope('custom_forms.create')->render();
    }

    /**
     * Store a newly created resource in storage.
     * POST /employees
     *
     * @return Response
     */
    public function store()
    {

        try{

            $inputData = Input::get('formData');
            parse_str($inputData, $formFields);
            $model = new CustomForm();


            $validator = Validator::make($formFields,CustomForm::$rulesCreate);
            if($validator->passes()){
                $model->name = $formFields['name'];
                $model->description = $formFields['description'];
                $model->subscription_id = Sentry::getUser()->subscription_id;
                if($model->save())
                    return \Response::json(array("success"=>true,"flashMessage"=>"Create Custom Form Success."));
                else
                    return \Response::json(array("failed"=>true,"flashMessage"=>"Create Custom Form Failed.","message"=>$model->validationErrors));
            }else{
                return \Response::json(array("failed"=>true,"flashMessage"=>"Create Custom Form Failed.","message"=>$validator->getMessageBag()->toArray()));
            }
        }catch (\Exception $e){
            return \Response::json(array("failed"=>true,"flashMessage"=>"Create Custom Form Failed.","message"=>$e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     * GET /employees/{id}
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
     * GET /employees/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $theme = $this->theme;
        //$theme->layout('form');
        $theme->set('title','Edit Employee');
        $model = Employee::find($id);
        $data = array("data"=>$model);

        return $theme->layout('form')->scope('employees.edit',$data)->render();
    }

    /**
     * Update the specified resource in storage.
     * PUT /employees/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        try{

            $inputData = Input::get('formData');
            parse_str($inputData, $formFields);
            $model = Employee::find($id);
            $specializes = explode(',',$formFields['specialize']);
            foreach($specializes as $special){
                if(Specialize::where('specialize',$special)->get()->count()==0){
                    $newSpecialize = new Specialize();
                    $newSpecialize->subscription_id = Sentry::getUser()->subscription_id;
                    $newSpecialize->specialize = $special;
                    $newSpecialize->save();
                }
            }
            $validator = Validator::make($formFields,Employee::$rulesUpdate);
            if($validator->passes()){
                $model->first = $formFields['first'];//Input::get('first');
                $model->last = $formFields['last'];//Input::get('last');
                $model->email = $formFields['email'];//Input::get('email'); ;
                $model->title = $formFields['title'];//Input::get('username');
                $model->phone = $formFields['phone'];
                $model->phone_ext = $formFields['phone_ext'];
                $model->specialize = $formFields['specialize'];

                if(isset($formFields['is_active']))
                    $model->is_active = $formFields['is_active'];
                else
                    $model->is_active = 0;

                if($model->save())
                    return \Response::json(array("success"=>true,"flashMessage"=>"Update Success."));
                else
                    return \Response::json(array("failed"=>true,"flashMessage"=>"Update Failed.","message"=>$model->validationErrors));
            }else{
                return \Response::json(array("failed"=>true,"flashMessage"=>"Update Failed.","message"=>$validator->getMessageBag()->toArray()));
            }
        }catch (\Exception $e){
            return \Response::json(array("failed"=>true,"flashMessage"=>"Update Failed.","message"=>$e->getMessage()));
        }
    }
    public  function delete($id){
        $theme = $this->theme;
        $model = Employee::find($id);
        $data = $model->toArray();

        return $theme->partial('deleteModal',array('data'=>$data,'route'=>'employee'));
    }
    /**
     * Remove the specified resource from storage.
     * DELETE /employees/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $model = Employee::find($id);
        $delete = $model->delete();
        if ($delete) {
            return \Response::json(array('success'=>true));
        }else{
            return \Response::json(array('failed'=>true));
        }
    }


}