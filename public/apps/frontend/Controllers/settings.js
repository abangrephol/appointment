angular.module('appSys.settings', [

    ])
    .factory('settingDay', ['$http', 'utils', function ($http, utils) {
        var path = config.server+'/api/setting/days?apikey='+api_key;
        var settings = $http.get(path).then(function (resp) {
            return resp.data;
        });

        var factory = {};
        factory.all = function () {
            return settings;
        };
        factory.get = function (id) {
            return settings.then(function(){
                return utils.findById(settings, id);
            })
        };
        return factory;
    }])
    .factory('settingCur', ['$http', 'utils', function ($http, utils) {
        var path = config.server+'/api/setting/currency?apikey='+api_key;
        var settings = $http.get(path).then(function (resp) {
            return resp.data;
        });

        var factory = {};
        factory.all = function () {
            return settings;
        };
        factory.get = function (id) {
            return settings.then(function(){
                return utils.findById(settings, id);
            })
        };
        return factory;
    }]);