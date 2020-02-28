
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="image" style="text-align: center;">
          <img src="{{ asset ('dist/img/logo.png') }}" class="" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>iPing Data Labs</p>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="active">
            <a href="{{url('home')}}">
            <i class="fa fa-dashboard"></i> <span>Home
          </a>
        </li>
        
        <li><a class="nav-link" href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i>Manage Users</a></li>
       
        <li><a class="nav-link" href="{{ route('roles.index') }}"><i class="fa fa-circle-o"></i>Manage Role</a></li>
        <li><a class="nav-link" href="{{ url('vertical') }}"><i class="fa fa-circle-o"></i>Vertical</a></li>
        <li><a class="nav-link" href="{{ url('category') }}"><i class="fa fa-circle-o"></i>Category</a></li>
        <li><a class="nav-link" href="{{ url('services') }}"><i class="fa fa-circle-o"></i>Subscription</a></li>               
        <li><a class="nav-link" href="{{ url('user_subscrbed_field') }}"><i class="fa fa-circle-o"></i>User Subscribes Field</a></li>               
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>