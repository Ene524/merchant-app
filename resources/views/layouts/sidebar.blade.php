<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu"
            data-widget="tree">
            <li class="">
                <a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>
                    <span>Anasayfa</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('item.index')}}"><i class="fa fa-file"></i>
                    <span>Itemler</span>
                </a>
            </li>
        </ul>
    </section>

    <section class="sidebar" style="position:absolute;bottom: 0;width: 100%;">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gear"></i> <span>Tanımlar</span>
                    <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cube"></i> <span>Kullanıcılar</span>
                            <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('user.create')}}"><i class="fa fa-circle-o"></i>Kullanıcı
                                    Ekle</a>
                            </li>
                            <li><a href="{{route('user.index')}}"><i class="fa fa-circle-o"></i>Kullanıcı
                                    Listesi</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cube"></i> <span>Sunucular</span>
                            <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i>Sunucu
                                    Ekle</a>
                            </li>
                            <li><a href="#"><i class="fa fa-circle-o"></i>Sunucu
                                    Listesi</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>


        </ul>
    </section>
</aside>
