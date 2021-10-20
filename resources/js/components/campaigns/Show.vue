<template>
  <v-app>
    <v-form @submit.prevent="submit(fields.id)">
      <v-card-title class="d-flex justify-center">Edit Campaign</v-card-title>
      <div class="d-flex justify-center">
        <v-col cols="12" sm="6" md="4">
          <v-text-field
            v-model="fields.name"
            label="Campaign Name"
            required
          ></v-text-field>
          <v-alert text type="error" v-if="errors && errors.name">{{
            errors.name[0]
          }}</v-alert>
          <v-select
            v-model="fields.campaign_status_id"
            :menu-props="{ top: true, offsetY: true }"
            :items="campaignStatuses"
            item-value="id"
            name="campaignStatuses"
            item-text="status"
            label="Select a status"
          />
          <v-alert
            text
            type="error"
            v-if="errors && errors.campaign_status_id"
            >{{ errors.campaign_status_id[0] }}</v-alert
          >
          <v-menu
            v-model="menu"
            :close-on-content-click="false"
            transition="scale-transition"
            offset-y
            min-width="auto"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-text-field
                v-model="fields.dispatch_date"
                label="Dispatch Date"
                readonly
                v-bind="attrs"
                v-on="on"
              ></v-text-field>
            </template>
            <v-date-picker
              v-model="fields.dispatch_date"
              @input="menu = false"
            ></v-date-picker>
          </v-menu>

          <v-menu
            v-model="menu2"
            :close-on-content-click="false"
            transition="scale-transition"
            offset-y
            min-width="auto"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-text-field
                v-model="fields.delivery_date"
                label="Delivery Date"
                readonly
                v-bind="attrs"
                v-on="on"
              ></v-text-field>
            </template>
            <v-date-picker
              v-model="fields.delivery_date"
              @input="menu2 = false"
            ></v-date-picker>
          </v-menu>

          <v-combobox
            v-model="fields.item_carts"
            :items="giftItems"
            item-value="id"
            item-text="name"
            label="Select Items To Put In Gift Box"
            multiple
            return-object
          ></v-combobox>
          <v-alert text type="error" v-if="errors && errors.itemCarts">{{
            errors.itemCarts[0]
          }}</v-alert>
          <v-simple-table>
            <tbody>
              <tr
                v-for="giftItemUsed in fields.item_carts"
                :key="giftItemUsed.id"
              >
                <td class="pr-2">
                  <v-input>
                    {{ giftItemUsed.name }}
                  </v-input>
                </td>
                <td class="pr-2">
                  <v-text-field
                    v-model="giftItemUsed.value"
                    label="Amount"
                  ></v-text-field>
                  <v-alert
                    text
                    type="error"
                    v-if="errors && errors.item_carts"
                    >{{ errors.value }}</v-alert
                  >
                </td>
              </tr>
            </tbody>
          </v-simple-table>
          <v-btn class="mt-4" type="submit" dark> Update </v-btn>
        </v-col>
      </div>
    </v-form>

    <div class="d-flex justify-center">
      <v-sheet v-if="fields.comments" class="flex-column justify-end">
        <v-card-title class="d-flex justify-center"
          >Campaign's Feedback</v-card-title
        >
        <v-sheet
          v-for="comment in fields.comments"
          :key="comment.id"
          width="450"
          rounded
          outlined
          class="mb-2"
        >
          <v-list-item-title class="p-2"
            >{{ comment.user.name | capitalize }}
            <v-list-item-title>
              {{ comment.body }}
            </v-list-item-title>
            <div class="d-flex flex-row">
              <v-list-item-title>Rated</v-list-item-title>
              <v-rating v-model="comment.star"></v-rating>
            </div>
          </v-list-item-title>
        </v-sheet>
      </v-sheet>
    </div>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      fields: { item_carts: "" },
      campaignStatuses: [],
      giftItems: [],
      item_carts: {},
      errors: {},
      comments: {},
      menu: false,
      menu2: false,
    };
  },
  mounted() {
    this.loadGiftCampaigns(this.$route.params.id);
    this.loadCampaignStatuses();
    this.loadGiftItems();
  },
  methods: {
    loadGiftCampaigns: function (campaignId) {
      axios
        .get(`/giftbox/public/api/campaigns/${campaignId}`)
        .then((response) => {
          this.fields = response.data.giftCampaign;
          this.fields.item_carts = response.data.giftItems;
          // this.comments = response.data.giftCampaign.comments;
          this.loading = false;
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
    loadGiftItems: function () {
      axios.get("/giftbox/public/api/gift-items").then((response) => {
        this.giftItems = response.data.data;
      });
    },
    submit(campaignId) {
      axios
        .patch(`/giftbox/public/api/campaigns/${campaignId}`, this.fields)
        .then((respone) => {
          this.loadGiftCampaigns(this.$route.params.id);
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