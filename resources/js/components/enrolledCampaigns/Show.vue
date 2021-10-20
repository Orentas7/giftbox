<template>
  <v-app>
    <v-card class="mx-auto p-4" min-width="600" tile>
      <v-list-item two-line>
        <v-list-item-content>
          <v-list-item-title>
            Gift Box: {{ fields.name | capitalize }}
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-simple-table class="mb-4">
        <template>
          <thead>
            <tr>
              <th class="text-left">Item</th>
              <th class="text-left">Amount</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="giftItemUsed in fields.item_carts"
              :key="giftItemUsed.id"
            >
              <td>{{ giftItemUsed.name | capitalize }}</td>
              <td>{{ giftItemUsed.value }}</td>
            </tr>
          </tbody>
        </template>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title> Leave us your feedback! </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-simple-table>
      <v-form @submit.prevent="submit()">
        <v-sheet rounded outlined class="mb-2 p-2">
          <v-list-item-title>
            {{ user.name | capitalize }}
          </v-list-item-title>
          <v-textarea
            v-model="fields.body"
            auto-grow
            label="Write what you liked, or did not :("
            rows="2 "
            row-height="20"
          ></v-textarea>
          <div class="d-flex flex-row">
            <v-list-item-title>Rate Us!</v-list-item-title>
            <v-rating v-model="fields.star"></v-rating>
          </div>
          <div class="d-flex justify-end">
            <v-btn class="mt-4 primary" type="submit">Post</v-btn>
          </div>
        </v-sheet>
      </v-form>
    </v-card>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      fields: {},
      campaignStatuses: [],
      giftItems: [],
      item_carts: [],
      giftItemUsed: "",
      user: "",
    };
  },
  mounted() {
    this.loadGiftCampaigns(this.$route.params.id);
    this.loadCampaignStatuses();
    this.loadUser();
  },
  methods: {
    loadGiftCampaigns: function (campaignId) {
      axios
        .get(`/giftbox/public/api/campaigns/${campaignId}`)
        .then((response) => {
          this.fields = response.data.giftCampaign;
          this.fields.item_carts = response.data.giftItems;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    loadCampaignStatuses: function () {
      axios.get("/giftbox/public/api/campaign-statuses").then((response) => {
        this.campaignStatuses = response.data.data;
      });
    },
    loadUser: function () {
      axios
        .get("/giftbox/public/api/user")
        .then((response) => {
          this.user = response.data;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    submit() {
      axios
        .post("/giftbox/public/api/comments", this.fields)
        .then((respone) => {
          this.fields = {};
          this.loadGiftCampaigns(this.$route.params.id);
          this.loadCampaignStatuses();
          this.loadUser();
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
