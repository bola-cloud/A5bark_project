<div style="display: none" id="editObjectsCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>تحديث التدريب</h5>
        </div>
        <div class="col-6 text-right">
            <div class="toggle-btn btn btn-default btn-sm" data-current-card="#editObjectsCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div><!-- /.row -->

    <hr/>

    <form action="/" id="objectForm">
        <input type="hidden" id="edit-id">
        
        <div class="form-group row">
            <label for="edit-family_id" class="col-sm-3 col-form-label">الأسرة</label>
            <div class="col-sm-9">
                <select type="text" class="form-control" id="edit-family_id"></select>
                <div style="padding: 5px 7px; display: none" id="edit-family_idErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.form-group -->

        <div class="form-group row">
            <label for="edit-family_code" class="col-sm-3 col-form-label">كود الأسرة</label>
            <div class="col-sm-9">
                <input id="edit-family_code" class="form-control" disabled="disabled">
                <div style="padding: 5px 7px; display: none" id="edit-family_codeErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.form-group -->

        <div class="form-group row">
            <label for="edit-project_name" class="col-sm-3 col-form-label" disabled="disabled">نوع المشروع</label>
            <div class="col-sm-9">
                <input type="hidden" id="edit-project_id">
                <input id="edit-project_name" class="form-control" disabled="disabled">
                <div style="padding: 5px 7px; display: none" id="edit-project_idErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.form-group -->

        <div class="form-group row">
            <label for="edit-delivery_date" class="col-sm-3 col-form-label">تاريخ التسليم</label>
            <div class="col-sm-9">
                <input type="date" class="form-control" id="edit-delivery_date">
                <div style="padding: 5px 7px; display: none" id="edit-delivery_dateErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.form-group -->
        
        <div class="form-group row mb-4">
            <input type="hidden" id="edit-delivery_content">
            <label for="edit-delivery_content" class="col-sm-3 col-form-label">محتوي المشروع</label>
            <div class="col-sm-9" style="overflow-y: scroll; height: 250px;">
                <div style="padding: 5px 7px; display: none" id="edit-projectContentErr" class="err-msg mt-2 alert mb-2 alert-danger">
                </div>

                <table class="table table-sm text-center">
                    <thead>
                        <tr>
                            <td>البند</td>
                            <td>الكمية</td>
                            <td>التحكم</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input id="edit-contentTitle" type="text" class="form-control" placeholder="البند">
                                </div>
                                <div style="padding: 5px 7px; display: none" id="edit-contentTitleErr" class="err-content-msg mt-2 alert alert-danger"></div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input id="edit-contentQuantity" type="number" min="0" class="form-control" placeholder="الكمية">
                                </div>
                                <div style="padding: 5px 7px; display: none" id="edit-contentQuantityErr" class="err-content-msg mt-2 alert alert-danger"></div>
                            </td>
                            <td>
                                <button class="edit-project-content btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="edit-projectContentTable"></tbody>
                </table>
            </div>
        </div><!-- /.form-group -->

        <div class="form-group row">
            <input type="hidden" id="edit-mediaFiles">
            <input type="hidden" id="edit-mediaFormater">
            <label for="edit-media_files" class="col-sm-3 col-form-label">ملفات</label>
            <div class="col-sm-9" style="overflow-y: scroll; height: 250px">
                <table class="table table-striped table-sm text-center">
                    <thead>
                        <tr>
                            <td>أسم الملف</td>
                            <td>الملف</td>
                            <td>التحكم</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="edit-mediaTitle" class="form-control" placeholder="اسم الملف">
                                </div>
                                <div style="padding: 5px 7px; display: none" id="edit-mediaTitleErr" class="err-file-msg mt-2 alert alert-danger"></div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="edit-mediaFile" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="edit-mediaFile">حدد الملف</label>
                                    </div>
                                </div>
                                <div style="padding: 5px 7px; display: none" id="edit-mediaFileErr" class="err-file-msg mt-2 alert alert-danger"></div>
                            </td>
                            <td>
                                <button id="edit-uploadMediaFile" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="edit-mediaTable">
                        
                    </tbody>
                </table>
            </div>
        </div><!-- /.form-group --> 

        <div class="form-group row">    
            <label for="edit-delivery_file" class="col-sm-3 col-form-label">نومذج استلام أصول</label>
            <div class="col-sm-9">
                <div>
                    <input type="file" id="edit-delivery_file">
                </div>
                <div style="padding: 5px 7px; display: none" id="edit-delivery_fileErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.form-group -->
     
        <button class="update-object btn btn-warning float-right">تحديث التدريب</button>
    </form>
