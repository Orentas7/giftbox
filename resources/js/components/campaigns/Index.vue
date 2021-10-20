<template>
  <v-app>
    <v-simple-table :class="{ loading: loading }">
      <template v-slot:default>
        <thead>
          <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Rating</th>
            <th>Dispatch Date</th>
            <th>Delivery Date</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="giftCampaign in giftCampaigns" :key="giftCampaign.id">
            <td>{{ giftCampaign.name }}</td>
            <td>{{ giftCampaign.campaign_status.status }}</td>
            <td>
              {{ averageRating(giftCampaign.comments) }}
            </td>
            <td>{{ giftCampaign.dispatch_date }}</td>
            <td>{{ giftCampaign.delivery_date }}</td>
            <td>
              <router-link
                :to="{ name: 'campaignShow', params: { id: giftCampaign.id } }"
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
                @click="deleteCampaign(giftCampaign.id)"
              >
                <v-icon>mdi-delete</v-icon>
              </v-btn>
            </td>
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
      loading: true,
    };
  },
  mounted() {
    this.loadGiftCampaigns();
  },
  methods: {
    loadGiftCampaigns: function () {
      axios
        .get("/giftbox/public/api/campaigns")
        .then((response) => {
          this.giftCampaigns = response.data.data;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteCampaign(id) {
      axios
        .delete(`/giftbox/public/api/campaigns/${id}`)
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    averageRating(data) {
      var count = 0,
        avgRating = 0;
      for (var key in data) {
        if (data.hasOwnProperty(key)) {
          if (data[key].hasOwnProperty("star")) {
            avgRating += data[key].star;
            count += 1;
          }
        }
      }
      if (isNaN(avgRating / count)) {
        return "No Data";
      } else {
        return avgRating / count;
      }
    },
  },
};
</script>