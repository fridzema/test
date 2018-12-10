<template>
  <form id="dropzone" class="dropzone">
    <div class="dz-message" data-dz-message><i class="upload icon"></i></div>
  </form>
</template>
<style src="../../../public/css/uploader.css"></style>
<script>
    import Event from '../event.js';
    export default {
        mounted() {
          var uploadErrors = false;

          new Dropzone("#dropzone", {
              params: {
                _token: window.Laravel.csrfToken,
              },
              url: '/admin/photos',
              autoProcessQueue: true,
              maxFilesize: 100,
              parallelUploads: 1,
              uploadMultiple: true,
              error: function() {
                uploadErrors = true;
              },
              success: function (evt, response){
                // // console.log(evt, response)
                // this.$emit('ItemAdded', response);
                Event.$emit('FileUploaded', response);
              }
              // queuecomplete: function(){
              //   if(!uploadErrors){
              //     this.$root.$emit('FileUploaded', 'new message!');
              //   }
              // }
          });

          console.log('Uploader mounted')
        }
    }
</script>
