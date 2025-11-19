 <style>
     .sidebar {
         margin-top: 60px;
         position: fixed;
         /* sidebar ko fix krta hai */
         top: 0;
         /* top se chipka dega */
         /* left side se chipka dega */

     }

     .mian-sidebar {
         margin-left: 250px;
         /* sidebar ke width jitna space de */
         padding: 20px;
     }

     /* SIDEBAR STYLING */
     .sidebar {
         position: fixed;
         top: 0;
         left: 0;
         height: 100vh;
         width: 250px;
         /* Full sidebar width */
         background-color: #222;
         /* Apni marzi ka bg color */
         padding-top: 20px;
         overflow-y: auto;
     }

     /* Sidebar ke andar list ka style */
     .sidebar ul {
         list-style: none;
         margin: 0;
         padding: 0;
     }

     /* Sidebar items */
     .sidebar ul li {
         width: 100%;
     }

     /* Sidebar links */
     .sidebar ul li a {
         display: block;
         /* pura block clickable hoga */
         width: 100%;
         padding: 12px 20px;
         color: #fff;
         text-decoration: none;
         transition: 0.3s;
     }

     .sidebar ul li a:hover {
         background-color: #444;
         /* hover effect */
     }

     /* MAIN CONTENT */
     .main-content {
         margin-left: 250px;
         /* sidebar jitni space do */
         padding: 20px;
     }
 </style>
 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
     <!-- sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel -->
         {{-- <div class="user-panel">
             <div class="image text-center"><img src="" class="img-circle" alt="User Image"> </div>
             <div class="info">
                 <p>Hassan</p>
                 <a href="#"><i class="fa fa-envelope"></i></a> <a href="#"><i class="fa fa-gear"></i></a> <a
                     href="#"><i class="fa fa-power-off"></i></a>
             </div>
         </div> --}}

         <!-- sidebar menu -->
         <ul class="sidebar-menu" data-widget="tree">
             <li class="header">PERSONAL</li>
             <li class="treeview"> <a href="{{ route('dashboard') }}"> <i class="icon-home"></i>
                     <span>Dashboard</span> <span class="pull-right-container"> <i
                             class="fa fa-angle-left pull-right"></i> </span> </a>
                 <ul class="treeview-menu">
                     <li class="active"><a href="index.html"><i class="fa fa-angle-right"></i> CMS</a></li>
                 </ul>
             </li>
             <li class="header">FORMS, TABLE</li>
             <li class="treeview"> <a href="#"> <i class="icon-note"></i> <span>Forms</span> <span
                         class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                 <ul class="treeview-menu">
                     <li><a href="{{ route('form1') }}"><i class="fa fa-angle-right"></i> Sinup Form</a></li>
                 </ul>
             </li>
             <li class="treeview"> <a href="#"> <i class="fa fa-table"></i> <span>Tables</span> <span
                         class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                 <ul class="treeview-menu">
                     <li><a href="{{ route('table') }}"><i class="fa fa-angle-right"></i> Users Tables</a></li>
                 </ul>
             </li>
             <li class="treeview"> <a href="#">  <span>Products</span> <span
                         class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                 <ul class="treeview-menu">
                     <li><a href="{{route('addProduct')}}">Add Product</a></li>
                     <li><a href="{{route('indexProduct')}}">View Product</a></li>
                 </ul>
             </li>
             <li class="treeview"> <a href="#"> <span>Categories</span><span class="pull-right-container"> <i
                             class="fa fa-angle-left pull-right"></i> </span></a>
                 <ul class="treeview-menu">
                     <li><a href="{{ route('addCategory') }}">Add Category</a></li>
                     <li><a href="{{ route('indexCategory') }}">View Category</a></li>
                     <li class="treeview"><a href="">Sub Categories<span class="pull-right-container"> <i
                                     class="fa fa-angle-left pull-right"></i> </span></a>
                         <ul class="treeview-menu">
                             <li><a href="{{ route('showSub') }}">Add SubCategory</a></li>
                             <li><a href="{{ route('indexSub') }}">View SubCategory</a></li>
                         </ul>
                     </li>
                 </ul>
             </li>
         </ul>
     </div>
     <!-- /.sidebar -->
 </aside>
