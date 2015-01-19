//jQuery(window).load(function(){
    var app = angular.module('appSys',['ui.router','ngAnimate','ngStorage','appSys.services','appSys.services.service','appSys.utils.service','appSys.settings']);

    app.run(
        ['$rootScope', '$state', '$stateParams',
            function ($rootScope,   $state,   $stateParams) {
                $rootScope.$state = $state;
                $rootScope.$stateParams = $stateParams;
            }
        ]
    )

    app.config(['$stateProvider', '$urlRouterProvider','$locationProvider',
        function ($stateProvider, $urlRouterProvider, $locationProvider){
            $locationProvider.hashPrefix('!');
            $urlRouterProvider
                .otherwise('/');

        }]
    );

//});