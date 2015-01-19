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
    .factory('availableTime',['$http',function($http){
        var path = config.apiPath+''
    }]);