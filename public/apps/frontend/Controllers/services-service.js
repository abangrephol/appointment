angular.module('appSys.services.service', [

    ])
    .factory('services', ['$http', 'utils', function ($http, utils) {
        var path = config.apiPath+'services?apikey='+api_key;
        var contacts = $http.get(path).then(function (resp) {
            return resp.data;
        });

        var factory = {};
        factory.all = function () {
            return contacts;
        };
        factory.get = function (id) {
            return contacts.then(function(){
                return utils.findById(contacts, id);
            })
        };
        return factory;
    }])
    .factory('servicesLogin',['$http','$q',function($http,$q){
        return {
            login: function($scope,$state,user,pass){
                return $http({
                    method: 'POST',
                    url: config.apiPath+'services/login?apikey='+api_key,
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: {username:user,password:pass}
                })

            }
        }
    }])
    .factory('servicesScheduled', ['$http', 'utils','$rootScope', function ($http, utils,$rootScope) {
        var path = config.apiPath+'services/scheduled?type='+$rootScope.userType+'&id='+$rootScope.userLogged.id+'&apikey='+api_key;
        var servicesScheduled = $http.get(path).then(function (resp) {
            return resp.data;
        });

        var factory = {};
        factory.all = function () {
            return servicesScheduled;
        };
        factory.get = function (id) {
            return servicesScheduled.then(function(){
                return utils.findById(contacts, id);
            })
        };
        factory.getByDate = function (date) {
            return servicesScheduled.then(function(){
                return utils.findByDate(contacts, date);
            })
        };
        return factory;
    }])
    .factory('availableTime',['$http',function($http){
        var path = config.apiPath+''
    }])
    .factory('serviceCustomForm',['$http','$q',function($http,$q){
        return {
            getFields: function(id){
                //var deferred = $q.defer();
                return $http.get(config.apiPath+'services/customform/'+id+'?apikey='+api_key)

                //return deferred.promise;
            }
        }
    }])
    .factory('serviceData',['$http','$q',function($http,$q){
        return {
            getAvailable: function(id,date,time){
                //var deferred = $q.defer();
                return $http.get(config.apiPath+'services/available/'+id+'/'+date+'/'+time+'?apikey='+api_key)

                //return deferred.promise;
            }
        }
    }])
    .factory('serviceRes',['$http',function($http){
        return {
                save: function(data,customer,payment){
                    return $http({
                        method: 'POST',
                        url: config.apiPath+'services/checkout?apikey='+api_key,
                        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                        data: {services: data,customer:customer,payment:payment}
                    })
                }
            }
    }]);