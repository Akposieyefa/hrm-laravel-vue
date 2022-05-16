<template>
    <div>
        <!-- Dashboard -->
        <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
            <!-- Vertical Navbar -->
            <Nav />

            <!-- Main content -->
            <div class="h-screen flex-grow-1 overflow-y-lg-auto">
                <!-- Header -->
                <Header />
                <!-- Main -->
                <main class="py-6 bg-surface-secondary">
                    <div class="container-fluid">
                        <!-- Card stats -->

                        <DashboardComponent v-if="user.role === 'admin'"/>

                        <!-- End of card state -->
                        <div class="card shadow border-0 mb-7" v-if="user.role === 'admin'">
                            <div class="card-header">
                                <h5 class="mb-0">Leave Applications </h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No..</th>
                                        <th scope="col">Employee</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(leave, index) in leaves"
                                            :key="leave.id"
                                        >
                                            <td> {{ index + 1 }}</td>
                                            <td v-if="user.role === 'admin'"> {{ leave.user.name }}</td>
                                            <td> {{ leave.title }}  </td>
                                            <td>  {{ formatDate(leave.leave_start_date)}} </td>
                                            <td>
                                                <strong class="text-warning" v-if="leave.status === ''">Pending</strong>
                                                <strong class="text-danger" v-else>{{ leave.status }}</strong>
                                            </td>
                                            <td>  {{ formatDate(leave.created_at)}} </td>
                                            <td class="text-end">
                                                <router-link  v-bind:to="'/leave/' + leave.id" class="btn btn-sm btn-neutral">View</router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer border-0 py-5">
                                <nav aria-label="...">
                                    <ul class="pagination">
                                        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                            <a class="page-link"  @click="getAllLeaves(pagination.prev_page_url)" href="#" tabindex="-1">Previous</a>
                                        </li>
                                        <li class="page-item disabled"><a class="page-link" href="#">Page {{ pagination.current_page}} of {{ pagination.last_page}} </a></li>
                                        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                            <a class="page-link" @click="getAllLeaves(pagination.next_page_url)" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import axios from "axios";

export default {
    name: "Dashboard",
    components: {
        DashboardComponent: () => import("../../components/DashboardComponent"),
        Header: () => import("../../components/Header"),
        Nav: () => import("../../components/Nav.vue"),
    },
    created() {
        this.getAllLeaves()
    },
    data() {
        return {
            leaves: [],
            pagination: {}
        }
    },
    methods : {
        async getAllLeaves(page_url) {
            let vm = this;
            page_url = page_url || 'leaves'
            const response = await axios.get(process.env.MIX_API_BASE_URL + page_url, {
                headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
            });
            this.leaves = response.data.data;
            vm.makePagination(response.data.meta, response.data.links)
        },
        makePagination(meta, links) {
            this.pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            };
        },
        formatDate(dateString) {
            const options = { year: "numeric", month: "long", day: "numeric" };
            return new Date(dateString).toLocaleDateString(undefined, options);
        },
    },
    computed: {
        ...mapGetters(["user"]),
    },
}
</script>

<style scoped>
@import '../../css/index.css';
@import url("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css");
</style>
