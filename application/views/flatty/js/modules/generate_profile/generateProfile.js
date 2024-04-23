let GenerateProfile = function () {
    let _self = this
    this.properties = {
        siteUrl: site_url,
        url: {
            getData: 'admin/generate_profile/get_data',
        },
        btn: {
            generate: $('.generate-btn')
        },
        generate: {
            data: {
                lang_female: $('.user_looking_text span').text().trim(),
                lang_male: $('.user_type_text span').text().trim(),
                local_id: $('.generate-languages option:selected').attr('data-local-id'),
            }
        }
    }

    this.events = () => {

        $('.generate-btn-edit').on('click', () => {
            $('.generate-form').slideToggle()
            $('.generate-profile').slideToggle()
        })

    $('.generate-age').on('change', function () {
        _self.properties.generate.data.age = this.value
    })

    $('.generate-languages').on('change', function () {
        _self.properties.generate.data.languages = this.value
      //_self.properties.generate.data.localId = $(this).attr('data-local-id')
        _self.properties.generate.data.local_id = $(this).find('option:selected').attr('data-local-id')
    })

    $('.generate-countries').on('change', function () {
        _self.properties.generate.data.countries = this.value
    })

    this.properties.btn.generate.on('click', this.getRandomProfile)

    $('#generated_photo').on('change', function () {
        if (this.files && this.files[0]) {
            let reader = new FileReader()
            reader.onload = function (e) {
                $('#user_icon').attr('src', e.target.result)
            }
            reader.readAsDataURL(this.files[0])
        }
    })

    $('[type="submit"]').on('click', function (e) {
        e.preventDefault()
        $('#form-personal').submit();
    });

    $('.box_user_type .generate_user_type').on('click',function () {

        let value = $(this).find('input').val();
        $('.user_type_text span').text(_self.properties.generate.data["lang_" + value])

        let userType = {'female' : 'male', 'male' : 'female'}
        $('.looking_user_type label input[value="' + userType[value] + '"]').trigger('click');

    });

    $('.settings_user_type .generate_user_type').on('click',function () {
        let value = $(this).find('input').val();
        _self.properties.generate.data.gender = value;
    });

    $('.looking_user_type label').on('click', function () {
        let value = $(this).find('input').val()
        let lookingUserTypeText = $('.user_looking_text span')

        if (value == 'female') {
            lookingUserTypeText.text(_self.properties.generate.data.lang_female)
        } else {
            lookingUserTypeText.text(_self.properties.generate.data.lang_male)
        }
    });

    $('[name="age_min"]').on('change', function () {
        $('.partner_age_min').text(this.value)
    });

    $('[name="age_max"]').on('change', function () {
        $('.partner_age_max').text(this.value);
    });

    $('[name="nickname"]').on('change', function () {
        $('.generate-profile_nickname .generate-info_text span').text(this.value);
    });

    $('[name="fname"]').on('change', function () {
        $('.generate-profile_fname .generate-info_text span').text(this.value);
    });

    $('[name="sname"]').on('change', function () {
        $('.generate-profile_sname .generate-info_text span').text(this.value);
    });

    $('[name="email"]').on('change', function () {
        $('.generate-info_text-email .generate-info_text span').text(this.value);
    });

    $('[name="password"]').on('change', function () {
        $('.generate-profile_password .generate-info_text span').text(this.value);
    });

    $('[name="birth_date"]').on('change', function () {
        $('.generate-profile_date .generate-info_text span').text(this.value);
    });
    }

    this.getFirstData = function () {
        _self.properties.generate.data.age = $('.generate-age').val()
        _self.properties.generate.data.languages = $('.generate-languages option:selected').val();
        _self.properties.generate.data.countries = $('.generate-countries option:selected').val();
        _self.properties.generate.data.gender = $('[name="generate_user_type"]').val();

    }

    this.genereteProfileIndo = (data) => {
        $('.generate-info_text-email .generate-info_text span').text(data.email);
        $('.generate-profile_nickname .generate-info_text span').text(data.nickname);
        $('.generate-profile_password .generate-info_text span').text(data.password);
        $('.generate-profile_fname .generate-info_text span').text(data.fname);
        $('.generate-profile_sname .generate-info_text span').text(data.sname);
        $('.generate-profile_date .generate-info_text span').text(data.birthday);
        $('.generate-profile_region .generate-info_text span').text(data.location);
        $('.partner_age_min').text(data.age_min);
        $('.partner_age_max').text(data.age_max);
        $('.generate-img img').attr('src', data.img);

        let value = $('.settings_user_type input:checked').val();
        $('.user_type_text span').text(_self.properties.generate.data["lang_" + value])
        $('#form-personal .generate_user_type input[value="' + value + '"]').trigger('click');
        let userType = {'female' : 'male', 'male' : 'female'}
        $('.looking_user_type label input[value="' + userType[value] + '"]').trigger('click');

        _self.properties.generate.data.gender = value;
    }

    this.getRandomProfile = (e) => {
        e.preventDefault()

        $.ajax({
            url: _self.properties.siteUrl + _self.properties.url.getData,
            method: 'POST',
            data: { data: _self.properties.generate.data },
            dataType: 'json',
            success: function (resp) {
                if (resp.errors && resp.errors.length) {
                    error_object.show_error_block(resp.errors.join('<br>', 'error'))
                } else {
                    let data = resp.data;
                    $('#fname').val(data.fname);
                    $('#sname').val(data.sname);
                    let daterangepicker =  $('#birth_date').data('daterangepicker');
                    daterangepicker.setStartDate(data.birthday);
                    daterangepicker.setEndDate(data.birthday);
                    $('#hidden_birth_date').val(data.birthday);
                    $('#nickname').val(data.nickname);
                    $('#pass_field').val(data.password);
                    $('[name="email"]').val(data.email);

                    $('#location').find('[name=region_name]').val(data.location);
                    $('#location').find('[name=id_country]').val(data.id_country);
                    $('#location').find('[name=id_region]').val(data.id_region);
                    $('#location').find('[name=id_city]').val(data.id_city);
                    $('#location').find('[name=lat]').val(data.lat);
                    $('#location').find('[name=lon]').val(data.lon);
                    $('#user_icon').attr('src', data.img);
                    $('#generated_photo').attr('src', data.img);
                    $('.generate-img img').attr('src', data.img);
                    $('#generate_img').val(data.img);

                    $('#age_min').val(data.age_min);
                    $('#age_max').val(data.age_max);

                    _self.genereteProfileIndo(data);
                }
            }
        })
    }

    this.init = () => {
        this.events()
        this.getFirstData()
    }

    this.init()
}
