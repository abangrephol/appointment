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
                controller: ['$scope', '$state', 'services', 'utils','$localStorage','settingCur',
                    function (  $scope,   $state,   services , utils, $localStorage,settingCur) {
                        $scope.apikey = api_key;
                        $scope.services = services;
                        $scope.currency = settingCur;
                        $state.transitionTo('service.list');
                        $scope.$storage = $localStorage.$default({cart:[]});

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
                        templateUrl: config.server+'/api/angview/timeAvailable?apikey='+api_key,
                        controller: ['$scope', '$stateParams','$localStorage',
                            function (  $scope,   $stateParams ,$localStorage) {

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
                        template: "<div ng-show='cartAdded' class='mb20 text-success'>Successfull make an appointment. View <b><a ui-sref='service.cart'>Cart</a></b> to checkout.</div>"
                            +"<div class='row col-sm-12 mb20'><span class='well well-sm mr5 mb5'>Start time : {{ startTime }}</span>"
                            +"<span class='well well-sm mr5 mb5'>End time : {{ endTime }}</span></div>"
                            +"<div class='row col-sm-12'><a class='btn btn-sm' ng-click='makeAppointment()'>Make Appointment</a></div>",
                        controller: ['$scope','$stateParams','utils',
                            function($scope,$stateParams,utils){
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
                        controller: ['$scope','$stateParams','filterApi',
                            function($scope,$stateParams,filterApi){
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
                                }else{
                                    $scope.empty = true;
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