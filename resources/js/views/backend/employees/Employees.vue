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
                                    <h1 class="h2 mb-0 ls-tight">Employees List</h1>
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
                                <h5 class="mb-0">All Employees</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No..</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">Date</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr
                                        v-for="(emp, index) in employees"
                                        :key="emp.id"
                                    >
                                        <td>
                                            {{ index + 1 }}
                                        </td>
                                        <td>{{ emp.user.name }}</td>
                                        <td>{{ emp.user.email }}</td>
                                        <td>{{ emp.phone}}</td>
                                        <td>{{ emp.department.name }}</td>
                                        <td>{{ emp.level.name }}</td>
                                        <td>{{ formatDate(emp.created_at)}}</td>
                                        <td class="text-end">
                                            <button  class="btn btn-sm btn-neutral" @click="editMode(emp.id)" data-toggle="modal" data-target="#form">Edit</button>
                                            <button  @click="deleteEmp(emp.id)" type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
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
                                            <a class="page-link"  @click="getAllEmp(pagination.prev_page_url)" href="#" tabindex="-1">Previous</a>
                                        </li>
                                        <li class="page-item disabled"><a class="page-link" href="#">Page {{ pagination.current_page}} of {{ pagination.last_page}} </a></li>
                                        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                            <a class="page-link" @click="getAllEmp(pagination.next_page_url)" href="#">Next</a>
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
                        <h5 class="modal-title" v-if="edit">Edit Employee</h5>
                        <h5 class="modal-title" v-else>Add New</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" v-model="employee.name" class="form-control form-control-lg" id="name" aria-describedby="emailHelp" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" v-model="employee.email" class="form-control form-control-lg" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" v-model="employee.phone" class="form-control form-control-lg" id="phone" aria-describedby="emailHelp" placeholder="Enter phone">
                            </div>
                            <div class="form-group">
                                <label for="phone">Level</label>
                                <select v-model="employee.level" class="form-control">
                                    <option value="0">Select a level</option>
                                    <option
                                        v-for="(lev, index) in levels"
                                        v-bind:value="lev.id"
                                        :key="index"
                                        class="form-control"> {{ lev.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phone">Department</label>
                                <select v-model="employee.department" class="form-control">
                                    <option value="0">Select a department</option>
                                    <option
                                        v-for="(department, index) in departments"
                                        v-bind:value="department.id"
                                        :key="index"
                                        class="form-control"> {{ department.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Address</label>
                                <textarea
                                    id="description"
                                    v-model="employee.address"
                                    placeholder="Enter address"
                                    rows="6"
                                    class="form-control form-control-md"
                                    aria-label="With textarea"
                                ></textarea>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0">
                            <button type="submit" @click="updateEmp(employee.id)" class="btn btn-sm btn-dark" v-if="edit">Update</button>
                            <button type="submit" @click="createEmp()" class="btn btn-sm btn-dark" v-else>Create</button>
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
export default {
    name: "Employees",
    components: {
        Header: () => import("../../../components/Header"),
        Nav: () => import("../../../components/Nav.vue"),
    },
    data() {
        return {
            employee: {
                name: "",
                email: "",
                phone: "",
                address: "",
                department: 0,
                level: 0
            },
            departments: [],
            levels : [],
            pagination: {},
            edit: false,
            employees: []
        }
    },
    created() {
        this.getAllEmp();
        this.getHelpers();
    },
    computed: {
        ...mapGetters(["user"]),
    },
    methods : {
        async getHelpers() {
            let api_url = process.env.MIX_API_BASE_URL + 'create-helpers'
            const response = await axios.get(api_url, {
                headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
            });
            this.departments = response.data.data.departments;
            this.levels = response.data.data.levels;
        },
        async editMode(id){
            this.edit = true;
            let api_url = process.env.MIX_API_BASE_URL + 'employees/'
            const response = await axios.get(api_url + id, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            });
            this.department = response.data.data;
        },
        async updateEmp(id) {
            let api_url = process.env.MIX_API_BASE_URL + 'employees/'
            try {
                const response = await axios.patch(
                    api_url + id,
                    {
                        name: this.department.name,
                        description: this.department.description
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem("token")}`,
                        },
                    }
                );
                await this.getAllEmp()
                this.$toasted.success(response.data.message)
                this.edit = false;
            } catch (e) {
                this.$toasted.error(e.response.data.message)
            }
        },
        async createEmp() {
            let api_url = process.env.MIX_API_BASE_URL + 'employees'
            try {
                const response = await axios.post(
                    api_url,
                    {
                        name: this.employee.name,
                        email: this.employee.email,
                        phone: this.employee.phone,
                        department_id: this.employee.department,
                        level_id: this.employee.level,
                        address: this.employee.address
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem("token")}`,
                        },
                    }
                );
                this.$toasted.success(response.data.message)
                this. clearData()
                await this.getAllEmp();
            } catch (e) {
                this.$toasted.error(e.response.data.message)
                console.log(e.response.data.error)
            }
        },
        async getAllEmp(page_url) {
            let vm = this;
            page_url = page_url || 'employees'
            const response = await axios.get(process.env.MIX_API_BASE_URL + page_url, {
                headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
            });
            this.employees = response.data.data;
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
        async deleteEmp(id) {
            let api_url = process.env.MIX_API_BASE_URL + 'employees/'
            if (confirm("Do you really want to delete this record?")) {
                try {
                    const response = await axios.delete( api_url + id, {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem("token")}`,
                        },
                    });
                    this.$toasted.success(response.data.message)
                    await this.getAllEmp();
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
            this.employee.name = ""
            this.employee.email = ""
            this.employee.phone = ""
            this.employee.department = 0
            this.employee.level = 0
            this.employee.address = ""
        }
    },
}
</script>

<style scoped>

</style>
