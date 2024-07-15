
<div style="display: none" id="pricingPlansForm" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('track_grades.Manage Pricing Plans')</h5>
        </div>
        <div class="col-6 text-end">
            <div id="close-plans-form" class="!toggle-btn btn btn-outline-dark btn-sm" data-current-card="#pricingPlansForm" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div><!-- /.row -->
    <hr/>

    <form action="/" id="objectForm">
        
        <div class="my-3 row">
            <label for="plan-plan_type" class="col-sm-2 col-form-label">@lang('track_grades.Type') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10" style="direction: rtl">
                <select class="form-control" id="plan-plan_type">
                    <option value="">-- select plan --</option>
                    <option value="1">@lang('track_grades.Plan_1')</option>
                    <option value="2">@lang('track_grades.Plan_2')</option>
                    <option value="3">@lang('track_grades.Plan_3')</option>
                </select>
                <div style="padding: 5px 7px; display: none" id="plan-plan_typeErr" class="err-msg mt-2 alert alert-danger custome-ar-field">
                </div>
            </div><!-- /.col-sm-10 -->
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="plan-ar_title" class="col-sm-2 col-form-label">@lang('track_grades.Title') <span class="text-danger float-right">*</span></label>
            
            <div class="col-5" style="direction: rtl">
                <input type="text" class="form-control custome-ar-field" id="plan-ar_title" placeholder="العنوان بالعربية">
                <div style="padding: 5px 7px; display: none" id="plan-ar_titleErr" class="err-msg mt-2 alert alert-danger custome-ar-field">
                </div>
            </div><!-- /.col-5 -->
            <div class="col-5" style="direction: rtl">
                <input type="text" class="form-control custome-en-field" id="plan-en_title" placeholder="Title in english">
                <div style="padding: 5px 7px; display: none" id="plan-en_titleErr" class="err-msg mt-2 alert alert-danger custome-en-field">
                </div>
            </div><!-- /.col-5 -->
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="plan-ar_description" class="col-sm-2 col-form-label">@lang('track_grades.Description') <span class="text-danger float-right">*</span></label>
            <div class="col-5" style="direction: rtl">
                <textarea class="form-control custome-ar-field" id="plan-ar_description" placeholder="العنوان بالعربية"></textarea>
                <div style="padding: 5px 7px; display: none" id="plan-ar_descriptionErr" class="err-msg mt-2 alert alert-danger custome-ar-field">
                </div>
            </div><!-- /.col-5 -->

            <div class="col-5" style="direction: rtl">
                <textarea class="form-control custome-en-field" id="plan-en_description" placeholder="Title in english"></textarea>
                <div style="padding: 5px 7px; display: none" id="plan-en_descriptionErr" class="err-msg mt-2 alert alert-danger custome-en-field">
                </div>
            </div><!-- /.col-5 -->
        </div><!-- /.my-3 -->

        
        <div class="my-3 row">
            <label for="plan-price" class="col-sm-2 col-form-label">@lang('track_grades.Price') <span class="text-danger float-right">*</span></label>
            <div class="col-10" style="direction: rtl">
                <input type="number" class="form-control custome-ar-field" id="plan-price" placeholder="">
                <div style="padding: 5px 7px; display: none" id="plan-priceErr" class="err-msg mt-2 alert alert-danger custome-ar-field">
                </div>
            </div><!-- /.col-5 -->
        </div><!-- /.my-3 -->

        <button class="add-plan-plan btn btn-primary float-end mb-3">@lang('track_grades.Add Pricing Plans')</button>

        <div class="clearfix"></div>

        <div class="my-3" style="height: 300px; overflow-y:scroll">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Plan Type</th>
                        <th>Title</th>
                        <th>Ar Description</th>
                        <th>En Description</th>
                        <th>Price</th>
                        <th>Sale</th>
                    </tr>
                </thead>
                <tbody id="pricingPlansBody"></tbody>
            </table>
        </div><!-- /.my-3 -->
    </form>
</div>

