<template>
    <div class="row g-6 mb-6">
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Departments</span>
                            <span class="h3 font-bold mb-0">{{ departments }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                <i class="bi bi-credit-card"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Employees</span>
                            <span class="h3 font-bold mb-0">{{ employees }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Projects</span>
                            <span class="h3 font-bold mb-0">{{ projects }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-info text-white text-lg rounded-circle">
                                <i class="bi bi-clock-history"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "DashboardComponent",
    created() {
        this.getDashboardHelper();
    },
    data() {
        return {
            projects : 0,
            departments : 0,
            employees : 0

        }
    },
    methods : {
        async getDashboardHelper() {
            let api_url = process.env.MIX_API_BASE_URL + 'dashboard-helpers'
            const response = await axios.get(api_url, {
                headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
            });
            this.employees = response.data.data.employees;
            this.departments = response.data.data.departments;
            this.projects = response.data.data.projects;
        },
    }
}
</script>

<style scoped>

</style>
