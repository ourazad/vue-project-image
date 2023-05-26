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

                            <input type="text" v-model="file_upload.name" name="name" class="form-control"
                                placeholder="File Name">
                            <input type="file" class="form-control" v-on:change="onChange">
                            <button class="btn btn-primary btn-block">Upload</button>
                        </form>
                    </div>
                </div>
                <table class="table table-dark my-5">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="file_upload in result" v-bind:key="file_upload.id">
                            <td>{{ file_upload.id }}</td>
                            <td>{{ file_upload.name }}</td>
                            <!-- <td>{{ file_upload.path }}</td> -->
                            <td><img :src="file_upload.path" height="150" width="150" alt="Profile Image" /></td>

                            <td>
                                <button type="button" class="btn btn-warning" @click="edit(file_upload)">Edit</button>
                                <button type="button" class="btn btn-danger"
                                    @click="remove(file_upload)">Delete</button>
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
            // file: '',
            success: '',

            result: {},
            file_upload: {
                id: '',
                name: '',
                file: '',
            }
        }
    },
    created() {
        this.FileUploadLoad();
    },
    methods: {
        FileUploadLoad() {
            var index = "http://127.0.0.1:8000/api/file";
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
            if (this.file_upload.id == '') {
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
            data.append('file', this.file);
            data.append('name', this.file_upload.name);

            axios.post('http://127.0.0.1:8000/api/file_save/', data, config)
                .then(({ data }) => {

                    alert("saved!");
                    existingObj.FileUploadLoad();
                })
                .then(function (res) {
                    existingObj.success = res.data.success;
                })
                .catch(function (err) {
                    existingObj.output = err;
                });
        },
        edit(file_upload) {
            this.file_upload = file_upload;

        },
        updateData() {
            let formData = new FormData()
            formData.append('path', this.file)
            formData.append('name', this.file_upload.name);

            axios.put('http://127.0.0.1:8000/api/file_update/' + this.file_upload.id, formData).then(response => {
                // handle the API response
            })
        },
        remove(file_upload) {
            var destroy = `http://127.0.0.1:8000/api/delete/${file_upload.id}`;
            //var destroy = `http://127.0.0.1:8000/api/delete/' + this.student.id;

            axios.delete(destroy);
            alert("Deleted !");
            this.FileUploadLoad();
        }

    }
}
</script>