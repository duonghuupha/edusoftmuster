/**
 * 
 * @param {*} id_form 
 * @param {*} post_url 
 * @param {*} url_reject 
 */
function save_reject(id_form, post_url, url_reject){
    var xhr = new XMLHttpRequest();
    var formData = new FormData($(id_form)[0]);
    $('.overlay').show();
    $.ajax({
        url: post_url,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                window.location.href = url_reject;
            }else{
                $('.overlay').hide();
                show_message('error', result.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

/**
 * 
 * @param {*} id_form 
 * @param {*} post_url 
 * @param {*} id_modal 
 * @param {*} id_content 
 * @param {*} url_refresh 
 */
function save_form_modal(id_form, post_url, id_modal, id_content, url_refresh){
    var xhr = new XMLHttpRequest();
    var formData = new FormData($(id_form)[0]);
    $('.overlay').show();
    $.ajax({
        url: post_url,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('.overlay').hide();
                show_message('success', result.msg);
                $(id_modal).modal('hide');
                //$(id_content).load(url_refresh);
                $(id_content).trigger('reloadGrid');
            }else{
                $('.overlay').hide();
                show_message('error', result.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

/**
 * 
 * @param {*} id_form 
 * @param {*} post_url 
 * @param {*} id_modal 
 * @param {*} id_content 
 * @param {*} url_refresh 
 */
function save_form_modal_old(id_form, post_url, id_modal, id_content, url_refresh){
    var xhr = new XMLHttpRequest();
    var formData = new FormData($(id_form)[0]);
    $('.overlay').show();
    $.ajax({
        url: post_url,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('.overlay').hide();
                show_message('success', result.msg);
                $(id_modal).modal('hide');
                $(id_content).load(url_refresh);
            }else{
                $('.overlay').hide();
                show_message('error', result.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

/**
 * 
 * @param {*} id_form 
 * @param {*} post_url 
 * @param {*} id_content 
 * @param {*} url_refresh 
 */
function save_form_line(id_form, post_url, id_content, url_refresh){
    var xhr = new XMLHttpRequest();
    var formData = new FormData($(id_form)[0]);
    $('.overlay').show();
    $.ajax({
        url: post_url,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('.overlay').hide();
                show_message('success', result.msg);
                //$(id_content).load(url_refresh);
                $(id_content).trigger('reloadGrid');
            }else{
                $('.overlay').hide();
                show_message('error', result.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

/**
 * 
 * @param {*} id_form 
 * @param {*} post_url 
 * @param {*} id_content 
 * @param {*} url_refresh 
 */
function save_form_reset_form(id_form, post_url, id_content, url_refresh){
    var xhr = new XMLHttpRequest();
    var formData = new FormData($(id_form)[0]);
    $('.overlay').show();
    $.ajax({
        url: post_url,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('.overlay').hide();
                show_message('success', result.msg);
                $(id_form)[0].reset(); $('.select2').val(null).trigger('change.select2'); $('.file_attach').ace_file_input('reset_input');
                $(id_content).trigger('reloadGrid');
            }else{
                $('.overlay').hide();
                show_message('error', result.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

/**
 * 
 * @param {*} str_data 
 * @param {*} notify 
 * @param {*} post_url 
 * @param {*} id_div 
 * @param {*} url_refresh 
 */
function del_data(str_data, notify, post_url, id_div, url_refresh){
    bootbox.confirm({
        message: notify,
        buttons:{
            confirm: {
                label: "Đồng ý",
                className: "btn-danger btn-sm"
            },
            cancel: {
                label: "Không đồng ý",
                className: "btn-primary btn-sm"
            }
        },
        callback: function(result){
            if(result){
                exec_del(str_data, post_url, id_div, url_refresh);
            }
        }
    });
}

/**
 * 
 * @param {*} data_str 
 * @param {*} url_data 
 * @param {*} id_div 
 * @param {*} url_refresh 
 */
function exec_del(data_str, url_data, id_div, url_refresh){
    $('.overlay').show();
    $.ajax({
        type: "POST",
        url: url_data,
        data: data_str, // serializes the form's elements.
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('.overlay').hide();
                show_message('success', result.msg);
                $(id_div).trigger('reloadGrid');
            }else{
                $('.overlay').hide();
                show_message('error', result.msg);
                return false;
            }
        }
    });
}

/**
 * 
 * @param {*} str_data 
 * @param {*} notify 
 * @param {*} post_url 
 * @param {*} reject_url 
 */
function update_data(str_data, notify, post_url, reject_url){
    bootbox.confirm({
        message: notify,
        buttons:{
            confirm: {
                label: "Đồng ý",
                className: "btn-danger btn-sm"
            },
            cancel: {
                label: "Không đồng ý",
                className: "btn-primary btn-sm"
            }
        },
        callback: function(result){
            if(result){
                exec_update(str_data, post_url, reject_url);
            }
        }
    });
}

/**
 * 
 * @param {*} data_str 
 * @param {*} url_data 
 * @param {*} reject_url 
 */
function exec_update(data_str, url_data, reject_url){
    $('.overlay').show();
    $.ajax({
        type: "POST",
        url: url_data,
        data: data_str, // serializes the form's elements.
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                window.location.href = reject_url;
            }else{
                $('.overlay').hide();
                show_message('error', result.msg);
                return false;
            }
        }
    });
}