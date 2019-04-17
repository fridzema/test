<template>
  <div
    class="ui right floated pagination menu"
    :class="size"
    v-if="data.meta.total > data.meta.per_page"
  >
    <a class="item" @click.prevent="selectPage(--data.meta.current_page)" v-if="data.links.prev">
      <i class="left icon" :class="icon"></i>
    </a>
    <a class="disabled item" v-if="showDisabled && !data.links.prev">
      <i class="left icon" :class="icon"></i>
    </a>
    <a
      class="item"
      v-for="n in getPages()"
      :class="{active: n == data.meta.current_page}"
      @click.prevent="selectPage(n)"
    >
      {{ n }}
    </a>
    <a class="item" @click.prevent="selectPage(++data.meta.current_page)" v-if="data.links.next">
      <i class="right icon" :class="icon"></i>
    </a>
    <a class="disabled item" v-if="showDisabled && !data.links.next">
      <i class="right icon" :class="icon"></i>
    </a>
  </div>
</template>

<script>
export default {
  props: {
    showDisabled: {
      type: Boolean,
      default: false,
      required: false,
    },
    icon: {
      type: String,
      default: 'angle double',
      required: false,
    },
    size: {
      type: String,
      default: 'mini',
      required: false,
    },
    data: {
      type: Object,
      default: function() {
        return {
          data: [],
          links: {
            first: null,
            last: null,
            prev: null,
            next: null,
          },
          meta: {
            current_page: 1,
            from: 1,
            last_page: 1,
            path: null,
            per_page: 10,
            to: 1,
            total: 0,
          },
        };
      },
      required: true,
    },
    limit: {
      type: Number,
      default: 0,
      required: false,
    },
  },

  methods: {
    selectPage: function(page) {
      this.$emit('change-page', page);
    },
    getPages: function() {
      if (this.limit === -1) {
        return 0;
      }

      if (this.limit === 0) {
        return this.data.meta.last_page;
      }

      var start = this.data.meta.current_page - this.limit,
        end = this.data.meta.current_page + this.limit + 1,
        pages = [],
        index;

      start = start < 1 ? 1 : start;
      end = end >= this.data.meta.last_page ? this.data.meta.last_page + 1 : end;

      for (index = start; index < end; index++) {
        pages.push(index);
      }

      return pages;
    },
  },
};
</script>
