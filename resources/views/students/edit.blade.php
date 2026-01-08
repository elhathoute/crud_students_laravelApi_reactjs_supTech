<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Information</title>
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
            <h1><i class="fas fa-user-graduate"></i> Edit Student Information</h1>
            <p>Update student details in the system. Fields marked with * are required.</p>
        </div>
        
        <div class="form-container">
            <div class="form-header">
                <div class="student-id-badge">
                    <i class="fas fa-id-badge"></i> Student ID: {{ $student->id}}
                </div>
                <div class="last-updated">
                    <i class="far fa-clock"></i> Last updated: {{ $student->updated_at}}
                </div>
            </div>
            
            <form id="editStudentForm" action="{{route('updateStudent')}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="studentId" class="required">Student ID</label>
                        <input type="text" id="studentId" name="studentId" value="{{ $student->id}}" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="fullName" class="required">Full Name</label>
                        <input type="text" id="fullName" name="fullName" value="{{ $student->name}}" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="required">Gender</label>
                        <div class="gender-options">
                            <label class="gender-option">
                                <input type="radio" name="gender" value="m" 
                                @if($student->gender=='m') 
                                checked
                                @endif
                                >
                                <span>Male</span>
                            </label>
                            <label class="gender-option">
                                <input type="radio" name="gender" value="f"
                                @if($student->gender=='f') 
                                checked
                                @endif
                                >
                                <span>Female</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="dob" class="required">Date of Birth</label>
                        <input type="date" id="dob" name="dob" value="{{ $student->birthDate}}" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="address" class="required">Address</label>
                        <textarea id="address" name="address" rows="3" required>{{ $student->address}}</textarea>
                    </div>
                </div>
                
                <div class="form-group">
                <label for="idBranch">Branch</label>
                <select id="idBranch" name="idBranch" required>
                    @foreach($branches as $branch)
                    <option value="{{$branch->id}}" 
                        @if($branch->id==$student->idBranch)
                            selected
                        @endif
                         >{{$branch->name}}</option>
                    @endforeach
                </select>
                 </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="bacGrade" class="required">BAC Grade</label>
                        <div class="bac-grade-container">
                            <input type="range" id="bacGrade" name="bacGrade" min="10" max="20" step="0.1" value="{{ $student->bacGrade}}" required>
                            <div class="grade-display" id="gradeDisplay">{{ $student->bacGrade}}</div>
                        </div>
                        <div class="form-note">Slide to adjust the BAC grade. Range: 10.0 to 20.0</div>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="button" class="btn btn-cancel" id="cancelBtn">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-save">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </form>
            
            <div class="form-footer">
                <p><i class="fas fa-info-circle"></i> All student information is confidential and protected under FERPA regulations.</p>
            </div>
        </div>
    </div>
</body>
</html>