var url = '';
$(function(){
    var gwdth = $('#list_muster').width(), fwdth = $('.full').width();
    $('#list_muster').jqGrid({
        url: baseUrl + '/muster_data/json?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Ngày tháng', name: 'create_at', width: 120, align: 'center'},
            {label: 'Tổng số trẻ', name: 'food_main', width: 150, align: 'center'}
        ],
        viewrecords: false, height:200, width: gwdth, rowNum: 20, rownumbers: true,
        height:($('.footer').offset().top - $('#breadcrumbs').offset().top - 181),
        pager: "#muster_pager",
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        }
    });
});