import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new  VueRouter({

    routes: [

        { path: '/', name: 'Home', component: () => import('./views/Home.vue') },
        { path: '/verify-email', name: 'Verify', component: () => import('./views/Verify.vue') },
        { path: '/forget-password', name: 'ForgetPassword', component: () => import('./views/ForgotPassword.vue') },

        { path: '/departments', name: 'Department', component: () => import('./views/backend/department/Departments.vue') },
        { path: '/levels', name: 'Levels', component: () => import('./views/backend/level/Levels.vue') },
        { path: '/employees', name: 'Employees', component: () => import('./views/backend/employees/Employees.vue') },

        { path: '/leaves', name: 'Leaves', component: () => import('./views/backend/leave/Leaves.vue') },
        { path: '/leave/:id', name: 'Leave', component: () => import('./views/backend/leave/Leave.vue') },

        { path: '/projects', name: 'Projects', component: () => import('./views/backend/project/Projects.vue') },
        { path: '/project/:id', name: 'Project', component: () => import('./views/backend/project/Project.vue') },

        { path: '/attendances', name: 'Attendances', component: () => import('./views/backend/attendance/Attendances.vue') },

        { path: '/tasks', name: 'Tasks', component: () => import('./views/backend/task/Tasks.vue') },
        { path: '/task/:id', name: 'Task', component: () => import('./views/backend/task/Task.vue') },

        { path: '/dashboard', name: 'Dashboard', component: () => import('./views/backend/Dashboard.vue') },
        { path: '/organizations', name: 'Organizations', component: () => import('./views/backend/organization/Organizations.vue') },

        { path: '/profile', name: 'Profile', component: () => import('./views/backend/Profile.vue') },

        { path: '/:pathMatch(.*)*', name: 'Notfound', component: () => import('./views/Notfound.vue')}
    ]
});

router.beforeEach((to, from, next) => {
    const publicPages = ['/','/verify-email', '/forget-password'];
    const authRequired = !publicPages.includes(to.path);
    const loggedIn = localStorage.getItem('token');

    if (authRequired && !loggedIn) {
        return next('/');
    }else {
        next();
    }
});

export default router;

