// Layouts
import MainLayout from '@/layouts/MainLayout';

// View
import Landing from '@/views/Landing';


const routes = () => {
  return [
    {path: '/', name: 'MainLayout', component: MainLayout}
  ]
}

export default routes();
