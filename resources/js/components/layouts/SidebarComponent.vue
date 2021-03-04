<template>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
	<!-- Sidebar - Brand -->
    <router-link :to="{ name: 'dashboard' }" class="sidebar-brand d-flex align-items-center justify-content-centernav-link" exact>
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </router-link>
	<!-- Divider -->
	<hr class="sidebar-divider my-0" />
	<!-- Nav Item - Dashboard -->
	<li class="nav-item">
		<router-link :to="{ name: 'dashboard' }" class="nav-link" exact>
	 	<i class="fas fa-fw fa-tachometer-alt"></i>
		<span>Dashboard</span>
		</router-link>
	</li>
	<!-- Divider -->
	<hr class="sidebar-divider" />
	<!-- Heading -->
	<div class="sidebar-heading">Interface</div>
	<li class="nav-item" v-if="$auth.can('view.users')">
		<router-link :to="{ name: 'user' }" class="nav-link" exact>
		<i class="fas fa-fw fa-users"></i>
		<span>Usuarios</span>
		</router-link>
	</li>
	<li class="nav-item" v-if="$auth.can('view.users')">
		<router-link :to="{ name: 'roles' }" class="nav-link" exact>
		<i class="fas fa-fw fa-user-cog"></i>
		<span>Roles</span>
		</router-link>
	</li>
	<li class="nav-item">
		<router-link :to="{ name: 'products' }" class="nav-link" exact>
		<i class="fas fa-fw fa-pencil-alt"></i>
		<span>Productos</span>
		</router-link>
	</li>
	<!-- Divider -->
	<hr class="sidebar-divider" />
	<!-- Heading -->
	<div class="sidebar-heading">Addons</div>
	<!-- Nav Item - Pages Collapse Menu -->
	<li class="nav-item">
		<a
			class="nav-link"
			data-toggle="collapse"
			data-target="#collapsePages"
			aria-expanded="true"
			aria-controls="collapsePages"
			>
			<i class="fas fa-fw fa-folder"></i>
			<span>Pages</span>
		</a>
		<div
			id="collapsePages"
			class="collapse show"
			aria-labelledby="headingPages"
			data-parent="#accordionSidebar"
			>
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Login Screens:</h6>
				<a class="collapse-item" href="login.html">Login</a>
				<a class="collapse-item" href="register.html">Register</a>
				<a class="collapse-item" href="forgot-password.html"
				>Forgot Password</a
				>
				<div class="collapse-divider"></div>
				<h6 class="collapse-header">Other Pages:</h6>
				<a class="collapse-item" href="404.html">404 Page</a>
				<a class="collapse-item" href="blank.html">Blank Page</a>
			</div>
		</div>
	</li>
	<!-- Nav Item - Charts -->
	<li class="nav-item">
		<a class="nav-link" href="charts.html">
			<i class="fas fa-fw fa-chart-area"></i>
			<span>Charts</span>
		</a>
	</li>
	<!-- Nav Item - Tables -->
	<li class="nav-item">
		<a class="nav-link" href="tables.html">
			<i class="fas fa-fw fa-table"></i>
			<span>Tables</span>
		</a>
	</li>
    <hr class="sidebar-divider" />
	<!-- Nav Item - Charts -->
	<li class="nav-item">
		<a class="nav-link" href="/home">
			<i class="fas fa-fw fa-arrow-left"></i>
			<span>Home</span>
		</a>
	</li>
	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block" />
	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>
<!-- End of Sidebar -->

</template>

<script>
export default {

  name: 'SidebarComponent',

  data () {
    return {

    }
  }
}
</script>

<style lang="css" scoped>

</style>
