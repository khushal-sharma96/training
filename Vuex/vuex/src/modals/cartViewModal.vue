<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" max-width="490" persistent >
      <v-btn class="mx-2" fab dark x-small color="red" >
        <v-icon dark @click="closeModal"> mdi-close </v-icon>
      </v-btn>

      <v-card>
        <!-- <template slot="progress">
          <v-progress-linear
            color="deep-purple"
            height="10"
            indeterminate
          ></v-progress-linear>
        </template> -->

        <v-img
          height="250"
          class="mt-2"
          :src="`/static/${item.name}.jpg`"
          contain
        ></v-img>

        <v-card-title>{{ item.name }}</v-card-title>

        <v-card-text>
          <v-row align="center" class="mx-0">
            Rating:
            <v-rating
              :value="rating"
              color="amber"
              dense
              half-increments
              readonly
              size="14"
            ></v-rating>

            <div class="grey--text ms-4">{{ rating }}</div>
          </v-row>

          <div class="my-4 text-subtitle-1" color="red">$ {{ item.price }}</div>

          <div>
            <v-btn @click="closeModal" color="red">Close</v-btn>
          </div>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {
  data() {
    return {
      dialog: true,
      rating: 4.5,
    };
  },
  props: {
    item: {
      type: Object,
    },
  },
  methods: {
    closeModal() {
      this.$emit("closed");
    },
  },
};
</script>
