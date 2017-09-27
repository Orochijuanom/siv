<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Hapy') }}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/dashboard/nprogress.css" rel="stylesheet">
    <link href="/css/dashboard/custom.min.css" rel="stylesheet">    
    <link rel="stylesheet" href="https://unpkg.com/vue-toastr-2/dist/vue-toastr-2.min.css">    
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
  </head>
  <body class="nav-md">
    <div id="app">
      <div class="container body">
        <div class="main_container">
          <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
              <div class="navbar nav_title" id="logo" style="border: 0;">                
              </div>
              <div class="clearfix"></div>
              <!-- sidebar menu -->
              <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                    <h3>General</h3>
                    <ul class="nav side-menu">
                    @yield('sidebar')
                    </ul>
                </div>
              

            </div>
              <!-- /sidebar menu -->              
            </div>
          </div>

          <!-- top navigation -->
          <div class="top_nav">
            <div class="nav_menu">
              <nav>
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>

                <ul class="nav navbar-nav navbar-right">
                  
                  <li class="">
                    <a href="javascript:;"  aria-expanded="false">
                      {{ Auth::user()->name }}<span class="caret"></span></a>
                    <ul >
                     
                      <li>
                          <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              <i class="fa fa-sign-out pull-right"></i> Salir</a>
                          
                          <form id="logout-form" action="/logout" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                          
                      </li>
                    </ul>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <!-- /top navigation -->
          <!-- page content -->
          <div class="right_col" role="main">
              <div class="row">
                <div class="col-md-12">
                  @yield('content')
              </div>
              </div>
            </div>
          </div>
          <!-- /page content -->

          <!-- footer content -->
          <footer>
            <div class="pull-right">
              SIV <a href="localhost:8000">SIV</a>              
            </div>
            <div class="clearfix"></div>
          </footer>
          <!-- /footer content -->
        </div>
      </div>
    </div>
      <script src="https://unpkg.com/vue-toastr-2/dist/vue-toastr-2.js"></script>
      <script src="/js/app.js"></script>
      <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <script src="/js/dashboard/nprogress.js"></script>
      <script src="/js/dashboard/custom.min.js"></script>      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
      <script>
      $(".modal-fullscreen").on('show.bs.modal', function () {
          setTimeout( function() {
              $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
          }, 0);
      });

      $(".modal-fullscreen").on('hidden.bs.modal', function () {
          $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
      });
      </script>
      @yield('scripts')

  </body>
</html>
