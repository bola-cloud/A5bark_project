@push('custome-css')
<style>
    #course-lessions .btn-sm {
        font-size: 0.575rem;
    }
</style>
@endpush

<div style="display: none" id="mediaObjectCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('courses.Edit_Lessions')</h5>
        </div>
        <div class="col-6 text-end">
            <div class="toggle-btn btn btn-outline-dark btn-sm" data-current-card="#mediaObjectCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div><!-- /.row -->
    <hr/>

    <form action="/" id="objectForm">
        <input type="hidden" id="l-order" value="1">
        <input type="hidden" id="l-course_id" value="1">

        <div class="my-2 row">
            <div class="col-sm-6">
                <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6 text-end">
                            <button class="btn btn-sm btn-outline-dark" type="button" id="add-lession-btn">
                                @lang('courses.Add_Lession')
                                <i class="fas fa-plus-circle mx-1"></i>
                            </button>
                        </div>
                    </div><!-- /.row -->
                </div>
                    <div class="card-body" style="overflow-y: scroll; height: 350px">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>@lang('courses.Title')</th>
                                    <th>@lang('courses.Type')</th>
                                    <th>@lang('courses.Action')</th>
                                </tr>
                            </thead>
                            <tbody id="course-lessions"></tbody>
                        </table>
                    </div><!-- /.card-body -->
                </div><!-- /card -->
            </div><!-- /.col-sm-6 -->

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <span id="label-lession_title"></span>
                            </div><!-- /.col-sm-6 -->
                            <div class="col-sm-6 text-end">
                                <button id="add-media-btn" class="btn btn-sm btn-outline-dark" type="button" !data-bs-toggle="modal" !data-bs-target="#lessionMediaForm">
                                    @lang('courses.Add_Media')
                                    <i class="fas fa-plus-circle mx-1"></i>
                                    <div style="display: none" class="spinner-border spinner-border-sm mx-2" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </button>
                            </div><!-- /.col-sm-6 -->
                        </div><!-- /.row -->
                    </div><!-- /.card-header -->
                    <div class="card-body" style="overflow-y: scroll; height: 350px">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('courses.Title')</th>
                                    <th>@lang('courses.Type')</th>
                                    <th>@lang('courses.Upload')</th>
                                    <th>@lang('courses.Action')</th>
                                </tr>
                            </thead>
                            <tbody id="lession-media"></tbody>
                        </table>
                    </div><!-- /.card-body -->
                </div><!-- /card -->
            </div><!-- /.col-sm-6 -->
        </div><!-- /.my-2 -->

        <button class="create-object btn btn-primary float-end">@lang('courses.Add Media')</button>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="courseLessionForm" tabindex="-1" data-bs-backdrop="static" aria-labelledby="courseLessionFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="my-2 row">
                    <label for="l-ar_title" class="col-sm-2 col-form-label">@lang('courses.Title') <span class="text-danger float-right">*</span></label>
                    <div class="col-5" style="direction: rtl">
                        <input type="text" class="form-control custome-ar-field" id="l-ar_title" placeholder="عنوان المحاضرة بالعربية">
                        <div style="padding: 5px 7px; display: none" id="l-ar_titleErr" class="err-msg mt-2 alert alert-danger custome-ar-field">
                        </div>
                    </div><!-- /.col-5 -->
                    <div class="col-5" style="direction: rtl">
                        <input type="text" class="form-control custome-en-field" id="l-en_title" placeholder="Lession title in english">
                        <div style="padding: 5px 7px; display: none" id="l-en_titleErr" class="err-msg mt-2 alert alert-danger custome-en-field">
                        </div>
                    </div><!-- /.col-5 -->
                </div><!-- /.my-2 -->
                
                <div class="my-2 row">
                    <label for="l-ar_description" class="col-sm-2 col-form-label">@lang('courses.Description') <span class="text-danger float-right">*</span></label>
                    <div class="col-5" style="direction: rtl">
                        <textarea type="text" class="form-control custome-ar-field" id="l-ar_description" placeholder="الوصف بالعربية"></textarea>
                        <div style="padding: 5px 7px; display: none" id="l-ar_descriptionErr" class="err-msg mt-2 alert alert-danger custome-ar-field">
                        </div>
                    </div><!-- /.col-5 -->
                    <div class="col-5" style="direction: rtl">
                        <textarea type="text" class="form-control custome-en-field" id="l-en_description" placeholder="Description in english"></textarea>
                        <div style="padding: 5px 7px; display: none" id="l-en_descriptionErr" class="err-msg mt-2 alert alert-danger custome-en-field">
                        </div>
                    </div><!-- /.col-5 -->
                </div><!-- /.my-2 -->
            </div><!-- /.modal-body -->

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <button type="button" id="add-lession" class="lesson-crud-btn btn btn-primary">
                    @lang('courses.Add_Lession')
                    <div style="display: none" class="spinner-border spinner-border-sm mx-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>

                <button type="button" id="update-lession" class="lesson-crud-btn btn btn-warning" style="display: none">
                    @lang('courses.Update_Lession')
                    <div style="display: none" class="spinner-border spinner-border-sm mx-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
                <!-- <button class="btn btn-primary">Save changes</button> -->
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="lessionMediaForm" tabindex="-1" data-bs-backdrop="static" aria-labelledby="lessionMediaFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="my-2 row">
                    <label for="m-ar_title" class="col-sm-2 col-form-label">@lang('courses.Title') <span class="text-danger float-right">*</span></label>
                    <div class="col-5" style="direction: rtl">
                        <input type="text" class="form-control custome-ar-field" id="m-ar_title" placeholder="عنوان المحاضرة بالعربية">
                        <div style="padding: 5px 7px; display: none" id="m-ar_titleErr" class="err-msg mt-2 alert alert-danger custome-ar-field">
                        </div>
                    </div><!-- /.col-5 -->
                    <div class="col-5" style="direction: rtl">
                        <input type="text" class="form-control custome-en-field" id="m-en_title" placeholder="Lession title in english">
                        <div style="padding: 5px 7px; display: none" id="m-en_titleErr" class="err-msg mt-2 alert alert-danger custome-en-field">
                        </div>
                    </div><!-- /.col-5 -->
                </div><!-- /.my-2 -->
                
                <div class="my-2 row">
                    <label for="m-ar_description" class="col-sm-2 col-form-label">@lang('courses.Description') <span class="text-danger float-right">*</span></label>
                    <div class="col-5" style="direction: rtl">
                        <textarea type="text" class="form-control custome-ar-field" id="m-ar_description" placeholder="الوصف بالعربية"></textarea>
                        <div style="padding: 5px 7px; display: none" id="l-ar_descriptionErr" class="err-msg mt-2 alert alert-danger custome-ar-field">
                        </div>
                    </div><!-- /.col-5 -->
                    <div class="col-5" style="direction: rtl">
                        <textarea type="text" class="form-control custome-en-field" id="m-en_description" placeholder="Description in english"></textarea>
                        <div style="padding: 5px 7px; display: none" id="m-en_descriptionErr" class="err-msg mt-2 alert alert-danger custome-en-field">
                        </div>
                    </div><!-- /.col-5 -->
                </div><!-- /.my-2 -->

                <div class="my-2 row">
                    <label for="m-media_type" class="col-sm-2 col-form-label">@lang('courses.Media_Type') <span class="text-danger float-right">*</span></label>
                    <div class="col-10">
                        <select class="form-control" id="m-media_type">
                            <option value="">@lang('courses.select_media_type')</option>
                            <option value="video">@lang('courses.video')</option>
                            <option value="file">@lang('courses.file')</option>
                        </select>
                    </div><!-- /.col-10 -->
                </div><!-- /.my-2 -->

                <div class="my-2 row">
                    <label for="m-upload_type" class="col-sm-2 col-form-label">@lang('courses.Upload_Type') <span class="text-danger float-right">*</span></label>
                    <div class="col-10">
                        <select class="form-control" id="m-upload_type"></select>
                    </div><!-- /.col-10 -->
                </div><!-- /.my-2 -->

                <div class="my-2 row m-file" style="display: none">
                    <label for="m-file" class="col-sm-2 col-form-label">@lang('courses.File') <span class="text-danger float-right">*</span></label>
                    <div class="col-10">
                        <input type="url" class="form-control" id="m-file">
                    </div><!-- /.col-10 -->
                </div><!-- /.my-2 -->

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <button type="button" id="add-media" class="media-crud-btn btn btn-primary">
                    @lang('courses.Add_Media')
                    <div style="display: none" class="spinner-border spinner-border-sm mx-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>

                <button type="button" id="update-media" class="media-crud-btn btn btn-warning" style="display: none">
                    @lang('courses.Update_Media')
                    <div style="display: none" class="spinner-border spinner-border-sm mx-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
                <!-- <button class="btn btn-primary">Save changes</button> -->
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>

