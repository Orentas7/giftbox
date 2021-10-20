<template>
  <v-app>
    <v-form @submit.prevent="updateGiftItem">
      <v-card-title class="d-flex justify-center">Edit Gift Item</v-card-title>
      <div class="d-flex justify-center">
        <v-col cols="12" sm="6" md="4">
          <v-text-field
            v-model="giftItem.name"
            label="Item Name"
            required
          ></v-text-field>
          <v-alert text type="error" v-if="errors && errors.name">{{
            errors.name[0]
          }}</v-alert>
          <v-text-field
            v-model="giftItem.unit_price"
            label="Unit Price"
            required
          ></v-text-field>
          <v-alert text type="error" v-if="errors && errors.unit_price">{{
            errors.unit_price[0]
          }}</v-alert>
          <v-text-field
            v-model="giftItem.unit_owned"
            label="Unit's Owned"
            required
          ></v-text-field>
          <v-alert text type="error" v-if="errors && errors.unit_owned">{{
            errors.unit_owned[0]
          }}</v-alert>
          <v-btn class="mt-4" type="submit" dark> Update </v-btn>
        </v-col>
      </div>
    </v-form>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      giftItem: [],
      loading: true,
      errors: {},
    };
  },
  mounted() {
    this.loadGiftItem(this.$route.params.id);
  },
  methods: {
    loadGiftItem: function (giftItemId) {
      axios
        .get(`/giftbox/public/api/gift-items/${giftItemId}`)
        .then((response) => {
          this.giftItem = response.data;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    updateGiftItem() {
      axios
        .patch(
          `/giftbox/public/api/gift-items/${this.$route.params.id}`,
          this.giftItem
        )
        .then((respone) => {
          this.loadGiftItem(this.$route.params.id);
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
  },
};
</script>