<template>
    <div>
        <!-- Dashboard -->
        <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
            <!-- Vertical Navbar -->
            <Nav />
            <!-- Main content -->
            <div class="h-screen flex-grow-1 overflow-y-lg-auto">
                <!-- Header -->
                <header class="bg-surface-primary border-bottom pt-6 pb-5">
                    <div class="container-fluid">
                        <div class="mb-npx">
                            <div class="row align-items-center">
                                <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                    <!-- Title -->
                                    <h1 class="h2 mb-0 ls-tight">Leave Application</h1>
                                </div>
                                <!-- Actions -->
                                <div class="col-sm-6 col-12 text-sm-end">
                                    <div class="mx-n1">
                                        <button  data-toggle="modal" data-target="#form" class="btn d-inline-flex btn-sm btn-dark mx-1">
                                    <span class=" pe-2">
                                        <i class="bi bi-plus"></i>
                                    </span>
                                            <span>Apply</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Nav -->
                        </div>
                    </div>
                </header>

                <!-- Main -->
                <main class="py-6 bg-surface-secondary">
                    <div class="container-fluid">
                        <!-- Card stats -->
                        <div class="card shadow border-0 mb-7">
                            <div class="card-header">
                                <h5 class="mb-0">All Leave</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No..</th>
                                        <th scope="col" v-if="user.role === 'admin'">Employee</th>
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
                                            <strong class="text-success" v-else-if="leave.status === 'approved'">{{ leave.status }}</strong>
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

        <!--Modal display-->
        <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title" >Apply for leave</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Subject</label>
                                <input type="text" v-model="leave.title" class="form-control form-control-lg" id="name" aria-describedby="emailHelp" placeholder="Enter leave subject">
                            </div>
                            <div class="form-group">
                                <label for="name">Description</label>
                                <textarea
                                    id="description"
                                    placeholder="Enter brief reason"
                                    v-model="leave.desc"
                                    rows="6"
                                    class="form-control form-control-md"
                                    aria-label="With textarea"
                                ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="date">Start Date</label>
                                <input type="date" v-model="leave.date" class="form-control form-control-lg" id="date" aria-describedby="emailHelp" placeholder="Enter level name">
                            </div>
                        </div>
                        <div class="modal-footer border-top-0">
                            <button type="submit" @click="applyForLeave()" class="btn btn-sm btn-dark" >Apply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end of modal -->
    </div>
</template>


<script>
import {mapGetters} from "vuex";
import axios from "axios";

export default {
    name: "Leaves",
    components: {
        Header: () => import("../../../components/Header"),
        Nav: () => import("../../../components/Nav.vue"),
    },
    data() {
        return {
            leave: {
                title: "",
                desc: "",
                date: ""
            },
            leaves: [],
            pagination: {}
        }
    },
    created() {
        this.getAllLeaves();
    },
    computed: {
        ...mapGetters(["user"]),
    },
    methods : {
        async applyForLeave() {
            try {
                let api_url = process.env.MIX_API_BASE_URL + 'leaves'
                const response = await axios.post(
                    api_url,
                    {
                        title: this.leave.title,
                        description: this.leave.desc,
                        leave_start_date: this.leave.date
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem("token")}`,
                        },
                    }
                );
                this.$toasted.success(response.data.message)
                this. clearData()
                await this.getAllLeaves();
            } catch (e) {
                this.$toasted.error(e.response.data.message)
            }
        },
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
        clearData() {
            this.leave.title = "";
            this.leave.desc = "";
            this.leave.date = "";
        }
    },
}
</script>

<style scoped>
@import '../../../css/index.css';
@import url("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css");
</style>

