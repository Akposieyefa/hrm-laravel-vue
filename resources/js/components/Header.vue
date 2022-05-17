<template>
    <header class="bg-surface-primary border-bottom pt-6 pb-10">
        <div class="container-fluid">
            <div class="mb-npx">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                        <!-- Title -->
                        <h3 class="h2 mb-0 ls-tight">Dashboard</h3>
                    </div>
                    <div class="col-sm-6 col-12 text-sm-end" v-if="user.role === 'employee'">
                        <div class="mx-n1">
                            <button @click=" clockInToday()"  class="btn d-inline-flex btn-sm btn-dark mx-1">
                                    <span class=" pe-2">
                                        <i class="bi bi-plus"></i>
                                    </span>
                                <span>ClockIn</span>
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </header>
</template>

<script>
import {mapGetters} from "vuex";
import axios from "axios";

export default {
    name: "Header",
    computed: {
        ...mapGetters(["user"]),
    },
    methods : {
        async clockInToday()
        {
            try {
                let api_url = process.env.MIX_API_BASE_URL + 'attendances'
                let today = new Date();
                let time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

                let month = today.getUTCMonth() + 1; //months from 1-12
                let day = today.getUTCDate();
                let year = today.getUTCFullYear();
                const response = await axios.post(
                    api_url,
                    {
                        auth_date: year + "-" + month + "-" + day,
                        clock_in: time
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem("token")}`,
                        },
                    }
                );
                this.$toasted.success(response.data.message)
            } catch (e) {
                this.$toasted.error(e.response.data.message)
            }
        }
    }
}
</script>

<style scoped>

</style>
