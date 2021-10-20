<template>
  <v-app>
    <v-simple-table :class="{ loading: loading }">
      <template v-slot:default>
        <thead>
          <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Open The Box</th>
            <th>Dispatch Date</th>
            <th>Delivery Date</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="giftCampaign in giftCampaigns" :key="giftCampaign.id">
            <td>{{ giftCampaign.name }}</td>
            <td>{{ giftCampaign.campaign_status.status }}</td>
            <td v-if="giftCampaign.campaign_status.status == 'Completed'">
              <router-link
                :to="{
                  name: 'enrolledCampaignsShow',
                  params: { id: giftCampaign.id },
                }"
                >View Gift Box
              </router-link>
            </td>
            <td v-else>Wait For Box To Be Delivered</td>
            <td>{{ giftCampaign.dispatch_date }}</td>
            <td>{{ giftCampaign.delivery_date }}</td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </v-app>
</template>

<script>
export default {
  data: function () {
    return {
      giftCampaigns: [],
      loading: false,
    };
  },
  mounted() {
    this.loadUser();
    this.loadGiftCampaigns();
  },
  methods: {
    loadGiftCampaigns: function () {
      axios
        .get("/giftbox/public/api/enrolled-campaigns")
        .then((response) => {
          this.giftCampaigns = response.data.data;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    loadUser: function () {
      axios
        .get("/giftbox/public/api/user")
        .then((response) => {})
        .catch((error) => {});
    },
  },
};
</script>