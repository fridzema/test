<template>
  <div>
    <div class="ui top attached menu">
      <div class="ui icon item" v-on:click="uploader = !uploader">
        <i class="plus icon"></i>
      </div>
      <div class="right menu">
        <div class="ui right aligned item">
          <div class="ui transparent icon input">
            <input name="query"
              type="text"
              placeholder="Keywords..."
              @input="getResults"
              v-model="searchQuery">
            <i class="search link icon"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="ui bottom attached clearing segment">
      <uploader v-if="uploader"></uploader>
      <div v-if="results.data.length" class="ui six cards" id="sortable-container">
        <div class="card" v-for="item in results.data" :data-model-id="item.id">
          <!-- <div class="content">
            <div class="ui mini basic buttons right floated">
              <a class="ui icon button" :href="'/admin/photo/' + item.id"><i class="eye icon"></i></a>
              <div class="ui icon button drag-handle"><i class="move icon"></i></div>
              <div class="ui icon button"><i class="pencil icon"></i></div>
              <div class="ui icon button"><i class="trash icon"></i></div>

            </div>

            <div class="ui mini ribbon label black">{{ item.filename }}</div>
            <div class="description">

            </div>
          </div>
          <div class="image">
            <img class="ui image" :src="item.thumbnails[200]" :title="item.filename" :alt="item.filename" />
          </div>
        </div> -->
        <div class="content">
<!--                      <div class="ui mini basic buttons right floated">
              <a class="ui icon button" :href="'/admin/photo/' + item.id"><i class="eye icon"></i></a>
              <div class="ui icon button drag-handle"><i class="move icon"></i></div>
              <div class="ui icon button"><i class="pencil icon"></i></div>
              <div class="ui icon button"><i class="trash icon"></i></div>

            </div> -->
          <img class="right floated mini ui image" :src="item.thumbnails[200]">
          <div class="header">
            {{ item.filename }}
          </div>
          <div class="meta">
            Friends of Veronika
          </div>
          <div class="description">
            Elliot requested permission to view your contact details
          </div>
        </div>
        <div class="extra content">
          <div class="ui two buttons">
            <div class="ui basic green button">Approve</div>
            <div class="ui basic red button">Decline</div>
          </div>
        </div>
        </div>
      </div>
      <div v-else class="ui message warning">
        No results
      </div>
      <pagination
        :data="results"
        v-bind:showDisabled="true"
        icon="chevron"
        :limit="3"
        v-on:change-page="getResults"
      ></pagination>
    </div>
  </div>
</template>

<script>
  import Event from '../event.js';

    export default {
      data() {
        return {
          results: {},
          totalResults: 0,
          searchQuery: '',
          uploader: false
        };
      },
      created() {
        this.getResults();
        this.makeSortable()

        Event.$on('AllFilesUploaded', (response) => {
          this.getResults()
        });

        console.log('Photogrid mounted')
      },
      methods: {
          getResults(page) {
            axios
              .post('/api/search/photos', {
                query: this.searchQuery,
                page: page || 1,
              })
              .then(
                response => (
                  (this.results = response.data)
                )
              );
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
        }
    }
</script>
