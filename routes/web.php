<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
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

    /*TODO CONTROLLER */
    Route::resource('todos', TodoController::class);

});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('p.logout');
