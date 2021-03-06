$service = angular.module('appSys.services', [
        'ui.bootstrap','ui.router','ngStorage'
])

.config(['$stateProvider', '$urlRouterProvider',
    function ($stateProvider,   $urlRouterProvider) {
        $stateProvider
            .state('service',{

                url: '/',
                templateUrl: config.server+'/api/angview/index?apikey='+api_key,
                resolve: {
                    services: ['services',
                        function( services){
                            return services.all();

                        }
                    ],
                    settingDay: ['settingDay',
                        function( settingDay){
                            return settingDay.all();

                        }
                    ],
                    settingCur: ['settingCur',
                        function( settingCur){
                            return settingCur.all();

                        }
                    ]
                },
                controller: ['$scope', '$state', 'services', 'utils','$localStorage','settingCur','$rootScope',
                    function (  $scope,   $state,   services , utils, $localStorage,settingCur,$rootScope) {
                        $scope.apikey = api_key;
                        $scope.services = services;
                        $scope.currency = settingCur;
                        $state.transitionTo('service.list');
                        $scope.$storage = $localStorage.$default({cart:[]});
                        $rootScope.logged = false;
                    }]

            })
            .state('service.list',{

                url: 'list',
                views: {
                    "list" : {
                        templateUrl: config.server+'/api/angview/services?apikey='+api_key,
                        controller: ['$scope', '$state', 'services', 'utils',
                            function (  $scope,   $state,   services , utils) {
                                $scope.services = services;

                            }]

                    }
                }




            })
            .state('service.detail',{
                url: 'service/{id:[0-9]}',
                views: {
                    "list" : {
                        templateUrl: config.server+'/api/angview/serviceDetail?apikey='+api_key,
                        controller: ['$scope', '$stateParams', 'utils','settingDay',
                            function (  $scope,   $stateParams,   utils ,settingDay) {
                                $scope.service = utils.findById($scope.services, $stateParams.id);
                                $scope.bussinessHour = settingDay;
                                $scope.selectText = "date";
                            }]
                    }
                }

            })
            .state('service.detail.date',{
                url : '/{date}',
                views :{
                    "time" : {
                        resolve:{
                            serviceCustomForm: function(serviceCustomForm){
                                return serviceCustomForm
                            }
                        },
                        templateUrl: config.server+'/api/angview/timeAvailable?apikey='+api_key,
                        controller: ['$scope', '$stateParams','serviceCustomForm','$localStorage',
                            function (  $scope,   $stateParams,serviceCustomForm ,$localStorage) {
                                var getCustomForm = serviceCustomForm.getFields($scope.service.id);
                                getCustomForm.then(function(resp){
                                    $scope.forms = resp.data;
                                });
                                $scope.selectedTime = null;
                                $scope.$parent.selectText = "time";
                                $scope.selectedDate = $stateParams.date;
                                var businesshourData = $scope.bussinessHour;
                                var day = moment($stateParams.date);
                                var openHour='00:00',closeHour='00:00',open=false;
                                businesshourData.forEach(function(bhDay){
                                    if(day.format('ddd')==bhDay.day){
                                        openHour = bhDay.hourFrom;
                                        closeHour = bhDay.hourTo;
                                        open=true;
                                    }
                                });
                                var timeArray = [];
                                if(open){

                                    var start = moment($stateParams.date).hour(parseInt(openHour.split(':')[0])).minute(parseInt(openHour.split(':')[1]));
                                    var end = moment($stateParams.date).hour(parseInt(closeHour.split(':')[0])).minute(parseInt(closeHour.split(':')[1]));
                                    var timeProc = moment($stateParams.date).add(8, 'h').add(1,'s'),
                                        timeProcF = timeProc;

                                    while(timeProc.isAfter(start) && timeProcF.isBefore(end)){
                                        var disabled=false;
                                        if(timeProc.isBefore(moment()))
                                            disabled = true;
                                        timeArray.push({'time':timeProc.format('hh:mm A'),
                                            'disable':disabled,'data':timeProc.format('HH:mm'),
                                            'timeEnd':moment(timeProc).add($scope.service.interval,'m').format('hh:mm A')
                                        })
                                        timeProc.add($scope.service.interval,'m');
                                        timeProcF = moment(timeProc);
                                        timeProcF.add($scope.service.interval,'m');
                                    }
                                    $scope.timeArray = timeArray;

                                }else{

                                }
                                $scope.select = function(time){
                                    $scope.selectedTime = time;
                                }
                            }]
                    }
                }
            })
            .state('service.detail.date.time',{
                url : '/{time}',
                views : {
                    "make" : {
                        resolve:{
                            serviceData: function(serviceData){
                                return serviceData
                            }
                        },
                        templateUrl: config.server+'/api/angview/makeAppointment?apikey='+api_key,

                        controller: ['$scope','$stateParams','utils','serviceData',
                            function($scope,$stateParams,utils,serviceData){
                                var getData = serviceData.getAvailable($scope.service.id,$scope.selectedDate,$scope.selectedTime.data);
                                $scope.notAvailable = false;
                                getData.then(function(resp){
                                    if(resp.data.length>0)
                                    if(resp.data[0]['employee_left']==0)
                                    {
                                        $scope.notAvailable=true;

                                    }

                                });

                                $scope.cartAdded = false;
                                $scope.cartAdd= function(state){
                                    $scope.cartAdded = state;

                                }
                                $scope.startTime = $scope.selectedTime.time;
                                $scope.endTime =  $scope.selectedTime.timeEnd;
                                $scope.makeAppointment = function($element){
                                    var isInStorage = false;
                                    $scope.$storage.cart.forEach(function(cartItem){

                                        if(cartItem.id == $scope.service.id && cartItem.date==$scope.selectedDate && api_key==cartItem.api){
                                            isInStorage = true;
                                            cartItem.date = $scope.selectedDate;
                                            cartItem.time = $scope.selectedTime.data;
                                        }
                                    });
                                    if(!isInStorage){
                                        $scope.selectedService = utils.findById($scope.services, $scope.service.id);
                                        $scope.$storage.cart.push({
                                            api: api_key,
                                            id : $scope.service.id,
                                            date: $scope.selectedDate,
                                            dateFormat: moment($scope.selectedDate).format('dddd, DD MMMM YYYY'),
                                            time: $scope.selectedTime.data,
                                            timeStart : $scope.startTime,
                                            timeEnd : $scope.endTime,
                                            service :{
                                                name: $scope.selectedService.name,
                                                price: $scope.selectedService.price
                                            }

                                        });
                                    }

                                    $scope.cartAdd(true);
                                }
                            }
                        ]
                    }
                }
            })
            .state('service.cart',{
                url : 'cart',
                views : {
                    'list': {
                        templateUrl: config.server+'/api/angview/cart?apikey='+api_key,
                        resolve:{
                            serviceRes: function(serviceRes){
                                return serviceRes
                            }
                        },
                        controller: ['$scope','$stateParams','filterApi','serviceRes',
                            function($scope,$stateParams,filterApi,serviceRes){
                                $scope.carts = filterApi.filter($scope.$storage.cart,$scope.apikey);
                                $scope.empty = false;
                                if($scope.carts.length>0){
                                    $scope.servicesPrice = 0;
                                    $scope.carts.forEach(function(item){
                                        $scope.servicesPrice += parseInt(item.service.price) ;
                                    })
                                    $scope.tax = Number($scope.servicesPrice * 0.1).toFixed(2);
                                    $scope.totalPrice = Number($scope.servicesPrice + ($scope.servicesPrice * 0.1)).toFixed(2);
                                    $scope.totalDeposit = Number($scope.servicesPrice * 0.2).toFixed(2);
                                    $scope.payment = {
                                        price : $scope.servicesPrice,
                                        price_tax : $scope.tax,
                                        price_deposit : $scope.totalDeposit,
                                        price_total : $scope.totalPrice
                                    };
                                }else{
                                    $scope.empty = true;
                                }
                                $scope.submit = function(customer){
                                    serviceRes.save($scope.carts,customer,$scope.payment)
                                        .success(function(data){
                                            $scope.$state.transitionTo('service.checkout');
                                        })
                                        .error(function(data){
                                            console.log('Error');
                                        })
                                }
                            }
                        ]
                    }
                }
            })
            .state('service.checkout',{
                url: 'checkout',
                views : {
                    'list':{
                        templateUrl: config.server+'/api/angview/checkout?apikey='+api_key,
                        controller: ['$scope','$stateParams','$localStorage',
                            function($scope,$stateParams,$localStorage){
                                $localStorage.$reset({cart:[]});
                            }
                        ]
                    }
                }
            })

            .state('service.calendar',{
                url: 'calendar',
                views: {
                    'list' : {
                        resolve:{
                            servicesScheduled: ['servicesScheduled',
                                function( servicesScheduled){
                                    return servicesScheduled.all();
                                }
                            ]
                        },
                        templateUrl: config.server+'/api/angview/calendar?apikey='+api_key,
                        controller: ['$scope','$state','$stateParams','servicesScheduled','$rootScope',
                            function($scope,$state,$stateParams,servicesScheduled,$rootScope){
                                if($rootScope.logged){
                                    $scope.dt = new Date();
                                    servicesScheduled.forEach(function(item){
                                        item.datetime = moment(item.date+" "+item.time).format('dddd, DD MMMM YYYY')
                                            +" at "+moment(item.date+" "+item.time).format('hh:mm A');
                                    })
                                    $scope.scheduled = servicesScheduled;
                                }
                                else
                                    $state.go('service.login');
                            }
                        ]
                    }
                }
            })
            .state('service.login',{
                url: 'login',

                views: {
                    'list' : {
                        templateUrl: config.server+'/api/angview/login?apikey='+api_key,
                        resolve:{
                            servicesLogin: function(servicesLogin){
                                return servicesLogin
                            }
                        },
                        controller: ['$scope','$state','$stateParams','servicesLogin','$timeout','$rootScope',
                            function($scope,$state,$stateParams,servicesLogin,$timeout,$rootScope){
                                if($rootScope.logged)
                                    $state.transitionTo('service.calendar');

                                $scope.login = function(user){
                                    var log = servicesLogin.login($scope,$state,user.username,user.password);
                                    log.then(function(resp){
                                        if(resp.data.status=="success"){
                                            $timeout(function() {
                                                $rootScope.userType = resp.data.type;
                                                $rootScope.userLogged = resp.data.data;
                                                $rootScope.logged = true;
                                                $scope.$apply();
                                                $state.transitionTo('service.calendar');
                                            });
                                        }else{
                                            alert(resp.data.message);
                                        }

                                    })
                                }
                            }
                        ]
                    }
                }
            })

    }
]);
$service.controller('datepicker', function ($scope,$state) {
    var days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
    $scope.today = function() {
        $scope.dt = new Date();
    };
    $scope.today();

    $scope.clear = function () {
        $scope.dt = null;
    };
    $scope.selects = function(date){
        var selectedDate = moment(date).format('YYYY-MM-DD');
        $state.go('service.detail.date',{date:selectedDate});

    };
    // Disable weekend selection
    $scope.disabled = function(date, mode) {
        var isDisable=true;
        for(var i = 0 ; i < $scope.bussinessHour.length; i++){
            if(days[date.getDay()]==$scope.bussinessHour[i].day){
                isDisable = false;
            }
        }
        return ( mode === 'day' && isDisable );
    };

    $scope.toggleMin = function() {
        $scope.minDate = $scope.minDate ? null : new Date();
    };
    $scope.toggleMin();

    $scope.open = function($event) {
        $event.preventDefault();
        $event.stopPropagation();

        $scope.opened = true;
    };

    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
    };

    $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
    $scope.format = $scope.formats[0];
});