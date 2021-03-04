<template>
	<!-- Spinner Loader -->
	<div class="spinner-background">
		<div class="spinner"></div>
	</div>
</template>

<script>
export default {

  name: 'SpinnerComponent',

  data () {
    return {

    }
  }
}
</script>

<style lang="css" scoped>

   .spinner {
      border: 6px solid rgba(0, 0, 0, .1);
      width: 45px;
      height: 45px;
      border-radius: 50%;
      border-left-color: #4e73df;
      position: absolute; /* cambiamos de fixed a absolute */
      /* Ponemos el valor de left, bottom, right y top en 0 */
      left: 0;
      bottom: 0; 
      right: 0; 
      top: 0; 
      margin: auto; /* Centramos vertical y horizontalmente */

      animation: spin 1s ease infinite;
   }
   .spinner-background {
        width: 100%;
        height: 100%;
        position: fixed; /* Cambiamos de absolute a relative */
        background-color: #fff7;
        z-index: 9000;
        -webkit-transition: all 1s;
        -o-transition: all 1s;
        transition: all 1s;
    }

   @keyframes spin {
      0% {
         transform: rotate(0deg);
      }

      100% {
         transform: rotate(360deg);
      }
   }
</style>