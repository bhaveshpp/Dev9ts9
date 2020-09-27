define(
    [
        'Bhaveshpp_Dev9ts9/js/view/checkout/summary/cbm'
    ],
    function (Component) {
        'use strict';

        return Component.extend({
            /**
             * @override
             * use to define amount is display setting
             */
            isDisplayed: function () {
                return true;
            }
        });
    }
);