(function($) {

    $(document).ready(function($) {

        var WatchForChanges = {

            init: function (){
                var $watchers = $('.rodller-watch-for-changes');

                if(empty($watchers)){
                    return;
                }

                $watchers.each(this.initWatching)
            },

            initWatching: function (i, elem){
                var $elem = $(elem),
                    watchedElemClass = $elem.data('watch'),
                    forValue = $elem.data('hide-on-value'),
                    forValueSplitted = forValue.split(',');

                $('body').on('change', '.' + watchedElemClass, hideByValue);

                function hideByValue(){
                    var $this = $(this);

                    if(!$this.hasClass(watchedElemClass)){
                        $this = $('.' + watchedElemClass + ':checked, ' + '.' + watchedElemClass + ':checked');
                    }

                    if(empty($this)){
                        return false;
                    }

                    var val = $this.val();

                    if($.inArray(val, forValueSplitted) !== -1){
                        $elem.hide();
                        return true;
                    }

                    $elem.show();
                    return false;

                }

                hideByValue();
            }
        };

        WatchForChanges.init();

        var TitleShowHide = {

            init: function() {
                if (!$('body').hasClass('post-type-page')){
                    return;
                }

                setTimeout(this.addButtonToTitle, 1000);

                $('body').on('click', '.content-title-visibility', this.toggleShowHideButton);
            },

            addButtonToTitle: function() {
                console.log($('#rodller-hide_title').val());
                var $postTitleBlock = $( '.editor-post-title__block' ),
                    titleClass = $('#rodller-hide_title').val() === '1' ? 'show-content-title' : 'disable-content-title';

                if ( !empty($postTitleBlock) ) {

                    $postTitleBlock.append( '<button class="content-title-visibility ' + titleClass + '" aria-hidden="true"></button>' );
                }
            },

            toggleShowHideButton: function(  ) {
                var $this = $(this),
                    $hiddenMeta = $('#rodller-hide_title');

                if ($this.hasClass('disable-content-title') ){
                    $this.removeClass('disable-content-title');
                    $this.addClass('show-content-title');
                    $hiddenMeta.val(1);
                }else{
                    $this.removeClass('show-content-title');
                    $this.addClass('disable-content-title');
                    $hiddenMeta.val(0);
                }
            }
        };

        TitleShowHide.init();

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
    })

})(jQuery);