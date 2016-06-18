/**
 * Created by sulimo on 17/1/2016.
 */
angular.module('TradeUnion')
    .factory('Worker', function($resource) {
       return $resource('/worker/:id', null, {
           'update': { method: 'PUT' },
           'create': {
               url: '/worker/create',
               method: 'GET',
               isArray: true
           },
           max: {
               url: '/worker/max',
               method: 'GET'
           }
       });
    })
    .factory('Specialty', function($resource) {
        return $resource('/specialty/:id', null, {
            'update': { method: 'PUT' },
            'create': {
                url: '/specialty/create',
                method: 'GET',
                isArray: true
            }
        });
    })
    .factory('Enterprise', function($resource) {
        return $resource('/enterprise/:id', null, {
            'update': { method: 'PUT' },
            'create': {
                url: '/enterprise/create',
                method: 'GET',
                isArray: true
            }
        });
    });