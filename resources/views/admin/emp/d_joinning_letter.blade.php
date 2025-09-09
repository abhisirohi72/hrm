<div style="font-family: Arial, sans-serif; line-height: 1.6; padding: 20px;">
    <p>Date: {{ date('d-m-Y') }}</p>
    <div style="text-align: center;">
        <img src="{{ 'file://' . public_path('storage/company/' . $employee->branches->c_logo) }}"
            style="width: 100px;" class="card-img-top" alt="Card Image">
    </div>
    <p>To,<br>
        {{ $employee->full_name }}<br>
        {{ $employee->address }}</p>

    <p>Subject: <strong>Joining Letter</strong></p>

    <p>Dear {{ $employee->full_name }},</p>

    <p>We are pleased to confirm your appointment as <strong>{{ $employee->designation ?? '' }}</strong> in the
        <strong>{{ $employee->departments->name }}</strong> department at <strong>{{ env('APP_NAME') }}</strong>.</p>

    <p>Your joining date is <strong>{{ \Carbon\Carbon::parse($employee->joining_date)->format('d M, Y') }}</strong>.</p>

    {{-- <p>Your employee ID: <strong>{{ $employee->employee_code }}</strong></p> --}}

    <p>Welcome to the team!</p>

    <p>Regards,<br>
    <strong>{{ $employee->branches->c_website }}</strong>
    <strong>{{ $employee->branches->c_email }}</strong><br>
    <strong>{{ $hr_name }}</strong></p>
</div>
