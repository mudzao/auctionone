<template>
  <div class="row">
    <div class="col-sm-12">
      <h6>
        {{ count }} in session now with me
        {{ user.name }} and highest bid is {{ highestBid }}
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
        <div class="col-8">
          <div class="row">
            <div class="col-6">
              <input
                id="price"
                type="number"
                class="form-control"
                required
                autofocus
                v-model="price"
                @keyup.enter="postBid()"
              />
            </div>
            <div class="col-6">
              <button class="btn btn-primary" @click.prevent="postBid()">
                Place Bid
              </button>
            </div>
          </div>
        </div>
        <div class="col-4">
          <button class="btn btn-dark" @click.prevent="quickBid()">
            Quick Bid {{ nextPrice }}
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
      highestBid: 0,
    };
  },

  computed: {
    nextPrice: {
      get() {
        return parseFloat(this.highestBid) + parseFloat(this.lot.step);
      },
      set() {},
    },
  },

  mounted() {
    this.listen();
    this.getBids();
    this.getHighestBid();
  },
  methods: {
    getBids() {
      axios.get("/vlot/" + this.lot.id + "/bids").then((response) => {
        this.bids = response.data;
      });
    },
    getHighestBid() {
      axios.get("/vlot/" + this.lot.id + "/highestbid").then((response) => {
        this.highestBid = response.data;
      });
    },
    postBid() {
      axios
        .post("/vlot/" + this.lot.id + "/bid", {
          price: this.price,
        })
        .then((response) => {
          this.price = "";
          this.highestBid = response.data.price;
          this.bids.unshift(response.data);
        });
    },
    quickBid() {
      axios
        .post("/vlot/" + this.lot.id + "/bid", {
          price: this.nextPrice,
        })
        .then((response) => {
          this.highestBid = response.data.price;
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
          this.highestBid = e.price;
          this.bids.unshift(e);
        });
    },
  },
};
</script>