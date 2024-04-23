'use strict';
function AdminStart (optionArr) {
    this.properties = {
        siteUrl: '',
        pageGid: '',
        captchaDataType: '',
        googleSiteKeyInput: '#googleSiteKey',
        googleSecretKyeInput: '#googleSecretKye',
        btnSaveCaptchaSettings: $('#btnSaveCaptchaSettings'),
        googleCaptchaToken : '',
        errorObj :  new Errors(),
        class: {
            marketplaceButton: '.marketplace-button',
            rightCol: '.right_col'
        },
        data: {
            captchaType: '[data-captcha="type"]',
            captchaBlock: '[data-captcha="block"]'
        }
    };

    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.initControls();
        _self.scrollPage();
    };

    this.initControls = function () {
         $(document)
                .off('click', _self.properties.data.captchaType).on('click', _self.properties.data.captchaType, function () {
            _self.captchaDataType = $(this).data('captcha_type');
            _self.changeCaptchaSettings(this);
            _self.btnSaveCaptcha();
        }).off('input', _self.properties.googleSiteKeyInput).on('input',_self.properties.googleSiteKeyInput, function (){
            _self.validGoogleSiteKey();
         }).off('input', _self.properties.googleSecretKyeInput).on('input',_self.properties.googleSecretKyeInput, function (){
            _self.validGoogleSecretKye(this);
         });
    };

    this.changeCaptchaSettings = function (obj) {
        var captcha = _self.captchaDataType;
        $(_self.properties.data.captchaBlock).addClass('hide');
        $('[data-captcha_block="' + captcha + '"]').removeClass('hide');
    };

    this.btnSaveCaptcha = function (){
            _self.properties.btnSaveCaptchaSettings.attr('disabled', _self.captchaDataType === 'google')
    }

    this.reloadScript = function(url) {
        var el = document.querySelector('.googletes');

        if (el){
            el.remove();
            console.log('remove')
        }
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = url;
        script.classList.add('googletes');
        script.onerror = function (){ $('.sk-wave ').fadeOut(0);};
        document.documentElement.appendChild(script);
    }

    this.validGoogleSiteKey =  function (){
        var boxInput    =  $(_self.properties.googleSiteKeyInput).closest('.form-group');
        var value       =  $(_self.properties.googleSiteKeyInput).val();
        $('.errors_box').html('');
        $( _self.properties.googleSecretKyeInput).attr("readonly", true);
        _self.properties.btnSaveCaptchaSettings.attr('disabled',true);
        if (value.length < 40){
            boxInput.addClass('has-error');
        }else {
            $('.sk-wave ').fadeIn(0);
             _self.reloadScript('https://www.google.com/recaptcha/api.js?render='+value);
            setTimeout(function (){_self.getGoogleToken()},1500);
        }
    }

    this.validGoogleSecretKye =  function (){
        console.log($(_self.properties.googleSecretKyeInput).val().length)
        var boxSecratInput    =  $(_self.properties.googleSecretKyeInput).closest('.form-group');
        _self.properties.btnSaveCaptchaSettings.attr('disabled',true);
        $('.sk-wave ').fadeOut(0);
        $('.errors_box').html('');
        if ($(_self.properties.googleSecretKyeInput).val().length < 39){
            boxSecratInput.addClass('has-error');
            return;
        }
         _self.getGoogleToken();
        var param =  { 'validGoogleCaptchaToken': _self.properties.googleCaptchaToken,"validGoogleCaptchaSecretKye" : $(_self.properties.googleSecretKyeInput).val() };
        setTimeout(function (){
            $.post(  _self.properties.siteUrl + "/admin/start/captcha/",param,function (res){
                var result = JSON.parse(res)
                if (result.success){
                    _self.properties.btnSaveCaptchaSettings.attr('disabled',false);
                    boxSecratInput.removeClass('has-error');
                    boxSecratInput.addClass('has-success');
                    $('.errors_box').html('');
                }else {
                    _self.properties.btnSaveCaptchaSettings.attr('disabled',true);
                    $('.errors_box').html(result['error-codes'].join(','));
                    boxSecratInput.removeClass('has-success');
                    boxSecratInput.addClass('has-error');
                }
                console.log(result);
                $('.sk-wave ').fadeOut(0);
            });
        },200)
    }

    this.getGoogleToken = function (){
        var value       =  $(_self.properties.googleSiteKeyInput).val();
        var boxInput    =  $(_self.properties.googleSiteKeyInput).closest('.form-group');
        _self.properties.btnSaveCaptchaSettings.attr('disabled',true);
        try {
            grecaptcha.execute(value, {action: 'homepage'}).then(function(token) {
                _self.properties.googleCaptchaToken = token;
                boxInput.removeClass('has-error');
                boxInput.addClass('has-success');
                $( _self.properties.googleSecretKyeInput).attr("readonly", false);
                $('.sk-wave ').fadeOut(0);
                if ($(_self.properties.googleSecretKyeInput).closest('.form-group').hasClass('has-success')){
                    _self.properties.btnSaveCaptchaSettings.attr('disabled',false);
                }
            }).catch(function (e){
                $('.sk-wave ').fadeOut(0);
                boxInput.addClass('has-error');
                console.log(e)
            });
        }catch (e){
            console.log(e)
            $('.sk-wave ').fadeOut(0);
            boxInput.addClass('has-error');
        }
    }

    this.scrollPage = function () {
        var size = $(document).height() - 28;
        var height = $(window).height();
        $(window).scroll(function () {
                if($(this).scrollTop()+height >= size){
                    $(_self.properties.class.rightCol).css('padding-bottom', '60px');
                    $(_self.properties.class.marketplaceButton).css('bottom', '30px');
                } else {
                    $(_self.properties.class.marketplaceButton).css('bottom', '0px');
                }
        });
    };

    _self.Init(optionArr);

};
