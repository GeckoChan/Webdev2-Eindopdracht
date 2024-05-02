<template>
    <div class="container mt-1 ">
      <div class="row">
        <div class="col-md-12">
          <div class="list-group">
            <top-achiever-item
              v-for="achiever in achievers"
              :key="achiever.id"
              :achiever="achiever"
            ></top-achiever-item>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import axios from "../../axios-auth";
import TopAchieverItem from "./TopAchieverItem.vue";
export default {
  name: "TopAchieverList",
  components: {
    TopAchieverItem,
  },
  data() {
    return {
      achievers: [],
    };
  },
  created() {
    this.getTopAchievers();
  },
  methods: {
    getTopAchievers() {
      axios
        .get("users/top", {
            params: {
                limit: 5,
            }
        })
        .then((res) => {
          this.achievers = res.data;
          console.log(this.achievers);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>