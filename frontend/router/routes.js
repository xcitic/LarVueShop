// Layouts
import MainLayout from '@/layouts/MainLayout';
import DashboardLayout from '@/layouts/DashboardLayout';
import AdminDashboardLayout from '@/layouts/AdminDashboardLayout';

// View
import Landing from '@/views/Landing';
import Product from '@/views/Product';
import Login from '@/views/Login';
import Register from '@/views/Register';
import Cart from '@/views/Cart';

// Authenticated Views
import Dashboard from '@/views/Dashboard';


// Admin Views
import AdminDashboard from '@/views/AdminDashboard';


const routes = () => {
  return [
    {path: '/', component: MainLayout,
      children: [
        {path: '', name: 'Landing', component: Landing},
        {path: '/product/:id', name: 'Product', component: Product},
        {path: '/register', name: 'Register', component: Register, meta: {guest: true}},
        {path: '/login', name: 'Login', component: Login, meta: {guest: true}},
        {path: '/cart', name: 'Cart', component: Cart}
      ]
    },
    {path: '/dashboard', component: DashboardLayout,
      children: [
        {path: '', name: 'Dashboard', component: Dashboard, meta: {requiresAuth: true}}
      ]},

    {path: '/admin/dashboard', component: AdminDashboardLayout,
      children: [
        {path: '', name: 'AdminDashboard', component: AdminDashboard, meta: {requiresAdmin: true}},
      ]}
  ]
}

export default routes();
