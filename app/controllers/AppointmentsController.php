<?php

class AppointmentsController extends \BaseController {
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

        return Datatable::collection(Subscription::find(Sentry::getUser()->subscription_id)->appointment()->get()) //array('id','first','last','email','username','is_active')
            ->showColumns('confirmation_number', 'note','price_total','created_at')
            ->addColumn('status', function($model){
                switch($model->status){
                    case 0 :
                        return "Pending";
                        break;
                    case 1 :
                        return "Complete";
                        break;
                }

            })
            ->addColumn('action',function($model){
                return Theme::widget("buttonColumn", array("model" => $model,'route'=>'appointments'))->render();
            })
            ->searchColumns('confirmation_number', 'note','price_total')
            ->orderColumns('created_at')
            ->make();
    }
    /**
     * Display a tab form beckend Appointment Making.
     * GET /tab/app
     *
     * @return Response
     */
    public  function  tabAppService(){
        $theme = $this->theme;
        $model = Services::all();
        $data = array("data"=>$model);
        return $theme->layout('tab')->scope('appointments._tab_service',$data)->render();
    }
    public  function  tabAppCustomer(){
        $theme = $this->theme;
        $routeUrl = 'dt.customers.appointment';
        $theme->set('route','appointments');
        $columns = array('First Name','Last Name','Address','Action');

        $data = array("usersColumn" => $columns,'routeUrl'=>$routeUrl);
        return $theme->layout('tab')->scope('appointments._tab_customer',$data)->render();
    }

    public  function  tabAppCustomerView($id){

    }
    public  function  tabAppConfirm(){
        $theme = $this->theme;
        return $theme->layout('tab')->scope('appointments._tab_confirm')->render();
    }
    public function getAvailableTime($date,$data){
        $theme = $this->theme;
        $service = Services::find($data);
        $data = array('date'=>$date,'service'=>$service,'hour'=>Setting::get(Sentry::getUser()->subscription_id.'.app.bussinessHour'));
        return $theme->widget('timeAvailability',$data)->render();
    }
	/**
	 * Display a listing of the resource.
	 * GET /appointments
	 *
	 * @return Response
	 */
	public function index()
	{
        $theme = $this->theme;
        $theme->set('title','Appointments');
        $theme->set('route','appointments');
        $routeUrl = 'dt.appointments';
        $columns = array('Confirmation Number','Note','Total Price','Order Date', 'Status','Action');

        $data = array("usersColumn" => $columns,'routeUrl'=>$routeUrl);


        return $theme->scope('appointments.index',$data)->render();
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /appointments/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $theme = $this->theme;
        $theme->set('title','New Appointment');

        return $theme->layout('formApp')->scope('appointments.create')->render();
	}
    /**
     * Store a newly created resource in storage.
     * POST /api/services/checkout
     *
     * @return Response
     */
    public function storeAPI(){
        DB::beginTransaction();
        try{

            $serviceData = Input::json('services');

            $customerData = Input::json('customer');

            $customerType = "new";
            $paymentData = Input::json('payment');

            $confirmNumber = Str::upper(Str::quickRandom(3)).time() ;

            $customerId = "";

            if($customerType=="new"){
                $customer = new Customer();
                $customer->first = $customerData['first'];
                $customer->last = $customerData['last'];
                $customer->email = $customerData['email'];
                $customer->address_1 = $customerData['address_1'];

                $customer->address_2 = isset($customerData['address_2'])?$customerData['address_2']:"";

                $customer->zip = $customerData['zip'];

                $customer->subscription_id = Session::get('sid')[0];
                if(!$customer->save()){
                    DB::rollBack();
                    API::response()->array(array("failed"=>true,"flashMessage"=>"Create Appointment Error. Customer data wrong.","message"=>$e->getMessage()));
                }
                $customerId = $customer->id;
            }else{
                $customerId = $customerData;
            }
            $appointmentId = "";
            $appointment = new Appointment();

            $appointment->customer_id = $customerId;
            $appointment->confirmation_number = $confirmNumber;
            $appointment->price = $paymentData['price'];
            $appointment->price_tax = $paymentData['price_tax'];
            $appointment->price_deposit = $paymentData['price_deposit'];
            $appointment->price_total = $paymentData['price_total'];
            $appointment->note = isset($customerData['note'])?$customerData['note']:"";
            $appointment->subscription_id = Session::get('sid')[0];

            if(!$appointment->save()){
                DB::rollBack();
                API::response()->array(array("failed"=>true,"flashMessage"=>"Create Appointment Failed. Appointment data wrong entry.","message"=>$appointment->validationErrors));
            }else{
                $appointmentId = $appointment->id;
            }

            foreach($serviceData as $service){
                $serviceModel = new AppointmentService();
                $serviceModel->appointment_id = $appointmentId;
                $serviceModel->service_id = $service['id'];
                $serviceModel->date = $service['date'];
                $serviceModel->time = $service['time'];


                if(!$serviceModel->save()){
                    DB::rollBack();
                    API::response()->array(array("failed"=>true,"flashMessage"=>"Create Appointment Error. Appointment Service failed.","message"=>$appointment->validationErrors));
                }
            }
            DB::commit();
            Mail::send(Theme::uses('default')->layout('default')->which('emails.appointment'), array('firstname'=>$customer['first']), function($message){
                $message->to(Input::json('customer')['email'], Input::json('customer')['first'].' '.Input::json('customer')['last'])->subject('Appointment Created');
            });
            return API::response()->array(array("success"=>true,"flashMessage"=>"Create Appointment Success."));
        }catch (\Exception $e){
            DB::rollBack();
            return API::response()->array(array("failed"=>true,"flashMessage"=>"Create Appointment Error. Database error.","message"=>$e->getMessage()));
        }
    }
	/**
	 * Store a newly created resource in storage.
	 * POST /appointments
	 *
	 * @return Response
	 */
	public function store()
	{
        DB::beginTransaction();
        try{

            $serviceData = Input::get('serviceData');
            $customerData = Input::get('customerData');
            $customerType = Input::get('customerType');
            $paymentData = Input::get('paymentData');
            $services = explode("||",$serviceData);

            parse_str($paymentData, $paymentData);
            $confirmNumber = Str::upper(Str::quickRandom(3)).time() ;

            $customerId = "";

            if($customerType=="new"){
                parse_str($customerData, $customerData);
                $customer = new Customer();
                $customer->first = $customerData['first'];
                $customer->last = $customerData['last'];
                $customer->email = $customerData['email'];
                $customer->address_1 = $customerData['address_1'];
                $customer->address_2 = $customerData['address_2'];
                $customer->zip = $customerData['zip'];
                $customer->subscription_id = Sentry::getUser()->subscription_id;
                if(!$customer->save()){
                    DB::rollBack();
                    return \Response::json(array("failed"=>true,"flashMessage"=>"Create Appointment Error.","message"=>$e->getMessage()));
                }
                $customerId = $customer->id;
            }else{
                $customerId = $customerData;
            }
            $appointmentId = "";
            $appointment = new Appointment();

            $appointment->customer_id = $customerId;
            $appointment->confirmation_number = $confirmNumber;
            $appointment->price = $paymentData['price'];
            $appointment->price_tax = $paymentData['tax'];
            $appointment->price_deposit = $paymentData['deposit'];
            $appointment->price_total = $paymentData['priceTotal'];
            $appointment->note = $paymentData['note'];
            $appointment->subscription_id = Sentry::getUser()->subscription_id;

            if(!$appointment->save()){
                DB::rollBack();
                return \Response::json(array("failed"=>true,"flashMessage"=>"Create Appointment Failed.","message"=>$appointment->validationErrors));
            }else{
                $appointmentId = $appointment->id;
            }

            foreach($services as $service){
                $service = explode('##',$service);
                $serviceModel = new AppointmentService();
                $serviceModel->appointment_id = $appointmentId;
                $serviceModel->service_id = $service[0];
                $serviceModel->date = $service[2];
                $serviceModel->time = $service[3];


                if(!$serviceModel->save()){
                    DB::rollBack();
                    return \Response::json(array("failed"=>true,"flashMessage"=>"Create Appointment Error. Appointment Service failed.","message"=>$appointment->validationErrors));
                }
            }
            DB::commit();
            return \Response::json(array("success"=>true,"flashMessage"=>"Create Appointment Success."));
        }catch (\Exception $e){
            DB::rollBack();
            return \Response::json(array("failed"=>true,"flashMessage"=>"Create Appointment Error.","message"=>$e->getMessage()));
        }
	}

	/**
	 * Display the specified resource.
	 * GET /appointments/{id}
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
	 * GET /appointments/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $theme = $this->theme;
        //$theme->layout('form');
        $theme->set('title','Inspect Appointment');
        $model = Appointment::find($id);
        $services = $model->appointmentService;
        $employees = Subscription::find(Sentry::getUser()->subscription_id)->employee()->get();
        $arrEmployee = [""=>"Not Assign"];
        foreach($employees as $employee){
            $arrEmployee[$employee->id] = $employee->first." ".$employee->last;
        }
        $data = array("data"=>$model,"services"=>$services,"employee"=>$arrEmployee);

        return $theme->layout('form')->scope('appointments.edit',$data)->render();
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /appointments/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        DB::beginTransaction();
        try{
            $inputData = Input::get('formData');
            parse_str($inputData, $formFields);
            $model = Appointment::find($id);
            foreach($model->appointmentService as $service){
                $serviceModel = AppointmentService::find($service->id);
                if(isset($formFields['employee_id_'.$service->id])){
                    $serviceModel->employee_id =$formFields['employee_id_'.$service->id];
                    $serviceModel->save();
                }

            }
            DB::commit();
            return \Response::json(array("success"=>true,"flashMessage"=>"Update Appointment Success."));
        }catch (\Exception $e){
            DB::rollBack();
            return API::response()->array(array("failed"=>true,"flashMessage"=>"Create Appointment Error. Database error.","message"=>$e->getMessage()));
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /appointments/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}