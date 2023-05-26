<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Laravel Vue JS File Upload Demo</div>
                    <div class="card-body">
                        <div v-if="success != ''" class="alert alert-success">
                            {{ success }}
                        </div>
                        <form @submit.prevent="save" enctype="multipart/form-data">

                            <input type="text" v-model="product.name" name="name" class="form-control"
                                placeholder="Product Name">
                            <input type="text" v-model="product.details" name="details" class="form-control"
                                placeholder="Product Details">
                            
                            <button class="btn btn-primary btn-block">Upload</button>
                        </form>
                    </div>
                </div>
                <table class="table table-dark my-5">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Details</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in result" v-bind:key="product.id">
                            <td>{{ product.id }}</td>
                            <td>{{ product.name }}</td>
                            <td>{{ product.details }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" @click="edit(product)">Edit</button>
                                <button type="button" class="btn btn-danger"
                                    @click="remove(product)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            // name: '',
            // details: '',
            success: '',

            result: {},
            product: {
                id: '',
                name: '',
                details: '',
            }
        }
    },
    created() {
        this.ProductLoad();
    },
    methods: {
        ProductLoad() {
            var index = "http://127.0.0.1:8000/api/product";
            axios.get(index)
                .then(
                    ({ data }) => {
                        console.log(data);
                        this.result = data;
                    }
                );
        },

        onChange(e) {
            this.file = e.target.files[0];
        },

        save() {
            if (this.product.id == '') {
                this.saveData();
            }
            else {
                this.updateData();
            }
        },
        saveData() {
            let existingObj = this;
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let data = new FormData();
            data.append('name', this.product.name);
            data.append('details', this.product.details);

            axios.post('http://127.0.0.1:8000/api/product_save/', data, config)
                .then(({ data }) => {

                    alert("saved!");
                    existingObj.ProductLoad();
                })
                .then(function (res) {
                    existingObj.success = res.data.success;
                })
                .catch(function (err) {
                    existingObj.output = err;
                });
        },
        edit(product) {
            this.product = product;

        },
        updateData() {
            let formData = new FormData()
            formData.append('name', this.product.name);
            formData.append('details', this.product.details);

            axios.put('http://127.0.0.1:8000/api/product_update/' + this.product.id, formData).then(response => {
                // handle the API response
            })
        },
        remove(product) {
            var destroy = `http://127.0.0.1:8000/api/delete/${product.id}`;
            //var destroy = `http://127.0.0.1:8000/api/delete/' + this.student.id;

            axios.delete(destroy);
            alert("Deleted !");
            this.ProductLoad();
        }

    }
}
</script>