<template>
  <v-app>
    <v-form @submit.prevent="submit">
      <v-card-title class="d-flex justify-center">Add Gift Item</v-card-title>
      <div class="d-flex justify-center">
        <v-col cols="12" sm="6" md="4">
          <v-text-field
            v-model="fields.name"
            label="Item Name"
            required
          ></v-text-field>
          <v-alert text type="error" v-if="errors && errors.name">{{
            errors.name[0]
          }}</v-alert>
          <v-text-field
            v-model="fields.unit_price"
            label="Unit Price"
            required
          ></v-text-field>
          <v-alert text type="error" v-if="errors && errors.unit_price">{{
            errors.unit_price[0]
          }}</v-alert>
          <v-text-field
            v-model="fields.unit_owned"
            label="Unit's Owned"
            required
          ></v-text-field>
          <v-alert text type="error" v-if="errors && errors.unit_owned">{{
            errors.unit_owned[0]
          }}</v-alert>
          <v-btn type="submit" dark> Create </v-btn>
        </v-col>
      </div>
    </v-form>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      fields: {},
      errors: {},
    };
  },
  methods: {
    submit() {
      axios
        .post("/giftbox/public/api/gift-items", this.fields)
        .then((respone) => {
          this.fields = {};
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
