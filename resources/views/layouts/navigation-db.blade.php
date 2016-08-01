<div class="panel panel-default">
	<div class="list-group">
		<a href="{{ url('/students/') }}" class="list-group-item {{{ (Request::is('students') ? '-active' : '') }}}">
			<span class="fa fa-fw fa-users"></span> Students
		</a>
		<a href="{{ url('/resources/') }}" class="list-group-item {{{ (Request::is('resources') ? '-active' : '') }}}">
			<span class="fa fa-fw fa-gears"></span> Resources
		</a>
		<a href="{{ url('/categories/') }}" class="list-group-item {{{ (Request::is('categories') ? '-active' : '') }}}">
			<span class="fa fa-fw fa-tags"></span> Categories
		</a>
	</div>
</div>