<?php

use App\Http\Controllers\AboutUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;

/*INSTALLATION*/
if (!file_exists(storage_path('installed.lock'))) {
    Route::middleware([])->group(function () {
        Route::get('/check_purchase_code', [InstallController::class, 'checkPurchaseCode'])->name('check.purchase.code');
        Route::post("/save_purchase_code", [InstallController::class, 'savePurchaseCode'])->name('installer.save.purchase.code');
        Route::get('/install', [InstallController::class, 'index'])->name('installer.index');
        Route::get('/install/system-check', [InstallController::class, 'systemCheck'])->name('installer.system_check');
        Route::get('/install/database', [InstallController::class, 'databaseForm'])->name('installer.database_form');
        Route::post('/install/database', [InstallController::class, 'saveDatabase'])->name('installer.save_database');
        Route::get('/install/success', [InstallController::class, 'success'])->name('installer.success');
    });
}

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Telecaler\FeedbackController;
use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\Employee\AdvanceSalaryController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\ShopFooterController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\CartSettingController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\TodoController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\TargetController;
use App\Http\Controllers\Admin\SopController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CredentialsController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\WhatsappController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ServiceController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutUsController::class, 'index'])->name('about');
Route::get('/service', [ServiceController::class, 'index'])->name('service');
Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::post('/contact_us_home', [HomeController::class, 'contactUs'])->name('contact.send');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get("/shop", [EcommerceController::class, 'eCommerce'])->name("e.commerce");
Route::get("/add_to_cart/{id}", [EcommerceController::class, 'addToCart'])->name("add.to.cart");
Route::get("/view_cart", [EcommerceController::class, 'viewCart'])->name("view.cart");
Route::get("/remove_cart_item/{id}", [EcommerceController::class, 'removeCartItem'])->name("remove.cart.item");
Route::post("/check_stock", [EcommerceController::class, 'checkStock'])->name("check.stock");
Route::post('/apply_coupon', [EcommerceController::class, 'applyCoupon'])->name('apply.coupon');
Route::post('/proceed_to_pay', [EcommerceController::class, 'proceedToPay'])->name('proceed.to.pay');

/*RAZORPAY*/
Route::get('/razorpay/{order_id}/{total_price}/{final_price}/{coupon_id?}', [RazorpayPaymentController::class, 'index'])->name('razorpay.index');
Route::post('/razorpay-payment', [RazorpayPaymentController::class, 'payment'])->name('razorpay.payment');
Route::post('/razorpay_data', [RazorpayPaymentController::class, 'razorpayDetails'])->name('razorpay.index');

