<?php
$id = $_REQUEST['id']; $jsonObj = $this->jsonObj;
$html = '[]';
if($id == 1){
    $title = "Xử lý chính";
}elseif($id == 2){
    $title = "Giám sát";
}
?>
<script>
$(function(){
	var placeholder = $('#process_task').css({'width':'100%' , 'min-height':'200px'});
    var data = <?php echo $html ?>;
    function drawPieChart(placeholder, data, position) {
        $.plot(placeholder, data, {
        series: {
            pie: {show: true, tilt:0.8,
                highlight: {opacity: 0.25},
                stroke: {color: '#fff',width: 2},
                startAngle: 2
            }
        },
        grid: {hoverable: true,clickable: true}
        });
    }
    drawPieChart(placeholder, data);
    placeholder.data('chart', data);
    placeholder.data('draw', drawPieChart);
    var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
    var previousPoint = null;
    placeholder.on('plothover', function (event, pos, item) {
        if(item) {
            if (previousPoint != item.seriesIndex) {
                previousPoint = item.seriesIndex;
                var tip = item.series['label'] + " : " + item.series['percent']+'%';
                $tooltip.show().children(0).text(tip);
            }
            $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
        } else {
            $tooltip.hide();
            previousPoint = null;
        }
    });
});
</script>
<div class="col-sm-6">
    <div class="widget-box">
        <div class="widget-header widget-header-flat widget-header-small">
            <h5 class="widget-title">
                <i class="ace-icon fa fa-tasks orange"></i>
                Kết quả xử lý công việc
            </h5>
            <div class="widget-toolbar no-border">
                <div class="inline dropdown-hover">
                    <button class="btn btn-minier btn-primary">
                        <?php echo $title ?>
                        <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                        <li class="active">
                            <a href="javascript:void(0)" <?php echo ($id == 1) ? 'class="blue"' : '' ?>
                            onclick="reload_block_four(1)">
                                <i class="ace-icon fa fa-caret-right bigger-110 <?php echo ($id == 1) ? '' : 'invisible' ?>">&nbsp;</i>
                                Xử lý chính
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" <?php echo ($id == 2) ? 'class="blue"' : '' ?>
                            onclick="reload_block_four(2)">
                                <i class="ace-icon fa fa-caret-right bigger-110 <?php echo ($id == 2) ? '' : 'invisible' ?>">&nbsp;</i>
                                Giám sát
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-main">
                <div id="process_task"></div>
            </div><!-- /.widget-main -->
        </div><!-- /.widget-body -->
    </div>
</div>