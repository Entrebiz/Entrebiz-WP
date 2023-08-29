(function (wp, $) {

    "use strict";

    var rodller_DynamicSidebars = {

        init: function () {
            $('body').on('row:update', '.repeater-row', this.displayReloadMessage);
            $('body').on('row:remove', '.repeater-row', this.displayReloadMessage);

        },

        displayReloadMessage: function () {

            var $sidebars = $('#customize-control-rodller_sidebars');

            if(!empty($sidebars.find('.notice'))){
                return;
            }

            $sidebars.append('<br><p class="notice notice-info is-dismissible">' + rodller_translation.sidebar_change_notice + '</p>');
        }
    };

    $(document).ready(function () {
        rodller_DynamicSidebars.init();
    });

    /**
     * Checks if variable is empty or not
     *
     * @param variable
     * @returns {boolean}
     */
    function empty(variable) {

        if (typeof variable === 'undefined') {
            return true;
        }

        if (variable === 0 || variable === '0') {
            return true;
        }

        if (variable === null) {
            return true;
        }

        if (variable.length === 0) {
            return true;
        }

        if (variable === "") {
            return true;
        }

        if (variable === false) {
            return true;
        }

        if (typeof variable === 'object' && $.isEmptyObject(variable)) {
            return true;
        }

        return false;
    }

})(wp, jQuery);

