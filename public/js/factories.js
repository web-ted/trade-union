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
           }
       });
    });