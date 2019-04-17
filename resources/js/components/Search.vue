<template>
  <div class="ui grid">
    <div class="ui top attached menu">
      <div class="ui icon item"></div>
      <div class="header item">Search {{ settings.model }}</div>
    </div>

    <div class="fourteen wide column">
      <table
        id="search_table"
        class="ui striped celled small very selectable compact table sortable clearing"
      >
        <thead>
          <tr>
            <th
              v-for="column in settings.fields.columns"
              :key="column.id"
              v-if="column.display"
              :data-column="column.field"
              v-bind:class="columnWidthClasses(column)"
            >
              {{ column.display_name }}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="result in results.data" :key="result.id">
            <td
              v-for="column in settings.fields.columns"
              :key="column.id"
              v-if="column.display"
              v-html="GetObject(result, column.display_field || column.field)"
            ></td>
          </tr>
        </tbody>
      </table>

      <pagination
        :data="results"
        v-bind:showDisabled="true"
        icon="chevron"
        :limit="3"
        v-on:change-page="getResults"
      ></pagination>
    </div>

    <div class="two wide column">
      <div class="ui vertical tiny menu fluid sticky_menu">
        <div class="item">
          <div
            class="ui green fluid mini button tooltip"
            data-content="Total results"
            v-if="totalResults"
          >
            {{ totalResults }}
          </div>
        </div>
        <div class="item">
          <div class="ui input">
            <input
              class="search_input"
              name="query"
              type="text"
              placeholder="Keywords..."
              @input="getResults"
              v-model="searchQuery"
            />
          </div>
        </div>

        <div class="item">
          <a class="ui button mini orange fluid icon labeled clear_filter_toggle"
            ><i class="icon remove"></i>Clear</a
          >
        </div>

        <div class="item">
          <button class="ui button fluid mini blue icon labeled filter_toggle">
            <i class="icon search"></i>Search
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['settings'],
  mounted() {
    console.log('Search mounted.');
  },
  data() {
    return {
      results: {},
      modelName: this.settings.model,
      totalResults: 0,
      searchQuery: '',
    };
  },
  created() {
    this.getResults();
  },
  methods: {
    getResults(page) {
      axios
        .post('/api/vue_search/search/' + this.modelName, {
          query: this.searchQuery,
          page: page || 1,
        })
        .then(
          response => (
            (this.results = response.data), (this.totalResults = response.data.meta.total)
          )
        );
    },
    columnWidthClasses: function(column) {
      return column.width_class_name !== undefined ? column.width_class_name + ' wide' : null;
    },
  },
};
</script>
