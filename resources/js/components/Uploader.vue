<template>
<div id="choose-files" style="margin-bottom: 14px;">
  <form action="/upload">
    <input type="file" />
  </form>
</div>
</template>

<script>
const Uppy = require('@uppy/core')
const Dashboard = require('@uppy/dashboard')
const GoogleDrive = require('@uppy/google-drive')
const Dropbox = require('@uppy/dropbox')
const XHRUpload = require('@uppy/xhr-upload')


    import Event from '../event.js';
    export default {
        methods: {

        },
        mounted() {


          const uppy = new Uppy({
            debug: true,
            meta: {
              _token: window.Laravel.csrfToken
            },
            autoProceed: false,
            restrictions: {
              maxFileSize: 1000000000000,
              allowedFileTypes: ['image/*', 'video/*']
            }
          })


        uppy.use(XHRUpload, {
          endpoint: '/admin/photos'
        })
        .use(Dashboard, {
          trigger: '.UppyModalOpenerBtn',
          inline: true,
          target: '#choose-files',
          replaceTargetContent: true,
          showProgressDetails: true,
          proudlyDisplayPoweredByUppy: false,
          width: '100%',
          showLinkToFileUploadResult: true,
          note: 'Raw images recommended',
          height: 500,
          metaFields: [
            { id: 'name', name: 'Name', placeholder: 'file name' },
            { id: 'caption', name: 'Caption', placeholder: 'describe what the image is about'},
            { id: 'keywords', name: 'Keywords', placeholder: 'tag1, tag2, tag3'},
          ],
          browserBackButtonClose: true
        })
        uppy.on('upload-success', (file, body) => {
          console.log(file, body);
          // do something with extracted response data
          // (`body` is equivalent to `file.response.body` or `uppy.getFile(fileID).response.body`)
        })
      }
  }
</script>
