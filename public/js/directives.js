/**
 * Created by sulimo on 19/1/2016.
 */
angular.module('TradeUnion')
    .directive('datePicker', function () {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                element.datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            }
        };
    });