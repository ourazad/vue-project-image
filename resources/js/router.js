import {createWebHistory, createRouter} from 'vue-router';
import file_upload from './pages/FileUploadComponent.vue';
import image from './pages/Image.vue';
import product from './pages/ProductComponent.vue';


const routes = [
    {   
        path: '/file_upload',
        name: 'File_Upload',
        component: file_upload,
    },
    {   
        path: '/image',
        name: 'Image',
        component: image,
    },
    {   
        path: '/product',
        name: 'Product',
        component: product,
    },
    
];


const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;