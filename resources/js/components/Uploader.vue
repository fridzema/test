<template>
  <form id="dropzone" class="dropzone">
    <div class="dz-message" data-dz-message><i class="upload icon"></i></div>
  </form>
</template>
<style src="../../../public/css/uploader.css"></style>
<script>
    import Event from '../event.js';
    export default {
        methods: {
          reset(Uploader){
            Uploader.removeAllFiles();
          }
        },
        mounted() {
          var component = this;

          var uploadErrors = false;

          var Uploader = new Dropzone("#dropzone", {
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
              // success: function (evt, response){
              //   Event.$emit('FileUploaded', response);
              // },
              queuecomplete: function(){
                if(!uploadErrors){
                  Event.$emit('AllFilesUploaded', true);
                  component.reset(Uploader);
                }
              }
          });

          console.log('Uploader mounted')
        }
    }
</script>
