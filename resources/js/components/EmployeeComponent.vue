<template>
    <div>
        <div>
            <form @submit.prevent="saveData" enctype="multipart/form-data">
                <div class="form-row mb-1">
                    <div class="form-group col-md-6">
                        <label for="name">First Name</label>
                        <input type="text" v-model="form.fname" :class="{'is-invalid' : form.errors.has('fname')}" class="form-control" placeholder="Employee First Name" name="fname" @keydown="form.errors.clear('fname')">
                        <span class="text-danger" v-if="form.errors.has('fname')" v-text="form.errors.get('fname')"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Last Name</label>
                        <input type="text" v-model="form.lname" :class="{'is-invalid' : form.errors.has('lname')}" class="form-control" placeholder="Employee Last Name" name="lname" @keydown="form.errors.clear('lname')">
                        <span class="text-danger" v-if="form.errors.has('lname')" v-text="form.errors.get('lname')"></span>
                    </div>
                </div>

                <div class="form-row mb-1">
                    <div class="form-group col-md-6">
                        <label for="name">Email</label>
                        <input type="email" v-model="form.email" :class="{'is-invalid' : form.errors.has('email')}" class="form-control" placeholder="example@gmail.com" name="email" @keydown="form.errors.clear('email')">
                        <span class="text-danger" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Phone</label>
                        <input type="text" v-model="form.phone" :class="{'is-invalid' : form.errors.has('phone')}" class="form-control" placeholder="Employee Phoen Number" name="phone" @keydown="form.errors.clear('phone')">
                        <span class="text-danger" v-if="form.errors.has('phone')" v-text="form.errors.get('phone')"></span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3 mb-5">Add New Employee </button>
            </form>

            <nav aria-label="Page navigation example m-5">
                <ul class="pagination">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="getCompanies(pagination.prev_page_url)">Previous</a></li>
                    <li class="page-item disabled"><a href="#" class="page-link text-dark">Page {{pagination.current_page}} of {{pagination.last_page}}</a></li>
                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="getCompanies(pagination.next_page_url)">Next</a></li>
                </ul>
            </nav>

            <div class="table-responsive mt-2">
                <table class="table table-bordered mb-4">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="employee in employees" :key="employee.id">
                            <td>{{employee.id}}</td>
                            <td><span v-if="editmode == false || editmode != employee.id">{{employee.fname}}</span><input v-if="editmode == employee.id" name="fname" class="form-control" v-model="employee.fname" type="text"></td>
                            <td><span v-if="editmode == false || editmode != employee.id">{{employee.lname}}</span><input v-if="editmode == employee.id" name="lname" class="form-control" v-model="employee.lname" type="text"></td>
                            <td><span v-if="editmode == false || editmode != employee.id">{{employee.email}}</span><input v-if="editmode == employee.id" name="email" class="form-control" v-model="employee.email" type="text"></td>
                            <td><router-link style="color: blue"><span v-if="editmode == false || editmode != employee.id">{{employee.phone}}</span><input v-if="editmode == employee.id" name="phone" class="form-control" v-model="employee.phone" type="text"></router-link></td>
                            <td class="text-center">
                                <div class="ml-auto mr-2 d-flex align-items-center">
                                    <span>
                                        <svg v-on:click="editmode = employee.id"  v-if="editmode != employee.id" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFC107" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"/>
                                            <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                            <line x1="16" y1="5" x2="19" y2="8" />
                                        </svg>
                                        <svg v-if="editmode == employee.id" v-on:click="updateCompany(employee)"  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkbox" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#4CAF50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"/>
                                            <polyline points="9 11 12 14 20 6" />
                                            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                        </svg>
                                    </span>
                                    <span>
                                        <svg v-on:click="deleteCompany(employee)" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash ml-1" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FF5722" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"/>
                                            <line x1="4" y1="7" x2="20" y2="7" />
                                            <line x1="10" y1="11" x2="10" y2="17" />
                                            <line x1="14" y1="11" x2="14" y2="17" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <div v-show="employeeForm" class="animate__animated animate__fadeInDown">
            <employee-component></employee-component>
        </div> -->
    </div>
</template>

<script>
    // import employee-component from './components/EmployeeComponent.vue';
    export default {
        name: 'Employee',
        data(){
            return{
                editmode: false,
                // companyForm: true,
                // employeeForm: false,
                pagination: {},
                employees: '',
                form: new Form({
                fname: '',
                lname: '',
                email: '',
                phone: '',
                })
            }
        },
        methods: {
            // companyShow(){
            //     this.companyForm = true
            //     this.employeeForm = false
            // },
            // employeeShow(){
            //     this.companyForm = false
            //     this.employeeForm = true
            // },
            // attachLogo(){
            //     this.form.logo = this.$refs.newLogoImage.files[0];
            //     console.log(this.form.logo)
            // },
            deleteCompany(e){
                let data = new FormData();
                data.append('_method', 'DELETE')
                axios.post('api/employee/'+e.id, data).then((res) => {
                    this.employees = res.data
                }).catch((error) => {
                    this.form.errors.record(error.response.data.errors)
                })
            },
            updateCompany(e){
                this.editmode = false
                let data = new FormData();
                data.append('_method', 'PATCH')
                data.append('fname', e.fname);
                data.append('lname', e.lname);
                data.append('email', e.email);
                data.append('phone', e.phone);
                axios.post('api/employee/'+e.id, data)
                .catch((error) => {
                this.form.errors.record(error.response.data.errors)
                })
            },
            getEmployees(page_url){
                let vm = this;
                page_url = page_url || 'api/employee'
                fetch(page_url)
                .then(res => res.json())
                .then((res) => {
                    this.employees =  res.data;
                    this.pagination = {
                        current_page: res.current_page,
                        last_page: res.last_page,
                        next_page_url: res.next_page_url,
                        prev_page_url: res.prev_page_url,
                    };
                }).catch((error) => (
                    console.log(error)
                ))
            },
            // makePagination(meta, links){
            //     let pagination = {
            //         current_page: meta.current_page,
            //         last_page: meta.last_page,
            //         next_page_url: links.next,
            //         prev_page_url: links.prev,
            //     }
            //     console.log(pagination);
            //     this.pagination = pagination;
            // },
            saveData(){
                let data = new FormData();
                data.append('fname', this.form.fname);
                data.append('lname', this.form.lname);
                data.append('email', this.form.email);
                data.append('phone', this.form.phone);
                axios.post('/api/employee', data).then((res) => {
                    this.form.reset()
                    this.getEmployees()
                }).catch((error) => {
                    this.form.errors.record(error.response.data.errors)
                })
            }
        },
        mounted() {
            this.getEmployees();
        }
    }
</script>