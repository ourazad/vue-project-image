<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li> <router-link class="nav-link active" :to="{ name: 'File_Upload' }">File Upload</router-link>
                    </li>
                    <li> <router-link class="nav-link active" :to="{ name: 'Product' }">Product</router-link>
                    </li>
                    <li> <router-link class="nav-link active" :to="{ name: 'Image' }">Image</router-link></li>
                </ul>
            </div>
        </div>
    </nav>
    <router-view></router-view>
    
</template>

<script>
</script>