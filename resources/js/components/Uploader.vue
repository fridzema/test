<template>
<div>
<div id="choose-files">
  <form action="/upload">
    <input type="file" />
  </form>
</div>
</div>
</template>

<script>
const Uppy = require('@uppy/core')
const Dashboard = require('@uppy/dashboard')
const GoogleDrive = require('@uppy/google-drive')
const Dropbox = require('@uppy/dropbox')


    import Event from '../event.js';
    export default {
        methods: {

        },
        mounted() {


          const uppyOne = new Uppy({
            debug: true,
            meta: {
              _token: window.Laravel.csrfToken
            },
            autoProceed: false,
            restrictions: {
              maxFileSize: 1000000,
              maxNumberOfFiles: 3,
              minNumberOfFiles: 2,
              allowedFileTypes: ['image/*', 'video/*']
            }
          })

          uppyOne
        .use(Dashboard, {
          trigger: '.UppyModalOpenerBtn',
          inline: true,
          target: '#choose-files',
          replaceTargetContent: true,
          showProgressDetails: true,
          note: 'Images and video only, 2–3 files, up to 1 MB',
          height: 470,
          metaFields: [
            { id: 'name', name: 'Name', placeholder: 'file name' },
            { id: 'caption', name: 'Caption', placeholder: 'describe what the image is about' }
          ],
          browserBackButtonClose: true
        })
        .use(GoogleDrive, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
        .use(Dropbox, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })

        uppy.on('complete', result => {
          console.log('successful files:', result.successful)
          console.log('failed files:', result.failed)
        })
      }
  }
</script>
