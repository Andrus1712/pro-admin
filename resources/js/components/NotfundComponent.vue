<template>
	<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- 404 Error Text -->
        <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Page Not Found</p>
            <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
            <router-link :to="{ name: 'dashboard' }" class="nav-link">&larr; Back to Dashboard</router-link>
        </div>

            

    </div>
    <!-- /.container-fluid -->
</template>

<script>
export default {

  name: 'NotfundComponent',

  data () {
    return {

    }
  }
}
</script>

<style lang="css" scoped>
</style>