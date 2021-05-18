    <!-- BEGIN HEADER MENU -->
    <div class="page-header-menu">
        <div class="container-fluid">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- <form class="search-form" action="page_general_search.html" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="query">
                    <span class="input-group-btn">
                        <a href="javascript:;" class="btn submit">
                            <i class="icon-magnifier"></i>
                        </a>
                    </span>
                </div>
            </form> -->
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN MEGA MENU -->
            <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
            <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
            <div class="hor-menu  ">
                <ul class="nav navbar-nav">
                    <?php
                    for ($a=0; $a < $menu; $a++) {
                        $main_link = set_value('main_link'.$a, isset($default['main_link'.$a]) ? $default['main_link'.$a] : ''); 
                        $main_menu = set_value('main_menu'.$a, isset($default['main_menu'.$a]) ? $default['main_menu'.$a] : ''); 
                        $main_note = set_value('main_note'.$a, isset($default['main_note'.$a]) ? $default['main_note'.$a] : ''); 
                        $main_row  = set_value('main_row'.$a, isset($default['main_row'.$a]) ? $default['main_row'.$a] : '');
                        if($main_row > 0) 
                        {
                            echo    '<li class="menu-dropdown classic-menu-dropdown ">
                                        <a href="javascript:;"> <i class="'.$main_note.'"></i> '.$main_menu.'
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu pull-left">';
                            for($b=0; $b<$main_row; $b++) {
                                $sub_link = set_value('sub_link'.$a.$b, isset($default['sub_link'.$a.$b]) ? $default['sub_link'.$a.$b] : ''); 
                                $sub_menu = set_value('sub_menu'.$a.$b, isset($default['sub_menu'.$a.$b]) ? $default['sub_menu'.$a.$b] : ''); 
                                $sub_row = set_value('sub_row'.$a.$b, isset($default['sub_row'.$a.$b]) ? $default['sub_row'.$a.$b] : '');
                                
                                if($sub_row > 0) 
                                {
                                    echo    '<li class="dropdown-submenu ">
                                                <a href="javascript:;" class="nav-link nav-toggle ">
                                                    '.$sub_menu.'
                                                    <span class="arrow"></span>
                                                </a>
                                                <ul class="dropdown-menu">';
                                    for ($c=0; $c < $sub_row; $c++) { 
                                        $sub_linkk = set_value('sub_linkk'.$a.$b.$c, isset($default['sub_linkk'.$a.$b.$c]) ? $default['sub_linkk'.$a.$b.$c] : ''); 
                                        $sub_menuu = set_value('sub_menuu'.$a.$b.$c, isset($default['sub_menuu'.$a.$b.$c]) ? $default['sub_menuu'.$a.$b.$c] : '');
                                        echo    '<li class=" ">
                                                    <a href="'.base_url().$sub_linkk.'" class="nav-link "> 
                                                        '.$sub_menuu.' </a>
                                                </li>';                                                
                                    }
                                    echo    '</ul>
                                        </li>';
                                }  else {
                                    echo    '<li class="">
                                                <a href="'.base_url().$sub_link.'" class="nav-link">
                                                    '.$sub_menu.'
                                                </a>
                                            </li>';
                                }
                            }
                            echo    '</ul>
                                </li>';
                        } else {
                            echo    '<li class="menu-dropdown classic-menu-dropdown ">
                                        <a href="'.base_url().$main_link.'"> <i class="'.$main_note.'"></i> '.$main_menu.'
                                        </a>
                                    </li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            <!-- END MEGA MENU -->
        </div>
    </div>
    <!-- END HEADER MENU -->
</div>
<!-- END HEADER -->