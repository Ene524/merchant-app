<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu"
            data-widget="tree">
            <li class="">
                <a href=""><i class="fa fa-dashboard"></i>
                    <span>Anasayfa</span>
                </a>
            </li>
            <li class="treeview {{ Request::segment(2) == 'items' ? 'active menu-open' : '' }}">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Item Yönetimi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#}"><i class="fa fa-circle-o"></i>Item Ekle</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i>Item Listesi</a>
                    </li>
                </ul>
            </li>

        </ul>
    </section>
</aside>
