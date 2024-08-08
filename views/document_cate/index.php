<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li>Văn thư</li>
                <li class="active">Danh mục văn bản</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Khai báo danh mục văn bản
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="col-sm-12">
                        <form id="fm-in" method="post">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Lựa chọn danh mục cha</label>
                                        <div>
                                            <select class="select2" data-placeholder="Lựa chọn danh mục cha"
                                                style="width:100%" id="parent_id_in" name="parent_id"
                                                data-minimum-results-for-search="Infinity">
                                                <option value="">Lựa chọn danh mục cha</option>
                                                <?php
                                                function show_options_in($categories, $parent_id = 0, $char = ''){
                                                    foreach ($categories as $key => $item){
                                                        if ($item['parent_id'] == $parent_id){
                                                            echo '<option value="'.$item['id'].'">';
                                                                echo $char . $item['title'];
                                                            echo '</option>';
                                                            unset($categories[$key]);
                                                            show_options_in($categories, $item['id'], $char.'|---');
                                                        }
                                                    }
                                                }
                                                show_options_in($this->jsonObj_dc_in);
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Tên danh mục</label>
                                        <div>
                                            <input type="text" id="title_in" name="title" required=""
                                                placeholder="Tên danh mục, ví dụ: Phòng giáo dục" style="width:100%" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <button class="btn btn-sm btn-danger" type="button"
                                        onclick="javascript:location.reload(true)">
                                        <i class="ace-icon fa fa-times"></i>
                                        Hủy bỏ
                                    </button>
                                    <button class="btn btn-sm btn-primary" type="button" onclick="save_in()">
                                        <i class="ace-icon fa fa-save"></i>
                                        Ghi dữ liệu
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.col -->
                    <div class="col-sm-12">
                        <div class="widget-box widget-color-blue" id="tree_view_dc_in">
                            <div class="widget-header">
                                <h4 class="widget-title smaller">
                                    Danh mục văn bản đến
                                </h4>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main padding-8">
                                    <?php
                                    function showCategories_in($categories, $parent_id = 0, $char = ''){
                                        $cate_child = array();
                                        foreach ($categories as $key => $item){
                                            if ($item['parent_id'] == $parent_id){
                                                $cate_child[] = $item;
                                                unset($categories[$key]);
                                            }
                                        }
                                        if ($cate_child) {
                                            echo '<ul class="tree-branch-children" role="group">';
                                            foreach ($cate_child as $key => $item){
                                                echo '<li class="tree-branch tree-open" role="treeitem" aria-expanded="true">';
                                                    echo '<div class="tree-branch-header"> 
                                                            <span class="tree-branch-name"> 
                                                                <i class="icon-folder green ace-icon fa fa-folder-open"></i>';
                                                    echo '<span class="tree-label">'.$item['title'].'</span>';
                                                    echo '<span class="pull-right">';
                                                        echo '<div class="hidden-sm hidden-xs action-buttons">';
                                                            echo '<a class="green" href="javascript:void(0)" onclick="edit_in('.$item['id'].')">';
                                                                echo '<i class="ace-icon fa fa-pencil bigger-130"></i>';
                                                            echo '</a> |  '; 
                                                            echo '<a class="red" href="javascript:void(0)" onclick="del_in('.$item['id'].')">';
                                                                echo '<i class="ace-icon fa fa-trash bigger-130"></i>';
                                                            echo '</a>';
                                                        echo '</div>';
                                                    echo '</span></span></div>';
                                                    showCategories_in($categories, $item['id'], $char);
                                                echo '</li>';
                                            }
                                            echo '</ul>';
                                        }
                                    }
                                    ?>
                                    <ul id="tree2" class="tree tree-unselectable tree-folder-select" role="tree">
                                        <?php showCategories_in($this->jsonObj_dc_in) ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.col -->
                </div>
                <div class="col-sm-6">
                <div class="col-sm-12">
                        <form id="fm-out" method="post">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Lựa chọn danh mục cha</label>
                                        <div>
                                            <select class="select2" data-placeholder="Lựa chọn danh mục cha"
                                                style="width:100%" id="parent_id_out" name="parent_id"
                                                data-minimum-results-for-search="Infinity">
                                                <option value="">Lựa chọn danh mục cha</option>
                                                <?php
                                                function show_options_out($categories, $parent_id = 0, $char = ''){
                                                    foreach ($categories as $key => $item){
                                                        if ($item['parent_id'] == $parent_id){
                                                            echo '<option value="'.$item['id'].'">';
                                                                echo $char . $item['title'];
                                                            echo '</option>';
                                                            unset($categories[$key]);
                                                            show_options_out($categories, $item['id'], $char.'|---');
                                                        }
                                                    }
                                                }
                                                show_options_out($this->jsonObj_dc_out);
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Tên danh mục</label>
                                        <div>
                                            <input type="text" id="title_out" name="title" required=""
                                                placeholder="Tên danh mục, ví dụ: Phòng giáo dục" style="width:100%" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <button class="btn btn-sm btn-danger" type="button"
                                        onclick="javascript:location.reload(true)">
                                        <i class="ace-icon fa fa-times"></i>
                                        Hủy bỏ
                                    </button>
                                    <button class="btn btn-sm btn-primary" type="button" onclick="save_out()">
                                        <i class="ace-icon fa fa-save"></i>
                                        Ghi dữ liệu
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.col -->
                    <div class="col-sm-12">
                        <div class="widget-box widget-color-blue" id="tree_view_dc_out">
                            <div class="widget-header">
                                <h4 class="widget-title smaller">
                                    Danh mục văn bản đi
                                </h4>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main padding-8">
                                    <?php
                                    function showCategories_out($categories, $parent_id = 0, $char = ''){
                                        $cate_child = array();
                                        foreach ($categories as $key => $item){
                                            if ($item['parent_id'] == $parent_id){
                                                $cate_child[] = $item;
                                                unset($categories[$key]);
                                            }
                                        }
                                        if ($cate_child) {
                                            echo '<ul class="tree-branch-children" role="group">';
                                            foreach ($cate_child as $key => $item){
                                                echo '<li class="tree-branch tree-open" role="treeitem" aria-expanded="true">';
                                                    echo '<div class="tree-branch-header"> 
                                                            <span class="tree-branch-name"> 
                                                                <i class="icon-folder green ace-icon fa fa-folder-open"></i>';
                                                    echo '<span class="tree-label">'.$item['title'].'</span>';
                                                    echo '<span class="pull-right">';
                                                        echo '<div class="hidden-sm hidden-xs action-buttons">';
                                                            echo '<a class="green" href="javascript:void(0)" onclick="edit_out('.$item['id'].')">';
                                                                echo '<i class="ace-icon fa fa-pencil bigger-130"></i>';
                                                            echo '</a> |  '; 
                                                            echo '<a class="red" href="javascript:void(0)" onclick="del_out('.$item['id'].')">';
                                                                echo '<i class="ace-icon fa fa-trash bigger-130"></i>';
                                                            echo '</a>';
                                                        echo '</div>';
                                                    echo '</span></span></div>';
                                                    showCategories_out($categories, $item['id'], $char);
                                                echo '</li>';
                                            }
                                            echo '</ul>';
                                        }
                                    }
                                    ?>
                                    <ul id="tree2" class="tree tree-unselectable tree-folder-select" role="tree">
                                        <?php showCategories_out($this->jsonObj_dc_out) ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.col -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<script src="<?php echo URL.'/public/' ?>scripts/document/cate.js"></script>