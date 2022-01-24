<template>
  <div class="row">
    <div class="col-sm-12">
      <h6>
        {{ count }} in session now for Lot {{ lot.name }} and my name is
        {{ user.name }}
      </h6>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th class="text-center">Price</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="bid in bids">
            <th>{{ bid.id }}</th>
            <td>{{ bid.user.name }}</td>
            <td class="text-center">RM {{ bid.price }}</td>
          </tr>
        </tbody>
      </table>
      <div class="row mb-3">
        <div class="col-md-4">
          <input
            id="price"
            type="number"
            class="form-control"
            required
            autofocus
            placeholder="Specify amount"
            v-model="price"
            @keyup.enter="postBid()"
          />
        </div>
        <div class="col-md-4">
          <button class="btn btn-primary" @click.prevent="postBid()">
            Place Bid
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["lot", "user"],

  data() {
    return {
      bids: [],
      price: "",
      count: 0,
    };
  },
  mounted() {
    this.listen();
    this.getBids();
  },
  methods: {
    getBids() {
      axios.get("/vlot/" + this.lot.id + "/bids").then((response) => {
        this.bids = response.data;
      });
    },
    postBid() {
      axios
        .post("/vlot/" + this.lot.id + "/bid", {
          price: this.price,
        })
        .then((response) => {
          this.price = "";
          this.bids.unshift(response.data);
        });
    },
    listen() {
      Echo.join("lot." + this.lot.id)
        .here((users) => {
          this.count = users.length;
        })
        .joining((user) => {
          this.count++;
        })
        .leaving((user) => {
          this.count--;
        })
        .listen("NewBid", (e) => {
          this.bids.unshift(e);
        });
    },
  },
};
</script>