@push('custome-js')
<script>
$(document).ready(function () {
    const Store = (() => {
        const meta = {
            grade_id      : null,
            pricing_plans : {},
        };

        const helpers = {
            setPricingPlans : (grade) => {
                grade.pricing_plans.forEach(plan => {
                    meta.pricing_plans[plan.plan_type] = {...plan};
                });
            }
        };

        const setters = {
            setGradeId : (grade_id) => {
                meta.grade_id = grade_id;
            },

            fetchGrade : async (grade_id) => {
                $('#loddingSpinner').show(500);

                const res = await axios.get(`{{ route('admin.trackGrades.index') }}/${grade_id}`);

                $('#loddingSpinner').hide(500);

                let { data, success } = res.data;
                
                if (success) {
                    meta.grade_id = data.id;
                     
                    helpers.setPricingPlans(data);
                }

                return Boolean(data.pricing_plans) 
                    ? data.pricing_plans
                    : {};
            },

            storePlan : async (plan_data) => {
                $('#loddingSpinner').show(500);

                let res = await axios.post(`{{ route('admin.trackGrades.index') }}/${meta.grade_id}`, {
                    _token  : '{{ csrf_token() }}',
                    _method : 'PUT',
                    update_price_plan : true,
                    ...plan_data
                });
                
                $('#loddingSpinner').hide(500);

                let { data, success } = res.data;

                if (success) {
                    helpers.setPricingPlans(data);
                }
            }
        };

        const getters = {
            getPlan : (plan_type) => {
                return Boolean(meta.pricing_plans[plan_type]) ? {...meta.pricing_plans[plan_type]} : null;
            },

            getPlans : () => {
                return {...meta.pricing_plans};
            },
        };
    
        return {
            setters,
            getters,
        }
    })();

    const View = (() => {
        let fields_el = [
            'ar_title', 'en_title', 
            'ar_description', 'en_description', 
            'price'
        ];

        let plan_list_body = '#pricingPlansBody';

        const toggleForm = (open = true) => {
            if (open) {
                $('#objectsCard').slideUp(500);
                $('#pricingPlansForm').slideDown(500);
            } else {
                $('#objectsCard').slideDown(500);
                $('#pricingPlansForm').slideUp(500);
            }
        };

        const getFormData = () => {
            let data      = [];
            let is_valied = true;

            fields_el.forEach(field => {
                let val = $(`#plan-${field}`).val();
                
                if (!Boolean(val)) {
                    is_valied = false
                    $(`#plan-${field}`).css('border', '1px solid red');
                } else {
                    data[field] = val;
                    $(`#plan-${field}`).css('border', '');
                }
            });

            return is_valied ? data : is_valied;
        }

        const renderPlanList = (plansObj) => {
            let plan_list  = ``;
            let plans_keys = Object.keys(plansObj).sort();
            
            plans_keys.forEach(key => {
                plan_list += `
                    <tr>
                        <td>${
                            plansObj[key].plan_type == 1 
                            ? "@lang('track_grades.Plan_1')"
                            : (
                                plansObj[key].plan_type == 2 
                                ? "@lang('track_grades.Plan_2')"
                                : "@lang('track_grades.Plan_3')"
                            )
                            
                        }</td>
                        <td>
                            <span class="badge bg-primary mx-1">${plansObj[key].ar_title}</span>
                            <span class="badge bg-primary mx-1">${plansObj[key].en_title}</span>
                        </td>
                        <td>${plansObj[key].ar_description}</td>
                        <td>${plansObj[key].en_description}</td>
                        <td>${plansObj[key].price}</td>
                        <td>${'---'}</td>
                    </tr>
                `;
            });
            
            $(plan_list_body).html(plan_list);
        }

        const renderFormData = (data = null) => {
            fields_el.forEach(key => {
                $(`#plan-${key}`).val(Boolean(data) ? data[key] : '');
            });
        }

        return {
            toggleForm,
            getFormData,
            renderPlanList,
            renderFormData
        }
    })();

    (() => {
        
        const { setters, getters } = Store;

        $('#dataTable').on('click', '.pricing-plans', async function () {
            let grade_id = $(this).data('target');

            await setters.fetchGrade(grade_id);
            
            View.toggleForm();

            View.renderPlanList(getters.getPlans());
        });

        $('.add-plan-plan').on('click', async function (e) {
            e.preventDefault();

            let data = View.getFormData();

            if (Boolean(data)) {
                $(this).attr('disabled', 'disabled');

                await setters.storePlan(data);

                View.renderPlanList(getters.getPlans());

                $(this).removeAttr('disabled');
            }

        });

        $('#plan-plan_type').on('change', function (e) {
            let plan_type = $(this).val();

            let data = getters.getPlan(plan_type);

            View.renderFormData(Boolean(data) ? data : null);
        })

        $('#close-plans-form').on('click', function (e) {
            let flag = confirm('@lang("track_grades.confim_cancle_session")');

            if (flag) {
                View.renderFormData(null);
                View.toggleForm(false);
            }
        });
    })();
});
</script>
@endpush