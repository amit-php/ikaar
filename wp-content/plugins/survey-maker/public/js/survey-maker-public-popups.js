(function($) {
    'use strict';

    function AysSurveyPopupsPlugin(element, options){
        this.el = element;
        this.$el = $(element);
        this.htmlClassPrefix = 'ays-survey-';
        this.ajaxAction = 'ays_survey_ajax';
        this.dbOptions = undefined;
        this.popupId = undefined;
        this.confirmBeforeUnload = false;

        this.init();

        return this;
    }

    AysSurveyPopupsPlugin.prototype.init = function() {
        var _this = this;

        _this.popupId = _this.$el.data('id');
        
        if( typeof window.aysSurveyPopupsOptions != 'undefined' ){
            _this.dbOptions = JSON.parse( atob( window.aysSurveyPopupsOptions[ _this.popupId ] ) );
        }
        
        _this.setEvents();
    };

    AysSurveyPopupsPlugin.prototype.setEvents = function(e){
        var _this = this;

        _this.popupSelectorClick( _this.$el, _this);

        var closeByEsc = typeof _this.dbOptions.popupEnableCloseByEsc != 'undefined' && _this.dbOptions.popupEnableCloseByEsc == 'on' ? true : false;

        _this.$el.on('click', '.' + _this.htmlClassPrefix + 'popup-btn-close', function(e){
            _this.$el.css('display', 'none');

            var hidePopupAfterClick = typeof _this.dbOptions.hidePopupAfterClose != 'undefined' && _this.dbOptions.hidePopupAfterClose == 'on' ? true : false;
            if(hidePopupAfterClick){
                _this.setPopupCookie("ays_survey_popup_hide_after_click_close_"+_this.popupId+"", 1, 365);
            }

            if (document.fullscreenElement) {
                _this.aysSurveyFullScreenWindowDeactivator();
            }
        });

        _this.$el.on('click', 'input.' + _this.htmlClassPrefix + 'finish-button', function(){
            var hidePopupAfterSubmit = typeof _this.dbOptions.hidePopup != 'undefined' && _this.dbOptions.hidePopup == 'on' ? true : false;
            var closePopupAfterFinish = typeof _this.dbOptions.enable_popup_close_after_finish != 'undefined' && _this.dbOptions.enable_popup_close_after_finish ? true : false;
            
            if(closePopupAfterFinish){
                var closePopupAfterFinishDelay = typeof _this.dbOptions.popup_close_after_finish_delay != 'undefined' && _this.dbOptions.popup_close_after_finish_delay  != '' ? _this.dbOptions.popup_close_after_finish_delay : 0;
                _this.$el.attr('data-close-popup' , true);
                _this.$el.attr('data-close-popup-delay' , closePopupAfterFinishDelay);
            }

            if( hidePopupAfterSubmit ){
                var aysHasError = $(this).parents('.ays-survey-sections').find('.ays-has-error');
                if(aysHasError.length == 0){
                    $.ajax({
                        url: aysSurveyMakerPopupsAjaxPublic.ajaxUrl,
                        method: 'post',
                        dataType: 'json',
                        data: {
                            action: _this.ajaxAction,
                            function: 'ays_survey_popup_set_cookie',
                            id: _this.popupId,
                        }
                    });
                }
            }
        });
        
        _this.$el.find('.ays-survey-popup-close-full-screen, .ays-survey-popup-open-full-screen').on('click', function() {
            _this.toggleFullscreen(_this.el);
        });

        if(closeByEsc){
            $(document).on('keydown', function(event) { 
                if (event.keyCode == 27) {                                    
                    _this.$el.find('.' + _this.htmlClassPrefix + 'popup-btn-close').trigger('click');
                }
            });
        }

        _this.aysSurveyFullScreenDeactivateAll();

    }
    
    AysSurveyPopupsPlugin.prototype.toggleFullscreen = function (elem) {
        var _this = this;
        elem = elem || document.documentElement;
        if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {
            _this.aysSurveyFullScreenActivate( elem );
            _this.aysSurveyFullScreenWindowActivator( elem );
        }else{
            _this.aysSurveyFullScreenDeactivate( elem );
            _this.aysSurveyFullScreenWindowDeactivator();
        }
    }

    AysSurveyPopupsPlugin.prototype.aysSurveyFullScreenActivate = function (elem) {
        $(elem).find('.ays-survey-popup-full-screen-mode .ays-survey-popup-close-full-screen').css({'display':'inline'});
        $(elem).find('.ays-survey-popup-full-screen-mode .ays-survey-popup-open-full-screen').css('display','none');
        $(elem).find('.ays-survey-popup-full-screen-mode').css({'padding-right':'25px'});
        $(elem).find('.ays-survey-popup-btn-close').css({'top':'0','right' : '0'});
        $(elem).css({'overflow':'auto'});
    }

    AysSurveyPopupsPlugin.prototype.aysSurveyFullScreenDeactivate = function (elem) {
        $(elem).find('.ays-survey-popup-full-screen-mode .ays-survey-popup-open-full-screen').css({'display':'inline'});
        $(elem).find('.ays-survey-popup-full-screen-mode .ays-survey-popup-close-full-screen').css('display','none');        
        $(elem).find('.ays-survey-popup-full-screen-mode').css({'padding-right':'0'});
        $(elem).find('.ays-survey-popup-btn-close').css({'top':'-16px','right' : '-16px'});
        $(elem).css({'overflow':'initial'});
    }

    AysSurveyPopupsPlugin.prototype.aysSurveyFullScreenDeactivateAll = function (elem) {
        var _this = this;
        document.addEventListener('fullscreenchange', function(event) {
            if (!document.fullscreenElement) {
                var eventTarget = event.target;
                if( $( eventTarget ).hasClass('ays-survey-popup-survey-window') ){
                    _this.aysSurveyFullScreenDeactivate( eventTarget );
                }
            }
        }, false);
    }

    AysSurveyPopupsPlugin.prototype.aysSurveyFullScreenWindowActivator = function (elem) {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        }else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        }else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        }else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    }

    AysSurveyPopupsPlugin.prototype.aysSurveyFullScreenWindowDeactivator = function () {
        if(document.exitFullscreen) {
            document.exitFullscreen();
        }else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        }else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        }
    }

    AysSurveyPopupsPlugin.prototype.popupSelectorClick = function (elem, _this) {
        var popupTriggerType = _this.dbOptions.popup_trigger;
        var popupSelector = _this.dbOptions.popup_selector;

        if(popupTriggerType == 'on_click'){

            $(document).find(popupSelector).on('click', function(){

                elem.css('display','block');
                
            });
        }
    }

    AysSurveyPopupsPlugin.prototype.setPopupCookie = function (name, value, daysToExpire) {
        var date = new Date();
        date.setTime(date.getTime() + (daysToExpire * 24 * 60 * 60 * 1000));
        var expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + "; " + expires + "; path=/";
    }

    $.fn.AysSurveyMakerPopups = function(options) {
        return this.each(function() {
            if (!$.data(this, 'AysSurveyMakerPopups')) {
                $.data(this, 'AysSurveyMakerPopups', new AysSurveyPopupsPlugin(this, options));
            } else {
                try {
                    $(this).data('AysSurveyMakerPopups').init();
                } catch (err) {
                    console.error('AysSurveyMakerPopups has not initiated properly');
                }
            }
        });
    };
    
    $(document).find('.ays-survey-popup-survey-window').AysSurveyMakerPopups();
})(jQuery);
