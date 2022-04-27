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
                        <div class="card shadow border-0 mb-7">
                            <div class="card-header">
                                <h5 class="mb-0">Leave Applications </h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No..</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Staff ID</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Appointment Date</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                           {{ user }}
                                       </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer border-0 py-5">



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

export default {
    name: "Dashboard",
    components: {
        DashboardComponent: () => import("../../components/DashboardComponent"),
        Header: () => import("../../components/Header"),
        Nav: () => import("../../components/Nav.vue"),
    },
    created() {
        console.log(this.user)
    },
    data() {
        return {
            staffs: [],
            pagination: {}
        }
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
