<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #f4f7f6;
            color: #333;
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
        }
        
        .description {
            text-align: center;
            color: #7f8c8d;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .required {
            color: #e74c3c;
        }
        
        input[type="text"],
        input[type="date"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        
        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="number"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }
        
        .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 5px;
        }
        
        .radio-option {
            display: flex;
            align-items: center;
        }
        
        .radio-option input[type="radio"] {
            margin-right: 8px;
        }
        
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .form-row .form-group {
            flex: 1;
            min-width: 250px;
        }
        
        .submit-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 30px auto 0;
            width: 200px;
            transition: background-color 0.3s;
        }
        
        .submit-btn:hover {
            background-color: #2980b9;
        }
        
        .field-info {
            font-size: 0.85rem;
            color: #7f8c8d;
            margin-top: 5px;
        }
        
        footer {
            text-align: center;
            margin-top: 30px;
            color: #95a5a6;
            font-size: 0.9rem;
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .radio-group {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Personal Information Form</h1>
        <p class="description">Please fill in all the required fields marked with <span class="required">*</span></p>
        
        <form action="{{ route('studentStore') }}" method="POST">
            @csrf
            <!-- Name field -->
            <div class="form-group">
                <label for="name">Full Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            </div>
            
            <!-- Gender field -->
            <div class="form-group">
                <label>Gender <span class="required">*</span></label>
                <div class="radio-group">
                    <label class="radio-option">
                        <input type="radio" name="gender" value="m" checked> Male
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="gender" value="f"> Female
                    </label>
                </div>
            </div>
            
            <!-- Address field -->
            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" placeholder="Enter your full address"></textarea>
                <div class="field-info">Street, city, state/province, and zip/postal code</div>
            </div>
            
            <!-- Birth Date and BAC Grade in a row -->
            <div class="form-row">
                <div class="form-group">
                    <label for="birthDate">Date of Birth <span class="required">*</span></label>
                    <input type="date" id="birthDate" name="birthDate" required>
                </div>
                
                <div class="form-group">
                    <label for="bacGrade">BAC Grade <span class="required">*</span></label>
                    <input type="number" id="bacGrade" name="bacGrade" min="0" max="20" step="0.01" placeholder="e.g., 15.75" required>
                    <div class="field-info">Enter a value between 0 and 20 (e.g., 15.5)</div>
                </div>
            </div>
            
            <!-- Branch field -->
            <div class="form-group">
                <label for="idBranch">Branch <span class="required">*</span></label>
                <select id="idBranch" name="idBranch" required>
                    <option value="">Select a branch</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
                <div class="field-info">Select the student's branch</div>
            </div>
            
            <!-- Submit button -->
            <button type="submit" class="submit-btn">Submit Form</button>
        </form>
        
        <footer>
            <p>This form collects personal information for registration purposes.</p>
        </footer>
    </div>
</body>
</html>