@push('custome-js')
<script>
$(document).ready(function () {
    const lang = '{{ $lang }}';

    const LessionLogic = (() => {
        const Store = (() => {
            const meta = {
                course_id  : null, // set me to null
                last_order : 1,
                lessions   : [],
                lession_id : null,// Target lesson for update
            };

            const getters = {
                getLessions : () => [...meta.lessions],

                findLessionForUpdate : (lession_id) => {
                    let lession = meta.lessions.find(lession => lession.id == lession_id);
                    meta.lession_id = lession.id;

                    return lession;
                }
            };

            const setters = {
                setCourseId : (course_id) => {
                    meta.course_id = course_id;
                },

                fetchLessions : async () => {
                    try {
                        const res = await axios.get(`{{ route('admin.courses.index') }}/${meta.course_id}`, {
                            params : {
                                get_course_lession : true
                            }
                        });

                        const { data, success } = res.data;
                        
                        if (success) {
                            meta.lessions   = Boolean(data.lessions) ? data.lessions.sort((a, b) => a.order - b.order) : [];
                            meta.last_order = meta.lessions.length ? meta.lessions[meta.lessions.length - 1].order + 1 : 1;
                            
                            return true;
                        }

                        return false;
                    } catch (e) {
                        return false;
                    }
                },

                addLession    : async (lession) => {
                    try {
                        const res = await axios.post(`{{ route('admin.coursesLessions.index') }}`, {
                            _token  : '{{ csrf_token() }}',
                            store_course_lession : true,
                            ...lession,
                            order : meta.last_order,
                            course_id : meta.course_id,
                        });

                        const { data, success } = res.data;

                        if (success) {
                            
                            meta.lessions.push(data);
                            meta.last_order += 1;
                            
                            return true;
                        }
                        
                        return false;
                    } catch (e) {
                        return false;
                    } 
                },

                updateLession : async (lession) => {
                    /**
                     * We want to get the lession data and update the lession 
                     * than get the response with new lession and update the local copy 
                     * than update the re-render the list. 
                     */
                    try {
                        const res = await axios.post(`{{ route('admin.coursesLessions.index') }}/${meta.lession_id}`, {
                            _method : 'PUT',
                            _token  : '{{ csrf_token() }}',
                            store_course_lession : true,
                            ...lession,
                            course_id : meta.course_id,
                        });

                        const { data, success } = res.data;

                        if (success) {
                            
                            meta.lessions = meta.lessions.map(lession => {
                                if (lession.id == data.id) {
                                    return data
                                }

                                return lession;
                            })
                            
                            return true;
                        }
                        
                        return false;
                    } catch (e) {
                        return false;
                    }
                },

                deleteLession : async (lession_id) => {
                    try {
                        const res = await axios.post(`{{ route('admin.coursesLessions.index') }}/${lession_id}`, {
                            _method : 'DELETE',
                            _token  : '{{ csrf_token() }}',
                        });

                        const { data, success } = res.data;

                        if (success) {
                            meta.lessions = meta.lessions.filter(less => less.id != lession_id);

                            return true
                        }
                        
                        return false;

                    } catch (e) {
                        return false;
                    }
                }
            };

            return {
                getters,
                setters
            };
        })();

        const Render = (() => {
            const lession_form_fields = [
                'ar_title', 'en_title', 'ar_description', 'en_description',
            ];

            let msgStyle ={
                'successAlert' : {
                    color: '#0f5132', background: '#d1e7dd', borderColor: '#badbcc'
                },
                'dangerAlert' : {
                    color: '#842029', background: '#f8d7da', borderColor: '#f5c2c7'
                },
                'warningAlert' : {
                    color: '#664d03', background: '#fff3cd', borderColor: '#ffecb5'
                }
            };

            const renderMessage = (msg, el_id = 'successAlert') => {
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

            const lessionLoader = (flag = false) => {
                // Loading animation in add lession button
                if (flag) {
                    $('#loddingSpinner').hide()
                    $('.lesson-crud-btn').removeAttr('disabled');
                    $('.lesson-crud-btn .spinner-border').hide(500);
                } else {
                    $('#loddingSpinner').show()
                    $('.lesson-crud-btn').attr('disabled', 'disabled');
                    $('.lesson-crud-btn .spinner-border').show(500);
                }
            };

            const getLessionData = () => {
                let is_valied = true;

                let data = {};

                lession_form_fields.forEach(key => {
                    let field_val = $(`#l-${key}`).val();

                    if (!Boolean(field_val)) {
                        is_valied = false;
                        $(`#l-${key}`).css('border', '1px solid red');
                    } else {
                        data[key] = field_val;
                        $(`#l-${key}`).css('border', '');
                    }
                });

                return is_valied ? data : is_valied;
            };

            const toggleLessionForm = (lession = null) => {
                /**
                 * # Toggle lession form bettween edit & create 
                 * # We use lession params as a flag to deside if the 
                 * form in edit or create mode 
                 */
                if (lession) {
                    lession_form_fields.forEach(key => {
                        $(`#l-${key}`).val(lession[key]);
                        $(`#l-${key}`).css('border', '');
                    });

                    var myModal = new bootstrap.Modal(document.getElementById('courseLessionForm'), { keyboard: false });

                    $("#add-lession").hide();
                    $('#update-lession').show();

                    myModal.toggle();
                } else {
                    var myModal = new bootstrap.Modal(document.getElementById('courseLessionForm'), { keyboard: false });

                    $("#add-lession").show();
                    $('#update-lession').hide();

                    Render.clearLessionForm();

                    myModal.toggle();
                }
            }

            const clearLessionForm = () => {
                lession_form_fields.forEach(key => {
                    $(`#l-${key}`).val('');
                });
            }

            const renderLessions = (lessions) => {
                let lessions_el = ``;

                lessions.forEach((lession, index) => {
                    lessions_el += `
                        <tr>
                            <td>${index + 1}</td>
                            <!--
                                <td>
                                    <button class="btn btn-sm btn-outline-dark">
                                        <i class="fas fa-caret-up"></i>
                                    </button>
                                        ${lession.order}
                                    <button class="btn btn-sm btn-outline-dark">
                                        <i class="fas fa-sort-down"></i>
                                    </button>
                                </td>
                            -->
                            <td>${lang == 'ar' ? lession.ar_title : lession.en_title}</td>
                            <td>
                                <div class="btn-group text-small">
                                    <button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-sliders-h"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button type="button" class="foucs-course-lession dropdown-item text-info" href="#" data-title="${lang == 'ar' ? lession.ar_title : lession.en_title}" data-target="${lession.id}">
                                                <div class="row">
                                                    <div class="col-8 text-left">
                                                        <span>@lang('layouts.show')</span>
                                                    </div>
                                                    <div class="col-4">
                                                        <i class="fas fa-eye float-end"></i>
                                                    </div>
                                                </div><!-- /.row -->
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="update-course-lession dropdown-item text-warning" href="#" data-target="${lession.id}">
                                                <div class="row">
                                                    <div class="col-8 text-left">
                                                        <span>@lang('layouts.edit')</span>
                                                    </div>
                                                    <div class="col-4">
                                                        <i class="fas fa-edit float-end"></i>
                                                    </div>
                                                </div><!-- /.row -->
                                            </button>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <button type="button" class="delete-course-lession dropdown-item text-danger" data-title="${lang == 'ar' ? lession.ar_title : lession.en_title}" data-target="${lession.id}">
                                                <div class="row">
                                                    <div class="col-8 text-left">
                                                        <span>@lang('layouts.delete')</span>
                                                    </div>
                                                    <div class="col-4">
                                                        <i class="fas fa-trash-alt float-end"></i>
                                                    </div>
                                                </div><!-- /.row -->    
                                            </button>
                                        </li>
                                    </ul>
                                </div><!-- /.btn-group -->
                            </td>
                        </tr>
                    `;
                });

                $('#course-lessions').html(lessions_el);
            };

            return {
                renderMessage,
                renderLessions,
                getLessionData,
                lessionLoader,
                clearLessionForm,
                toggleLessionForm,
            }
        })();

        const { setters, getters } = Store;

        // Render course lesson table
        $('#dataTable').on('click', '.update-content', async function (e) {
            /**
             * Load related lessions of the course
             * than render it, disabled the add new lession untill the content loades
             * 
            */
            e.preventDefault();

            Render.lessionLoader();

            let target_id = $(this).data('target');

            setters.setCourseId(target_id);

            let flag = await setters.fetchLessions();
            Render.renderLessions(getters.getLessions());

            Render.lessionLoader(true);

            if (flag) {
                $('#objectsCard').slideUp(500);
                $("#mediaObjectCard").slideDown(500);
            } else {
                Render.renderMessage(`@lang('courses.something_wrong')`, 'dangerAlert');
            }

        });

        // Store new lesson record
        $('#add-lession').on('click', async function (e) {
            // Add new lession to the course.
            e.preventDefault();

            const data = Render.getLessionData();

            if (data) {
                Render.lessionLoader();
                
                let flag = await setters.addLession(data);
                
                flag
                ? Render.renderMessage(`@lang('courses.lession_created')`, 'successAlert')
                : Render.renderMessage(`@lang('courses.something_wrong')`, 'dangerAlert');

                Render.renderLessions(getters.getLessions());

                Render.clearLessionForm();
                Render.lessionLoader(true);
            }
        });

        // Update lesson record
        $('#update-lession').on('click', async function (e) {
            // Update course lession.
            e.preventDefault();

            const data = Render.getLessionData();

            if (data) {
                Render.lessionLoader();
                
                let flag = await setters.updateLession(data);
                
                flag
                ? Render.renderMessage(`@lang('courses.lession_updated')`, 'warningAlert')
                : Render.renderMessage(`@lang('courses.something_wrong')`, 'dangerAlert');

                Render.renderLessions(getters.getLessions());

                Render.lessionLoader(true);
            }
        });
        
        // Delete lesson record
        $('#course-lessions').on('click', '.delete-course-lession', async function (e) {
            // Delete course lession with it's own media from the course. 
            e.preventDefault();

            let target_title = $(this).data('title');
            
            let flag = confirm(`@lang('courses.confirm_lession_delete') ${target_title}`);
            
            if (flag) {
                let target_id = $(this).data('target');

                let flag = await setters.deleteLession(target_id);
                Render.renderLessions(getters.getLessions());

                flag
                ? Render.renderMessage(`@lang('courses.lession_deleted')`, 'warningAlert')
                : Render.renderMessage(`@lang('courses.something_wrong')`, 'dangerAlert');
            }

        });

        // Toggle lesson create form
        $('#add-lession-btn').on('click', function (e) {
            // Show add lession form logic.
            e.preventDefault();

            Render.toggleLessionForm();
        });

        // Toggle lesson create form
        $('#course-lessions').on('click', '.update-course-lession', function (e) {
            // Show lession edit form
            e.preventDefault();

            let target_id = $(this).data('target');

            let lession = getters.findLessionForUpdate(target_id);
            
            Render.toggleLessionForm(lession);
                        
        });

    })();

    const MediaLogic = (() => {
        const Store = (() => {
            const meta = {
                media_id   : null, 
                lession_id : null,
                last_order : 1,
                media      : {},
                media_update_target_id : null,
            };

            const setters = {

                storeMedia : async (mediaObj) => {
                    try {
                        const res = await axios.post(`{{ route('admin.coursesMedias.index') }}`, {
                            _token: "{{ csrf_token() }}",
                            ...mediaObj,
                            lession_id : meta.lession_id,
                            order : meta.last_order
                        });

                        const { data, success } = res.data;

                        if (success) {
                            if (Boolean(meta.media[meta.lession_id])) {
                                meta.media[meta.lession_id].push(data);    
                            } else {
                                meta.media[meta.lession_id] = [data];    
                            }

                            return true;
                        } else {
                            return false;
                        }
                    } catch (e) {
                        console.log('StoreMedia request error ...', e);
                        return false;
                    }
                },

                updateMedia : async (media) => {
                    try {
                        const res = await axios.post(`{{ route('admin.coursesMedias.index') }}/${meta.media_id}`, {
                            _method : 'PUT',
                            _token  : '{{ csrf_token() }}',
                            ...media,
                            lession_id : meta.lession_id,
                        });

                        const { data, success } = res.data;

                        if (success) {
                            
                            meta.media[meta.lession_id] = meta.media[meta.lession_id].map(media => {
                                if (media.id == data.id) {
                                    return data
                                }

                                return media;
                            })
                            
                            return true;
                        }
                        
                        return false;
                    } catch (e) {
                        return false;
                    }
                },

                deleteMedia : async (media_id) => {
                    try {
                        const res = await axios.post(`{{ route('admin.coursesMedias.index') }}/${media_id}`, {
                            _method : 'DELETE',
                            _token  : '{{ csrf_token() }}',
                        });

                        const { data, success } = res.data;

                        if (success) {
                            meta.media[meta.lession_id] = meta.media[meta.lession_id].filter(media => media.id != media_id);

                            return true
                        }
                        
                        return false;

                    } catch (e) {
                        return false;
                    }
                },
                
                setMediaId   : (media_id) => {
                    meta.media_id   = media_id
                    meta.lession_id = null;
                }, 

                setLessionId : (lession_id) => meta.lession_id = lession_id,

            };
            
            const getters = {
                
                findMediaForUpdate : (media_id) => {
                    
                    let media = meta.media[meta.lession_id].find(media => media.id == media_id);
                    meta.media_id = media.id;

                    return media;
                },

                getMedia : async () => {
                    /**
                     * 1- check if the lession media exists,
                     * 2- if exists return the value
                     * 3- if not send a request to get the data
                     * 4- store the data in the storga 
                     */
                    
                    if (!Boolean(meta.media[meta.lession_id])) {
                        try {
                            const res = await axios.get(`{{ route('admin.coursesLessions.index') }}/${meta.lession_id}`);

                            const { data, success } = res.data;

                            if (success) {
                                meta.media[meta.lession_id] = [...data.media]
                            } else {
                                return false;   
                            }
                        } catch (e) {
                            console.log('getMedia error : ', e);
                            return false;
                        }
                    }
                    
                    return Boolean(meta.media[meta.lession_id]) ? [...meta.media[meta.lession_id]] : [];
                },
            };

            return {
                setters,
                getters,
            }
        })();

        const Render = (() => {
            const media_table_body  = '#lession-media'
            const media_form_fields = [
                'ar_title', 'en_title', 'ar_description', 'en_description',
                'media_type', 'upload_type', 'file'
            ];

            let msgStyle ={
                'successAlert' : {
                    color: '#0f5132', background: '#d1e7dd', borderColor: '#badbcc'
                },
                'dangerAlert' : {
                    color: '#842029', background: '#f8d7da', borderColor: '#f5c2c7'
                },
                'warningAlert' : {
                    color: '#664d03', background: '#fff3cd', borderColor: '#ffecb5'
                }
            };

            const renderMessage = (msg, el_id = 'successAlert') => {
                Toastify({
                    text: msg,
                    className: "info",
                    offset: {
                        x: 20, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                        y: 50 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                    },
                    style: msgStyle[el_id]
                }).showToast();
            };

            const renderMedia = (lession_media, lession_title = null) => {
                let media_list = '';

                lession_media.forEach((media, index) => {
                    media_list += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${lang == 'ar' ? media.ar_title : media.en_title }</td>
                            <td>${ media.media_type }</td>
                            <td>${ media.upload_type }</td>
                            <td>
                                <div class="btn-group text-small">
                                    <button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-sliders-h"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button type="button" class="foucs-lession-media- dropdown-item text-info" href="#" data-target="${media.id}">
                                                <div class="row">
                                                    <div class="col-8 text-left">
                                                        <span>@lang('layouts.show')</span>
                                                    </div>
                                                    <div class="col-4">
                                                        <i class="fas fa-eye float-end"></i>
                                                    </div>
                                                </div><!-- /.row -->
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="update-lession-media dropdown-item text-warning" href="#" data-target="${media.id}">
                                                <div class="row">
                                                    <div class="col-8 text-left">
                                                        <span>@lang('layouts.edit')</span>
                                                    </div>
                                                    <div class="col-4">
                                                        <i class="fas fa-edit float-end"></i>
                                                    </div>
                                                </div><!-- /.row -->
                                            </button>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <button type="button" class="delete-lession-media dropdown-item text-danger" data-title="${lang == 'ar' ? media.ar_title : media.en_title}" data-target="${media.id}">
                                                <div class="row">
                                                    <div class="col-8 text-left">
                                                        <span>@lang('layouts.delete')</span>
                                                    </div>
                                                    <div class="col-4">
                                                        <i class="fas fa-trash-alt float-end"></i>
                                                    </div>
                                                </div><!-- /.row -->    
                                            </button>
                                        </li>
                                    </ul>
                                </div><!-- /.btn-group -->
                            </td>
                        </tr>
                    `;
                });

                $(media_table_body).html(media_list);
                Boolean(lession_title) ? $('#label-lession_title').text(lession_title) : null;

            };

            const mediaLoader = (flag = false) => {
                // Loading animation in add media button
                if (flag) {
                    $('#loddingSpinner').hide()
                    $('.media-crud-btn').removeAttr('disabled');
                    $('.media-crud-btn .spinner-border').hide(500);
                } else {
                    $('#loddingSpinner').show()
                    $('.media-crud-btn').attr('disabled', 'disabled');
                    $('.media-crud-btn .spinner-border').show(500);
                }
            };

            const mediaTableloader = (flag = false) => {
                if (!flag) {
                    $('#add-media-btn').attr('disabled', 'disabled');
                    $('#add-media-btn .spinner-border').show(500);
                } else {
                    $('#add-media-btn').removeAttr('disabled');
                    $('#add-media-btn .spinner-border').hide(500);
                }
            };

            const toggleMediaForm = (media = null) => {
                /**
                 * # Toggle medis form bettween edit & create 
                 * # We use medis params as a flag to deside if the 
                 * form in edit or create mode 
                 */

                if (media) {
                    media_form_fields.forEach(key => {
                        $(`#m-${key}`).val(media[key]).trigger('change');
                    });

                    var myModal = new bootstrap.Modal(document.getElementById('lessionMediaForm'), { keyboard: false });

                    $("#add-media").hide();
                    $('#update-media').show();

                    myModal.toggle();
                } else {
                    var myModal = new bootstrap.Modal(document.getElementById('lessionMediaForm'), { keyboard: false });

                    $("#add-media").show();
                    $('#update-media').hide();

                    clearMediaForm();

                    myModal.toggle();
                }
            };

            const getMediaData = () => {
                let is_valied = true;

                let data = {};

                media_form_fields.forEach(key => {
                    let field_val = $(`#m-${key}`).val();

                    if (!Boolean(field_val)) {
                        is_valied = false;
                        $(`#m-${key}`).css('border', '1px solid red');
                    } else {
                        data[key] = field_val;
                        $(`#m-${key}`).css('border', '');
                    }
                });

                return is_valied ? data : is_valied;
            };
            
            const clearMediaForm = () => {
                media_form_fields.forEach(key => {
                    $(`#m-${key}`).val('').trigger('change');
                });
            };

            return {
                renderMessage,
                renderMedia,
                mediaLoader,
                mediaTableloader,
                toggleMediaForm,
                getMediaData,
                clearMediaForm
            }
        })();

        const { setters, getters } = Store;

        // Reset the media table ...
        $('#dataTable').on('click', '.update-content', async function (e) {
            e.preventDefault();

            Render.renderMedia([], '---')

        });

        // Show lession media
        $('#course-lessions').on('click', '.foucs-course-lession', async function (e) {
            e.preventDefault();
            
            /**
             * Get lession_id
             * check if the lession media exists
             *  => if exists render the existing list
             *  => else get the media with a request cach it 
             * render the data
            */
            
            let lession_id    = $(this).data('target');
            let lession_title = $(this).data('title');
            
            Render.mediaTableloader();

            setters.setLessionId(lession_id);
            
            let data = await getters.getMedia();

            Boolean(data) 
                ? Render.renderMedia(await getters.getMedia(), lession_title)
                : Render.renderMessage(`@lang('courses.something_wrong')`, 'dangerAlert');;
            
            Render.mediaTableloader(true);

        });

        // Load media create form
        $('#add-media-btn').on('click', function (e) {
            e.preventDefault();

            Render.toggleMediaForm();
        });

        // Load media update form
        $('#lession-media').on('click', '.update-lession-media', async function (e) {
            /**
             * Load related lessions of the course
             * than render it, disabled the add new lession untill the content loades
             * 
            */

            e.preventDefault();

            let target_id = $(this).data('target');

            let media = getters.findMediaForUpdate(target_id);
            
            Render.toggleMediaForm(media);

        });

        // Update media
        $('#update-media').on('click', async function (e) {
            // Update course lession.
            e.preventDefault();

            const data = Render.getMediaData();

            if (data) {
                Render.mediaLoader();
                
                let flag = await setters.updateMedia(data);
                
                flag
                ? Render.renderMessage(`@lang('courses.media_updated')`, 'warningAlert')
                : Render.renderMessage(`@lang('courses.something_wrong')`, 'dangerAlert');

                Render.renderMedia(await getters.getMedia());

                Render.mediaLoader(true);
            }
        });

        // Delete media
        $('#lession-media').on('click', '.delete-lession-media', async function (e) {
            // Delete course lession with it's own media from the course. 
            e.preventDefault();

            let target_title = $(this).data('title');
            
            let flag = confirm(`@lang('courses.confirm_media_delete') ${target_title}`);
            
            if (flag) {
                let media_id = $(this).data('target');

                let flag = await setters.deleteMedia(media_id);
                Render.renderMedia(await getters.getMedia());

                flag
                ? Render.renderMessage(`@lang('courses.media_deleted')`, 'warningAlert')
                : Render.renderMessage(`@lang('courses.something_wrong')`, 'dangerAlert');
            }

        });

        // Create new media
        $('#add-media').on('click', async function (e) {
            e.preventDefault();

            /**
             * 1- Call form data 
             * 2- if valied send request
             * 3-
             */
            let data = Render.getMediaData();
            
            if (data) {
                Render.mediaLoader();
                
                let flag = await setters.storeMedia(data);
                
                flag
                ? Render.renderMessage(`@lang('courses.lession_created')`, 'warningAlert')
                : Render.renderMessage(`@lang('courses.something_wrong')`, 'dangerAlert');

                Render.renderMedia(await getters.getMedia());

                Render.clearMediaForm();
                Render.mediaLoader(true);
            }
        });
        
        // Parse media form input fields by 
        $('#m-media_type').on('change', function () {
            let val = $(this).val();
            let options = ``;

            switch (val) {
                case 'video' :
                    options = `
                        <option value="">@lang('courses.select_upload_type')</option>
                        <option value="local_upload">@lang('courses.local_upload')</option>
                        <option value="google_drive_link">@lang('courses.google_drive_link')</option>
                        <option value="youtube_link">@lang('courses.youtube_link')</option>
                        <option value="bunny">@lang('courses.bunny')</option>
                    `;
                    break;
                case 'file' :
                    options = `
                        <option value="">@lang('courses.select_upload_type')</option>
                        <option value="local_upload">@lang('courses.local_upload')</option>
                        <option value="google_drive_link">@lang('courses.google_drive_link')</option>
                    `;
                    break;
                default :
                    options = '';
            }// end :: switch

            $('#m-upload_type').html(options);
        }); 

        $('#m-upload_type').on('change', function () {
            let val = $(this).val();

            if (val == '') {
                $('#m-file').attr('type', '');
                $('.m-file').slideUp(500);
            } else {
                $('#m-file').attr('type', val == 'local_upload' ? 'file' : 'url');
                $('.m-file').slideDown(500);
            }
        });

    })();
});
</script>
@endpush