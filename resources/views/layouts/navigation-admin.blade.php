<div class="panel panel-default">
	<div class="list-group db-menu">
		<a href="{{ route('admin.students.index') }}" class="list-group-item {{{ (Request::is('students') ? 'active' : '') }}}">
			<span class="fa fa-fw fa-users"></span> Students
		</a>
		<a href="{{ route('admin.resources.index') }}" class="list-group-item {{{ (Request::is('resources') ? 'active' : '') }}}">
			<span class="fa fa-fw fa-gears"></span> Resources
		</a>
		<a href="{{ route('admin.categories.index') }}" class="list-group-item {{{ (Request::is('categories') ? 'active' : '') }}}">
			<span class="fa fa-fw fa-tags"></span> Categories
		</a>
		<a href="{{ url('/admin/loans/') }}" class="list-group-item {{{ (Request::is('loans') ? 'active' : '') }}}">
			<span class="fa fa-fw fa-exchange"></span> Loans
		</a>
	</div>
</div>