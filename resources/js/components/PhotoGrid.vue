<template>
  <div class="ui segment">
    <div class="ui four cards" id="photos">
      <div class="card" v-for="item in items">
        <div class="content">
          <div class="ui mini buttons right floated blue">
            <div class="ui icon button drag-handle"><i class="move icon"></i></div>
            <div class="ui icon button"><i class="pencil icon"></i></div>

          </div>

          <div class="ui ribbon label black">{{ item.filename }}</div>
          <div class="description">

          </div>
        </div>
        <div class="image">
          <img class="ui image" :src="item.thumbnails[200]" :title="item.filename" alt="Photo not found" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        data () {
          return {
            items: []
          }
        },
        mounted() {
          axios
          .get('/admin/photos')
          .then(response => (this.items = response.data))

          console.log('Photogrid mounted')
        }
    }
</script>
