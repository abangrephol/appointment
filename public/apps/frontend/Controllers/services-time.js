angular.module('appSys.services.service', [

    ])
    .factory('services', ['$http', 'utils', function ($http, utils) {
        var path = config.server+'/api/services/time';
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
    }]);