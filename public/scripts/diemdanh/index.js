var url = '';
$(function(){
    var gwdth = $('#list_students').width(), fwdth = $('.full').width();
    $('#list_students').jqGrid({
        url: baseUrl + '/diemdanh/json?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Họ và tên', name: 'fullname', width: 150},
            {label: '&nbsp', name: 'muster', width: 50, align: 'center', formatter: format_muster},
            {label: '&nbsp', name: 'id', hidden:true},
            {label: '&nbsp', name: 'class_id', hidden:true},
            {label: '&nbsp', name: 'muster', hidden:true}
        ],
        viewrecords: false, height:200, width: gwdth, rowNum: 1000, rownumbers: true,
        height:($('.footer').offset().top - $('#breadcrumbs').offset().top - 133),
        pager: "#students_pager",
        ondblClickRow: function(rowId){
            var grid = $('#list_students');
            jQuery('#list_students').jqGrid("setSelection", rowId);
            var row = grid.jqGrid("getRowData", rowId);
            var date = $('#ngaydiemdanh').val();
            add_muster(rowId, row.class_id, row.fullname, date);
        }
    });
    combo_select_2('#class_id', baseUrl + '/diemdanh/combo_class?token='+localStorage.getItem('token'), "", 0);
    setTimeout(() => {
        $('#students_pager').css({"height": "0px", "display": "none"});
    }, 100);
});

function format_muster(cellvalue, options, rowObject){
    if(cellvalue != 0){
        return '<i class="ace icon fa fa-calendar green"></i>';
    }else{
        return '';
    }
}

function search(){
    var classid = $('#class_id').val(), ngaydiemdanh = $('#ngaydiemdanh').val();
    if(classid.length == 0 && ngaydiemdanh.length == 0){
        show_message('error', 'Vui lòng chọn lớp và ngày điểm danh');
        return;
    }else{
        $('#list_students').jqGrid('setGridParam',{
            postData: {"classid": classid, "date": ngaydiemdanh}
        }).trigger('reloadGrid');
    }
}

function add_muster(idh, classid, fullname, date){
    var grid = $('#list_students');
    jQuery('#list_students').jqGrid("setSelection", idh);
    var row = grid.jqGrid("getRowData", idh);
    if(row.muster != 0){
        var data_str = "token="+localStorage.getItem("token")+'&id='+idh+'&classid='+classid+'&date='+date;
        del_data(data_str, "Bạn có chắc chắn muốn <b style='color:red'>Hủy</b> điểm danh cho học sinh: <b>"+fullname+"</b>", baseUrl + '/diemdanh/del', '#list_students', baseUrl + '/diemdanh/json?token='+localStorage.getItem('token'));
    }else{
        var data_str = "token="+localStorage.getItem("token")+'&id='+idh+'&classid='+classid+'&date='+date;
        del_data(data_str, "Bạn có chắc chắn muốn điểm danh cho học sinh: <b>"+fullname+"</b>", baseUrl + '/diemdanh/add', '#list_students', baseUrl + '/diemdanh/json?token='+localStorage.getItem('token'));
    }
}