<?php
if(!isset($_SESSION['data'])){
    header("Location: ".URL.'/index/logout');
}
?>
<div id="navbar" class="navbar navbar-default ace-save-state navbar-fixed-top">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="navbar-header pull-left">
            <a href="<?php echo URL.'/index' ?>" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    EDUSOFT
                </small>
            </a>
        </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="dropdown-modal">
                    <a class="dropdown-toggle" href="javascript:void(0)" onclick="change_year()">
                        <span class="badge year_school"><?php echo $this->_Year[0]['title'] ?></span>
                    </a>
                </li>
                <li class="purple dropdown-modal">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)"
                    onclick="load_list_notify()">
                        <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                        <span class="badge badge-important" id="total_notify">0</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close"
                    id="list_notify_modal">

                    </ul>
                </li>
                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="<?php echo URL.'/styles/assets' ?>/images/edusoft.png"/>
                        <span class="user-info">
                            <small>Xin chào,</small>
                            <?php
                            if($_SESSION['data'][0]['username'] == 'admin'){
                                echo "Administrator";
                            }else{
                                echo $this->_Data->return_fullname_personnel_userid($_SESSION['data'][0]['personnel_id']);
                            }
                            ?>
                        </span>
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>
                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="<?php echo URL.'/index/logout' ?>">
                                <i class="ace-icon fa fa-power-off"></i>
                                Đăng xuất
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>