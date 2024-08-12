<?php
$url = $_REQUEST['url']; $url = explode("/", $url);
?>
<div id="sidebar" class="sidebar responsive ace-save-state sidebar-fixed compact">
    <ul class="nav nav-list">
        <!--<li class="hover <?php echo ($url[0] == 'index') ? 'active' : '' ?>">
            <a href="<?php echo URL.'/index?token='.$_SESSION['data'][0]['token'] ?>">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Bàn làm việc </span>
            </a>
            <b class="arrow"></b>
        </li>-->
    </ul>
</div>