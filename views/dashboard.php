<section class="container w-100 d-flex flex-column">
    <input type="hidden" id="g-token" />

    <div class="position-fixed bottom-0 end-0 p-1 pb-5" style="max-width: 20vh; max-height: 50vh;" id="toast-container">

    </div>

    <div class="accordion mt-5">
        <div class="accordion-item h-50">
            <h2 class="accordion-header">
                <button class="d-block accordion-button collapsed text-center" type="button" data-bs-toggle="collapse" data-bs-target="#pending-requests">
                    الاعدادات الحاليه
                </button>
            </h2>
            <div id="pending-requests" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    <div class="row overflow-auto" style="max-height: 30vh">
                        <table class="table table-sm text-center table-striped table-hover overflow-auto">
                            <thead class="sticky-top bg-light">
                                <tr>
                                    <th>العمليات المتاحه</th>
                                    <th> القناه </th>
                                    <th> بوت التيليجرام</th>
                                    <th> الاعاقات </th>
                                    <th> المحافظه </th>
                                    <th> اسم الاعداد </th>
                                </tr>
                            </thead>
                            <tbody id='bot-settings-table-body'>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="d-block accordion-button text-center w-100" type="button" data-bs-toggle="collapse" data-bs-target="#current-users">
                    اضافه اعداد جديد
                </button>
            </h2>
            <div id="current-users" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    <div class="accordion-body" id="saveSettingContainer">
                        <div class="row overflow-auto" style="max-height: 40vh">
                            <form id="settings-form" action="javascript:void(0)" onsubmit="saveSetting();">
                                <div class="input-group mb-3">
                                    <input name="name" id="name" type="text" class="form-control" placeholder="اسم الاعداد" aria-label="settings name" required>
                                    <span class="input-group-text">اسم الاعداد</span>
                                </div>
                                <div class="input-group mb-3">
                                    <input name="bot" id="bot" type="text" class="form-control" placeholder="البوت" aria-label="bot" required>
                                    <span class="input-group-text">البوت</span>
                                </div>
                                <div class="input-group mb-3">
                                    <input name="channel" id="channel" type="text" class="form-control" placeholder="القناه" aria-label="channel" required>
                                    <span class="input-group-text">القناه</span>
                                </div>
                                <div class="input-group mb-3">
                                    <select id="countries" name="country" class="form-select" style="direction: rtl" aria-label="countries">
                                        <option value="0" selected>كل المحافظات</option>
                                    </select>
                                    <span class="input-group-text">المحافظه</span>
                                </div>
                                <div id="obstructionsContainer" class="input-group-text mb-3 d-flex flex-column align-items-center" aria-label="obstructions">
                                    <div class="row w-100"> <span class="input-group-text border-none mb-2">الاعاقات المتاحه</span> </div>
                                    <div id="obstructions" class="d-flex justify-content-end flex-wrap float-end w-100"></div>
                                </div>
                                <div class="input-group d-flex justify-content-center mb-2">
                                    <input id="submit" type="submit" class="btn btn-primary" value="حفظ" name="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="/assets/js/main-layout/admin/control.js"></script>