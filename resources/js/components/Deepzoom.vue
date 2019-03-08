<template>
  <div id="openseadragon" style="width: 100%; height: 600px;"></div>
</template>
<!-- <style src="../../../public/css/uploader.css"></style> -->
<script>
    import Event from '../event.js';
    export default {
        // methods: {
        //   reset(Uploader){
        //     Uploader.removeAllFiles();
        //   }
        // },
        mounted() {

          var viewer = window.OpenSeadragon({
            id: "openseadragon",
            tileSources: "/img/deepzoom/photo.dzi",
            showNavigationControl: false,
            defaultZoomLevel:  1,
            minZoomLevel:  1,
            visibilityRatio:  1,
            showRotationControl: true,
            preserveViewport: true,
            gestureSettingsTouch: {
                pinchRotate: true
            },
            zoomPerScroll: 1.5
          });

          console.log('Deepzoom mounted')
        }
    }
</script>
