// Layouts
import MainLayout from '@/layouts/MainLayout';

// View
import Landing from '@/views/Landing';
import Products from '@/views/Products';
import Login from '@/views/Login';
import Register from '@/views/Register';

const routes = () => {
  return [
    {path: '/', name: 'MainLayout', component: MainLayout,
      children: [
        {path: '', name: 'Landing', component: Landing},
        {path: '/products', name: 'Products', component: Products},
        {path: '/register', name: 'Register', component: Register},
        {path: '/login', name: 'Login', component: Login},
      ]
    }
  ]
}

export default routes();
