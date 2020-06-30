<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
{{-- <link rel="stylesheet" href="{{asset('css/forminput.css')}}"> --}}
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
{{-- <link rel="stylesheet" href="{{asset('css/aturiconglypchon.css')}}"> --}}
<link rel="stylesheet" href="{{asset('css/tampilantable.css')}}">
{{-- <link rel="stylesheet" href="{{asset('css/pagination.css')}}"> --}}
<!-------------------------Buat Shopper------------------------>
<link rel="stylesheet" href="{{ asset('shopper') }}/fonts/icomoon/style.css">

{{-- <link rel="stylesheet" href="{{ asset('shopper') }}/css/bootstrap.min.css"> --}}
{{-- <link rel="stylesheet" href="{{ asset('shopper') }}/css/magnific-popup.css">
<link rel="stylesheet" href="{{ asset('shopper') }}/css/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('shopper') }}/css/owl.carousel.min.css">
<link rel="stylesheet" href="{{ asset('shopper') }}/css/owl.theme.default.min.css">
<link rel="stylesheet" href="{{ asset('shopper') }}/css/aos.css">
<link rel="stylesheet" href="{{ asset('shopper') }}/css/style.css">
<!------------------------------------------------------------->

{{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}} --}}
<!---------------------Buata data table ---------------->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>  

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<!-------------------------------------------------------->

<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<script>
    $( function() {
    $( "#datepicker" ).datepicker();
  } );
    $( function() {
    $( "#datepicker2" ).datepicker();
  } );
     function konfirmasi()
     {
     tanya = confirm("Anda Yakin Akan Menghapus Data ?");
     if (tanya == true) return true;
     else return false;
     }
</script>
<body class="w3-light-grey">
<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>

{{-- <span class="w3-bar-item w3-right">
  <form id="logout-form" action="#" method="POST" style="display: none;">
    @csrf
</form>
</span> --}}
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="https://www.w3schools.com/w3images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
        <?php 
            if(Auth::check()){
        ?>
      <span>Welcome, <strong>{{Auth::user()->name}}</strong></span><br>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </div>

        <?php
            }
        ?>
        <a href="{{route('index')}}" class="w3-bar-item w3-button"><i class="fa fa-home"></i></a>
        <a href="{{ route('logout') }}" class="w3-bar-item w3-button"><i class="fa fa-user"> 
        Logot
        </i></a>
    </div>
  </div>

  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    {{-- <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a> --}}
    <a href="{{route('inputdatabarang')}}" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Entry Barang</a>
    <a href="{{route('editdatabarang')}}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Edit Barang</a>
  <a href="{{route('inputransaksi')}}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Input Transaksi</a>
    <a href="{{route('listtransaksi')}}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>  List Transaksi</a>
  <a href="{{route('inputdatareseller')}}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-diamond fa-fw"></i>  Input Reseller</a>
  <a href="{{route('listreseller')}}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i>  List Reseller</a>
  <a href="{{route('inputransaksireseller')}}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bank fa-fw"></i>  Input Transaksi Reseller</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  History</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Settings</a><br><br>
  </div>
</nav>
{{-- Batas Side Bar Menu --}}


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

@yield('content')

<script>
//Buata data TABLES
$(document).ready(function() {
    $('#example').DataTable( {
        "columnDefs": [ {
            "visible": false,
            "targets": -1
        } ]
    } );
} );
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

<script src="{{ asset('shopper') }}/js/jquery-3.3.1.min.js"></script>
<script src="{{ asset('shopper') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('shopper') }}/js/aos.js"></script>
<script src="{{ asset('shopper') }}/js/main.js"></script>
  @yield('js')
  
</body>
</html>
