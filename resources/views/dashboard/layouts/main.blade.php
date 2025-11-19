<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="Biz Admin is a Multipurpose bootstrap 4 Based Dashboard & Admin Site Responsive Template by uxliner." />
<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Biz Admin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
<meta name="author" content="uxliner"/>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">

<!-- Favicon -->
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/favicon-16x16.png')}}">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

<!-- Theme style -->
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/et-line-font/et-line-font.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/themify-icons/themify-icons.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/simple-lineicon/simple-line-icons.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/skins/_all-skins.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css')}}">

<!-- Toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Font Awesome Free -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" />

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">

<!-- ✅ Custom Fixes (Header + Sidebar + Summernote) -->
<style>
/* Fixed Header & Sidebar */
.main-header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1050;
}

.main-sidebar {
    position: fixed;
    top: 70px; /* header height */
    left: 0;
    width: 250px; /* sidebar width */
    height: 100%;
    z-index: 1040;
}

/* Push content below header & sidebar */
.content-wrapper {
    margin-top: 70px; /* header height */
    margin-left: 250px; /* sidebar width */
    padding: 20px;
}

/* Summernote editor z-index */
.note-editor {
    z-index: 1030;
}

/* Make toolbar sticky below header */
.note-editor.sticky .note-toolbar {
    position: sticky !important;
    top: 70px; /* header height */
    z-index: 1035;
    background: #fff;
    border-bottom: 1px solid #ddd;
}

/* Editable area padding so text never goes under toolbar */
.note-editable {
    min-height: 250px;
    padding-top: 10px;
}
</style>
</head>

<body class="skin-blue sidebar-mini">
<div class="wrapper boxed-wrapper">

    @include('dashboard.layouts.header')
    @include('dashboard.layouts.sideBar')
    @yield('content')

    <footer class="main-footer" style="margin-right: 20px">
        Copyright © 2025 IT Nextro. All rights reserved.
    </footer>

    <aside class="control-sidebar control-sidebar-dark">
        <div class="tab-content">
            <div class="tab-pane" id="control-sidebar-home-tab"></div>
        </div>
    </aside>
    <div class="control-sidebar-bg"></div>
</div>

<!-- jQuery -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>

<!-- Bootstrap bundle -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Template JS -->
<script src="{{asset('assets/js/bizadmin.js')}}"></script>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Sparkline -->
<script src="{{asset('assets/plugins/jquery-sparklines/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-sparklines/sparkline-int.js')}}"></script>

<!-- Morris Charts -->
<script src="{{asset('assets/plugins/raphael/raphael-min.js')}}"></script>
<script src="{{asset('assets/plugins/morris/morris.js')}}"></script>
<script src="{{asset('assets/plugins/functions/dashboard1.js')}}"></script>

<!-- DataTables -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<!-- Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>

<!-- Table Export -->
<script src="{{asset('assets/plugins/table-expo/filesaver.min.js')}}"></script>
<script src="{{asset('assets/plugins/table-expo/xls.core.min.js')}}"></script>
<script src="{{asset('assets/plugins/table-expo/tableexport.js')}}"></script>

<script>
$(function () {

  // DataTables
  $('#example1').DataTable({ "ordering": false });
  $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
  });

  // Table Export
  $("table").tableExport({ formats: ["xlsx","xls", "csv", "txt"] });

  // Summernote initialization + sticky toolbar
  if ($('#summernote').length) {
      $('#summernote').summernote({
          placeholder: 'Write product description here...',
          tabsize: 2,
          height: 250,
          toolbar: [
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['font', ['fontsize', 'color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['insert', ['link', 'picture', 'table']],
              ['view', ['fullscreen', 'codeview']]
          ]
      });
    }

      var $editor = $('.note-editor');
      var $toolbar = $editor.find('.note-toolbar');
      var toolbarHeight = $toolbar.outerHeight();
      var headerHeight = $('.main-header').outerHeight() || 70;

      $(window).on('scroll', function() {
          var scrollTop = $(window).scrollTop();
          var editorOffset = $editor.offset().top;

          if (scrollTop >= editorOffset - headerHeight) {
              $editor.addClass('sticky');
              $editor.find('.note-editable').css('padding-top', toolbarHeight + 'px');
          } else {
              $editor.removeClass('sticky');
              $editor.find('.note-editable').css('padding-top', '10px');
          }
      });


  // Slug auto-generate
  if ($('#name').length) {
      $('#name').on('keyup', function () {
        let name = $(this).val();
        let slug = name
            .toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');
        $('#slug').val(slug);
      });
  }

});

// Toastr options
toastr.options = {
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "3500",
};

@if(session('success'))
    toastr.success("{{ session('success') }}");
@endif
@if(session('fail'))
    toastr.error("{{ session('fail') }}");
@endif
</script>
</body>
</html>