Route::middleware("auth")->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'view'])->name("dashboard");

    /* DEPARTMENT */
    Route::get('/view_department', [DepartmentController::class, 'viewDepartment'])->name('view.department');
    Route::get('/add_department', [DepartmentController::class, 'addDepartment'])->name('add.department');
    Route::get('/edit_department/{id}', [DepartmentController::class, 'editDepartment'])->name('edit.department');
    Route::get('/delete_department/{id}', [DepartmentController::class, 'deleteDepartment'])->name('delete.department');
    Route::post('/save_department', [DepartmentController::class, 'saveDepartment'])->name('save.department');
    Route::get('/view_pages/{id}', [DepartmentController::class, 'viewPages'])->name('view.pages');
    Route::post("/save_page_access", [DepartmentController::class, 'savePageAccess'])->name('save.page.access');

    /* BRANCH */
    Route::get('/view_branch', [BranchController::class, 'viewBranch'])->name('view.branch');
    Route::get('/add_branch', [BranchController::class, 'addBranch'])->name('add.branch');
    Route::get('/edit_branch/{id}', [BranchController::class, 'editBranch'])->name('edit.branch');
    Route::get('/delete_branch/{id}', [BranchController::class, 'deleteBranch'])->name('delete.branch');
    Route::post('/save_branch', [BranchController::class, 'saveBranch'])->name('save.branch');

    /* EMPLOYEE */
    Route::get('/view_employee', [EmployeeController::class, 'viewEmp'])->name('view.emp');
    Route::get('/add_employee', [EmployeeController::class, 'addEmp'])->name('add.emp');
    Route::get('/edit_employee/{id}', [EmployeeController::class, 'editEmp'])->name('edit.emp');
    Route::get('/delete_employee/{id}', [EmployeeController::class, 'deleteEmp'])->name('delete.emp');
    Route::post('/save_employee', [EmployeeController::class, 'saveEmp'])->name('save.emp');

    /* ICARD */
    Route::get('/view_emp_icard/{id}', [EmployeeController::class, 'viewEmpIcard'])->name('view.emp.icard');
    Route::get('/emp_icard_pdf/{id}', [EmployeeController::class, 'downloadIcard'])->name('download.emp.icard');

    /* JOINNING LETTER */
    Route::get('/emp_joinning_letter/{id}', [EmployeeController::class, 'viewJoinningLetter'])->name('view.emp.joinning.letter');
    Route::get('/emp_joinning_letter_pdf/{id}', [EmployeeController::class, 'downloadJoinningLetter'])->name('download.emp.joinning.letter');

    /* OFFER LETTER */
    Route::get('/emp_offer_letter/{id}', [EmployeeController::class, 'viewOfferLetter'])->name('view.emp.offer.letter');
    Route::get('/emp_offer_letter_pdf/{id}', [EmployeeController::class, 'downloadOfferLetter'])->name('download.emp.offer.letter');

    /*ATTENDANCE */
    Route::get('/show_attendance', [AttendanceController::class, 'showAttendance'])->name('view.attendance');
    Route::get('/add_attendance', [AttendanceController::class, 'addAttendance'])->name('add.attendance');
    Route::post('/attendance/checkin', [AttendanceController::class, 'markCheckIn'])->name('attendance.checkin');
    Route::post('/attendance/checkout', [AttendanceController::class, 'markCheckOut'])->name('attendance.checkout');

    /*TELECALER FEEDBACK */
    Route::get('/view_t_feedback', [FeedbackController::class, 'viewTFeedback'])->name('view.t_feedback');
    Route::get('/add_t_feedback', [FeedbackController::class, 'addTFeedback'])->name('add.t_feedback');
    Route::get('/edit_t_feedback/{id}', [FeedbackController::class, 'editTFeedback'])->name('edit.t_feedback');
    Route::get('/delete_t_feedback/{id}', [FeedbackController::class, 'deleteTFeedback'])->name('delete.t_feedback');
    Route::post('/save_t_feedback', [FeedbackController::class, 'saveTFeedback'])->name('save.t_feedback');

    /*LOAN*/
    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');
    Route::get('/edit_loan/{id}', [LoanController::class, 'editLoan'])->name('edit.loan');
    Route::get('/delete_loan/{id}', [LoanController::class, 'deleteLoan'])->name('delete.loan');

    /*ADVANCE SALARY*/
    Route::get('/advances', [AdvanceSalaryController::class, 'index'])->name('advances.index');
    Route::get('/advances/create', [AdvanceSalaryController::class, 'create'])->name('advances.create');
    Route::post('/advances', [AdvanceSalaryController::class, 'store'])->name('advances.store');
    Route::get('/advances/{id}/approve', [AdvanceSalaryController::class, 'approve'])->name('advances.approve');
    Route::get('/advances/{id}/reject', [AdvanceSalaryController::class, 'reject'])->name('advances.reject');

    /* CATEGORY */
    Route::get('/category', [CategoryController::class, 'viewCategory'])->name('view.category');
    Route::get('/category/add', [CategoryController::class, 'addCategory'])->name('add.category');
    Route::get('/category/edit/{id}', [CategoryController::class, 'editCategory'])->name('edit.category');
    Route::get('/category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('delete.category');
    Route::post('/save_category', [CategoryController::class, 'saveCategory'])->name('save.category');

    /* PRODUCT */
    Route::get('/product', [ProductController::class, 'viewProduct'])->name('view.product');
    Route::get('/product/add', [ProductController::class, 'addProduct'])->name('add.product');
    Route::get('/product/edit/{id}', [ProductController::class, 'editProduct'])->name('edit.product');
    Route::get('/product/delete/{id}', [ProductController::class, 'deleteProduct'])->name('delete.product');
    Route::post('/save_product', [ProductController::class, 'saveProduct'])->name('save.product');

    /* FOOTER DETAILS*/
    Route::get('/shop_footer_details', [ShopFooterController::class, 'viewShopFooterDetails'])->name('view.footer.details');
    Route::get('/shop_footer_details/add', [ShopFooterController::class, 'addShopFooterDetails'])->name('add.footer.details');
    Route::get('/shop_footer_details/edit/{id}', [ShopFooterController::class, 'editShopFooterDetails'])->name('edit.footer.details');
    Route::get('/shop_footer_details/delete/{id}', [ShopFooterController::class, 'deleteShopFooterDetails'])->name('delete.footer.details');
    Route::post('/save_shop_footer_details', [ShopFooterController::class, 'saveShopFooterDetails'])->name('save.footer.details');

    /*DISCOUNT*/
    Route::get('/discount', [DiscountController::class, 'viewdiscount'])->name('view.discount');
    Route::get('/discount/add', [DiscountController::class, 'addDiscount'])->name('add.discount');
    Route::get('/discount/edit/{id}', [DiscountController::class, 'editDiscount'])->name('edit.discount');
    Route::get('/discount/delete/{id}', [DiscountController::class, 'deleteDiscount'])->name('delete.discount');
    Route::post('/save_discount', [DiscountController::class, 'saveDiscount'])->name('save.discount');

    /*CART SETTING*/
    Route::get('/cart_setting', [CartSettingController::class, 'addCartSetting'])->name('add.cart.setting');
    Route::post('/save_cart_setting', [CartSettingController::class, 'saveCartSetting'])->name('save.cart.setting');

    /*PROFILE*/
    Route::get('/add_profile', [ProfileController::class, 'viewProfile'])->name('add.profile');
    Route::post('/save_profile', [ProfileController::class, 'saveProfile'])->name('save.profile');

    /*SALARY*/
    Route::get('/salary', [SalaryController::class, 'viewSalary'])->name('view.salary');
    Route::get('/salary/add', [SalaryController::class, 'addSalary'])->name('add.salary');
    Route::get('/salary/edit/{id}', [SalaryController::class, 'editSalary'])->name('edit.salary');
    Route::get('/salary/delete/{id}', [SalaryController::class, 'deleteSalary'])->name('delete.salary');
    Route::post('/save_salary', [SalaryController::class, 'saveSalary'])->name('save.salary');

    /*LEADS*/
    Route::get('/leads', [LeadController::class, 'index'])->name('leads.index');
    Route::get('/leads/create', [LeadController::class, 'create'])->name('add.leads');
    Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');
    Route::get('/leads/{lead}/edit', [LeadController::class, 'edit'])->name('leads.edit');
    Route::post('/leads/{lead}', [LeadController::class, 'update'])->name('leads.update');

    /*TASK MANAGEMENT*/
    Route::resource('tasks', TaskController::class);
    Route::get('/notifications/count', [NotificationController::class, 'count'])->name('notifications.count');
    Route::get('/notifications/mark-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.read');


    /*TODO CONTROLLER */
    Route::resource('todos', TodoController::class);

    /*HOME CONTACT US*/
    Route::get('/contact_us', [ContactUsController::class, 'viewContactUs'])->name('contact.us.index');
    // Route::get('/contact_us/create', [ContactUsController::class, 'addContactUs'])->name('add.contact.us');
    Route::post('/contact_us', [ContactUsController::class, 'store'])->name('contact.us.store');
    // Route::get('/contact_us/{contact}/edit', [ContactUsController::class, 'edit'])->name('contact.us.edit');
    // Route::post('/contact_us/{contact}', [ContactUsController::class, 'update'])->name('contact.us.update');

    /*LEAVES*/
    Route::get('/leaves', [LeaveController::class, 'viewLeaves'])->name('view.leaves');
    Route::get('/leaves/add', [LeaveController::class, 'addLeave'])->name('add.leaves');
    Route::get('/leaves/edit/{id}', [LeaveController::class, 'editLeave'])->name('edit.leaves');
    Route::get('/leaves/delete/{id}', [LeaveController::class, 'deleteLeave'])->name('delete.leaves');
    Route::post('/save_leaves', [LeaveController::class, 'saveLeave'])->name('save.leaves');

    /*HOLIDAY*/
    Route::get('/holidays', [HolidayController::class, 'viewHolidays'])->name('view.holidays');
    Route::get('/holidays/add', [HolidayController::class, 'addHoliday'])->name('add.holidays');
    Route::post('/save_holidays', [HolidayController::class, 'saveHoliday'])->name('save.holidays');
    Route::get('/holidays/edit/{id}', [HolidayController::class, 'editHoliday'])->name('edit.holidays');
    Route::get('/holidays/delete/{id}', [HolidayController::class, 'deleteHoliday'])->name('delete.holidays');

    /*TARGET*/
    Route::get('/target', [TargetController::class, 'viewTarget'])->name('view.target');
    Route::get('/target/add', [TargetController::class, 'addTarget'])->name('add.target');
    Route::get('/target/edit/{id}', [TargetController::class, 'editTarget'])->name('edit.target');
    Route::get('/target/delete/{id}', [TargetController::class, 'deleteTarget'])->name('delete.target');
    Route::post('/save_target', [TargetController::class, 'saveTarget'])->name('save.target');

    /*SOP*/
    Route::get('/sop', [SopController::class, 'viewSop'])->name('view.sop');
    Route::get('/sop/add', [SopController::class, 'addSop'])->name('add.sop');
    Route::get('/sop/edit/{id}', [SopController::class, 'editSop'])->name('edit.sop');
    Route::get('/sop/delete/{id}', [SopController::class, 'deleteSop'])->name('delete.sop');
    Route::post('/save_sop', [SopController::class, 'saveSop'])->name('save.sop');

    /*CAMPAIGN*/
    Route::get('/campaign', [CampaignController::class, 'viewCampaign'])->name('view.campaign');
    Route::get('/campaign/add', [CampaignController::class, 'addCampaign'])->name('add.campaign');
    Route::get('/campaign/edit/{id}', [CampaignController::class, 'editCampaign'])->name('edit.campaign');
    Route::get('/campaign/delete/{id}', [CampaignController::class, 'deleteCampaign'])->name('delete.campaign');
    Route::post('/save_Campaign', [CampaignController::class, 'saveCampaign'])->name('save.campaign');

    /*MATERIALS*/
    Route::get('/material', [MaterialController::class, 'viewMaterial'])->name('view.material');
    Route::get('/material/add', [MaterialController::class, 'addMaterial'])->name('add.material');
    Route::get('/material/edit/{id}', [MaterialController::class, 'editMaterial'])->name('edit.material');
    Route::get('/material/delete/{id}', [MaterialController::class, 'deleteMaterial'])->name('delete.material');
    Route::post('/save_Material', [MaterialController::class, 'saveMaterial'])->name('save.material');

    /*ORDER HISTORY*/
    Route::get('/order_details', [OrderController::class, 'viewOrderDetails'])->name('view.order_details');
    Route::get('/order_details/add', [OrderController::class, 'addMaterial'])->name('add.order_details');
    Route::get('/order_details/edit/{id}', [OrderController::class, 'editMaterial'])->name('edit.order_details');
    Route::get('/order_details/delete/{unique_id}', [OrderController::class, 'deleteOrderDetails'])->name('delete.order_details');
    // Route::post('/save_Material', [OrderController::class, 'saveMaterial'])->name('save.order_details');

    /*CUSTOMERS*/
    Route::get('/users', [UserController::class, 'viewUserDetails'])->name('view.user.details');
    Route::get('/users/add', [UserController::class, 'addUserDetails'])->name('add.user.details');
    Route::get('/users/edit/{id}', [UserController::class, 'editUserDetails'])->name('edit.user.details');
    Route::get('/users/delete/{id}', [UserController::class, 'deleteOrderDetails'])->name('delete.user.details');
    Route::post('/save_User', [UserController::class, 'saveUserDetails'])->name('save.user.details');

    /*MEETINGS*/
    Route::get('/meeting', [MeetingController::class, 'viewMeeting'])->name('view.meeting');
    Route::get('/meeting/add', [MeetingController::class, 'addMeeting'])->name('add.meeting');
    Route::get('/meeting/edit/{id}', [MeetingController::class, 'editMeeting'])->name('edit.meeting');
    Route::get('/meeting/delete/{id}', [MeetingController::class, 'deleteMeeting'])->name('delete.meeting');
    Route::post('/save_Meeting', [MeetingController::class, 'saveMeeting'])->name('save.meeting');

    /*TEMPLATE*/
    Route::get('/template', [TemplateController::class, 'viewTemplate'])->name('view.template');
    Route::get('/template/add', [TemplateController::class, 'addTemplate'])->name('add.template');
    Route::get('/template/edit/{id}', [TemplateController::class, 'editTemplate'])->name('edit.template');
    Route::get('/template/delete/{id}', [TemplateController::class, 'deleteTemplate'])->name('delete.template');
    Route::post('/save_Template', [TemplateController::class, 'saveTemplate'])->name('save.template');

    /*Whats App*/
    Route::get('/whats_app', [SettingController::class, 'viewWhatsApp'])->name('view.whats_app');
    Route::get('/whats_app/add', [SettingController::class, 'addWhatsApp'])->name('add.whats.app');
    Route::get('/whats_app/edit/{id}', [SettingController::class, 'editWhatsApp'])->name('edit.whats.app');
    Route::get('/whats_app/delete/{id}', [SettingController::class, 'deleteWhatsApp'])->name('delete.whats.app');
    Route::post('/save_whats_app', [SettingController::class, 'saveWhatsApp'])->name('save.whats.app');

    /*WHATS APP FLOW*/
    Route::get('/whats_app_flow', [SettingController::class, 'viewWhatsAppFlow'])->name('view.whats_app.flow');
    Route::get('/whats_app_flow/add', [SettingController::class, 'addWhatsAppFlow'])->name('add.whats_app.flow');
    Route::get('/whats_app_flow/edit/{id}', [SettingController::class, 'editWhatsAppFlow'])->name('edit.whats_app.flow');
    Route::get('/whats_app_flow/delete/{id}', [SettingController::class, 'deleteWhatsAppFlow'])->name('delete.whats_app.flow');
    Route::post('/save_whats_app_flow', [SettingController::class, 'saveWhatsAppFlow'])->name('save.whats_app.flow');

    /*WHATSAPP MESSAGES*/
    //FOR CHAT
    Route::get('/whats_app_chat', [WhatsappController::class, 'viewWhatsAppChat'])->name('view.whats_app.chat');
    Route::get('/whats_app_chat/add', [WhatsappController::class, 'addWhatsAppChat'])->name('add.whats_app.chat');
    Route::post('/save_whats_app_chat', [WhatsappController::class, 'saveWhatsAppChat'])->name('save.whats_app.chat');   

    //FOR IMAGE
    Route::get('/whats_app_image', [WhatsappController::class, 'viewWhatsAppImage'])->name('view.whats_app.image');
    Route::get('/whats_app_image/add', [WhatsappController::class, 'addWhatsAppImage'])->name('add.whats_app.image');
    Route::post('/save_whats_app_image', [WhatsappController::class, 'saveWhatsAppImage'])->name('save.whats_app.image');

    //FOR STICKER
    Route::get('/whats_app_sticker', [WhatsappController::class, 'viewWhatsAppSticker'])->name('view.whats_app.sticker');
    Route::get('/whats_app_sticker/add', [WhatsappController::class, 'addWhatsAppSticker'])->name('add.whats_app.sticker');
    Route::post('/save_whats_app_sticker', [WhatsappController::class, 'saveWhatsAppSticker'])->name('save.whats_app.sticker');

    //FOR DOCUMENT
    Route::get('/whats_app_document', [WhatsappController::class, 'viewWhatsAppDocument'])->name('view.whats_app.document');
    Route::get('/whats_app_document/add', [WhatsappController::class, 'addWhatsAppDocument'])->name('add.whats_app.document');
    Route::post('/save_whats_app_document', [WhatsappController::class, 'saveWhatsAppDocument'])->name('save.whats_app.document');

    //FOR AUDIO
    Route::get('/whats_app_audio', [WhatsappController::class, 'viewWhatsAppAudio'])->name('view.whats_app.audio');
    Route::get('/whats_app_audio/add', [WhatsappController::class, 'addWhatsAppAudio'])->name('add.whats_app.audio');
    Route::post('/save_whats_app_audio', [WhatsappController::class, 'saveWhatsAppAudio'])->name('save.whats_app.audio');

    //FOR VIDEO
    Route::get('/whats_app_video', [WhatsappController::class, 'viewWhatsAppVideo'])->name('view.whats_app.video');
    Route::get('/whats_app_video/add', [WhatsappController::class, 'addWhatsAppVideo'])->name('add.whats_app.video');
    Route::post('/save_whats_app_video', [WhatsappController::class, 'saveWhatsAppVideo'])->name('save.whats_app.video');

    //FOR CONTACT
    Route::get('/whats_app_contact', [WhatsappController::class, 'viewWhatsAppContact'])->name('view.whats_app.contact');
    Route::get('/whats_app_contact/add', [WhatsappController::class, 'addWhatsAppContact'])->name('add.whats_app.contact');
    Route::post('/save_whats_app_contact', [WhatsappController::class, 'saveWhatsAppContact'])->name('save.whats_app.contact');

    //FOR LOCATION
    Route::get('/whats_app_location', [WhatsappController::class, 'viewWhatsAppLocation'])->name('view.whats_app.location');
    Route::get('/whats_app_location/add', [WhatsappController::class, 'addWhatsAppLocation'])->name('add.whats_app.location');
    Route::post('/save_whats_app_location', [WhatsappController::class, 'saveWhatsAppLocation'])->name('save.whats_app.location');

    //FOR VCARD
    Route::get('/whats_app_vcard', [WhatsappController::class, 'viewWhatsAppVcard'])->name('view.whats_app.vcard');
    Route::get('/whats_app_vcard/add', [WhatsappController::class, 'addWhatsAppVcard'])->name('add.whats_app.vcard');
    Route::post('/save_whats_app_vcard', [WhatsappController::class, 'saveWhatsAppVcard'])->name('save.whats_app.vcard');

    //FOR REACTION
    Route::get('/whats_app_reaction', [WhatsappController::class, 'viewWhatsAppReaction'])->name('view.whats_app.reaction');
    Route::get('/whats_app_reaction/add', [WhatsappController::class, 'addWhatsAppReaction'])->name('add.whats_app.reaction');
    Route::post('/save_whats_app_reaction', [WhatsappController::class, 'saveWhatsAppReaction'])->name('save.whats_app.reaction');

    //FOR RESEND BY STATUS
    Route::get('/whats_app_resend', [WhatsappController::class, 'viewWhatsAppResend'])->name('view.whats_app.resend');
    Route::get('/whats_app_resend/add', [WhatsappController::class, 'addWhatsAppResend'])->name('add.whats_app.resend');
    Route::post('/save_whats_app_resend', [WhatsappController::class, 'saveWhatsAppResend'])->name('save.whats_app.resend');

    //QRCODE
    Route::get('/whats_app_qrcode', [WhatsappController::class, 'viewWhatsAppQrcode'])->name('view.whats_app.qrcode');

    /*THEME*/
    Route::get('/adding_theme', [ThemeController::class, 'addingTheme'])->name("add.theme");
    Route::get('/edit_theme/edit/{id}', [ThemeController::class, 'addingTheme'])->name("edit.theme");
    Route::get('/delete_theme/{id}', [ThemeController::class, 'deleteTheme'])->name("delete.theme");
    Route::post('/save_theme', [ThemeController::class, 'saveTheme'])->name("save.theme");

    // *****THEME SELECT******* //
    Route::get('/select_theme', [ThemeController::class, 'selectTheme'])->name('select.theme');
    Route::post('/save_selected_theme', [ThemeController::class, 'saveSelectedTheme'])->name('save.selected.theme');

    // *****HOME HEADER CUSTOMIZATION******* //
    Route::get('/theme_home_header_customization', [ThemeController::class, 'homeHeaderCustomization'])->name('theme.home.header.customization');
    Route::get('/theme_home_header_customization/edit/{id}', [ThemeController::class, 'homeHeaderCustomization'])->name('home.header.edit');
    Route::get('/theme_home_header_customization/delete/{id}', [ThemeController::class, 'deleteHomeHeader'])->name("home.header.delete");
    Route::post('/theme_home_header_save_first_step', [ThemeController::class, 'homeHeaderSaveFirstStep'])->name('home.save.first.step');

    // *****HOME CUSTOM DATA******* //
    Route::get('/theme_home_custom_data', [ThemeController::class, 'homeCustomData'])->name('theme.home.custom.data');
    Route::get('/theme_home_custom_data/edit/{id}', [ThemeController::class, 'homeCustomData'])->name('home.custom.data.edit');
    Route::get('/theme_home_custom_data/delete/{id}', [ThemeController::class, 'deleteCustomData'])->name("home.custom.data.delete");
    Route::post('/theme_home_save_sec_step', [ThemeController::class, 'homeSaveSecStep'])->name('home.save.sec.step');

    // *****HOME ABOUT US DATA******* //
    Route::get('/theme_home_about_us', [ThemeController::class, 'homeAboutUs'])->name('theme.home.about.us');
    Route::get('/theme_home_about_us/edit/{id}', [ThemeController::class, 'homeAboutUs'])->name('home.about.us.edit');
    Route::get('/theme_home_about_us/delete/{id}', [ThemeController::class, 'deleteAboutUs'])->name("home.about.us.delete");
    Route::post('/theme_home_save_third_step', [ThemeController::class, 'homeSaveThirdStep'])->name('home.save.third.step');

    // *****HOME SERVICE DATA******* //
    Route::get('/theme_home_service_us', [ThemeController::class, 'homeService'])->name('theme.home.service');
    Route::get('/theme_home_service_us/edit/{id}', [ThemeController::class, 'homeService'])->name('home.service.edit');
    Route::get('/theme_home_service_us/delete/{id}', [ThemeController::class, 'deleteService'])->name("home.service.delete");
    Route::post('/theme_home_save_fourth_step', [ThemeController::class, 'homeSaveFourthStep'])->name('home.save.fourth.step');

    // *****HOME CALL TO ACTION******* //
    Route::get('/theme_home_call_to_action', [ThemeController::class, 'homecallToAction'])->name('theme.home.call.to.action');
    Route::get('/theme_home_call_to_action/edit/{id}', [ThemeController::class, 'homecallToAction'])->name('home.call.to.action.edit');
    Route::get('/theme_home_call_to_action/delete/{id}', [ThemeController::class, 'deleteCallToAction'])->name("home.call.to.action.delete");
    Route::post('/theme_home_save_fifth_step', [ThemeController::class, 'homeSaveFifthStep'])->name('home.save.fifth.step');

    // *****HOME FEATURES******* //
    Route::get('/theme_home_feature', [ThemeController::class, 'homeFeatures'])->name('theme.home.feature');
    Route::get('/theme_home_feature/edit/{id}', [ThemeController::class, 'homeFeatures'])->name('home.feature.edit');
    Route::get('/theme_home_feature/delete/{id}', [ThemeController::class, 'deleteFeatures'])->name("home.feature.delete");
    Route::post('/theme_home_save_sixth_step', [ThemeController::class, 'homeSaveSixthStep'])->name('home.save.sixth.step');

    // *****HOME PRICING******* //
    Route::get('/theme_home_pricing', [ThemeController::class, 'homePricing'])->name('theme.home.pricing');
    Route::get('/theme_home_pricing/edit/{id}', [ThemeController::class, 'homePricing'])->name('home.pricing.edit');
    Route::get('/theme_home_pricing/delete/{id}', [ThemeController::class, 'deletePricing'])->name("home.pricing.delete");
    Route::post('/theme_home_save_seventh_step', [ThemeController::class, 'homeSaveSeventhStep'])->name('home.save.seventh.step');

    // *****HOME FREQUENTLY QUESTION******* //
    Route::get('/theme_home_frequently_qst', [ThemeController::class, 'homeFrequentlyQst'])->name('theme.home.frquently');
    Route::get('/theme_home_frequently_qst/edit/{id}', [ThemeController::class, 'homeFrequentlyQst'])->name('home.frquently.edit');
    Route::get('/theme_home_frequently_qst/delete/{id}', [ThemeController::class, 'deleteFrequentlyQst'])->name("home.frquently.delete");
    Route::post('/theme_home_save_eighth_step', [ThemeController::class, 'homeSaveEighthStep'])->name('home.save.eighth.step');

    // *****ABOUT TEAM MEMBER******* //`
    Route::get('/theme_about_team_member', [ThemeController::class, 'aboutTeamMember'])->name('theme.about.team.member');
    Route::get('/theme_about_team_member/edit/{id}', [ThemeController::class, 'aboutTeamMember'])->name('theme.about.team.member.edit');
    Route::get('/theme_about_team_member/delete/{id}', [ThemeController::class, 'deleteTeamMember'])->name("theme.about.team.member.delete");
    Route::post('/save_theme_team_member', [ThemeController::class, 'saveThemeTeamMember'])->name('save.theme.team.member');

    // *****CONTACT US******* //
    Route::get('/theme_contact', [ThemeController::class, 'themeContact'])->name('theme.contact');
    Route::get('/theme_contact/edit/{id}', [ThemeController::class, 'themeContact'])->name('theme.contact.edit');
    Route::get('/theme_contact/delete/{id}', [ThemeController::class, 'deleteContact'])->name("theme.contact.delete");
    Route::post('/save_theme_contact', [ThemeController::class, 'saveContact'])->name('save.theme.contact');

    // *****CREDENTIALS******* //
    Route::get('/credentials', [CredentialsController::class, 'viewCredentials'])->name('credentials.view');
    Route::get('/credentials/add', [CredentialsController::class, 'addCredentials'])->name('credentials.add');
    Route::get('/credentials/edit/{id}', [CredentialsController::class, 'editCredentials'])->name('credentials.edit');
    Route::get('/credentials/delete/{id}', [CredentialsController::class, 'deleteCredentials'])->name("credentials.delete");
    Route::post('/save_credentials', [CredentialsController::class, 'saveCredentials'])->name('save.credentials');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('p.logout');
