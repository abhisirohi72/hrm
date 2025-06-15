<div style="font-family: Arial, sans-serif; line-height: 1.6; padding: 20px;">
    <p>Date: {{ date('d-m-Y') }}</p>
    <div style="text-align: center;">
        <img src="{{ 'file://' . public_path('storage/company/' . $employee->branches->c_logo) }}"
            style="width: 100px;" class="card-img-top" alt="Card Image">
    </div>
    <p>To,<br>
    {{ $employee->full_name }}<br>
    {{ $employee->address }}</p>

    <p>Subject: <strong>Offer of Employment</strong></p>

    <p>Dear {{ $employee->full_name }},</p>

    <p>We are pleased to offer you the position of <strong>{{ $employee->designation ?? '' }}</strong> in the <strong>{{ $employee->departments->name }}</strong> department at <strong>{{ $company_name }}</strong>.</p>

    <p>The terms and conditions of your employment, including compensation, job responsibilities, and policies, will be shared with you during onboarding.</p>

    <p>If you accept this offer, please confirm by replying or signing this document. We look forward to welcoming you to our team.</p>

    <p>Best Regards,<br>
    <strong>{{ $employee->branches->c_website }}</strong>
    <strong>{{ $employee->branches->c_email }}</strong><br>
    <strong>{{ $hr_name }}</strong></p>
</div>
