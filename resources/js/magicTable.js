import jszip from 'jszip';
// import pdfmake from 'pdfmake';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-autofill-bs5';
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.colVis.mjs';
import 'datatables.net-buttons/js/buttons.html5.mjs';
import 'datatables.net-buttons/js/buttons.print.mjs';
import 'datatables.net-colreorder-bs5';
// import DateTime from 'datatables.net-datetime';
import 'datatables.net-fixedcolumns-bs5';
import 'datatables.net-fixedheader-bs5';
import 'datatables.net-keytable-bs5';
import 'datatables.net-responsive-bs5';
import 'datatables.net-rowgroup-bs5';
import 'datatables.net-rowreorder-bs5';
import 'datatables.net-scroller-bs5';
import 'datatables.net-searchbuilder-bs5';
import 'datatables.net-searchpanes-bs5';
import 'datatables.net-select-bs5';
import 'datatables.net-staterestore-bs5';

// This line was the one missing
window.JSZip = jszip;


/**
 * My DynamicTable Class, is a way ti hande datatable objects in genaric way
 * without the need re-do the routine work, like...
 * The store, edit, & delete ui logic.
 *
 * So you only need to create an instance of DynamicTable, than give it the
 * required prams server routs, table id, and other ui elements id, than the whole
 * logic is created !!
*/

class DynamicTable {
    routs;
    table_id;
    table_el_ids;
    table_object;
    current_objct;
    msg_container;

