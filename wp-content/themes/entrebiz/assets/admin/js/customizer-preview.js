(function ($) {

    "use strict";

    $(document).ready(function () {

        var rodller_ShortcutIconTitle = {
            init: function () {

                $('body').on('mouseenter', '.customize-partial-edit-shortcut-button', this.hoverIn);
                $('body').on('mouseleave', '.customize-partial-edit-shortcut-button', this.hoverOut);
            },

            hoverIn: function () {
                var $this = $(this),
                    $parent = $this.parent(),
                    parentClasses = $parent.attr('class'),
                    parentClassesArray = parentClasses.split('-'),
                    controlClassSufix = parentClassesArray[parentClassesArray.length-1],
                    $helper = $parent.find('.rodller_shortcut_helper');


                if(empty(controlClassSufix)){
                    return false;
                }

                if(!empty($helper)){
                    $helper.fadeIn(200);
                    return;
                }

                var $customizerControl = $(parent.document).find('#customize-control-' + controlClassSufix),
                    $controlTitle = $customizerControl.siblings('.customize-section-description-container.section-meta'),
                    $sectionTitle = $controlTitle.find('.customize-section-title > h3');

                if(!empty($sectionTitle)){
                    var text = $sectionTitle.getCurrentElementText().trim();
                    rodller_ShortcutIconTitle.createHelper($parent, text);
                    return true;
                }

                rodller_ShortcutIconTitle.createHelper($parent, $this.attr('title'));
            },

            hoverOut: function (){
                var $this = $(this),
                    $parent = $this.parent(),
                    $helper = $parent.find('.rodller_shortcut_helper');

                if(empty($helper)){
                    return false;
                }

                $helper.fadeOut(200);
            },

            createHelper: function ($appendTo, content){
                var orientation = rodller_ShortcutIconTitle.checkHelperOrientation($appendTo, 200);
                $appendTo.append('<span class="rodller_shortcut_helper ' + orientation + '" style="display: none">' + content + '</span>');
                $appendTo.find('.rodller_shortcut_helper').fadeIn(200);
            },
            
            checkHelperOrientation: function ($parent, offset){
                var windowWidth = $( window ).width(),
                    elementPosition = $parent.position().left + offset;

                return (windowWidth < elementPosition) ? "rodller_orientation_left" : "rodller_orientation_right";
            }
        };

        rodller_ShortcutIconTitle.init();

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

        $.fn.getCurrentElementText = function () {

            var text =$(this).clone().children().remove().end().text();

            if(empty(text)){
                return '';
            }

            return text;
        };

    });

})(jQuery);

