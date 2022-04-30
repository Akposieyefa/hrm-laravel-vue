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
                                    <h1 class="h2 mb-0 ls-tight">Task details</h1>
                                </div>
                                <!-- Actions -->
                                <div class="col-sm-6 col-12 text-sm-end">
                                    <div class="mx-n1">
                                        <button  data-toggle="modal" data-target="#form" v-if="!task.status" class="btn d-inline-flex btn-sm btn-dark mx-1">
                                            <span class=" pe-2">
                                                <i class="bi bi-plus"></i>
                                            </span>
                                            <span>Comment on Task</span>
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
                        <header class="header">
                            <div class="container">
                                <div class="teacher-name">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <h2>Task Title :  <small>{{ task.title }}</small></h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:20px;">
                                    <div class="col-sm-12">
                                        <p class="text-justify"> {{ task.description }} </p>
                                    </div> <br>
                                    <div class="col-sm-12">
                                       Task Status :
                                        <strong class="text-success" v-if="task.status">Completed</strong>
                                        <strong class="text-danger" v-else>Not Completed</strong>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <!-- end -->
                    </div>

                    <!--Modal display-->
                    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title" >Comment on Task</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="desc">Message</label>
                                            <textarea
                                                id="desc"
                                                v-model="message.description"
                                                placeholder="Enter task description"
                                                rows="6"
                                                class="form-control form-control-md"
                                                aria-label="With textarea"
                                            ></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top-0">
                                        <button type="submit" @click="commentOnTask(task.id)" class="btn btn-sm btn-dark" >Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end of modal -->

                </main>
            </div>
        </div>
        <!--end of modal -->


    </div>
</template>


<script>
import {mapGetters} from "vuex";

export default {
    name: "Task",
    components: {
        Header: () => import("../../../components/Header"),
        Nav: () => import("../../../components/Nav.vue"),
    },
    data() {
        return {
            task: {},
            message : {
                description : "",
            },
        }
    },
    created() {
        this.getTask(this.$route.params.id);
    },
    methods: {
        async getTask(id){
            let api_url = process.env.MIX_API_BASE_URL + 'tasks/'
            const response = await axios.get(api_url + id, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            });
            this.task = response.data.data;
        },
        async commentOnTask(id) {
            let api_url = process.env.MIX_API_BASE_URL + 'tasks/'
            try {
                const response = await axios.post(
                    api_url + id,
                    {
                        status_description: this.message.description,
                        _method: "patch",
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

</style>
