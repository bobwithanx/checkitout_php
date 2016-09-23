    <nav class="navbar navbar-default navbar-static-top">
    	<div class="container">
    		<div class="navbar-header">

    			<!-- Collapsed Hamburger -->
    			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
    				<span class="sr-only">Toggle Navigation</span>
    				<span class="icon-bar"></span>
    				<span class="icon-bar"></span>
    				<span class="icon-bar"></span>
    			</button>

    			<!-- Branding Image -->
    			<a class="navbar-brand" href="{{ url('/') }}">
    				CheckItOut
    			</a>
    		</div>

    		<div class="collapse navbar-collapse" id="app-navbar-collapse">
    			<!-- Left Side Of Navbar -->
    			<ul class="nav navbar-nav navbar-right">
    				@if (! Auth::guest())
                    @endif
    			</ul>
    			<!-- Right Side Of Navbar -->
    			<ul class="nav navbar-nav navbar-right">
    				<!-- Authentication Links -->
    				@if (Auth::guest())
        				<li><a href="{{ url('/login') }}">Login</a></li>
    				@else
                        @if (Auth::user()->name == 'Admin')
                            <li><a href="{{ url('/reports') }}"><i class="fa fa-bar-chart" aria-hidden="true"></i> Reports</a></li>
                        @endif
                        <li class="dropdown">
        					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        						{{Auth::user()->name}} <span class="caret"></span>
        					</a>

        					<ul class="dropdown-menu" role="menu">
                                @if (Auth::user()->name == 'Admin')
                                    <li class="dropdown-header">Setup</li>
                                    <li><a href="{{ url('/students/') }}"><i class="fa fa-btn fa-users"></i> Students</a></li>
                                    <li><a href="{{ url('/resources/') }}"><i class="fa fa-btn fa-gears"></i> Resources</a></li>
                                    <li><a href="{{ url('/categories/') }}"><i class="fa fa-btn fa-tags"></i> Categories</a></li>
                                    <li><a href="{{ url('/transactions/') }}"><i class="fa fa-btn fa-exchange"></i> Transactions</a></li>
                                    <li role="separator" class="divider"></li>
                                @endif
        						<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
        					</ul>
        				</li>
    				@endif
    			</ul>
    		</div>
    	</div>
    </nav>
