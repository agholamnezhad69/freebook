/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import swal from 'sweetalert';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));


const app = new Vue({
    el: '#app',
    data: {
        attr_selected: [],
        companyOfCategory: [],
        is_check_for_all_cat: '',
        catSelect: [],
        allUni: [],
        majorSelect_for_uni: [],
        searchCat: [],
        searchCat_for_company: [],
        cat_name: '',
        categories: [],
        attrs: [],
        allCategories: [],
        allCategories_widout_state: [],
        allCompany: [],
        categoryName: "",
        categoryParent_id: "0",
        category_id: "",
        category_parent_id: "",
        catChild: [],
        major: [],
        stateName: '',
        companyName: '',
        majorName: '',
        uniName: '',
        state_id: '',
        uni_id: '',
        major_id: '',
        company_id: '',
        is_update_state: '',
        is_update_major: '',
        is_update_Company: '',
        all_parent_name: [],
        ids: [],
        /********************************/
        called_from_uniName: false,
        status_form:'',
    },

    mounted() {
        this.getcategory();
        this.getMajor();
        this.getAllcategory();
        this.getCatToStateAttr();
        this.getCatToCompanyAttr();
        this.getAllAttr();
    },
    watch: {
        'uniName': function () {
            if (this.called_from_uniName == true) {
                this.called_from_uniName = false;
                return;
            }


            if (this.uniName == "") {
                this.allUni = [];
                return;
            }

            var arr = [];

            for (var i = 0; i < this.allCategories.length; i++) {
                if (this.allCategories[i]['parent_id'] != '0') {
                    arr[i] = this.allCategories[i];
                }
            }


            this.allUni = arr.filter(item => item["title"].indexOf(this.uniName) > -1)

        }
    },

    methods: {

        getcategory: function () {

            axios.get('/admin/getCategory').then(response => {

                this.categories = response.data;

            });
        },
        getAllcategory: function () {


            axios.get('/admin/getAllCategory').then(response => {

                this.allCategories = response.data;

                for (var i = 0; i < this.allCategories.length; i++) {
                    if (this.allCategories[i]['parent_id'] != 0) {
                        this.allCategories_widout_state.push(this.allCategories[i])
                    }
                }

            });


        },
        addCategory: function () {
            axios.post('/admin/addCategory', {


                name: this.categoryName,
                parent_id: this.categoryParent_id,

            }).then(response => {

                this.getcategory();
                swal('با موفقیت ذخیره شد');

            }, response => {

                swal('خطا در ذخیره سازی');
            })
        },
        removeCategory: function () {
            if (this.ids.length == 0) {
                swal('هیچ موردی برای حذف انتخاب نشده');
                return;
            }
            axios.post('/admin/removeCategory', {

                id: this.ids,

            }).then(response => {
                var row = this.all_parent_name[this.all_parent_name.length - 1];

                if (typeof (row) !== "undefined") {
                    this.getCatChild(row['id'], row['parent_id']);
                }


                swal('با موفقیت حذف شد');

            }, response => {

                swal('خطا در حذف ');
            })
        },
        removeCategoryParent: function () {
            if (this.ids.length == 0) {
                swal('هیچ موردی برای حذف انتخاب نشده');
                return;
            }
            axios.post('/admin/removeCategory', {

                id: this.ids,

            }).then(response => {
                this.getcategory();


                swal('با موفقیت حذف شد');

            }, response => {

                swal('خطا در حذف ');
            })
        },
        getCatChild: function (id, parent_id) {

            this.ids = [];
            $('.divParent').fadeOut(0);
            $('.divChild').fadeIn(0);
            axios.post('/admin/catChild', {
                id: id,
                parent_id: parent_id
            }).then(response => {
                this.catChild = response.data['catChild'],
                    this.category_id = response.data['cat_id'],
                    this.categoryName = response.data['catName'],
                    this.category_parent_id = response.data['catParentId'],
                    this.all_parent_name = response.data['allParent']
                $('.cat-main').hide();
                $('.category-item.cat-parent').fadeIn(0);
                $('.cat-child').fadeIn(0);


            }, response => {
                alert('nnnnnnnnnnnnnnnnnnnnnnnnnn');

            })
        },
        getMajor_for_uni: function (uni_id) {
            this.uni_id=uni_id
            axios.post('/admin/getMajor_for_uni', {
                uni_id: uni_id
            }).then(response => {

                this.catChild=response.data;
                $('.cat-main').hide();
                $('.category-item.cat-parent').fadeIn(0);
                $('.cat-child').fadeIn(0);
                if(this.status_form==1){
                    // $('.category-all-item').hide();
                    $('.forms').show();
                }
                this.status_form=1;



            }, response => {


            })
        },
        last_form:function(){
            // this.status_form=0;
            $('.category-all-item').show();
            $('.cat-child').show();
            // $('.forms').hide();
            // this.getMajor_for_uni(this.uni_id);
        },
        getChilds: function (id, parent_id) {

            this.ids = [];
            axios.post('/admin/getChilds', {

                id: id,
                parent_id: parent_id

            }).then(response => {

                if (response.data == '1') {


                    $('.divParent').fadeIn(0);
                    $('.divChild').fadeOut(0);


                } else {


                    $('.cats').fadeIn(0);
                    $('.attrs').fadeOut(0);


                    $('.divParent').fadeOut(0);
                    $('.divChild').fadeIn(0);
                    this.catChild = response.data['child'],
                        this.all_parent_name = response.data['allParent']
                }


            }, response => {


            })
        },
        getCatParent: function (parent_id) {
            axios.post('/admin/catParent', {

                parent_id: parent_id,


            }).then(response => {

                if (response.data == '1') {
                    $('.cat-main').fadeIn(0);
                    $('.category-item.cat-parent').fadeOut(0);
                    $('.cat-child').fadeOut(0);
                } else {
                    this.category_parent_id = response.data['catParent_id'];
                    this.categoryName = response.data['catParent_name'];
                    this.catChild = response.data['catChild'];
                }


            }, response => {


            })
        },
        getMajor: function () {

            axios.get('/admin/getMajor').then(response => {

                this.major = response.data;


            });
        },
        getCityofState: function () {

            axios.post('/admin/getCityOfState/', {


                id: this.state_id,

            }).then(response => {

                this.city = response.data;


            }, response => {

                alert('no000000');
            })
        },
        addState: function () {
            if (this.stateName === "") {
                $('.state i.select.fa-star').fadeOut(0);
                $('.state i.input.fa-star').fadeIn(0);
                $('.city i.select.fa-star').fadeOut(0);
                $('.city i.input.fa-star').fadeOut(0);
                return;
            } else {
                $('.city i.select.fa-star').fadeOut(0);
                $('.city i.input.fa-star').fadeOut(0);
                $('.state i.select.fa-star').fadeOut(0);
                $('.state i.input.fa-star').fadeOut(0);
            }

            axios.post('/admin/addState', {

                id: this.state_id,
                name: this.stateName,
                is_update: this.is_update_state

            }).then(response => {
                this.getCityofState();
                this.getStateAndCit();
                $('.btn_remove_state').fadeIn(0);
                $('.btn_update_state').fadeIn(0);
                $('.btn_cancel_update_state').fadeOut(0);
                $('.state i.select.fa-star').fadeOut(0);
                $('.select_state').fadeIn(0);
                this.stateName = '';
                this.is_update_state = ""
                swal('با موفقیت ذخیره شد');


            }, response => {

                swal('خطا در ذخیره سازی');
            })
        },
        removeState: function () {

            if (this.state_id == "") {
                $('.city i.select.fa-star').fadeOut(0);
                $('.city i.input.fa-star').fadeOut(0);
                $('.state i.input.fa-star').fadeOut(0);
                $('.state i.select.fa-star').fadeIn(0);
                return;
            } else {
                $('.city i.select.fa-star').fadeOut(0);
                $('.city i.input.fa-star').fadeOut(0);
                $('.state i.input.fa-star').fadeOut(0);
                $('.state i.select.fa-star').fadeOut(0);
            }

            axios.post('/admin/removeState', {

                id: this.state_id,

            }).then(response => {


                this.getStateAndCit(),
                    this.state_id = '';
                swal('با موفقیت حذف شد');


            }, response => {

                swal('خطا در حذف ');
            })
        },
        updateState: function () {
            if (this.state_id == "") {
                $('.city i.select.fa-star').fadeOut(0);
                $('.city i.input.fa-star').fadeOut(0);
                $('.state i.select.fa-star').fadeIn(0);
                $('.state i.input.fa-star').fadeOut(0);
                return;
            } else {
                $('.city i.select.fa-star').fadeOut(0);
                $('.city i.input.fa-star').fadeOut(0);
                $('.select_state').fadeOut(0);
                $('.btn_remove_state').fadeOut(0);
                $('.btn_update_state').fadeOut(0);
                $('.btn_cancel_update_state').fadeIn(0);
                $('.state i.select.fa-star').fadeOut(0);
                $('.state i.input.fa-star').fadeOut(0);
            }
            axios.post('/admin/updateState', {

                id: this.state_id,


            }).then(response => {

                if (response.data == false) {
                    swal('استان پیدا نشد');
                    return;
                }

                this.stateName = response.data;
                this.is_update_state = 1;


            }, response => {
                alert('no')

            })
        },
        cancelUpdateState: function () {


            $('.btn_remove_state').fadeIn(0);
            $('.btn_update_state').fadeIn(0);
            $('.btn_cancel_update_state').fadeOut(0);
            $('.state i.select.fa-star').fadeOut(0);
            $('.select_state').fadeIn(0);
            this.stateName = '';
            this.is_update_state = ""
        },
        removeMajor: function () {

            /*            if (this.city_id == "") {
                            $('.state i.input.fa-star').fadeOut(0);
                            $('.state i.select.fa-star').fadeOut(0);
                            $('.city i.input.fa-star').fadeOut(0);
                            $('.city i.select.fa-star').fadeIn(0);
                            return;
                        } else {
                            $('.state i.input.fa-star').fadeOut(0);
                            $('.state i.select.fa-star').fadeOut(0);
                            $('.city i.input.fa-star').fadeOut(0);
                            $('.city i.select.fa-star').fadeOut(0);
                        }*/

            axios.post('/admin/removeMajor', {

                id: this.major_id,

            }).then(response => {

                this.getMajor();
                this.major_id = '';
                swal('با موفقیت حذف شد');


            }, response => {

                swal('خطا در حذف ');
            })
        },
        addMajor: function () {
            /*         if (this.state_id === '') {
                         $('.state i.input.fa-star').fadeOut(0);
                         $('.state i.select.fa-star').fadeIn(0);
                         $('.city i.select.fa-star').fadeOut(0);
                         return;

                     } else if (this.cityName === "") {
                         $('.state i.select.fa-star').fadeOut(0);
                         $('.city i.select.fa-star').fadeOut(0);
                         $('.city i.input.fa-star').fadeIn(0);
                         return;
                     } else {
                         $('.state i.select.fa-star').fadeOut(0);
                         $('.state i.input.fa-star').fadeOut(0);
                         $('.city i.select.fa-star').fadeOut(0);
                         $('.city i.input.fa-star').fadeOut(0);

                     }*/

            axios.post('/admin/addMajor', {

                major_id: this.major_id,
                majorName: this.majorName,
                //  state_id: this.state_id,
                is_update: this.is_update_major

            }).then(response => {
                // this.getCityofState();
                /*         $('.btn_remove_city').fadeIn(0);
                         $('.btn_update_city').fadeIn(0);
                         $('.btn_cancel_update_city').fadeOut(0);
                         $('.city i.select.fa-star').fadeOut(0);
                         $('.select_city').fadeIn(0);
                         this.cityName = '';
                         ;*/
                this.is_update_major = ""
                this.getMajor();
                swal('با موفقیت ذخیره شد');


            }, response => {

                swal('خطا در ذخیره سازی');
            })
        },
        addMajorforUni: function () {


            axios.post('/admin/addMajorforUni', {


                major_id: this.major_id,
                uni_id: this.uni_id,

            }).then(response => {

                this.get_major_for_uni(this.uni_id);
                swal('با موفقیت ذخیره شد');


            }, response => {

                swal('خطا در ذخیره سازی');
            })
        },
        removeMajorSelectForUni: function (major_id) {


            axios.post('/admin/removeMajorSelectForUni', {


                major_id: major_id,
                uni_id: this.uni_id,

            }).then(response => {

                this.get_major_for_uni(this.uni_id);
                swal('با موفقیت ذخیره شد');


            }, response => {

                swal('خطا در ذخیره سازی');
            })
        },
        updateMajor: function () {
            /*           if (this.city_id == "") {
                           $('.state i.input.fa-star').fadeOut(0);
                           $('.state i.select.fa-star').fadeOut(0);
                           $('.city i.select.fa-star').fadeIn(0);
                           $('.city i.input.fa-star').fadeOut(0);
                           return;
                       } else {
                           $('.state i.input.fa-star').fadeOut(0);
                           $('.state i.select.fa-star').fadeOut(0);
                           $('.select_city').fadeOut(0);
                           $('.btn_remove_city').fadeOut(0);
                           $('.btn_update_city').fadeOut(0);
                           $('.btn_cancel_update_city').fadeIn(0);
                           $('.city i.select.fa-star').fadeOut(0);
                           $('.city i.input.fa-star').fadeOut(0);
                       }*/
            axios.post('/admin/updateMajor', {

                id: this.major_id,


            }).then(response => {


                this.majorName = response.data;
                this.is_update_major = 1;
                alert('yes');

            }, response => {

                alert('no');
            })
        },
        cancelUpdateCity: function () {


            $('.btn_remove_city').fadeIn(0);
            $('.btn_update_city').fadeIn(0);
            $('.btn_cancel_update_city').fadeOut(0);
            $('.city i.select.fa-star').fadeOut(0);
            $('.select_city').fadeIn(0);
            this.cityName = '';
            this.is_update_city = ""
        },
        getSearchCat: function () {

            axios.post('/admin/getSearchCat', {


                name: this.cat_name,


            }).then(response => {

                this.searchCat = response.data;


            }, response => {


            })
        },
        selectCat: function (row) {

            for (var i = 0; i < this.catSelect.length; i++) {
                if (this.catSelect[i].name == row.name) {
                    this.searchCat = [];
                    this.cat_name = '';
                    return;
                }
            }

            this.catSelect.push(row);
            this.searchCat = [];
            this.cat_name = '';


        },
        selectCatForCompany: function (row) {


            this.uniName = row.title;
            this.uni_id = row.id;
            this.allUni = [];
            this.called_from_uniName = true;

            this.get_major_for_uni(row.id);
        },
        get_major_for_uni: function (uni_id) {

            axios.post('/admin/get_major_for_uni', {

                uni_id: uni_id,

            }).then(response => {


                this.majorSelect_for_uni = response.data;


            }, response => {

                alert('no')

            })

        },
        removeSelect: function (index) {

            this.catSelect.splice(index, 1)

            ;


        },
        removeSelectForCompany: function (index) {

            this.catSelect_for_company.splice(index, 1)

            ;


        },
        addCatToStateAttr: function () {


            axios.post('/admin/addCatToStateAttr', {


                catSelect: this.catSelect,

                is_allCat: this.is_check_for_all_cat,


            }).then(response => {

                if (this.is_check_for_all_cat == true) {
                    this.getCatToStateAttr();
                }
                swal('با موفقیت ذخیره شد');
            }, response => {


            })


        },
        addCatToCompanyAttr: function () {


            axios.post('/admin/addCatToCompanyAttr', {


                catSelect: this.catSelect_for_company,

                is_allCat: this.is_check_for_all_cat,


            }).then(response => {

                if (this.is_check_for_all_cat == true) {
                    this.getCatToCompanyAttr();
                }
                swal('با موفقیت ذخیره شد');
            }, response => {


            })


        },
        getCatToStateAttr: function () {


            axios.get('/admin/getCatToStateAttr').then(response => {

                this.catSelect = response.data;

            });
        },
        getCatToCompanyAttr: function () {


            axios.get('/admin/getCatToCompanyAttr').then(response => {

                this.catSelect_for_company = response.data;

            });
        },
        addCompany: function () {

            if (this.category_id === "") {
                $('.cat i.select.fa-star').fadeIn(0);
                $('.company i.input.fa-star').fadeOut(0);
                return;
            } else if (this.companyName === "") {
                $('.company i.input.fa-star').fadeIn(0);
                $('.company i.select.fa-star').fadeOut(0);
                $('.cat i.select.fa-star').fadeOut(0);
                return;
            } else {
                $('.company i.select.fa-star').fadeOut(0);
                $('.company i.input.fa-star').fadeOut(0);

                /*        $('.city i.select.fa-star').fadeOut(0);
                        $('.city i.input.fa-star').fadeOut(0);*/

            }

            axios.post('/admin/addCompany', {

                cat_id: this.category_id,
                name: this.companyName,
                is_update_Company: this.is_update_Company,
                company_id: this.company_id,

                /* is_update: this.is_update_state*/

            }).then(response => {

                $('.btn_remove_company').fadeIn(0);
                $('.btn_update_company').fadeIn(0);
                $('.btn_cancel_update_company').fadeOut(0);
                $('.company i.select.fa-star').fadeOut(0);
                $('.select_company').fadeIn(0);
                this.companyName = '';
                this.company_id = '';
                this.is_update_Company = ""
                this.getCompanyOfCategory(this.category_id);
                // this.is_update_state = ""
                swal('با موفقیت ذخیره شد');


            }, response => {

                swal('خطا در ذخیره سازی');
            })
        },
        getCompanyOfCategory: function (cat_id) {

            axios.post('/admin/getCompanyOfCategory/', {


                cat_id: cat_id,

            }).then(response => {

                this.companyOfCategory = response.data;


            }, response => {

                alert('no');
            })
        },
        removeCompany: function () {
            if (this.category_id === "") {
                $('.cat i.select.fa-star').fadeIn(0);

                return;
            } else if (this.company_id == "") {
                $('.company i.select.fa-star').fadeIn(0);
                $('.company i.input.fa-star').fadeOut(0);
                return;
            } else {

                $('.cat i.select.fa-star').fadeOut(0);
                $('.company i.select.fa-star').fadeOut(0);
                $('.company i.input.fa-star').fadeOut(0);
            }

            axios.post('/admin/removeCompany', {

                id_company: this.company_id,

            }).then(response => {
                this.getCompanyOfCategory(this.category_id);
                this.company_id = '';
                swal('با موفقیت حذف شد');


            }, response => {

                swal('خطا در حذف ');
            })
        },
        updateCompany: function () {
            if (this.category_id === "") {
                $('.cat i.select.fa-star').fadeIn(0);
                return;
            } else if (this.company_id == "") {
                $('.company i.input.fa-star').fadeOut(0);
                $('.cat i.select.fa-star').fadeOut(0);
                $('.company i.select.fa-star').fadeIn(0);
                return;
            } else {
                $('.cat i.select.fa-star').fadeOut(0);
                $('.btn_update_company').fadeOut(0);
                $('.btn_remove_company').fadeOut(0);
                $('.btn_cancel_update_company').fadeIn(0);
                $('.company i.select.fa-star').fadeOut(0);
                $('.company i.input.fa-star').fadeOut(0);
                $('.company select').fadeOut(0);
            }
            axios.post('/admin/updateCompany', {

                id: this.company_id,


            }).then(response => {

                if (response.data == false) {
                    swal('شرکت  پیدا نشد');
                    return;
                }

                this.companyName = response.data;
                this.is_update_Company = 1;


            }, response => {
                alert('no')

            })
        },
        cancelUpdateCompany: function () {

            $('.company select').fadeIn(0);
            $('.btn_remove_company').fadeIn(0);
            $('.btn_update_company').fadeIn(0);
            $('.btn_cancel_update_company').fadeOut(0);
            $('.company i.select.fa-star').fadeOut(0);
            $('.select_company').fadeIn(0);
            this.companyName = '';
            this.is_update_Company = ""
        },
        getAllAttr: function () {

            axios.get('/admin/getAllAttr').then(response => {

                this.attrs = response.data;

            });
        },
        getCatToAllAttr: function () {

            axios.post('/admin/getCatToAllAttr', {

                cat_id: this.category_id,

            }).then(response => {
                console.log('ali', response.data);
                this.attrs = response.data;

            }, response => {
                swal('خطا در ذخیره سازی');
            })
        },
        addCatToAllAttr: function (attrId) {

            axios.post('/admin/addCatToAllAttr', {

                attr_id: attrId,
                cat_id: this.category_id,

            }).then(response => {

                console.log('ali', response.data);

            }, response => {

                swal('خطا در ذخیره سازی');
            })
        }
    }
});