</div>

@push('page_scripts')
<script>
$(function () {
    
    function projectContent () {
        let content = [];

        function getData () {
            let is_valied = true;
            $('.err-content-msg').slideUp(500);

            let tmp = {
                id : Math.round(Math.random() * 1000),
                title    : $('#edit-contentTitle').val(),
                quantity : $('#edit-contentQuantity').val(),
            };


            if (!Boolean(tmp.title)) {
                is_valied = false;
                $('#edit-contentTitleErr').text('يرجي ادخال مسمي البند').slideDown(500);
            }

            if (!Boolean(tmp.quantity) || tmp.quantity < 0) {
                is_valied = false;
                $('#edit-contentQuantityErr').text('يرجي ادخال كمية البند').slideDown(500);
            }

            return is_valied ? tmp : false;
        }

        function clearForm () {
            $('#edit-contentTitle').val('')
            $('#edit-contentQuantity').val('') 
        }

        function renderList () {
            let rows = '';

            content.forEach(el => {
                rows += `
                    <tr>
                        <td>${el.title}</td>
                        <td>${el.quantity}</td>
                        <td>
                            <button class="btn btn-danger btn-sm delete-project-content" data-target="${el.id}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });

            $('#edit-projectContentTable').html(rows);
        }

        $('.edit-project-content').click(function (e) {
            /**
             * 1- get content data (title, quantityt)
             * 2- validate data
             * 3- add to the list
             * 4- render the new list
             */

            e.preventDefault();

            let data = getData();

            if (data) {
                content.push(data);
                $('#edit-delivery_content').val(JSON.stringify(content));

                clearForm();
                renderList();
            }

        });

        $('#edit-projectContentTable').on('click', '.delete-project-content', function () {
            let target_id = $(this).data('target');

            content = content.filter(val => val.id != target_id);
            $('#edit-delivery_content').val(JSON.stringify(content));

            clearForm();
            renderList();
        });

        // edit action
        $('#edit-delivery_content').click(function () {
            content = JSON.parse($('#edit-delivery_content').val());
             
            clearForm();
            renderList();
        })
    }

    projectContent();

    function mediaHandler (base_url = `{{ route('admin.project_actions.store') }}`) {
        window.list_media = [];

        function renderFileRow (title, id = null, file = null) {
            let row_id = Boolean(id) ? id : Math.round(Math.random() * 1000);

            let row = `
            <tr id="mediaRow${row_id}">
                <td>${title}</td>
                <td id="uploadProgress${row_id}">
                    ${
                        Boolean(id) ? 
                        `
                            <span class="badge badge-success px-3 py-1 my-2">
                                <i class="fas fa-check-circle"></i>
                                <span class="mx-2">تم رفع الملف بنجاح</span>
                            </span>
                        `
                        :
                        `
                            <div class="progress mt-2" id="mediaProgress${row_id}">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
                            </div>
                        `
                    }
                </td>
                <td>
                    ${
                        Boolean(id) ? 
                        `
                            <button class="btn btn-sm btn-danger del-media" data-target="${row_id}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            
                            <a href="{{url('/')}}/${file}" target="_blank" class="btn btn-sm btn-primary">
                                <i class="fas fa-link"></i>
                            </a>
                        `
                        :
                        `
                            <button disabled="disabled" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        `
                    }
                </td>
            </tr>
            `;

            $('#edit-mediaTable').append(row);

            return row_id;
        }

        function updateMediaList (media_id) {
            window.list_media.push(media_id);
            $(`#edit-mediaFiles`).val(JSON.stringify(window.list_media));
        }

        function validateMediaFile () {
            
            let is_valied = true;
            $('.err-file-msg').slideUp(500);

            if ($('#edit-mediaTitle').val() == '') {
                $('#edit-mediaTitleErr').text('يجب ادخال اسم الملف').slideDown(500)
                is_valied = false
            }
            
            if ($('#edit-mediaFile').prop('files').length == 0) {
                $('#edit-mediaFileErr').text('يرجي تحديد الملف').slideDown(500);
                is_valied = false
            } else if ($('#edit-mediaFile').prop('files')[0].size > 100000000) {
                $('#edit-mediaFileErr').text('حجم الملف يجب ان لا يزيد عن 12 مجيا').slideDown(500);
                is_valied = false
            }

            return is_valied;
        }

        $('#edit-uploadMediaFile').click(function (e) {
            e.preventDefault();

            /**
             * 1- get the file
             * 2- upload a file
             * 3- after upload finish get the file id from response
             * 4- add the file upload to the uploaded files media list
             */
            

            if (validateMediaFile()) {
                let fDataObj = new FormData();
                
                fDataObj.append('_upload_media', true);
                fDataObj.append('_token', "{{ csrf_token() }}");
                fDataObj.append('title', $('#edit-mediaTitle').val());
                fDataObj.append('media_file', $('#edit-mediaFile').prop('files')[0])

                let dumy_id = renderFileRow(fDataObj.get('title'));
                
                const config = {
                    onUploadProgress: progressEvent => {
                        let progress = Math.round((progressEvent.loaded / progressEvent.total) * 100);
                        $(`#mediaProgress${dumy_id}`).html(`
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="${progress}" aria-valuemin="0" aria-valuemax="100" style="width: ${progress}%">${progress}%</div>
                        `);
                    }
                }

                axios.post(`{{ route('admin.training_actions.store') }}`, fDataObj, config)
                .then(res => {
                    let { data, success } = res.data;

                    if (success) {
                        $(`#mediaRow${dumy_id}`).remove();
                        updateMediaList(data.id);
                        renderFileRow(data.title, data.id, data.file);
                            
                        // clear old session
                        $('#edit-mediaTitle').val('');
                        $('#edit-mediaFile').val('');
                    }
                })
                .finally(() => {
                })
                .catch(err => {
                    $(`#uploadProgress${dumy_id}`).html(`
                        <span class="badge badge-danger px-3 py-1 my-2">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span class="mx-2">حدث خطاء ما !</span>
                        </span>
                    `);
                });
            }
        });

        $('#edit-mediaTable').on('click', '.del-media', function () {
            let target_id = $(this).data('target');
            list_media = list_media.filter(media_id => media_id != target_id);
            $(`#edit-mediaFiles`).val(JSON.stringify(list_media));
            $(`#mediaRow${target_id}`).remove();
        });

        $('#edit-family_id').change(function () {
            // get family id
            // request the familly data
            // show the and family code project data, 
            let target_id = $(this).val();

            if (Boolean(target_id)) {
                $('#loddingSpinner').show(500);
                
                axios.get(`{{ url("admin/families") }}/${target_id}`)
                .then(res => {
                    let { data, success } = res.data;
                    
                    if (success) {
                        $('#edit-project_id').val(data.project.id);
                        $('#edit-family_code').val(data.family_code);
                        $('#edit-project_name').val(data.project.name);
                    } else {
                        throw 'error';
                    }// end :: if
                })
                .finally(() => {
                    $('#loddingSpinner').hide(500);
                })
                .catch(err => {
                    // show error message ...
                });
            } else {
                $('#edit-project_id').val('');
                $('#edit-family_code').val('');
                $('#edit-project_name').val('');
            }
        });
    }

    mediaHandler (base_url = `{{ route('admin.project_actions.store') }}`);
});
</script>
@endpush
