<?php
$url = $_REQUEST['url']; $url = explode("/", $url);
?>
<div id="sidebar" class="sidebar responsive ace-save-state sidebar-fixed compact">
    <ul class="nav nav-list">
        <li class="hover">
            <a href="<?php echo URL.'/index?token='.$_SESSION['data'][0]['token'] ?>">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Trang chủ </span>
            </a>
            <b class="arrow"></b>
        </li>
        <li class="hover">
            <a href="<?php echo URL.'/muster_data?token='.$_SESSION['data'][0]['token'] ?>">
                <i class="menu-icon fa fa-calculator"></i>
                <span class="menu-text"> Dữ liệu điểm danh </span>
            </a>
            <b class="arrow"></b>
        </li>
        <li class="hover">
            <a href="<?php echo URL.'/import_food_class?token='.$_SESSION['data'][0]['token'] ?>">
                <i class="menu-icon fa fa-cutlery"></i>
                <span class="menu-text"> Giao nhận KPHS</span>
            </a>
            <b class="arrow"></b>
        </li>
    </ul>
</div>