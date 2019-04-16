<template>
    <div class="ui three cards" id="sortable-container">
      <div class="card" v-for="item in items" :data-model-id="item.id">
        <div class="content">
          <div class="ui mini basic buttons right floated blue">
            <a class="ui icon button" :href="'/admin/photo/' + item.id"><i class="eye icon"></i></a>
            <div class="ui icon button drag-handle"><i class="move icon"></i></div>
            <div class="ui icon button"><i class="pencil icon"></i></div>
            <div class="ui icon button"><i class="trash icon"></i></div>

          </div>

          <div class="ui ribbon label black">{{ item.filename }}</div>
          <div class="description">

          </div>
        </div>
        <div class="image">
          <img class="ui image" :src="item.thumbnails[200]" :title="item.filename" alt="Photo not found" />
        </div>
      </div>
      <infinite-loading @distance="1" @infinite="infiniteHandler"></infinite-loading>
    </div>
</template>

<script>
  import Event from '../event.js';

    export default {
        data () {
          return {
            items: [],
            page: 1
          }
        },
       methods: {
          infiniteHandler($state) {
              let vm = this;

              this.$http.get('/api/photos?page='+this.page)
                  .then(response => {
                      return response.json();
                  }).then(data => {
                      data.data.forEach(function (value, key) {
                        vm.items.push(value);
                      });

                      $state.loaded();
                  });

              this.page = this.page + 1;
          },
          fetch() {
            axios
            .get('/api/photos')
            .then(response => (this.items = response.data.data))
          },
          makeSortable() {
            var el = document.getElementById('sortable-container');
            var sortable = Sortable.create(el, {
              dataIdAttr: 'data-model-id',
              handle: '.drag-handle',
              sort: true,
              animation: 150,
              scrollSensitivity: 150,
              scrollSpeed: 100,
              onEnd: function (evt) {
                axios.post('/admin/photos/reorder', {sort_order: sortable.toArray()});
              },
            });
          }
        },
        mounted() {
          this.fetch()
          this.makeSortable()

          Event.$on('AllFilesUploaded', (response) => {
            this.fetch()
          });

          console.log('Photogrid mounted')
        }
    }
</script>