    constructor (
        routs = {
            index_route   : '',
            store_route   : '',
            show_route    : '',
            update_route  : '',
            destroy_route : '',
        },
        table_id = '#dataTable',
        msg_container = {
            success_el : '#successAlert',
            danger_el  : '#dangerAlert',
            warning_el : '#warningAlert'
        },
        table_el_ids = {
            table_id        : '#dataTable',
            toggle_btn      : '.toggle-btn',
            create_obj_btn  : '.create-object',
            update_obj_btn  : '.update-object',
            fields_list     : ['id', 'name', 'email', 'phone', 'category', 'category', 'password'],
            imgs_fields     : []
        },
        columns = [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'name', name: 'name' },
            { data: 'category', name: 'category' },
            { data: 'actions', name: 'actions' },
        ],
        search_function = () => {},
        custome_msg = {
            delete_msg : null
        }
    ) {

        let this_objct       = this;
        this.routs           = routs;
        this.table_id        = table_id;
        this.columns         = columns;
        this.table_el_ids    = table_el_ids;
        this.msg_container   = msg_container;
        this.search_function = search_function;
        this.search_request  = null;
        this.custome_msg     = custome_msg;

        // inite data-table
        this.table_object = new DataTable(this.table_id, {
            dom: "Btpli",
            // dom : 'Bfrtipl',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ],
            processing: true,
            serverSide: true,
            ajax: this_objct.routs.index_route,
            columns : this_objct.columns,
            ajax: {
                url : this_objct.routs.index_route,
                data: this_objct.search_function
            },
            "order": [[ 0, "desc" ]],
            colReorder: true,
            lengthMenu: [10, 100, 500, 1000, 5000, 10000, 50000]

        });

        // view manuplation model
        const toggleCard = (current_el_id , target_el_id) => {
            $(current_el_id).slideUp(500);
            $(target_el_id).slideDown(500);
        }

        // inite my event
        $(this.table_el_ids.toggle_btn).on('click', function () {
            let current_el_id = $(this).data('current-card');
            let target_el_id  = $(this).data('target-card');

            toggleCard(current_el_id, target_el_id);
        });

        // submit form
        $(this.table_el_ids.create_obj_btn).on('click', function (e, current_objct = this_objct) {
            e.preventDefault();

            // get field attributes
            let data = current_objct._getFromData(current_objct.table_el_ids.fields_list, current_objct.table_el_ids.imgs_fields);

            // validate data
            let is_valied = current_objct.validateData(data);

            // send request
            if (is_valied) {
                $('#loddingSpinner').show(500);

                $(this).attr('disabled', 'disabled');

                current_objct._postRequest(current_objct.routs.store_route, data)
                .then(res => {
                    if (res.success) {
                        current_objct.table_object.draw();
                        current_objct.clearForm(current_objct.table_el_ids.fields_list);
                        current_objct.showAlertMsg(res.msg, current_objct.msg_container.success_el);

                        toggleCard('#createObjectCard', '#objectsCard');
                    } else {
                        current_objct.showAlertMsg(
                            Boolean(res.msg) && typeof(res.msg) == 'string' 
                                ? res.msg : ( res?.message || 'Somthing went rong please refresh the page!!'), current_objct.msg_container.danger_el);
                        console.log('my err response', res);// keep me for debuging
                        Boolean(res.msg) && current_objct.showValidationErr(res.msg)
                    }// end :: if

                    $('#loddingSpinner').hide(500);
                })
                .catch(err => {
                    $('#loddingSpinner').hide(500);
                    current_objct.showAlertMsg(err?.message || err?.msg || 'Somthing went rong please refresh the page!!', current_objct.msg_container.danger_el);
                    console.log('my err response', err);// keep me for debuging
                })
                .finally(() => {
                    $(this).removeAttr('disabled');
                });
            }// end :: if
        });

        // update form
        $(this.table_el_ids.update_obj_btn).on('click', function (e, current_objct = this_objct) {
            e.preventDefault();

            // get field attributes
            let data = current_objct._getFromData(current_objct.table_el_ids.fields_list, current_objct.table_el_ids.imgs_fields, 'edit-');
            data.append('_method', 'put');

            // validate data
            let is_valied = current_objct.validateData(data, 'edit-');

            // send request
            if (is_valied) {
                $('#loddingSpinner').show(500);
                
                $(this).attr('disabled', 'disabled');

                current_objct._postRequest(current_objct.routs.update_route + `/${data.get('id')}`, data)
                .then(res => {
                    if (res.success) {
                        current_objct.table_object.draw();
                        current_objct.clearForm(current_objct.table_el_ids.fields_list, 'edit-');
                        current_objct.showAlertMsg(res.msg, current_objct.msg_container.success_el);

                        toggleCard('#editObjectsCard', '#objectsCard');
                    } else {
                        current_objct.showAlertMsg(
                            Boolean(res.msg) && typeof(res.msg) == 'string' 
                                ? res.msg : ( res?.message || 'Somthing went rong please refresh the page!!'), current_objct.msg_container.danger_el);
                        console.log('my err response', res);// keep me for debuging
                        current_objct.showValidationErr(res.msg, 'edit-')
                    }// end :: if

                    $('#loddingSpinner').hide(500);
                })
                .catch(err => {
                    $('#loddingSpinner').hide(500);
                    current_objct.showAlertMsg(err?.msg || err?.message || 'Somthing went rong please refresh the page!!', current_objct.msg_container.danger_el);
                    console.log('my err response', err);// keep me for debuging
                })
                .finally(() => {
                    $(this).removeAttr('disabled');
                });
            }// end :: if
        });

        $('.search-action').on('keyup change', function (e, current_objct = this_objct) {
            if (current_objct.search_request != null) {
                clearTimeout(current_objct.search_request)
            }

            current_objct.search_request = setTimeout(() => {
                current_objct.table_object.draw();
            }, 250);
        });

        $('.relode-btn').on('click', () => {
            /**
             * relode datatable event
             */
            this.table_object.draw();

            $('.relode-btn-icon').hide();
            $('.relode-btn-loader').show();
            setTimeout(() => {
                $('.relode-btn-icon').show();
                $('.relode-btn-loader').hide();
            }, 1500);
        });

        $('.toggle-search').on('click', function () {
            $('.search-container').toggle(500);
        });

        // handle edit & delete event
        $(this.table_id).on('click', '.show-object', async function (e, current_objct = this_objct) {
            $('#loddingSpinner').show(500);

            if (await current_objct.showDataForm(this)) {
                let current_el_id = $(this).data('current-card');
                let target_el_id  = $(this).data('target-card');
                toggleCard(current_el_id, target_el_id);
            }

            setTimeout(() => {
                $('#loddingSpinner').hide(500);
            }, 500);
        }).on('change', '.c-activation-btn', function (e, current_objct = this_objct) {
            let target_id = $(this).data('target-obj');

            axios.post(`${current_objct.routs.update_route}/${target_id}`, {
                _token  : $('meta[name="csrf-token"]').attr('content'),
                _method : 'PUT',
                activate_object: true
            }).then(res => {
                const { success, msg } = res.data;

                if (!success) {
                    $(this).prop('checked', !$(this).prop('checked'));
                    
                    current_objct.showAlertMsg(Boolean(msg) ? msg : 'Somthing went rong please refresh the page!!', current_objct.msg_container.danger_el);
                } else {
                    current_objct.showAlertMsg(msg, current_objct.msg_container.success_el);
                }
            })// axios
        }).on('click', '.edit-object', async function (e, current_objct = this_objct) {
            $('#loddingSpinner').show(500);
            
            let { success, msg } = await current_objct.editDataForm(this);

            if (success) {
                // toggle edit card
                let current_el_id = $(this).data('current-card');
                let target_el_id  = $(this).data('target-card');
                toggleCard(current_el_id, target_el_id);
            } else {
                console.log('my err response');// keep me for debuging
                current_objct.showAlertMsg(msg, current_objct.msg_container.danger_el);
            }

            $('#loddingSpinner').hide(500);

        }).on('click', '.delete-object', function (e, current_objct = this_objct) {
            // console.log('test delete event !!', current_objct);
            // get object id
            let object_id   = $(this).data('object-id');
            let object_name = $(this).data('object-name');

            let message = current_objct.custome_msg.delete_msg != null ? current_objct.custome_msg.delete_msg + `"${object_name}"`
                                                           : `Are you sure you want to delete "${object_name}"`;
            let flag = confirm(message);

            if (flag) {

                $('#loddingSpinner').show(500);
                let data = new FormData();
                data.append('_method', 'delete');
                data.append('_token' , $('meta[name="csrf-token"]').attr('content'));

                current_objct._postRequest(current_objct.routs.destroy_route + `/${object_id}`, data)
                .then(res => {
                    if (res.success) {
                        current_objct.table_object.draw();
                        current_objct.showAlertMsg(Boolean(res.msg) ? res.msg : 'Target object was deleted', current_objct.msg_container.success_el);
                        $('#loddingSpinner').hide(500);
                    } else {
                        throw res.msg;
                    }
                })
                .catch(err => {
                    $('#loddingSpinner').hide(500);
                    current_objct.showAlertMsg(Boolean(err) ? err : 'Somthing went rong please refresh the page!!', current_objct.msg_container.danger_el);
                    console.log('my err response', err);// keep me for debuging
                });
            }// end :: if
        }).on('click', '.toggle-cards-btn', function () {
            let current_el_id = $(this).data('current-card');
            let target_el_id  = $(this).data('target-card');
            toggleCard(current_el_id, target_el_id);
        });
    }

    // get data
    _getRequest = async (url = '') => {
        const response = await fetch(url);

        // parses JSON response into native JavaScript objects
        return response.json();
    }

    // post data
    _postRequest = async (url = '', data = {}) => {
        const response = await fetch(url, {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            // headers: {
            //     'Content-Type': 'application/json'
            // },
            body: data // body data type must match "Content-Type" header
        });

        // parses JSON response into native JavaScript objects
        return response.json();
    };

    // get form data
    _getFromData = (fields_id_list, imgs_fields, prefix = '') => {
        // const data = {
        //     _token : $('meta[name="csrf-token"]').attr('content')
        // };

        const data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));

        fields_id_list.forEach(el_id => {
            // data[el_id] = $(`#${prefix + el_id}`).val();
            data.append(el_id, $(`#${prefix + el_id}`).val());
        });

        imgs_fields.forEach(el_id => {
            let files_list = $(`#${prefix + el_id}`).get(0).files[0];

            data.append(`${el_id}`, files_list);

            // for (let index = 0; index < files_list.length; index++) {
            //     data.append(`${el_id}[]`, files_list[index]);
            // }// end :: for
        });// imgs_fields

        return data;
    }

    // show object data in form fields
    addDataToForm = (fields_id_list, imgs_fields, data, prefix) => {
        fields_id_list = fields_id_list.filter(el_id => !imgs_fields.includes(el_id) );
        fields_id_list.forEach(el_id => {
            $(`#${prefix + el_id}`).val(data[el_id]).change();
        });
    }

    // clear form fields values
    clearForm = (fields_id_list, prefix = '') => {
        fields_id_list.forEach(el_id => {
            $(`#${prefix}${el_id}`).val('').change();
        });
    }

    // show dynamic messages
    showAlertMsg = (msg, el_id) => {
        // $(el_id).text(msg).slideDown(500);
        // setTimeout(() => {
        //     $(el_id).slideUp(500);
        // }, 3000);
        let msgStyle ={
            '#successAlert' : {
                color: '#0f5132', background: '#d1e7dd', borderColor: '#badbcc'
            },
            '#dangerAlert' : {
                color: '#842029', background: '#f8d7da', borderColor: '#f5c2c7'
            },
            '#warningAlert' : {
                color: '#664d03', background: '#fff3cd', borderColor: '#ffecb5'
            }
        };

        Toastify({
            text: msg,
            className: "info",
            offset: {
                x: 20, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                y: 50 // vertical axis - can be a number or a string indicating unity. eg: '2em'
            },
            style: msgStyle[el_id]
        }).showToast();
    }

    // custome show modal
    showDataForm = async () => true;

    // send request to get edit form data, and render this data
    editDataForm = async (targetBtn) => {
        let object_id = $(targetBtn).data('object-id');

        let response = await axios.get(this.routs.show_route + `/${object_id}`, {
            params : {
                fast_acc: true
            }
        });

        let { data, success, msg } = response.data;

        if (success) {
            this.addDataToForm(this.table_el_ids.fields_list, this.table_el_ids.imgs_fields, data, 'edit-');

            return { success, msg };
        }

        return { success, msg };
    }

    // validate data, uses polymorphism, because it diffre from user to other
    validateData = (data, prefix = '') => true;

    showValidationErr = (msgs, prefix = '') => {
        let keys = Object.keys(msgs);
        keys.forEach(key => {
            // for case of sub validation specialy for images !!
            let tmp_key = (key.split('.'))[0];
            $(`#${prefix}${tmp_key}Err`).html(msgs[key]).slideDown(500);
        });
    }

    getFieldNamesList = () => {
        return this.table_el_ids.fields_list
    }
}

window.DynamicTable = DynamicTable;