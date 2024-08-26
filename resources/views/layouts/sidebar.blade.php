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
                    <span>Personel Yönetimi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#}"><i class="fa fa-circle-o"></i>Personel Ekle</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i>Personel Listesi</a>
                    </li>
                </ul>
            </li>

        </ul>
    </section>

    <section class="sidebar"
             style="position:absolute;bottom: 0;width: 100%;">
        <ul class="sidebar-menu"
            data-widget="tree">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gear"></i>
                    <span>Tanımlar</span>
                    <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cube"></i>
                            <span>Kullanıcılar</span>
                            <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="#"><i class="fa fa-circle-o"></i>Kullanıcı
                                    Ekle
                                </a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-circle-o"></i>Kullanıcı
                                    Listesi
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                </ul>
            </li>


        </ul>
    </section>
</aside>
