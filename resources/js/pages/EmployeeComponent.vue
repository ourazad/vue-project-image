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

                            <input type="text" v-model="employee.name" name="name" class="form-control"
                                placeholder="employee Name">
                            <input type="text" v-model="employee.details" name="details" class="form-control"
                                placeholder="employee Details">
                            
                            <button class="btn btn-primary btn-block">Upload</button>
                        </form>
                    </div>
                </div>
                <table class="table table-dark my-5">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">employee Name</th>
                            <th scope="col">Details</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="employee in result" v-bind:key="employee.id">
                            <td>{{ employee.id }}</td>
                            <td>{{ employee.name }}</td>
                            <td>{{ employee.details }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" @click="edit(employee)">Edit</button>
                                <button type="button" class="btn btn-danger"
                                    @click="remove(employee)">Delete</button>
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
            employee: {
                id: '',
                name: '',
                details: '',
            }
        }
    },
    created() {
        this.employeeLoad();
    },
    methods: {
        employeeLoad() {
            var index = "http://127.0.0.1:8000/api/employee";
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
            if (this.employee.id == '') {
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
            data.append('name', this.employee.name);
            data.append('details', this.employee.details);

            axios.post('http://127.0.0.1:8000/api/employee_save/', data, config)
                .then(({ data }) => {

                    alert("saved!");
                    existingObj.employeeLoad();
                })
                .then(function (res) {
                    existingObj.success = res.data.success;
                })
                .catch(function (err) {
                    existingObj.output = err;
                });
        },
        edit(employee) {
            this.employee = employee;

        },
        updateData() {
            let formData = new FormData()
            formData.append('name', this.employee.name);
            formData.append('details', this.employee.details);

            axios.put('http://127.0.0.1:8000/api/employee_update/' + this.employee.id, formData).then(response => {
                // handle the API response
            })
        },
        remove(employee) {
            var destroy = `http://127.0.0.1:8000/api/delete/${employee.id}`;
            //var destroy = `http://127.0.0.1:8000/api/delete/' + this.student.id;

            axios.delete(destroy);
            alert("Deleted !");
            this.employeeLoad();
        }

    }
}
</script>