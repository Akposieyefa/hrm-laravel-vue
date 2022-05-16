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
                                    <h1 class="h2 mb-0 ls-tight">Project</h1>
                                </div>
                                <!-- Actions -->
                                <div class="col-sm-6 col-12 text-sm-end">
                                    <div class="mx-n1">
                                        <button  data-toggle="modal" data-target="#form" class="btn d-inline-flex btn-sm btn-dark mx-1">
                                            <span class=" pe-2">
                                                <i class="bi bi-plus"></i>
                                            </span>
                                            <span>Add Task</span>
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
                                            <h2><strong>{{ project.title }}</strong></h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:20px;">
                                    <div class="col-sm-6">
                                       {{ project.description}}
                                    </div>
                                </div>
                            </div>
                        </header>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card-block">
                                        <h5><i class="fa fa-rocket fa-fw p-5 mt-5"></i>Tasks</h5>
                                        <ol class="list-group" style="margin-top:15px;margin-bottom:15px;">
                                            <li class="list-group-item" v-for="(project_task, index) in project.tasks" :key="index">
                                                {{ project_task.title }} <small>Assigned {{ formatDate(project_task.created_at) }}</small> <br> <strong>Assigned to : </strong> {{ project_task.employee.name }}
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end -->
                    </div>

                    <!--Modal display-->
                    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title" >Add New</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">Title</label>
                                            <input type="text"  v-model="task.title" class="form-control form-control-lg" id="name" aria-describedby="emailHelp" placeholder="Enter task title">
                                        </div>
                                        <div class="form-group">
                                            <label for="desc">Description</label>
                                            <textarea
                                                id="desc"
                                                v-model="task.description"
                                                placeholder="Enter task description"
                                                rows="6"
                                                class="form-control form-control-md"
                                                aria-label="With textarea"
                                            ></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="employee">Department</label>
                                            <select v-model="task.employee" class="form-control">
                                                <option value="0">Assign task to a staff</option>
                                                <option
                                                    v-for="(employee, index) in employees"
                                                    v-bind:value="employee.user.id"
                                                    :key="index"
                                                    class="form-control"> {{ employee.user.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top-0">
                                        <button type="submit" @click="createTask()" class="btn btn-sm btn-dark" >Create</button>
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
    name: "Project",
    components: {
        Header: () => import("../../../components/Header"),
        Nav: () => import("../../../components/Nav.vue"),
    },
    data() {
        return {
            project: {},
            task : {
                title: "",
                description : "",
                employee: 0
            },
            employees: []
        }
    },
    created() {
        this.getProject(this.$route.params.id);
        this.getAllMyEmployees();
    },
    methods: {
        async getProject(id){
            let api_url = process.env.MIX_API_BASE_URL + 'projects/'
            const response = await axios.get(api_url + id, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            });
            this.project = response.data.data;
            console.log(this.project)
        },
        async getAllMyEmployees() {
            let api_url = process.env.MIX_API_BASE_URL + 'employees'
            const response = await axios.get(api_url, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            });
            this.employees = response.data.data;
        },
        async createTask() {
            let api_url = process.env.MIX_API_BASE_URL + 'tasks'
            try {
                const response = await axios.post(
                    api_url,
                    {
                        title: this.task.title,
                        employee_id: this.task.employee,
                        description: this.task.description,
                        project_id: this.$route.params.id
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem("token")}`,
                        },
                    }
                );
                this.$toasted.success(response.data.message)
                await this.getProject(this.$route.params.id);
            } catch (e) {
                this.$toasted.error(e.response.data.message)
                console.log(e.response.data.error)
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
@import '../../../css/profile.css';
</style>
