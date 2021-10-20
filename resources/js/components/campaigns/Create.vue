<template>
  <v-app>
    <v-form @submit.prevent="submit">
      <v-card-title class="d-flex justify-center">Create Campaign</v-card-title>
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
            name="giftItems"
            label="Select Items To Put In Gift Box"
            multiple
            return-object
          ></v-combobox>
          <v-alert text type="error" v-if="errors && errors.item_carts">{{
            errors.item_carts[0]
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
                    return-object
                    v-model="giftItemUsed.value"
                    label="Amount"
                  ></v-text-field>
                  <v-alert
                    text
                    type="error"
                    v-if="errors && errors.giftItemUsed"
                    >{{ errors.gifttemUsed }}</v-alert
                  >
                </td>
              </tr>
            </tbody>
          </v-simple-table>
          <v-btn class="mt-4" type="submit" dark> Create </v-btn>
        </v-col>
      </div>
    </v-form>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      fields: {
        item_carts: "",
      },
      campaignStatuses: [],
      giftItems: [],
      errors: {},
      menu: false,
      menu2: false,
    };
  },
  mounted() {
    this.loadCampaignStatuses();
    this.loadGiftItems();
  },
  methods: {
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
    submit() {
      axios
        .post("/giftbox/public/api/campaigns", this.fields)
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