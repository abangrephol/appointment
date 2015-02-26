angular.module('appSys.utils.service', [

    ])

    .factory('utils', function () {
        return {
            // Util for finding an object by its 'id' property among an array
            findById: function findById(a, id) {
                for (var i = 0; i < a.length; i++) {
                    if (a[i].id == id) return a[i];
                }
                return null;
            },
            findByDate: function findByDate(a,id){
                for (var i = 0; i < a.length; i++) {
                    if (a[i].date == id) return a[i];
                }
                return null;
            }

        };
    })
    .factory('filterApi',function(){
        return {
            filter: function filter(items,api){
                var tmp = [];
                for (var i = 0; i < items.length; i++) {
                    if (items[i].api == api){
                        tmp.push(items[i]);
                    }
                }
                return tmp;
            }
        }
    });