<template>
   <div class="card border-left-info shadow h-100 py-2">
      <div class="card-header">Profile</div>

      <div class="card-body">
         This roles
         {{ $auth.roles() }}
         <br />
         is admin ?
         {{ $auth.isAdmin() }}
         <br />
         permisos
         {{ $auth.permissions() }}
      </div>
   </div>
</template>

<script>
export default {};
</script>

<style>
</style>
