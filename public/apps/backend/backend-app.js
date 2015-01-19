(function(angular) {
    'use strict';
    var app = angular.module('bApp', ['ngRoute']);
    app.controller('MainCtrl',function($scope, $route, $routeParams, $location,$http){
        $scope.$route = $route;
        $scope.$location = $location;
        $scope.$routeParams = $routeParams;
        $scope.$http = $http;
        $scope.loadPage = function($scope){
            $scope.$http.get($scope.$location.path())
                .success(function(result){
                    jQuery('.contentpanel > div > div > .panel').hide().html(result).fadeIn('slow');
                })
        }
    });
    app.controller('AppointmentCtrl',function($scope,$routeParams){
        $scope.loadPage($scope);
    });
    app.config(function($routeProvider,$locationProvider){
        $locationProvider.hashPrefix('!');
        $routeProvider
            .when('/app',{
                template : 'Loading',
                controller: 'AppointmentCtrl'
            })
            .when('/service',{
                template : 'Loading {{1}}',
                controller: 'AppointmentCtrl'
            })
            .otherwise({
                redirectTo : '/'
            });

    });

})(window.angular);