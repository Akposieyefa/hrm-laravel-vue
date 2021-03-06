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
                                    <h1 class="h2 mb-0 ls-tight">Level List</h1>
                                </div>
                                <!-- Actions -->
                                <div class="col-sm-6 col-12 text-sm-end">
                                    <div class="mx-n1">
                                        <button  data-toggle="modal" data-target="#form" class="btn d-inline-flex btn-sm btn-dark mx-1">
                                    <span class=" pe-2">
                                        <i class="bi bi-plus"></i>
                                    </span>
                                            <span>Create</span>
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
                                <h5 class="mb-0">All Level</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No..</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr
                                        v-for="(level, index) in levels"
                                        :key="level.id"
                                    >
                                        <td>
                                            {{ index + 1 }}
                                        </td>
                                        <td>
                                            {{ level.name }}
                                        </td>
                                        <td>
                                            {{ formatDate(level.created_at)}}
                                        </td>
                                        <td class="text-end">
                                            <button class="btn btn-sm btn-neutral" @click="editMode(level.id)" data-toggle="modal" data-target="#form" >Edit</button>
                                            <button  @click="deleteLevel(level.id)" type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer border-0 py-5">
                                <nav aria-label="...">
                                    <ul class="pagination">
                                        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                            <a class="page-link"  @click="getAllBnk(pagination.prev_page_url)" href="#" tabindex="-1">Previous</a>
                                        </li>
                                        <li class="page-item disabled"><a class="page-link" href="#">Page {{ pagination.current_page}} of {{ pagination.last_page}} </a></li>
                                        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                            <a class="page-link" @click="getAllBnk(pagination.next_page_url)" href="#">Next</a>
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
                        <h5 class="modal-title"  v-if="edit">Update</h5>
                        <h5 class="modal-title" v-else>Add New</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" v-model="level.name" class="form-control form-control-lg" id="name" aria-describedby="emailHelp" placeholder="Enter level name">
                            </div>
                        </div>
                        <div class="modal-footer border-top-0">
                            <button type="submit"  class="btn btn-sm btn-dark" @click="updateLevel(level.id)" v-if="edit">Update</button>
                            <button type="submit" @click="createLevel()" class="btn btn-sm btn-dark" v-else>Create</button>
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
    name: "Levels",
    components: {
        Header: () => import("../../../components/Header"),
        Nav: () => import("../../../components/Nav.vue"),
    },
    data() {
        return {
            level: {
                name: "",
            },
            levels: [],
            pagination: {},
            edit: false
        }
    },
    created() {
        this.getAllLevel();
    },
    computed: {
        ...mapGetters(["user"]),
    },
    methods : {
        async editMode(id){
            this.edit = true;
            let api_url = process.env.MIX_API_BASE_URL + 'levels/'
            const response = await axios.get(api_url + id, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            });
            this.level = response.data.data;
        },
        async updateLevel(id) {
            try {
                let api_url = process.env.MIX_API_BASE_URL + 'levels/'
                const response = await axios.patch(
                    api_url + id,
                    {
                        name: this.level.name
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem("token")}`,
                        },
                    }
                );
                await this.getAllLevel();
                this.$toasted.success(response.data.message)
                this.edit = false;
            } catch (e) {
                this.$toasted.error(e.response.data.message)
            }
        },
        async createLevel() {
            try {
                let api_url = process.env.MIX_API_BASE_URL + 'levels'
                const response = await axios.post(
                    api_url,
                    {
                        name: this.level.name
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem("token")}`,
                        },
                    }
                );
                this.$toasted.success(response.data.message)
                this. clearData()
                await this.getAllLevel();
            } catch (e) {
                this.$toasted.error(e.response.data.message)
            }
        },
        async getAllLevel(page_url) {
            let vm = this;
            page_url = page_url || 'levels'
            const response = await axios.get(process.env.MIX_API_BASE_URL + page_url, {
                headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
            });
            this.levels = response.data.data;
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
        async deleteLevel(id) {
            if (confirm("Do you really want to delete this record?")) {
                try {
                    let api_url = process.env.MIX_API_BASE_URL + 'levels/'
                    const response = await axios.delete(api_url + id, {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem("token")}`,
                        },
                    });
                    this.$toasted.success(response.data.message)
                    await this.getAllDpt();
                } catch (e) {
                    this.$toasted.error(e.response.data.message)
                }
            }
        },
        formatDate(dateString) {
            const options = { year: "numeric", month: "long", day: "numeric" };
            return new Date(dateString).toLocaleDateString(undefined, options);
        },
        clearData() {
            this.level.name = ""
        }
    },
}
</script>

<style scoped>
@import '../../../css/index.css';
@import url("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css");
</style>
