var data_accept = [];
function save() {
    if(data_accept.length != 0 && isAllValueChecked()){
        $('#data_food').val(JSON.stringify(data_accept));
        bootbox.confirm({
            message: "Bạn có chắc chắn muốn duyệt các món ăn đã chọn?",
            buttons:{
                confirm: {
                    label: "Đồng ý",
                    className: "btn-primary btn-sm"
                },
                cancel: {
                    label: "Không đồng ý",
                    className: "btn-danger btn-sm"
                }
            },
            callback: function(result){
                if(result){
                    save_reject('#fm', baseUrl + '/import_food_class/add?token='+localStorage.getItem('token'), baseUrl + '/import_food_class?token=' + localStorage.getItem('token'));
                }
            }
        });
    }else{
        show_message('error', 'Vui lòng xác nhận định lượng món ăn và ký tên!');
    }
}

function change_data_accept(food_id) {
    var check_food = $('#value_'+food_id).is(':checked');
    if(check_food){
        var str_data = {'food_id': food_id, 'status': 1, 'value': $('#value_'+food_id).val()};
        data_accept.push(str_data);
    }else{
        data_accept = data_accept.filter(item => item.food_id !== food_id);
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function isAllValueChecked() {
    const $inputs = document.querySelectorAll('input[type="checkbox"][id^="value_"]');

    if ($inputs.length === 0) return false;

    for (let i = 0; i < $inputs.length; i++) {
        if (!$inputs[i].checked) {
            return false;
        }
    }
    return true;
}