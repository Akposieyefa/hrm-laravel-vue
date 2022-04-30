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
                                    <h1 class="h2 mb-0 ls-tight">My task list</h1>
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
                                <h5 class="mb-0">All My Tasks</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No..</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Project Title</th>
                                        <th scope="col">Project Duration</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr
                                        v-for="(task, index) in tasks"
                                        :key="task.id"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td> {{ task.title }}</td>
                                        <td> {{ task.project.title}} </td>
                                        <td> {{ task.project.project_duration}} </td>
                                        <td>
                                            <strong class="text-success" v-if="task.status">Completed</strong>
                                            <strong class="text-danger" v-else>Not Completed</strong>
                                        </td>
                                        <td>
                                            {{ formatDate(task.created_at)}}
                                        </td>
                                        <td class="text-end">
                                            <router-link  v-bind:to="'/task/' + task.id" class="btn btn-sm btn-neutral">View</router-link>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer border-0 py-5">
                                <nav aria-label="...">
                                    <ul class="pagination">
                                        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                            <a class="page-link"  @click="getAllTask(pagination.prev_page_url)" href="#" tabindex="-1">Previous</a>
                                        </li>
                                        <li class="page-item disabled"><a class="page-link" href="#">Page {{ pagination.current_page}} of {{ pagination.last_page}} </a></li>
                                        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                            <a class="page-link" @click="getAllTask(pagination.next_page_url)" href="#">Next</a>
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
import {mapGetters} from "vuex";

export default {
    name: "Tasks",
    components: {
        Header: () => import("../../../components/Header"),
        Nav: () => import("../../../components/Nav.vue"),
    },
    data() {
        return {
            tasks: [],
            pagination: {},
        }
    },
    created() {
        this.getAllTask();
    },
    computed: {
        ...mapGetters(["user"]),
    },
    methods : {
        async getAllTask(page_url) {
            let vm = this;
            page_url = page_url || 'tasks'
            const response = await axios.get(process.env.MIX_API_BASE_URL + page_url, {
                headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
            });
            this.tasks = response.data.data;
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
            this.project.title = "";
            this.project.duration = "";
            this.project.description = "";
        }
    },
}
</script>

<style scoped>

</style>
