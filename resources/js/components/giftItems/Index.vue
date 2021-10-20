<template v-slot:default>
  <v-app>
    <v-simple-table :class="{ loading: loading }">
      <thead>
        <tr>
          <th>Item</th>
          <th>Price</th>
          <th>Owned</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="giftItem in giftItems" :key="giftItem.id">
          <td>{{ giftItem.name }}</td>
          <td>{{ giftItem.unit_price }}</td>
          <td>{{ giftItem.unit_owned }}</td>
          <td>
            <router-link
              :to="{ name: 'giftItemShow', params: { id: giftItem.id } }"
            >
              <v-btn color="primary" fab small dark>
                <v-icon>mdi-pencil</v-icon>
              </v-btn>
            </router-link>
          </td>
          <td>
            <v-btn
              color="red"
              fab
              small
              dark
              @click="deleteGiftItem(giftItem.id)"
            >
              <v-icon>mdi-delete</v-icon>
            </v-btn>
          </td>
        </tr>
      </tbody>
    </v-simple-table>
  </v-app>
</template>

<script>
import Show from "./Show.vue";
export default {
  components: { Show },
  data: function () {
    return {
      giftItems: [],
      loading: true,
    };
  },
  mounted() {
    this.loadGiftItems();
  },
  methods: {
    loadGiftItems: function () {
      axios
        .get("/giftbox/public/api/gift-items")
        .then((response) => {
          this.giftItems = response.data.data;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteGiftItem(id) {
      axios
        .delete(`/giftbox/public/api/gift-items/${id}`)
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
