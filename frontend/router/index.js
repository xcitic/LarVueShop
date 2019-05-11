// Layouts
import MainLayout from '@/layouts/MainLayout';
import DashboardLayout from '@/layouts/DashboardLayout';

// View
import Landing from '@/views/Landing';
import Products from '@/views/Products';
import Login from '@/views/Login';
import Register from '@/views/Register';

// Authenticated Views
import Dashboard from '@/views/Dashboard';



const routes = () => {
  return [
    {path: '/', component: MainLayout,
      children: [
        {path: '', name: 'Landing', component: Landing},
        {path: '/products', name: 'Products', component: Products},
        {path: '/register', name: 'Register', component: Register, meta: {guest: true}},
        {path: '/login', name: 'Login', component: Login, meta: {guest: true}},
      ]
    },
    {path: '/dashboard', component: DashboardLayout,
      children: [
        {path: '', name: 'Dashboard', component: Dashboard, meta: {requiresAuth: true}}
      ]}
  ]
}

export default routes();
