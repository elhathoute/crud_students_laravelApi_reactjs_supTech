<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Information</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
            color: white;
            padding: 25px 30px;
            position: relative;
        }
        
        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .header p {
            opacity: 0.9;
            font-size: 16px;
        }
        
        .header i {
            font-size: 32px;
        }
        
        .form-container {
            padding: 30px;
        }
        
        .student-id-badge {
            display: inline-block;
            background-color: #e8f0fe;
            color: #4b6cb7;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 18px;
        }
        
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px 20px;
        }
        
        .form-group {
            flex: 1;
            min-width: 300px;
            padding: 0 15px;
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #444;
            font-size: 15px;
        }
        
        .required::after {
            content: " *";
            color: #e74c3c;
        }
        
        input, select, textarea {
            width: 100%;
            padding: 14px 16px;
            border: 1.5px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #fcfcfc;
        }
        
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #4b6cb7;
            box-shadow: 0 0 0 3px rgba(75, 108, 183, 0.1);
            background-color: white;
        }
        
        .gender-options {
            display: flex;
            gap: 20px;
            margin-top: 5px;
        }
        
        .gender-option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        
        .gender-option input {
            width: auto;
            margin: 0;
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #eee;
        }
        
        .btn {
            padding: 14px 28px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-save {
            background-color: #4b6cb7;
            color: white;
        }
        
        .btn-save:hover {
            background-color: #3a5795;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(75, 108, 183, 0.3);
        }
        
        .btn-cancel {
            background-color: #f1f3f9;
            color: #555;
        }
        
        .btn-cancel:hover {
            background-color: #e4e7f0;
        }
        
        .form-note {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
            font-style: italic;
        }
        
        .bac-grade-container {
            position: relative;
        }
        
        .grade-display {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #4b6cb7;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
        }
        
        .form-footer {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            color: #777;
            font-size: 14px;
            border-top: 1px solid #eee;
        }
        
        @media (max-width: 768px) {
            .form-group {
                min-width: 100%;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
        
        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .last-updated {
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-user-graduate"></i> Student Information</h1>
            <p>View student details in the system.</p>
        </div>
        
        <div class="info-container">
            <div class="info-header">
                <div class="student-id-badge">
                    <i class="fas fa-id-badge"></i> Student ID: {{ $student->id }}
                </div>
                <div class="last-updated">
                    <i class="far fa-clock"></i> Last updated: {{ $student->updated_at }}
                </div>
            </div>
            
            <div class="info-section">
                <div class="info-row">
                    <div class="info-group">
                        <label class="info-label">Student ID</label>
                        <div class="info-value">{{ $student->id }}</div>
                    </div>
                    
                    <div class="info-group">
                        <label class="info-label">Full Name</label>
                        <div class="info-value">{{ $student->name }}</div>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-group">
                        <label class="info-label">Gender</label>
                        <div class="info-value">
                            @if($student->gender == 'm')
                                Male
                            @elseif($student->gender == 'f')
                                Female
                            @else
                                {{ $student->gender }}
                            @endif
                        </div>
                    </div>
                    
                    <div class="info-group">
                        <label class="info-label">Date of Birth</label>
                        <div class="info-value">{{ $student->birthDate }}</div>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-group full-width">
                        <label class="info-label">Address</label>
                        <div class="info-value">{{ $student->address }}</div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-group full-width">
                        <label class="info-label">Branch</label>
                        <div class="info-value">{{ $student->branch->name ?? 'N/A' }}</div>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-group full-width">
                        <label class="info-label">BAC Grade</label>
                        <div class="info-value">{{ $student->bacGrade }}</div>
                    </div>
                </div>
            </div>
            
            <div class="info-footer">
                <p><i class="fas fa-info-circle"></i> All student information is confidential and protected under FERPA regulations.</p>
            </div>
        </div>
    </div>
    <button type="button" onclick="window.history.back()">
  Go Back
</button>
</body>
</html>